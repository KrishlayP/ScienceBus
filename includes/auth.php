<?php
require_once __DIR__ . '/data.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function default_admin_users(): array
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

function admin_users(): array
{
    $data = read_json_data('users', []);
    if (empty($data['users'])) {
        $data = default_admin_users();
        write_json_data('users', $data);
    }

    return $data;
}

function save_admin_users(array $data): void
{
    write_json_data('users', $data);
}

function current_admin(): ?array
{
    return $_SESSION['admin_user'] ?? null;
}

function is_super_admin(): bool
{
    $user = current_admin();
    return $user && ($user['role'] ?? '') === 'super_admin';
}

function require_admin(): void
{
    if (!current_admin()) {
        redirect_to('login.php');
    }
}

function require_super_admin(): void
{
    require_admin();
    if (!is_super_admin()) {
        http_response_code(403);
        exit('Only super admin can perform this action.');
    }
}

function login_admin(string $email, string $password): bool
{
    $data = admin_users();
    foreach ($data['users'] as $user) {
        if (strtolower($user['email']) === strtolower($email) && password_verify($password, $user['password'])) {
            $_SESSION['admin_user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
            ];
            return true;
        }
    }

    return false;
}
