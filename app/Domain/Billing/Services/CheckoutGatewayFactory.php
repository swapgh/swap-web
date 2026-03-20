<?php
declare(strict_types=1);

namespace App\Domain\Billing\Services;

use App\Domain\Billing\Gateways\CheckoutGateway;
use App\Domain\Billing\Gateways\PlaceholderCheckoutGateway;
use App\Domain\Billing\Gateways\StripeCheckoutGateway;

final class CheckoutGatewayFactory
{
    public function make(): CheckoutGateway
    {
        return match ((string) config('app.billing.provider', 'placeholder')) {
            'stripe' => new StripeCheckoutGateway(
                (string) config('app.billing.secret_key', ''),
                (string) config('app.billing.success_url', ''),
                (string) config('app.billing.cancel_url', ''),
            ),
            default => new PlaceholderCheckoutGateway(),
        };
    }
}
