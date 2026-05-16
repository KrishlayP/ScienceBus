<?php
require_once __DIR__ . '/_layout.php';
require_super_admin();
$adminAction = ['label' => 'Add Admin', 'href' => 'member-form.php'];
admin_header('Members');
?>
<section class="admin-surface flex h-[calc(100vh-125px)] flex-col overflow-hidden bg-white rounded-2xl border shadow-sm p-5">
    <div class="shrink-0 border-b pb-4 mb-5">
        <h2 class="font-semibold text-lg">Admin Members</h2>
        <p class="text-sm text-slate-500">Only super admin can add members.</p>
    </div>
    <div id="memberList" class="grid flex-1 auto-rows-max gap-4 overflow-y-auto pr-2 md:grid-cols-2 xl:grid-cols-3"></div>
</section>
<script>
document.addEventListener('DOMContentLoaded', loadMembers);

async function loadMembers() {
  const res = await request('members');
  document.getElementById('memberList').innerHTML = (res.data.users || []).map(user => `
    <article class="bg-slate-50 border rounded-xl p-4">
      <div class="font-semibold">${html(user.name)}</div>
      <div class="text-sm text-slate-500">${html(user.email)}</div>
      <span class="mt-3 inline-flex rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">${html((user.role || '').replace('_', ' '))}</span>
    </article>
  `).join('');
}
</script>
<?php admin_footer(); ?>
