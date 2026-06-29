# TOOLTX2026 Website

Website quản lý tài khoản, key kích hoạt và tải APK TOOLTX2026. Xây dựng bằng PHP built-in server với các trang HTML tĩnh và router tùy chỉnh.

## Cấu trúc chính

- `index.html` — trang chủ
- `login.html`, `register.html` — đăng nhập / đăng ký
- `account.html`, `deposit.html`, `history.html` — quản lý tài khoản
- `packages.html` — mua gói VIP
- `apk.html`, `buy-key.html`, `free-key.html` — tải APK và key
- `admin/` — trang quản trị
- `api/` — các endpoint PHP
- `router.php` — định tuyến yêu cầu

## Chạy dự án

Workflow mặc định: `php -S 0.0.0.0:5000 router.php`

## User preferences

*Chưa có tùy chọn được ghi nhận.*
