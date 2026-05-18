<?php
$hostName = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
$isLocal = $hostName === '' || strpos($hostName, 'localhost') !== false || strpos($hostName, '127.0.0.1') !== false;

define('DB_HOST', $isLocal ? '127.0.0.1' : 'sql108.infinityfree.com');
define('DB_PORT', $isLocal ? 3307 : 3306);
define('DB_NAME', $isLocal ? 'sciencebus' : 'if0_40777874_sciencebus');
define('DB_USER', $isLocal ? 'root' : 'if0_40777874');
define('DB_PASS', $isLocal ? '' : 'fxuqs0L1RUCZXO');
define('DB_CHARSET', 'utf8mb4');
