<?php

declare(strict_types=1);

function getPdo(): ?PDO
{
    static $pdo = null;
    static $attempted = false;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    if ($attempted) {
        return null;
    }

    $attempted = true;
    $config = require __DIR__ . '/config.php';
    $db = $config['db'];
    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=%s',
        $db['host'],
        $db['port'],
        $db['name'],
        $db['charset']
    );

    try {
        $pdo = new PDO($dsn, $db['user'], $db['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (PDOException) {
        return null;
    }

    return $pdo;
}

function fetchRows(string $table, array $fallback): array
{
    $pdo = getPdo();

    if (!$pdo instanceof PDO) {
        return $fallback;
    }

    $allowedTables = ['services', 'tips'];

    if (!in_array($table, $allowedTables, true)) {
        return $fallback;
    }

    try {
        $statement = $pdo->query("SELECT * FROM {$table} ORDER BY sort_order ASC, id ASC");
        $rows = $statement->fetchAll();
    } catch (PDOException) {
        return $fallback;
    }

    return $rows ?: $fallback;
}
