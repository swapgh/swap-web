<?php
declare(strict_types=1);

namespace App\Infrastructure\Database;

use PDO;
use RuntimeException;

final class Connection
{
    private static ?PDO $pdo = null;

    public static function get(): PDO
    {
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        $default = (string) config('database.default', 'mysql');
        $connection = config('database.connections.' . $default);
        if (!is_array($connection)) {
            throw new RuntimeException('Database connection configuration not found: ' . $default);
        }

        $driver = (string) ($connection['driver'] ?? 'mysql');
        if ($driver !== 'mysql') {
            throw new RuntimeException('Unsupported database driver: ' . $driver);
        }

        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            (string) ($connection['host'] ?? '127.0.0.1'),
            (int) ($connection['port'] ?? 3306),
            (string) ($connection['database'] ?? ''),
            (string) ($connection['charset'] ?? 'utf8mb4'),
        );

        self::$pdo = new PDO(
            $dsn,
            (string) ($connection['username'] ?? ''),
            (string) ($connection['password'] ?? ''),
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );

        return self::$pdo;
    }
}
