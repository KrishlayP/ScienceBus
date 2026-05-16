<?php
require_once __DIR__ . '/_layout.php';
$adminAction = ['label' => 'Add Member', 'href' => 'team-form.php'];
admin_header('Team');
?>
<section class="admin-surface flex h-[calc(100vh-125px)] flex-col overflow-hidden bg-white rounded-2xl border shadow-sm p-5">
    <div class="shrink-0 border-b pb-4 mb-5">
        <h2 class="font-semibold text-lg">Team Members</h2>
        <p class="text-sm text-slate-500">View team members grouped by section.</p>
    </div>
    <div id="teamList" class="grid flex-1 auto-rows-max gap-4 overflow-y-auto pr-2 md:grid-cols-2 xl:grid-cols-3"></div>
</section>
<script>
document.addEventListener('DOMContentLoaded', loadTeam);

async function loadTeam() {
  const res = await request('team');
  const labels = {main_team:'Main', educator_team:'Educator', operational_team:'Operational'};
  const markup = Object.entries(res.data).flatMap(([section, members]) => members.map(member => `
    <article class="admin-card bg-slate-50 border rounded-xl p-4">
      <div class="flex gap-4">
        <img src="../${html(member.image)}" class="w-16 h-16 rounded-full object-cover">
        <div class="min-w-0">
          <h3 class="font-bold truncate">${html(member.name)}</h3>
          <p class="text-sm text-blue-700">${html(member.role)}</p>
          <p class="text-xs text-slate-500">${html(labels[section] || section)}</p>
        </div>
      </div>
      <div class="mt-4 flex gap-2">
        <a class="admin-action rounded-lg bg-slate-900 text-white px-3 py-2 text-sm" href="team-form.php?section=${section}&id=${member.id}">Edit</a>
        ${res.superAdmin ? `<button class="admin-action rounded-lg border border-red-200 bg-red-50 text-red-700 px-3 py-2 text-sm" onclick="deleteItem('team',{section:'${section}',id:'${member.id}'},loadTeam)">Delete</button>` : ''}
      </div>
    </article>
  `)).join('');
  document.getElementById('teamList').innerHTML = markup;
}
</script>
<?php admin_footer(); ?>
