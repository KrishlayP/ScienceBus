<?php
require_once __DIR__ . '/auth.php';

function get_collection($module)
{
    if ($module === 'news') {
        $data = load_news_data();
        return array_map(function ($image) {
            return ['id' => md5($image), 'title' => basename($image), 'image' => $image];
        }, isset($data['news']) ? $data['news'] : []);
    }

    if ($module === 'team') {
        return load_team_data();
    }

    if ($module === 'gallery') {
        return load_gallery_data();
    }

    if ($module === 'messages') {
        return load_messages_data();
    }

    if ($module === 'members') {
        $data = admin_users();
        return ['users' => array_map(function ($user) {
            unset($user['password']);
            return $user;
        }, isset($data['users']) ? $data['users'] : [])];
    }

    return [];
}

function save_news_item()
{
    $image = save_uploaded_image('image') ?: trim(isset($_POST['image_path']) ? $_POST['image_path'] : '');

    if ($image !== '') {
        db_begin();
        db_exec('UPDATE news_items SET sort_order = sort_order + 1');
        db_exec(
            'INSERT INTO news_items (id, title, image, sort_order)
             VALUES (?, ?, ?, 0)
             ON DUPLICATE KEY UPDATE title = VALUES(title), sort_order = 0',
            [make_id(), basename($image), $image]
        );
        db_commit();
    }
}

function delete_news_item($id)
{
    db_exec('DELETE FROM news_items WHERE MD5(image) = ? OR id = ?', [$id, $id]);
}

function save_team_item()
{
    $section = isset($_POST['section']) ? $_POST['section'] : 'main_team';
    $allowed = ['main_team', 'educator_team', 'operational_team'];
    if (!in_array($section, $allowed, true)) {
        $section = 'main_team';
    }

    $id = trim(isset($_POST['id']) ? $_POST['id'] : '');
    $image = save_uploaded_image('image') ?: trim(isset($_POST['existing_image']) ? $_POST['existing_image'] : '');
    $id = $id ?: make_id();
    $sortOrder = (int) db_column('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM team_members WHERE section = ?', [$section]);

    db_exec(
        'INSERT INTO team_members (id, section, name, role, org, email, contact, image, sort_order)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE
            section = VALUES(section),
            name = VALUES(name),
            role = VALUES(role),
            org = VALUES(org),
            email = VALUES(email),
            contact = VALUES(contact),
            image = VALUES(image)',
        [
            $id,
            $section,
            trim(isset($_POST['name']) ? $_POST['name'] : ''),
            trim(isset($_POST['role']) ? $_POST['role'] : ''),
            trim(isset($_POST['org']) ? $_POST['org'] : ''),
            trim(isset($_POST['email']) ? $_POST['email'] : ''),
            trim(isset($_POST['contact']) ? $_POST['contact'] : ''),
            $image,
            $sortOrder,
        ]
    );
}

function delete_team_item($section, $id)
{
    db_exec('DELETE FROM team_members WHERE section = ? AND id = ?', [$section, $id]);
}

function save_gallery_item()
{
    $categoryIndex = (int) (isset($_POST['category_index']) ? $_POST['category_index'] : -1);
    $packageIndex = (int) (isset($_POST['package_index']) ? $_POST['package_index'] : -1);
    $categoryName = trim(isset($_POST['category_name']) ? $_POST['category_name'] : 'Gallery');
    $packageName = trim(isset($_POST['package_name']) ? $_POST['package_name'] : 'Album');

    db_begin();
    $category = gallery_category_by_index($categoryIndex);
    if (!$category) {
        $categorySort = (int) db_column('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM gallery_categories');
        db_exec('INSERT INTO gallery_categories (name, sort_order) VALUES (?, ?)', [$categoryName, $categorySort]);
        $categoryId = (int) db_last_insert_id();
    } else {
        $categoryId = (int) $category['id'];
        db_exec('UPDATE gallery_categories SET name = ? WHERE id = ?', [$categoryName, $categoryId]);
    }

    $package = gallery_package_by_index($categoryId, $packageIndex);
    if (!$package) {
        $packageSort = (int) db_column('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM gallery_packages WHERE category_id = ?', [$categoryId]);
        db_exec('INSERT INTO gallery_packages (category_id, name, sort_order) VALUES (?, ?, ?)', [$categoryId, $packageName, $packageSort]);
        $packageId = (int) db_last_insert_id();
    } else {
        $packageId = (int) $package['id'];
        db_exec('UPDATE gallery_packages SET name = ? WHERE id = ?', [$packageName, $packageId]);
    }

    $image = save_uploaded_image('image') ?: trim(isset($_POST['image_path']) ? $_POST['image_path'] : '');
    if ($image !== '') {
        $imageSort = (int) db_column('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM gallery_images WHERE package_id = ?', [$packageId]);
        db_exec('INSERT INTO gallery_images (package_id, image, sort_order) VALUES (?, ?, ?)', [$packageId, $image, $imageSort]);
    }

    db_commit();
}

function delete_gallery_package($categoryIndex, $packageIndex)
{
    $category = gallery_category_by_index($categoryIndex);
    if (!$category) {
        return;
    }

    $package = gallery_package_by_index((int) $category['id'], $packageIndex);
    if ($package) {
        db_exec('DELETE FROM gallery_packages WHERE id = ?', [$package['id']]);
    }
}

function delete_message_item($id)
{
    db_exec('DELETE FROM contact_messages WHERE id = ?', [$id]);
}

function save_admin_member()
{
    require_super_admin();
    db_exec(
        'INSERT INTO admin_users (id, name, email, password, role, created_at)
         VALUES (?, ?, ?, ?, ?, NOW())',
        [
            make_id(),
            trim(isset($_POST['name']) ? $_POST['name'] : ''),
            trim(isset($_POST['email']) ? $_POST['email'] : ''),
            password_hash(isset($_POST['password']) ? $_POST['password'] : 'Admin@123', PASSWORD_DEFAULT),
            $_POST['role'] === 'super_admin' ? 'super_admin' : 'admin',
        ]
    );
}

function gallery_category_by_index($index)
{
    if ($index < 0) {
        return null;
    }

    return db_fetch_one(
        'SELECT id, name FROM gallery_categories ORDER BY sort_order ASC, id ASC LIMIT 1 OFFSET ' . $index
    );
}

function gallery_package_by_index($categoryId, $index)
{
    if ($index < 0) {
        return null;
    }

    return db_fetch_one(
        'SELECT id, name FROM gallery_packages WHERE category_id = ? ORDER BY sort_order ASC, id ASC LIMIT 1 OFFSET ' . $index,
        [$categoryId]
    );
}
