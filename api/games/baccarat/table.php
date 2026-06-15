<?php
require_once __DIR__ . '/../../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

$user = require_login();

$now = time();
$vip_expire = isset($user['vip_expire']) ? intval($user['vip_expire']) : 0;
if ($user['role'] !== 'admin' && $vip_expire <= $now) {
    json_response(false, 'Bạn cần có gói VIP còn hiệu lực để sử dụng tính năng này.', 403);
}

$table = isset($_GET['table']) ? trim($_GET['table']) : '';
if ($table === '') {
    json_response(false, 'Thiếu tham số tên bàn.', 400);
}

// Chỉ cho phép ký tự an toàn
if (!preg_match('/^[A-Za-z0-9_\-]+$/', $table)) {
    json_response(false, 'Tên bàn không hợp lệ.', 400);
}

$url = 'http://103.249.117.228:46566/data/' . rawurlencode($table);

$ctx = stream_context_create([
    'http' => [
        'method'  => 'GET',
        'timeout' => 10,
        'header'  => "User-Agent: Mozilla/5.0\r\n"
    ]
]);

$raw = @file_get_contents($url, false, $ctx);

if ($raw === false) {
    json_response(false, 'Không thể kết nối đến máy chủ Baccarat. Vui lòng thử lại.', 503);
}

$parsed = json_decode($raw, true);
if (!is_array($parsed)) {
    json_response(false, 'Dữ liệu từ máy chủ không hợp lệ.', 502);
}

json_response(true, $parsed);
