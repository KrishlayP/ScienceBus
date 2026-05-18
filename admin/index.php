<?php
require_once __DIR__ . '/_layout.php';

$news = load_news_data();
$gallery = load_gallery_data();
$team = load_team_data();
$messages = load_messages_data();

$teamCount = count(isset($team['main_team']) ? $team['main_team'] : []) + count(isset($team['educator_team']) ? $team['educator_team'] : []) + count(isset($team['operational_team']) ? $team['operational_team'] : []);
$albumCount = 0;
$photoCount = 0;
foreach (isset($gallery['categories']) ? $gallery['categories'] : [] as $cat) {
    $albumCount += count(isset($cat['packages']) ? $cat['packages'] : []);
    foreach (isset($cat['packages']) ? $cat['packages'] : [] as $package) {
        $photoCount += count(isset($package['images']) ? $package['images'] : []);
    }
}

admin_header('Dashboard');

$cards = [
    ['News Images', count(isset($news['news']) ? $news['news'] : []), 'news.php', 'N'],
    ['Gallery Albums', $albumCount, 'gallery.php', 'G'],
    ['Team Members', $teamCount, 'team.php', 'T'],
    ['Messages', count(isset($messages['messages']) ? $messages['messages'] : []), 'messages.php', 'M'],
];

$quickRows = [
    ['News Images', count(isset($news['news']) ? $news['news'] : []), 'news-form.php', 'Add News'],
    ['Gallery Albums', $albumCount . ' albums / ' . $photoCount . ' photos', 'gallery-form.php', 'Add Photo'],
    ['Team Members', $teamCount, 'team-form.php', 'Add Member'],
    ['Messages', count(isset($messages['messages']) ? $messages['messages'] : []), 'messages.php', 'View Inbox'],
];
?>
<section class="admin-animate grid gap-4 lg:grid-cols-[1fr_150px]">
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <?php foreach ($cards as [$label, $value, $link, $icon]): ?>
            <a href="<?= e($link) ?>" class="admin-card rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200/80">
                <div class="flex items-center gap-2 text-sm font-medium text-slate-400">
                    <span class="grid h-7 w-7 place-items-center rounded-lg bg-slate-100 text-xs text-slate-500"><?= e($icon) ?></span>
                    <?= e($label) ?>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div class="text-2xl font-semibold tracking-tight text-[#073b2c]"><?= e((string) $value) ?></div>
                    <span class="text-xs font-medium text-emerald-600">updated</span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <a href="gallery-form.php" class="admin-card grid min-h-28 place-items-center rounded-xl border-2 border-dashed border-emerald-200 bg-white p-4 text-center shadow-sm hover:border-emerald-500">
        <span class="grid h-10 w-10 place-items-center rounded-xl bg-emerald-600 text-xl font-semibold text-white">+</span>
        <span class="text-sm font-semibold text-[#073b2c]">Add Data</span>
    </a>
</section>

<section class="admin-animate mt-5 grid gap-4 xl:grid-cols-[1.4fr_.6fr]" style="animation-delay:.08s">
    <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200/80">
        <div class="mb-4 flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-lg font-semibold text-[#073b2c]">Content Summary</h2>
                <p class="text-sm text-slate-500">Dynamic sections ka quick overview.</p>
            </div>
        </div>
        <div class="overflow-hidden rounded-xl border border-slate-100">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-400">
                    <tr>
                        <th class="px-4 py-3">Section</th>
                        <th class="px-4 py-3">Count</th>
                        <th class="px-4 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($quickRows as [$label, $value, $link, $action]): ?>
                        <tr class="transition hover:bg-emerald-50/50">
                            <td class="px-4 py-3 font-medium text-slate-700"><?= e($label) ?></td>
                            <td class="px-4 py-3 text-slate-500"><?= e((string) $value) ?></td>
                            <td class="px-4 py-3 text-right">
                                <a class="font-medium text-emerald-700 hover:text-emerald-900" href="<?= e($link) ?>"><?= e($action) ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200/80">
        <h2 class="text-lg font-semibold text-[#073b2c]">Role Rules</h2>
        <p class="mt-3 text-sm leading-6 text-slate-600">Admin aur Super Admin dono content add/update kar sakte hain. Sirf Super Admin delete kar sakta hai aur naye admin members add kar sakta hai.</p>
        <div class="mt-5 grid gap-2">
            <a class="rounded-xl bg-emerald-600 px-4 py-2.5 text-center text-sm font-medium text-white transition hover:bg-emerald-700" href="news-form.php">Add News</a>
            <a class="rounded-xl bg-emerald-50 px-4 py-2.5 text-center text-sm font-medium text-emerald-800 transition hover:bg-emerald-100" href="team-form.php">Add Team Member</a>
        </div>
    </div>
</section>
<?php admin_footer(); ?>
