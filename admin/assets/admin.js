const api = 'ajax.php';

function setLoading(targetId, type = 'cards') {
  const target = typeof targetId === 'string' ? document.getElementById(targetId) : targetId;
  if (!target) return;
  target.setAttribute('aria-busy', 'true');
  const count = type === 'table' ? 5 : 6;
  const loading = `<div class="admin-loading" role="status" aria-label="Loading content"><span class="admin-loader"></span><span class="admin-loading-label">Loading...</span></div>`;
  const rows = Array.from({ length: count }, () => '<div class="admin-skeleton-row"></div>').join('');
  target.innerHTML = type === 'table'
    ? `<tr><td colspan="8">${loading}</td></tr><tr><td colspan="8">${rows}</td></tr>`
    : `${loading}${Array.from({ length: count }, () => '<div class="admin-skeleton-card"><span></span><span></span><span></span></div>').join('')}`;
}

function clearLoading(targetId) {
  const target = typeof targetId === 'string' ? document.getElementById(targetId) : targetId;
  target?.removeAttribute('aria-busy');
}

function paginateTableBody(targetId, pageSize = 8) {
  const tbody = typeof targetId === 'string' ? document.getElementById(targetId) : targetId;
  if (!tbody) return;
  const rows = [...tbody.querySelectorAll(':scope > tr')];
  const table = tbody.closest('table');
  if (!table) return;

  table.parentElement.querySelector(`.admin-pagination[data-for="${tbody.id}"]`)?.remove();
  table.parentElement.querySelector(`.admin-filter[data-for="${tbody.id}"]`)?.remove();
  let page = 1;
  let query = '';
  const filter = document.createElement('label');
  filter.className = 'admin-filter';
  filter.dataset.for = tbody.id;
  filter.innerHTML = `<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg><input type="search" placeholder="Search table..." aria-label="Search table"><span>${rows.length} records</span>`;
  const controls = document.createElement('div');
  controls.className = 'admin-pagination';
  controls.dataset.for = tbody.id;
  controls.innerHTML = `<span class="admin-pagination-info"></span><div class="admin-pagination-actions"><button type="button" data-page-action="prev" aria-label="Previous page">&#8592;</button><span class="admin-pagination-pages"></span><button type="button" data-page-action="next" aria-label="Next page">&#8594;</button></div>`;

  const render = () => {
    const filtered = rows.filter(row => row.textContent.toLowerCase().includes(query));
    const totalPages = Math.max(1, Math.ceil(filtered.length / pageSize));
    page = Math.min(page, totalPages);
    rows.forEach(row => { row.hidden = true; });
    filtered.slice((page - 1) * pageSize, page * pageSize).forEach(row => { row.hidden = false; });
    controls.querySelector('.admin-pagination-info').textContent = filtered.length ? `${(page - 1) * pageSize + 1}-${Math.min(page * pageSize, filtered.length)} of ${filtered.length}` : 'No matching records';
    controls.querySelector('[data-page-action="prev"]').disabled = page === 1;
    controls.querySelector('[data-page-action="next"]').disabled = page === totalPages;
    controls.querySelector('.admin-pagination-pages').textContent = `${page} / ${totalPages}`;
    filter.querySelector('span').textContent = `${filtered.length} records`;
  };

  controls.addEventListener('click', event => {
    const action = event.target.closest('button')?.dataset.pageAction;
    if (action === 'prev' && page > 1) page--;
    if (action === 'next') page++;
    render();
  });
  filter.querySelector('input').addEventListener('input', event => {
    query = event.target.value.trim().toLowerCase();
    page = 1;
    render();
  });
  table.parentElement.insertBefore(filter, table);
  table.parentElement.appendChild(controls);
  render();
}

function filterList(targetId, itemSelector = ':scope > *', pageSize = 8) {
  const target = typeof targetId === 'string' ? document.getElementById(targetId) : targetId;
  if (!target) return;
  const items = [...target.querySelectorAll(itemSelector)].filter(item => !item.classList.contains('admin-loading'));
  const host = target.parentElement;
  host.querySelector(`.admin-filter[data-for="${target.id}"]`)?.remove();
  host.querySelector(`.admin-pagination[data-for="${target.id}"]`)?.remove();
  let page = 1;
  let query = '';
  const filter = document.createElement('label');
  filter.className = 'admin-filter admin-list-filter';
  filter.dataset.for = target.id;
  filter.innerHTML = `<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg><input type="search" placeholder="Search list..." aria-label="Search list"><span>${items.length} items</span>`;
  const controls = document.createElement('div');
  controls.className = 'admin-pagination';
  controls.dataset.for = target.id;
  controls.innerHTML = `<span class="admin-pagination-info"></span><div class="admin-pagination-actions"><button type="button" data-page-action="prev" aria-label="Previous page">&#8592;</button><span class="admin-pagination-pages"></span><button type="button" data-page-action="next" aria-label="Next page">&#8594;</button></div>`;
  const render = () => {
    const filtered = items.filter(item => item.textContent.toLowerCase().includes(query));
    const totalPages = Math.max(1, Math.ceil(filtered.length / pageSize));
    page = Math.min(page, totalPages);
    items.forEach(item => { item.hidden = true; });
    filtered.slice((page - 1) * pageSize, page * pageSize).forEach(item => { item.hidden = false; });
    filter.querySelector('span').textContent = `${filtered.length} items`;
    controls.querySelector('.admin-pagination-info').textContent = filtered.length ? `${(page - 1) * pageSize + 1}-${Math.min(page * pageSize, filtered.length)} of ${filtered.length}` : 'No matching items';
    controls.querySelector('[data-page-action="prev"]').disabled = page === 1;
    controls.querySelector('[data-page-action="next"]').disabled = page === totalPages;
    controls.querySelector('.admin-pagination-pages').textContent = `${page} / ${totalPages}`;
    controls.hidden = filtered.length <= pageSize;
  };
  filter.querySelector('input').addEventListener('input', event => {
    query = event.target.value.trim().toLowerCase();
    page = 1;
    render();
  });
  controls.addEventListener('click', event => {
    const action = event.target.closest('button')?.dataset.pageAction;
    if (action === 'prev' && page > 1) page--;
    if (action === 'next') page++;
    render();
  });
  host.insertBefore(filter, target);
  host.appendChild(controls);
  render();
}

async function request(module, action = 'list', body = null) {
  const options = body
    ? { method: 'POST', body }
    : {};
  const url = body ? api : `${api}?module=${module}&action=${action}`;
  const response = await fetch(url, options);
  const json = await response.json();
  if (!json.ok) throw new Error(json.message || 'Request failed');
  return json;
}

function setMessage(text, type = 'success') {
  const box = document.getElementById('adminMessage');
  if (!box) return;
  box.className = `mb-5 rounded-lg border px-4 py-3 ${type === 'error' ? 'bg-red-50 border-red-200 text-red-700' : 'bg-emerald-50 border-emerald-200 text-emerald-800'}`;
  box.textContent = text;
  box.hidden = false;
  setTimeout(() => { box.hidden = true; }, 2500);
}

function html(value) {
  return String(value || '').replace(/[&<>"']/g, (char) => ({
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  }[char]));
}

function bindAjaxForm(formId, module, afterSave) {
  const form = document.getElementById(formId);
  if (!form) return;
  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    const body = new FormData(form);
    body.append('module', module);
    body.append('action', 'save');
    try {
      await request(module, 'save', body);
      form.reset();
      setMessage('Saved successfully.');
      afterSave();
    } catch (error) {
      setMessage(error.message, 'error');
    }
  });
}

async function deleteItem(module, data, afterDelete) {
  if (!confirm('Delete this item?')) return;
  const body = new FormData();
  body.append('module', module);
  body.append('action', 'delete');
  Object.entries(data).forEach(([key, value]) => body.append(key, value));
  try {
    await request(module, 'delete', body);
    setMessage('Deleted successfully.');
    afterDelete();
  } catch (error) {
    setMessage(error.message, 'error');
  }
}

// Keep the helpers available to the small inline page controllers used by the
// PHP admin screens, even when a browser scopes this file as a module.
window.setLoading = setLoading;
window.clearLoading = clearLoading;
window.request = request;
window.setMessage = setMessage;
window.html = html;
window.bindAjaxForm = bindAjaxForm;
window.deleteItem = deleteItem;
window.paginateTableBody = paginateTableBody;
window.filterList = filterList;
