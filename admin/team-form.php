<?php
require_once __DIR__ . '/_layout.php';
$team = load_team_data();
$section = isset($_GET['section']) ? $_GET['section'] : 'main_team';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$member = [];
if ($id && isset($team[$section])) {
    foreach ($team[$section] as $item) {
        if ((isset($item['id']) ? $item['id'] : '') === $id) {
            $member = $item;
            break;
        }
    }
}
admin_header($id ? 'Edit Member' : 'Add Member');
?>
<div class="max-w-2xl">
    <a href="team.php" class="admin-action text-sm font-semibold text-blue-700">Back to Team</a>
    <form id="teamForm" class="admin-surface mt-4 bg-white rounded-2xl border shadow-sm p-6" enctype="multipart/form-data">
        <input name="id" type="hidden" value="<?= e(isset($member['id']) ? $member['id'] : '') ?>">
        <input name="existing_image" type="hidden" value="<?= e(isset($member['image']) ? $member['image'] : '') ?>">
        <label class="block text-sm font-medium">Section</label>
        <select name="section" class="mt-1 w-full rounded-lg border px-3 py-2 mb-4">
            <?php foreach (['main_team' => 'Main Team', 'educator_team' => 'Educator Team', 'operational_team' => 'Operational Team'] as $value => $label): ?>
                <option value="<?= e($value) ?>" <?= $section === $value ? 'selected' : '' ?>><?= e($label) ?></option>
            <?php endforeach; ?>
        </select>
        <input name="name" required value="<?= e(isset($member['name']) ? $member['name'] : '') ?>" class="w-full rounded-lg border px-3 py-2 mb-3" placeholder="Name">
        <input name="role" required value="<?= e(isset($member['role']) ? $member['role'] : '') ?>" class="w-full rounded-lg border px-3 py-2 mb-3" placeholder="Role">
        <input name="org" value="<?= e(isset($member['org']) ? $member['org'] : '') ?>" class="w-full rounded-lg border px-3 py-2 mb-3" placeholder="Organization">
        <input name="email" value="<?= e(isset($member['email']) ? $member['email'] : '') ?>" class="w-full rounded-lg border px-3 py-2 mb-3" placeholder="Email">
        <input name="contact" value="<?= e(isset($member['contact']) ? $member['contact'] : '') ?>" class="w-full rounded-lg border px-3 py-2 mb-3" placeholder="Contact">
        <input name="image" type="file" accept="image/*" class="w-full rounded-lg border px-3 py-2">
        <button class="admin-action mt-6 rounded-lg bg-blue-600 text-white px-6 py-3 font-semibold">Save Member</button>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  bindAjaxForm('teamForm', 'team', () => setTimeout(() => location.href = 'team.php', 600));
});
</script>
<?php admin_footer(); ?>
