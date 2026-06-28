<?php
header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set('Asia/Ho_Chi_Minh');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức không hợp lệ!']);
    exit;
}

$key  = $_POST['key']  ?? '';
$hwid = $_POST['hwid'] ?? '';

if (empty($key) || empty($hwid)) {
    echo json_encode(['status' => 'error', 'message' => 'Thiếu tham số Key hoặc HWID!']);
    exit;
}

$jsonFile = __DIR__ . '/data/keys.json';

if (!file_exists($jsonFile)) {
    echo json_encode(['status' => 'error', 'message' => 'Hệ thống cơ sở dữ liệu lỗi!']);
    exit;
}

$jsonData = json_decode(file_get_contents($jsonFile), true);
if (!is_array($jsonData)) $jsonData = [];

if (!isset($jsonData[$key])) {
    echo json_encode(['status' => 'error', 'message' => 'Key không tồn tại trên hệ thống!']);
    exit;
}

$keyData = $jsonData[$key];

if (!empty($keyData['expiry'])) {
    if (time() > strtotime($keyData['expiry'])) {
        echo json_encode(['status' => 'error', 'message' => 'Key này đã hết hạn sử dụng!']);
        exit;
    }
}

if (empty($keyData['hwid'])) {
    $jsonData[$key]['hwid'] = $hwid;
    file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    echo json_encode(['status' => 'success', 'message' => 'Kích hoạt và liên kết thiết bị thành công!']);
} else {
    if ($keyData['hwid'] === $hwid) {
        echo json_encode(['status' => 'success', 'message' => 'Xác thực thành công! Chào mừng trở lại.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Key này đã được đăng ký cho một thiết bị khác!']);
    }
}
