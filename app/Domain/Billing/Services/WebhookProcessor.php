<?php
declare(strict_types=1);

namespace App\Domain\Billing\Services;

use App\Domain\Billing\DTOs\WebhookEvent;
use App\Domain\Billing\Repositories\BillingRecordRepository;
use App\Domain\Billing\Repositories\WebhookEventRepository;

final class WebhookProcessor
{
    private readonly BillingRecordRepository $records;
    private readonly WebhookEventRepository $events;

    public function __construct(
        ?BillingRecordRepository $records = null,
        ?WebhookEventRepository $events = null,
    ) {
        $this->records = $records ?? BillingRecordRepository::withDefaultConnection();
        $this->events = $events ?? WebhookEventRepository::withDefaultConnection();
    }

    public function process(WebhookEvent $event): ?array
    {
        if ($event->sessionId === '') {
            return null;
        }

        $provider = (string) ($event->payload['provider'] ?? config('app.billing.provider', 'placeholder'));
        $this->events->record($provider, $event->type, $event->sessionId, $event->payload);

        $status = match ($event->type) {
            'checkout.completed', 'payment.succeeded', 'checkout.session.completed', 'payment_intent.succeeded' => 'paid',
            'checkout.expired', 'checkout.session.expired' => 'expired',
            'payment.failed', 'payment_intent.payment_failed' => 'failed',
            default => 'pending',
        };

        return $this->records->updateStatus($event->sessionId, $status, [
            'webhook_type' => $event->type,
            'webhook_received_at' => gmdate(DATE_ATOM),
        ]);
    }
}
