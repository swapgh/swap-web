<?php
declare(strict_types=1);

namespace App\Domain\Billing\DTOs;

final class CheckoutResult
{
    public function __construct(
        public readonly bool $success,
        public readonly ?CheckoutSessionData $session = null,
        public readonly ?string $error = null,
    ) {
    }

    public static function success(CheckoutSessionData $session): self
    {
        return new self(true, $session, null);
    }

    public static function failure(string $error): self
    {
        return new self(false, null, $error);
    }
}
