<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/captcha_helper.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $a = rand(1, 9);
    $b = rand(1, 9);
    $op = rand(0, 1) === 0 ? '+' : '-';
    if ($op === '-' && $a < $b) { $tmp = $a; $a = $b; $b = $tmp; }
    $answer = $op === '+' ? $a + $b : $a - $b;
    $question = "$a $op $b = ?";
    $id = generateCaptchaId();
    saveCaptcha($id, $answer);
    json_response(true, ['question' => $question, 'captcha_id' => $id]);
}

if ($method === 'POST') {
    $input = get_json_input();
    $userAnswer = isset($input['answer']) ? trim($input['answer']) : '';
    $captchaId = isset($input['captcha_id']) ? trim($input['captcha_id']) : '';

    if (empty($captchaId)) {
        json_response(false, 'Thiếu mã xác minh. Vui lòng tải lại trang.');
    }
    $stored = getCaptcha($captchaId);
    if ($stored === null) {
        json_response(false, 'Mã xác minh đã hết hạn. Vui lòng tải lại trang.');
    }
    deleteCaptcha($captchaId);
    if ($userAnswer !== $stored['answer']) {
        json_response(false, 'Mã xác minh không đúng. Vui lòng thử lại.');
    }
    json_response(true, 'Mã xác minh chính xác.');
}

json_response(false, 'Phương thức không được hỗ trợ.', 405);
