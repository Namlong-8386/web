<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Giftcode - TOOLTX2026 Admin</title>
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
            <h2 class="font-bold text-slate-800 text-base leading-tight">Giftcode</h2>
            <p class="text-xs text-slate-400 hidden sm:block">Tạo và quản lý mã giftcode</p>
        </div>
        <div class="ml-auto">
            <button onclick="openCreateModal()" class="flex items-center gap-2 px-4 py-2 bg-primary hover:bg-blue-600 text-white rounded-xl text-sm font-bold active:scale-95 transition-all">
                <i data-lucide="plus" class="w-4 h-4"></i><span class="hidden sm:inline">Tạo Giftcode</span>
            </button>
        </div>
    </header>
    <main class="flex-1 p-4 sm:p-6">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100">
                <h3 class="font-bold text-slate-800">Danh sách Giftcode</h3>
                <p class="text-xs text-slate-400 mt-0.5">Quản lý mã khuyến mãi và theo dõi lượt sử dụng</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left min-w-[640px]">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                            <th class="px-5 py-3">Mã code</th>
                            <th class="px-5 py-3">Thưởng VIP</th>
                            <th class="px-5 py-3">Sử dụng</th>
                            <th class="px-5 py-3">Giới hạn</th>
                            <th class="px-5 py-3 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="gc-tbody" class="divide-y divide-slate-50 text-sm">
                        <tr><td colspan="5" class="py-10 text-center text-slate-400">Đang tải...</td></tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex items-center justify-between px-5 py-3 border-t border-slate-100">
                <p id="gc-pg-info" class="text-xs text-slate-400"></p>
                <div id="gc-pg" class="flex items-center gap-1"></div>
            </div>
        </div>
    </main>
</div>

<!-- Create Modal -->
<div id="create-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeCreateModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
        <div class="w-full max-w-sm bg-white rounded-2xl p-6 pointer-events-auto shadow-2xl">
            <h3 class="font-bold text-slate-800 mb-4">Tạo Giftcode mới</h3>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Tiền tố (prefix)</label>
                    <input type="text" id="gc-prefix" placeholder="VD: SUMMER, FREE, VIP..." class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary uppercase">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Thưởng VIP (ngày)</label>
                    <input type="number" id="gc-days" min="1" max="365" value="7" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Giới hạn sử dụng</label>
                    <input type="number" id="gc-limit" min="1" max="10000" value="1" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Số lượng mã</label>
                    <input type="number" id="gc-qty" min="1" max="20" value="1" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>
            <div class="flex gap-2 mt-5">
                <button onclick="createGiftcodes()" class="flex-1 py-2.5 bg-primary text-white font-bold rounded-xl text-sm active:scale-95 transition-all">Tạo mã</button>
                <button onclick="closeCreateModal()" class="py-2.5 px-4 bg-slate-100 text-slate-600 font-semibold rounded-xl text-sm">Hủy</button>
            </div>
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
function openCreateModal(){document.getElementById('create-modal').classList.remove('hidden');}
function closeCreateModal(){document.getElementById('create-modal').classList.add('hidden');}

let allGc=[], filteredGc=[];
function renderGiftcodes(gcs){
    const tbody=document.getElementById('gc-tbody');
    if(!gcs.length){tbody.innerHTML='<tr><td colspan="5" class="py-10 text-center text-slate-400 text-sm">Chưa có giftcode nào.</td></tr>';return;}
    tbody.innerHTML=gcs.map(gc=>{
        const used=gc.quantity_used||0;
        const max=gc.quantity||1;
        const pct=Math.round((used/max)*100);
        const isFull=used>=max||gc.status==='expired';
        return `<tr class="hover:bg-slate-50 transition-colors">
            <td class="px-5 py-3.5">
                <div class="flex items-center gap-2">
                    <span class="font-mono font-bold text-slate-800 tracking-wider">${gc.code}</span>
                    <button onclick="copyToClipboard('${gc.code}')" class="w-6 h-6 flex items-center justify-center bg-slate-100 hover:bg-blue-50 text-slate-400 hover:text-primary rounded transition-all active:scale-90"><i data-lucide="copy" class="w-3 h-3"></i></button>
                </div>
            </td>
            <td class="px-5 py-3.5"><span class="px-2.5 py-1 bg-purple-50 text-purple-600 rounded-lg text-[11px] font-bold">+${gc.days} ngày VIP</span></td>
            <td class="px-5 py-3.5">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-slate-700">${used}/${max}</span>
                    <div class="flex-1 max-w-[80px] bg-slate-100 rounded-full h-1.5"><div class="h-1.5 rounded-full ${isFull?'bg-red-400':'bg-emerald-400'}" style="width:${pct}%"></div></div>
                </div>
            </td>
            <td class="px-5 py-3.5">${isFull?'<span class="px-2 py-1 bg-red-50 text-red-500 rounded-lg text-[10px] font-bold">Hết lượt</span>':'<span class="px-2 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-bold">Còn dùng</span>'}</td>
            <td class="px-5 py-3.5 text-center">
                <button onclick="deleteGiftcode('${gc.code}')" class="flex items-center gap-1 px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-500 rounded-lg text-[11px] font-bold active:scale-95 transition-all mx-auto"><i data-lucide="trash-2" class="w-3 h-3"></i>Xóa</button>
            </td>
        </tr>`;
    }).join('');
    lucide.createIcons();
}

async function fetchGiftcodes(){
    try{const r=await fetch('../api/giftcode.php?action=admin_list',{headers:{'Authorization':`Bearer ${token}`}});const d=await r.json();if(d.success){allGc=d.codes||[];filteredGc=[...allGc];initPagination('gc',{itemsPerPage:20,dataArray:filteredGc,renderFn:renderGiftcodes,containerId:'gc-tbody',paginationId:'gc-pg',infoId:'gc-pg-info'});}}catch(e){console.error(e);}
}
async function createGiftcodes(){
    const prefix=(document.getElementById('gc-prefix').value.trim()||'GC').toUpperCase();
    const days=parseInt(document.getElementById('gc-days').value)||7;
    const quantity=parseInt(document.getElementById('gc-limit').value)||1;
    const count=parseInt(document.getElementById('gc-qty').value)||1;
    try{
        const r=await fetch('../api/giftcode.php',{method:'POST',headers:{'Content-Type':'application/json','Authorization':`Bearer ${token}`},body:JSON.stringify({action:'admin_create',prefix,days,quantity,count})});
        const d=await r.json(); alert(d.message); if(d.success){closeCreateModal();fetchGiftcodes();}
    }catch(e){alert('Lỗi kết nối.');}
}
async function deleteGiftcode(code){
    if(!await showConfirm(`Xóa giftcode "${code}"?`))return;
    try{
        const r=await fetch('../api/giftcode.php',{method:'POST',headers:{'Content-Type':'application/json','Authorization':`Bearer ${token}`},body:JSON.stringify({action:'admin_delete',code})});
        const d=await r.json(); alert(d.message); if(d.success)fetchGiftcodes();
    }catch(e){alert('Lỗi kết nối.');}
}
document.getElementById('gc-prefix').addEventListener('input',function(){this.value=this.value.toUpperCase();});
fetchGiftcodes();
</script>
</body>
</html>
