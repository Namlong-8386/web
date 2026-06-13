<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

// Yêu cầu đăng nhập trước
$user = require_login();

$input = get_json_input();
$package_name = isset($input['package_name']) ? trim($input['package_name']) : '';
$price = isset($input['price']) ? intval($input['price']) : 0;

if (empty($package_name) || $price <= 0) {
    json_response(false, 'Thông tin gói mua không hợp lệ.');
}

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

if ($users[$user_index]['balance'] < $price) {
    json_response(false, 'Số dư trong tài khoản không đủ để thực hiện giao dịch này.');
}

// Trừ số dư người dùng
$users[$user_index]['balance'] -= $price;

// Tính thời gian VIP
$duration = 86400; // Mặc định 1 ngày
if (stripos($package_name, '1 Ngày') !== false || stripos($package_name, '1 ngày') !== false) {
    $duration = 86400;
} elseif (stripos($package_name, '7 Ngày') !== false || stripos($package_name, '7 ngày') !== false) {
    $duration = 604800;
} elseif (stripos($package_name, '30 Ngày') !== false || stripos($package_name, '30 ngày') !== false || stripos($package_name, 'tháng') !== false || stripos($package_name, 'Tháng') !== false) {
    $duration = 2592000;
}

$current_expire = isset($users[$user_index]['vip_expire']) ? intval($users[$user_index]['vip_expire']) : 0;
if ($current_expire > time()) {
    $new_expire = $current_expire + $duration;
} else {
    $new_expire = time() + $duration;
}
$users[$user_index]['vip_expire'] = $new_expire;

// Tạo mã giao dịch mới
$transactions = read_json('transactions.json');
$tx_id = 'TX' . time() . rand(100, 999);

$new_tx = [
    'id' => $tx_id,
    'username' => $user['username'],
    'type' => 'out',
    'title' => 'Mua ' . $package_name,
    'amount' => $price,
    'time' => date('H:i - d/m/Y'),
    'status' => 'Thành công'
];

$transactions[] = $new_tx;

if (write_json('users.json', $users) && write_json('transactions.json', $transactions)) {
    json_response(true, [
        'message' => 'Mua gói ' . $package_name . ' thành công!',
        'new_balance' => $users[$user_index]['balance']
    ]);
} else {
    json_response(false, 'Lỗi hệ thống khi thực hiện giao dịch. Vui lòng thử lại sau.', 500);
}
