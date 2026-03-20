<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Core\Controller;
use App\Domain\Billing\DTOs\CheckoutRequest;
use App\Domain\Billing\Services\CheckoutService;

final class BillingController extends Controller
{
    public function createCheckout(): never
    {
        $request = CheckoutRequest::fromArray($this->requestInput());
        $service = new CheckoutService();
        $result = $service->create($request);

        if (!$result->success || $result->session === null) {
            $this->json([
                'ok' => false,
                'error' => $result->error ?? 'Unable to create checkout session.',
                'provider' => $service->providerName(),
            ], 422);
        }

        $this->json([
            'ok' => true,
            'provider' => $service->providerName(),
            'session' => $result->session->toArray(),
        ], 201);
    }

    public function currentCheckout(): never
    {
        $service = new CheckoutService();
        $sessionId = trim((string) ($_GET['session_id'] ?? ''));
        $session = $sessionId !== '' ? $service->find($sessionId) : $service->latest();

        if ($session === null) {
            $this->json([
                'ok' => false,
                'error' => 'Checkout session not found.',
            ], 404);
        }

        $this->json([
            'ok' => true,
            'provider' => $service->providerName(),
            'session' => $session,
        ]);
    }

    public function config(): never
    {
        $service = new CheckoutService();

        $this->json([
            'ok' => true,
            'enabled' => $service->isAvailable(),
            'provider' => $service->providerName(),
            'mode' => (string) config('app.billing.mode', 'test'),
            'public_key' => (string) config('app.billing.public_key', ''),
            'success_url' => (string) config('app.billing.success_url', ''),
            'cancel_url' => (string) config('app.billing.cancel_url', ''),
            'webhook_path' => '/api/billing/webhook',
        ]);
    }

    private function requestInput(): array
    {
        $contentType = strtolower((string) ($_SERVER['CONTENT_TYPE'] ?? ''));
        if (str_contains($contentType, 'application/json')) {
            $decoded = json_decode((string) file_get_contents('php://input'), true);
            return is_array($decoded) ? $decoded : [];
        }

        return $_POST;
    }
}
