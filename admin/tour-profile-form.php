<?php
require_once __DIR__ . '/_layout.php';
$profile = load_tour_profile_data();
$id = (int) (isset($_GET['id']) ? $_GET['id'] : 0);
$item = ['id' => 0, 'tour_start' => '', 'tour_end' => '', 'district' => '', 'description' => ''];
if ($id > 0) {
    foreach ($profile['tours'] as $tour) {
        if ((int) $tour['id'] === $id) {
            $item = $tour;
            break;
        }
    }
}
admin_header($id > 0 ? 'Edit Tour Row' : 'Add Tour Row');
?>
<div class="max-w-3xl">
    <div class="mb-4 flex justify-end">
        <a href="tour-profile.php" class="admin-action border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Back to Tour Profile</a>
    </div>
    <form id="tourProfileForm" class="admin-surface rounded-2xl border bg-white p-6 shadow-sm">
        <input name="id" type="hidden" value="<?= e((string) $item['id']) ?>">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium">Tour Start</label>
                <input name="tour_start" type="date" value="<?= e($item['tour_start'] ?? '') ?>" class="mb-4 mt-1 w-full rounded-lg border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Tour End</label>
                <input name="tour_end" type="date" value="<?= e($item['tour_end'] ?? '') ?>" class="mb-4 mt-1 w-full rounded-lg border px-3 py-2">
            </div>
        </div>

        <label class="block text-sm font-medium">District / Tour Name</label>
        <input name="district" required value="<?= e($item['district']) ?>" class="mb-4 mt-1 w-full rounded-lg border px-3 py-2" placeholder="Example: Farrukhabad">

        <label class="block text-sm font-medium">Description</label>
        <textarea name="description" required rows="6" class="mt-1 w-full rounded-lg border px-3 py-2" placeholder="Tour profile description"><?= e($item['description']) ?></textarea>

        <button class="admin-action mt-6 bg-slate-950 px-6 py-3 text-white hover:bg-slate-800">Save Tour Row</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  bindAjaxForm('tourProfileForm', 'tour_profile', () => setTimeout(() => location.href = 'tour-profile.php', 600));
});
</script>
<?php admin_footer(); ?>
