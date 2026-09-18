<?php
$hostName = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
$isLocal = $hostName === '' || strpos($hostName, 'localhost') !== false || strpos($hostName, '127.0.0.1') !== false;

define('APP_ENV', $isLocal ? 'local' : 'production');

if (!$isLocal) {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(E_ALL);
}

define('DB_HOST', $isLocal ? '127.0.0.1' : 'sql108.infinityfree.com');
define('DB_PORT', $isLocal ? 3306 : 3306);
define('DB_NAME', $isLocal ? 'sciencebus' : 'if0_40777874_sciencebus');
define('DB_USER', $isLocal ? 'root' : 'if0_40777874');
define('DB_PASS', $isLocal ? '' : 'fxuqs0L1RUCZXO');
define('DB_CHARSET', 'utf8mb4');
