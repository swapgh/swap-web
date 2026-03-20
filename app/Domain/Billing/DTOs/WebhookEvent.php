<?php
declare(strict_types=1);

namespace App\Domain\Billing\DTOs;

final class WebhookEvent
{
    public function __construct(
        public readonly string $type,
        public readonly string $sessionId,
        public readonly array $payload,
    ) {
    }

    public static function fromArray(array $input): self
    {
        return new self(
            trim((string) ($input['type'] ?? '')),
            trim((string) ($input['session_id'] ?? '')),
            $input,
        );
    }

    public static function fromStripePayload(array $input): self
    {
        $object = $input['data']['object'] ?? [];

        return new self(
            trim((string) ($input['type'] ?? '')),
            trim((string) ($object['id'] ?? '')),
            $input,
        );
    }
}
