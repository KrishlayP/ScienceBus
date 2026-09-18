<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/theme.php';
require_once __DIR__ . '/components/header-bus.php';

function admin_nav_icon($name)
{
    $icons = [
        'dashboard' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/></svg>',
        'slider' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m7 15 3-3 3 3 2-2 3 3"/><circle cx="16" cy="9" r="1.5"/></svg>',
        'news' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 4h12a2 2 0 0 1 2 2v14H7a2 2 0 0 1-2-2V4Z"/><path d="M19 8h2v10a2 2 0 0 1-2 2M8 8h7M8 12h7M8 16h4"/></svg>',
        'tour' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 19V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v13"/><path d="M2 19h20M8 4v15M16 4v15M8 10h8"/></svg>',
        'gallery' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="9" cy="9" r="2"/><path d="m21 15-4-4L7 21"/></svg>',
        'team' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'impact' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 21s-7-4.35-7-10a4 4 0 0 1 7-2.65A4 4 0 0 1 19 11c0 5.65-7 10-7 10Z"/><path d="M8 12h2l1-2 2 4 1-2h2"/></svg>',
        'messages' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"/><path d="M8 9h8M8 13h5"/></svg>',
        'members' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0M19 5v6M16 8h6"/></svg>',
    ];

    return isset($icons[$name]) ? $icons[$name] : $icons['dashboard'];
}

function admin_header($title)
{
    require_admin();
    $user = current_admin();
    $currentPage = basename($_SERVER['PHP_SELF']);
    $action = isset($GLOBALS['adminAction']) ? $GLOBALS['adminAction'] : null;
    $theme = admin_theme();
    $css = $theme['css'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= e($title) ?> - Science Bus Admin</title>
        <script>
            (() => {
                const savedTheme = localStorage.getItem('scienceBusAdminTheme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                document.documentElement.dataset.adminTheme = savedTheme || (prefersDark ? 'night' : 'day');
            })();
        </script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="assets/admin.js?v=4"></script>
        <script type="module" src="assets/admin-animations.js"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500;600;700;800&display=swap');
            * { box-sizing: border-box; }
            @keyframes fadeUp {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes softPop {
                0% { transform: scale(.98); opacity: .85; }
                100% { transform: scale(1); opacity: 1; }
            }
            @keyframes dashboardBusRide {
                0%, 5% { left: 112px; opacity: 0; transform: translateY(1px) scale(.92); }
                12% { opacity: 1; }
                78% { opacity: 1; }
                92%, 100% { left: calc(100% - 112px); opacity: 0; transform: translateY(1px) scale(.92); }
            }
            @keyframes dashboardBusSmoke {
                0% { opacity: 0; transform: translate(0, 0) scale(.45); }
                25% { opacity: .55; }
                100% { opacity: 0; transform: translate(-13px, -9px) scale(1.35); }
            }
            :root {
                --admin-bg: <?= e($css['bg']) ?>;
                --admin-card: <?= e($css['card']) ?>;
                --admin-border: <?= e($css['border']) ?>;
                --admin-muted: <?= e($css['muted']) ?>;
                --admin-ink: <?= e($css['ink']) ?>;
                --admin-primary: <?= e($css['primary']) ?>;
                --admin-primary-light: <?= e($css['primary_light']) ?>;
                --admin-primary-dark: <?= e($css['primary_dark']) ?>;
                --admin-button-start: <?= e($css['button_start']) ?>;
                --admin-button-end: <?= e($css['button_end']) ?>;
                --admin-button-hover-start: <?= e($css['button_hover_start']) ?>;
                --admin-button-hover-end: <?= e($css['button_hover_end']) ?>;
                --admin-ring: <?= e($css['ring']) ?>;
                --admin-shadow: <?= e($css['shadow']) ?>;
            }
            body { font-family: 'Nunito Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f5f7fb !important; }
            #adminSidebar {
                border-width: 0 1px 0 0 !important;
                border-color: #e2e8f0 !important;
                border-radius: 0 !important;
                box-shadow: none !important;
            }
            .admin-brand-mark {
                background: linear-gradient(135deg, #3b82f6, #1d4ed8);
                box-shadow: 0 8px 20px rgba(37, 99, 235, .22);
            }
            .admin-topbar {
                min-height: 76px;
                border-bottom: 1px solid rgba(226, 232, 240, .85);
                background: rgba(255,255,255,.92);
                backdrop-filter: blur(16px);
            }
            .admin-page-scroll { background: #f5f7fb; }
            .admin-animate { opacity: 1; }
            .admin-card {
                border: 1px solid #dbeafe;
                background: var(--admin-card);
                border-radius: 14px;
                box-shadow: 0 2px 8px rgba(15, 23, 42, .035);
                transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
            }
            .admin-card:hover {
                transform: translateY(-2px);
                border-color: var(--admin-primary-light);
                box-shadow: 0 12px 30px var(--admin-shadow);
            }
            .admin-surface {
                border: 1px solid #dbeafe;
                background: var(--admin-card);
                border-radius: 14px;
                box-shadow: 0 2px 8px rgba(15, 23, 42, .035);
                transition: box-shadow .18s ease, border-color .18s ease, background-color .18s ease;
            }
            .admin-surface:hover {
                box-shadow: 0 12px 30px var(--admin-shadow);
                border-color: var(--admin-primary-light);
            }
            .admin-action {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 10px;
                font-weight: 600;
                transition: background-color .16s ease, border-color .16s ease, color .16s ease, box-shadow .16s ease;
            }
            .admin-action:hover { box-shadow: 0 8px 22px var(--admin-shadow); }
            .admin-nav-link { position: relative; overflow: hidden; min-height: 44px; }
            .admin-nav-link.is-active { box-shadow: inset 3px 0 0 #2563eb; }
            .admin-nav-icon { transition: transform .2s ease, background-color .2s ease, color .2s ease; }
            .admin-nav-icon svg { width: 19px; height: 19px; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
            table tbody tr { transition: background-color .16s ease; }
            table tbody tr:hover { background-color: var(--admin-bg); }
            input, select, textarea {
                border-color: var(--admin-border);
                background: #fff;
                color: var(--admin-ink);
                transition: border-color .16s ease, box-shadow .16s ease, background-color .16s ease;
            }
            input:focus, select:focus, textarea:focus {
                border-color: var(--admin-primary-light);
                box-shadow: 0 0 0 4px var(--admin-ring);
                outline: none;
            }
            .admin-kbd {
                border: 1px solid var(--admin-border);
                border-radius: 8px;
                background: var(--admin-bg);
                color: var(--admin-muted);
                font-size: 12px;
                font-weight: 600;
                padding: 2px 8px;
            }
            .admin-loading { display: flex; align-items: center; justify-content: center; gap: 10px; min-height: 72px; grid-column: 1 / -1; color: #64748b; font-size: 13px; font-weight: 700; }
            .admin-loader { width: 18px; height: 18px; border: 2px solid #bfdbfe; border-top-color: #2563eb; border-radius: 999px; animation: adminSpin .7s linear infinite; }
            .admin-skeleton-card, .admin-skeleton-row { border: 1px solid #e5e7eb; border-radius: 12px; background: linear-gradient(90deg, #f8fafc 25%, #eaf2ff 37%, #f8fafc 63%); background-size: 400% 100%; animation: adminShimmer 1.35s ease-in-out infinite; }
            .admin-skeleton-card { min-height: 150px; padding: 18px; }
            .admin-skeleton-card span { display: block; height: 10px; margin-bottom: 13px; border-radius: 999px; background: rgba(148,163,184,.2); }
            .admin-skeleton-card span:first-child { width: 34%; height: 28px; }
            .admin-skeleton-card span:last-child { width: 55%; }
            .admin-skeleton-row { height: 48px; margin: 8px 0; }
            .admin-pagination { display: flex; align-items: center; justify-content: space-between; gap: 14px; border-top: 1px solid var(--admin-border); margin-top: 10px; padding: 14px 4px 2px; color: #64748b; font-size: 12px; font-weight: 700; }
            .admin-pagination-actions { display: flex; align-items: center; gap: 9px; }
            .admin-pagination-actions button { display: grid; width: 34px; height: 34px; place-items: center; border: 1px solid #bfdbfe; border-radius: 10px; color: #2563eb; background: #fff; transition: background-color .16s ease, color .16s ease, opacity .16s ease; }
            .admin-pagination-actions button:hover:not(:disabled) { color: #fff; background: #2563eb; }
            .admin-pagination-actions button:disabled { cursor: not-allowed; opacity: .35; }
            .admin-pagination-pages { min-width: 48px; text-align: center; color: var(--admin-ink); }
            .admin-filter { display: flex; height: 42px; align-items: center; gap: 10px; margin-bottom: 14px; border: 1px solid #bfdbfe; border-radius: 12px; padding: 0 12px; color: #64748b; background: var(--admin-card); }
            .admin-filter svg { width: 18px; height: 18px; flex: 0 0 auto; stroke: #3b82f6; stroke-width: 1.8; stroke-linecap: round; }
            .admin-filter input { min-width: 0; flex: 1; border: 0 !important; outline: 0; padding: 0; background: transparent !important; box-shadow: none !important; font-size: 13px; }
            .admin-filter span { flex: 0 0 auto; color: #94a3b8; font-size: 11px; font-weight: 700; }
            .admin-list-filter { max-width: 420px; }
            .admin-surface img { content-visibility: auto; }
            #sliderRows tr { contain: layout paint; }
            @keyframes adminSpin { to { transform: rotate(360deg); } }
            @keyframes adminShimmer { 0% { background-position: 100% 0; } 100% { background-position: 0 0; } }
            @media (prefers-reduced-motion: reduce) { .admin-loader, .admin-skeleton-card, .admin-skeleton-row { animation: none; } }
            .admin-action.bg-slate-950,
            .admin-action.bg-slate-900,
            button.admin-action.bg-slate-950,
            a.admin-action.bg-slate-950 {
                background: linear-gradient(135deg, var(--admin-button-start), var(--admin-button-end)) !important;
                color: #fff !important;
            }
            .admin-action.bg-slate-950:hover,
            .admin-action.bg-slate-900:hover {
                background: linear-gradient(135deg, var(--admin-button-hover-start), var(--admin-button-hover-end)) !important;
            }
            .admin-action.text-blue-700,
            .admin-action.text-slate-700 {
                color: var(--admin-primary-dark) !important;
            }
            .admin-action.border,
            .admin-card,
            .admin-surface {
                border-color: var(--admin-border) !important;
            }
            .dashboard-bus-route {
                pointer-events: none;
                position: absolute;
                inset: 0;
                overflow: hidden;
                border-radius: 12px;
            }
            .dashboard-bus {
                position: absolute;
                bottom: 3px;
                left: 112px;
                z-index: 1;
                width: 90px;
                color: var(--admin-primary);
                filter: drop-shadow(0 3px 3px rgba(37, 99, 235, .18));
                animation: dashboardBusRide 14s linear infinite;
            }
            .dashboard-bus-wheel {
                transform-box: fill-box;
                transform-origin: center;
                animation: dashboardBusWheel 1s linear infinite;
            }
            .dashboard-bus-smoke {
                fill: #64748b;
                filter: drop-shadow(0 1px 1px rgba(15, 23, 42, .18));
                transform-box: fill-box;
                transform-origin: center;
                animation: dashboardBusSmoke 1.8s ease-out infinite;
            }
            .dashboard-bus-smoke:nth-of-type(2) { animation-delay: -.6s; }
            .dashboard-bus-smoke:nth-of-type(3) { animation-delay: -1.2s; }
            .dashboard-bus-headlight {
                display: none;
                fill: url(#dashboardHeadlightGlow);
                opacity: .75;
            }
            .theme-toggle-icon { display: none; }
            html[data-admin-theme="day"] .theme-icon-sun,
            html[data-admin-theme="night"] .theme-icon-moon { display: block; }
            html[data-admin-theme="night"] {
                color-scheme: dark;
                --admin-bg: #081225;
                --admin-card: #101c31;
                --admin-border: #263958;
                --admin-muted: #93c5fd;
                --admin-ink: #e5eefc;
                --admin-primary: #60a5fa;
                --admin-primary-light: #3b82f6;
                --admin-primary-dark: #bfdbfe;
                --admin-shadow: rgba(0, 0, 0, .3);
            }
            html[data-admin-theme="night"] body.bg-blue-50 { background: #081225 !important; color: #e5eefc !important; }
            html[data-admin-theme="night"] #adminSidebar,
            html[data-admin-theme="night"] .admin-card,
            html[data-admin-theme="night"] .admin-surface,
            html[data-admin-theme="night"] .bg-white { background-color: #101c31 !important; }
            html[data-admin-theme="night"] .bg-blue-50,
            html[data-admin-theme="night"] .bg-slate-50 { background-color: #14233b !important; }
            html[data-admin-theme="night"] .border-blue-200,
            html[data-admin-theme="night"] .border-slate-200 { border-color: #263958 !important; }
            html[data-admin-theme="night"] .text-slate-950,
            html[data-admin-theme="night"] .text-slate-900,
            html[data-admin-theme="night"] .text-slate-800,
            html[data-admin-theme="night"] .text-slate-700 { color: #e5eefc !important; }
            html[data-admin-theme="night"] .text-slate-600 { color: #b8c7dc !important; }
            html[data-admin-theme="night"] .text-slate-500,
            html[data-admin-theme="night"] .text-slate-400 { color: #9fb0ca !important; }
            html[data-admin-theme="night"] table .font-semibold,
            html[data-admin-theme="night"] table .font-bold {
                color: #edf5ff !important;
                text-shadow: 0 0 12px rgba(96, 165, 250, .12);
            }
            html[data-admin-theme="night"] input,
            html[data-admin-theme="night"] select,
            html[data-admin-theme="night"] textarea { background: #0c1729; color: #e5eefc; }
            html[data-admin-theme="night"] table tbody tr:hover { background-color: #14233b; }
            html[data-admin-theme="night"] table th,
            html[data-admin-theme="night"] table td { border-color: #263958 !important; }
            html[data-admin-theme="night"] .dashboard-bus-headlight { display: block; }
            html[data-admin-theme="night"] .dashboard-bus-smoke { fill: #94a3b8; }
            html[data-admin-theme="night"] .dashboard-bus { filter: drop-shadow(0 3px 4px rgba(96, 165, 250, .3)); }
            html[data-admin-theme="night"] #themeToggle { background: #101c31; border-color: #36517a; color: #facc15; }
            html[data-admin-theme="night"] body { background: #081225 !important; }
            html[data-admin-theme="night"] .admin-topbar { background: rgba(16,28,49,.94); border-color: #263958; }
            html[data-admin-theme="night"] .admin-page-scroll { background: #081225; }
            @keyframes dashboardBusWheel {
                to { transform: rotate(360deg); }
            }
            @media (max-width: 767px) {
                .dashboard-bus-route { display: none; }
                #adminSidebar { flex: 0 0 auto; width: 100%; }
                #adminSidebar > div:first-of-type { height: 60px; }
                #adminSidebar nav {
                    display: flex;
                    gap: 6px;
                    margin-top: 0;
                    overflow-x: auto;
                    padding: 8px 10px;
                    scrollbar-width: none;
                }
                #adminSidebar nav::-webkit-scrollbar { display: none; }
                #adminSidebar .admin-nav-link { flex: 0 0 auto; min-height: 42px; }
                .admin-topbar { min-height: 112px; }
                .admin-page-scroll { height: calc(100vh - 214px); }
            }
            @media (prefers-reduced-motion: reduce) {
                .dashboard-bus { display: none; }
            }
        </style>
    </head>
    <body class="h-screen overflow-hidden <?= e($theme['body']) ?> antialiased">
    <div class="flex h-screen flex-col overflow-hidden md:flex-row">
        <aside id="adminSidebar" class="relative z-40 shrink-0 overflow-visible border <?= e($theme['sidebar_border']) ?> bg-white transition-all duration-300 md:h-screen md:w-[250px]">
            <button id="sidebarToggle" type="button" class="absolute right-0 top-5 z-50 hidden h-9 w-9 translate-x-1/2 place-items-center bg-transparent text-blue-600 transition hover:text-blue-800 focus:outline-none md:grid" aria-label="Toggle sidebar">
                <svg id="sidebarToggleIcon" class="h-4 w-4 transition-transform duration-300" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="M12.5 5 7.5 10l5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div class="flex h-[76px] items-center border-b border-slate-200 px-4">
                <div class="flex items-center gap-3">
                    <div class="admin-brand-mark grid h-10 w-10 place-items-center rounded-xl text-sm font-bold text-white">SB</div>
                    <div class="sidebar-label">
                        <div class="text-[17px] font-extrabold tracking-tight text-slate-950">Science Bus</div>
                        <div class="text-xs font-medium text-slate-500">Content management</div>
                    </div>
                </div>
            </div>

            <div class="sidebar-label mt-5 hidden px-[22px] text-[11px] font-bold uppercase tracking-[.14em] text-slate-400 md:block">Workspace</div>
            <nav class="mt-3 grid grid-cols-2 gap-1 px-2.5 md:grid-cols-1">
                <?php
                $links = [
                    ['Dashboard', 'index.php', 'dashboard'],
                    ['Home Slider', 'home-slider.php', 'slider'],
                    ['News', 'news.php', 'news'],
                    ['Tour Profile', 'tour-profile.php', 'tour'],
                    ['Gallery', 'gallery.php', 'gallery'],
                    ['Team', 'team.php', 'team'],
                    ['Social Impact', 'social-impact.php', 'impact'],
                    ['Messages', 'messages.php', 'messages'],
                ];
                if (is_super_admin()) {
                    $links[] = ['Members', 'members.php', 'members'];
                }
                foreach ($links as $link):
                    list($label, $href, $icon) = $link;
                    $prefix = str_replace('.php', '-', $href);
                    $active = $currentPage === $href || strpos($currentPage, $prefix) === 0;
                    $classes = $active ? $theme['nav_active'] : $theme['nav_idle'];
                    $iconClasses = $active ? $theme['nav_icon_active'] : $theme['nav_icon_idle'];
                ?>
                    <a class="admin-nav-link <?= $active ? 'is-active' : '' ?> flex items-center gap-2 rounded-xl px-3 py-2 text-[15px] font-semibold transition-all duration-200 md:gap-3 <?= $classes ?>" href="<?= $href ?>">
                        <span class="admin-nav-icon grid h-8 w-8 place-items-center rounded-lg text-xs <?= e($iconClasses) ?>"><?= admin_nav_icon($icon) ?></span>
                        <span class="sidebar-label relative z-[1]"><?= e($label) ?></span>
                    </a>
                <?php endforeach; ?>
            </nav>

            <div class="absolute inset-x-0 bottom-0 hidden min-h-[78px] items-center gap-3 border-t border-slate-200 bg-white p-3 md:flex">
                <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-blue-100 text-sm font-extrabold text-blue-700"><?= e(strtoupper(substr($user['name'], 0, 2))) ?></div>
                <div class="sidebar-label min-w-0 flex-1">
                    <div class="truncate text-sm font-bold text-slate-900"><?= e($user['name']) ?></div>
                    <div class="mt-0.5 truncate text-xs text-slate-500"><?= e(admin_role_label($user['role'])) ?></div>
                </div>
                <div class="sidebar-label flex items-center">
                    <a class="grid h-9 w-9 place-items-center rounded-lg text-slate-400 hover:bg-blue-50 hover:text-blue-700" href="../index.php" title="Open website" aria-label="Open website">
                        <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="M3 12h18M12 3c2.3 2.5 3.5 5.5 3.5 9S14.3 18.5 12 21M12 3c-2.3 2.5-3.5 5.5-3.5 9S9.7 18.5 12 21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    </a>
                    <a class="grid h-9 w-9 place-items-center rounded-lg text-slate-400 hover:bg-red-50 hover:text-red-600" href="logout.php" title="Log out" aria-label="Log out">
                        <svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M10 5H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h4M14 8l4 4-4 4M9 12h9" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </div>
        </aside>

        <main class="min-h-0 flex-1 overflow-hidden">
            <div class="admin-topbar admin-animate flex flex-col gap-3 px-5 py-3 md:flex-row md:items-center md:justify-between md:px-7">
                <div class="relative z-10">
                    <nav class="text-[12px] font-medium <?= e($theme['section_text']) ?>">
                        <a href="index.php" class="<?= e($theme['link']) ?>">Admin</a>
                        <span class="mx-1">/</span>
                        <span><?= e($title) ?></span>
                    </nav>
                    <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-950 md:text-[28px]"><?= e($title) ?></h1>
                </div>
                <div class="relative z-10 flex items-center gap-3">
                    <button id="themeToggle" type="button" class="grid h-10 w-10 place-items-center rounded-xl border border-blue-200 bg-white text-blue-700 shadow-sm transition hover:bg-blue-50" aria-label="Switch to night mode" title="Switch theme">
                        <svg class="theme-toggle-icon theme-icon-sun h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 3V1m0 22v-2M3 12H1m22 0h-2M4.22 4.22 2.8 2.8m18.4 18.4-1.42-1.42m0-15.56L21.2 2.8M2.8 21.2l1.42-1.42" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <circle cx="12" cy="12" r="4.5" stroke="currentColor" stroke-width="1.8"/>
                        </svg>
                        <svg class="theme-toggle-icon theme-icon-moon h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M20.5 15.2A8.5 8.5 0 0 1 8.8 3.5 8.5 8.5 0 1 0 20.5 15.2Z" fill="currentColor"/>
                        </svg>
                    </button>
                    <div class="shrink-0 whitespace-nowrap rounded-xl border px-4 py-2 text-sm font-medium shadow-sm <?= e($theme['date_badge']) ?>">
                        <?= date('d M Y') ?>
                    </div>
                    <?php if ($action): ?>
                        <a href="<?= e($action['href']) ?>" class="admin-action px-5 py-2.5 text-sm text-white shadow-sm <?= e($theme['primary_button']) ?>">
                            <?= e($action['label']) ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="admin-page-scroll h-[calc(100vh-76px)] overflow-y-auto p-4 md:p-7">
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
        const themeToggle = document.getElementById('themeToggle');
        const labels = () => sidebar.querySelectorAll('.sidebar-label');

        function setCollapsed(collapsed) {
            sidebar.classList.toggle('md:w-[250px]', !collapsed);
            sidebar.classList.toggle('md:w-[76px]', collapsed);
            labels().forEach(label => label.classList.toggle('md:hidden', collapsed));
            icon.classList.toggle('rotate-180', collapsed);
            localStorage.setItem('scienceBusSidebarCollapsed', collapsed ? '1' : '0');
        }

        let collapsed = localStorage.getItem('scienceBusSidebarCollapsed') === '1';
        setCollapsed(collapsed);
        toggle?.addEventListener('click', () => {
            collapsed = !collapsed;
            setCollapsed(collapsed);
        });

        function setAdminTheme(theme) {
            document.documentElement.dataset.adminTheme = theme;
            localStorage.setItem('scienceBusAdminTheme', theme);
            themeToggle?.setAttribute('aria-label', theme === 'night' ? 'Switch to day mode' : 'Switch to night mode');
        }

        setAdminTheme(document.documentElement.dataset.adminTheme || 'day');
        themeToggle?.addEventListener('click', () => {
            setAdminTheme(document.documentElement.dataset.adminTheme === 'night' ? 'day' : 'night');
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
        echo '<div class="mb-5 rounded-lg border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm">' . e($message) . '</div>';
    }
}
