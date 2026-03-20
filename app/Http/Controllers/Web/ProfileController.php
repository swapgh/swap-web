<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Core\Controller;
use App\Domain\Account\Services\ProfileReader;
use App\Domain\Billing\Services\CheckoutService;
use App\Core\Session;

final class ProfileController extends Controller
{
    public function index(): void
    {
        $this->protectSensitivePage();

        $checkoutService = new CheckoutService();
        $sessionId = trim((string) ($_GET['session_id'] ?? ''));
        $checkoutReturn = trim((string) ($_GET['checkout'] ?? ''));
        $billingSession = $sessionId !== '' ? $checkoutService->find($sessionId) : $checkoutService->latest();

        $this->render('web.pages.profile', [
            'user' => (new ProfileReader())->current(),
            'billingSession' => $billingSession,
            'billingAvailable' => $checkoutService->isAvailable(),
            'billingProvider' => $checkoutService->providerName(),
            'billingError' => Session::pull('_flash.billing_error'),
            'billingSuccess' => Session::pull('_flash.billing_success'),
            'checkoutReturn' => $checkoutReturn,
            'robotsContent' => 'noindex,nofollow,noarchive',
        ]);
    }
}
