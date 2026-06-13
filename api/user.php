<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

// Yêu cầu đăng nhập trước
$user = require_login();

json_response(true, [
    'username' => $user['username'],
    'full_name' => $user['full_name'],
    'user_id' => $user['user_id'],
    'balance' => $user['balance'],
    'role' => isset($user['role']) ? $user['role'] : 'user',
    'vip_expire' => isset($user['vip_expire']) ? $user['vip_expire'] : 0
]);
