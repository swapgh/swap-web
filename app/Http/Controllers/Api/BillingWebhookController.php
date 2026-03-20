<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Core\Controller;
use App\Domain\Billing\DTOs\WebhookEvent;
use App\Domain\Billing\Services\StripeWebhookVerifier;
use App\Domain\Billing\Services\WebhookProcessor;

final class BillingWebhookController extends Controller
{
    public function handle(): never
    {
        $provider = (string) config('app.billing.provider', 'placeholder');
        $rawPayload = $this->rawRequestBody();
        $payload = $this->requestInput($rawPayload);
        $event = $provider === 'stripe'
            ? $this->stripeEvent($rawPayload, $payload)
            : WebhookEvent::fromArray($payload);

        if ($event->type === '' || $event->sessionId === '') {
            $this->json([
                'ok' => false,
                'error' => 'Invalid webhook payload.',
            ], 422);
        }

        $record = (new WebhookProcessor())->process($event);
        if ($record === null) {
            $this->json([
                'ok' => false,
                'error' => 'Billing record not found.',
            ], 404);
        }

        $this->json([
            'ok' => true,
            'record' => $record,
        ]);
    }

    private function requestInput(string $rawPayload): array
    {
        $contentType = strtolower((string) ($_SERVER['CONTENT_TYPE'] ?? ''));
        if (str_contains($contentType, 'application/json')) {
            $decoded = json_decode($rawPayload, true);
            return is_array($decoded) ? $decoded : [];
        }

        return $_POST;
    }

    private function rawRequestBody(): string
    {
        $raw = file_get_contents('php://input');
        return is_string($raw) ? $raw : '';
    }

    private function stripeEvent(string $rawPayload, array $payload): WebhookEvent
    {
        $secret = (string) config('app.billing.webhook_secret', '');
        $signature = (string) ($_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '');

        if (!(new StripeWebhookVerifier())->verify($rawPayload, $signature, $secret)) {
            $this->json([
                'ok' => false,
                'error' => 'Invalid Stripe webhook signature.',
            ], 400);
        }

        return WebhookEvent::fromStripePayload($payload);
    }
}
