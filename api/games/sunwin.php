<?php
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

// Xác thực người dùng
$user = require_login();

// Kiểm tra VIP (admin bỏ qua)
$now = time();
$vip_expire = isset($user['vip_expire']) ? intval($user['vip_expire']) : 0;
if ($user['role'] !== 'admin' && $vip_expire <= $now) {
    json_response(false, 'Bạn cần có gói VIP còn hiệu lực để sử dụng tính năng này.', 403);
}

// ============================================================
// Cấu hình API dự đoán Sunwin
// ============================================================
$DUDOAN_URL = 'http://103.249.117.228:46565/dudoan';
// ============================================================

$action = isset($_GET['action']) ? trim($_GET['action']) : 'dudoan';

if ($action === 'dudoan') {
    $ctx = stream_context_create([
        'http' => [
            'method'  => 'GET',
            'timeout' => 10,
            'header'  => "User-Agent: Mozilla/5.0\r\n"
        ]
    ]);

    $raw = @file_get_contents($DUDOAN_URL, false, $ctx);

    if ($raw === false) {
        json_response(false, 'Không thể kết nối đến máy chủ dự đoán. Vui lòng thử lại.', 503);
    }

    $parsed = json_decode($raw, true);
    if (!is_array($parsed) || !isset($parsed['Phien']) || !isset($parsed['du_doan'])) {
        json_response(false, 'Dữ liệu từ máy chủ không hợp lệ.', 502);
    }

    json_response(true, [
        'game'       => 'sunwin',
        'data'       => $parsed,
        'fetched_at' => date('H:i:s d/m/Y')
    ]);
}

json_response(false, "Action '$action' không được hỗ trợ.", 400);
