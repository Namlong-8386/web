<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Trạng thái VIP - TOOLTX2026 Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="../assets/js/pagination.js"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#3b82f6',success:'#10b981',danger:'#ef4444',warning:'#f59e0b'}}}}</script>
    <style>::-webkit-scrollbar{width:6px;height:6px}::-webkit-scrollbar-track{background:#f1f5f9}::-webkit-scrollbar-thumb{background:#cbd5e1;border-radius:4px}::-webkit-scrollbar-thumb:hover{background:#94a3b8}</style>
<script src="/assets/js/anti-devtools.js"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans">

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
            <h2 class="font-bold text-slate-800 text-base leading-tight">Trạng thái VIP</h2>
            <p class="text-xs text-slate-400 hidden sm:block">Quản lý thời hạn VIP của thành viên</p>
        </div>
    </header>
    <main class="flex-1 p-4 sm:p-6">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-5 border-b border-slate-100">
                <div>
                    <h3 class="font-bold text-slate-800">Danh sách thành viên</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Gia hạn hoặc thiết lập VIP trực tiếp</p>
                </div>
                <div class="relative">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    <input type="text" id="search-pkg" oninput="filterPkg()" placeholder="Tìm username..." class="pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-primary w-56">
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left min-w-[700px]">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                            <th class="px-5 py-3">Thành viên</th>
                            <th class="px-5 py-3">Số dư</th>
                            <th class="px-5 py-3">Trạng thái VIP</th>
                            <th class="px-5 py-3">Hết hạn</th>
                            <th class="px-5 py-3 text-center">Gia hạn nhanh</th>
                            <th class="px-5 py-3 text-center">Đặt ngày</th>
                        </tr>
                    </thead>
                    <tbody id="pkg-tbody" class="divide-y divide-slate-50 text-sm">
                        <tr><td colspan="6" class="py-10 text-center text-slate-400">Đang tải...</td></tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex items-center justify-between px-5 py-3 border-t border-slate-100">
                <p id="pkg-pg-info" class="text-xs text-slate-400"></p>
                <div id="pkg-pg" class="flex items-center gap-1"></div>
            </div>
        </div>
    </main>
</div>

<!-- VIP date modal -->
<div id="vip-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeVipModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
        <div class="w-full max-w-sm bg-white rounded-2xl p-6 pointer-events-auto shadow-2xl">
            <h3 class="font-bold text-slate-800 mb-1">Thiết lập VIP</h3>
            <p class="text-xs text-slate-400 mb-4">Tài khoản: <span id="vip-target" class="font-bold text-slate-700"></span></p>
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Ngày hết hạn</label>
            <input type="datetime-local" id="vip-date" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary mb-4">
            <div class="flex gap-2">
                <button onclick="saveVipDate()" class="flex-1 py-2.5 bg-primary text-white font-bold rounded-xl text-sm active:scale-95 transition-all">Lưu</button>
                <button onclick="closeVipModal()" class="py-2.5 px-4 bg-slate-100 text-slate-600 font-semibold rounded-xl text-sm">Hủy</button>
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
function formatMoney(n){return Number(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g,',');}

let allUsers=[], filteredUsers=[], vipTarget='';

async function extendVip(u,days){
    if(!await showConfirm(`Gia hạn VIP ${days} ngày cho "${u}"?`))return;
    try{
        const now=Date.now()/1000;
        const user=allUsers.find(x=>x.username===u);
        const cur=user&&user.vip_expire&&user.vip_expire>now?user.vip_expire:now;
        const newExp=Math.floor(cur+days*86400);
        const r=await fetch('../api/admin_users.php',{method:'POST',headers:{'Content-Type':'application/json','Authorization':`Bearer ${token}`},body:JSON.stringify({action:'update_vip',target_username:u,vip_expire:newExp})});
        const d=await r.json(); alert(d.message); if(d.success)fetchUsers();
    }catch(e){alert('Lỗi kết nối.');}
}

function openVipModal(u){
    vipTarget=u;
    document.getElementById('vip-target').innerText=u;
    const user=allUsers.find(x=>x.username===u);
    if(user&&user.vip_expire&&user.vip_expire>Date.now()/1000){
        const d=new Date(user.vip_expire*1000);
        d.setMinutes(d.getMinutes()-d.getTimezoneOffset());
        document.getElementById('vip-date').value=d.toISOString().slice(0,16);
    } else {
        document.getElementById('vip-date').value='';
    }
    document.getElementById('vip-modal').classList.remove('hidden');
}
function closeVipModal(){document.getElementById('vip-modal').classList.add('hidden');}
async function saveVipDate(){
    const val=document.getElementById('vip-date').value;
    if(!val){alert('Vui lòng chọn ngày hết hạn.');return;}
    const ts=Math.floor(new Date(val).getTime()/1000);
    try{
        const r=await fetch('../api/admin_users.php',{method:'POST',headers:{'Content-Type':'application/json','Authorization':`Bearer ${token}`},body:JSON.stringify({action:'update_vip',target_username:vipTarget,vip_expire:ts})});
        const d=await r.json(); alert(d.message); if(d.success){closeVipModal();fetchUsers();}
    }catch(e){alert('Lỗi kết nối.');}
}

function renderPkg(users){
    const tbody=document.getElementById('pkg-tbody');
    const now=Date.now()/1000;
    if(!users.length){tbody.innerHTML='<tr><td colspan="6" class="py-10 text-center text-slate-400 text-sm">Không có thành viên.</td></tr>';return;}
    tbody.innerHTML=users.map(u=>{
        const isVip=u.vip_expire&&u.vip_expire>now;
        const expDate=u.vip_expire&&u.vip_expire>0?new Date(u.vip_expire*1000).toLocaleDateString('vi'):'—';
        return `<tr class="hover:bg-slate-50 transition-colors">
            <td class="px-5 py-3.5"><p class="font-semibold text-slate-800">${u.username}</p><p class="text-[11px] text-slate-400">ID: ${u.user_id}</p></td>
            <td class="px-5 py-3.5 font-bold text-primary">${formatMoney(u.balance)}đ</td>
            <td class="px-5 py-3.5">${isVip?'<span class="inline-flex items-center gap-1 px-2.5 py-1 bg-purple-50 text-purple-600 rounded-lg text-[11px] font-bold"><i data-lucide="crown" class="w-3 h-3"></i>VIP Active</span>':'<span class="px-2.5 py-1 bg-slate-100 text-slate-400 rounded-lg text-[11px] font-medium">Thường</span>'}</td>
            <td class="px-5 py-3.5 text-sm text-slate-600">${expDate}</td>
            <td class="px-5 py-3.5">
                <div class="flex gap-1 justify-center">
                    <button onclick="extendVip('${u.username}',1)" class="px-2.5 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg text-[11px] font-bold active:scale-95 transition-all">+1 ngày</button>
                    <button onclick="extendVip('${u.username}',7)" class="px-2.5 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg text-[11px] font-bold active:scale-95 transition-all">+7 ngày</button>
                    <button onclick="extendVip('${u.username}',30)" class="px-2.5 py-1.5 bg-purple-50 hover:bg-purple-100 text-purple-600 rounded-lg text-[11px] font-bold active:scale-95 transition-all">+30 ngày</button>
                </div>
            </td>
            <td class="px-5 py-3.5 text-center"><button onclick="openVipModal('${u.username}')" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-[11px] font-semibold active:scale-95 transition-all flex items-center gap-1 mx-auto"><i data-lucide="calendar" class="w-3.5 h-3.5"></i>Đặt ngày</button></td>
        </tr>`;
    }).join('');
    lucide.createIcons();
}
function filterPkg(){const q=document.getElementById('search-pkg').value.toLowerCase();filteredUsers=allUsers.filter(u=>u.username.toLowerCase().includes(q));initPagination('pkg',{itemsPerPage:20,dataArray:filteredUsers,renderFn:renderPkg,containerId:'pkg-tbody',paginationId:'pkg-pg',infoId:'pkg-pg-info'});}
async function fetchUsers(){
    try{const r=await fetch('../api/admin_users.php',{headers:{'Authorization':`Bearer ${token}`}});const d=await r.json();if(d.success){allUsers=d.users;filteredUsers=[...allUsers];initPagination('pkg',{itemsPerPage:20,dataArray:filteredUsers,renderFn:renderPkg,containerId:'pkg-tbody',paginationId:'pkg-pg',infoId:'pkg-pg-info'});}}catch(e){console.error(e);}
}
fetchUsers();
</script>
</body>
</html>
