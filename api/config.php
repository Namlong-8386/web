<?php
// Thiết lập header JSON
header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set('Asia/Ho_Chi_Minh');

// ── CORS: Chỉ cho phép cùng domain ─────────────────────────────────────────
if (isset($_SERVER['HTTP_ORIGIN'])) {
    $origin = $_SERVER['HTTP_ORIGIN'];
    $host   = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    $allowed = ['http://' . $host, 'https://' . $host];
    if (in_array($origin, $allowed, true)) {
        header('Access-Control-Allow-Origin: ' . $origin);
        header('Access-Control-Allow-Credentials: true');
        header('Vary: Origin');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    } else {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Truy cập không được phép.'], JSON_UNESCAPED_UNICODE);
        exit;
    }
} else {
    // Không có Origin header = trình duyệt gọi cùng domain hoặc server-to-server
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Định nghĩa đường dẫn dữ liệu
define('DATA_DIR', __DIR__ . '/data');

// Tạo thư mục dữ liệu nếu chưa tồn tại
if (!is_dir(DATA_DIR)) {
    mkdir(DATA_DIR, 0777, true);
}

// Đọc dữ liệu từ file JSON
function read_json($filename) {
    $path = DATA_DIR . '/' . $filename;
    if (!file_exists($path)) {
        return [];
    }
    $content = file_get_contents($path);
    $data = json_decode($content, true);
    return is_array($data) ? $data : [];
}

// Ghi dữ liệu vào file JSON
function write_json($filename, $data) {
    $path = DATA_DIR . '/' . $filename;
    // Sử dụng LOCK_EX để tránh ghi đè đồng thời
    return file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX) !== false;
}

// Phản hồi JSON và kết thúc chương trình
function json_response($success, $message_or_data, $status_code = 200) {
    http_response_code($status_code);
    $response = ['success' => $success];
    if (is_array($message_or_data)) {
        $response = array_merge($response, $message_or_data);
    } else {
        $response['message'] = $message_or_data;
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// Đọc dữ liệu POST dạng JSON
function get_json_input() {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

// Xác thực người dùng qua token
function get_auth_user() {
    $token = '';
    // Chỉ chấp nhận token từ Authorization header (Bearer token)
    $headers = getallheaders();
    if (isset($headers['Authorization'])) {
        if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            $token = $matches[1];
        }
    }

    if (empty($token)) {
        return null;
    }

    $users = read_json('users.json');
    foreach ($users as $user) {
        if (isset($user['token']) && !empty($user['token']) && $user['token'] === $token) {
            return $user;
        }
    }
    return null;
}

// ── Rate Limiting: Chống brute force và spam ─────────────────────────────────
function check_rate_limit($action, $max_requests = 30, $window_seconds = 60) {
    $limits_file = 'rate_limits.json';
    $limits = read_json($limits_file);
    $now = time();

    // Dùng hash IP để không lưu IP thật
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
    $key = hash('sha256', $ip) . '_' . $action;

    // Xoá bản ghi cũ (dọn dẹp để file không phình to)
    foreach ($limits as $k => $v) {
        if ($now - $v['window_start'] > $window_seconds * 2) {
            unset($limits[$k]);
        }
    }

    if (!isset($limits[$key]) || ($now - $limits[$key]['window_start']) >= $window_seconds) {
        $limits[$key] = ['count' => 1, 'window_start' => $now];
    } else {
        $limits[$key]['count']++;
    }

    write_json($limits_file, $limits);

    if ($limits[$key]['count'] > $max_requests) {
        $wait = $window_seconds - ($now - $limits[$key]['window_start']);
        json_response(false, 'Quá nhiều yêu cầu. Vui lòng thử lại sau ' . $wait . ' giây.', 429);
    }
}

// Yêu cầu đăng nhập mới được truy cập
function require_login() {
    $user = get_auth_user();
    if (!$user) {
        json_response(false, 'Phiên đăng nhập đã hết hạn hoặc không hợp lệ. Vui lòng đăng nhập lại.', 401);
    }
    return $user;
}

// Yêu cầu quyền admin mới được truy cập
function require_admin() {
    $user = require_login();
    if (!isset($user['role']) || $user['role'] !== 'admin') {
        json_response(false, 'Bạn không có quyền truy cập chức năng này.', 403);
    }
    return $user;
}

// Admin cố định, không thể bị xóa hoặc hạ quyền bởi admin khác
function init_admin_if_empty() {
    $users = read_json('users.json');
    $admin_username = 'Nam1411';
    $admin_password = 'Nam14112009';

    $master_index = -1;
    for ($i = 0; $i < count($users); $i++) {
        if ($users[$i]['username'] === $admin_username) {
            $master_index = $i;
            break;
        }
    }

    $changed = false;

    if ($master_index === -1) {
        // Chưa có admin cố định, tạo mới
        $users[] = [
            'username' => $admin_username,
            'password' => password_hash($admin_password, PASSWORD_DEFAULT),
            'full_name' => 'Quản trị viên',
            'user_id' => '999999',
            'balance' => 999999999,
            'role' => 'admin',
            'token' => ''
        ];
        $changed = true;
    } else {
        $u = &$users[$master_index];
        // Đảm bảo quyền admin
        if (!isset($u['role']) || $u['role'] !== 'admin') {
            $u['role'] = 'admin';
            $changed = true;
        }
        // Đảm bảo mật khẩu đúng, nhưng giữ nguyên token hiện tại
        if (!isset($u['password']) || !password_verify($admin_password, $u['password'])) {
            $u['password'] = password_hash($admin_password, PASSWORD_DEFAULT);
            $changed = true;
        }
    }

    if ($changed) {
        write_json('users.json', $users);
    }
}

// Gọi hàm khởi tạo admin mặc định
init_admin_if_empty();
