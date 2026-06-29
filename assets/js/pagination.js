/**
 * Pagination helper for TOOLTX2026 admin & user pages
 * Multi-instance safe.
 * Usage: initPagination('uniqueId', { itemsPerPage: 20, dataArray: allData, renderFn, containerId, paginationId, infoId })
 */
const Pagination = {
  instances: {},
  defaults: { itemsPerPage: 20, currentPage: 1 },

  init(id, cfg) {
    const inst = { ...this.defaults, ...cfg, id, currentPage: 1 };
    this.instances[id] = inst;
    this.refresh(id);
    return inst;
  },

  go(id, page) {
    const inst = this.instances[id];
    if (!inst) return;
    const totalPages = Math.ceil(inst.dataArray.length / inst.itemsPerPage) || 1;
    if (page < 1 || page > totalPages) return;
    inst.currentPage = page;
    this.refresh(id);
  },

  refresh(id) {
    const inst = this.instances[id];
    if (!inst) return;
    const { dataArray, itemsPerPage, currentPage, renderFn, containerId } = inst;
    const total = dataArray.length;
    const totalPages = Math.ceil(total / itemsPerPage) || 1;
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const pageData = dataArray.slice(start, end);

    renderFn(pageData);
    this.renderControls(id, total, totalPages);
    this.renderInfo(id, total, start, Math.min(end, total));

    const tbl = document.getElementById(containerId);
    if (tbl) tbl.scrollIntoView({ behavior: 'smooth', block: 'start' });
  },

  renderControls(id, total, totalPages) {
    const inst = this.instances[id];
    const el = document.getElementById(inst.paginationId);
    if (!el) return;
    if (total === 0) { el.innerHTML = ''; return; }

    let cp = inst.currentPage;
    let html = '';

    // Prev
    html += `<button onclick="Pagination.go('${id}', ${cp - 1})" class="w-8 h-8 flex items-center justify-center rounded-lg ${cp === 1 ? 'text-slate-300 cursor-not-allowed' : 'text-slate-600 hover:bg-slate-200 active:bg-slate-300'} transition-colors" ${cp === 1 ? 'disabled' : ''}><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg></button>`;

    const maxV = 5;
    let sp = Math.max(1, cp - Math.floor(maxV / 2));
    let ep = Math.min(totalPages, sp + maxV - 1);
    if (ep - sp + 1 < maxV) sp = Math.max(1, ep - maxV + 1);

    if (sp > 1) {
      html += `<button onclick="Pagination.go('${id}', 1)" class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-200 transition-colors">1</button>`;
      if (sp > 2) html += `<span class="w-8 h-8 flex items-center justify-center text-xs text-slate-400">\u2026</span>`;
    }
    for (let i = sp; i <= ep; i++) {
      const active = i === cp;
      html += `<button onclick="Pagination.go('${id}', ${i})" class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-semibold ${active ? 'bg-primary text-white' : 'text-slate-600 hover:bg-slate-200'} transition-colors">${i}</button>`;
    }
    if (ep < totalPages) {
      if (ep < totalPages - 1) html += `<span class="w-8 h-8 flex items-center justify-center text-xs text-slate-400">\u2026</span>`;
      html += `<button onclick="Pagination.go('${id}', ${totalPages})" class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-200 transition-colors">${totalPages}</button>`;
    }

    // Next
    html += `<button onclick="Pagination.go('${id}', ${cp + 1})" class="w-8 h-8 flex items-center justify-center rounded-lg ${cp === totalPages ? 'text-slate-300 cursor-not-allowed' : 'text-slate-600 hover:bg-slate-200 active:bg-slate-300'} transition-colors" ${cp === totalPages ? 'disabled' : ''}><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg></button>`;

    el.innerHTML = html;
  },

  renderInfo(id, total, start, end) {
    const inst = this.instances[id];
    const el = document.getElementById(inst.infoId);
    if (!el) return;
    if (total === 0) { el.innerText = 'Kh\u00f4ng c\u00f3 d\u1eef li\u1ec7u'; return; }
    el.innerText = `Hi\u1ec3n th\u1ecb ${start + 1}-${end} / ${total}`;
  }
};

function initPagination(id, cfg) {
  return Pagination.init(id, cfg);
}
