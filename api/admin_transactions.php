<?php
require_once __DIR__ . '/config.php';

// Chỉ cho phép admin truy cập
$admin = require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $transactions = read_json('transactions.json');
    // Trả về danh sách đảo ngược để giao dịch mới nhất ở trên đầu
    json_response(true, ['transactions' => array_reverse($transactions)]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = get_json_input();
    $tx_id = isset($input['tx_id']) ? trim($input['tx_id']) : '';
    $action = isset($input['action']) ? trim($input['action']) : ''; // 'approve' hoặc 'reject'

    if (empty($tx_id) || empty($action)) {
        json_response(false, 'Thiếu thông tin yêu cầu.');
    }

    $transactions = read_json('transactions.json');
    $tx_index = -1;
    for ($i = 0; $i < count($transactions); $i++) {
        if ($transactions[$i]['id'] === $tx_id) {
            $tx_index = $i;
            break;
        }
    }

    if ($tx_index === -1) {
        json_response(false, 'Không tìm thấy giao dịch này.');
    }

    if ($transactions[$tx_index]['status'] !== 'Chờ duyệt') {
        json_response(false, 'Giao dịch này đã được xử lý trước đó.');
    }

    $target_username = $transactions[$tx_index]['username'];
    $amount = $transactions[$tx_index]['amount'];

    if ($action === 'approve') {
        // Duyệt giao dịch: Cộng tiền cho người dùng
        $users = read_json('users.json');
        $user_index = -1;
        for ($j = 0; $j < count($users); $j++) {
            if ($users[$j]['username'] === $target_username) {
                $user_index = $j;
                break;
            }
        }

        if ($user_index === -1) {
            json_response(false, 'Không tìm thấy tài khoản người dùng thụ hưởng.');
        }

        // Thực hiện cộng số dư và đổi trạng thái giao dịch
        $users[$user_index]['balance'] += $amount;
        $transactions[$tx_index]['status'] = 'Thành công';

        if (write_json('users.json', $users) && write_json('transactions.json', $transactions)) {
            json_response(true, 'Đã phê duyệt giao dịch nạp tiền thành công!');
        } else {
            json_response(false, 'Lỗi hệ thống khi phê duyệt giao dịch.');
        }

    } elseif ($action === 'reject') {
        // Từ chối giao dịch: Chỉ thay đổi trạng thái
        $transactions[$tx_index]['status'] = 'Từ chối';

        if (write_json('transactions.json', $transactions)) {
            json_response(true, 'Đã từ chối yêu cầu nạp tiền.');
        } else {
            json_response(false, 'Lỗi hệ thống khi cập nhật giao dịch.');
        }
    } else {
        json_response(false, 'Hành động phê duyệt không hợp lệ.');
    }
}
