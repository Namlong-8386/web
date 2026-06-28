<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, 'Phương thức không hợp lệ.', 405);
}

$user = require_login();

// Kiểm tra đã nhận key chưa
$users = read_json('users.json');
$uIndex = -1;
foreach ($users as $i => $u) {
    if ($u['user_id'] === $user['user_id']) { $uIndex = $i; break; }
}
if ($uIndex === -1) json_response(false, 'Không tìm thấy tài khoản.', 404);
if (!empty($users[$uIndex]['free_key_claimed'])) {
    json_response(false, 'Tài khoản đã nhận key miễn phí rồi.', 400);
}

// Xoá token cũ của user này nếu còn
$tokens = read_json('key_tokens.json');
foreach ($tokens as $tk => $td) {
    if (isset($td['user_id']) && $td['user_id'] === $user['user_id']) {
        unset($tokens[$tk]);
    }
}

// Tạo key ngẫu nhiên
function gen_key() {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $parts = [];
    for ($i = 0; $i < 3; $i++) {
        $s = '';
        for ($j = 0; $j < 5; $j++) $s .= $chars[random_int(0, strlen($chars) - 1)];
        $parts[] = $s;
    }
    return 'FREE-' . implode('-', $parts);
}

// Tạo token bảo mật
$token   = bin2hex(random_bytes(20));
$key     = gen_key();
$expires = time() + 3600; // hết hạn sau 1 giờ

$tokens[$token] = [
    'user_id'    => $user['user_id'],
    'key'        => $key,
    'expires_at' => $expires,
    'used'       => false,
    'created_at' => date('Y-m-d H:i:s'),
];
write_json('key_tokens.json', $tokens);

// Lấy domain hiện tại để tạo link đích
$scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost:5000';
$dest_url = urlencode($scheme . '://' . $host . '/apk-key?t=' . $token);

// Gọi Link4m API
$link4m_token = '687ee21a72bf7639b4009ae8';
$api_url      = "https://link4m.co/api-shorten/v2?api={$link4m_token}&url={$dest_url}";

$ctx    = stream_context_create(['http' => ['timeout' => 10]]);
$result = @json_decode(@file_get_contents($api_url, false, $ctx), true);

if (!$result || $result['status'] !== 'success') {
    // Fallback: trả thẳng link nếu Link4m lỗi
    $fallback = $scheme . '://' . $host . '/apk-key?t=' . $token;
    json_response(true, ['link' => $fallback, 'fallback' => true]);
}

json_response(true, ['link' => $result['shortenedUrl'], 'fallback' => false]);
