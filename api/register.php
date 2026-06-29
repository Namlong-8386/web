<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

$input = get_json_input();
$username = isset($input['username']) ? trim($input['username']) : '';
$password = isset($input['password']) ? $input['password'] : '';
$full_name = $username;
$recaptchaToken = isset($input['recaptcha_token']) ? trim($input['recaptcha_token']) : '';

if (empty($username) || empty($password)) {
    json_response(false, 'Vui lòng nhập đầy đủ tất cả thông tin.');
}

// Verify reCAPTCHA
require_once __DIR__ . '/recaptcha.php';
if (!verifyRecaptcha($recaptchaToken)) {
    json_response(false, 'Vui lòng xác minh bạn không phải robot.');
}

if (strlen($username) < 4) {
    json_response(false, 'Tên đăng nhập phải có ít nhất 4 ký tự.');
}

if (strlen($password) < 6) {
    json_response(false, 'Mật khẩu phải có ít nhất 6 ký tự.');
}

$users = read_json('users.json');

// Kiểm tra trùng username
foreach ($users as $user) {
    if (strtolower($user['username']) === strtolower($username)) {
        json_response(false, 'Tên đăng nhập đã tồn tại trên hệ thống.');
    }
}

// Tạo user_id ngẫu nhiên gồm 6 chữ số không trùng lặp
$user_id = '';
do {
    $temp_id = strval(rand(100000, 999999));
    $id_exists = false;
    foreach ($users as $user) {
        if ($user['user_id'] === $temp_id) {
            $id_exists = true;
            break;
        }
    }
    if (!$id_exists) {
        $user_id = $temp_id;
    }
} while (empty($user_id));

// Tạo tài khoản mới
$new_user = [
    'username' => $username,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'full_name' => $full_name,
    'user_id' => $user_id,
    'balance' => 0, // Số dư ban đầu là 0 VNĐ
    'role' => 'user',
    'token' => ''
];

$users[] = $new_user;
if (write_json('users.json', $users)) {
    json_response(true, 'Đăng ký tài khoản thành công!');
} else {
    json_response(false, 'Lỗi hệ thống khi lưu tài khoản. Vui lòng thử lại sau.', 500);
}
