<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

header('Content-Type: text/plain; charset=utf-8');

echo "ScienceBus Debug\n";
echo "================\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n";
echo "PHP version: " . PHP_VERSION . "\n";
echo "Current file: " . __FILE__ . "\n\n";

try {
    echo "[1] Loading database config...\n";
    require_once __DIR__ . '/includes/database.php';
    echo "OK\n";
    echo "DB_HOST: " . DB_HOST . "\n";
    echo "DB_PORT: " . DB_PORT . "\n";
    echo "DB_NAME: " . DB_NAME . "\n";
    echo "DB_USER: " . DB_USER . "\n\n";

    echo "[2] Checking PDO extension...\n";
    echo extension_loaded('pdo') ? "PDO loaded: yes\n" : "PDO loaded: no\n";
    echo extension_loaded('pdo_mysql') ? "pdo_mysql loaded: yes\n\n" : "pdo_mysql loaded: no\n\n";

    echo "[3] Connecting to database...\n";
    $pdo = db();
    echo "Connected: yes\n\n";

    echo "[4] Checking admin_users table...\n";
    $count = db_column('SELECT COUNT(*) FROM admin_users');
    echo "admin_users count: " . $count . "\n\n";

    echo "[5] Checking super admin row...\n";
    $email = isset($_GET['email']) ? strtolower(trim($_GET['email'])) : 'superadmin@sciencebus.local';
    $user = db_fetch_one(
        'SELECT id, name, email, password, role FROM admin_users WHERE LOWER(email) = ? LIMIT 1',
        [$email]
    );

    if (!$user) {
        echo "User found: no\n";
        echo "Checked email: " . $email . "\n";
        exit;
    }

    echo "User found: yes\n";
    echo "ID: " . $user['id'] . "\n";
    echo "Name: " . $user['name'] . "\n";
    echo "Email: " . $user['email'] . "\n";
    echo "Role: " . $user['role'] . "\n";
    echo "Password hash length: " . strlen($user['password']) . "\n";
    echo "Admin@123 verifies: " . (password_verify('Admin@123', trim($user['password'])) ? 'yes' : 'no') . "\n\n";

    echo "[6] Checking session...\n";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    echo "Session status: " . session_status() . "\n";
    echo "Session ID length: " . strlen(session_id()) . "\n\n";

    echo "RESULT: Debug completed.\n";
} catch (Throwable $error) {
    echo "\nERROR\n";
    echo "Message: " . $error->getMessage() . "\n";
    echo "File: " . $error->getFile() . "\n";
    echo "Line: " . $error->getLine() . "\n";
}
