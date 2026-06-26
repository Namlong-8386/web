<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

// Yêu cầu đăng nhập trước
$user = require_login();

$input = get_json_input();
$amount = isset($input['amount']) ? intval($input['amount']) : 0;
$method = isset($input['method']) ? trim($input['method']) : 'bank';

if ($amount < 10000) {
    json_response(false, 'Số tiền nạp tối thiểu là 10,000 VNĐ.');
}

if (!in_array($method, ['bank', 'momo'])) {
    json_response(false, 'Phương thức thanh toán không hợp lệ.');
}

// Tạo giao dịch mới ở trạng thái chờ duyệt
$transactions = read_json('transactions.json');
$tx_id = 'TX' . time() . rand(100, 999);

$new_tx = [
    'id' => $tx_id,
    'username' => $user['username'],
    'type' => 'in',
    'title' => 'Nạp tiền vào ví (' . ($method === 'bank' ? 'Bank' : 'Momo') . ')',
    'amount' => $amount,
    'time' => date('H:i - d/m/Y'),
    'status' => 'Chờ duyệt' // Chờ admin phê duyệt
];

$transactions[] = $new_tx;

if (write_json('transactions.json', $transactions)) {
    json_response(true, [
        'message' => 'Yêu cầu nạp tiền đã được gửi. Vui lòng chờ quản trị viên phê duyệt!',
        'tx_id'   => $tx_id,
        'amount'  => $amount,
        'method'  => $method,
        'user_id' => $user['user_id']
    ]);
} else {
    json_response(false, 'Lỗi hệ thống khi gửi yêu cầu. Vui lòng thử lại sau.', 500);
}
