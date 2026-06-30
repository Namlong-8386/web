(function() {
    'use strict';

    // Chặn phím tắt DevTools & View Source
    document.addEventListener('keydown', function(e) {
        // F12
        if (e.key === 'F12') {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
        // Ctrl+Shift+I / Ctrl+Shift+J / Ctrl+Shift+C
        if ((e.ctrlKey || e.metaKey) && e.shiftKey && ['I','J','C'].includes(e.key)) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
        // Ctrl+U (View Source)
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'u') {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
    }, true);

    // Chặn chuột phải
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        return false;
    }, true);

    // Debugger trap: nếu DevTools mở, debugger sẽ dừng lạu lâu hơn
    function devtoolsTrap() {
        const threshold = 160;
        const widthThreshold = window.outerWidth - window.innerWidth > threshold;
        const heightThreshold = window.outerHeight - window.innerHeight > threshold;
        if (widthThreshold || heightThreshold) {
            document.body.innerHTML = '<h1 style="text-align:center;padding-top:40vh;font-family:sans-serif;">Truy cập bị từ chối.</h1>';
        }
    }
    window.addEventListener('resize', devtoolsTrap);
    setInterval(devtoolsTrap, 1000);

    // Bảo vệ console object khỏi bị ghi đè
    (function() {
        let c = console;
        if (!c) return;
        const methods = ['log', 'debug', 'info', 'warn', 'error', 'table', 'clear'];
        for (let m of methods) {
            c[m] = function() {};
        }
    })();

    // Detect debugger qua eval timing
    setInterval(function() {
        const start = performance.now();
        debugger;
        const end = performance.now();
        if (end - start > 100) {
            document.body.innerHTML = '<h1 style="text-align:center;padding-top:40vh;font-family:sans-serif;">Truy cập bị từ chối.</h1>';
        }
    }, 1500);
})();
