<?php
require_once __DIR__ . '/config.php';

function db(?string $database = DB_NAME): PDO
{
    static $connections = [];

    $key = $database ?? '__server__';
    if (isset($connections[$key])) {
        return $connections[$key];
    }

    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';charset=' . DB_CHARSET;
    if ($database !== null) {
        $dsn .= ';dbname=' . $database;
    }

    return $connections[$key] = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
}

function db_exec(string $sql, array $params = []): PDOStatement
{
    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}

function db_fetch_all(string $sql, array $params = []): array
{
    return db_exec($sql, $params)->fetchAll();
}

function db_fetch_one(string $sql, array $params = []): ?array
{
    $row = db_exec($sql, $params)->fetch();
    return $row === false ? null : $row;
}

function db_column(string $sql, array $params = []): mixed
{
    $value = db_exec($sql, $params)->fetchColumn();
    return $value === false ? null : $value;
}
