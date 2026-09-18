<?php
require_once __DIR__ . '/_layout.php';
$impact = load_social_impact_data();
admin_header('Social Impact');
?>
<div class="grid gap-5 xl:grid-cols-[380px_minmax(0,1fr)]">
    <form id="impactForm" class="admin-surface rounded-2xl border bg-white p-5 shadow-sm">
        <input type="hidden" name="id" id="impactId">
        <div class="mb-4">
            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Website Testimonials</p>
            <h2 class="text-lg font-bold text-slate-900">Add Social Impact</h2>
            <p class="mt-1 text-sm text-slate-500">This appears in the News page "What People Are Saying" slider.</p>
        </div>

        <label class="block text-sm font-medium">Username</label>
        <input name="username" id="impactUsername" class="mb-4 mt-1 w-full rounded-lg border px-3 py-2" placeholder="User name">

        <label class="block text-sm font-medium">Description</label>
        <textarea name="description" id="impactDescription" rows="6" class="mb-4 mt-1 w-full rounded-lg border px-3 py-2" placeholder="What people are saying"></textarea>

        <label class="block text-sm font-medium">Rating</label>
        <select name="rating" id="impactRating" class="mb-5 mt-1 w-full rounded-lg border px-3 py-2">
            <option value="5">5 Stars</option>
            <option value="4">4 Stars</option>
            <option value="3">3 Stars</option>
            <option value="2">2 Stars</option>
            <option value="1">1 Star</option>
        </select>

        <div class="flex gap-2">
            <button class="admin-action bg-slate-950 px-5 py-2.5 text-sm text-white hover:bg-slate-800">Save</button>
            <button type="button" id="impactReset" class="admin-action rounded-lg border px-5 py-2.5 text-sm text-slate-700">Clear</button>
        </div>
    </form>

    <section class="admin-surface rounded-2xl border bg-white p-5 shadow-sm">
        <div class="mb-4 flex items-center justify-between border-b pb-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Table Rows</p>
                <h2 class="text-lg font-bold text-slate-900">Testimonials</h2>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] text-left text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="w-16 px-4 py-3">S.No</th>
                        <th class="w-44 px-4 py-3">Username</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="w-36 px-4 py-3">Rating</th>
                        <th class="w-44 px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody id="impactRows" class="divide-y"></tbody>
            </table>
        </div>
    </section>
</div>

<script>
const initialImpact = <?= json_encode($impact['testimonials'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
const canDeleteImpact = <?= is_super_admin() ? 'true' : 'false' ?>;
let currentImpactRows = initialImpact;

function ratingStars(rating) {
  const value = Math.max(1, Math.min(5, Number(rating) || 5));
  return '<span class="text-amber-400">' + '&#9733;'.repeat(value) + '</span><span class="text-slate-300">' + '&#9734;'.repeat(5 - value) + '</span>';
}

function resetImpactForm() {
  document.getElementById('impactForm').reset();
  document.getElementById('impactId').value = '';
}

function editImpact(item) {
  document.getElementById('impactId').value = item.id || '';
  document.getElementById('impactUsername').value = item.username || '';
  document.getElementById('impactDescription').value = item.description || '';
  document.getElementById('impactRating').value = item.rating || 5;
  document.getElementById('impactForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function editImpactByIndex(index) {
  editImpact(currentImpactRows[index] || {});
}

function renderImpact(rows) {
  currentImpactRows = rows || [];
  document.getElementById('impactRows').innerHTML = (rows || []).map((item, index) => `
    <tr class="align-top">
      <td class="px-4 py-4 font-semibold text-slate-700">${index + 1}</td>
      <td class="px-4 py-4 font-semibold text-slate-900">${html(item.username)}</td>
      <td class="px-4 py-4 leading-6 text-slate-600">${html(item.description)}</td>
      <td class="px-4 py-4 text-lg">${ratingStars(item.rating)}</td>
      <td class="px-4 py-4">
        <div class="flex gap-2">
          <button class="admin-action rounded-lg bg-slate-900 px-3 py-2 text-sm text-white" onclick="editImpactByIndex(${index})">Edit</button>
          ${canDeleteImpact ? `<button class="admin-action rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700" onclick="deleteItem('social_impact',{id:'${html(item.id)}'},loadImpact)">Delete</button>` : ''}
        </div>
      </td>
    </tr>
  `).join('');
  paginateTableBody('impactRows');
}

async function loadImpact() {
  setLoading('impactRows', 'table');
  const res = await request('social_impact');
  clearLoading('impactRows');
  renderImpact(res.data.testimonials || []);
}

document.addEventListener('DOMContentLoaded', () => {
  renderImpact(initialImpact);
  bindAjaxForm('impactForm', 'social_impact', () => {
    resetImpactForm();
    loadImpact();
  });
  document.getElementById('impactReset').addEventListener('click', resetImpactForm);
});
</script>
<?php admin_footer(); ?>
