<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

$user = require_login();

$tx_id = isset($_GET['tx']) ? trim($_GET['tx']) : '';

if (empty($tx_id)) {
    json_response(false, 'Thiếu mã giao dịch.');
}

$transactions = read_json('transactions.json');

$tx = null;
foreach ($transactions as $t) {
    if ($t['id'] === $tx_id) {
        $tx = $t;
        break;
    }
}

if (!$tx) {
    json_response(false, 'Không tìm thấy giao dịch.', 404);
}

if ($tx['username'] !== $user['username'] && (!isset($user['role']) || $user['role'] !== 'admin')) {
    json_response(false, 'Bạn không có quyền xem giao dịch này.', 403);
}

json_response(true, [
    'tx_id'    => $tx['id'],
    'amount'   => $tx['amount'],
    'status'   => $tx['status'],
    'time'     => $tx['time'],
    'user_id'  => $user['user_id'],
    'username' => $user['username'],
    'bank_id'      => '970422',
    'account_no'   => '0984705329',
    'account_name' => 'HO KHANH NAM',
]);
