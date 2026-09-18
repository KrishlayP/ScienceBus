<?php
require_once __DIR__ . '/_layout.php';
$adminAction = ['label' => 'Add Location / Album / Photo', 'href' => 'gallery-form.php'];
admin_header('Gallery');
?>
<div id="galleryList" class="h-[calc(100vh-125px)] space-y-5 overflow-y-auto pr-2"></div>
<script>
document.addEventListener('DOMContentLoaded', loadGallery);

async function loadGallery() {
  setLoading('galleryList', 'cards');
  const res = await request('gallery');
  clearLoading('galleryList');
  document.getElementById('galleryList').innerHTML = (res.data.categories || []).map((cat, ci) => `
    <section class="admin-surface p-5">
      <div class="flex items-center justify-between border-b border-slate-200 pb-4">
        <div>
          <h2 class="font-bold text-lg text-slate-950">${html(cat.name)}</h2>
          <p class="text-sm text-slate-500">${(cat.packages || []).length} albums</p>
        </div>
      </div>
      <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-4 mt-5">
        ${(cat.packages || []).map((pkg, pi) => `
          <article class="admin-card overflow-hidden">
            <img src="../${html((pkg.images || [])[0] || 'assets/image/logo/logo.png')}" width="360" height="144" loading="lazy" decoding="async" alt="${html(pkg.name)}" class="w-full h-36 object-cover bg-blue-50 transition duration-300 hover:scale-[1.03]">
            <div class="p-3">
              <h3 class="font-semibold text-slate-950">${html(pkg.name)}</h3>
              <p class="text-sm text-slate-500">${(pkg.images || []).length} photos</p>
              <div class="mt-3 flex gap-2">
                <a class="admin-action bg-slate-950 text-white px-3 py-2 text-sm hover:bg-slate-800" href="gallery-form.php?category_index=${ci}&package_index=${pi}">Add Photo</a>
                ${res.superAdmin ? `<button class="admin-action border border-red-200 bg-red-50 text-red-700 px-3 py-2 text-sm hover:bg-red-100" onclick="deleteItem('gallery',{category_index:${ci},package_index:${pi}},loadGallery)">Delete</button>` : ''}
              </div>
            </div>
          </article>
        `).join('')}
      </div>
    </section>
  `).join('');
  filterList('galleryList');
}
</script>
<?php admin_footer(); ?>
