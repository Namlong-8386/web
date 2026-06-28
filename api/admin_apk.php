<?php
require_once __DIR__ . '/config.php';
$admin = require_admin();

define('APK_PATH', __DIR__ . '/../assets/apk/TOOLTX2026.apk');
define('APK_INFO', 'apk_info.json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $info = read_json(APK_INFO);
    if (empty($info) && file_exists(APK_PATH)) {
        $sz = filesize(APK_PATH);
        $info = ['filename'=>'TOOLTX2026.apk','version'=>'1.0.0','size'=>$sz,'size_label'=>round($sz/1048576,1).' MB','uploaded_at'=>date('d/m/Y H:i', filemtime(APK_PATH)),'uploaded_by'=>'system'];
    }
    json_response(true, ['apk'=>$info]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update version only
    if (isset($_POST['action']) && $_POST['action'] === 'update_version') {
        $version = trim($_POST['version'] ?? '');
        if (empty($version)) json_response(false, 'Thiếu phiên bản.');
        $info = read_json(APK_INFO);
        $info['version'] = $version;
        write_json(APK_INFO, $info);
        json_response(true, 'Cập nhật phiên bản thành công!');
    }

    if (!isset($_FILES['apk'])) json_response(false, 'Không tìm thấy file APK.');
    $file = $_FILES['apk'];
    $version = trim($_POST['version'] ?? '1.0.0');
    if ($file['error'] !== UPLOAD_ERR_OK) json_response(false, 'Lỗi upload. Mã: ' . $file['error']);
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if ($ext !== 'apk') json_response(false, 'Chỉ chấp nhận file .apk');
    if ($file['size'] > 200 * 1024 * 1024) json_response(false, 'File quá lớn (tối đa 200MB).');
    $dir = dirname(APK_PATH);
    if (!is_dir($dir)) mkdir($dir, 0777, true);
    if (!move_uploaded_file($file['tmp_name'], APK_PATH)) json_response(false, 'Lỗi lưu file APK.');
    $sz = filesize(APK_PATH);
    $info = ['filename'=>'TOOLTX2026.apk','version'=>$version,'size'=>$sz,'size_label'=>round($sz/1048576,1).' MB','uploaded_at'=>date('d/m/Y H:i'),'uploaded_by'=>$admin['username']];
    write_json(APK_INFO, $info);
    json_response(true, ['message'=>'Cập nhật APK thành công! Phiên bản '.$version,'apk'=>$info]);
}
