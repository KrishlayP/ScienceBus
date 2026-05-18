<?php
require_once __DIR__ . '/../includes/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function login_e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function login_redirect($path)
{
    header('Location: ' . $path);
    exit;
}

if (isset($_SESSION['admin_user'])) {
    login_redirect('index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim(isset($_POST['email']) ? $_POST['email'] : ''));
    $password = trim(isset($_POST['password']) ? $_POST['password'] : '');

    $user = db_fetch_one(
        'SELECT id, name, email, password, role FROM admin_users WHERE LOWER(email) = ? LIMIT 1',
        [$email]
    );

    if ($user && password_verify($password, trim($user['password']))) {
        $_SESSION['admin_user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        login_redirect('index.php');
    }

    $error = 'Invalid email or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Science Bus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-100 flex items-center justify-center p-4">
    <form method="post" class="w-full max-w-md bg-white rounded-2xl shadow-xl border p-8">
        <h1 class="text-2xl font-bold text-slate-900">Admin Login</h1>
        <p class="text-sm text-slate-500 mt-1">Manage Science Bus dynamic content.</p>

        <?php if ($error): ?>
            <div class="mt-5 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3"><?= login_e($error) ?></div>
        <?php endif; ?>

        <label class="block mt-6 text-sm font-medium">Email</label>
        <input name="email" type="text" inputmode="email" required class="mt-1 w-full rounded-lg border px-4 py-3" placeholder="superadmin@sciencebus.local">

        <label class="block mt-4 text-sm font-medium">Password</label>
        <input name="password" type="password" required class="mt-1 w-full rounded-lg border px-4 py-3" placeholder="Admin@123">

        <button class="mt-6 w-full rounded-lg bg-blue-600 text-white font-semibold py-3 hover:bg-blue-700">Login</button>

        <div class="mt-5 text-xs text-slate-500 leading-5">
            Default super admin: superadmin@sciencebus.local / Admin@123<br>
            Default admin: admin@sciencebus.local / Admin@123
        </div>
    </form>
</body>
</html>
