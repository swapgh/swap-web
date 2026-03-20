<?php
declare(strict_types=1);

namespace App\Domain\Billing\DTOs;

final class CheckoutSessionData
{
    public function __construct(
        public readonly string $id,
        public readonly string $provider,
        public readonly string $productKey,
        public readonly string $currency,
        public readonly int $amountCents,
        public readonly string $customerEmail,
        public readonly string $status,
        public readonly string $checkoutUrl,
        public readonly string $createdAt,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'provider' => $this->provider,
            'product_key' => $this->productKey,
            'currency' => $this->currency,
            'amount_cents' => $this->amountCents,
            'customer_email' => $this->customerEmail,
            'status' => $this->status,
            'checkout_url' => $this->checkoutUrl,
            'created_at' => $this->createdAt,
        ];
    }
}
