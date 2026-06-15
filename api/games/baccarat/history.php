<?php
require_once __DIR__ . '/../../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    json_response(false, 'Phương thức không được hỗ trợ.', 405);
}

require_login();

$HISTORY_URL = 'http://103.249.117.228:46566/history';

$ctx = stream_context_create([
    'http' => [
        'method'  => 'GET',
        'timeout' => 10,
        'header'  => "User-Agent: Mozilla/5.0\r\n"
    ]
]);

$raw = @file_get_contents($HISTORY_URL, false, $ctx);

if ($raw === false) {
    json_response(false, 'Không thể kết nối đến máy chủ Baccarat. Vui lòng thử lại.', 503);
}

$parsed = json_decode($raw, true);
if (!is_array($parsed)) {
    json_response(false, 'Dữ liệu từ máy chủ không hợp lệ.', 502);
}

$tables = array_values(array_filter($parsed, function($t) {
    return isset($t['table_name']);
}));

usort($tables, function($a, $b) {
    return strcmp($a['table_name'], $b['table_name']);
});

json_response(true, [
    'game'       => 'baccarat',
    'tables'     => $tables,
    'fetched_at' => date('H:i:s d/m/Y')
]);
