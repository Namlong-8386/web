<?php
require_once __DIR__ . '/config.php';

// Yêu cầu đăng nhập mới được tải APK
$user = require_login();

$apkPath = __DIR__ . '/../assets/apk/TOOLTX2026.apk';

if (!file_exists($apkPath)) {
    json_response(false, 'File APK không tồn tại.', 404);
}

$filename = 'TOOLTX2026.apk';
$fsize = filesize($apkPath);
$fmtime = filemtime($apkPath);

// Nếu client đã có file cùng phiên bản, trả về 304
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $fmtime) {
    header('HTTP/1.1 304 Not Modified');
    exit;
}

header('Content-Type: application/vnd.android.package-archive');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . $fsize);
header('Last-Modified: ' . gmdate('D, d M Y H:i:s T', $fmtime));
header('Cache-Control: private, no-cache');
header('X-Content-Type-Options: nosniff');

readfile($apkPath);
exit;
