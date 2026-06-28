<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, 'Phương thức không hợp lệ.', 405);
}

$user = require_login();

$users = read_json('users.json');
$index = -1;
foreach ($users as $i => $u) {
    if ($u['user_id'] === $user['user_id']) { $index = $i; break; }
}
if ($index === -1) json_response(false, 'Không tìm thấy tài khoản.', 404);

if (!empty($users[$index]['free_key_claimed'])) {
    json_response(false, 'Tài khoản đã nhận key miễn phí trước đó.', 400);
}

function generate_key($prefix = 'FREE') {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $parts = [];
    for ($i = 0; $i < 3; $i++) {
        $seg = '';
        for ($j = 0; $j < 5; $j++) $seg .= $chars[random_int(0, strlen($chars) - 1)];
        $parts[] = $seg;
    }
    return $prefix . '-' . implode('-', $parts);
}

$key = generate_key('FREE');
$expiry = date('Y-m-d H:i:s', strtotime('+1 day'));

$keys = read_json('keys.json');
$keys[$key] = [
    'hwid'       => '',
    'expiry'     => $expiry,
    'type'       => 'free',
    'user_id'    => $user['user_id'],
    'created_at' => date('Y-m-d H:i:s'),
];
write_json('keys.json', $keys);

$users[$index]['free_key_claimed'] = true;
$users[$index]['free_key']         = $key;
write_json('users.json', $users);

json_response(true, ['key' => $key, 'expiry' => $expiry, 'message' => 'Nhận key miễn phí thành công!']);
