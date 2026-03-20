<?php
declare(strict_types=1);

namespace App\Infrastructure\Database;

use PDO;

final class Migrator
{
    public function __construct(
        private readonly PDO $pdo,
    ) {
    }

    public static function withDefaultConnection(): self
    {
        return new self(Connection::get());
    }

    public function migrate(string $migrationsPath): array
    {
        $this->ensureMigrationsTable();

        $applied = $this->appliedMigrations();
        $files = glob(rtrim($migrationsPath, '/') . '/*.sql') ?: [];
        sort($files);

        $ran = [];

        foreach ($files as $file) {
            $name = basename($file);
            if (in_array($name, $applied, true)) {
                continue;
            }

            $sql = trim((string) file_get_contents($file));
            if ($sql === '') {
                continue;
            }

            $this->pdo->beginTransaction();
            $this->pdo->exec($sql);
            $statement = $this->pdo->prepare(
                'INSERT INTO schema_migrations (migration, applied_at) VALUES (:migration, :applied_at)'
            );
            $statement->execute([
                'migration' => $name,
                'applied_at' => gmdate(DATE_ATOM),
            ]);
            $this->pdo->commit();

            $ran[] = $name;
        }

        return $ran;
    }

    private function ensureMigrationsTable(): void
    {
        $this->pdo->exec(
            'CREATE TABLE IF NOT EXISTS schema_migrations (
                migration VARCHAR(255) NOT NULL PRIMARY KEY,
                applied_at VARCHAR(50) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );
    }

    private function appliedMigrations(): array
    {
        $statement = $this->pdo->query('SELECT migration FROM schema_migrations ORDER BY migration ASC');
        $rows = $statement->fetchAll(PDO::FETCH_COLUMN);

        return array_map(static fn(mixed $value): string => (string) $value, $rows);
    }
}
