<?php
require_once __DIR__ . '/_layout.php';
admin_header('Add News');
?>
<div class="max-w-2xl">
    <a href="news.php" class="admin-action text-sm font-semibold text-blue-700">Back to News</a>
    <form id="newsForm" class="admin-surface mt-4 bg-white rounded-2xl border shadow-sm p-6" enctype="multipart/form-data">
        <h2 class="font-semibold text-xl mb-1">Add News Image</h2>
        <p class="text-sm text-slate-500 mb-6">Upload a new media image or enter existing image path.</p>
        <label class="block text-sm font-medium">Upload Image</label>
        <input name="image" type="file" accept="image/*" class="mt-1 mb-4 w-full rounded-lg border px-3 py-2">
        <label class="block text-sm font-medium">Or Image Path</label>
        <input name="image_path" class="mt-1 w-full rounded-lg border px-3 py-2" placeholder="assets/image/news/photo.jpg">
        <button class="admin-action mt-6 rounded-lg bg-blue-600 text-white px-6 py-3 font-semibold">Save News</button>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  bindAjaxForm('newsForm', 'news', () => setTimeout(() => location.href = 'news.php', 600));
});
</script>
<?php admin_footer(); ?>
