<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    require_once __DIR__ . '/../includes/auth.php';
} catch (Throwable $error) {
    header('Content-Type: text/plain; charset=utf-8');
    http_response_code(500);
    echo "Login bootstrap error\n";
    echo "Message: " . $error->getMessage() . "\n";
    echo "File: " . $error->getFile() . "\n";
    echo "Line: " . $error->getLine() . "\n";
    exit;
}

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

if (current_admin()) {
    login_redirect('index.php');
}

$error = '';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = strtolower(trim(isset($_POST['email']) ? $_POST['email'] : ''));
        $password = trim(isset($_POST['password']) ? $_POST['password'] : '');

        $user = db_fetch_one(
            'SELECT id, name, email, password, role FROM admin_users WHERE LOWER(email) = ? LIMIT 1',
            [$email]
        );

        if ($user && password_verify($password, trim($user['password']))) {
            start_admin_session($user);
            login_redirect('index.php');
        }

        $error = 'Invalid email or password.';
    }
} catch (Throwable $error) {
    $error = 'Server error: ' . $error->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Science Bus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            min-height: 100%;
        }

        body {
            min-height: 100%;
            background: #071326;
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
        }

        body::before {
            background-image: url('../assets/image/header/login-bus.jpg');
            background-position: center;
            background-size: cover;
            filter: blur(4px);
            transform: scale(1.04);
            z-index: -2;
        }

        body::after {
            background:
                linear-gradient(135deg, rgba(220, 111, 128, .42), rgba(17, 80, 151, .52)),
                radial-gradient(circle at 50% 42%, rgba(255, 255, 255, .20), transparent 32%),
                rgba(3, 10, 26, .20);
            z-index: -1;
        }

        .login-card {
            background: rgba(240, 246, 255, .42);
            border: 1px solid rgba(255, 255, 255, .46);
            box-shadow: 0 28px 70px rgba(4, 13, 31, .30);
            backdrop-filter: blur(24px) saturate(1.18);
        }

        .login-avatar {
            background: #07244d;
            box-shadow: 0 16px 34px rgba(5, 21, 50, .28);
        }

        .login-input {
            background: rgba(45, 77, 112, .96);
            border: 1px solid rgba(210, 225, 244, .18);
            color: #fff;
            transition: border-color .18s ease, box-shadow .18s ease, background-color .18s ease;
        }

        .login-input::placeholder {
            color: rgba(232, 240, 252, .72);
        }

        .login-input:focus {
            background: rgba(38, 69, 103, .98);
            border-color: rgba(255, 255, 255, .56);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, .14);
            outline: none;
        }

        .input-icon {
            background: #062657;
            color: #fff;
        }

        .login-button {
            background: rgba(238, 244, 255, .78);
            border: 1px solid rgba(255, 255, 255, .62);
            box-shadow: 0 18px 34px rgba(4, 13, 31, .22);
            color: #0b2a55;
            transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
        }

        .login-button:hover {
            filter: brightness(1.05);
            box-shadow: 0 22px 42px rgba(4, 13, 31, .28);
            transform: translateY(-1px);
        }

        .login-button:active {
            transform: translateY(0);
        }
    </style>
</head>
<body class="min-h-screen text-slate-950">
    <main class="grid min-h-screen w-full place-items-center px-5 py-10">
        <form method="post" class="login-card relative w-full max-w-[430px] rounded-[30px] px-7 pb-8 pt-20 md:px-9">
            <div class="login-avatar absolute left-1/2 top-0 grid h-28 w-28 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full text-white ring-4 ring-white/45">
                <svg aria-hidden="true" width="62" height="62" viewBox="0 0 64 64" fill="none">
                    <circle cx="32" cy="21" r="11" stroke="currentColor" stroke-width="4"/>
                    <path d="M13 54c2.7-12.3 9.5-19 19-19s16.3 6.7 19 19H13Z" stroke="currentColor" stroke-width="4" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="mb-7 text-center">
                <h1 class="text-2xl font-black tracking-wide text-[#082453]">Admin Login</h1>
                <p class="mt-1 text-sm font-medium text-[#31547d]">Science Bus</p>
            </div>

            <?php if ($error): ?>
                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50/90 px-4 py-3 text-sm font-medium text-red-700"><?= login_e($error) ?></div>
            <?php endif; ?>

            <label class="sr-only" for="email">Email</label>
            <div class="flex overflow-hidden rounded-none shadow-sm">
                <span class="input-icon grid w-14 shrink-0 place-items-center">
                    <svg aria-hidden="true" width="19" height="19" viewBox="0 0 24 24" fill="none">
                        <path d="M4 20v-1.5C4 15.5 7.6 14 12 14s8 1.5 8 4.5V20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </span>
                <input id="email" name="email" type="text" inputmode="email" required class="login-input h-14 min-w-0 flex-1 px-4 text-base" placeholder="Email ID">
            </div>

            <label class="sr-only" for="password">Password</label>
            <div class="mt-4 flex overflow-hidden rounded-none shadow-sm">
                <span class="input-icon grid w-14 shrink-0 place-items-center">
                    <svg aria-hidden="true" width="19" height="19" viewBox="0 0 24 24" fill="none">
                        <rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor" stroke-width="2"/>
                        <path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>
                <input id="password" name="password" type="password" required class="login-input h-14 min-w-0 flex-1 px-4 text-base" placeholder="Password">
            </div>

            <div class="mt-5 text-center text-xs font-semibold text-[#31547d]">
                Science Bus Admin
            </div>

            <div class="px-8">
                <button class="login-button mt-8 w-full rounded-b-[22px] rounded-t-none px-5 py-4 text-sm font-black uppercase tracking-[.18em]">Login</button>
            </div>
        </form>
    </main>
</body>
</html>
