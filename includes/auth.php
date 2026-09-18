<?php
require_once __DIR__ . '/data.php';

const ADMIN_SESSION_TIMEOUT = 1800;

if (session_status() === PHP_SESSION_NONE) {
    if (APP_ENV === 'production') {
        ini_set('session.cookie_httponly', '1');
        ini_set('session.cookie_samesite', 'Lax');
        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
            ini_set('session.cookie_secure', '1');
        }
    }
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
        $role = normalize_admin_role(isset($user['role']) ? $user['role'] : '');
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
                $role,
                date('Y-m-d H:i:s', strtotime(isset($user['created_at']) ? $user['created_at'] : 'now')),
            ]
        );
    }
}

function normalize_admin_role($role)
{
    $role = strtolower(trim((string) $role));
    $role = str_replace(['-', ' '], '_', $role);
    return $role === 'super_admin' ? 'super_admin' : 'admin';
}

function admin_role_label($role)
{
    return ucwords(str_replace('_', ' ', normalize_admin_role($role)));
}

function clear_admin_session()
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }
}

function start_admin_session($user)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    session_regenerate_id(true);

    $_SESSION['admin_user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'role' => normalize_admin_role($user['role']),
    ];
    $_SESSION['admin_last_activity'] = time();
}

function current_admin()
{
    if (!isset($_SESSION['admin_user'])) {
        return null;
    }

    $lastActivity = isset($_SESSION['admin_last_activity']) ? (int) $_SESSION['admin_last_activity'] : 0;
    if ($lastActivity <= 0 || (time() - $lastActivity) > ADMIN_SESSION_TIMEOUT) {
        clear_admin_session();
        return null;
    }

    $_SESSION['admin_last_activity'] = time();
    $_SESSION['admin_user']['role'] = normalize_admin_role(isset($_SESSION['admin_user']['role']) ? $_SESSION['admin_user']['role'] : '');
    return $_SESSION['admin_user'];
}

function is_super_admin()
{
    $user = current_admin();
    return $user && normalize_admin_role(isset($user['role']) ? $user['role'] : '') === 'super_admin';
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
        start_admin_session($user);
        return true;
    }

    return false;
}
