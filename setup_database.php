<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/auth.php';

function run_sql_file(string $path): void
{
    $sql = file_get_contents($path);
    $statements = array_filter(array_map('trim', preg_split('/;\s*[\r\n]+/', $sql)));
    $pdo = db(null);

    foreach ($statements as $statement) {
        if ($statement !== '') {
            $pdo->exec($statement);
        }
    }
}

function seed_admin_users(): void
{
    if ((int) db_column('SELECT COUNT(*) FROM admin_users') > 0) {
        return;
    }

    $data = read_legacy_json_data('users', default_admin_users());
    foreach ($data['users'] ?? [] as $user) {
        db_exec(
            'INSERT INTO admin_users (id, name, email, password, role, created_at)
             VALUES (?, ?, ?, ?, ?, ?)',
            [
                $user['id'] ?? make_id(),
                $user['name'] ?? '',
                $user['email'] ?? '',
                $user['password'] ?? password_hash('Admin@123', PASSWORD_DEFAULT),
                ($user['role'] ?? '') === 'super_admin' ? 'super_admin' : 'admin',
                date('Y-m-d H:i:s', strtotime($user['created_at'] ?? 'now')),
            ]
        );
    }
}

function seed_team(): void
{
    if ((int) db_column('SELECT COUNT(*) FROM team_members') > 0) {
        return;
    }

    $data = read_legacy_json_data('team', default_team_data());
    foreach (['main_team', 'educator_team', 'operational_team'] as $section) {
        foreach (($data[$section] ?? []) as $sort => $member) {
            db_exec(
                'INSERT INTO team_members (id, section, name, role, org, email, contact, image, sort_order)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $member['id'] ?? make_id(),
                    $section,
                    $member['name'] ?? '',
                    $member['role'] ?? '',
                    $member['org'] ?? '',
                    $member['email'] ?? '',
                    $member['contact'] ?? '',
                    $member['image'] ?? '',
                    $sort,
                ]
            );
        }
    }
}

function seed_news(): void
{
    if ((int) db_column('SELECT COUNT(*) FROM news_items') > 0) {
        return;
    }

    $data = read_legacy_json_data('news', ['news' => []]);
    foreach (($data['news'] ?? []) as $sort => $image) {
        db_exec(
            'INSERT INTO news_items (id, title, image, sort_order) VALUES (?, ?, ?, ?)',
            [make_id(), basename($image), $image, $sort]
        );
    }
}

function seed_gallery(): void
{
    if ((int) db_column('SELECT COUNT(*) FROM gallery_categories') > 0) {
        return;
    }

    $data = read_legacy_json_data('gallery', ['categories' => []]);
    foreach (($data['categories'] ?? []) as $categorySort => $category) {
        db_exec(
            'INSERT INTO gallery_categories (name, sort_order) VALUES (?, ?)',
            [$category['name'] ?? 'Gallery', $categorySort]
        );
        $categoryId = (int) db()->lastInsertId();

        foreach (($category['packages'] ?? []) as $packageSort => $package) {
            db_exec(
                'INSERT INTO gallery_packages (category_id, name, sort_order) VALUES (?, ?, ?)',
                [$categoryId, $package['name'] ?? 'Album', $packageSort]
            );
            $packageId = (int) db()->lastInsertId();

            foreach (($package['images'] ?? []) as $imageSort => $image) {
                db_exec(
                    'INSERT INTO gallery_images (package_id, image, sort_order) VALUES (?, ?, ?)',
                    [$packageId, $image, $imageSort]
                );
            }
        }
    }
}

function seed_messages(): void
{
    if ((int) db_column('SELECT COUNT(*) FROM contact_messages') > 0) {
        return;
    }

    $data = read_legacy_json_data('messages', ['messages' => []]);
    foreach (($data['messages'] ?? []) as $message) {
        db_exec(
            'INSERT INTO contact_messages (id, name, email, school, message, created_at)
             VALUES (?, ?, ?, ?, ?, ?)',
            [
                $message['id'] ?? make_id(),
                $message['name'] ?? '',
                $message['email'] ?? '',
                $message['school'] ?? '',
                $message['message'] ?? '',
                date('Y-m-d H:i:s', strtotime($message['created_at'] ?? 'now')),
            ]
        );
    }
}

try {
    run_sql_file(__DIR__ . '/database.sql');
    seed_admin_users();
    seed_team();
    seed_news();
    seed_gallery();
    seed_messages();

    $summary = [
        'admin_users' => db_column('SELECT COUNT(*) FROM admin_users'),
        'team_members' => db_column('SELECT COUNT(*) FROM team_members'),
        'news_items' => db_column('SELECT COUNT(*) FROM news_items'),
        'gallery_categories' => db_column('SELECT COUNT(*) FROM gallery_categories'),
        'gallery_packages' => db_column('SELECT COUNT(*) FROM gallery_packages'),
        'gallery_images' => db_column('SELECT COUNT(*) FROM gallery_images'),
        'contact_messages' => db_column('SELECT COUNT(*) FROM contact_messages'),
    ];

    if (PHP_SAPI !== 'cli') {
        header('Content-Type: text/plain');
    }

    echo "ScienceBus database is ready.\n";
    foreach ($summary as $table => $count) {
        echo $table . ': ' . $count . "\n";
    }
} catch (Throwable $error) {
    http_response_code(500);
    echo 'Database setup failed: ' . $error->getMessage() . "\n";
    exit(1);
}
