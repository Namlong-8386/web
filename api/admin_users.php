<?php
require_once __DIR__ . '/config.php';

// Chỉ cho phép admin truy cập
$admin = require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $users = read_json('users.json');
    $sanitized_users = [];
    foreach ($users as $u) {
        $sanitized_users[] = [
            'username' => $u['username'],
            'full_name' => $u['full_name'],
            'user_id' => $u['user_id'],
            'balance' => $u['balance'],
            'role' => isset($u['role']) ? $u['role'] : 'user',
            'vip_expire' => isset($u['vip_expire']) ? $u['vip_expire'] : 0
        ];
    }
    json_response(true, ['users' => $sanitized_users]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = get_json_input();
    $action = isset($input['action']) ? trim($input['action']) : '';
    $target_username = isset($input['target_username']) ? trim($input['target_username']) : '';

    if (empty($action) || empty($target_username)) {
        json_response(false, 'Thiếu thông tin yêu cầu.');
    }

    $users = read_json('users.json');
    $user_index = -1;
    for ($i = 0; $i < count($users); $i++) {
        if ($users[$i]['username'] === $target_username) {
            $user_index = $i;
            break;
        }
    }

    if ($user_index === -1) {
        json_response(false, 'Không tìm thấy người dùng này.');
    }

    define('MASTER_ADMIN', 'Nam1411');
    $is_master = isset($admin['username']) && $admin['username'] === MASTER_ADMIN;

    if ($action === 'update_balance') {
        $new_balance = isset($input['balance']) ? intval($input['balance']) : 0;
        if ($new_balance < 0) {
            json_response(false, 'Số dư không thể âm.');
        }
        
        $old_balance = $users[$user_index]['balance'];
        $users[$user_index]['balance'] = $new_balance;

        // Lưu log giao dịch đặc biệt thay đổi số dư bởi admin
        $transactions = read_json('transactions.json');
        $tx_id = 'TX' . time() . rand(100, 999);
        $diff = $new_balance - $old_balance;
        $title = 'Được điều chỉnh số dư bởi Admin';
        if ($diff < 0) {
            $title = 'Bị Admin trừ số dư';
        }
        
        $new_tx = [
            'id' => $tx_id,
            'username' => $target_username,
            'type' => ($diff >= 0 ? 'in' : 'out'),
            'title' => $title,
            'amount' => abs($diff),
            'time' => date('H:i - d/m/Y'),
            'status' => 'Thành công'
        ];
        
        // Chỉ ghi nhận log nếu có sự thay đổi
        if ($diff != 0) {
            $transactions[] = $new_tx;
            write_json('transactions.json', $transactions);
        }

        if (write_json('users.json', $users)) {
            json_response(true, 'Cập nhật số dư người dùng thành công!');
        } else {
            json_response(false, 'Lỗi hệ thống khi cập nhật số dư.');
        }

    } elseif ($action === 'update_role') {
        $new_role = isset($input['role']) ? trim($input['role']) : 'user';
        if (!in_array($new_role, ['user', 'admin'])) {
            json_response(false, 'Vai trò không hợp lệ.');
        }

        $target_is_admin = isset($users[$user_index]['role']) && $users[$user_index]['role'] === 'admin';

        // Chỉ admin cố định mới được hạ quyền admin khác
        if ($target_is_admin && $new_role !== 'admin' && !$is_master) {
            json_response(false, 'Chỉ admin cố định mới có quyền hạ quyền admin khác.');
        }
        
        // Ngăn admin tự hạ cấp chính mình
        if ($target_username === $admin['username'] && $new_role !== 'admin') {
            json_response(false, 'Bạn không thể tự hạ cấp vai trò quản trị của chính mình.');
        }

        // Không cho phép hạ quyền admin cố định
        if ($target_username === MASTER_ADMIN && $new_role !== 'admin') {
            json_response(false, 'Không thể hạ quyền admin cố định.');
        }

        $users[$user_index]['role'] = $new_role;

        if (write_json('users.json', $users)) {
            json_response(true, 'Cập nhật vai trò người dùng thành công!');
        } else {
            json_response(false, 'Lỗi hệ thống khi cập nhật vai trò.');
        }
    } elseif ($action === 'update_vip') {
        $vip_expire = isset($input['vip_expire']) ? intval($input['vip_expire']) : 0;
        
        $users[$user_index]['vip_expire'] = $vip_expire;

        if (write_json('users.json', $users)) {
            json_response(true, 'Cập nhật thời hạn VIP người dùng thành công!');
        } else {
            json_response(false, 'Lỗi hệ thống khi cập nhật thời hạn VIP.');
        }
    } elseif ($action === 'delete_user') {
        if ($target_username === $admin['username']) {
            json_response(false, 'Bạn không thể tự xóa tài khoản của chính mình.');
        }

        $target_is_admin = isset($users[$user_index]['role']) && $users[$user_index]['role'] === 'admin';

        if ($target_is_admin && !$is_master) {
            json_response(false, 'Chỉ admin cố định mới có quyền xóa admin khác.');
        }

        if ($target_username === MASTER_ADMIN) {
            json_response(false, 'Không thể xóa tài khoản admin cố định.');
        }

        array_splice($users, $user_index, 1);

        if (write_json('users.json', $users)) {
            json_response(true, 'Xóa tài khoản người dùng thành công!');
        } else {
            json_response(false, 'Lỗi hệ thống khi xóa người dùng.');
        }
    } else {
        json_response(false, 'Hành động không hợp lệ.');
    }
}
