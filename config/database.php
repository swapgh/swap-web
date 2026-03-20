<?php
declare(strict_types=1);

return [
    'default' => (string) ($_ENV['DB_CONNECTION'] ?? 'mysql'),
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => (string) ($_ENV['DB_HOST'] ?? '127.0.0.1'),
            'port' => (int) ($_ENV['DB_PORT'] ?? 3306),
            'database' => (string) ($_ENV['DB_DATABASE'] ?? 'swap_web'),
            'username' => (string) ($_ENV['DB_USERNAME'] ?? 'root'),
            'password' => (string) ($_ENV['DB_PASSWORD'] ?? ''),
            'charset' => (string) ($_ENV['DB_CHARSET'] ?? 'utf8mb4'),
        ],
    ],
];
