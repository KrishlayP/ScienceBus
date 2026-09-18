<?php
require_once __DIR__ . '/_layout.php';
$adminAction = ['label' => 'Add Tour Row', 'href' => 'tour-profile-form.php'];
$profile = load_tour_profile_data();
$stats = $profile['stats'];
admin_header('Tour Profile');
?>
<div class="grid gap-5 xl:grid-cols-[360px_minmax(0,1fr)]">
    <form id="tourStatsForm" class="admin-surface rounded-2xl border bg-white p-5 shadow-sm">
        <div class="mb-4">
            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Overview Cards</p>
            <h2 class="text-lg font-bold text-slate-900">Tour Stats</h2>
        </div>
        <label class="block text-sm font-medium">Total Tours</label>
        <input name="total_tours" value="<?= e($stats['total_tours']) ?>" class="mb-4 mt-1 w-full rounded-lg border px-3 py-2">
        <label class="block text-sm font-medium">People Benefitted</label>
        <input name="people_benefitted" value="<?= e($stats['people_benefitted']) ?>" class="mb-4 mt-1 w-full rounded-lg border px-3 py-2">
        <label class="block text-sm font-medium">Districts Covered</label>
        <input name="districts_covered" value="<?= e($stats['districts_covered']) ?>" class="mb-4 mt-1 w-full rounded-lg border px-3 py-2">
        <label class="block text-sm font-medium">Active Period</label>
        <input name="active_period" value="<?= e($stats['active_period']) ?>" class="mb-5 mt-1 w-full rounded-lg border px-3 py-2">
        <button class="admin-action bg-slate-950 px-5 py-2.5 text-sm text-white hover:bg-slate-800">Save Stats</button>
    </form>

    <div class="admin-surface rounded-2xl border bg-white p-5 shadow-sm">
        <div class="mb-4 flex items-center justify-between border-b pb-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Table Rows</p>
                <h2 class="text-lg font-bold text-slate-900">Tour History</h2>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-left text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="w-16 px-4 py-3">S.No</th>
                        <th class="w-36 px-4 py-3">Start</th>
                        <th class="w-36 px-4 py-3">End</th>
                        <th class="w-56 px-4 py-3">District</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="w-44 px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody id="tourRows" class="divide-y"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
const initialTours = <?= json_encode($profile['tours'], JSON_UNESCAPED_UNICODE) ?>;
const canDeleteTours = <?= is_super_admin() ? 'true' : 'false' ?>;

function renderTours(tours) {
  document.getElementById('tourRows').innerHTML = (tours || []).map((tour, index) => `
    <tr class="align-top">
      <td class="px-4 py-4 font-semibold text-slate-700">${index + 1}</td>
      <td class="px-4 py-4 text-slate-600">${html(tour.tour_start)}</td>
      <td class="px-4 py-4 text-slate-600">${html(tour.tour_end)}</td>
      <td class="px-4 py-4 font-semibold text-slate-900">${html(tour.district)}</td>
      <td class="px-4 py-4 leading-6 text-slate-600">${html(tour.description)}</td>
      <td class="px-4 py-4">
        <div class="flex gap-2">
          <a class="admin-action rounded-lg bg-slate-900 px-3 py-2 text-sm text-white" href="tour-profile-form.php?id=${tour.id}">Edit</a>
          ${canDeleteTours ? `<button class="admin-action rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700" onclick="deleteItem('tour_profile',{id:'${tour.id}'},loadTours)">Delete</button>` : ''}
        </div>
      </td>
    </tr>
  `).join('');
  paginateTableBody('tourRows');
}

async function loadTours() {
  setLoading('tourRows', 'table');
  const res = await request('tour_profile');
  clearLoading('tourRows');
  renderTours(res.data.tours || []);
}

document.addEventListener('DOMContentLoaded', () => {
  renderTours(initialTours);
  const form = document.getElementById('tourStatsForm');
  form.addEventListener('submit', async event => {
    event.preventDefault();
    const body = new FormData(form);
    body.append('module', 'tour_profile');
    body.append('action', 'save_stats');
    try {
      await request('tour_profile', 'save_stats', body);
      setMessage('Tour stats saved.');
    } catch (error) {
      setMessage(error.message, 'error');
    }
  });
});
</script>
<?php admin_footer(); ?>
