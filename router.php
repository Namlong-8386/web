<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$routes = [
    '/'                      => 'index.html',
    '/login'                 => 'login.html',
    '/register'              => 'register.html',
    '/packages'              => 'packages.html',
    '/game/sunwin'           => 'games/sunwin.html',
    '/game/baccarat'         => 'games/baccarat.html',
    '/game/baccarat-table'   => 'games/baccarat-table.html',
    '/apk'                   => 'apk.html',
    '/buy-key'               => 'buy-key.html',
    '/free-key'              => 'free-key.html',
    '/apk-key'               => 'apk-key.html',
    '/giftcode'              => 'giftcode.html',
    '/account'               => 'account.html',
    '/deposit'               => 'deposit.html',
    '/history'               => 'history.html',
    '/support'               => 'support.html',
    '/payment-qr'            => 'payment-qr.html',
    '/admin'                 => 'admin/index.html',
    '/admin/'                => 'admin/index.html',
    '/admin/login'           => 'admin/login.html',
    '/admin/transactions'    => 'admin/transactions.html',
    '/admin/packages'        => 'admin/packages.html',
    '/admin/package-history' => 'admin/package_history.html',
    '/admin/giftcodes'       => 'admin/giftcodes.html',
    '/admin/keys'            => 'admin/keys.html',
];

// Khớp route chính xác
if (isset($routes[$uri])) {
    $file = __DIR__ . '/' . $routes[$uri];
    if (file_exists($file)) {
        header('Content-Type: text/html; charset=utf-8');
        readfile($file);
        return true;
    }
}

// Chặn truy cập trực tiếp file APK - bắt buộc tải qua API có xác thực
if (preg_match('#^/assets/apk/.+\.apk$#i', $uri)) {
    http_response_code(404);
    echo '<h1>404 - Không tìm thấy trang</h1>';
    return true;
}

// Nếu file/thư mục thực sự tồn tại thì phục vụ trực tiếp
$file = __DIR__ . $uri;
if (file_exists($file) && !is_dir($file)) {
    return false;
}

// API routes: /api/xxx -> api/xxx.php
if (preg_match('#^/api/(.+)$#', $uri, $m)) {
    $phpFile = __DIR__ . '/api/' . $m[1] . '.php';
    if (file_exists($phpFile)) {
        require $phpFile;
        return true;
    }
    // Sub-paths like /api/games/sunwin
    $phpFile2 = __DIR__ . $uri . '.php';
    if (file_exists($phpFile2)) {
        require $phpFile2;
        return true;
    }
}

// 404 fallback
http_response_code(404);
echo '<h1>404 - Không tìm thấy trang</h1>';
