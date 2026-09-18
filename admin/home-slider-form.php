<?php
require_once __DIR__ . '/_layout.php';
require_once __DIR__ . '/../includes/admin_functions.php';

$id = isset($_GET['id']) ? trim($_GET['id']) : '';
$slide = $id !== '' ? home_slider_item($id) : null;

admin_header($slide ? 'Edit Slide' : 'Add Slide');
?>
<div class="max-w-2xl">
    <div class="mb-4 flex justify-end">
        <a href="home-slider.php" class="admin-action border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back to Home Slider</a>
    </div>
    <form id="homeSliderForm" class="admin-surface bg-white rounded-2xl border shadow-sm p-6" enctype="multipart/form-data">
        <h2 class="font-semibold text-xl mb-1"><?= $slide ? 'Edit Slider Image' : 'Add Slider Image' ?></h2>
        <p class="text-sm text-slate-500 mb-6">Upload a home page hero image or enter an existing image path.</p>

        <input type="hidden" name="id" value="<?= e($slide['id'] ?? '') ?>">
        <input type="hidden" name="existing_image" value="<?= e($slide['image'] ?? '') ?>">

        <?php if (!empty($slide['image'])): ?>
            <img src="../<?= e($slide['image']) ?>" class="mb-5 h-44 w-full rounded-xl border object-cover">
        <?php endif; ?>

        <label class="block text-sm font-medium">Title</label>
        <input name="title" value="<?= e($slide['title'] ?? '') ?>" class="mt-1 mb-4 w-full rounded-lg border px-3 py-2" placeholder="Hero quote or slide title">

        <label class="block text-sm font-medium">Upload Image</label>
        <input name="image" type="file" accept="image/*" class="mt-1 mb-4 w-full rounded-lg border px-3 py-2">

        <label class="block text-sm font-medium">Or Image Path</label>
        <input name="image_path" value="<?= e($slide['image'] ?? '') ?>" class="mt-1 w-full rounded-lg border px-3 py-2" placeholder="assets/image/header/photo.jpg">

        <button class="admin-action mt-6 rounded-lg bg-slate-950 px-6 py-3 font-semibold text-white hover:bg-slate-800">Save Slide</button>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  bindAjaxForm('homeSliderForm', 'home_slider', () => setTimeout(() => location.href = 'home-slider.php', 600));
});
</script>
<?php admin_footer(); ?>
