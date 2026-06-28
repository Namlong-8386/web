<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

$user = require_login();

$input = get_json_input();
$pkg_type = isset($input['pkg_type']) ? trim($input['pkg_type']) : '';

$packages = [
    '1_day'    => ['name' => 'Key 1 Ngày',    'price' => 5000,   'days' => 1],
    '7_day'    => ['name' => 'Key 7 Ngày',    'price' => 25000,  'days' => 7],
    '30_day'   => ['name' => 'Key 30 Ngày',   'price' => 80000,  'days' => 30],
    'lifetime' => ['name' => 'Key Vĩnh Viễn', 'price' => 150000, 'days' => 0],
];

if (!isset($packages[$pkg_type])) {
    json_response(false, 'Gói key không hợp lệ.');
}

$pkg = $packages[$pkg_type];

$users = read_json('users.json');
$user_index = -1;
for ($i = 0; $i < count($users); $i++) {
    if ($users[$i]['username'] === $user['username']) {
        $user_index = $i;
        break;
    }
}

if ($user_index === -1) {
    json_response(false, 'Không tìm thấy thông tin người dùng.');
}

if ($users[$user_index]['balance'] < $pkg['price']) {
    json_response(false, 'Số dư trong tài khoản không đủ. Vui lòng nạp thêm tiền.');
}

$users[$user_index]['balance'] -= $pkg['price'];

// Tạo key ngẫu nhiên
function gen_key_part($len = 5) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $part = '';
    for ($i = 0; $i < $len; $i++) {
        $part .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $part;
}

$keys = read_json('keys.json');
do {
    $new_key = 'KEY-' . gen_key_part() . '-' . gen_key_part() . '-' . gen_key_part();
} while (isset($keys[$new_key]));

$expiry = $pkg['days'] > 0
    ? date('Y-m-d H:i:s', time() + $pkg['days'] * 86400)
    : '';

$keys[$new_key] = [
    'hwid'       => '',
    'expiry'     => $expiry,
    'type'       => $pkg_type,
    'username'   => $user['username'],
    'created_at' => date('Y-m-d H:i:s'),
];

$transactions = read_json('transactions.json');
$tx_id = 'TX' . time() . rand(100, 999);
$transactions[] = [
    'id'       => $tx_id,
    'username' => $user['username'],
    'type'     => 'out',
    'title'    => 'Mua ' . $pkg['name'],
    'amount'   => $pkg['price'],
    'time'     => date('H:i - d/m/Y'),
    'status'   => 'Thành công',
];

if (write_json('users.json', $users) && write_json('keys.json', $keys) && write_json('transactions.json', $transactions)) {
    json_response(true, [
        'message'     => 'Mua ' . $pkg['name'] . ' thành công!',
        'key'         => $new_key,
        'expiry'      => $expiry ? date('d/m/Y H:i', strtotime($expiry)) : 'Vĩnh viễn',
        'new_balance' => $users[$user_index]['balance'],
    ]);
} else {
    json_response(false, 'Lỗi hệ thống khi thực hiện giao dịch. Vui lòng thử lại.', 500);
}
