<?php
declare(strict_types=1);

namespace App\Domain\Billing\Services;

use App\Domain\Billing\DTOs\CheckoutRequest;
use App\Domain\Billing\DTOs\CheckoutResult;
use App\Domain\Billing\Gateways\CheckoutGateway;
use App\Domain\Billing\Repositories\BillingRecordRepository;
use Throwable;

final class CheckoutService
{
    private readonly CheckoutGateway $gateway;
    private readonly BillingRecordRepository $records;

    public function __construct(
        ?CheckoutGateway $gateway = null,
        ?BillingRecordRepository $records = null,
    ) {
        $this->gateway = $gateway ?? (new CheckoutGatewayFactory())->make();
        $this->records = $records ?? BillingRecordRepository::withDefaultConnection();
    }

    public function create(CheckoutRequest $request): CheckoutResult
    {
        if (!$this->isAvailable()) {
            return CheckoutResult::failure('Billing is not enabled.');
        }

        if ($request->productKey === '') {
            return CheckoutResult::failure('Product key is required.');
        }

        if ($request->amountCents <= 0) {
            return CheckoutResult::failure('Amount must be greater than zero.');
        }

        if ($request->customerEmail === '' || !filter_var($request->customerEmail, FILTER_VALIDATE_EMAIL)) {
            return CheckoutResult::failure('A valid customer email is required.');
        }

        try {
            $session = $this->gateway->createSession($request);
            $this->records->save($session);
        } catch (Throwable $exception) {
            return CheckoutResult::failure($exception->getMessage());
        }

        return CheckoutResult::success($session);
    }

    public function find(string $id): ?array
    {
        return $this->records->find($id);
    }

    public function latest(): ?array
    {
        return $this->records->latest();
    }

    public function all(): array
    {
        return $this->records->all();
    }

    public function isAvailable(): bool
    {
        return (bool) config('app.features.billing', false);
    }

    public function providerName(): string
    {
        return $this->gateway->providerName();
    }
}
