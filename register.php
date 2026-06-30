<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Đăng Ký - TOOLTX2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#3b82f6', danger: '#ef4444' } } } }</script>
    <style>
        body { background-color: #f1f5f9; -webkit-user-select: none; user-select: none; }
        .input-group:focus-within .input-icon { color: #3b82f6; }
        .input-group:focus-within { border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
        .input-error { border-color: #ef4444 !important; box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important; }
        .input-error .input-icon { color: #ef4444 !important; }
    </style>
<script src="/assets/js/anti-devtools.js"></script>
</head>
<body class="font-sans min-h-screen flex flex-col items-center justify-center relative overflow-hidden p-4">

    <div class="absolute top-0 left-0 w-full h-72 bg-gradient-to-b from-blue-100 to-transparent -z-10"></div>
    <a href="/" class="absolute top-6 left-6 w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-sm text-slate-500 hover:text-primary active:scale-95 z-20"><i data-lucide="arrow-left" class="w-5 h-5"></i></a>

    <main class="w-full max-w-md relative z-10">
        <!-- Shared Card Frame -->
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden">
            <!-- Top Header with Logo -->
            <div class="pt-8 pb-4 px-8 text-center">
                <div class="w-16 h-16 bg-gradient-to-tr from-primary to-blue-700 rounded-2xl mx-auto flex items-center justify-center mb-4 shadow-lg shadow-blue-500/30 transform rotate-12">
                    <i data-lucide="zap" class="w-8 h-8 text-white transform -rotate-12"></i>
                </div>
                <h1 class="text-2xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-800">TOOLTX2026</h1>
            </div>

            <!-- Tabs -->
            <div class="flex border-b border-slate-100 mx-8">
                <a href="/login" class="flex-1 pb-3 text-center text-sm font-semibold text-slate-400 hover:text-slate-600 transition-colors">Đăng nhập</a>
                <a href="/register" class="flex-1 pb-3 text-center text-sm font-bold text-primary border-b-2 border-primary">Đăng ký</a>
            </div>

            <!-- Form Body -->
            <div class="px-8 pt-6 pb-8">
                <form id="register-form" class="space-y-4" onsubmit="handleRegister(event)">

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700 pl-1">Tên đăng nhập</label>
                        <div class="input-group relative flex items-center bg-slate-50 border-2 border-slate-100 rounded-2xl transition-all duration-300">
                            <div class="pl-4 pr-3 py-3.5"><i data-lucide="user" class="w-5 h-5 text-slate-400 input-icon"></i></div>
                            <input type="text" id="username" required minlength="4" class="w-full py-3.5 pr-4 bg-transparent border-none focus:outline-none font-medium" placeholder="Tối thiểu 4 ký tự">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700 pl-1">Mật khẩu</label>
                        <div class="input-group relative flex items-center bg-slate-50 border-2 border-slate-100 rounded-2xl transition-all duration-300">
                            <div class="pl-4 pr-3 py-3.5"><i data-lucide="lock" class="w-5 h-5 text-slate-400 input-icon"></i></div>
                            <input type="password" id="password" required minlength="6" class="w-full py-3.5 pr-12 bg-transparent border-none focus:outline-none tracking-wide" placeholder="Tối thiểu 6 ký tự">
                            <button type="button" class="toggle-password absolute right-0 inset-y-0 px-4 flex items-center text-slate-400 focus:outline-none" data-target="password"><i data-lucide="eye" class="w-5 h-5 eye-icon"></i></button>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700 pl-1">Nhập lại mật khẩu</label>
                        <div id="confirm-group" class="input-group relative flex items-center bg-slate-50 border-2 border-slate-100 rounded-2xl transition-all duration-300">
                            <div class="pl-4 pr-3 py-3.5"><i data-lucide="shield-check" class="w-5 h-5 text-slate-400 input-icon"></i></div>
                            <input type="password" id="confirm-password" required class="w-full py-3.5 pr-12 bg-transparent border-none focus:outline-none tracking-wide" placeholder="Xác nhận lại mật khẩu">
                            <button type="button" class="toggle-password absolute right-0 inset-y-0 px-4 flex items-center text-slate-400 focus:outline-none" data-target="confirm-password"><i data-lucide="eye" class="w-5 h-5 eye-icon"></i></button>
                        </div>
                        <p id="error-message" class="text-danger text-xs font-medium pl-2 hidden mt-1">Mật khẩu không khớp!</p>
                    </div>

                    <div class="flex justify-center pt-2">
                        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                    </div>

                    <button type="submit" id="submit-btn" class="w-full bg-gradient-to-r from-primary to-blue-600 text-white font-bold py-4 rounded-2xl shadow-lg active:scale-[0.98] transition-transform flex items-center justify-center relative mt-2">
                        <span id="btn-text">Đăng ký tài khoản</span>
                        <i data-lucide="loader-2" id="btn-loader" class="w-5 h-5 animate-spin hidden absolute"></i>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- Custom Alert Modal -->
    <div id="alert-modal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeAlertModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div class="w-full max-w-sm bg-white rounded-3xl p-6 pointer-events-auto shadow-2xl relative">
                <div class="text-center mb-6">
                    <div id="alert-modal-icon" class="w-12 h-12 rounded-full bg-blue-50 text-primary flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="info" class="w-6 h-6"></i>
                    </div>
                    <h3 id="alert-modal-title" class="text-lg font-bold text-slate-800 mb-2">Thông báo</h3>
                    <p id="alert-modal-message" class="text-sm text-slate-500 px-2">...</p>
                </div>
                <button onclick="closeAlertModal()" class="w-full py-3 bg-primary hover:bg-blue-600 active:scale-95 text-white font-bold rounded-2xl shadow-lg transition-all">
                    Đóng
                </button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        let alertPromiseResolver = null;
        function alert(message, type = 'info') {
            document.getElementById('alert-modal-message').innerText = message;
            const iconDiv = document.getElementById('alert-modal-icon');
            if (type === 'success' || message.includes('thành công') || message.includes('Thành công')) {
                iconDiv.className = "w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mx-auto mb-4";
                iconDiv.innerHTML = '<i data-lucide="check-circle" class="w-6 h-6"></i>';
                document.getElementById('alert-modal-title').innerText = 'Thành công';
            } else if (type === 'error' || message.includes('Lỗi') || message.includes('không') || message.includes('thất bại')) {
                iconDiv.className = "w-12 h-12 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center mx-auto mb-4";
                iconDiv.innerHTML = '<i data-lucide="x-circle" class="w-6 h-6"></i>';
                document.getElementById('alert-modal-title').innerText = 'Lỗi';
            } else {
                iconDiv.className = "w-12 h-12 rounded-full bg-blue-50 text-primary flex items-center justify-center mx-auto mb-4";
                iconDiv.innerHTML = '<i data-lucide="info" class="w-6 h-6"></i>';
                document.getElementById('alert-modal-title').innerText = 'Thông báo';
            }
            lucide.createIcons();
            document.getElementById('alert-modal').classList.remove('hidden');
            return new Promise((resolve) => { alertPromiseResolver = resolve; });
        }
        function closeAlertModal() {
            document.getElementById('alert-modal').classList.add('hidden');
            if (alertPromiseResolver) { alertPromiseResolver(); alertPromiseResolver = null; }
        }

        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', function () {
                const input = document.getElementById(this.getAttribute('data-target')), icon = this.querySelector('.eye-icon');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type); icon.setAttribute('data-lucide', type === 'text' ? 'eye-off' : 'eye'); lucide.createIcons();
            });
        });

        function setRegisterBtnLoading(isLoading) {
            document.getElementById('btn-text').classList.toggle('opacity-0', isLoading);
            document.getElementById('btn-loader').classList.toggle('hidden', !isLoading);
            document.getElementById('submit-btn').disabled = isLoading;
        }

        async function handleRegister(e) {
            e.preventDefault();
            const username = document.getElementById('username').value.trim();
            const pwd = document.getElementById('password').value;
            const conf = document.getElementById('confirm-password').value;
            const grp = document.getElementById('confirm-group');

            const recaptchaToken = typeof grecaptcha !== 'undefined' ? grecaptcha.getResponse() : '';
            if (!recaptchaToken) {
                await alert('Vui lòng tích xác nhận "Tôi không phải robot".');
                return;
            }

            if (pwd !== conf) {
                grp.classList.add('input-error'); document.getElementById('error-message').classList.remove('hidden');
                grp.style.transform = 'translateX(-5px)'; setTimeout(() => grp.style.transform = 'translateX(5px)', 50); setTimeout(() => grp.style.transform = 'translateX(0)', 100);
                return;
            }

            setRegisterBtnLoading(true);

            try {
                const response = await fetch('api/register.php', {
                    method: 'POST',
                    credentials: 'include',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username, password: pwd, recaptcha_token: recaptchaToken })
                });
                const result = await response.json();
                if (result.success) {
                    await alert(result.message || "Đăng ký thành công!");
                    window.location.href = "/login";
                } else {
                    await alert(result.message || 'Đăng ký thất bại.');
                    if (typeof grecaptcha !== 'undefined') grecaptcha.reset();
                    setRegisterBtnLoading(false);
                }
            } catch (error) {
                console.error(error);
                await alert('Có lỗi xảy ra trong quá trình kết nối với máy chủ.');
                setRegisterBtnLoading(false);
            }
        }
        document.getElementById('confirm-password').addEventListener('input', () => { document.getElementById('confirm-group').classList.remove('input-error'); document.getElementById('error-message').classList.add('hidden'); });

    </script>
</body>
</html>
