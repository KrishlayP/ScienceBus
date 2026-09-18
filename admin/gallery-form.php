<?php
require_once __DIR__ . '/_layout.php';

$gallery = load_gallery_data();
$categoryIndex = (int) (isset($_GET['category_index']) ? $_GET['category_index'] : -1);
$packageIndex = (int) (isset($_GET['package_index']) ? $_GET['package_index'] : -1);
$categoryName = isset($gallery['categories'][$categoryIndex]['name']) ? $gallery['categories'][$categoryIndex]['name'] : '';
$packageName = isset($gallery['categories'][$categoryIndex]['packages'][$packageIndex]['name']) ? $gallery['categories'][$categoryIndex]['packages'][$packageIndex]['name'] : '';

admin_header('Add Gallery Photo');
?>
<div class="max-w-5xl">
    <div class="mb-4 flex justify-end">
        <a href="gallery.php" class="admin-action border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back</a>
    </div>
    <form id="galleryForm" class="admin-surface grid gap-5 p-6 lg:grid-cols-[minmax(0,1fr)_320px]" enctype="multipart/form-data">
        <input name="category_index" id="categoryIndex" type="hidden" value="<?= e((string) $categoryIndex) ?>">
        <input name="package_index" id="packageIndex" type="hidden" value="<?= e((string) $packageIndex) ?>">
        <input name="existing_category" id="existingCategory" type="hidden" value="<?= e($categoryName) ?>">
        <input name="existing_package" id="existingPackage" type="hidden" value="<?= e($packageName) ?>">

        <div class="space-y-5">
            <section class="rounded-xl border border-slate-200 p-4">
                <div class="mb-4">
                    <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Step 1</p>
                    <h3 class="text-lg font-bold text-slate-900">Location</h3>
                </div>

                <label class="block text-sm font-medium text-slate-700">Location Name</label>
                <div class="relative mt-1">
                    <input
                        id="categoryName"
                        name="category_name"
                        value="<?= e($categoryName) ?>"
                        autocomplete="off"
                        class="w-full rounded-lg border px-3 py-2"
                        placeholder="Click or type location, e.g. Farrukhabad"
                    >
                    <div id="categoryMenu" class="absolute z-30 mt-1 hidden max-h-56 w-full overflow-y-auto rounded-lg border border-slate-200 bg-white p-1 shadow-xl"></div>
                </div>
                <p class="mt-2 text-xs text-slate-500">Select an existing location from the list, or type a new name to create it.</p>
            </section>

            <section class="rounded-xl border border-slate-200 p-4">
                <div class="mb-4">
                    <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Step 2</p>
                    <h3 class="text-lg font-bold text-slate-900">College / Album</h3>
                </div>

                <label class="block text-sm font-medium text-slate-700">College / Album Name</label>
                <div class="relative mt-1">
                    <input
                        id="packageName"
                        name="package_name"
                        value="<?= e($packageName) ?>"
                        autocomplete="off"
                        class="w-full rounded-lg border px-3 py-2"
                        placeholder="Click or type album, e.g. Rajputana Public School"
                    >
                    <div id="packageMenu" class="absolute z-30 mt-1 hidden max-h-56 w-full overflow-y-auto rounded-lg border border-slate-200 bg-white p-1 shadow-xl"></div>
                </div>
                <p class="mt-2 text-xs text-slate-500">Albums for the selected location appear here, or type a new name to create an album.</p>
            </section>

            <section class="rounded-xl border border-slate-200 p-4">
                <div class="mb-4">
                    <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Step 3</p>
                    <h3 class="text-lg font-bold text-slate-900">Photo</h3>
                </div>

                <label class="block text-sm font-medium text-slate-700">Upload Photo</label>
                <input id="imageInput" name="image" type="file" accept="image/*" class="mt-1 w-full rounded-lg border px-3 py-2">

                <label class="mt-4 block text-sm font-medium text-slate-700">Or Image Path</label>
                <input name="image_path" class="mt-1 w-full rounded-lg border px-3 py-2" placeholder="assets/uploads/tours/location/album/photo.jpg">
            </section>

            <div class="flex flex-wrap gap-3">
                <button class="admin-action bg-slate-950 px-6 py-3 text-white hover:bg-slate-800">Save Photo</button>
            </div>
        </div>

        <aside class="rounded-xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Preview</p>
            <div class="mt-4 overflow-hidden rounded-xl border bg-white shadow-sm">
                <div class="aspect-[4/3] bg-slate-100">
                    <img id="imagePreview" src="../assets/image/logo/logo.png" class="h-full w-full object-cover" alt="">
                </div>
                <div class="p-4">
                    <h3 id="previewAlbum" class="font-bold text-slate-900">College / Album</h3>
                    <p id="previewLocation" class="mt-1 text-sm text-slate-500">Location</p>
                </div>
            </div>
        </aside>
    </form>
</div>

<script>
const galleryData = <?= json_encode($gallery, JSON_UNESCAPED_UNICODE) ?>;
const initialCategoryIndex = <?= (int) $categoryIndex ?>;
const initialPackageIndex = <?= (int) $packageIndex ?>;

document.addEventListener('DOMContentLoaded', () => {
  const categoryIndexInput = document.getElementById('categoryIndex');
  const packageIndexInput = document.getElementById('packageIndex');
  const existingCategoryInput = document.getElementById('existingCategory');
  const existingPackageInput = document.getElementById('existingPackage');
  const categoryNameInput = document.getElementById('categoryName');
  const packageNameInput = document.getElementById('packageName');
  const categoryMenu = document.getElementById('categoryMenu');
  const packageMenu = document.getElementById('packageMenu');
  const previewLocation = document.getElementById('previewLocation');
  const previewAlbum = document.getElementById('previewAlbum');
  const imageInput = document.getElementById('imageInput');
  const imagePreview = document.getElementById('imagePreview');

  function normalize(value) {
    return String(value || '').trim().toLowerCase();
  }

  function categories() {
    return galleryData.categories || [];
  }

  function selectedCategory() {
    const index = Number(categoryIndexInput.value);
    return index >= 0 ? categories()[index] : null;
  }

  function renderMenu(menu, items, onPick, typedValue, emptyLabel) {
    const query = normalize(typedValue);
    const filtered = items.filter(item => normalize(item.label).includes(query));
    menu.innerHTML = '';

    if (!filtered.length) {
      const empty = document.createElement('div');
      empty.className = 'px-3 py-2 text-sm text-slate-500';
      empty.textContent = emptyLabel;
      menu.appendChild(empty);
    }

    filtered.forEach(item => {
      const button = document.createElement('button');
      button.type = 'button';
      button.className = 'block w-full rounded-md px-3 py-2 text-left text-sm text-slate-700 hover:bg-slate-100';
      button.textContent = item.label;
      button.onclick = () => onPick(item);
      menu.appendChild(button);
    });

    menu.classList.remove('hidden');
  }

  function syncCategoryMatch() {
    const typed = categoryNameInput.value;
    const matchIndex = categories().findIndex(category => normalize(category.name) === normalize(typed));
    categoryIndexInput.value = String(matchIndex);
    existingCategoryInput.value = matchIndex >= 0 ? categories()[matchIndex].name : '';

    if (matchIndex < 0) {
      packageIndexInput.value = '-1';
      existingPackageInput.value = '';
    }

    syncPackageMatch();
    updatePreview();
  }

  function syncPackageMatch() {
    const category = selectedCategory();
    const typed = packageNameInput.value;
    const packages = category ? (category.packages || []) : [];
    const matchIndex = packages.findIndex(pkg => normalize(pkg.name) === normalize(typed));
    packageIndexInput.value = String(matchIndex);
    existingPackageInput.value = matchIndex >= 0 ? packages[matchIndex].name : '';
    updatePreview();
  }

  function updatePreview() {
    previewLocation.textContent = categoryNameInput.value || 'Location';
    previewAlbum.textContent = packageNameInput.value || 'College / Album';
  }

  function showCategoryMenu() {
    renderMenu(
      categoryMenu,
      categories().map((category, index) => ({label: category.name, index})),
      item => {
        categoryNameInput.value = item.label;
        categoryIndexInput.value = String(item.index);
        existingCategoryInput.value = item.label;
        packageNameInput.value = '';
        packageIndexInput.value = '-1';
        existingPackageInput.value = '';
        categoryMenu.classList.add('hidden');
        showPackageMenu();
        updatePreview();
      },
      categoryNameInput.value,
      'No existing location. This will be created.'
    );
  }

  function showPackageMenu() {
    const category = selectedCategory();
    const packages = category ? (category.packages || []) : [];
    renderMenu(
      packageMenu,
      packages.map((pkg, index) => ({label: pkg.name, index})),
      item => {
        packageNameInput.value = item.label;
        packageIndexInput.value = String(item.index);
        existingPackageInput.value = item.label;
        packageMenu.classList.add('hidden');
        updatePreview();
      },
      packageNameInput.value,
      category ? 'No existing album. This will be created.' : 'Select or type a location first.'
    );
  }

  categoryNameInput.addEventListener('focus', showCategoryMenu);
  categoryNameInput.addEventListener('click', showCategoryMenu);
  categoryNameInput.addEventListener('input', () => {
    syncCategoryMatch();
    showCategoryMenu();
  });

  packageNameInput.addEventListener('focus', showPackageMenu);
  packageNameInput.addEventListener('click', showPackageMenu);
  packageNameInput.addEventListener('input', () => {
    syncPackageMatch();
    showPackageMenu();
  });

  document.addEventListener('click', event => {
    if (!categoryMenu.contains(event.target) && event.target !== categoryNameInput) {
      categoryMenu.classList.add('hidden');
    }
    if (!packageMenu.contains(event.target) && event.target !== packageNameInput) {
      packageMenu.classList.add('hidden');
    }
  });

  imageInput.addEventListener('change', () => {
    const file = imageInput.files && imageInput.files[0];
    if (file) {
      imagePreview.src = URL.createObjectURL(file);
    }
  });

  if (initialCategoryIndex >= 0 && categories()[initialCategoryIndex]) {
    categoryNameInput.value = categories()[initialCategoryIndex].name;
    categoryIndexInput.value = String(initialCategoryIndex);
    existingCategoryInput.value = categoryNameInput.value;
  }

  if (initialPackageIndex >= 0 && selectedCategory() && selectedCategory().packages[initialPackageIndex]) {
    packageNameInput.value = selectedCategory().packages[initialPackageIndex].name;
    packageIndexInput.value = String(initialPackageIndex);
    existingPackageInput.value = packageNameInput.value;
  }

  syncCategoryMatch();
  bindAjaxForm('galleryForm', 'gallery', () => setTimeout(() => location.href = 'gallery.php', 600));
});
</script>
<?php admin_footer(); ?>
