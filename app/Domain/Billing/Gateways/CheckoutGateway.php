<?php
declare(strict_types=1);

namespace App\Domain\Billing\Gateways;

use App\Domain\Billing\DTOs\CheckoutRequest;
use App\Domain\Billing\DTOs\CheckoutSessionData;

interface CheckoutGateway
{
    public function providerName(): string;

    public function createSession(CheckoutRequest $request): CheckoutSessionData;
}
