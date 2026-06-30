<?php
require_once __DIR__ . '/config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    if ($action === 'admin_list') {
        $admin = require_admin();
        $codes = read_json('giftcodes.json');
        json_response(true, ['codes' => $codes]);
    }

    require_login();
    json_response(false, 'Hành động không hợp lệ.', 400);
}

if ($method === 'POST') {
    $input = get_json_input();
    $action = isset($input['action']) ? $input['action'] : '';

    if ($action === 'redeem') {
        $user = require_login();
        $code = isset($input['code']) ? strtoupper(trim($input['code'])) : '';

        if (empty($code)) {
            json_response(false, 'Vui lòng nhập mã giftcode.');
        }

        $codes = read_json('giftcodes.json');
        $code_index = -1;
        for ($i = 0; $i < count($codes); $i++) {
            if ($codes[$i]['code'] === $code) {
                $code_index = $i;
                break;
            }
        }

        if ($code_index === -1) {
            json_response(false, 'Mã giftcode không tồn tại hoặc không hợp lệ.');
        }

        $gc = $codes[$code_index];

        if ($gc['status'] !== 'active') {
            json_response(false, 'Mã giftcode này đã hết lượt sử dụng.');
        }

        if (in_array($user['username'], $gc['used_by'])) {
            json_response(false, 'Bạn đã sử dụng mã giftcode này rồi.');
        }

        if ($gc['quantity_used'] >= $gc['quantity']) {
            $codes[$code_index]['status'] = 'expired';
            write_json('giftcodes.json', $codes);
            json_response(false, 'Mã giftcode này đã hết lượt sử dụng.');
        }

        $users = read_json('users.json');
        $user_index = -1;
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]['username'] === $user['username']) {
                $user_index = $i;
                break;
            }
        }

        if ($user_index === -1) {
            json_response(false, 'Không tìm thấy thông tin tài khoản.');
        }

        $duration_seconds = $gc['days'] * 86400;
        $current_expire = isset($users[$user_index]['vip_expire']) ? intval($users[$user_index]['vip_expire']) : 0;
        if ($current_expire > time()) {
            $new_expire = $current_expire + $duration_seconds;
        } else {
            $new_expire = time() + $duration_seconds;
        }
        $users[$user_index]['vip_expire'] = $new_expire;

        $codes[$code_index]['used_by'][] = $user['username'];
        $codes[$code_index]['quantity_used'] += 1;
        if ($codes[$code_index]['quantity_used'] >= $codes[$code_index]['quantity']) {
            $codes[$code_index]['status'] = 'expired';
        }

        $transactions = read_json('transactions.json');
        $tx_id = 'GC' . time() . rand(100, 999);
        $new_tx = [
            'id' => $tx_id,
            'username' => $user['username'],
            'type' => 'in',
            'title' => 'Giftcode VIP ' . $gc['days'] . ' ngày',
            'amount' => 0,
            'time' => date('H:i - d/m/Y'),
            'status' => 'Thành công'
        ];
        $transactions[] = $new_tx;

        if (write_json('users.json', $users) && write_json('giftcodes.json', $codes) && write_json('transactions.json', $transactions)) {
            $exp_date = date('d/m/Y', $new_expire);
            json_response(true, [
                'message' => 'Kích hoạt giftcode thành công! VIP của bạn có hiệu lực đến ' . $exp_date . '.',
                'days' => $gc['days'],
                'vip_expire' => $new_expire
            ]);
        } else {
            json_response(false, 'Lỗi hệ thống. Vui lòng thử lại.', 500);
        }
    }

    if ($action === 'admin_create') {
        $admin = require_admin();
        $days = isset($input['days']) ? intval($input['days']) : 0;
        $quantity = isset($input['quantity']) ? intval($input['quantity']) : 0;
        $prefix = isset($input['prefix']) ? strtoupper(trim($input['prefix'])) : 'GIFT';
        $count = isset($input['count']) ? intval($input['count']) : 1;

        if ($days <= 0) {
            json_response(false, 'Số ngày VIP phải lớn hơn 0.');
        }
        if ($quantity <= 0) {
            json_response(false, 'Số lượt sử dụng phải lớn hơn 0.');
        }
        if ($count <= 0 || $count > 50) {
            json_response(false, 'Số lượng mã tạo phải từ 1 đến 50.');
        }

        $codes = read_json('giftcodes.json');
        $new_codes = [];

        for ($i = 0; $i < $count; $i++) {
            $code_str = $prefix . '-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
            $existing = false;
            foreach ($codes as $c) {
                if ($c['code'] === $code_str) { $existing = true; break; }
            }
            if ($existing) {
                $code_str = $prefix . '-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 10));
            }

            $new_code = [
                'code' => $code_str,
                'days' => $days,
                'quantity' => $quantity,
                'quantity_used' => 0,
                'status' => 'active',
                'created_by' => $admin['username'],
                'created_at' => date('H:i - d/m/Y'),
                'used_by' => []
            ];
            $codes[] = $new_code;
            $new_codes[] = $new_code;
        }

        if (write_json('giftcodes.json', $codes)) {
            json_response(true, ['message' => 'Tạo ' . $count . ' mã giftcode thành công!', 'codes' => $new_codes]);
        } else {
            json_response(false, 'Lỗi hệ thống khi lưu dữ liệu.', 500);
        }
    }

    if ($action === 'admin_delete') {
        $admin = require_admin();
        $code = isset($input['code']) ? strtoupper(trim($input['code'])) : '';
        if (empty($code)) {
            json_response(false, 'Thiếu mã giftcode.');
        }
        $codes = read_json('giftcodes.json');
        $new_codes = array_values(array_filter($codes, function($c) use ($code) { return $c['code'] !== $code; }));
        if (count($new_codes) === count($codes)) {
            json_response(false, 'Không tìm thấy mã giftcode.');
        }
        if (write_json('giftcodes.json', $new_codes)) {
            json_response(true, ['message' => 'Đã xóa mã giftcode thành công.']);
        } else {
            json_response(false, 'Lỗi hệ thống.', 500);
        }
    }

    json_response(false, 'Hành động không hợp lệ.', 400);
}

json_response(false, 'Phương thức không được hỗ trợ.', 405);
