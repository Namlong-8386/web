<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lịch Sử Giao Dịch - TOOLTX2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="/assets/js/pagination.js"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#3b82f6', success: '#10b981', danger: '#ef4444', warning: '#f59e0b' } } } }</script>
    <style>
        body { -webkit-user-select: none; user-select: none; -webkit-tap-highlight-color: transparent; }
        ::-webkit-scrollbar, .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
<script src="/assets/js/anti-devtools.js"></script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans min-h-screen flex flex-col">
    <div id="copy-toast" class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[100] bg-slate-800 text-white text-xs font-semibold px-4 py-2 rounded-full shadow-lg opacity-0 pointer-events-none transition-opacity duration-200">Đã sao chép!</div>

    <header class="bg-white shadow-sm sticky top-0 z-40 border-b border-slate-100 overflow-hidden h-14">
        <!-- Chế độ mặc định -->
        <div id="header-default" class="absolute inset-0 flex items-center justify-between px-4 transition-transform duration-300 z-10">
            <a href="/account" class="w-10 h-10 flex items-center justify-center text-slate-500 hover:bg-slate-50 active:bg-slate-100 rounded-full transition-colors absolute left-2"><i data-lucide="chevron-left" class="w-6 h-6"></i></a>
            <h1 class="text-lg font-bold text-slate-800 w-full text-center">Lịch sử giao dịch</h1>
            <button id="btn-open-search" class="w-10 h-10 flex items-center justify-center text-slate-500 hover:bg-slate-50 active:bg-slate-100 rounded-full transition-colors absolute right-2"><i data-lucide="search" class="w-5 h-5"></i></button>
        </div>
        <!-- Chế độ tìm kiếm -->
        <div id="header-search" class="absolute inset-0 flex items-center px-4 bg-white transform translate-x-full transition-transform duration-300 z-20">
            <div class="flex-1 relative flex items-center gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i data-lucide="search" class="w-4 h-4 text-slate-400"></i></div>
                    <input type="text" id="search-input" class="block w-full pl-9 pr-8 py-2 bg-slate-100 border-transparent rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-primary focus:bg-white" placeholder="Tìm tên, số tiền...">
                    <button id="btn-clear-search" class="absolute inset-y-0 right-0 pr-2.5 flex items-center hidden"><i data-lucide="x-circle" class="w-4 h-4 text-slate-400"></i></button>
                </div>
                <button id="btn-close-search" class="text-sm font-medium text-primary px-1 active:scale-95 transition-transform">Hủy</button>
            </div>
        </div>
    </header>

    <main class="flex-grow pb-8 w-full max-w-3xl mx-auto">
        <div class="bg-white px-4 py-3 sticky top-14 z-30 border-b border-slate-100 shadow-sm">
            <div class="flex gap-2 overflow-x-auto no-scrollbar">
                <button class="filter-btn active whitespace-nowrap px-5 py-2 rounded-full text-sm font-semibold bg-primary text-white active:scale-95" data-filter="all">Tất cả</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-medium bg-slate-100 text-slate-600 active:scale-95" data-filter="in">Tiền vào</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-medium bg-slate-100 text-slate-600 active:scale-95" data-filter="out">Tiền ra</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-medium bg-slate-100 text-slate-600 active:scale-95" data-filter="keys"><i data-lucide="key" class="w-3.5 h-3.5 inline-block mr-1"></i>Key đã mua</button>
            </div>
        </div>

        <div class="px-4 py-4 space-y-6" id="transaction-list-container"></div>

        <!-- Pagination -->
        <div class="px-4 py-2 flex items-center justify-between">
            <p id="tx-pg-info" class="text-xs text-slate-400"></p>
            <div id="tx-pg" class="flex items-center gap-1"></div>
        </div>

        <!-- Keys list -->
        <div class="px-4 py-4 space-y-3 hidden" id="keys-list-container"></div>

        <!-- Keys Pagination -->
        <div id="keys-pg-wrap" class="px-4 py-2 flex items-center justify-between hidden">
            <p id="keys-pg-info" class="text-xs text-slate-400"></p>
            <div id="keys-pg" class="flex items-center gap-1"></div>
        </div>

        <!-- Empty state -->
        <div id="empty-state" class="hidden flex-col items-center justify-center py-12 text-center">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4"><i data-lucide="search-x" class="w-10 h-10 text-slate-400"></i></div>
            <h3 id="empty-title" class="text-base font-bold text-slate-800">Không có giao dịch</h3>
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
        
        const token = localStorage.getItem('token');
        if (!token) {
            (async () => {
                await alert('Vui lòng đăng nhập để xem lịch sử giao dịch.');
                window.location.href = '/login';
            })();
        }

        const headerSearch = document.getElementById('header-search'), searchInput = document.getElementById('search-input'), btnClearSearch = document.getElementById('btn-clear-search');
        document.getElementById('btn-open-search').addEventListener('click', () => { headerSearch.classList.remove('translate-x-full'); setTimeout(() => searchInput.focus(), 300); });
        document.getElementById('btn-close-search').addEventListener('click', () => { headerSearch.classList.add('translate-x-full'); searchInput.value = ''; btnClearSearch.classList.add('hidden'); renderTransactions(); });
        btnClearSearch.addEventListener('click', () => { searchInput.value = ''; btnClearSearch.classList.add('hidden'); searchInput.focus(); renderTransactions(); });
        searchInput.addEventListener('input', (e) => { btnClearSearch.classList.toggle('hidden', e.target.value.length === 0); renderTransactions(); });
        
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => { b.classList.remove('bg-primary', 'text-white', 'font-semibold', 'active'); b.classList.add('bg-slate-100', 'text-slate-600', 'font-medium'); });
                this.classList.remove('bg-slate-100', 'text-slate-600', 'font-medium'); this.classList.add('bg-primary', 'text-white', 'font-semibold', 'active');
                if (this.getAttribute('data-filter') === 'keys') {
                    renderKeys();
                } else {
                    renderTransactions();
                }
            });
        });

        let rawTransactions = [];
        let rawKeys = [];
        let currentUserId = '';
        let txPgInst = null, keysPgInst = null;

        async function fetchCurrentUser() {
            try {
                const r = await fetch('api/user.php', { headers: { 'Authorization': `Bearer ${token}` } });
                const d = await r.json();
                if (d.success) currentUserId = d.user_id || '';
            } catch(e) {}
        }

        function formatMoney(n) { return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); }

        function copyText(text) {
            navigator.clipboard.writeText(text).then(() => showCopyToast()).catch(() => {
                const el = document.createElement('textarea');
                el.value = text; document.body.appendChild(el); el.select();
                document.execCommand('copy'); document.body.removeChild(el);
                showCopyToast();
            });
        }
        function showCopyToast() {
            const t = document.getElementById('copy-toast');
            t.style.opacity = '1';
            setTimeout(() => { t.style.opacity = '0'; }, 1600);
        }

        function getGroupName(timeStr) {
            if (!timeStr) return 'Khác';
            const parts = timeStr.split(' ');
            const dateStr = parts[0]; // YYYY-MM-DD
            const todayStr = new Date().toISOString().split('T')[0];
            if (dateStr === todayStr) {
                return 'Hôm nay';
            }
            const d = dateStr.split('-');
            if (d.length === 3) return `${d[2]}/${d[1]}/${d[0]}`;
            return dateStr;
        }

        async function fetchTransactions() {
            try {
                const response = await fetch('api/history.php', { headers: { 'Authorization': `Bearer ${token}` } });
                const result = await response.json();
                if (result.success) {
                    rawTransactions = result.transactions || [];
                    renderTransactions();
                } else {
                    localStorage.clear();
                    window.location.href = '/login';
                }
            } catch (e) {
                console.error(e);
                alert('Không thể kết nối máy chủ.');
            }
        }

        function renderTransactionsData(pageItems) {
            const container = document.getElementById('transaction-list-container');
            const emptyState = document.getElementById('empty-state');

            container.innerHTML = '';
            if (pageItems.length === 0) {
                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
                document.getElementById('empty-title').innerText = 'Không có giao dịch';
                return;
            }
            emptyState.classList.add('hidden');
            emptyState.classList.remove('flex');

            // Group by date
            const groups = {};
            pageItems.forEach(item => {
                const groupName = getGroupName(item.time);
                if (!groups[groupName]) groups[groupName] = [];
                groups[groupName].push(item);
            });

            for (const [groupName, items] of Object.entries(groups)) {
                const groupDiv = document.createElement('div');
                groupDiv.className = 'date-group';
                let groupHtml = `<h3 class="text-xs font-bold text-slate-400 uppercase mb-3 ml-1">${groupName}</h3>
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden divide-y divide-slate-50">`;
                items.forEach(item => {
                    const isSuccess = item.status === 'Thành công';
                    const isPending = item.status === 'Chờ duyệt';
                    const isRejected = item.status === 'Từ chối';
                    const isPendingDeposit = isPending && item.type === 'in';
                    let statusLabel, statusClass;
                    if (isPendingDeposit) { statusLabel = 'Chưa thanh toán'; statusClass = 'text-rose-600 bg-rose-50 border border-rose-200'; }
                    else if (isSuccess) { statusLabel = item.status; statusClass = 'text-success bg-success/10'; }
                    else if (isPending) { statusLabel = item.status; statusClass = 'text-amber-600 bg-amber-500/10'; }
                    else { statusLabel = item.status; statusClass = 'text-danger bg-danger/10'; }
                    const timeOnly = item.time.split(' ')[0] || '';
                    const uid = item.user_id || currentUserId;
                    const method = item.method || 'bank';
                    const qrLink = `/payment-qr?tx=${item.id}&amount=${item.amount}&uid=${encodeURIComponent(uid)}&method=${method}`;
                    groupHtml += `<div class="transaction-item p-4" data-type="${item.type}">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl flex-shrink-0 ${item.type === 'in' ? 'bg-blue-50 text-primary' : 'bg-orange-50 text-orange-500'} flex items-center justify-center">
                                <i data-lucide="${item.type === 'in' ? 'arrow-down-to-line' : 'package'}" class="w-6 h-6"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-slate-800 text-sm truncate trans-title">${item.title}</h4>
                                <p class="text-xs text-slate-400 flex items-center gap-1 mt-0.5">${timeOnly} · <span class="font-mono">${item.id}</span>
                                    <button onclick="copyText('${item.id}')" title="Sao chép mã" class="inline-flex items-center justify-center w-5 h-5 bg-slate-100 hover:bg-blue-50 hover:text-primary text-slate-400 rounded active:scale-90 transition-all"><i data-lucide="copy" class="w-3 h-3"></i></button>
                                </p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="font-bold ${item.type === 'in' ? 'text-success' : 'text-danger'} text-sm trans-amount">${item.type === 'in' ? '+' : '-'}${formatMoney(item.amount)}đ</p>
                                <span class="text-[10px] font-semibold ${statusClass} px-2 py-0.5 rounded-md mt-1 inline-block">${statusLabel}</span>
                            </div>
                        </div>
                        ${isPendingDeposit ? `<a href="${qrLink}" class="mt-3 w-full flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-blue-600 text-white text-xs font-bold py-2.5 rounded-xl shadow shadow-blue-500/25 active:scale-[0.97] transition-transform"><i data-lucide="credit-card" class="w-3.5 h-3.5"></i>Thanh toán ngay</a>` : ''}
                    </div>`;
                });
                groupHtml += `</div>`;
                groupDiv.innerHTML = groupHtml;
                container.appendChild(groupDiv);
            }
            lucide.createIcons();
        }

        function renderTransactions() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const filterValue = document.querySelector('.filter-btn.active').getAttribute('data-filter');
            const container = document.getElementById('transaction-list-container');
            container.classList.remove('hidden');
            document.getElementById('keys-list-container').classList.add('hidden');
            document.getElementById('keys-pg-wrap').classList.add('hidden');

            const filtered = rawTransactions.filter(item => {
                const matchTab = (filterValue === 'all' || filterValue === item.type);
                const matchSearch = item.title.toLowerCase().includes(searchTerm) || item.amount.toString().includes(searchTerm) || item.id.toLowerCase().includes(searchTerm);
                return matchTab && matchSearch;
            });

            txPgInst = initPagination('tx', {
                itemsPerPage: 20,
                dataArray: filtered,
                renderFn: renderTransactionsData,
                containerId: 'transaction-list-container',
                paginationId: 'tx-pg',
                infoId: 'tx-pg-info'
            });
        }

        async function fetchKeys() {
            try {
                const res = await fetch('api/my_keys.php', { headers: { 'Authorization': `Bearer ${token}` } });
                const data = await res.json();
                if (data.success) rawKeys = data.keys || [];
            } catch(e) {}
        }

        function renderKeysData(pageItems) {
            const keysContainer = document.getElementById('keys-list-container');
            const emptyState = document.getElementById('empty-state');
            keysContainer.innerHTML = '';
            if (pageItems.length === 0) {
                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
                document.getElementById('empty-title').innerText = 'Chưa có key nào';
                return;
            }
            emptyState.classList.add('hidden');
            emptyState.classList.remove('flex');
            const typeColors = {
                '1_day':    { bg: 'bg-blue-50',   text: 'text-primary',    icon: 'clock' },
                '7_day':    { bg: 'bg-amber-50',   text: 'text-amber-500',  icon: 'calendar-days' },
                '30_day':   { bg: 'bg-emerald-50', text: 'text-emerald-600',icon: 'calendar-check' },
                'lifetime': { bg: 'bg-purple-50',  text: 'text-purple-600', icon: 'infinity' },
                'free':     { bg: 'bg-green-50',   text: 'text-green-600',  icon: 'gift' },
            };
            pageItems.forEach(k => {
                const color = typeColors[k.type] || { bg: 'bg-slate-50', text: 'text-slate-500', icon: 'key' };
                const isExpired = k.is_expired;
                const isLinked = k.hwid !== '';
                const card = document.createElement('div');
                card.className = 'bg-white rounded-2xl shadow-sm border border-slate-100 p-4';
                card.innerHTML = `<div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 ${color.bg} rounded-xl flex items-center justify-center flex-shrink-0"><i data-lucide="${color.icon}" class="w-5 h-5 ${color.text}"></i></div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="font-bold text-slate-800 text-sm">${k.label}</p>
                            ${isExpired ? '<span class="text-[9px] font-black bg-red-100 text-red-500 px-1.5 py-0.5 rounded-full uppercase">Hết hạn</span>' : '<span class="text-[9px] font-black bg-green-100 text-green-600 px-1.5 py-0.5 rounded-full uppercase">Còn hạn</span>'}
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">Hạn: ${k.expiry}</p>
                    </div>
                    <div class="text-right flex-shrink-0">${isLinked ? '<span class="text-[9px] font-semibold bg-blue-50 text-primary px-2 py-0.5 rounded-full flex items-center gap-1"><i data-lucide="smartphone" class="w-3 h-3"></i> Đã liên kết</span>' : '<span class="text-[9px] font-semibold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">Chưa dùng</span>'}</div>
                </div>
                <div class="bg-slate-50 rounded-xl px-3 py-2.5 flex items-center justify-between gap-2">
                    <p class="font-mono text-sm font-bold text-slate-700 tracking-wider truncate">${k.key}</p>
                    <button onclick="copyText('${k.key}')" class="flex-shrink-0 flex items-center gap-1 text-xs font-bold text-primary bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg active:scale-95 transition-all"><i data-lucide="copy" class="w-3.5 h-3.5"></i> Sao chép</button>
                </div>`;
                keysContainer.appendChild(card);
            });
            lucide.createIcons();
        }

        function renderKeys() {
            const txContainer = document.getElementById('transaction-list-container');
            const keysContainer = document.getElementById('keys-list-container');
            txContainer.classList.add('hidden');
            document.getElementById('tx-pg').innerHTML = '';
            document.getElementById('tx-pg-info').innerText = '';
            keysContainer.classList.remove('hidden');
            document.getElementById('keys-pg-wrap').classList.remove('hidden');
            const searchTerm = searchInput.value.toLowerCase().trim();
            const filtered = rawKeys.filter(k => k.key.toLowerCase().includes(searchTerm) || k.label.toLowerCase().includes(searchTerm));
            keysPgInst = initPagination('keys', {
                itemsPerPage: 20,
                dataArray: filtered,
                renderFn: renderKeysData,
                containerId: 'keys-list-container',
                paginationId: 'keys-pg',
                infoId: 'keys-pg-info'
            });
        }

        fetchCurrentUser().then(() => Promise.all([fetchTransactions(), fetchKeys()]));
    </script>
</body>
</html>


