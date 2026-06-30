<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - TOOLTX2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: '#3b82f6' } } } }
    </script>
    <style>
        * { -webkit-tap-highlight-color: transparent; }
        body {
            margin: 0; padding: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8fafc;
            color: #1e293b;
            overflow-x: hidden;
        }
        ::-webkit-scrollbar { display: none; }

        /* Animated mesh background */
        .mesh-bg {
            position: fixed; inset: 0; z-index: -1;
            background:
                radial-gradient(circle at 0% 0%, rgba(59,130,246,0.12) 0%, transparent 45%),
                radial-gradient(circle at 100% 0%, rgba(139,92,246,0.10) 0%, transparent 45%),
                radial-gradient(circle at 100% 100%, rgba(14,165,233,0.10) 0%, transparent 45%),
                radial-gradient(circle at 0% 100%, rgba(99,102,241,0.08) 0%, transparent 45%);
            animation: meshMove 18s ease-in-out infinite alternate;
        }
        @keyframes meshMove {
            0%   { transform: scale(1) translate(0,0); }
            100% { transform: scale(1.08) translate(-2%, -2%); }
        }

        /* Glass header */
        .glass-header {
            background: rgba(255,255,255,0.72);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226,232,240,0.8);
        }

        /* Hero card shimmer */
        .hero-card {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 24px;
            box-shadow: 0 20px 50px -12px rgba(15,23,42,0.35);
        }
        .hero-card::before {
            content: ''; position: absolute; inset: -50%;
            background: conic-gradient(from 180deg, transparent 0%, rgba(59,130,246,0.25) 25%, transparent 50%);
            animation: rotateGlow 8s linear infinite;
        }
        .hero-card::after {
            content: ''; position: absolute; inset: 1px; border-radius: 23px;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            z-index: 1;
        }
        .hero-inner { position: relative; z-index: 2; }
        @keyframes rotateGlow { to { transform: rotate(360deg); } }

        /* Floating particles */
        .particle {
            position: absolute; border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0) 70%);
            animation: floatUp linear infinite;
            opacity: 0.25;
        }
        @keyframes floatUp {
            0% { transform: translateY(100%) scale(0.5); opacity: 0; }
            20% { opacity: 0.35; }
            80% { opacity: 0.25; }
            100% { transform: translateY(-120%) scale(1); opacity: 0; }
        }

        /* Reveal animation */
        .reveal {
            opacity: 0; transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s cubic-bezier(0.16,1,0.3,1);
        }
        .reveal.show { opacity: 1; transform: translateY(0); }

        /* Bottom nav */
        .bottom-nav {
            background: rgba(255,255,255,0.82);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.7);
            box-shadow: 0 8px 32px rgba(15,23,42,0.12);
        }
        .nav-item { position: relative; transition: all 0.2s ease; }
        .nav-item.active { background: rgba(59,130,246,0.1); color: #2563eb; }
        .nav-item .nav-dot {
            position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%) scale(0);
            width: 4px; height: 4px; border-radius: 50%; background: #2563eb;
            transition: transform 0.2s ease;
        }
        .nav-item.active .nav-dot { transform: translateX(-50%) scale(1); }

        /* Toast */
        .toast-enter { opacity: 0; transform: translateX(-50%) translateY(12px); }
        .toast-enter-active { opacity: 1; transform: translateX(-50%) translateY(0); transition: all 0.3s ease; }
        .toast-exit { opacity: 0; transform: translateX(-50%) translateY(12px); transition: all 0.3s ease; }
    </style>
<script src="/assets/js/anti-devtools.js"></script>
</head>
<body class="min-h-screen flex flex-col">

    <div class="mesh-bg"></div>

    <!-- Header -->
    <header class="glass-header fixed top-0 left-0 right-0 z-40 h-14">
        <div class="flex items-center justify-between h-full px-4 max-w-3xl mx-auto w-full">
            <h1 class="text-xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-800">
                TOOLTX2026
            </h1>
            <div id="admin-shortcut-container" class="flex items-center gap-2"></div>
        </div>
    </header>

    <!-- Main content -->
    <main class="flex-grow pt-20 px-4 pb-32 max-w-3xl mx-auto w-full">

        <!-- Hero -->
        <section class="hero-card mb-6 reveal" style="transition-delay: 80ms;">
            <div class="hero-inner p-5">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div id="greeting-label" class="text-blue-200 text-xs font-semibold uppercase tracking-wider mb-1">Chào mừng</div>
                        <h2 id="greeting-title" class="text-2xl font-black text-white leading-tight">
                            <span id="greeting-text">Xin chào! 👋</span>
                            <span id="greeting-vip"></span>
                        </h2>
                    </div>
                    <div id="auth-shortcut"></div>
                </div>
                <p id="hero-subtitle" class="text-slate-300 text-sm leading-relaxed mb-5 max-w-xs">
                    Khám phá các công cụ dự đoán, key kích hoạt và ứng dụng Android chính thức.
                </p>
                <div class="flex items-center gap-3">
                    <a href="/packages" class="inline-flex items-center gap-1.5 bg-white text-slate-900 text-xs font-bold px-4 py-2.5 rounded-xl shadow-lg active:scale-95 transition-transform">
                        <i data-lucide="crown" class="w-3.5 h-3.5 text-amber-500"></i> Mua gói VIP
                    </a>
                    <a href="/apk" class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/15 text-white text-xs font-bold px-4 py-2.5 rounded-xl border border-white/15 active:scale-95 transition-all">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i> Tải APK
                    </a>
                </div>

                <!-- Particles -->
                <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
                    <div class="particle" style="width:4px;height:4px;left:12%;animation-duration:7s;animation-delay:0s;"></div>
                    <div class="particle" style="width:6px;height:6px;left:28%;animation-duration:9s;animation-delay:1.5s;"></div>
                    <div class="particle" style="width:3px;height:3px;left:55%;animation-duration:6s;animation-delay:0.5s;"></div>
                    <div class="particle" style="width:5px;height:5px;left:72%;animation-duration:8s;animation-delay:2s;"></div>
                    <div class="particle" style="width:4px;height:4px;left:88%;animation-duration:7.5s;animation-delay:1s;"></div>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Mục 1 -->
            <a href="javascript:void(0)" onclick="handleServiceClick('Dịch Vụ Mục 1')" class="block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow active:scale-[0.98] duration-200 border border-slate-100 relative">
                <div class="relative w-full h-48 sm:h-56">
                    <img src="https://i.ibb.co/PvrXg25V/x.jpg" alt="Logo Mục 1" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 w-full flex justify-between items-end">
                        <div>
                            <h3 class="text-white font-bold text-lg">Dịch Vụ Mục 1</h3>
                            <p class="text-white/80 text-xs mt-1">Khám phá các ưu đãi mới</p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Mục 2 -->
            <a href="javascript:void(0)" onclick="handleServiceClick('Dịch Vụ Mục 2')" class="block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow active:scale-[0.98] duration-200 border border-slate-100 relative">
                <div class="relative w-full h-48 sm:h-56">
                    <img src="https://i.ibb.co/Wd3CWsk/x.jpg" alt="Logo Mục 2" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 w-full flex justify-between items-end">
                        <div>
                            <h3 class="text-white font-bold text-lg">Dịch Vụ Mục 2</h3>
                            <p class="text-white/80 text-xs mt-1">Trải nghiệm tính năng độc quyền</p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Mục 3 — Baccarat -->
            <a href="javascript:void(0)" onclick="handleServiceClick('Dịch Vụ Mục 3')" class="block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow active:scale-[0.98] duration-200 border border-slate-100 relative">
                <div class="relative w-full h-48 sm:h-56">
                    <img src="https://i.ibb.co/rGY7cLXY/x.jpg" alt="Logo Baccarat" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 w-full flex justify-between items-end">
                        <div>
                            <h3 class="text-white font-bold text-lg">Dịch Vụ Mục 3</h3>
                            <p class="text-white/80 text-xs mt-1">Baccarat – Biểu đồ theo bàn trực tiếp</p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </main>

    <!-- Bottom Navigation -->
    <div class="fixed bottom-5 left-0 w-full z-50 px-4 flex justify-center pointer-events-none">
        <nav class="bottom-nav w-full max-w-sm rounded-3xl px-2 py-2 pointer-events-auto flex justify-between items-center">
            <a href="/" class="nav-item active flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-500 hover:text-slate-700">
                <i data-lucide="home" class="w-5 h-5 mb-1"></i>
                <span class="text-[9px] font-semibold">Trang chủ</span>
                <span class="nav-dot"></span>
            </a>
            <a href="/packages" class="nav-item flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-500 hover:text-slate-700">
                <i data-lucide="package" class="w-5 h-5 mb-1"></i>
                <span class="text-[9px] font-medium">Mua gói</span>
                <span class="nav-dot"></span>
            </a>
            <a href="/apk" class="nav-item flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-500 hover:text-slate-700">
                <i data-lucide="smartphone" class="w-5 h-5 mb-1"></i>
                <span class="text-[9px] font-medium">APK & Key</span>
                <span class="nav-dot"></span>
            </a>
            <a href="/deposit" class="nav-item flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-500 hover:text-slate-700">
                <i data-lucide="wallet" class="w-5 h-5 mb-1"></i>
                <span class="text-[9px] font-medium">Nạp tiền</span>
                <span class="nav-dot"></span>
            </a>
            <a href="/account" class="nav-item flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-500 hover:text-slate-700">
                <i data-lucide="user" class="w-5 h-5 mb-1"></i>
                <span class="text-[9px] font-medium">Tài khoản</span>
                <span class="nav-dot"></span>
            </a>
        </nav>
    </div>

    <!-- Alert Modal -->
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

        // Reveal animation on load
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');
            if (window.IntersectionObserver) {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('show');
                            io.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });
                reveals.forEach(el => io.observe(el));
            } else {
                reveals.forEach(el => el.classList.add('show'));
            }
        });

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

        const token = localStorage.getItem('token');

        function timeGreeting() {
            const hour = new Date().getHours();
            if (hour < 12) return 'Chào buổi sáng';
            if (hour < 18) return 'Chào buổi chiều';
            return 'Chào buổi tối';
        }

        async function initPage() {
            if (token) {
                try {
                    const response = await fetch('api/user.php', { headers: { 'Authorization': `Bearer ${token}` } });
                    const result = await response.json();
                    if (result.success) {
                        const now = Math.floor(Date.now() / 1000);
                        const isVip = result.vip_expire && result.vip_expire > now;
                        document.getElementById('greeting-text').textContent = `${timeGreeting()}, ${result.full_name || result.username}!`;
                        if (isVip) {
                            document.getElementById('greeting-vip').innerHTML = `
                                <span class="inline-flex items-center gap-0.5 px-2 py-0.5 bg-amber-500 text-white text-[10px] font-black rounded-full shadow-sm ml-1 uppercase"><i data-lucide="crown" class="w-3 h-3"></i> VIP</span>`;
                        } else {
                            document.getElementById('greeting-vip').innerHTML = '';
                        }
                        document.getElementById('greeting-label').innerText = 'Đã đăng nhập';
                        document.getElementById('hero-subtitle').innerText = 'Sẵn sàng sử dụng các công cụ VIP và tải ứng dụng.';
                        if (result.role === 'admin') {
                            document.getElementById('admin-shortcut-container').innerHTML = `
                                <a href="/admin" class="flex items-center gap-1 bg-red-500/10 hover:bg-red-500/20 text-red-600 text-xs font-bold py-1.5 px-3 rounded-xl transition-colors">
                                    <i data-lucide="shield" class="w-3.5 h-3.5"></i> Admin
                                </a>
                            `;
                        }
                        lucide.createIcons();
                    } else {
                        localStorage.clear();
                        showLoginButton();
                    }
                } catch (e) {
                    console.error(e);
                    showLoginButton();
                }
            } else {
                showLoginButton();
            }
        }

        function showLoginButton() {
            document.getElementById('auth-shortcut').innerHTML = `
                <a href="/login" class="inline-flex items-center gap-1 bg-white/10 hover:bg-white/15 text-white text-xs font-bold py-2 px-3.5 rounded-xl border border-white/20 transition-colors">
                    <i data-lucide="log-in" class="w-3.5 h-3.5"></i> Đăng nhập
                </a>
            `;
            lucide.createIcons();
        }

        async function handleServiceClick(serviceName) {
            if (!token) {
                await alert('Vui lòng đăng nhập để sử dụng dịch vụ.');
                window.location.href = '/login';
                return;
            }

            if (serviceName === 'Dịch Vụ Mục 3') {
                window.location.href = '/game/baccarat';
                return;
            }

            try {
                const res = await fetch('api/user.php', { headers: { 'Authorization': `Bearer ${token}` } });
                const data = await res.json();
                if (!data.success) {
                    await alert('Phiên đăng nhập hết hạn. Vui lòng đăng nhập lại.');
                    localStorage.clear();
                    window.location.href = '/login';
                    return;
                }
                const now = Math.floor(Date.now() / 1000);
                const isVip = (data.vip_expire && data.vip_expire > now) || data.role === 'admin';
                if (!isVip) {
                    await alert('Bạn cần có gói VIP còn hiệu lực để sử dụng dịch vụ này. Vui lòng mua gói tại mục "Mua gói".');
                    return;
                }
                if (serviceName === 'Dịch Vụ Mục 1') {
                    window.location.href = '/game/sunwin';
                } else {
                    await alert(`${serviceName} đang được chuẩn bị và sẽ sớm khả dụng!`);
                }
            } catch (e) {
                await alert('Không thể kết nối máy chủ. Vui lòng thử lại.');
            }
        }

        initPage();
    </script>
</body>
</html>
