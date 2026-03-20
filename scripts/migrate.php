<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/Support/bootstrap.php';

use App\Infrastructure\Database\Migrator;

try {
    $migrator = Migrator::withDefaultConnection();
    $ran = $migrator->migrate(__DIR__ . '/../database/migrations');
} catch (Throwable $exception) {
    fwrite(STDERR, 'Migration failed: ' . $exception->getMessage() . PHP_EOL);
    exit(1);
}

echo $ran === []
    ? "No migrations executed.\n"
    : "Executed migrations:\n- " . implode("\n- ", $ran) . "\n";
