<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$routes = [
    '/'                      => 'index.html',
    '/login'                 => 'login.html',
    '/register'              => 'register.html',
    '/packages'              => 'packages.html',
    '/game'                  => 'game.html',
    '/game/sunwin'           => 'games/sunwin.html',
    '/giftcode'              => 'giftcode.html',
    '/account'               => 'account.html',
    '/deposit'               => 'deposit.html',
    '/history'               => 'history.html',
    '/support'               => 'support.html',
    '/admin'                 => 'admin/index.html',
    '/admin/'                => 'admin/index.html',
    '/admin/login'           => 'admin/login.html',
    '/admin/transactions'    => 'admin/transactions.html',
    '/admin/packages'        => 'admin/packages.html',
    '/admin/package-history' => 'admin/package_history.html',
    '/admin/giftcodes'       => 'admin/giftcodes.html',
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

// Nếu file/thư mục thực sự tồn tại thì phục vụ trực tiếp
$file = __DIR__ . $uri;
if (file_exists($file) && !is_dir($file)) {
    return false;
}

// 404 fallback
http_response_code(404);
echo '<h1>404 - Không tìm thấy trang</h1>';
