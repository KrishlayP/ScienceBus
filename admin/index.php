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
    ['Gallery Albums', $albumCount . ' albums / ' . $photoCount . ' photos', 'gallery-form.php', 'Add Gallery'],
    ['Team Members', $teamCount, 'team-form.php', 'Add Member'],
    ['Messages', count(isset($messages['messages']) ? $messages['messages'] : []), 'messages.php', 'View Inbox'],
];
?>
<div class="admin-animate mb-4 flex items-center justify-between">
    <div>
        <p class="text-sm font-bold text-blue-600">Workspace overview</p>
        <p class="mt-1 text-sm text-slate-500">Your website content at a glance.</p>
    </div>
    <a href="gallery-form.php" class="admin-action bg-blue-600 px-4 py-2.5 text-sm text-white hover:bg-blue-700">+ Add content</a>
</div>

<section class="admin-animate grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <?php foreach ($cards as $cardIndex => [$label, $value, $link, $icon]): ?>
        <a href="<?= e($link) ?>" class="admin-card group relative min-h-[150px] overflow-hidden bg-gradient-to-br <?= ['from-blue-500 to-blue-700', 'from-sky-500 to-blue-600', 'from-indigo-500 to-blue-700', 'from-cyan-500 to-blue-600'][$cardIndex] ?> p-5 text-white">
            <span class="absolute -bottom-10 -right-8 h-28 w-28 rounded-full bg-white/10 transition-transform duration-300 group-hover:scale-125"></span>
            <div class="relative flex items-start justify-between">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-white/15 text-sm font-extrabold"><?= e($icon) ?></span>
                <span class="rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider">Live</span>
            </div>
            <div class="relative mt-5 text-sm font-semibold text-white/80"><?= e($label) ?></div>
            <div class="relative mt-0.5 text-3xl font-extrabold tracking-tight"><?= e((string) $value) ?></div>
        </a>
    <?php endforeach; ?>
</section>

<section class="admin-animate mt-5 grid gap-4 xl:grid-cols-[1.45fr_.55fr]" style="animation-delay:.08s">
    <div class="admin-surface p-5">
        <div class="mb-4 flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-lg font-semibold text-slate-950">Content Summary</h2>
                <p class="text-sm text-slate-500">Quick overview of dynamic content sections.</p>
            </div>
        </div>
        <div class="overflow-hidden rounded-xl border border-slate-200">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Section</th>
                        <th class="px-4 py-3">Count</th>
                        <th class="px-4 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($quickRows as [$label, $value, $link, $action]): ?>
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-700"><?= e($label) ?></td>
                            <td class="px-4 py-3 text-slate-500"><?= e((string) $value) ?></td>
                            <td class="px-4 py-3 text-right">
                                <a class="font-medium text-slate-950 underline-offset-4 hover:underline" href="<?= e($link) ?>"><?= e($action) ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="admin-surface p-5">
        <div class="mb-5 flex items-center justify-between">
            <h2 class="text-lg font-extrabold text-slate-950">Quick actions</h2>
            <span class="text-slate-400">•••</span>
        </div>
        <p class="text-sm leading-6 text-slate-600">Add and update website content from one place.</p>
        <div class="mt-5 grid gap-2">
            <a class="admin-action justify-between bg-blue-600 px-4 py-3 text-sm text-white hover:bg-blue-700" href="news-form.php"><span>Add News</span><span>→</span></a>
            <a class="admin-action justify-between border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-blue-700 hover:bg-blue-100" href="team-form.php"><span>Add Team Member</span><span>→</span></a>
            <a class="admin-action justify-between border border-blue-100 bg-white px-4 py-3 text-sm text-blue-700 hover:bg-blue-50" href="messages.php"><span>View Messages</span><span>→</span></a>
        </div>
    </div>
</section>
<?php admin_footer(); ?>
