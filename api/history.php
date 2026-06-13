<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

// Yêu cầu đăng nhập trước
$user = require_login();

$transactions = read_json('transactions.json');
$user_transactions = [];

foreach ($transactions as $tx) {
    if ($tx['username'] === $user['username']) {
        $user_transactions[] = $tx;
    }
}

// Đảo ngược danh sách để giao dịch mới nhất ở trên đầu
$user_transactions = array_reverse($user_transactions);

json_response(true, [
    'transactions' => $user_transactions
]);
