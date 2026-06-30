<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Key Free - TOOLTX2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#3b82f6' } } } }</script>
    <style>
        body { -webkit-user-select: none; user-select: none; -webkit-tap-highlight-color: transparent; }
        ::-webkit-scrollbar { display: none; }
        .tab-active { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; box-shadow: 0 4px 15px rgba(59,130,246,0.4); }
        .tab-inactive { background: #f1f5f9; color: #64748b; }
    </style>
<script src="/assets/js/anti-devtools.js"></script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans min-h-screen flex flex-col">

    <header class="bg-white shadow-sm sticky top-0 z-40 border-b border-slate-100">
        <div class="flex items-center justify-between h-14 px-4 max-w-3xl mx-auto w-full">
            <a href="/apk" class="w-8 h-8 flex items-center justify-center text-slate-500 active:bg-slate-100 rounded-full transition-colors">
                <i data-lucide="chevron-left" class="w-6 h-6"></i>
            </a>
            <h1 class="text-base font-bold text-slate-800">Key Free</h1>
            <div class="w-8"></div>
        </div>
    </header>

    <main class="flex-grow p-4 pb-36 max-w-3xl mx-auto w-full">

        <!-- Quick nav -->
        <div class="flex gap-2 p-1 bg-slate-200/70 rounded-2xl mb-4">
            <a href="/apk" class="tab-inactive flex-1 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-1.5">
                <i data-lucide="download" class="w-4 h-4"></i> Tải APK
            </a>
            <a href="/buy-key" class="tab-inactive flex-1 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-1.5">
                <i data-lucide="key" class="w-4 h-4"></i> Mua Key
            </a>
            <div class="tab-active flex-1 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-1.5">
                <i data-lucide="gift" class="w-4 h-4"></i> Key Free
            </div>
        </div>

        <!-- Banner -->
        <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl p-5 mb-4 relative overflow-hidden shadow-lg shadow-emerald-500/20">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-10 -mt-10 blur-xl pointer-events-none"></div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center flex-shrink-0 backdrop-blur-sm">
                    <i data-lucide="gift" class="w-7 h-7 text-white"></i>
                </div>
                <div>
                    <h2 class="text-white font-black text-lg">Key miễn phí</h2>
                    <p class="text-emerald-100 text-xs mt-1">Vượt link · Nhận key dùng thử 12 tiếng</p>
                </div>
            </div>
        </div>

        <!-- Các bước -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-4">
            <h3 class="font-bold text-slate-700 mb-3 text-sm flex items-center gap-2">
                <i data-lucide="list-ordered" class="w-4 h-4 text-primary"></i> Cách nhận key miễn phí
            </h3>
            <div class="space-y-2.5">
                <div class="flex items-center gap-3 p-2.5 bg-slate-50 rounded-xl">
                    <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 text-[11px] font-black text-primary">1</div>
                    <p class="text-sm text-slate-600">Nhấn <span class="font-semibold text-slate-800">"Tạo Link Nhận Key"</span> bên dưới</p>
                </div>
                <div class="flex items-center gap-3 p-2.5 bg-slate-50 rounded-xl">
                    <div class="w-7 h-7 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0 text-[11px] font-black text-emerald-600">2</div>
                    <p class="text-sm text-slate-600">Mở link, <span class="font-semibold text-slate-800">vượt quảng cáo</span> để tiếp tục</p>
                </div>
                <div class="flex items-center gap-3 p-2.5 bg-slate-50 rounded-xl">
                    <div class="w-7 h-7 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 text-[11px] font-black text-amber-600">3</div>
                    <p class="text-sm text-slate-600">Key sẽ <span class="font-semibold text-slate-800">tự hiện</span> sau khi vượt link thành công</p>
                </div>
                <div class="flex items-center gap-3 p-2.5 bg-amber-50 rounded-xl border border-amber-100">
                    <div class="w-7 h-7 bg-amber-200 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-700"></i>
                    </div>
                    <p class="text-sm text-amber-700">Link hết hạn sau <span class="font-bold">1 giờ</span></p>
                </div>
            </div>
        </div>

        <!-- Trạng thái -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-4">

            <!-- Loading -->
            <div id="fk-loading" class="py-6 flex flex-col items-center">
                <div class="w-8 h-8 border-primary border-t-transparent rounded-full animate-spin mb-3" style="border-width:3px;border-style:solid;"></div>
                <p class="text-sm text-slate-400">Đang kiểm tra...</p>
            </div>

            <!-- Chưa đăng nhập -->
            <div id="fk-logout" class="hidden flex-col items-center py-6 text-center">
                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-3">
                    <i data-lucide="lock" class="w-7 h-7 text-primary opacity-60"></i>
                </div>
                <p class="text-slate-600 text-sm mb-4">Bạn cần đăng nhập để nhận key miễn phí</p>
                <a href="/login" class="bg-primary text-white font-bold px-6 py-2.5 rounded-xl text-sm shadow-md active:scale-95 transition-transform">Đăng nhập ngay</a>
            </div>

            <!-- Sẵn sàng -->
            <div id="fk-ready" class="hidden">
                <p class="text-xs text-slate-500 mb-4 text-center">Xin chào <span id="fk-username" class="font-semibold text-slate-700"></span>! Nhấn nút dưới để tạo link nhận key.</p>
                <button onclick="generateFreeKeyLink()" id="fk-gen-btn" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-black py-4 rounded-xl shadow-md shadow-emerald-500/20 active:scale-[0.98] transition-transform flex items-center justify-center gap-2 text-base">
                    <i data-lucide="link" class="w-5 h-5"></i> Tạo Link Nhận Key
                </button>
            </div>

            <!-- Đã có link -->
            <div id="fk-link-ready" class="hidden">
                <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4 mb-4">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-7 h-7 bg-emerald-200 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-lucide="check" class="w-4 h-4 text-emerald-700"></i>
                        </div>
                        <p class="text-emerald-700 font-bold text-sm">Link đã được tạo!</p>
                    </div>
                    <p class="text-emerald-600 text-xs leading-relaxed">Nhấn nút bên dưới để mở link, vượt qua quảng cáo. Sau đó key sẽ hiển thị tự động.</p>
                </div>
                <a id="fk-link-btn" href="#" target="_blank" class="w-full bg-gradient-to-r from-primary to-blue-700 text-white font-black py-4 rounded-xl shadow-lg shadow-blue-500/30 active:scale-[0.98] transition-transform flex items-center justify-center gap-2 text-base mb-3">
                    <i data-lucide="external-link" class="w-5 h-5"></i> Mở Link & Nhận Key
                </a>
                <div class="bg-amber-50 border border-amber-100 rounded-xl p-3 flex items-start gap-2">
                    <i data-lucide="info" class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5"></i>
                    <p class="text-xs text-amber-700 leading-relaxed">Sau khi vượt link thành công, bạn sẽ được chuyển đến trang nhận key tự động. Link hết hạn sau <strong>1 giờ</strong>.</p>
                </div>
            </div>

        </div>

        <!-- Hỗ trợ -->
        <a href="/support" class="flex items-center justify-between bg-white rounded-2xl p-4 shadow-sm border border-slate-100 active:bg-slate-50 transition-colors">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-purple-50 rounded-full flex items-center justify-center text-purple-500">
                    <i data-lucide="headphones" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="font-semibold text-slate-700 text-sm">Cần hỗ trợ?</p>
                    <p class="text-xs text-slate-400">Liên hệ đội ngũ hỗ trợ</p>
                </div>
            </div>
            <i data-lucide="chevron-right" class="w-5 h-5 text-slate-300"></i>
        </a>

    </main>

    <!-- Bottom Nav -->
    <div class="fixed bottom-6 left-0 w-full z-30 px-4 flex justify-center pointer-events-none">
        <nav class="w-full max-w-sm bg-white/90 backdrop-blur-lg border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.08)] rounded-3xl px-1 py-2 pointer-events-auto flex justify-between items-center">
            <a href="/" class="flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-400 transition-all">
                <i data-lucide="home" class="w-5 h-5 mb-1"></i>
                <span class="text-[9px] font-medium">Trang chủ</span>
            </a>
            <a href="/packages" class="flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-400 transition-all">
                <i data-lucide="package" class="w-5 h-5 mb-1"></i>
                <span class="text-[9px] font-medium">Mua gói</span>
            </a>
            <a href="/apk" class="flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-primary bg-blue-50/80 transition-all">
                <i data-lucide="smartphone" class="w-5 h-5 mb-1"></i>
                <span class="text-[9px] font-semibold">APK & Key</span>
            </a>
            <a href="/deposit" class="flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-400 transition-all">
                <i data-lucide="wallet" class="w-5 h-5 mb-1"></i>
                <span class="text-[9px] font-medium">Nạp tiền</span>
            </a>
            <a href="/account" class="flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-400 transition-all">
                <i data-lucide="user" class="w-5 h-5 mb-1"></i>
                <span class="text-[9px] font-medium">Tài khoản</span>
            </a>
        </nav>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-24 left-1/2 -translate-x-1/2 z-[100] bg-slate-800 text-white text-xs font-semibold px-4 py-2 rounded-full shadow-lg opacity-0 pointer-events-none transition-opacity duration-200"></div>

    <script>
        lucide.createIcons();
        const token = localStorage.getItem('token');

        function showToast(msg) {
            const t = document.getElementById('toast');
            t.innerText = msg; t.style.opacity = '1';
            setTimeout(() => { t.style.opacity = '0'; }, 2000);
        }

        function fkShow(state) {
            ['loading','logout','ready','link-ready'].forEach(s => {
                const el = document.getElementById('fk-' + s);
                el.classList.add('hidden');
                el.classList.remove('flex', 'block');
            });
            const el = document.getElementById('fk-' + state);
            el.classList.remove('hidden');
            if (state === 'logout') el.classList.add('flex');
            lucide.createIcons();
        }

        async function initFreeKey() {
            fkShow('loading');
            if (!token) { fkShow('logout'); return; }
            try {
                const res  = await fetch('/api/user.php', { headers: { 'Authorization': `Bearer ${token}` } });
                const data = await res.json();
                if (!data.success) { localStorage.clear(); fkShow('logout'); return; }
                document.getElementById('fk-username').innerText = data.username;
                fkShow('ready');
            } catch(e) {
                fkShow('ready');
            }
        }

        async function generateFreeKeyLink() {
            const btn = document.getElementById('fk-gen-btn');
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg> Đang tạo link...';
            try {
                const res  = await fetch('/api/get_free_key_link', {
                    method: 'POST',
                    headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' }
                });
                const data = await res.json();
                if (data.success) {
                    document.getElementById('fk-link-btn').href = data.link;
                    fkShow('link-ready');
                } else {
                    showToast(data.message || 'Có lỗi xảy ra');
                    btn.disabled = false;
                    btn.innerHTML = '<i data-lucide="link" class="w-5 h-5"></i> Tạo Link Nhận Key';
                    lucide.createIcons();
                }
            } catch(e) {
                showToast('Lỗi kết nối, vui lòng thử lại');
                btn.disabled = false;
                btn.innerHTML = '<i data-lucide="link" class="w-5 h-5"></i> Tạo Link Nhận Key';
                lucide.createIcons();
            }
        }

        initFreeKey();
    </script>
</body>
</html>
