<?php
declare(strict_types=1);

namespace App\Domain\Billing\Gateways;

use App\Domain\Billing\DTOs\CheckoutRequest;
use App\Domain\Billing\DTOs\CheckoutSessionData;

final class PlaceholderCheckoutGateway implements CheckoutGateway
{
    public function providerName(): string
    {
        return 'placeholder';
    }

    public function createSession(CheckoutRequest $request): CheckoutSessionData
    {
        $id = 'chk_' . bin2hex(random_bytes(8));
        $profileUrl = with_lang(page_url('account'));
        $separator = str_contains($profileUrl, '?') ? '&' : '?';

        return new CheckoutSessionData(
            $id,
            $this->providerName(),
            $request->productKey,
            $request->currency,
            $request->amountCents,
            $request->customerEmail,
            'pending',
            $profileUrl . $separator . 'checkout=success&session_id=' . rawurlencode($id),
            gmdate(DATE_ATOM),
        );
    }
}
