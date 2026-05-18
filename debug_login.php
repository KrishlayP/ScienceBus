<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

header('Content-Type: text/plain');

echo "PHP version: " . PHP_VERSION . "\n";

try {
    require_once __DIR__ . '/includes/auth.php';
    echo "Auth loaded: yes\n";
    echo "DB host: " . DB_HOST . "\n";
    echo "DB name: " . DB_NAME . "\n";

    $user = db_fetch_one(
        'SELECT id, email, password, role FROM admin_users WHERE LOWER(email) = ? LIMIT 1',
        ['superadmin@sciencebus.local']
    );

    if (!$user) {
        echo "User found: no\n";
        exit;
    }

    echo "User found: yes\n";
    echo "Email: " . $user['email'] . "\n";
    echo "Role: " . $user['role'] . "\n";
    echo "Password hash length: " . strlen($user['password']) . "\n";
    echo "Admin@123 verifies: " . (password_verify('Admin@123', trim($user['password'])) ? 'yes' : 'no') . "\n";
} catch (Throwable $error) {
    echo "ERROR: " . $error->getMessage() . "\n";
    echo "FILE: " . $error->getFile() . "\n";
    echo "LINE: " . $error->getLine() . "\n";
}
