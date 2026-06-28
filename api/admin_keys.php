<?php
require_once __DIR__ . '/config.php';
$admin = require_admin();

function gen_part($len = 5) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $out = '';
    for ($i = 0; $i < $len; $i++) $out .= $chars[random_int(0, strlen($chars) - 1)];
    return $out;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $keys = read_json('keys.json');
    $labels = ['1_day'=>'Key 1 Ngày','7_day'=>'Key 7 Ngày','30_day'=>'Key 30 Ngày','lifetime'=>'Key Vĩnh Viễn','free'=>'Key Free'];
    $result = [];
    foreach ($keys as $kv => $kd) {
        $type = $kd['type'] ?? 'unknown';
        $exp_ts = !empty($kd['expiry']) ? strtotime($kd['expiry']) : 0;
        $result[] = [
            'key'        => $kv,
            'label'      => $labels[$type] ?? 'Key',
            'type'       => $type,
            'username'   => $kd['username'] ?? '',
            'hwid'       => $kd['hwid'] ?? '',
            'expiry'     => $exp_ts > 0 ? date('d/m/Y H:i', $exp_ts) : 'Vĩnh viễn',
            'is_expired' => $exp_ts > 0 && $exp_ts < time(),
            'created_at' => $kd['created_at'] ?? '',
        ];
    }
    usort($result, fn($a,$b) => strcmp($b['created_at'], $a['created_at']));
    $active  = count(array_filter($result, fn($k) => !$k['is_expired']));
    $expired = count(array_filter($result, fn($k) => $k['is_expired']));
    $linked  = count(array_filter($result, fn($k) => $k['hwid'] !== ''));
    json_response(true, ['keys'=>$result,'stats'=>['total'=>count($result),'active'=>$active,'expired'=>$expired,'linked'=>$linked]]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input  = get_json_input();
    $action = $input['action'] ?? '';

    if ($action === 'create') {
        $type = $input['type'] ?? '';
        $qty  = min(max(intval($input['qty'] ?? 1), 1), 50);
        $username = trim($input['username'] ?? '');
        $type_days = ['1_day'=>1,'7_day'=>7,'30_day'=>30,'lifetime'=>0,'custom'=>intval($input['custom_days'] ?? 7)];
        if (!isset($type_days[$type])) json_response(false, 'Loại key không hợp lệ.');
        $days = $type_days[$type];
        $keys = read_json('keys.json');
        $created = [];
        for ($i = 0; $i < $qty; $i++) {
            do { $nk = 'KEY-'.gen_part().'-'.gen_part().'-'.gen_part(); } while (isset($keys[$nk]));
            $keys[$nk] = [
                'hwid'       => '',
                'expiry'     => $days > 0 ? date('Y-m-d H:i:s', time() + $days * 86400) : '',
                'type'       => $type,
                'username'   => $username,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $created[] = $nk;
        }
        write_json('keys.json', $keys) ? json_response(true, ['message'=>"Tạo $qty key thành công!",'keys'=>$created]) : json_response(false,'Lỗi hệ thống.',500);
    }

    elseif ($action === 'delete') {
        $kv = $input['key'] ?? '';
        if (empty($kv)) json_response(false, 'Thiếu key cần xóa.');
        $keys = read_json('keys.json');
        if (!isset($keys[$kv])) json_response(false, 'Key không tồn tại.');
        unset($keys[$kv]);
        write_json('keys.json', $keys) ? json_response(true, 'Đã xóa key thành công!') : json_response(false,'Lỗi hệ thống.',500);
    }

    elseif ($action === 'reset_hwid') {
        $kv = $input['key'] ?? '';
        if (empty($kv)) json_response(false, 'Thiếu key.');
        $keys = read_json('keys.json');
        if (!isset($keys[$kv])) json_response(false, 'Key không tồn tại.');
        $keys[$kv]['hwid'] = '';
        write_json('keys.json', $keys) ? json_response(true, 'Đã reset thiết bị!') : json_response(false,'Lỗi hệ thống.',500);
    }

    else { json_response(false, 'Action không hợp lệ.'); }
}
