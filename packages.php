<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Mua Gói VIP - TOOLTX2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#3b82f6' } } } }</script>
    <style>
        body { -webkit-user-select: none; user-select: none; -webkit-tap-highlight-color: transparent; }
        ::-webkit-scrollbar { display: none; }
    </style>
<script src="/assets/js/anti-devtools.js"></script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans min-h-screen flex flex-col">

    <header class="bg-white shadow-sm sticky top-0 z-40 border-b border-slate-100">
        <div class="flex items-center justify-between h-14 px-4">
            <a href="/" class="w-8 h-8 flex items-center justify-center text-slate-500 active:bg-slate-100 rounded-full transition-colors">
                <i data-lucide="chevron-left" class="w-6 h-6"></i>
            </a>
            <h1 class="text-xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-800 absolute left-1/2 -translate-x-1/2">
                TOOLTX2026
            </h1>
            <div class="w-8"></div>
        </div>
    </header>

    <main class="flex-grow p-4 pb-32 max-w-3xl mx-auto w-full">
        <!-- Logged out view -->
        <div id="logged-out-view" class="hidden flex-col items-center justify-center py-16 text-center">
            <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-6 relative">
                <i data-lucide="package" class="w-12 h-12 text-primary opacity-60"></i>
                <div class="absolute inset-0 border-4 border-white rounded-full"></div>
                <div class="absolute inset-0 border-4 border-blue-100 rounded-full scale-110 opacity-50"></div>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Chưa đăng nhập</h3>
            <p class="text-slate-500 mb-8 max-w-xs text-sm">Đăng nhập ngay để mua gói VIP dịch vụ.</p>
            <a href="/login" class="w-full max-w-xs bg-gradient-to-r from-primary to-blue-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-500/30 active:scale-[0.98] transition-transform flex items-center justify-center gap-2">
                <i data-lucide="log-in" class="w-5 h-5"></i> Đăng nhập ngay
            </a>
            <div class="mt-6 flex items-center justify-center gap-2 text-sm">
                <span class="text-slate-400">Chưa có tài khoản?</span>
                <a href="/register" class="font-bold text-primary hover:underline">Đăng ký</a>
            </div>
        </div>

        <!-- Main content -->
        <div id="logged-in-content">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-800 mb-1">Mua gói VIP dịch vụ</h2>
            <p class="text-sm text-slate-500">Số dư khả dụng: <span id="user-balance" class="font-bold text-primary">Đang tải...</span></p>
        </div>

        <!-- Danh sách gói -->
        <div class="space-y-4" id="packages-list">
            <!-- Gói 1 -->
            <div class="bg-white rounded-3xl p-5 shadow-sm border border-slate-100 flex flex-col justify-between relative overflow-hidden transition-all duration-200 hover:shadow-md">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50 rounded-full -mr-10 -mt-10 opacity-60"></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <span class="text-[10px] font-bold tracking-wider text-primary bg-blue-50 px-2.5 py-1 rounded-full uppercase">VIP Cơ bản</span>
                        <h3 class="text-xl font-black text-slate-800 mt-2">Gói VIP 1 Ngày</h3>
                        <p class="text-xs text-slate-500 mt-1">Dành cho trải nghiệm ngắn hạn</p>
                    </div>
                    <div class="text-right">
                        <span class="text-xl font-black text-slate-800">10,000</span>
                        <span class="text-xs font-semibold text-slate-500">đ</span>
                    </div>
                </div>
                <div class="mt-6 flex justify-between items-center gap-3">
                    <div class="flex items-center gap-1 text-[11px] font-semibold text-slate-600">
                        <i data-lucide="zap" class="w-3.5 h-3.5 text-yellow-500"></i> Kích hoạt ngay lập tức
                    </div>
                    <button onclick="buyPackage('VIP 1 ngày', 10000, this)" class="bg-primary text-white text-xs font-bold py-2.5 px-5 rounded-xl shadow-md hover:bg-blue-600 active:scale-95 transition-all flex items-center gap-1">
                        Mua gói
                    </button>
                </div>
            </div>

            <!-- Gói 2 -->
            <div class="bg-white rounded-3xl p-5 shadow-sm border border-primary/20 flex flex-col justify-between relative overflow-hidden transition-all duration-200 hover:shadow-md ring-2 ring-primary/5">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-primary/10 to-transparent rounded-full -mr-10 -mt-10 opacity-70"></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <span class="text-[10px] font-bold tracking-wider text-yellow-600 bg-yellow-50 px-2.5 py-1 rounded-full uppercase">Được mua nhiều nhất 🔥</span>
                        <h3 class="text-xl font-black text-slate-800 mt-2">Gói VIP 7 Ngày</h3>
                        <p class="text-xs text-slate-500 mt-1">Tiết kiệm 30% chi phí</p>
                    </div>
                    <div class="text-right">
                        <span class="text-xl font-black text-slate-800">50,000</span>
                        <span class="text-xs font-semibold text-slate-500">đ</span>
                    </div>
                </div>
                <div class="mt-6 flex justify-between items-center gap-3">
                    <div class="flex items-center gap-1 text-[11px] font-semibold text-slate-600">
                        <i data-lucide="check-circle" class="w-3.5 h-3.5 text-green-500"></i> Hỗ trợ 24/7 ưu tiên
                    </div>
                    <button onclick="buyPackage('VIP 7 ngày', 50000, this)" class="bg-gradient-to-r from-primary to-blue-600 text-white text-xs font-bold py-2.5 px-5 rounded-xl shadow-lg active:scale-95 transition-all flex items-center gap-1">
                        Mua gói
                    </button>
                </div>
            </div>

            <!-- Gói 3 -->
            <div class="bg-slate-900 rounded-3xl p-5 shadow-sm flex flex-col justify-between relative overflow-hidden transition-all duration-200 hover:shadow-md">
                <div class="absolute top-0 right-0 w-28 h-28 bg-gradient-to-tr from-blue-500/20 to-transparent rounded-full -mr-8 -mt-8 blur-lg"></div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <span class="text-[10px] font-bold tracking-wider text-white bg-blue-500/30 px-2.5 py-1 rounded-full uppercase">Siêu Tiết Kiệm</span>
                        <h3 class="text-xl font-black text-white mt-2">Gói VIP 1 Tháng</h3>
                        <p class="text-xs text-slate-400 mt-1">Tiết kiệm 50% chi phí</p>
                    </div>
                    <div class="text-right text-white">
                        <span class="text-xl font-black text-white">150,000</span>
                        <span class="text-xs font-semibold text-slate-400">đ</span>
                    </div>
                </div>
                <div class="mt-6 flex justify-between items-center gap-3">
                    <div class="flex items-center gap-1 text-[11px] font-semibold text-slate-300">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5 text-yellow-400"></i> Mở khóa toàn bộ tính năng
                    </div>
                    <button onclick="buyPackage('VIP 1 tháng', 150000, this)" class="bg-white text-slate-950 text-xs font-bold py-2.5 px-5 rounded-xl shadow-md hover:bg-slate-100 active:scale-95 transition-all flex items-center gap-1">
                        Mua gói
                    </button>
                </div>
            </div>
        </div>
        </div>
    </main>

    <!-- Custom Confirm Modal -->
    <div id="confirm-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeConfirmModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div class="w-full max-w-sm bg-white rounded-3xl p-6 pointer-events-auto shadow-2xl relative">
                <div class="text-center mb-6">
                    <div class="w-12 h-12 rounded-full bg-blue-50 text-primary flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="help-circle" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Xác nhận thao tác</h3>
                    <p id="confirm-modal-message" class="text-sm text-slate-500 px-2">Bạn chắc chắn muốn thực hiện thao tác này?</p>
                </div>
                <div class="flex gap-2">
                    <button id="confirm-modal-yes-btn" class="flex-1 py-3 bg-primary hover:bg-blue-600 active:scale-95 text-white font-bold rounded-2xl shadow-lg transition-all">
                        Đồng ý
                    </button>
                    <button onclick="closeConfirmModal()" class="py-3 px-5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold rounded-2xl transition-colors">
                        Hủy
                    </button>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Thanh Điều Hướng Dưới Cùng -->
    <div class="fixed bottom-6 left-0 w-full z-30 px-4 flex justify-center pointer-events-none">
        <nav class="w-full max-w-sm bg-white/90 backdrop-blur-lg border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.08)] rounded-3xl px-1 py-2 pointer-events-auto flex justify-between items-center relative transition-all">
            <a href="/" class="flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-400 hover:text-slate-600 transition-all duration-300">
                <i data-lucide="home" class="w-5 h-5 mb-1 active:scale-75 transition-transform"></i>
                <span class="text-[9px] font-medium">Trang chủ</span>
            </a>
            <a href="/packages" class="flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-primary bg-blue-50/80 transition-all duration-300">
                <i data-lucide="package" class="w-5 h-5 mb-1 active:scale-75 transition-transform"></i>
                <span class="text-[9px] font-semibold">Mua gói</span>
            </a>
            <a href="/apk" class="flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-400 hover:text-slate-600 transition-all duration-300">
                <i data-lucide="smartphone" class="w-5 h-5 mb-1 active:scale-75 transition-transform"></i>
                <span class="text-[9px] font-medium">APK & Key</span>
            </a>
            <a href="/deposit" class="flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-400 hover:text-slate-600 transition-all duration-300">
                <i data-lucide="wallet" class="w-5 h-5 mb-1 active:scale-75 transition-transform"></i>
                <span class="text-[9px] font-medium">Nạp tiền</span>
            </a>
            <a href="/account" class="flex-1 flex flex-col items-center justify-center py-2 rounded-2xl text-slate-400 hover:text-slate-600 transition-all duration-300">
                <i data-lucide="user" class="w-5 h-5 mb-1 active:scale-75 transition-transform"></i>
                <span class="text-[10px] font-medium">Tài khoản</span>
            </a>
        </nav>
    </div>

    <script>
        lucide.createIcons();
        
        let confirmPromiseResolver = null;
        function showConfirmModal(message) {
            document.getElementById('confirm-modal-message').innerText = message;
            document.getElementById('confirm-modal').classList.remove('hidden');
            lucide.createIcons();
            return new Promise((resolve) => {
                confirmPromiseResolver = resolve;
            });
        }
        function closeConfirmModal() {
            document.getElementById('confirm-modal').classList.add('hidden');
            if (confirmPromiseResolver) {
                confirmPromiseResolver(false);
                confirmPromiseResolver = null;
            }
        }
        document.getElementById('confirm-modal-yes-btn').addEventListener('click', () => {
            document.getElementById('confirm-modal').classList.add('hidden');
            if (confirmPromiseResolver) {
                confirmPromiseResolver(true);
                confirmPromiseResolver = null;
            }
        });

        // Custom Alert
        let alertPromiseResolver = null;
        function showAlertModal(message, type = 'info') {
            document.getElementById('alert-modal-message').innerText = message;
            
            const iconDiv = document.getElementById('alert-modal-icon');
            if (type === 'success') {
                iconDiv.className = "w-12 h-12 rounded-full bg-green-50 text-green-500 flex items-center justify-center mx-auto mb-4";
                iconDiv.innerHTML = '<i data-lucide="check-circle" class="w-6 h-6"></i>';
                document.getElementById('alert-modal-title').innerText = 'Thành công';
            } else if (type === 'error') {
                iconDiv.className = "w-12 h-12 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-4";
                iconDiv.innerHTML = '<i data-lucide="x-circle" class="w-6 h-6"></i>';
                document.getElementById('alert-modal-title').innerText = 'Lỗi';
            } else {
                iconDiv.className = "w-12 h-12 rounded-full bg-blue-50 text-primary flex items-center justify-center mx-auto mb-4";
                iconDiv.innerHTML = '<i data-lucide="info" class="w-6 h-6"></i>';
                document.getElementById('alert-modal-title').innerText = 'Thông báo';
            }
            
            document.getElementById('alert-modal').classList.remove('hidden');
            lucide.createIcons();
            
            return new Promise((resolve) => {
                alertPromiseResolver = resolve;
            });
        }
        function closeAlertModal() {
            document.getElementById('alert-modal').classList.add('hidden');
            if (alertPromiseResolver) {
                alertPromiseResolver();
                alertPromiseResolver = null;
            }
        }

        const token = localStorage.getItem('token');
        if (!token) {
            document.getElementById('logged-in-content').classList.add('hidden');
            document.getElementById('logged-out-view').classList.remove('hidden');
            document.getElementById('logged-out-view').classList.add('flex');
        }

        // Lấy thông tin user để hiển thị số dư
        async function fetchUserInfo() {
            try {
                const response = await fetch('api/user.php', { headers: { 'Authorization': `Bearer ${token}` } });
                const result = await response.json();
                if (result.success) {
                    document.getElementById('user-balance').innerText = formatMoney(result.balance) + ' VNĐ';
                } else {
                    localStorage.clear();
                    window.location.href = '/login';
                }
            } catch (error) {
                console.error(error);
                document.getElementById('user-balance').innerText = 'Lỗi kết nối';
            }
        }

        function formatMoney(n) {
            return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        async function buyPackage(packageName, price, btn) {
            const confirmPurchase = await showConfirmModal(`Bạn có chắc chắn muốn mua gói ${packageName} với giá ${formatMoney(price)} VNĐ?`);
            if (!confirmPurchase) return;

            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = `<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i>`;
            lucide.createIcons();

            try {
                const response = await fetch('api/buy_package.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Authorization': `Bearer ${token}` },
                    body: JSON.stringify({ package_name: packageName, price })
                });
                const result = await response.json();
                if (result.success) {
                    await showAlertModal(result.message, 'success');
                    fetchUserInfo(); // Cập nhật lại số dư
                } else {
                    await showAlertModal(result.message || 'Có lỗi xảy ra.', 'error');
                }
            } catch (error) {
                console.error(error);
                await showAlertModal('Không thể kết nối đến máy chủ.', 'error');
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalText;
                lucide.createIcons();
            }
        }

        if (token) {
            fetchUserInfo();
        }
    </script>
</body>
</html>
