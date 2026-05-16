<?php
const DATA_DIR = __DIR__ . '/../assets/data';
const UPLOAD_DIR = __DIR__ . '/../assets/uploads';
const UPLOAD_WEB_PATH = 'assets/uploads/';

function data_path(string $name): string
{
    return DATA_DIR . '/' . $name . '.json';
}

function read_json_data(string $name, array $fallback = []): array
{
    $path = data_path($name);
    if (!is_file($path)) {
        return $fallback;
    }

    $json = file_get_contents($path);
    $data = json_decode($json, true);
    return is_array($data) ? $data : $fallback;
}

function write_json_data(string $name, array $data): bool
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

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect_to(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function make_id(): string
{
    return bin2hex(random_bytes(8));
}

function save_uploaded_image(string $field): ?string
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

function default_team_data(): array
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

function load_team_data(): array
{
    $data = read_json_data('team', []);
    if (!$data) {
        $data = default_team_data();
        write_json_data('team', $data);
    }

    return $data;
}
