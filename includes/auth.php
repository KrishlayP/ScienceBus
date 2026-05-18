<?php
require_once __DIR__ . '/data.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function default_admin_users()
{
    return [
        'users' => [
            [
                'id' => make_id(),
                'name' => 'Super Admin',
                'email' => 'superadmin@sciencebus.local',
                'password' => password_hash('Admin@123', PASSWORD_DEFAULT),
                'role' => 'super_admin',
                'created_at' => date('c'),
            ],
            [
                'id' => make_id(),
                'name' => 'Admin',
                'email' => 'admin@sciencebus.local',
                'password' => password_hash('Admin@123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('c'),
            ],
        ],
    ];
}

function admin_users()
{
    return load_admin_users_data();
}

function save_admin_users($data)
{
    foreach (isset($data['users']) ? $data['users'] : [] as $user) {
        db_exec(
            'INSERT INTO admin_users (id, name, email, password, role, created_at)
             VALUES (?, ?, ?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE
                name = VALUES(name),
                password = VALUES(password),
                role = VALUES(role)',
            [
                isset($user['id']) ? $user['id'] : make_id(),
                isset($user['name']) ? $user['name'] : '',
                isset($user['email']) ? $user['email'] : '',
                isset($user['password']) ? $user['password'] : '',
                (isset($user['role']) ? $user['role'] : '') === 'super_admin' ? 'super_admin' : 'admin',
                date('Y-m-d H:i:s', strtotime(isset($user['created_at']) ? $user['created_at'] : 'now')),
            ]
        );
    }
}

function current_admin()
{
    return isset($_SESSION['admin_user']) ? $_SESSION['admin_user'] : null;
}

function is_super_admin()
{
    $user = current_admin();
    return $user && (isset($user['role']) ? $user['role'] : '') === 'super_admin';
}

function require_admin()
{
    if (!current_admin()) {
        redirect_to('login.php');
    }
}

function require_super_admin()
{
    require_admin();
    if (!is_super_admin()) {
        http_response_code(403);
        exit('Only super admin can perform this action.');
    }
}

function login_admin($email, $password)
{
    $email = strtolower(trim($email));
    $password = trim($password);

    $user = db_fetch_one(
        'SELECT id, name, email, password, role FROM admin_users WHERE LOWER(email) = ? LIMIT 1',
        [$email]
    );

    if ($user && password_verify($password, trim(isset($user['password']) ? $user['password'] : ''))) {
        $_SESSION['admin_user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];
        return true;
    }

    return false;
}
