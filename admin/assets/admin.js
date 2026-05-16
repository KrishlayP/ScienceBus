const api = 'ajax.php';

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
