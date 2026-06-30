<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Mua Key - TOOLTX2026</title>
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
            <h1 class="text-base font-bold text-slate-800">Mua Key</h1>
            <div class="w-8"></div>
        </div>
    </header>

    <main class="flex-grow p-4 pb-36 max-w-3xl mx-auto w-full">

        <!-- Quick nav -->
        <div class="flex gap-2 p-1 bg-slate-200/70 rounded-2xl mb-4">
            <a href="/apk" class="tab-inactive flex-1 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-1.5">
                <i data-lucide="download" class="w-4 h-4"></i> Tải APK
            </a>
            <div class="tab-active flex-1 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-1.5">
                <i data-lucide="key" class="w-4 h-4"></i> Mua Key
            </div>
            <a href="/free-key" class="tab-inactive flex-1 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-1.5">
                <i data-lucide="gift" class="w-4 h-4"></i> Key Free
            </a>
        </div>

        <!-- Chưa đăng nhập -->
        <div id="logged-out-view" class="hidden flex-col items-center justify-center py-16 text-center">
            <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-5">
                <i data-lucide="key" class="w-10 h-10 text-primary opacity-60"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Chưa đăng nhập</h3>
            <p class="text-slate-500 mb-6 text-sm">Đăng nhập để mua key bằng số dư tài khoản.</p>
            <a href="/login" class="w-full max-w-xs bg-gradient-to-r from-primary to-blue-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-500/30 active:scale-[0.98] transition-transform flex items-center justify-center gap-2">
                <i data-lucide="log-in" class="w-5 h-5"></i> Đăng nhập ngay
            </a>
        </div>

        <!-- Đã đăng nhập -->
        <div id="logged-in-content">

            <!-- Banner + Số dư -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-5 mb-5 relative overflow-hidden shadow-xl">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full -mr-10 -mt-10 blur-xl pointer-events-none"></div>
                <div class="relative z-10 flex items-center gap-4">
                    <div class="w-14 h-14 bg-amber-400/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i data-lucide="key" class="w-7 h-7 text-amber-400"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="text-white font-black text-lg leading-tight">Key kích hoạt</h2>
                        <p class="text-slate-400 text-xs mt-1">Liên kết với thiết bị · Sử dụng không giới hạn</p>
                    </div>
                </div>
                <div class="relative z-10 mt-4 pt-4 border-t border-white/10 flex items-center justify-between">
                    <span class="text-slate-400 text-xs">Số dư khả dụng</span>
                    <span id="user-balance" class="text-white font-black text-base">Đang tải...</span>
                </div>
            </div>

            <!-- Các gói key -->
            <h3 class="font-bold text-slate-700 mb-3 text-sm px-1">Chọn gói key</h3>
            <div class="space-y-3 mb-5">
                <!-- 1 ngày -->
                <div onclick="selectPkg(this,'1_day','Key 1 Ngày',5000)" class="key-pkg bg-white rounded-2xl p-4 border-2 border-transparent shadow-sm active:scale-[0.98] transition-all cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="clock" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">Key 1 Ngày</p>
                                <p class="text-xs text-slate-500">Hết hạn sau 24 giờ</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-black text-primary text-base">5,000đ</p>
                            <div class="w-5 h-5 rounded-full border-2 border-slate-200 ml-auto mt-1 check-circle flex items-center justify-center"></div>
                        </div>
                    </div>
                </div>
                <!-- 7 ngày -->
                <div onclick="selectPkg(this,'7_day','Key 7 Ngày',25000)" class="key-pkg bg-white rounded-2xl p-4 border-2 border-transparent shadow-sm active:scale-[0.98] transition-all cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="calendar-days" class="w-5 h-5 text-amber-500"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <p class="font-bold text-slate-800">Key 7 Ngày</p>
                                    <span class="bg-amber-400 text-white text-[9px] font-black px-1.5 py-0.5 rounded-full uppercase">Phổ biến</span>
                                </div>
                                <p class="text-xs text-slate-500">Hết hạn sau 7 ngày</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-black text-primary text-base">25,000đ</p>
                            <div class="w-5 h-5 rounded-full border-2 border-slate-200 ml-auto mt-1 check-circle flex items-center justify-center"></div>
                        </div>
                    </div>
                </div>
                <!-- 30 ngày -->
                <div onclick="selectPkg(this,'30_day','Key 30 Ngày',80000)" class="key-pkg bg-white rounded-2xl p-4 border-2 border-transparent shadow-sm active:scale-[0.98] transition-all cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="calendar-check" class="w-5 h-5 text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">Key 30 Ngày</p>
                                <p class="text-xs text-slate-500">Hết hạn sau 30 ngày</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-black text-primary text-base">80,000đ</p>
                            <div class="w-5 h-5 rounded-full border-2 border-slate-200 ml-auto mt-1 check-circle flex items-center justify-center"></div>
                        </div>
                    </div>
                </div>
                <!-- Vĩnh viễn -->
                <div onclick="selectPkg(this,'lifetime','Key Vĩnh Viễn',150000)" class="key-pkg bg-white rounded-2xl p-4 border-2 border-transparent shadow-sm active:scale-[0.98] transition-all cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-50 to-transparent pointer-events-none"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="infinity" class="w-5 h-5 text-purple-600"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <p class="font-bold text-slate-800">Key Vĩnh Viễn</p>
                                    <span class="bg-purple-500 text-white text-[9px] font-black px-1.5 py-0.5 rounded-full uppercase">Tốt nhất</span>
                                </div>
                                <p class="text-xs text-slate-500">Không giới hạn thời gian</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-black text-primary text-base">150,000đ</p>
                            <div class="w-5 h-5 rounded-full border-2 border-slate-200 ml-auto mt-1 check-circle flex items-center justify-center"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary -->
            <div id="summary" class="hidden bg-blue-50 border border-blue-100 rounded-2xl p-3 mb-4 flex items-center justify-between">
                <div>
                    <p class="text-xs text-blue-600 font-medium">Gói đã chọn</p>
                    <p id="sum-name" class="font-bold text-slate-800 text-sm"></p>
                </div>
                <p id="sum-price" class="font-black text-primary text-base"></p>
            </div>

            <button onclick="handleBuy()" class="w-full bg-gradient-to-r from-primary to-blue-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-500/30 active:scale-[0.98] transition-transform flex items-center justify-center gap-2 text-base">
                <i data-lucide="shopping-cart" class="w-5 h-5"></i> Mua Key bằng số dư
            </button>
            <p class="text-center text-xs text-slate-400 mt-2">Số dư sẽ bị trừ ngay khi xác nhận mua</p>

        </div>
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

    <!-- Confirm Modal -->
    <div id="confirm-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeConfirmModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div class="w-full max-w-sm bg-white rounded-3xl p-6 pointer-events-auto shadow-2xl">
                <div class="text-center mb-6">
                    <div class="w-12 h-12 rounded-full bg-blue-50 text-primary flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="help-circle" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Xác nhận mua key</h3>
                    <p id="confirm-modal-message" class="text-sm text-slate-500 px-2"></p>
                </div>
                <div class="flex gap-2">
                    <button id="confirm-yes-btn" class="flex-1 py-3 bg-primary text-white font-bold rounded-2xl shadow-lg active:scale-95 transition-all">Đồng ý</button>
                    <button onclick="closeConfirmModal()" class="py-3 px-5 bg-slate-100 text-slate-600 font-semibold rounded-2xl transition-colors">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Modal -->
    <div id="alert-modal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeAlertModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div class="w-full max-w-sm bg-white rounded-3xl p-6 pointer-events-auto shadow-2xl">
                <div class="text-center mb-6">
                    <div id="alert-icon" class="w-12 h-12 rounded-full bg-blue-50 text-primary flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="info" class="w-6 h-6"></i>
                    </div>
                    <h3 id="alert-title" class="text-lg font-bold text-slate-800 mb-2">Thông báo</h3>
                    <p id="alert-message" class="text-sm text-slate-500 px-2"></p>
                    <!-- Key result -->
                    <div id="key-result" class="hidden mt-4 bg-slate-50 border border-slate-200 rounded-2xl p-3">
                        <p class="text-xs text-slate-500 mb-1">Key của bạn</p>
                        <p id="key-value" class="font-black text-slate-800 text-base tracking-wider break-all"></p>
                        <p id="key-expiry" class="text-xs text-slate-500 mt-1"></p>
                        <button onclick="copyKey()" class="mt-2 text-xs text-primary font-bold flex items-center gap-1 mx-auto">
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i> Sao chép key
                        </button>
                    </div>
                </div>
                <button onclick="closeAlertModal()" class="w-full py-3 bg-primary text-white font-bold rounded-2xl shadow-lg active:scale-95 transition-all">Đóng</button>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-24 left-1/2 -translate-x-1/2 z-[100] bg-slate-800 text-white text-xs font-semibold px-4 py-2 rounded-full shadow-lg opacity-0 pointer-events-none transition-opacity duration-200"></div>

    <script>
        lucide.createIcons();
        const token = localStorage.getItem('token');
        let selectedPkg = null;
        let currentKey = '';

        if (!token) {
            document.getElementById('logged-in-content').classList.add('hidden');
            const lo = document.getElementById('logged-out-view');
            lo.classList.remove('hidden');
            lo.classList.add('flex');
        }

        function formatMoney(n) {
            return Number(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        function showToast(msg) {
            const t = document.getElementById('toast');
            t.innerText = msg; t.style.opacity = '1';
            setTimeout(() => { t.style.opacity = '0'; }, 2000);
        }

        // Confirm modal
        let confirmResolve = null;
        function showConfirmModal(msg) {
            document.getElementById('confirm-modal-message').innerText = msg;
            document.getElementById('confirm-modal').classList.remove('hidden');
            lucide.createIcons();
            return new Promise(r => { confirmResolve = r; });
        }
        function closeConfirmModal() {
            document.getElementById('confirm-modal').classList.add('hidden');
            if (confirmResolve) { confirmResolve(false); confirmResolve = null; }
        }
        document.getElementById('confirm-yes-btn').addEventListener('click', () => {
            document.getElementById('confirm-modal').classList.add('hidden');
            if (confirmResolve) { confirmResolve(true); confirmResolve = null; }
        });

        // Alert modal
        let alertResolve = null;
        function showAlertModal(msg, type = 'info', keyData = null) {
            document.getElementById('alert-message').innerText = msg;
            const icon = document.getElementById('alert-icon');
            const title = document.getElementById('alert-title');
            if (type === 'success') {
                icon.className = 'w-12 h-12 rounded-full bg-green-50 text-green-500 flex items-center justify-center mx-auto mb-4';
                icon.innerHTML = '<i data-lucide="check-circle" class="w-6 h-6"></i>';
                title.innerText = 'Thành công';
            } else if (type === 'error') {
                icon.className = 'w-12 h-12 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-4';
                icon.innerHTML = '<i data-lucide="x-circle" class="w-6 h-6"></i>';
                title.innerText = 'Lỗi';
            } else {
                icon.className = 'w-12 h-12 rounded-full bg-blue-50 text-primary flex items-center justify-center mx-auto mb-4';
                icon.innerHTML = '<i data-lucide="info" class="w-6 h-6"></i>';
                title.innerText = 'Thông báo';
            }
            const keyResult = document.getElementById('key-result');
            if (keyData) {
                currentKey = keyData.key;
                document.getElementById('key-value').innerText = keyData.key;
                document.getElementById('key-expiry').innerText = 'Hạn: ' + keyData.expiry;
                keyResult.classList.remove('hidden');
            } else {
                keyResult.classList.add('hidden');
            }
            document.getElementById('alert-modal').classList.remove('hidden');
            lucide.createIcons();
            return new Promise(r => { alertResolve = r; });
        }
        function closeAlertModal() {
            document.getElementById('alert-modal').classList.add('hidden');
            if (alertResolve) { alertResolve(); alertResolve = null; }
        }

        function copyKey() {
            if (!currentKey) return;
            navigator.clipboard.writeText(currentKey).then(() => showToast('Đã sao chép key!'));
        }

        async function fetchUserInfo() {
            try {
                const res = await fetch('api/user.php', { headers: { 'Authorization': `Bearer ${token}` } });
                const data = await res.json();
                if (data.success) {
                    document.getElementById('user-balance').innerText = formatMoney(data.balance) + ' VNĐ';
                } else {
                    localStorage.clear();
                    window.location.href = '/login';
                }
            } catch (e) {
                document.getElementById('user-balance').innerText = 'Lỗi kết nối';
            }
        }

        function selectPkg(el, pkg, name, price) {
            document.querySelectorAll('.key-pkg').forEach(c => {
                c.classList.remove('border-primary', 'bg-blue-50/30');
                const cc = c.querySelector('.check-circle');
                cc.innerHTML = ''; cc.classList.remove('bg-primary', 'border-primary');
            });
            el.classList.add('border-primary', 'bg-blue-50/30');
            const circle = el.querySelector('.check-circle');
            circle.classList.add('bg-primary', 'border-primary');
            circle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
            selectedPkg = { pkg, name, price };
            document.getElementById('sum-name').innerText = name;
            document.getElementById('sum-price').innerText = formatMoney(price) + 'đ';
            const s = document.getElementById('summary');
            s.classList.remove('hidden'); s.classList.add('flex');
        }

        async function handleBuy() {
            if (!selectedPkg) { showToast('Vui lòng chọn gói key'); return; }
            if (!token) { window.location.href = '/login'; return; }

            const ok = await showConfirmModal(`Mua ${selectedPkg.name} với giá ${formatMoney(selectedPkg.price)} VNĐ?\nSố dư sẽ bị trừ ngay lập tức.`);
            if (!ok) return;

            try {
                const res = await fetch('api/buy_key.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Authorization': `Bearer ${token}` },
                    body: JSON.stringify({ pkg_type: selectedPkg.pkg })
                });
                const data = await res.json();
                if (data.success) {
                    document.getElementById('user-balance').innerText = formatMoney(data.new_balance) + ' VNĐ';
                    await showAlertModal(data.message, 'success', { key: data.key, expiry: data.expiry });
                } else {
                    await showAlertModal(data.message || 'Có lỗi xảy ra.', 'error');
                }
            } catch (e) {
                await showAlertModal('Không thể kết nối đến máy chủ.', 'error');
            }
        }

        if (token) fetchUserInfo();
    </script>
</body>
</html>
