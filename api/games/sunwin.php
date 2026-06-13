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
// Cấu hình riêng của Sunwin
// ============================================================
$HISTORY_URL = 'http://103.249.117.228:46565/history';
$SORT_FIELD  = 'Phien';
// ============================================================

$action = isset($_GET['action']) ? trim($_GET['action']) : 'history';

if ($action === 'history') {
    $ctx = stream_context_create([
        'http' => [
            'method'  => 'GET',
            'timeout' => 10,
            'header'  => "User-Agent: Mozilla/5.0\r\n"
        ]
    ]);

    $raw = @file_get_contents($HISTORY_URL, false, $ctx);

    if ($raw === false) {
        json_response(false, 'Không thể kết nối đến máy chủ Sunwin. Vui lòng thử lại.', 503);
    }

    $parsed = json_decode($raw, true);
    if (!is_array($parsed)) {
        json_response(false, 'Dữ liệu từ máy chủ không hợp lệ.', 502);
    }

    usort($parsed, function($a, $b) use ($SORT_FIELD) {
        return intval($b[$SORT_FIELD]) - intval($a[$SORT_FIELD]);
    });

    json_response(true, [
        'game'       => 'sunwin',
        'data'       => array_slice($parsed, 0, 30),
        'fetched_at' => date('H:i:s d/m/Y')
    ]);
}

json_response(false, "Action '$action' không được hỗ trợ.", 400);
