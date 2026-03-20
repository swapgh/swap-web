<?php
declare(strict_types=1);

namespace App\Domain\Billing\DTOs;

final class CheckoutRequest
{
    public function __construct(
        public readonly string $productKey,
        public readonly string $currency,
        public readonly int $amountCents,
        public readonly string $customerEmail,
    ) {
    }

    public static function fromArray(array $input): self
    {
        return new self(
            trim((string) ($input['product_key'] ?? '')),
            strtoupper(trim((string) ($input['currency'] ?? 'EUR'))),
            (int) ($input['amount_cents'] ?? 0),
            strtolower(trim((string) ($input['customer_email'] ?? ''))),
        );
    }
}
