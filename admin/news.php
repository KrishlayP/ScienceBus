<?php
require_once __DIR__ . '/_layout.php';
$adminAction = ['label' => 'Add News', 'href' => 'news-form.php'];
admin_header('News');
?>
<section class="admin-surface flex h-[calc(100vh-125px)] flex-col overflow-hidden bg-white rounded-2xl border shadow-sm p-5">
    <div class="shrink-0 flex items-center justify-between border-b pb-4 mb-5">
        <div>
            <h2 class="font-semibold text-lg">News Images</h2>
            <p class="text-sm text-slate-500">Uploaded news/media items shown on website.</p>
        </div>
    </div>
    <div id="newsList" class="grid flex-1 auto-rows-max gap-4 overflow-y-auto pr-2 sm:grid-cols-2 xl:grid-cols-4"></div>
</section>
<script>
document.addEventListener('DOMContentLoaded', loadNews);

async function loadNews() {
  const res = await request('news');
  document.getElementById('newsList').innerHTML = res.data.map(item => `
    <article class="admin-card border rounded-xl overflow-hidden bg-slate-50">
      <img src="../${html(item.image)}" class="w-full h-40 object-cover transition duration-300 hover:scale-[1.03]">
      <div class="p-3">
        <div class="text-sm font-medium truncate">${html(item.title)}</div>
        ${res.superAdmin ? `<button class="admin-action mt-3 rounded-lg border border-red-200 bg-red-50 text-red-700 px-3 py-2 text-sm" onclick="deleteItem('news',{id:'${item.id}'},loadNews)">Delete</button>` : ''}
      </div>
    </article>
  `).join('');
}
</script>
<?php admin_footer(); ?>
