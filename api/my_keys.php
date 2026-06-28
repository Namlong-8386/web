<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

$user = require_login();

$keys = read_json('keys.json');
$my_keys = [];

foreach ($keys as $key_value => $key_data) {
    if (isset($key_data['username']) && $key_data['username'] === $user['username']) {
        $pkg_labels = [
            '1_day'    => 'Key 1 Ngày',
            '7_day'    => 'Key 7 Ngày',
            '30_day'   => 'Key 30 Ngày',
            'lifetime' => 'Key Vĩnh Viễn',
            'free'     => 'Key Free',
        ];
        $type = isset($key_data['type']) ? $key_data['type'] : 'unknown';
        $label = isset($pkg_labels[$type]) ? $pkg_labels[$type] : 'Key';

        $is_expired = false;
        $expiry_display = 'Vĩnh viễn';
        if (!empty($key_data['expiry'])) {
            $expiry_ts = strtotime($key_data['expiry']);
            $is_expired = $expiry_ts < time();
            $expiry_display = date('d/m/Y H:i', $expiry_ts);
        }

        $my_keys[] = [
            'key'        => $key_value,
            'label'      => $label,
            'type'       => $type,
            'hwid'       => $key_data['hwid'] ?? '',
            'expiry'     => $expiry_display,
            'is_expired' => $is_expired,
            'created_at' => isset($key_data['created_at']) ? $key_data['created_at'] : '',
        ];
    }
}

// Sắp xếp mới nhất lên trên
usort($my_keys, function($a, $b) {
    return strcmp($b['created_at'], $a['created_at']);
});

json_response(true, ['keys' => $my_keys]);
