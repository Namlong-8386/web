<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Thanh Toán - TOOLTX2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#3b82f6' } } } }</script>
    <style>
        body { -webkit-user-select: none; user-select: none; -webkit-tap-highlight-color: transparent; }
        ::-webkit-scrollbar { display: none; }

        @keyframes shimmer {
            0% { background-position: -400px 0; }
            100% { background-position: 400px 0; }
        }
        .skeleton {
            background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
            background-size: 800px 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 12px;
        }

        @keyframes pulse-ring {
            0% { transform: scale(1); opacity: 0.6; }
            50% { transform: scale(1.08); opacity: 0.2; }
            100% { transform: scale(1); opacity: 0.6; }
        }
        .pulse-ring { animation: pulse-ring 2s ease-in-out infinite; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }

        .qr-glow {
            box-shadow: 0 0 0 4px rgba(59,130,246,0.15), 0 20px 60px rgba(59,130,246,0.2);
        }

        @keyframes borderGlow {
            0%, 100% { border-color: rgba(59,130,246,0.4); }
            50% { border-color: rgba(59,130,246,0.9); }
        }
        .border-glow { animation: borderGlow 2s ease-in-out infinite; }

        @keyframes spin { to { transform: rotate(360deg); } }
        .spin { animation: spin 1s linear infinite; }

        /* Step 3 overlay */
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(.85); }
            to   { opacity: 1; transform: scale(1); }
        }
        .scale-in { animation: scaleIn 0.4s cubic-bezier(.34,1.56,.64,1) forwards; }

        /* Ripple success */
        @keyframes ripple {
            0%   { transform: scale(1);   opacity: .6; }
            100% { transform: scale(2.4); opacity: 0;  }
        }
        .ripple { animation: ripple 1.4s ease-out infinite; }

        .copy-btn:active { transform: scale(.9); }

        .countdown-ring { transition: stroke-dashoffset 1s linear; }

        @keyframes checkDraw {
            from { stroke-dashoffset: 60; }
            to   { stroke-dashoffset: 0; }
        }
        .check-draw {
            stroke-dasharray: 60;
            stroke-dashoffset: 60;
            animation: checkDraw .5s ease-out .2s forwards;
        }
    </style>
<script src="/assets/js/anti-devtools.js"></script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="bg-white shadow-sm sticky top-0 z-40 border-b border-slate-100">
        <div class="flex items-center justify-between h-14 px-4">
            <a href="/deposit" class="w-8 h-8 flex items-center justify-center text-slate-500 active:bg-slate-100 rounded-full transition-colors">
                <i data-lucide="chevron-left" class="w-6 h-6"></i>
            </a>
            <h1 class="text-xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-800 absolute left-1/2 -translate-x-1/2">
                TOOLTX2026
            </h1>
            <div class="w-8"></div>
        </div>
    </header>

    <!-- STEP 2 — PAYMENT VIEW -->
    <div id="view-payment" class="flex-grow flex flex-col">
        <main class="flex-grow p-4 pb-10 max-w-lg mx-auto w-full">

            <!-- Step indicator -->
            <div class="flex items-center gap-2 mb-5 fade-in-up">
                <div class="flex items-center gap-1.5">
                    <div class="w-6 h-6 rounded-full bg-emerald-500 flex items-center justify-center">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-white"></i>
                    </div>
                    <span class="text-xs font-semibold text-emerald-600">Tạo lệnh</span>
                </div>
                <div class="flex-1 h-0.5 bg-gradient-to-r from-emerald-400 to-primary rounded-full"></div>
                <div class="flex items-center gap-1.5">
                    <div class="w-6 h-6 rounded-full bg-primary flex items-center justify-center">
                        <span class="text-white text-[10px] font-bold">2</span>
                    </div>
                    <span class="text-xs font-semibold text-primary">Thanh toán</span>
                </div>
                <div class="flex-1 h-0.5 bg-slate-200 rounded-full"></div>
                <div class="flex items-center gap-1.5">
                    <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center">
                        <span class="text-slate-400 text-[10px] font-bold">3</span>
                    </div>
                    <span class="text-xs font-medium text-slate-400">Xác nhận</span>
                </div>
            </div>

            <!-- Timer + title -->
            <div class="text-center mb-5 fade-in-up" style="animation-delay:.05s">
                <div class="inline-flex items-center gap-2 bg-amber-50 border border-amber-200 rounded-full px-4 py-1.5 mb-3">
                    <svg id="timer-svg" width="20" height="20" viewBox="0 0 36 36" class="-rotate-90">
                        <circle cx="18" cy="18" r="15" fill="none" stroke="#fde68a" stroke-width="3"/>
                        <circle id="timer-ring" cx="18" cy="18" r="15" fill="none" stroke="#f59e0b" stroke-width="3"
                            stroke-dasharray="94.2" stroke-dashoffset="0" class="countdown-ring"/>
                    </svg>
                    <span class="text-sm font-bold text-amber-700">Còn <span id="timer-display">15:00</span></span>
                </div>
                <h2 class="text-lg font-bold text-slate-800">Chuyển khoản để nạp tiền</h2>
                <p class="text-xs text-slate-500 mt-1">Chuyển đúng <strong>nội dung</strong> — hệ thống tự duyệt khi nhận được tiền</p>
            </div>

            <!-- Polling status bar -->
            <div id="polling-bar" class="flex items-center gap-2 bg-blue-50 border border-blue-100 rounded-2xl px-4 py-2.5 mb-4 fade-in-up" style="animation-delay:.08s">
                <svg class="spin w-4 h-4 text-primary flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                </svg>
                <p class="text-xs text-primary font-medium">Đang chờ xác nhận thanh toán...</p>
            </div>

            <!-- QR + Bank card (layout gốc) -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-xl mb-4 fade-in-up qr-glow" style="animation-delay:0.1s">

                <!-- Bank header -->
                <div class="bg-gradient-to-r from-[#003087] to-[#0055b3] px-5 py-3 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm">
                        <svg width="28" height="16" viewBox="0 0 90 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <text x="2" y="30" font-family="Arial Black, sans-serif" font-size="28" font-weight="900" fill="#003087">MB</text>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-black text-sm tracking-wide">MBBANK</p>
                        <p class="text-blue-200 text-[10px]">Military Commercial Joint Stock Bank</p>
                    </div>
                    <div class="ml-auto flex items-center gap-1 bg-emerald-400/20 border border-emerald-400/40 rounded-full px-2.5 py-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse inline-block"></span>
                        <span class="text-emerald-300 text-[10px] font-semibold">Hoạt động</span>
                    </div>
                </div>

                <!-- QR Image area -->
                <div class="flex flex-col items-center px-6 py-5">
                    <div class="relative">
                        <!-- Animated corner accents -->
                        <div class="absolute -top-1 -left-1 w-6 h-6 border-t-[3px] border-l-[3px] border-primary rounded-tl-lg border-glow"></div>
                        <div class="absolute -top-1 -right-1 w-6 h-6 border-t-[3px] border-r-[3px] border-primary rounded-tr-lg border-glow"></div>
                        <div class="absolute -bottom-1 -left-1 w-6 h-6 border-b-[3px] border-l-[3px] border-primary rounded-bl-lg border-glow"></div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 border-b-[3px] border-r-[3px] border-primary rounded-br-lg border-glow"></div>
                        <!-- Pulse ring -->
                        <div class="absolute inset-0 rounded-2xl bg-primary/5 pulse-ring"></div>
                        <!-- Skeleton + image -->
                        <div id="qr-skeleton" class="skeleton w-52 h-52 rounded-2xl"></div>
                        <img id="qr-image" src="" alt="VietQR" class="hidden w-52 h-52 rounded-2xl object-contain" onload="onQRLoaded()" onerror="onQRError()">
                    </div>
                    <div class="mt-3 flex items-center gap-1.5 text-xs text-slate-400">
                        <img src="https://img.vietqr.io/image/vietqr_logo.png" alt="VietQR" class="h-4" onerror="this.style.display='none'">
                        <span>Powered by VietQR</span>
                    </div>
                    <button id="btn-download-qr" onclick="downloadQR()" class="mt-3 hidden flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 active:scale-95 text-slate-600 text-xs font-semibold px-4 py-2 rounded-xl transition-all">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i>
                        Tải mã QR
                    </button>
                </div>

                <!-- Divider -->
                <div class="flex items-center gap-3 px-5 mb-4">
                    <div class="flex-1 h-px bg-slate-100"></div>
                    <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Thông tin chuyển khoản</span>
                    <div class="flex-1 h-px bg-slate-100"></div>
                </div>

                <!-- Bank info rows -->
                <div class="px-5 pb-5 space-y-3">

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                            <i data-lucide="landmark" class="w-3.5 h-3.5 text-slate-400"></i>
                            Ngân Hàng
                        </span>
                        <span class="text-sm font-bold text-slate-800">MBBANK</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                            <i data-lucide="user-check" class="w-3.5 h-3.5 text-slate-400"></i>
                            Người Nhận
                        </span>
                        <span class="text-sm font-bold text-slate-800">HO KHANH NAM</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                            <i data-lucide="credit-card" class="w-3.5 h-3.5 text-slate-400"></i>
                            Số Tài Khoản
                        </span>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold text-slate-800 font-mono tracking-wide">0984705329</span>
                            <button onclick="copyText('0984705329', this)" class="copy-btn w-7 h-7 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center transition-colors">
                                <i data-lucide="copy" class="w-3.5 h-3.5 text-primary"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between bg-blue-50 rounded-2xl px-4 py-3 -mx-1">
                        <span class="text-xs text-primary font-semibold flex items-center gap-1.5">
                            <i data-lucide="banknote" class="w-3.5 h-3.5"></i>
                            Số Tiền
                        </span>
                        <span id="display-amount" class="text-base font-black text-primary">—</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                            <i data-lucide="message-square" class="w-3.5 h-3.5 text-slate-400"></i>
                            Nội Dung CK
                        </span>
                        <div class="flex items-center gap-2">
                            <span id="display-content" class="text-sm font-bold text-slate-800 font-mono">—</span>
                            <button onclick="copyText(document.getElementById('display-content').innerText, this)" class="copy-btn w-7 h-7 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center transition-colors">
                                <i data-lucide="copy" class="w-3.5 h-3.5 text-primary"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Notice -->
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-4 fade-in-up" style="animation-delay:.15s">
                <div class="flex gap-3">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5"></i>
                    <div class="text-xs text-amber-800 leading-relaxed space-y-1">
                        <p class="font-bold">Lưu ý:</p>
                        <p>• Nhập <strong>đúng nội dung</strong> để hệ thống nhận diện tự động.</p>
                        <p>• Giao dịch được duyệt trong <strong>5–15 phút</strong> sau khi chuyển.</p>
                        <p>• Trang này tự động cập nhật, <strong>không cần tải lại</strong>.</p>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="grid grid-cols-2 gap-3 fade-in-up" style="animation-delay:.2s">
                <a href="/history" class="flex items-center justify-center gap-2 bg-white border border-slate-200 text-slate-700 font-semibold py-3.5 rounded-2xl shadow-sm active:scale-[0.97] transition-transform text-sm">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                    Lịch sử
                </a>
                <a href="/support" class="flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-blue-600 text-white font-semibold py-3.5 rounded-2xl shadow-lg shadow-blue-500/25 active:scale-[0.97] transition-transform text-sm">
                    <i data-lucide="headphones" class="w-4 h-4"></i>
                    Hỗ trợ
                </a>
            </div>

        </main>
    </div>

    <!-- STEP 3 — RESULT VIEW (hidden initially) -->
    <div id="view-result" class="hidden fixed inset-0 bg-slate-100 flex flex-col items-center justify-center p-6 z-50">
        <div class="w-full max-w-sm">

            <!-- Result card -->
            <div id="result-card" class="bg-white rounded-3xl shadow-2xl overflow-hidden scale-in">

                <!-- Result header -->
                <div id="result-header" class="px-6 pt-8 pb-6 flex flex-col items-center">
                    <!-- Icon with ripple -->
                    <div class="relative w-24 h-24 flex items-center justify-center mb-5">
                        <div id="result-ripple1" class="absolute inset-0 rounded-full ripple"></div>
                        <div id="result-ripple2" class="absolute inset-0 rounded-full ripple" style="animation-delay:.5s"></div>
                        <div id="result-icon-wrap" class="relative w-20 h-20 rounded-full flex items-center justify-center shadow-lg">
                            <!-- SVG check/x drawn inline for animation -->
                            <svg id="result-svg-check" class="hidden w-10 h-10" viewBox="0 0 40 40" fill="none">
                                <polyline class="check-draw" points="8,20 17,29 32,12" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <svg id="result-svg-x" class="hidden w-10 h-10" viewBox="0 0 40 40" fill="none">
                                <line x1="12" y1="12" x2="28" y2="28" stroke="white" stroke-width="4" stroke-linecap="round"/>
                                <line x1="28" y1="12" x2="12" y2="28" stroke="white" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>

                    <h2 id="result-title" class="text-xl font-black text-slate-800 mb-1">—</h2>
                    <p id="result-msg" class="text-sm text-slate-500 text-center px-2">—</p>
                </div>

                <!-- Step indicator (completed) -->
                <div class="flex items-center gap-2 px-6 py-3 bg-slate-50 border-t border-slate-100">
                    <div class="flex items-center gap-1.5">
                        <div class="w-5 h-5 rounded-full bg-emerald-500 flex items-center justify-center">
                            <i data-lucide="check" class="w-3 h-3 text-white"></i>
                        </div>
                        <span class="text-[10px] font-semibold text-emerald-600">Tạo lệnh</span>
                    </div>
                    <div class="flex-1 h-0.5 bg-emerald-400 rounded-full"></div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-5 h-5 rounded-full bg-emerald-500 flex items-center justify-center">
                            <i data-lucide="check" class="w-3 h-3 text-white"></i>
                        </div>
                        <span class="text-[10px] font-semibold text-emerald-600">Thanh toán</span>
                    </div>
                    <div id="step3-line" class="flex-1 h-0.5 rounded-full"></div>
                    <div class="flex items-center gap-1.5">
                        <div id="step3-dot" class="w-5 h-5 rounded-full flex items-center justify-center">
                            <i id="step3-icon" data-lucide="check" class="w-3 h-3 text-white"></i>
                        </div>
                        <span id="step3-label" class="text-[10px] font-semibold">Xác nhận</span>
                    </div>
                </div>

                <!-- Amount + detail -->
                <div class="px-6 py-4 border-t border-slate-100 space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-400">Số tiền</span>
                        <span id="result-amount" class="text-sm font-bold text-slate-800">—</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-400">Mã giao dịch</span>
                        <span id="result-txid" class="text-xs font-mono text-slate-600">—</span>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="px-6 pb-6 pt-2 space-y-3">
                    <a href="/deposit" id="result-btn-retry" class="hidden w-full flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-blue-600 text-white font-bold py-3.5 rounded-2xl shadow shadow-blue-500/25 active:scale-[0.97] transition-transform text-sm">
                        <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                        Nạp tiền lại
                    </a>
                    <a href="/" id="result-btn-home" class="w-full flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3.5 rounded-2xl active:scale-[0.97] transition-transform text-sm">
                        <i data-lucide="home" class="w-4 h-4"></i>
                        Về trang chủ
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[60] pointer-events-none">
        <div id="toast-inner" class="hidden bg-slate-800/95 text-white text-sm font-medium px-5 py-3 rounded-2xl shadow-xl flex items-center gap-2 backdrop-blur-sm">
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
            <span id="toast-msg">Đã sao chép!</span>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const params  = new URLSearchParams(window.location.search);
        const txId    = params.get('tx')     || '';
        const amount  = parseInt(params.get('amount') || '0');
        const uid     = params.get('uid')    || '';
        const method  = params.get('method') || 'bank';
        const token   = localStorage.getItem('token') || '';

        function formatMoney(n) {
            return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ' VNĐ';
        }

        /* ── Init page data ───────────────────────────────────────── */
        document.getElementById('display-amount').innerText  = amount ? formatMoney(amount) : '—';
        document.getElementById('display-content').innerText = uid    || '—';

        /* ── Copy ────────────────────────────────────────────────── */
        function copyText(text, btn) {
            if (!text || text === '—') return;
            const doCopy = () => {
                const origHTML = btn.innerHTML;
                btn.innerHTML = '<svg class="w-3.5 h-3.5 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>';
                btn.classList.replace('bg-blue-50','bg-emerald-50');
                showToast('Đã sao chép!');
                setTimeout(() => { btn.innerHTML = origHTML; btn.classList.replace('bg-emerald-50','bg-blue-50'); lucide.createIcons(); }, 2000);
            };
            navigator.clipboard.writeText(text).then(doCopy).catch(() => {
                const ta = document.createElement('textarea');
                ta.value = text; ta.style.cssText = 'position:fixed;opacity:0';
                document.body.appendChild(ta); ta.select(); document.execCommand('copy');
                document.body.removeChild(ta); doCopy();
            });
        }

        let toastTimer;
        function showToast(msg) {
            clearTimeout(toastTimer);
            const inner = document.getElementById('toast-inner');
            document.getElementById('toast-msg').innerText = msg;
            inner.classList.remove('hidden');
            toastTimer = setTimeout(() => { inner.classList.add('hidden'); }, 2400);
        }

        /* ── Countdown 15 min ────────────────────────────────────── */
        let totalSeconds = 15 * 60;
        const circumference = 2 * Math.PI * 15; // ≈94.25
        const ring = document.getElementById('timer-ring');
        ring.setAttribute('stroke-dasharray', circumference);

        function updateTimer() {
            const m = Math.floor(totalSeconds / 60);
            const s = totalSeconds % 60;
            document.getElementById('timer-display').innerText =
                String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0');
            const offset = circumference * (1 - totalSeconds / (15 * 60));
            ring.style.strokeDashoffset = offset;
            if (totalSeconds <= 60) {
                ring.setAttribute('stroke','#ef4444');
            }
            if (totalSeconds <= 0) {
                clearInterval(timerInterval);
                document.getElementById('timer-display').innerText = 'Hết hạn';
            }
            totalSeconds--;
        }
        updateTimer();
        const timerInterval = setInterval(updateTimer, 1000);

        /* ── QR image ────────────────────────────────────────────── */
        function buildQRUrl(amt, desc) {
            return `https://img.vietqr.io/image/970422-0984705329-qr_only.png?amount=${amt}&addInfo=${encodeURIComponent(desc)}&accountName=${encodeURIComponent('HO KHANH NAM')}`;
        }
        function onQRLoaded() {
            document.getElementById('qr-skeleton').classList.add('hidden');
            const img = document.getElementById('qr-image');
            img.classList.remove('hidden');
            document.getElementById('btn-download-qr').classList.remove('hidden');
            lucide.createIcons();
        }

        async function downloadQR() {
            const btn = document.getElementById('btn-download-qr');
            const img = document.getElementById('qr-image');
            if (!img || !img.src) return;

            btn.innerHTML = '<svg class="animate-spin w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/></svg> Đang tải...';
            btn.disabled = true;

            try {
                const res = await fetch(img.src);
                const blob = await res.blob();
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `QR_NapTien_${uid || 'TOOLTX'}.png`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
                showToast('Đã tải mã QR!');
            } catch (e) {
                showToast('Không tải được, thử lưu ảnh thủ công.');
            } finally {
                btn.innerHTML = '<i data-lucide="download" class="w-3.5 h-3.5"></i> Tải mã QR';
                btn.disabled = false;
                lucide.createIcons();
            }
        }
        function onQRError() {
            document.getElementById('qr-skeleton').innerHTML = '<div class="w-52 h-52 rounded-2xl bg-rose-50 flex flex-col items-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg><p class="text-xs text-rose-500 font-medium px-4 text-center">Không tải được QR.<br>Vui lòng thử lại.</p></div>';
        }
        if (uid && amount) {
            document.getElementById('qr-image').src = buildQRUrl(amount, uid);
        }

        /* ── Polling ─────────────────────────────────────────────── */
        let pollInterval = null;

        async function checkStatus() {
            if (!txId || !token) return;

            try {
                const res  = await fetch(`/api/payment_qr?tx=${encodeURIComponent(txId)}`,
                    { headers: { 'Authorization': `Bearer ${token}` } });
                const data = await res.json();
                if (!data.success) return;

                const status = data.status || '';

                if (status === 'Thành công') {
                    stopPolling();
                    showResult('success');
                } else if (status === 'Từ chối') {
                    stopPolling();
                    showResult('rejected');
                }
                // 'Chờ duyệt' → keep polling
            } catch (e) {
                // network error, keep trying
            }
        }

        function stopPolling() {
            clearInterval(pollInterval);
            clearInterval(timerInterval);
        }

        function showResult(type) {
            const isSuccess = type === 'success';

            /* ── Step indicator ── */
            const dot   = document.getElementById('step3-dot');
            const icon  = document.getElementById('step3-icon');
            const label = document.getElementById('step3-label');
            const line  = document.getElementById('step3-line');

            if (isSuccess) {
                dot.className   = 'w-5 h-5 rounded-full flex items-center justify-center bg-emerald-500';
                label.className = 'text-[10px] font-semibold text-emerald-600';
                label.innerText = 'Xác nhận';
                line.classList.add('bg-emerald-400');
            } else {
                dot.className   = 'w-5 h-5 rounded-full flex items-center justify-center bg-rose-500';
                label.className = 'text-[10px] font-semibold text-rose-600';
                label.innerText = 'Từ chối';
                line.classList.add('bg-rose-300');
            }

            /* ── Icon / colors ── */
            const wrap = document.getElementById('result-icon-wrap');
            const r1   = document.getElementById('result-ripple1');
            const r2   = document.getElementById('result-ripple2');

            if (isSuccess) {
                wrap.className = 'relative w-20 h-20 rounded-full flex items-center justify-center shadow-lg bg-emerald-500';
                r1.className   = 'absolute inset-0 rounded-full ripple bg-emerald-300/40';
                r2.className   = 'absolute inset-0 rounded-full ripple bg-emerald-300/30';
                document.getElementById('result-svg-check').classList.remove('hidden');
                document.getElementById('result-title').innerText = 'Thanh toán thành công!';
                document.getElementById('result-title').className  = 'text-xl font-black text-emerald-600 mb-1';
                document.getElementById('result-msg').innerText   = 'Số dư của bạn đã được cộng tiền. Cảm ơn bạn đã nạp tiền!';
            } else {
                wrap.className = 'relative w-20 h-20 rounded-full flex items-center justify-center shadow-lg bg-rose-500';
                r1.className   = 'absolute inset-0 rounded-full ripple bg-rose-300/40';
                r2.className   = 'absolute inset-0 rounded-full ripple bg-rose-300/30';
                document.getElementById('result-svg-x').classList.remove('hidden');
                document.getElementById('result-title').innerText = 'Giao dịch bị từ chối';
                document.getElementById('result-title').className  = 'text-xl font-black text-rose-600 mb-1';
                document.getElementById('result-msg').innerText   = 'Giao dịch của bạn đã bị quản trị viên từ chối. Vui lòng liên hệ hỗ trợ nếu cần.';
                document.getElementById('result-btn-retry').classList.remove('hidden');
            }

            document.getElementById('result-amount').innerText = amount ? formatMoney(amount) : '—';
            document.getElementById('result-txid').innerText   = txId || '—';

            /* ── Show step 3 view ── */
            const view = document.getElementById('view-result');
            view.classList.remove('hidden');
            lucide.createIcons();
        }

        /* Start polling immediately and then every 1 second */
        if (txId && token) {
            checkStatus();
            pollInterval = setInterval(checkStatus, 1000);
        }
    </script>
</body>
</html>
