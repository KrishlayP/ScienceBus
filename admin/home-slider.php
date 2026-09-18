<?php
require_once __DIR__ . '/_layout.php';
$adminAction = ['label' => 'Add Slide', 'href' => 'home-slider-form.php'];
admin_header('Home Slider');
?>
<section class="admin-surface flex h-[calc(100vh-125px)] flex-col overflow-hidden bg-white rounded-2xl border shadow-sm p-5">
    <div class="shrink-0 flex items-center justify-between border-b pb-4 mb-5">
        <div>
            <h2 class="font-semibold text-lg">Hero Slider Images</h2>
            <p class="text-sm text-slate-500">Manage the images shown on the home page hero slider.</p>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[760px] text-left text-sm">
            <thead class="border-b text-xs uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-3 py-3">Image</th>
                    <th class="px-3 py-3">Title</th>
                    <th class="px-3 py-3">Path</th>
                    <th class="px-3 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="sliderRows" class="divide-y"></tbody>
        </table>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', loadHomeSlider);

async function loadHomeSlider() {
  setLoading('sliderRows', 'table');
  try {
    const res = await request('home_slider');
    const slides = res.data.slides || [];
    const markup = slides.map(item => `
    <tr>
      <td class="px-3 py-3">
        <img src="../${html(item.image)}" width="128" height="80" loading="lazy" decoding="async" class="h-20 w-32 rounded-lg border object-cover bg-blue-50" alt="${html(item.title || 'Slider image')}">
      </td>
      <td class="px-3 py-3 font-medium text-slate-950">${html(item.title || 'Slide')}</td>
      <td class="px-3 py-3 text-slate-500">
        <span class="block max-w-[320px] truncate">${html(item.image)}</span>
      </td>
      <td class="px-3 py-3">
        <div class="flex justify-end gap-2">
          <a class="admin-action rounded-lg border px-3 py-2 text-sm" href="home-slider-form.php?id=${encodeURIComponent(item.id)}">Edit</a>
          ${res.superAdmin ? `<button class="admin-action rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700" onclick="deleteItem('home_slider',{id:'${html(item.id)}'},loadHomeSlider)">Delete</button>` : ''}
        </div>
      </td>
    </tr>
    `).join('') || `<tr><td colspan="4" class="px-3 py-8 text-center text-slate-500">No slider images found.</td></tr>`;
    requestAnimationFrame(() => {
      document.getElementById('sliderRows').innerHTML = markup;
      paginateTableBody('sliderRows');
    });
  } catch (error) {
    document.getElementById('sliderRows').innerHTML = `<tr><td colspan="4" class="px-3 py-8 text-center text-red-600">${html(error.message || 'Could not load slider images.')}</td></tr>`;
  } finally {
    clearLoading('sliderRows');
  }
}
</script>
<?php admin_footer(); ?>
