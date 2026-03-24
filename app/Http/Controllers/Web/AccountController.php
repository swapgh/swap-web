<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Core\Controller;
use App\Core\Session;
use App\Domain\Account\Services\CharacterCatalog;
use App\Domain\Account\Services\ProfileReader;
use App\Domain\Billing\DTOs\CheckoutRequest;
use App\Domain\Billing\Services\CheckoutService;

final class AccountController extends Controller
{
    public function dashboard(): void
    {
        $this->protectSensitivePage();

        $checkoutService = new CheckoutService();
        $sessionId = trim((string) ($_GET['session_id'] ?? ''));
        $checkoutReturn = trim((string) ($_GET['checkout'] ?? ''));
        $billingSession = $sessionId !== '' ? $checkoutService->find($sessionId) : $checkoutService->latest();

        $this->renderPage('web.pages.account.dashboard', [
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

    public function characters(): void
    {
        $this->protectSensitivePage();

        $this->renderPage('web.pages.account.characters', [
            'characters' => (new CharacterCatalog())->allForCurrentUser(),
            'robotsContent' => 'noindex,nofollow,noarchive',
        ]);
    }

    public function supportHistory(): void
    {
        $this->protectSensitivePage();

        $service = new CheckoutService();

        $this->renderPage('web.pages.account.support-history', [
            'user' => (new ProfileReader())->current(),
            'billingSessions' => $service->all(),
            'billingAvailable' => $service->isAvailable(),
            'billingProvider' => $service->providerName(),
            'robotsContent' => 'noindex,nofollow,noarchive',
        ]);
    }

    public function checkout(): void
    {
        if (!verify_csrf_token($_POST['_token'] ?? null)) {
            Session::flash('billing_error', 'Your session expired. Please try again.');
            $this->redirect(with_lang(page_url('account')));
        }

        $user = (new ProfileReader())->current();
        $request = CheckoutRequest::fromArray([
            'product_key' => (string) ($_POST['product_key'] ?? 'supporter_pack'),
            'currency' => (string) ($_POST['currency'] ?? 'EUR'),
            'amount_cents' => (int) ($_POST['amount_cents'] ?? 0),
            'customer_email' => (string) ($user['email'] ?? ''),
        ]);

        $result = (new CheckoutService())->create($request);
        if (!$result->success || $result->session === null) {
            Session::flash('billing_error', $result->error ?? 'Unable to start contribution.');
            $this->redirect(with_lang(page_url('account')));
        }

        Session::flash('billing_success', 'Contribution session created.');
        $this->redirect($result->session->checkoutUrl);
    }
}
