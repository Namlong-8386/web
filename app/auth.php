<?php
header('Content-Type: application/json');

// File lưu trữ dữ liệu người dùng
$json_file = 'users.json';

// Kiểm tra phương thức request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit;
}

// Đọc dữ liệu gửi lên (hỗ trợ cả JSON body và Form Data)
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Nhận tham số action (mặc định là login nếu không truyền)
$action = $input['action'] ?? $_POST['action'] ?? 'login'; // 'login' hoặc 'register'

$username = $input['username'] ?? $_POST['username'] ?? '';
$password = $input['password'] ?? $_POST['password'] ?? '';
$device_id = $input['device_id'] ?? $_POST['device_id'] ?? '';

if (empty($username) || empty($password) || empty($device_id)) {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ username, password và device_id"]);
    exit;
}

// Đọc file users.json
if (!file_exists($json_file)) {
    file_put_contents($json_file, json_encode([], JSON_PRETTY_PRINT));
}

$users_data = json_decode(file_get_contents($json_file), true);
if (!$users_data) {
    $users_data = [];
}

if ($action === 'register') {
    // --- KIỂM TRA ĐIỀU KIỆN (VALIDATION) ---
    if (strlen($username) < 3 || strlen($username) > 20) {
        echo json_encode(["status" => "error", "message" => "Tên đăng nhập phải từ 3 đến 20 ký tự!"]);
        exit;
    }
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        echo json_encode(["status" => "error", "message" => "Tên đăng nhập chỉ được chứa chữ cái không dấu, chữ số và dấu gạch dưới!"]);
        exit;
    }
    if (strlen($password) < 6) {
        echo json_encode(["status" => "error", "message" => "Mật khẩu phải có ít nhất 6 ký tự!"]);
        exit;
    }
    // ----------------------------------------

    // 1. XỬ LÝ ĐĂNG KÝ TÀI KHOẢN
    if (isset($users_data[$username])) {
        echo json_encode(["status" => "error", "message" => "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác!"]);
        exit;
    }

    // Tạo tài khoản mới, gán device_id và đặt trạng thái mặc định là 'inactive' (chưa kích hoạt)
    $users_data[$username] = [
        "password" => $password,
        "device_id" => $device_id,
        "account_status" => "inactive" // Thêm trạng thái: 'active' (đã kích hoạt) hoặc 'inactive' (chưa kích hoạt)
    ];
    
    file_put_contents($json_file, json_encode($users_data, JSON_PRETTY_PRINT));
    echo json_encode(["status" => "success", "message" => "Đăng ký thành công! Tài khoản đang chờ Admin kích hoạt."]);
    exit;

} else {
    // 2. XỬ LÝ ĐĂNG NHẬP
    if (!isset($users_data[$username])) {
        echo json_encode(["status" => "error", "message" => "Tài khoản không tồn tại!"]);
        exit;
    }

    $user = $users_data[$username];

    // Kiểm tra mật khẩu
    if ($user['password'] !== $password) {
        echo json_encode(["status" => "error", "message" => "Mật khẩu không chính xác!"]);
        exit;
    }

    // --- KIỂM TRA TRẠNG THÁI KÍCH HOẠT ---
    // Nếu tài khoản có trường account_status và nó đang là 'inactive'
    if (isset($user['account_status']) && $user['account_status'] === 'inactive') {
        echo json_encode(["status" => "error", "message" => "Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ Quản trị viên!"]);
        exit;
    }
    // ------------------------------------

    // Kiểm tra và lưu thiết bị (Device ID)
    if (empty($user['device_id'])) {
        // Nếu admin hoặc ai đó tạo tài khoản mà chưa gắn device_id, thì gán thiết bị đầu tiên đăng nhập
        $users_data[$username]['device_id'] = $device_id;
        file_put_contents($json_file, json_encode($users_data, JSON_PRETTY_PRINT));
        
        echo json_encode(["status" => "success", "message" => "Đăng nhập thành công. Tài khoản đã được liên kết với thiết bị này!"]);
        exit;
    } else {
        // Nếu đã có thiết bị liên kết, kiểm tra xem có khớp với thiết bị hiện tại không
        if ($user['device_id'] !== $device_id) {
            echo json_encode(["status" => "error", "message" => "Tài khoản này đã được liên kết với thiết bị khác. Vui lòng đăng nhập trên thiết bị đã đăng ký!"]);
            exit;
        } else {
            echo json_encode(["status" => "success", "message" => "Đăng nhập thành công!"]);
            exit;
        }
    }
}
?>