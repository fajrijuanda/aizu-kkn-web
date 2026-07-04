<?php

header('Content-Type: application/json');

$databaseUrl = getenv('DATABASE_URL') ?: '';
$status = [
    'php' => PHP_VERSION,
    'pdo_pgsql' => extension_loaded('pdo_pgsql'),
    'env' => [
        'app_env' => getenv('APP_ENV') ?: null,
        'app_debug_length' => strlen((string) getenv('APP_DEBUG')),
        'app_config_cache_length' => strlen((string) getenv('APP_CONFIG_CACHE')),
        'view_compiled_path_length' => strlen((string) getenv('VIEW_COMPILED_PATH')),
        'db_connection' => getenv('DB_CONNECTION') ?: null,
        'database_url_present' => $databaseUrl !== '',
    ],
    'database' => [
        'connected' => false,
        'users_table' => false,
        'error' => null,
    ],
];

if ($databaseUrl !== '' && extension_loaded('pdo_pgsql')) {
    $parts = parse_url($databaseUrl);

    try {
        $dsn = sprintf(
            'pgsql:host=%s;port=%s;dbname=%s;sslmode=require',
            $parts['host'] ?? '',
            $parts['port'] ?? 5432,
            isset($parts['path']) ? ltrim($parts['path'], '/') : ''
        );
        $pdo = new PDO($dsn, urldecode($parts['user'] ?? ''), urldecode($parts['pass'] ?? ''), [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $status['database']['connected'] = true;
        $status['database']['users_table'] = (bool) $pdo
            ->query("select exists (select 1 from information_schema.tables where table_name = 'users')")
            ->fetchColumn();
    } catch (Throwable $exception) {
        $status['database']['error'] = $exception->getMessage();
    }
}

echo json_encode($status, JSON_PRETTY_PRINT);
