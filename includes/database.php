<?php
require_once __DIR__ . '/config.php';

function db()
{
    static $connection = null;

    if ($connection instanceof mysqli) {
        return $connection;
    }

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    $connection->set_charset(DB_CHARSET);

    return $connection;
}

function db_exec($sql, $params = [])
{
    $connection = db();

    if (!$params) {
        return $connection->query($sql);
    }

    $stmt = $connection->prepare($sql);
    $types = '';
    $values = [];

    foreach ($params as $param) {
        if (is_int($param)) {
            $types .= 'i';
        } elseif (is_float($param)) {
            $types .= 'd';
        } else {
            $types .= 's';
        }
        $values[] = $param;
    }

    $stmt->bind_param($types, ...$values);
    $stmt->execute();

    return $stmt;
}

function db_fetch_all($sql, $params = [])
{
    $result = db_exec($sql, $params);
    if ($result instanceof mysqli_stmt) {
        $result = $result->get_result();
    }

    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function db_fetch_one($sql, $params = [])
{
    $rows = db_fetch_all($sql, $params);
    return $rows ? $rows[0] : null;
}

function db_column($sql, $params = [])
{
    $row = db_fetch_one($sql, $params);
    if (!$row) {
        return null;
    }

    return reset($row);
}

function db_begin()
{
    db()->begin_transaction();
}

function db_commit()
{
    db()->commit();
}

function db_last_insert_id()
{
    return db()->insert_id;
}
