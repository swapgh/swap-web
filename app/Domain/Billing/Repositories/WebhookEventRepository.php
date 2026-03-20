<?php
declare(strict_types=1);

namespace App\Domain\Billing\Repositories;

use App\Infrastructure\Database\Connection;
use PDO;
use Throwable;

final class WebhookEventRepository
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

    public function record(string $provider, string $eventType, string $sessionId, array $payload): void
    {
        if (!$this->pdo instanceof PDO) {
            return;
        }

        $statement = $this->pdo->prepare(
            'INSERT INTO webhook_events (provider, event_type, session_id, payload, recorded_at)
             VALUES (:provider, :event_type, :session_id, :payload, :recorded_at)'
        );

        $statement->execute([
            'provider' => $provider,
            'event_type' => $eventType,
            'session_id' => $sessionId,
            'payload' => json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'recorded_at' => gmdate(DATE_ATOM),
        ]);
    }
}
