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

    if ($module === 'home_slider') {
        return load_home_slider_data();
    }

    if ($module === 'team') {
        return load_team_data();
    }

    if ($module === 'gallery') {
        return load_gallery_data();
    }

    if ($module === 'tour_profile') {
        return load_tour_profile_data();
    }

    if ($module === 'messages') {
        return load_messages_data();
    }

    if ($module === 'social_impact') {
        return load_social_impact_data();
    }

    if ($module === 'members') {
        $data = admin_users();
        return ['users' => array_map(function ($user) {
            unset($user['password']);
            $user['role'] = normalize_admin_role(isset($user['role']) ? $user['role'] : '');
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

function home_slider_item($id)
{
    ensure_home_slider_tables();
    return db_fetch_one('SELECT id, title, image FROM home_slider_items WHERE id = ?', [$id]);
}

function save_home_slider_item()
{
    ensure_home_slider_tables();

    $id = trim(isset($_POST['id']) ? $_POST['id'] : '');
    $existingImage = trim(isset($_POST['existing_image']) ? $_POST['existing_image'] : '');
    $image = save_uploaded_image('image') ?: trim(isset($_POST['image_path']) ? $_POST['image_path'] : '');
    if ($image === '') {
        $image = $existingImage;
    }

    if ($image === '') {
        throw new RuntimeException('Please upload an image or enter an image path.');
    }

    $title = trim(isset($_POST['title']) ? $_POST['title'] : '');
    if ($title === '') {
        $title = pathinfo(basename($image), PATHINFO_FILENAME);
    }

    if ($id !== '') {
        db_exec(
            'UPDATE home_slider_items SET title = ?, image = ? WHERE id = ?',
            [$title, $image, $id]
        );
        return;
    }

    $sortOrder = (int) db_column('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM home_slider_items');
    db_exec(
        'INSERT INTO home_slider_items (id, title, image, sort_order)
         VALUES (?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE title = VALUES(title), image = VALUES(image)',
        [make_id(), $title, $image, $sortOrder]
    );
}

function delete_home_slider_item($id)
{
    ensure_home_slider_tables();
    db_exec('DELETE FROM home_slider_items WHERE id = ? OR MD5(image) = ?', [$id, $id]);
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
    $selectedCategory = trim(isset($_POST['existing_category']) ? $_POST['existing_category'] : '');
    $selectedPackage = trim(isset($_POST['existing_package']) ? $_POST['existing_package'] : '');
    $categoryName = trim(isset($_POST['category_name']) ? $_POST['category_name'] : '');
    $packageName = trim(isset($_POST['package_name']) ? $_POST['package_name'] : '');

    if ($categoryName === '' && $selectedCategory !== '') {
        $categoryName = $selectedCategory;
    }

    if ($packageName === '' && $selectedPackage !== '') {
        $packageName = $selectedPackage;
    }

    $categoryName = $categoryName !== '' ? $categoryName : 'Location';
    $packageName = $packageName !== '' ? $packageName : 'Album';

    db_begin();
    $category = $categoryIndex >= 0
        ? gallery_category_by_index($categoryIndex)
        : gallery_category_by_name($categoryName);

    if (!$category) {
        $categorySort = (int) db_column('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM gallery_categories');
        db_exec('INSERT INTO gallery_categories (name, sort_order) VALUES (?, ?)', [$categoryName, $categorySort]);
        $categoryId = (int) db_last_insert_id();
    } else {
        $categoryId = (int) $category['id'];
        db_exec('UPDATE gallery_categories SET name = ? WHERE id = ?', [$categoryName, $categoryId]);
    }

    $package = $packageIndex >= 0
        ? gallery_package_by_index($categoryId, $packageIndex)
        : gallery_package_by_name($categoryId, $packageName);

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

function save_tour_profile_stats()
{
    ensure_tour_profile_tables();
    $stats = [
        'total_tours' => trim(isset($_POST['total_tours']) ? $_POST['total_tours'] : ''),
        'people_benefitted' => trim(isset($_POST['people_benefitted']) ? $_POST['people_benefitted'] : ''),
        'districts_covered' => trim(isset($_POST['districts_covered']) ? $_POST['districts_covered'] : ''),
        'active_period' => trim(isset($_POST['active_period']) ? $_POST['active_period'] : ''),
    ];

    foreach ($stats as $key => $value) {
        db_exec(
            'INSERT INTO tour_profile_stats (stat_key, stat_value)
             VALUES (?, ?)
             ON DUPLICATE KEY UPDATE stat_value = VALUES(stat_value)',
            [$key, $value]
        );
    }
}

function save_tour_profile_item()
{
    ensure_tour_profile_tables();
    $id = (int) (isset($_POST['id']) ? $_POST['id'] : 0);
    $tourStart = trim(isset($_POST['tour_start']) ? $_POST['tour_start'] : '');
    $tourEnd = trim(isset($_POST['tour_end']) ? $_POST['tour_end'] : '');
    $district = trim(isset($_POST['district']) ? $_POST['district'] : '');
    $description = trim(isset($_POST['description']) ? $_POST['description'] : '');

    if ($district === '' || $description === '') {
        throw new RuntimeException('District and description are required.');
    }

    if ($id > 0) {
        db_exec(
            'UPDATE tour_profile_items SET tour_start = NULLIF(?, ""), tour_end = NULLIF(?, ""), district = ?, description = ? WHERE id = ?',
            [$tourStart, $tourEnd, $district, $description, $id]
        );
        return;
    }

    $sortOrder = (int) db_column('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM tour_profile_items');
    db_exec(
        'INSERT INTO tour_profile_items (tour_start, tour_end, district, description, sort_order) VALUES (NULLIF(?, ""), NULLIF(?, ""), ?, ?, ?)',
        [$tourStart, $tourEnd, $district, $description, $sortOrder]
    );
}

function delete_tour_profile_item($id)
{
    ensure_tour_profile_tables();
    db_exec('DELETE FROM tour_profile_items WHERE id = ?', [(int) $id]);
}

function delete_message_item($id)
{
    db_exec('DELETE FROM contact_messages WHERE id = ?', [$id]);
}

function save_social_impact_item()
{
    ensure_social_impact_tables();

    $id = trim(isset($_POST['id']) ? $_POST['id'] : '');
    $username = trim(isset($_POST['username']) ? $_POST['username'] : '');
    $description = trim(isset($_POST['description']) ? $_POST['description'] : '');
    $rating = max(1, min(5, (int) (isset($_POST['rating']) ? $_POST['rating'] : 5)));

    if ($username === '' || $description === '') {
        throw new RuntimeException('Username and description are required.');
    }

    if ($id !== '') {
        db_exec(
            'UPDATE social_impact_testimonials SET username = ?, description = ?, rating = ? WHERE id = ?',
            [$username, $description, $rating, $id]
        );
        return;
    }

    $sortOrder = (int) db_column('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM social_impact_testimonials');
    db_exec(
        'INSERT INTO social_impact_testimonials (id, username, description, rating, sort_order)
         VALUES (?, ?, ?, ?, ?)',
        [make_id(), $username, $description, $rating, $sortOrder]
    );
}

function delete_social_impact_item($id)
{
    ensure_social_impact_tables();
    db_exec('DELETE FROM social_impact_testimonials WHERE id = ?', [trim($id)]);
}

function save_admin_member()
{
    require_super_admin();
    $email = strtolower(trim(isset($_POST['email']) ? $_POST['email'] : ''));
    if ($email === '') {
        throw new RuntimeException('Email is required.');
    }

    db_exec(
        'INSERT INTO admin_users (id, name, email, password, role, created_at)
         VALUES (?, ?, ?, ?, ?, NOW())',
        [
            make_id(),
            trim(isset($_POST['name']) ? $_POST['name'] : ''),
            $email,
            password_hash(isset($_POST['password']) ? $_POST['password'] : 'Admin@123', PASSWORD_DEFAULT),
            'admin',
        ]
    );
}

function delete_admin_member($id)
{
    require_super_admin();
    $id = trim($id);
    $current = current_admin();
    if ($id === '' || ($current && $id === $current['id'])) {
        throw new RuntimeException('You cannot delete the current super admin account.');
    }

    db_exec('DELETE FROM admin_users WHERE id = ? AND role = "admin"', [$id]);
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

function gallery_category_by_name($name)
{
    if ($name === '') {
        return null;
    }

    return db_fetch_one(
        'SELECT id, name FROM gallery_categories WHERE LOWER(name) = LOWER(?) ORDER BY sort_order ASC, id ASC LIMIT 1',
        [$name]
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

function gallery_package_by_name($categoryId, $name)
{
    if ($name === '') {
        return null;
    }

    return db_fetch_one(
        'SELECT id, name FROM gallery_packages WHERE category_id = ? AND LOWER(name) = LOWER(?) ORDER BY sort_order ASC, id ASC LIMIT 1',
        [$categoryId, $name]
    );
}
