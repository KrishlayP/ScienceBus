<?php
require_once __DIR__ . '/../includes/auth.php';

function admin_header($title)
{
    require_admin();
    $user = current_admin();
    $currentPage = basename($_SERVER['PHP_SELF']);
    $action = isset($GLOBALS['adminAction']) ? $GLOBALS['adminAction'] : null;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= e($title) ?> - Science Bus Admin</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="assets/admin.js" defer></script>
        <style>
            @keyframes fadeUp {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes softPop {
                0% { transform: scale(.98); opacity: .85; }
                100% { transform: scale(1); opacity: 1; }
            }
            .admin-animate { animation: fadeUp .42s ease both; }
            .admin-card { transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease; }
            .admin-card:hover { transform: translateY(-3px); box-shadow: 0 18px 45px rgba(15, 61, 46, .10); }
            .admin-surface {
                animation: fadeUp .38s ease both;
                transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease, background-color .22s ease;
            }
            .admin-surface:hover {
                transform: translateY(-2px);
                box-shadow: 0 16px 42px rgba(15, 61, 46, .09);
                border-color: rgba(16, 185, 129, .28);
            }
            .admin-action {
                transition: transform .18s ease, box-shadow .18s ease, background-color .18s ease, color .18s ease;
            }
            .admin-action:hover { transform: translateY(-1px); box-shadow: 0 10px 22px rgba(37, 99, 235, .14); }
            .admin-nav-link { position: relative; overflow: hidden; }
            .admin-nav-link::after {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,.35), transparent);
                transform: translateX(-120%);
                transition: transform .45s ease;
            }
            .admin-nav-link:hover::after { transform: translateX(120%); }
            .admin-nav-icon { transition: transform .2s ease, background-color .2s ease, color .2s ease; }
            .admin-nav-link:hover .admin-nav-icon { transform: scale(1.08); }
            table tbody tr { transition: background-color .18s ease, transform .18s ease; }
            table tbody tr:hover { transform: translateX(2px); }
            input, select, textarea {
                transition: border-color .18s ease, box-shadow .18s ease, background-color .18s ease;
            }
            input:focus, select:focus, textarea:focus {
                border-color: rgb(16 185 129);
                box-shadow: 0 0 0 4px rgba(16, 185, 129, .12);
                outline: none;
            }
        </style>
    </head>
    <body class="h-screen overflow-hidden bg-[#f7faf7] text-[#123a2f] antialiased">
    <div class="flex h-screen flex-col overflow-hidden md:flex-row">
        <aside id="adminSidebar" class="relative m-2 shrink-0 overflow-hidden transition-all duration-300 md:m-3 md:h-[calc(100vh-1.5rem)] md:w-60 rounded-2xl bg-white/95 p-3 shadow-[0_10px_30px_rgba(15,61,46,.08)] ring-1 ring-emerald-950/5">
            <button id="sidebarToggle" type="button" class="absolute -right-3 top-8 z-10 grid h-7 w-7 place-items-center rounded-lg bg-white text-sm text-emerald-700 shadow-md ring-1 ring-emerald-950/10" aria-label="Toggle sidebar">
                <span id="sidebarToggleIcon">&lt;</span>
            </button>
            <div class="flex items-center rounded-xl bg-emerald-50/80 px-3 py-2.5">
                <div class="flex items-center gap-3">
                    <div class="grid h-9 w-9 place-items-center rounded-xl bg-emerald-600 text-sm font-semibold text-white shadow-sm">SB</div>
                    <div class="sidebar-label">
                        <div class="text-sm font-semibold tracking-tight text-[#073b2c]">Science Bus</div>
                        <div class="text-xs font-medium text-emerald-700"><?= e(str_replace('_', ' ', $user['role'])) ?></div>
                    </div>
                </div>
            </div>

            <div class="sidebar-label mt-5 hidden px-2 text-[11px] font-semibold uppercase tracking-wider text-slate-400 md:block">Manage</div>
            <nav class="mt-3 grid grid-cols-2 gap-1 md:mt-2 md:grid-cols-1">
                <?php
                $links = [
                    ['Dashboard', 'index.php', 'D'],
                    ['News', 'news.php', 'N'],
                    ['Gallery', 'gallery.php', 'G'],
                    ['Team', 'team.php', 'T'],
                    ['Messages', 'messages.php', 'M'],
                ];
                if (is_super_admin()) {
                    $links[] = ['Members', 'members.php', 'A'];
                }
                foreach ($links as $link):
                    list($label, $href, $icon) = $link;
                    $prefix = str_replace('.php', '-', $href);
                    $active = $currentPage === $href || strpos($currentPage, $prefix) === 0;
                    $classes = $active
                        ? 'bg-emerald-100/80 text-emerald-900 shadow-sm'
                        : 'text-slate-500 hover:bg-emerald-50 hover:text-emerald-800';
                ?>
                    <a class="admin-nav-link flex items-center gap-2 rounded-xl px-2.5 py-2 text-sm font-medium transition-all duration-200 md:gap-3 <?= $classes ?>" href="<?= $href ?>">
                        <span class="admin-nav-icon grid h-8 w-8 place-items-center rounded-lg text-xs <?= $active ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-500' ?>"><?= e($icon) ?></span>
                        <span class="sidebar-label relative z-[1]"><?= e($label) ?></span>
                    </a>
                <?php endforeach; ?>
            </nav>

            <div class="mt-5 hidden rounded-xl bg-[#073b2c] p-3 text-white shadow-sm md:block">
                <div class="sidebar-label text-sm font-semibold"><?= e($user['name']) ?></div>
                <div class="sidebar-label mt-1 text-xs text-emerald-100"><?= e($user['email']) ?></div>
                <div class="mt-3 grid grid-cols-2 gap-2 text-center text-xs font-semibold">
                    <a class="sidebar-label rounded-lg bg-white/10 px-2 py-2 hover:bg-white/20" href="../index.php">Website</a>
                    <a class="sidebar-label rounded-lg bg-red-400/20 px-2 py-2 text-red-50 hover:bg-red-400/30" href="logout.php">Logout</a>
                </div>
            </div>
        </aside>

        <main class="min-h-0 flex-1 overflow-hidden p-2 md:p-3">
            <div class="h-full overflow-y-auto pr-1">
            <div class="admin-animate mb-5 flex flex-col gap-3 px-1 py-1 md:flex-row md:items-center md:justify-between">
                <div>
                    <nav class="text-[12px] font-medium text-slate-400">
                        <a href="index.php" class="text-emerald-700 hover:text-emerald-900">Admin</a>
                        <span class="mx-1">/</span>
                        <span><?= e($title) ?></span>
                    </nav>
                    <h1 class="mt-1 text-2xl font-semibold tracking-tight md:text-[28px]"><?= e($title) ?></h1>
                </div>
                <div class="flex items-center gap-3">
                    <div class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-500 shadow-sm">
                        <?= date('d M Y') ?>
                    </div>
                    <?php if ($action): ?>
                        <a href="<?= e($action['href']) ?>" class="admin-action rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                            <?= e($action['label']) ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div id="adminMessage" hidden></div>
    <?php
}

function admin_footer()
{
    ?>
            </div>
        </main>
    </div>
    <script>
    (() => {
        const sidebar = document.getElementById('adminSidebar');
        const toggle = document.getElementById('sidebarToggle');
        const icon = document.getElementById('sidebarToggleIcon');
        const labels = () => sidebar.querySelectorAll('.sidebar-label');

        function setCollapsed(collapsed) {
            sidebar.classList.toggle('md:w-60', !collapsed);
            sidebar.classList.toggle('md:w-[76px]', collapsed);
            sidebar.classList.toggle('md:p-2', collapsed);
            sidebar.classList.toggle('p-3', !collapsed);
            labels().forEach(label => label.classList.toggle('md:hidden', collapsed));
            icon.textContent = collapsed ? '>' : '<';
            localStorage.setItem('scienceBusSidebarCollapsed', collapsed ? '1' : '0');
        }

        let collapsed = localStorage.getItem('scienceBusSidebarCollapsed') === '1';
        setCollapsed(collapsed);
        toggle?.addEventListener('click', () => {
            collapsed = !collapsed;
            setCollapsed(collapsed);
        });
    })();
    </script>
    </body>
    </html>
    <?php
}

function flash_message()
{
    if (empty($_SESSION['flash'])) {
        return null;
    }
    $message = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $message;
}

function set_flash($message)
{
    $_SESSION['flash'] = $message;
}

function flash_block()
{
    $message = flash_message();
    if ($message) {
        echo '<div class="mb-5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3">' . e($message) . '</div>';
    }
}
