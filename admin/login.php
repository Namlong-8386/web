<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Đăng Nhập Admin - TOOLTX2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6'
                    }
                }
            }
        }
    </script>
<script src="/assets/js/anti-devtools.js"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-sm">
        <!-- Logo / Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-500/20 rounded-2xl mb-4 border border-blue-500/30">
                <i data-lucide="shield-check" class="w-8 h-8 text-blue-400"></i>
            </div>
            <h1 class="text-2xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">
                TOOLTX2026
            </h1>
            <p class="text-slate-400 text-sm mt-1">Trang quản trị hệ thống</p>
        </div>

        <!-- Login Card -->
        <div class="bg-slate-800 rounded-3xl p-6 shadow-2xl border border-slate-700">
            <h2 class="text-white font-bold text-lg mb-6 text-center">Đăng nhập Admin</h2>

            <div id="error-box" class="hidden mb-4 bg-red-500/10 border border-red-500/30 rounded-2xl p-3 flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-red-400 shrink-0"></i>
                <p id="error-msg" class="text-red-400 text-sm"></p>
            </div>

            <form id="login-form" onsubmit="handleLogin(event)" class="space-y-4">
                <!-- Username -->
                <div>
                    <label class="block text-slate-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">Tên đăng nhập</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-4 h-4 text-slate-500"></i>
                        </span>
                        <input type="text" id="username" autocomplete="username"
                            class="w-full pl-10 pr-4 py-3 bg-slate-700 border border-slate-600 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm"
                            placeholder="Nhập tên đăng nhập" required>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-slate-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">Mật khẩu</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-4 h-4 text-slate-500"></i>
                        </span>
                        <input type="password" id="password" autocomplete="current-password"
                            class="w-full pl-10 pr-12 py-3 bg-slate-700 border border-slate-600 rounded-2xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm"
                            placeholder="Nhập mật khẩu" required>
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-slate-300 transition-colors">
                            <i id="eye-icon" data-lucide="eye" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember me -->
                <div class="flex items-center gap-2 px-1 pt-1">
                    <input type="checkbox" id="remember-me" class="w-4 h-4 rounded border-slate-600 bg-slate-700 text-primary focus:ring-blue-500 cursor-pointer">
                    <label for="remember-me" class="text-sm text-slate-400 cursor-pointer select-none">Ghi nhớ tài khoản</label>
                </div>

                <div class="flex justify-center">
                    <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-theme="dark"></div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submit-btn"
                    class="w-full py-3.5 bg-blue-600 hover:bg-blue-500 active:scale-95 text-white font-bold rounded-2xl shadow-lg shadow-blue-900/40 transition-all flex items-center justify-center gap-2 mt-2">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span id="btn-text">Đăng nhập</span>
                </button>
            </form>
        </div>

        <p class="text-center text-slate-600 text-xs mt-6">Chỉ dành cho quản trị viên hệ thống</p>
    </div>

    <script>
        lucide.createIcons();

        // Nếu đã đăng nhập admin rồi thì chuyển thẳng vào dashboard
        if (localStorage.getItem('token') && localStorage.getItem('role') === 'admin') {
            window.location.href = '/admin';
        }

        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }

        function showError(msg) {
            const box = document.getElementById('error-box');
            document.getElementById('error-msg').innerText = msg;
            box.classList.remove('hidden');
            lucide.createIcons();
        }

        function hideError() {
            document.getElementById('error-box').classList.add('hidden');
        }

        // Load saved credentials
        function loadSavedCredentials() {
            const savedUser = localStorage.getItem('saved_username');
            const savedPass = localStorage.getItem('saved_password');
            if (savedUser) {
                document.getElementById('username').value = savedUser;
            }
            if (savedPass) {
                document.getElementById('password').value = savedPass;
                document.getElementById('remember-me').checked = true;
            }
        }

        async function handleLogin(e) {
            e.preventDefault();
            hideError();

            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('remember-me').checked;
            const btn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');

            const recaptchaToken = typeof grecaptcha !== 'undefined' ? grecaptcha.getResponse() : '';
            if (!recaptchaToken) {
                showError('Vui lòng tích xác nhận "Tôi không phải robot".');
                return;
            }

            btn.disabled = true;
            btnText.innerText = 'Đang xử lý...';

            try {
                const res = await fetch('../api/login.php', {
                    method: 'POST',
                    credentials: 'include',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username, password, recaptcha_token: recaptchaToken })
                });
                const data = await res.json();

                if (data.success) {
                    const role = data.role || (data.data && data.data.role);
                    if (role !== 'admin') {
                        showError('Tài khoản này không có quyền truy cập trang quản trị.');
                    } else {
                        const token = data.token || (data.data && data.data.token);
                        const uname = data.username || (data.data && data.data.username);

                        if (rememberMe) {
                            localStorage.setItem('saved_username', username);
                            localStorage.setItem('saved_password', password);
                        } else {
                            localStorage.removeItem('saved_username');
                            localStorage.removeItem('saved_password');
                        }

                        localStorage.setItem('token', token);
                        localStorage.setItem('username', uname);
                        localStorage.setItem('role', role);
                        window.location.href = '/admin';
                    }
                } else {
                    showError(data.message || 'Tên đăng nhập hoặc mật khẩu không đúng.');
                    if (typeof grecaptcha !== 'undefined') grecaptcha.reset();
                }
            } catch (err) {
                showError('Không thể kết nối đến máy chủ. Vui lòng thử lại.');
            } finally {
                btn.disabled = false;
                btnText.innerText = 'Đăng nhập';
            }
        }

        loadSavedCredentials();
    </script>
</body>
</html>
