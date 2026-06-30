<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Quản lý Key & APK - TOOLTX2026 Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="../assets/js/pagination.js"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#3b82f6',success:'#10b981',danger:'#ef4444',warning:'#f59e0b'}}}}</script>
    <style>::-webkit-scrollbar{width:6px;height:6px}::-webkit-scrollbar-track{background:#f1f5f9}::-webkit-scrollbar-thumb{background:#cbd5e1;border-radius:4px}::-webkit-scrollbar-thumb:hover{background:#94a3b8}
    .copy-toast{position:fixed;bottom:24px;left:50%;transform:translateX(-50%);background:#1e293b;color:white;padding:8px 20px;border-radius:99px;font-size:13px;font-weight:600;z-index:9999;opacity:0;transition:opacity .2s;pointer-events:none}.copy-toast.show{opacity:1}</style>
<script src="/assets/js/anti-devtools.js"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans">
<div id="copy-toast" class="copy-toast">Đã sao chép!</div>

<aside id="sidebar" class="fixed inset-y-0 left-0 w-60 bg-[#0f172a] flex flex-col z-30 transition-transform duration-300 -translate-x-full lg:translate-x-0">
    <div class="h-16 flex items-center px-5 border-b border-white/5 flex-shrink-0">
        <div><p class="font-black tracking-widest text-xs text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300 uppercase">TOOLTX2026</p><p class="text-[10px] text-slate-500 font-semibold mt-0.5">Bảng quản trị hệ thống</p></div>
    </div>
    <nav class="flex-1 overflow-y-auto py-3 px-2 space-y-0.5">
        <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest px-3 py-2">Tổng quan</p>
        <a href="/admin" data-path="/admin" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-white/5 hover:text-white transition-all"><i data-lucide="layout-dashboard" class="w-4 h-4 flex-shrink-0"></i><span>Dashboard</span></a>
        <a href="/admin/transactions" data-path="/admin/transactions" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-white/5 hover:text-white transition-all"><i data-lucide="wallet" class="w-4 h-4 flex-shrink-0"></i><span>Nạp tiền</span></a>
        <a href="/admin/packages" data-path="/admin/packages" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-white/5 hover:text-white transition-all"><i data-lucide="crown" class="w-4 h-4 flex-shrink-0"></i><span>Trạng thái VIP</span></a>
        <a href="/admin/package-history" data-path="/admin/package-history" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-white/5 hover:text-white transition-all"><i data-lucide="history" class="w-4 h-4 flex-shrink-0"></i><span>Lịch sử gói</span></a>
        <a href="/admin/giftcodes" data-path="/admin/giftcodes" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-white/5 hover:text-white transition-all"><i data-lucide="gift" class="w-4 h-4 flex-shrink-0"></i><span>Giftcode</span></a>
        <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest px-3 py-2 pt-4">APK & Key</p>
        <a href="/admin/keys" data-path="/admin/keys" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-white/5 hover:text-white transition-all"><i data-lucide="key" class="w-4 h-4 flex-shrink-0"></i><span>Quản lý Key & APK</span></a>
    </nav>
    <div class="p-3 border-t border-white/5 flex-shrink-0">
        <div class="flex items-center gap-2.5 px-2 py-2 mb-2">
            <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i data-lucide="shield-check" class="w-4 h-4 text-blue-400"></i></div>
            <div class="min-w-0"><p id="admin-name" class="text-sm font-bold text-white truncate">Admin</p><p class="text-[11px] text-slate-500">Quản trị viên</p></div>
        </div>
        <button onclick="logoutAdmin()" class="w-full flex items-center justify-center gap-2 py-2 px-3 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-xl text-xs font-semibold transition-colors"><i data-lucide="log-out" class="w-3.5 h-3.5"></i> Đăng xuất</button>
    </div>
</aside>
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 hidden lg:hidden" onclick="toggleSidebar()"></div>

<div class="lg:ml-60 min-h-screen flex flex-col">
    <header class="h-16 bg-white border-b border-slate-200 flex items-center px-4 sm:px-6 sticky top-0 z-20 gap-4">
        <button onclick="toggleSidebar()" class="lg:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors flex-shrink-0"><i data-lucide="menu" class="w-5 h-5"></i></button>
        <div class="min-w-0">
            <h2 class="font-bold text-slate-800 text-base leading-tight">Quản lý Key & APK</h2>
            <p class="text-xs text-slate-400 hidden sm:block">Tạo, xóa key APK và cập nhật file APK</p>
        </div>
        <div class="ml-auto">
            <button onclick="openCreateKeyModal()" class="flex items-center gap-2 px-4 py-2 bg-primary hover:bg-blue-600 text-white rounded-xl text-sm font-bold active:scale-95 transition-all">
                <i data-lucide="plus" class="w-4 h-4"></i><span class="hidden sm:inline">Tạo Key</span>
            </button>
        </div>
    </header>

    <main class="flex-1 p-4 sm:p-6 space-y-6">

        <!-- APK Section -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="flex items-center gap-3 p-5 border-b border-slate-100">
                <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i data-lucide="smartphone" class="w-5 h-5 text-green-500"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800">Tệp APK ứng dụng</h3>
                    <p class="text-xs text-slate-400">Thông tin và cập nhật file APK phân phối</p>
                </div>
            </div>
            <div class="p-5">
                <div id="apk-info" class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-5">
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide mb-1">Tên file</p>
                        <p id="apk-filename" class="font-semibold text-slate-800 text-sm">...</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide mb-1">Phiên bản</p>
                        <p id="apk-version" class="font-bold text-primary text-sm">...</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide mb-1">Kích thước</p>
                        <p id="apk-size" class="font-semibold text-slate-800 text-sm">...</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide mb-1">Cập nhật lúc</p>
                        <p id="apk-date" class="font-semibold text-slate-800 text-sm">...</p>
                    </div>
                </div>

                <!-- Upload form -->
                <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center hover:border-primary/50 hover:bg-blue-50/30 transition-all" id="drop-zone">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <i data-lucide="upload-cloud" class="w-6 h-6 text-primary"></i>
                    </div>
                    <p class="font-semibold text-slate-700 mb-1">Tải lên APK mới</p>
                    <p class="text-xs text-slate-400 mb-3">Chỉ nhận file .apk · Tối đa 200MB</p>
                    <input type="file" id="apk-file" accept=".apk" class="hidden" onchange="onApkFileSelect(this)">
                    <div class="flex flex-col sm:flex-row items-center gap-2 justify-center">
                        <input type="text" id="apk-version-input" placeholder="Phiên bản (VD: 2.0.1)" class="px-3 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary w-48">
                        <button onclick="document.getElementById('apk-file').click()" class="flex items-center gap-2 px-4 py-2 bg-primary hover:bg-blue-600 text-white rounded-xl text-sm font-bold active:scale-95 transition-all">
                            <i data-lucide="file-up" class="w-4 h-4"></i> Chọn file APK
                        </button>
                    </div>
                    <div id="apk-selected-info" class="hidden mt-3 bg-blue-50 rounded-xl px-4 py-2.5 flex items-center gap-2 max-w-sm mx-auto">
                        <i data-lucide="file-check" class="w-4 h-4 text-primary flex-shrink-0"></i>
                        <span id="apk-selected-name" class="text-sm font-semibold text-primary truncate"></span>
                        <button onclick="uploadApk()" id="upload-btn" class="ml-auto flex-shrink-0 px-3 py-1 bg-primary text-white rounded-lg text-xs font-bold active:scale-95 transition-all">Upload</button>
                    </div>
                </div>
                <div id="upload-progress" class="hidden mt-3">
                    <div class="flex items-center gap-2 text-sm text-slate-600 mb-1.5">
                        <i data-lucide="loader" class="w-4 h-4 animate-spin text-primary"></i>
                        <span id="upload-status">Đang tải lên...</span>
                    </div>
                    <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div id="upload-bar" class="h-2 bg-primary rounded-full transition-all duration-300" style="width:0%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Stats -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm text-center">
                <p id="ks-total" class="text-2xl font-black text-slate-800">—</p>
                <p class="text-xs text-slate-400 mt-1">Tổng key</p>
            </div>
            <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm text-center">
                <p id="ks-active" class="text-2xl font-black text-emerald-500">—</p>
                <p class="text-xs text-slate-400 mt-1">Còn hạn</p>
            </div>
            <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm text-center">
                <p id="ks-expired" class="text-2xl font-black text-red-500">—</p>
                <p class="text-xs text-slate-400 mt-1">Hết hạn</p>
            </div>
            <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm text-center">
                <p id="ks-linked" class="text-2xl font-black text-blue-500">—</p>
                <p class="text-xs text-slate-400 mt-1">Đã liên kết TB</p>
            </div>
        </div>

        <!-- Keys Table -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-5 border-b border-slate-100">
                <div>
                    <h3 class="font-bold text-slate-800">Danh sách Key APK</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Tất cả key trong hệ thống</p>
                </div>
                <div class="flex gap-2 flex-wrap">
                    <select id="filter-key-type" onchange="filterKeys()" class="bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="all">Tất cả loại</option>
                        <option value="1_day">Key 1 Ngày</option>
                        <option value="7_day">Key 7 Ngày</option>
                        <option value="30_day">Key 30 Ngày</option>
                        <option value="lifetime">Vĩnh Viễn</option>
                        <option value="free">Key Free</option>
                    </select>
                    <select id="filter-key-status" onchange="filterKeys()" class="bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="all">Tất cả trạng thái</option>
                        <option value="active">Còn hạn</option>
                        <option value="expired">Hết hạn</option>
                        <option value="linked">Đã liên kết</option>
                        <option value="unused">Chưa dùng</option>
                    </select>
                    <div class="relative">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                        <input type="text" id="search-keys" oninput="filterKeys()" placeholder="Tìm key, user..." class="pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-primary w-44">
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left min-w-[780px]">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                            <th class="px-5 py-3">Key</th>
                            <th class="px-5 py-3">Loại</th>
                            <th class="px-5 py-3">Tài khoản</th>
                            <th class="px-5 py-3">Thiết bị</th>
                            <th class="px-5 py-3">Hết hạn</th>
                            <th class="px-5 py-3">Trạng thái</th>
                            <th class="px-5 py-3 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="keys-tbody" class="divide-y divide-slate-50 text-sm">
                        <tr><td colspan="7" class="py-10 text-center text-slate-400">Đang tải...</td></tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex items-center justify-between px-5 py-3 border-t border-slate-100">
                <p id="keys-pg-info" class="text-xs text-slate-400"></p>
                <div id="keys-pg" class="flex items-center gap-1"></div>
            </div>
        </div>
    </main>
</div>

<!-- Create Key Modal -->
<div id="create-key-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeCreateKeyModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
        <div class="w-full max-w-sm bg-white rounded-2xl p-6 pointer-events-auto shadow-2xl">
            <h3 class="font-bold text-slate-800 mb-4">Tạo Key APK mới</h3>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Loại key</label>
                    <select id="key-type" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="1_day">Key 1 Ngày</option>
                        <option value="7_day" selected>Key 7 Ngày</option>
                        <option value="30_day">Key 30 Ngày</option>
                        <option value="lifetime">Vĩnh Viễn</option>
                        <option value="custom">Tùy chỉnh số ngày</option>
                    </select>
                </div>
                <div id="custom-days-row" class="hidden">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Số ngày</label>
                    <input type="number" id="key-custom-days" min="1" max="3650" value="14" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Số lượng key</label>
                    <input type="number" id="key-qty" min="1" max="50" value="1" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Gán cho tài khoản <span class="font-normal normal-case text-slate-400">(không bắt buộc)</span></label>
                    <input type="text" id="key-username" list="users-list" placeholder="Để trống = key tự do" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    <datalist id="users-list"></datalist>
                </div>
            </div>
            <div class="flex gap-2 mt-5">
                <button onclick="createKeys()" class="flex-1 py-2.5 bg-primary text-white font-bold rounded-xl text-sm active:scale-95 transition-all">Tạo Key</button>
                <button onclick="closeCreateKeyModal()" class="py-2.5 px-4 bg-slate-100 text-slate-600 font-semibold rounded-xl text-sm">Hủy</button>
            </div>
        </div>
    </div>
</div>

<!-- Created Keys Modal -->
<div id="created-keys-modal" class="fixed inset-0 z-[55] hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeCreatedModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
        <div class="w-full max-w-md bg-white rounded-2xl p-6 pointer-events-auto shadow-2xl">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center flex-shrink-0"><i data-lucide="check-circle" class="w-5 h-5 text-emerald-500"></i></div>
                <div><h3 class="font-bold text-slate-800">Key đã được tạo!</h3><p class="text-xs text-slate-400">Sao chép các key bên dưới</p></div>
            </div>
            <div id="created-keys-list" class="space-y-2 max-h-64 overflow-y-auto mb-4"></div>
            <button onclick="closeCreatedModal()" class="w-full py-2.5 bg-primary text-white font-bold rounded-xl text-sm active:scale-95 transition-all">Đóng</button>
        </div>
    </div>
</div>

<div id="confirm-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeConfirm()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
        <div class="w-full max-w-sm bg-white rounded-2xl p-6 pointer-events-auto shadow-2xl">
            <div class="text-center mb-5"><div class="w-10 h-10 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center mx-auto mb-3"><i data-lucide="alert-triangle" class="w-5 h-5"></i></div><h3 class="font-bold text-slate-800 mb-1">Xác nhận</h3><p id="confirm-msg" class="text-sm text-slate-500"></p></div>
            <div class="flex gap-2"><button id="confirm-yes" class="flex-1 py-2.5 bg-primary text-white font-bold rounded-xl text-sm active:scale-95 transition-all">Đồng ý</button><button onclick="closeConfirm()" class="py-2.5 px-4 bg-slate-100 text-slate-600 font-semibold rounded-xl text-sm">Hủy</button></div>
        </div>
    </div>
</div>
<div id="alert-modal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeAlert()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
        <div class="w-full max-w-sm bg-white rounded-2xl p-6 pointer-events-auto shadow-2xl text-center">
            <div id="alert-icon" class="w-10 h-10 rounded-full bg-blue-50 text-primary flex items-center justify-center mx-auto mb-3"><i data-lucide="info" class="w-5 h-5"></i></div>
            <h3 id="alert-title" class="font-bold text-slate-800 mb-1">Thông báo</h3>
            <p id="alert-msg" class="text-sm text-slate-500 mb-5"></p>
            <button onclick="closeAlert()" class="w-full py-2.5 bg-primary text-white font-bold rounded-xl text-sm active:scale-95 transition-all">Đóng</button>
        </div>
    </div>
</div>

<script>
lucide.createIcons();
const token=localStorage.getItem('token');
if(!token||localStorage.getItem('role')!=='admin'){window.location.href='/admin/login';}
document.getElementById('admin-name').innerText=localStorage.getItem('username')||'Admin';
function toggleSidebar(){document.getElementById('sidebar').classList.toggle('-translate-x-full');document.getElementById('sidebar-overlay').classList.toggle('hidden');}
document.querySelectorAll('.nav-link').forEach(l=>{if(l.dataset.path===window.location.pathname){l.classList.add('bg-blue-600','text-white');l.classList.remove('text-slate-400','hover:bg-white/5','hover:text-white');}});
function logoutAdmin(){localStorage.clear();window.location.href='/admin/login';}

let confirmResolve=null;
function showConfirm(m){document.getElementById('confirm-msg').innerText=m;document.getElementById('confirm-modal').classList.remove('hidden');lucide.createIcons();return new Promise(r=>{confirmResolve=r;});}
function closeConfirm(){document.getElementById('confirm-modal').classList.add('hidden');if(confirmResolve){confirmResolve(false);confirmResolve=null;}}
document.getElementById('confirm-yes').addEventListener('click',()=>{document.getElementById('confirm-modal').classList.add('hidden');if(confirmResolve){confirmResolve(true);confirmResolve=null;}});
let alertResolve=null;
function alert(m,t='info'){const i=document.getElementById('alert-icon'),ti=document.getElementById('alert-title');document.getElementById('alert-msg').innerText=m;if(t==='success'||m.includes('thành công')||m.includes('Thành công')){i.className='w-10 h-10 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mx-auto mb-3';i.innerHTML='<i data-lucide="check-circle" class="w-5 h-5"></i>';ti.innerText='Thành công';}else if(t==='error'||m.includes('Lỗi')){i.className='w-10 h-10 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-3';i.innerHTML='<i data-lucide="x-circle" class="w-5 h-5"></i>';ti.innerText='Lỗi';}else{i.className='w-10 h-10 rounded-full bg-blue-50 text-primary flex items-center justify-center mx-auto mb-3';i.innerHTML='<i data-lucide="info" class="w-5 h-5"></i>';ti.innerText='Thông báo';}document.getElementById('alert-modal').classList.remove('hidden');lucide.createIcons();return new Promise(r=>{alertResolve=r;});}
function closeAlert(){document.getElementById('alert-modal').classList.add('hidden');if(alertResolve){alertResolve();alertResolve=null;}}
function copyToClipboard(t){navigator.clipboard.writeText(t).catch(()=>{});const toast=document.getElementById('copy-toast');toast.classList.add('show');setTimeout(()=>toast.classList.remove('show'),1800);}

// APK
async function fetchApkInfo(){
    try{const r=await fetch('../api/admin_apk.php',{headers:{'Authorization':`Bearer ${token}`}});const d=await r.json();
    if(d.success&&d.apk){
        document.getElementById('apk-filename').innerText=d.apk.filename||'—';
        document.getElementById('apk-version').innerText=d.apk.version||'—';
        document.getElementById('apk-size').innerText=d.apk.size_label||'—';
        document.getElementById('apk-date').innerText=d.apk.uploaded_at||'—';
    }}catch(e){console.error(e);}
}

let selectedApkFile=null;
function onApkFileSelect(input){
    const file=input.files[0];
    if(!file)return;
    selectedApkFile=file;
    document.getElementById('apk-selected-name').innerText=file.name+' ('+Math.round(file.size/1048576,1)+' MB)';
    document.getElementById('apk-selected-info').classList.remove('hidden');
}

async function uploadApk(){
    if(!selectedApkFile){alert('Chưa chọn file APK.');return;}
    const version=document.getElementById('apk-version-input').value.trim()||'1.0.0';
    const btn=document.getElementById('upload-btn');
    btn.disabled=true; btn.innerText='Đang tải...';
    document.getElementById('upload-progress').classList.remove('hidden');

    const fd=new FormData();
    fd.append('apk',selectedApkFile);
    fd.append('version',version);

    try{
        const xhr=new XMLHttpRequest();
        xhr.upload.onprogress=e=>{
            if(e.lengthComputable){
                const pct=Math.round(e.loaded/e.total*100);
                document.getElementById('upload-bar').style.width=pct+'%';
                document.getElementById('upload-status').innerText=`Đang tải lên... ${pct}%`;
            }
        };
        xhr.onload=async()=>{
            document.getElementById('upload-progress').classList.add('hidden');
            const d=JSON.parse(xhr.responseText);
            await alert(d.message||'Cập nhật APK thành công!');
            if(d.success){
                document.getElementById('apk-selected-info').classList.add('hidden');
                selectedApkFile=null;
                document.getElementById('apk-file').value='';
                fetchApkInfo();
            }
            btn.disabled=false; btn.innerText='Upload';
        };
        xhr.onerror=()=>{
            document.getElementById('upload-progress').classList.add('hidden');
            alert('Lỗi kết nối khi tải file.','error');
            btn.disabled=false; btn.innerText='Upload';
        };
        xhr.open('POST','../api/admin_apk.php');
        xhr.setRequestHeader('Authorization',`Bearer ${token}`);
        xhr.send(fd);
    }catch(e){alert('Lỗi: '+e.message,'error');btn.disabled=false;btn.innerText='Upload';}
}

// Keys
let allKeys=[], filteredKeys=[];
function openCreateKeyModal(){document.getElementById('create-key-modal').classList.remove('hidden');}
function closeCreateKeyModal(){document.getElementById('create-key-modal').classList.add('hidden');}
function closeCreatedModal(){document.getElementById('created-keys-modal').classList.add('hidden');fetchKeys();}

document.getElementById('key-type').addEventListener('change',function(){
    document.getElementById('custom-days-row').classList.toggle('hidden',this.value!=='custom');
});

// Load users for datalist
async function loadUsersList(){
    try{const r=await fetch('../api/admin_users.php',{headers:{'Authorization':`Bearer ${token}`}});const d=await r.json();
    if(d.success){const dl=document.getElementById('users-list');dl.innerHTML=d.users.map(u=>`<option value="${u.username}">`).join('');}}catch(e){}
}

async function createKeys(){
    const type=document.getElementById('key-type').value;
    const qty=parseInt(document.getElementById('key-qty').value)||1;
    const username=document.getElementById('key-username').value.trim();
    const customDays=parseInt(document.getElementById('key-custom-days').value)||14;
    try{
        const r=await fetch('../api/admin_keys.php',{method:'POST',headers:{'Content-Type':'application/json','Authorization':`Bearer ${token}`},body:JSON.stringify({action:'create',type,qty,username,custom_days:customDays})});
        const d=await r.json();
        if(d.success){
            closeCreateKeyModal();
            const list=document.getElementById('created-keys-list');
            list.innerHTML=(d.keys||[]).map(k=>`
                <div class="flex items-center gap-2 bg-slate-50 rounded-xl px-3 py-2.5">
                    <i data-lucide="key" class="w-4 h-4 text-primary flex-shrink-0"></i>
                    <span class="font-mono text-sm font-bold text-slate-800 flex-1 truncate">${k}</span>
                    <button onclick="copyToClipboard('${k}')" class="flex-shrink-0 w-7 h-7 flex items-center justify-center bg-blue-50 hover:bg-blue-100 text-primary rounded-lg active:scale-90 transition-all"><i data-lucide="copy" class="w-3.5 h-3.5"></i></button>
                </div>
            `).join('');
            document.getElementById('created-keys-modal').classList.remove('hidden');
            lucide.createIcons();
        } else { alert(d.message,'error'); }
    }catch(e){alert('Lỗi kết nối.','error');}
}

async function deleteKey(kv){
    if(!await showConfirm(`Xóa vĩnh viễn key:\n${kv}?`))return;
    try{
        const r=await fetch('../api/admin_keys.php',{method:'POST',headers:{'Content-Type':'application/json','Authorization':`Bearer ${token}`},body:JSON.stringify({action:'delete',key:kv})});
        const d=await r.json(); alert(d.message); if(d.success)fetchKeys();
    }catch(e){alert('Lỗi kết nối.','error');}
}

async function resetHwid(kv){
    if(!await showConfirm(`Reset thiết bị liên kết cho key:\n${kv}?`))return;
    try{
        const r=await fetch('../api/admin_keys.php',{method:'POST',headers:{'Content-Type':'application/json','Authorization':`Bearer ${token}`},body:JSON.stringify({action:'reset_hwid',key:kv})});
        const d=await r.json(); alert(d.message); if(d.success)fetchKeys();
    }catch(e){alert('Lỗi kết nối.','error');}
}

const typeColors={'1_day':'bg-blue-50 text-blue-600','7_day':'bg-indigo-50 text-indigo-600','30_day':'bg-purple-50 text-purple-600','lifetime':'bg-amber-50 text-amber-600','free':'bg-emerald-50 text-emerald-600'};

function renderKeys(keys){
    const tbody=document.getElementById('keys-tbody');
    if(!keys.length){tbody.innerHTML='<tr><td colspan="7" class="py-10 text-center text-slate-400 text-sm">Không tìm thấy key nào.</td></tr>';return;}
    tbody.innerHTML=keys.map(k=>{
        const tc=typeColors[k.type]||'bg-slate-100 text-slate-600';
        const isLinked=k.hwid!=='';
        const statusBadge=k.is_expired?'<span class="px-2 py-0.5 bg-red-50 text-red-500 rounded-lg text-[10px] font-bold">Hết hạn</span>':'<span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-bold">Còn hạn</span>';
        const deviceBadge=isLinked?'<span class="px-2 py-0.5 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold flex items-center gap-1 w-fit"><i data-lucide="smartphone" class="w-3 h-3"></i>Đã liên kết</span>':'<span class="px-2 py-0.5 bg-slate-100 text-slate-400 rounded-lg text-[10px] font-medium">Chưa dùng</span>';
        return `<tr class="hover:bg-slate-50 transition-colors">
            <td class="px-5 py-3.5">
                <div class="flex items-center gap-1.5">
                    <span class="font-mono text-xs font-bold text-slate-700">${k.key}</span>
                    <button onclick="copyToClipboard('${k.key}')" class="w-5 h-5 flex items-center justify-center bg-slate-100 hover:bg-blue-50 text-slate-400 hover:text-primary rounded active:scale-90 transition-all"><i data-lucide="copy" class="w-3 h-3"></i></button>
                </div>
            </td>
            <td class="px-5 py-3.5"><span class="px-2 py-1 ${tc} rounded-lg text-[11px] font-bold">${k.label}</span></td>
            <td class="px-5 py-3.5 text-sm font-medium text-slate-700">${k.username||'<span class="text-slate-300">Tự do</span>'}</td>
            <td class="px-5 py-3.5">${deviceBadge}</td>
            <td class="px-5 py-3.5 text-xs text-slate-500">${k.expiry}</td>
            <td class="px-5 py-3.5">${statusBadge}</td>
            <td class="px-5 py-3.5">
                <div class="flex items-center justify-center gap-1.5">
                    ${isLinked?`<button onclick="resetHwid('${k.key}')" class="flex items-center gap-1 px-2 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-[10px] font-semibold active:scale-95 transition-all"><i data-lucide="refresh-cw" class="w-3 h-3"></i>Reset TB</button>`:''}
                    <button onclick="deleteKey('${k.key}')" class="flex items-center gap-1 px-2 py-1.5 bg-red-50 hover:bg-red-100 text-red-500 rounded-lg text-[10px] font-bold active:scale-95 transition-all"><i data-lucide="trash-2" class="w-3 h-3"></i>Xóa</button>
                </div>
            </td>
        </tr>`;
    }).join('');
    lucide.createIcons();
}

function filterKeys(){
    const q=document.getElementById('search-keys').value.toLowerCase();
    const type=document.getElementById('filter-key-type').value;
    const status=document.getElementById('filter-key-status').value;
    filteredKeys=allKeys.filter(k=>{
        const mq=k.key.toLowerCase().includes(q)||(k.username&&k.username.toLowerCase().includes(q));
        const mt=type==='all'||k.type===type;
        let ms=true;
        if(status==='active')ms=!k.is_expired;
        else if(status==='expired')ms=k.is_expired;
        else if(status==='linked')ms=k.hwid!=='';
        else if(status==='unused')ms=k.hwid==='';
        return mq&&mt&&ms;
    });
    initPagination('keys',{itemsPerPage:20,dataArray:filteredKeys,renderFn:renderKeys,containerId:'keys-tbody',paginationId:'keys-pg',infoId:'keys-pg-info'});
}

async function fetchKeys(){
    try{
        const r=await fetch('../api/admin_keys.php',{headers:{'Authorization':`Bearer ${token}`}});
        const d=await r.json();
        if(d.success){
            allKeys=d.keys;
            filteredKeys=[...allKeys];
            initPagination('keys',{itemsPerPage:20,dataArray:filteredKeys,renderFn:renderKeys,containerId:'keys-tbody',paginationId:'keys-pg',infoId:'keys-pg-info'});
            document.getElementById('ks-total').innerText=d.stats.total;
            document.getElementById('ks-active').innerText=d.stats.active;
            document.getElementById('ks-expired').innerText=d.stats.expired;
            document.getElementById('ks-linked').innerText=d.stats.linked;
        }
    }catch(e){console.error(e);}
}

fetchApkInfo();
fetchKeys();
loadUsersList();
</script>
</body>
</html>
