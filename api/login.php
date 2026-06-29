<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

$input = get_json_input();
$username = isset($input['username']) ? trim($input['username']) : '';
$password = isset($input['password']) ? $input['password'] : '';
$captchaAnswer = isset($input['captcha_answer']) ? trim($input['captcha_answer']) : '';
$captchaId = isset($input['captcha_id']) ? trim($input['captcha_id']) : '';

if (empty($username) || empty($password) || $captchaAnswer === '') {
    json_response(false, 'Vui lòng nhập đầy đủ thông tin và mã xác minh.');
}

// Verify captcha via flat file
require_once __DIR__ . '/captcha_helper.php';
$stored = getCaptcha($captchaId);
if ($stored === null) {
    json_response(false, 'Mã xác minh đã hết hạn. Vui lòng tải lại trang.');
}
deleteCaptcha($captchaId);
if ($captchaAnswer !== $stored['answer']) {
    json_response(false, 'Mã xác minh không đúng. Vui lòng thử lại.');
}

$users = read_json('users.json');
$user_index = -1;

for ($i = 0; $i < count($users); $i++) {
    if (strtolower($users[$i]['username']) === strtolower($username)) {
        $user_index = $i;
        break;
    }
}

if ($user_index === -1 || !password_verify($password, $users[$user_index]['password'])) {
    json_response(false, 'Tên đăng nhập hoặc mật khẩu không chính xác.');
}

// Tạo token ngẫu nhiên
$token = bin2hex(random_bytes(16));
$users[$user_index]['token'] = $token;

if (write_json('users.json', $users)) {
    json_response(true, [
        'message' => 'Đăng nhập thành công!',
        'token' => $token,
        'username' => $users[$user_index]['username'],
        'role' => isset($users[$user_index]['role']) ? $users[$user_index]['role'] : 'user'
    ]);
} else {
    json_response(false, 'Lỗi hệ thống khi tạo phiên đăng nhập. Vui lòng thử lại sau.', 500);
}
