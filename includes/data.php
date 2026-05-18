<?php
require_once __DIR__ . '/database.php';

const DATA_DIR = __DIR__ . '/../assets/data';
const UPLOAD_DIR = __DIR__ . '/../assets/uploads';
const UPLOAD_WEB_PATH = 'assets/uploads/';

function data_path($name)
{
    return DATA_DIR . '/' . $name . '.json';
}

function read_json_data($name, $fallback = [])
{
    if ($name === 'news') {
        return load_news_data();
    }

    if ($name === 'gallery') {
        return load_gallery_data();
    }

    if ($name === 'messages') {
        return load_messages_data();
    }

    if ($name === 'users') {
        return load_admin_users_data();
    }

    return $fallback;
}

function read_legacy_json_data($name, $fallback = [])
{
    $path = data_path($name);
    if (!is_file($path)) {
        return $fallback;
    }

    $json = file_get_contents($path);
    $data = json_decode($json, true);
    return is_array($data) ? $data : $fallback;
}

function write_json_data($name, $data)
{
    if (!is_dir(DATA_DIR)) {
        mkdir(DATA_DIR, 0775, true);
    }

    return file_put_contents(
        data_path($name),
        json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        LOCK_EX
    ) !== false;
}

function load_news_data()
{
    $rows = db_fetch_all('SELECT image FROM news_items ORDER BY sort_order ASC, created_at DESC, id DESC');
    return ['news' => array_column($rows, 'image')];
}

function load_gallery_data()
{
    $categories = db_fetch_all('SELECT id, name FROM gallery_categories ORDER BY sort_order ASC, id ASC');
    $data = ['categories' => []];

    foreach ($categories as $category) {
        $packages = db_fetch_all(
            'SELECT id, name FROM gallery_packages WHERE category_id = ? ORDER BY sort_order ASC, id ASC',
            [$category['id']]
        );

        $categoryData = ['name' => $category['name'], 'packages' => []];
        foreach ($packages as $package) {
            $images = db_fetch_all(
                'SELECT image FROM gallery_images WHERE package_id = ? ORDER BY sort_order ASC, id ASC',
                [$package['id']]
            );

            $categoryData['packages'][] = [
                'name' => $package['name'],
                'images' => array_column($images, 'image'),
            ];
        }

        $data['categories'][] = $categoryData;
    }

    return $data;
}

function load_messages_data()
{
    return [
        'messages' => db_fetch_all(
            'SELECT id, name, email, school, message, DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") AS created_at
             FROM contact_messages
             ORDER BY created_at DESC, id DESC'
        ),
    ];
}

function load_admin_users_data()
{
    return [
        'users' => db_fetch_all(
            'SELECT id, name, email, password, role, DATE_FORMAT(created_at, "%Y-%m-%dT%H:%i:%s") AS created_at
             FROM admin_users
             ORDER BY created_at ASC, name ASC'
        ),
    ];
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect_to($path)
{
    header('Location: ' . $path);
    exit;
}

function make_id()
{
    return bin2hex(random_bytes(8));
}

function save_uploaded_image($field)
{
    if (empty($_FILES[$field]['name']) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $tmp = $_FILES[$field]['tmp_name'];
    $mime = mime_content_type($tmp);
    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
    ];

    if (!isset($allowed[$mime])) {
        return null;
    }

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0775, true);
    }

    $fileName = date('YmdHis') . '-' . make_id() . '.' . $allowed[$mime];
    $destination = UPLOAD_DIR . '/' . $fileName;

    if (!move_uploaded_file($tmp, $destination)) {
        return null;
    }

    return UPLOAD_WEB_PATH . $fileName;
}

function default_team_data()
{
    return [
        'main_team' => [
            [
                'id' => make_id(),
                'name' => 'Prof. Deepu Philip',
                'role' => 'Professor, DOMS Department',
                'org' => 'IIT Kanpur',
                'email' => 'dphilip@iitk.ac.in',
                'contact' => '',
                'image' => 'assets/image/Team/ProfDeepuPhilip.png',
            ],
            [
                'id' => make_id(),
                'name' => 'Dr. Sumit Kumar Srivastava',
                'role' => 'Scientific Officer',
                'org' => 'C.S.T Department, UP',
                'email' => 'sumit.astro.physics@gmail.com',
                'contact' => '',
                'image' => 'assets/image/Team/sumitkumarsr.jpeg',
            ],
            [
                'id' => make_id(),
                'name' => 'Rachna Agrawal',
                'role' => 'Project Executive Officer',
                'org' => 'IIT Kanpur',
                'email' => 'rachna@iitk.ac.in',
                'contact' => '',
                'image' => 'assets/image/Team/rachna.jpeg',
            ],
        ],
        'educator_team' => [
            [
                'id' => make_id(),
                'name' => 'Mr. Rinku',
                'role' => 'Educator',
                'org' => '',
                'email' => 'rinkugangwar9991@gmail.com',
                'contact' => '9451237404',
                'image' => 'assets/image/Team/rinku.jpeg',
            ],
            [
                'id' => make_id(),
                'name' => 'Mr. Brikesh Kumar',
                'role' => 'Educator',
                'org' => '',
                'email' => 'brikesh.kumar.0108@gmail.com',
                'contact' => '7860134226',
                'image' => 'assets/image/Team/brikesh.jpeg',
            ],
        ],
        'operational_team' => [
            [
                'id' => make_id(),
                'name' => 'Mr. Ashish Tripathi',
                'role' => 'Operational Manager',
                'org' => 'IIT Kanpur',
                'email' => 'ashishkt@iitk.ac.in',
                'contact' => '',
                'image' => 'assets/image/Team/ashish.jpeg',
            ],
            [
                'id' => make_id(),
                'name' => 'Mr. Subhashish Panday',
                'role' => 'Lab Technician',
                'org' => '',
                'email' => 'pshubhashish8@gmail.com',
                'contact' => '9794370873',
                'image' => 'assets/image/Team/Shubhashish.jpeg',
            ],
            [
                'id' => make_id(),
                'name' => 'Mr. Devendra Mishra',
                'role' => 'Bus Driver',
                'org' => '',
                'email' => 'devendramishra225@gmail.com',
                'contact' => '9838577697',
                'image' => 'assets/image/Team/devendra.jpeg',
            ],
        ],
    ];
}

function load_team_data()
{
    $rows = db_fetch_all(
        'SELECT id, section, name, role, org, email, contact, image
         FROM team_members
         ORDER BY FIELD(section, "main_team", "educator_team", "operational_team"), sort_order ASC, created_at ASC'
    );

    $data = [
        'main_team' => [],
        'educator_team' => [],
        'operational_team' => [],
    ];

    foreach ($rows as $row) {
        $section = $row['section'];
        unset($row['section']);
        if (isset($data[$section])) {
            $data[$section][] = $row;
        }
    }

    return $data;
}
