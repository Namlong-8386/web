<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, 'Phương thức không hợp lệ.', 405);
}

check_rate_limit('verify_key_token', 30, 60);

$input = get_json_input();
$token = isset($input['token']) ? trim($input['token']) : '';

if (empty($token)) {
    json_response(false, 'Token không hợp lệ.', 400);
}

$tokens = read_json('key_tokens.json');

if (!isset($tokens[$token])) {
    json_response(false, 'Link đã hết hạn hoặc không tồn tại.', 404);
}

$td = $tokens[$token];

if (!empty($td['used'])) {
    json_response(false, 'Key đã được nhận rồi. Mỗi link chỉ dùng một lần.', 400);
}

if (time() > $td['expires_at']) {
    unset($tokens[$token]);
    write_json('key_tokens.json', $tokens);
    json_response(false, 'Link đã hết hạn (quá 1 giờ). Vui lòng tạo lại.', 410);
}

// Đánh dấu token đã dùng
$tokens[$token]['used']    = true;
$tokens[$token]['used_at'] = date('Y-m-d H:i:s');
write_json('key_tokens.json', $tokens);

// Ghi key vào keys.json
$key     = $td['key'];
$expiry  = date('Y-m-d H:i:s', strtotime('+12 hours'));
$keys    = read_json('keys.json');
$keys[$key] = [
    'hwid'       => '',
    'expiry'     => $expiry,
    'type'       => 'free',
    'user_id'    => $td['user_id'],
    'created_at' => date('Y-m-d H:i:s'),
];
write_json('keys.json', $keys);

json_response(true, [
    'key'    => $key,
    'expiry' => $expiry,
    'message' => 'Nhận key thành công!',
]);
