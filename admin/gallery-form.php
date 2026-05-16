<?php
require_once __DIR__ . '/_layout.php';
$gallery = read_json_data('gallery', ['categories' => []]);
$categoryIndex = (int) ($_GET['category_index'] ?? -1);
$packageIndex = (int) ($_GET['package_index'] ?? -1);
$categoryName = $gallery['categories'][$categoryIndex]['name'] ?? '';
$packageName = $gallery['categories'][$categoryIndex]['packages'][$packageIndex]['name'] ?? '';
admin_header('Add Gallery Item');
?>
<div class="max-w-2xl">
    <a href="gallery.php" class="admin-action text-sm font-semibold text-blue-700">Back to Gallery</a>
    <form id="galleryForm" class="admin-surface mt-4 bg-white rounded-2xl border shadow-sm p-6" enctype="multipart/form-data">
        <input name="category_index" type="hidden" value="<?= e((string) $categoryIndex) ?>">
        <input name="package_index" type="hidden" value="<?= e((string) $packageIndex) ?>">
        <label class="block text-sm font-medium">Category Name</label>
        <input name="category_name" required value="<?= e($categoryName) ?>" class="mt-1 w-full rounded-lg border px-3 py-2 mb-4" placeholder="Travel 1">
        <label class="block text-sm font-medium">Album Name</label>
        <input name="package_name" required value="<?= e($packageName) ?>" class="mt-1 w-full rounded-lg border px-3 py-2 mb-4" placeholder="College 1">
        <label class="block text-sm font-medium">Upload Photo</label>
        <input name="image" type="file" accept="image/*" class="mt-1 w-full rounded-lg border px-3 py-2 mb-4">
        <label class="block text-sm font-medium">Or Image Path</label>
        <input name="image_path" class="mt-1 w-full rounded-lg border px-3 py-2" placeholder="assets/image/gallery/3.jpeg">
        <button class="admin-action mt-6 rounded-lg bg-blue-600 text-white px-6 py-3 font-semibold">Save Gallery Item</button>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  bindAjaxForm('galleryForm', 'gallery', () => setTimeout(() => location.href = 'gallery.php', 600));
});
</script>
<?php admin_footer(); ?>
