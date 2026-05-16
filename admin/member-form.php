<?php
require_once __DIR__ . '/_layout.php';
require_super_admin();
admin_header('Add Admin');
?>
<div class="max-w-2xl">
    <a href="members.php" class="admin-action text-sm font-semibold text-blue-700">Back to Members</a>
    <form id="memberForm" class="admin-surface mt-4 bg-white rounded-2xl border shadow-sm p-6">
        <label class="block text-sm font-medium">Name</label>
        <input name="name" required class="mt-1 w-full rounded-lg border px-3 py-2 mb-4" placeholder="Name">
        <label class="block text-sm font-medium">Email</label>
        <input name="email" type="email" required class="mt-1 w-full rounded-lg border px-3 py-2 mb-4" placeholder="Email">
        <label class="block text-sm font-medium">Password</label>
        <input name="password" type="password" required class="mt-1 w-full rounded-lg border px-3 py-2 mb-4" placeholder="Password">
        <label class="block text-sm font-medium">Role</label>
        <select name="role" class="mt-1 w-full rounded-lg border px-3 py-2">
            <option value="admin">Admin</option>
            <option value="super_admin">Super Admin</option>
        </select>
        <button class="admin-action mt-6 rounded-lg bg-blue-600 text-white px-6 py-3 font-semibold">Save Admin</button>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  bindAjaxForm('memberForm', 'members', () => setTimeout(() => location.href = 'members.php', 600));
});
</script>
<?php admin_footer(); ?>
