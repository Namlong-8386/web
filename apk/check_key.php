<?php
header('Content-Type: application/json; charset=utf-8');

// CẤU HÌNH MÚI GIỜ VIỆT NAM (GMT+7)
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Chỉ chấp nhận phương thức POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức không hợp lệ!']);
    exit;
}

// Lấy dữ liệu gửi lên từ APK
$key = $_POST['key'] ?? '';
$hwid = $_POST['hwid'] ?? '';

// Kiểm tra dữ liệu đầu vào
if (empty($key) || empty($hwid)) {
    echo json_encode(['status' => 'error', 'message' => 'Thiếu tham số Key hoặc HWID!']);
    exit;
}

$jsonFile = 'key.json';

// Kiểm tra sự tồn tại của file dữ liệu
if (!file_exists($jsonFile)) {
    echo json_encode(['status' => 'error', 'message' => 'Hệ thống cơ sở dữ liệu lỗi!']);
    exit;
}

// Đọc và giải mã file JSON
$jsonData = json_decode(file_get_contents($jsonFile), true);

// 1. Kiểm tra Key có tồn tại không
if (!isset($jsonData[$key])) {
    echo json_encode(['status' => 'error', 'message' => 'Key không tồn tại trên hệ thống!']);
    exit;
}

$keyData = $jsonData[$key];

// 2. KIỂM TRA HẠN SỬ DỤNG ĐẾN TỪNG GIỜ PHÚT GIÂY
if (!empty($keyData['expiry'])) {
    $currentTimeStamp = time(); // Thời gian hiện tại của VN (dạng timestamp)
    $expiryTimeStamp = strtotime($keyData['expiry']); // Thời gian hết hạn chuyển sang timestamp

    // Nếu thời gian hiện tại lớn hơn thời gian hết hạn
    if ($currentTimeStamp > $expiryTimeStamp) {
        echo json_encode(['status' => 'error', 'message' => 'Key này đã hết hạn sử dụng!']);
        exit;
    }
}

// 3. Kiểm tra và xử lý HWID
if (empty($keyData['hwid'])) {
    // Trường hợp Key mới chưa kích hoạt trên máy nào -> Trói HWID hiện tại vào Key
    $jsonData[$key]['hwid'] = $hwid;
    
    // Ghi lại vào file JSON (sử dụng LOCK_EX để tránh xung đột ghi file)
    file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT), LOCK_EX);
    
    echo json_encode([
        'status' => 'success', 
        'message' => 'Kích hoạt và liên kết thiết bị thành công!'
    ]);
    exit;
} else {
    // Trường hợp Key đã được kích hoạt trước đó -> Kiểm tra xem HWID có trùng khớp không
    if ($keyData['hwid'] === $hwid) {
        echo json_encode([
            'status' => 'success', 
            'message' => 'Xác thực thành công! Chào mừng trở lại.'
        ]);
        exit;
    } else {
        echo json_encode([
            'status' => 'error', 
            'message' => 'Key này đã được đăng ký cho một thiết bị khác!'
        ]);
        exit;
    }
}
