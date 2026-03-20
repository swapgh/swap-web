<?php
declare(strict_types=1);

namespace App\Domain\Billing\Repositories;

use App\Domain\Billing\DTOs\CheckoutSessionData;
use App\Infrastructure\Database\Connection;
use PDO;
use Throwable;

final class BillingRecordRepository
{
    public function __construct(
        private readonly ?PDO $pdo,
    ) {
    }

    public static function withDefaultConnection(): self
    {
        try {
            return new self(Connection::get());
        } catch (Throwable) {
            return new self(null);
        }
    }

    public function all(): array
    {
        if (!$this->usesDatabase()) {
            $records = array_values($this->allIndexedFromFile());

            usort($records, static function (array $left, array $right): int {
                $leftDate = strtotime((string) ($left['created_at'] ?? '')) ?: 0;
                $rightDate = strtotime((string) ($right['created_at'] ?? '')) ?: 0;

                return $rightDate <=> $leftDate;
            });

            return $records;
        }

        $statement = $this->pdo->query('SELECT * FROM billing_records ORDER BY created_at DESC');
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map([$this, 'hydrateRecord'], is_array($records) ? $records : []);
    }

    public function save(CheckoutSessionData $session): void
    {
        if (!$this->usesDatabase()) {
            $records = $this->allIndexedFromFile();
            $records[$session->id] = $session->toArray();
            $this->persistToFile($records);
            return;
        }

        $data = $session->toArray();
        $statement = $this->pdo->prepare(
            'INSERT INTO billing_records (
                id, provider, product_key, currency, amount_cents, customer_email,
                status, checkout_url, meta, created_at, updated_at
            ) VALUES (
                :id, :provider, :product_key, :currency, :amount_cents, :customer_email,
                :status, :checkout_url, :meta, :created_at, :updated_at
            )
            ON DUPLICATE KEY UPDATE
                provider = VALUES(provider),
                product_key = VALUES(product_key),
                currency = VALUES(currency),
                amount_cents = VALUES(amount_cents),
                customer_email = VALUES(customer_email),
                status = VALUES(status),
                checkout_url = VALUES(checkout_url),
                meta = VALUES(meta),
                created_at = VALUES(created_at),
                updated_at = VALUES(updated_at)'
        );

        $statement->execute([
            'id' => $data['id'],
            'provider' => $data['provider'],
            'product_key' => $data['product_key'],
            'currency' => $data['currency'],
            'amount_cents' => $data['amount_cents'],
            'customer_email' => $data['customer_email'],
            'status' => $data['status'],
            'checkout_url' => $data['checkout_url'],
            'meta' => isset($data['meta']) ? json_encode($data['meta'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : null,
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'] ?? null,
        ]);
    }

    public function find(string $id): ?array
    {
        if (!$this->usesDatabase()) {
            $records = $this->allIndexedFromFile();
            return isset($records[$id]) && is_array($records[$id]) ? $records[$id] : null;
        }

        $statement = $this->pdo->prepare('SELECT * FROM billing_records WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $record = $statement->fetch(PDO::FETCH_ASSOC);

        return is_array($record) ? $this->hydrateRecord($record) : null;
    }

    public function latest(): ?array
    {
        if (!$this->usesDatabase()) {
            $records = array_values($this->allIndexedFromFile());
            if ($records === []) {
                return null;
            }

            return $records[array_key_last($records)];
        }

        $statement = $this->pdo->query('SELECT * FROM billing_records ORDER BY created_at DESC LIMIT 1');
        $record = $statement->fetch(PDO::FETCH_ASSOC);

        return is_array($record) ? $this->hydrateRecord($record) : null;
    }

    public function updateStatus(string $id, string $status, array $meta = []): ?array
    {
        if (!$this->usesDatabase()) {
            $records = $this->allIndexedFromFile();
            if (!isset($records[$id]) || !is_array($records[$id])) {
                return null;
            }

            $records[$id]['status'] = $status;
            if ($meta !== []) {
                $records[$id]['meta'] = array_merge(
                    is_array($records[$id]['meta'] ?? null) ? $records[$id]['meta'] : [],
                    $meta,
                );
            }

            $records[$id]['updated_at'] = gmdate(DATE_ATOM);
            $this->persistToFile($records);

            return $records[$id];
        }

        $record = $this->find($id);
        if ($record === null) {
            return null;
        }

        $record['status'] = $status;
        if ($meta !== []) {
            $record['meta'] = array_merge(
                is_array($record['meta'] ?? null) ? $record['meta'] : [],
                $meta,
            );
        }

        $record['updated_at'] = gmdate(DATE_ATOM);

        $statement = $this->pdo->prepare(
            'UPDATE billing_records
             SET status = :status, meta = :meta, updated_at = :updated_at
             WHERE id = :id'
        );
        $statement->execute([
            'status' => $record['status'],
            'meta' => json_encode($record['meta'] ?? [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'updated_at' => $record['updated_at'],
            'id' => $id,
        ]);

        return $record;
    }

    private function usesDatabase(): bool
    {
        return $this->pdo instanceof PDO;
    }

    private function allIndexedFromFile(): array
    {
        $path = $this->storagePath();
        if (!is_file($path)) {
            return [];
        }

        $decoded = json_decode((string) file_get_contents($path), true);
        return is_array($decoded) ? $decoded : [];
    }

    private function persistToFile(array $records): void
    {
        $directory = dirname($this->storagePath());
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents(
            $this->storagePath(),
            json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            LOCK_EX
        );
    }

    private function storagePath(): string
    {
        return dirname(__DIR__, 4) . '/storage/billing/checkout-sessions.json';
    }

    private function hydrateRecord(array $record): array
    {
        $meta = $record['meta'] ?? null;
        if (is_string($meta) && $meta !== '') {
            $decoded = json_decode($meta, true);
            $record['meta'] = is_array($decoded) ? $decoded : [];
        } elseif ($meta === null) {
            $record['meta'] = [];
        }

        return $record;
    }
}
