<?php
require_once __DIR__ . '/_layout.php';
admin_header('Messages');
?>
<div class="admin-surface h-[calc(100vh-125px)] overflow-auto bg-white rounded-xl border shadow-sm">
    <table class="w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="p-3">Name</th>
                <th class="p-3">Email</th>
                <th class="p-3">School</th>
                <th class="p-3">Message</th>
                <th class="p-3">Date</th>
                <?php if (is_super_admin()): ?><th class="p-3">Action</th><?php endif; ?>
            </tr>
        </thead>
        <tbody id="messageRows"></tbody>
    </table>
</div>
<script>
document.addEventListener('DOMContentLoaded', loadMessages);

async function loadMessages() {
  const res = await request('messages');
  document.getElementById('messageRows').innerHTML = (res.data.messages || []).map(message => `
    <tr class="border-t">
      <td class="p-3">${html(message.name)}</td>
      <td class="p-3">${html(message.email)}</td>
      <td class="p-3">${html(message.school)}</td>
      <td class="p-3">${html(message.message)}</td>
      <td class="p-3">${html(message.created_at)}</td>
      ${res.superAdmin ? `<td class="p-3"><button class="admin-action rounded-lg bg-red-600 text-white px-3 py-2 text-sm" onclick="deleteItem('messages',{id:'${message.id}'},loadMessages)">Delete</button></td>` : ''}
    </tr>
  `).join('');
}
</script>
<?php admin_footer(); ?>
