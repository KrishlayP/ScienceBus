<?php
require_once __DIR__ . '/auth.php';

function get_collection(string $module): array
{
    if ($module === 'news') {
        $data = read_json_data('news', ['news' => []]);
        return array_map(fn($image) => ['id' => md5($image), 'title' => basename($image), 'image' => $image], $data['news'] ?? []);
    }

    if ($module === 'team') {
        return load_team_data();
    }

    if ($module === 'gallery') {
        return read_json_data('gallery', ['categories' => []]);
    }

    if ($module === 'messages') {
        return read_json_data('messages', ['messages' => []]);
    }

    if ($module === 'members') {
        $data = admin_users();
        return ['users' => array_map(function ($user) {
            unset($user['password']);
            return $user;
        }, $data['users'] ?? [])];
    }

    return [];
}

function save_news_item(): void
{
    $data = read_json_data('news', ['news' => []]);
    $image = save_uploaded_image('image') ?: trim($_POST['image_path'] ?? '');

    if ($image !== '') {
        array_unshift($data['news'], $image);
        $data['news'] = array_values(array_unique($data['news']));
        write_json_data('news', $data);
    }
}

function delete_news_item(string $id): void
{
    $data = read_json_data('news', ['news' => []]);
    $data['news'] = array_values(array_filter($data['news'] ?? [], fn($image) => md5($image) !== $id));
    write_json_data('news', $data);
}

function save_team_item(): void
{
    $section = $_POST['section'] ?? 'main_team';
    $allowed = ['main_team', 'educator_team', 'operational_team'];
    if (!in_array($section, $allowed, true)) {
        $section = 'main_team';
    }

    $data = load_team_data();
    $id = trim($_POST['id'] ?? '');
    $image = save_uploaded_image('image') ?: trim($_POST['existing_image'] ?? '');
    $item = [
        'id' => $id ?: make_id(),
        'name' => trim($_POST['name'] ?? ''),
        'role' => trim($_POST['role'] ?? ''),
        'org' => trim($_POST['org'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'contact' => trim($_POST['contact'] ?? ''),
        'image' => $image,
    ];

    $updated = false;
    foreach ($data[$section] as $index => $member) {
        if (($member['id'] ?? '') === $item['id']) {
            $data[$section][$index] = $item;
            $updated = true;
            break;
        }
    }

    if (!$updated) {
        $data[$section][] = $item;
    }

    write_json_data('team', $data);
}

function delete_team_item(string $section, string $id): void
{
    $data = load_team_data();
    if (!isset($data[$section])) {
        return;
    }

    $data[$section] = array_values(array_filter($data[$section], fn($member) => ($member['id'] ?? '') !== $id));
    write_json_data('team', $data);
}

function save_gallery_item(): void
{
    $data = read_json_data('gallery', ['categories' => []]);
    $categoryIndex = (int) ($_POST['category_index'] ?? -1);
    $packageIndex = (int) ($_POST['package_index'] ?? -1);
    $categoryName = trim($_POST['category_name'] ?? 'Gallery');
    $packageName = trim($_POST['package_name'] ?? 'Album');

    if ($categoryIndex < 0 || !isset($data['categories'][$categoryIndex])) {
        $data['categories'][] = ['name' => $categoryName, 'packages' => []];
        $categoryIndex = count($data['categories']) - 1;
    } else {
        $data['categories'][$categoryIndex]['name'] = $categoryName;
    }

    if ($packageIndex < 0 || !isset($data['categories'][$categoryIndex]['packages'][$packageIndex])) {
        $data['categories'][$categoryIndex]['packages'][] = ['name' => $packageName, 'images' => []];
        $packageIndex = count($data['categories'][$categoryIndex]['packages']) - 1;
    } else {
        $data['categories'][$categoryIndex]['packages'][$packageIndex]['name'] = $packageName;
    }

    $image = save_uploaded_image('image') ?: trim($_POST['image_path'] ?? '');
    if ($image !== '') {
        $data['categories'][$categoryIndex]['packages'][$packageIndex]['images'][] = $image;
    }

    write_json_data('gallery', $data);
}

function delete_gallery_package(int $categoryIndex, int $packageIndex): void
{
    $data = read_json_data('gallery', ['categories' => []]);
    if (isset($data['categories'][$categoryIndex]['packages'][$packageIndex])) {
        array_splice($data['categories'][$categoryIndex]['packages'], $packageIndex, 1);
        write_json_data('gallery', $data);
    }
}

function delete_message_item(string $id): void
{
    $data = read_json_data('messages', ['messages' => []]);
    $data['messages'] = array_values(array_filter($data['messages'] ?? [], fn($message) => ($message['id'] ?? '') !== $id));
    write_json_data('messages', $data);
}

function save_admin_member(): void
{
    require_super_admin();
    $data = admin_users();
    $data['users'][] = [
        'id' => make_id(),
        'name' => trim($_POST['name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'password' => password_hash($_POST['password'] ?? 'Admin@123', PASSWORD_DEFAULT),
        'role' => $_POST['role'] === 'super_admin' ? 'super_admin' : 'admin',
        'created_at' => date('c'),
    ];
    save_admin_users($data);
}
