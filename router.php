<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$routes = [
    '/'                      => 'index.php',
    '/login'                 => 'login.php',
    '/register'              => 'register.php',
    '/packages'              => 'packages.php',
    '/game/sunwin'           => 'games/sunwin.php',
    '/game/baccarat'         => 'games/baccarat.php',
    '/game/baccarat-table'   => 'games/baccarat-table.php',
    '/apk'                   => 'apk.php',
    '/buy-key'               => 'buy-key.php',
    '/free-key'              => 'free-key.php',
    '/apk-key'               => 'apk-key.php',
    '/giftcode'              => 'giftcode.php',
    '/account'               => 'account.php',
    '/deposit'               => 'deposit.php',
    '/history'               => 'history.php',
    '/support'               => 'support.php',
    '/payment-qr'            => 'payment-qr.php',
    '/admin'                 => 'admin/index.php',
    '/admin/'                => 'admin/index.php',
    '/admin/login'           => 'admin/login.php',
    '/admin/transactions'    => 'admin/transactions.php',
    '/admin/packages'        => 'admin/packages.php',
    '/admin/package-history' => 'admin/package_history.php',
    '/admin/giftcodes'       => 'admin/giftcodes.php',
    '/admin/keys'            => 'admin/keys.php',
];

// Chặn truy cập trực tiếp file PHP
if (preg_match('#\.php$#i', $uri) && !preg_match('#^/api/#', $uri)) {
    http_response_code(403);
    echo '<h1>403 - Truy cập bị từ chối</h1>';
    return true;
}

// Khớp route chính xác
if (isset($routes[$uri])) {
    $file = __DIR__ . '/' . $routes[$uri];
    if (file_exists($file)) {
        header('Content-Type: text/html; charset=utf-8');
        require $file;
        return true;
    }
}

// Chặn truy cập trực tiếp file APK - bắt buộc tải qua API có xác thực
if (preg_match('#^/assets/apk/.+\.apk$#i', $uri)) {
    http_response_code(404);
    echo '<h1>404 - Không tìm thấy trang</h1>';
    return true;
}

// Nếu file/thư mục thực sự tồn tại thì phục vụ trực tiếp (trừ .php)
$file = __DIR__ . $uri;
if (file_exists($file) && !is_dir($file) && !preg_match('#\.php$#i', $uri)) {
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
