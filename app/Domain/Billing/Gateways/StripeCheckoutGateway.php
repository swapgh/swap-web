<?php
declare(strict_types=1);

namespace App\Domain\Billing\Gateways;

use App\Domain\Billing\DTOs\CheckoutRequest;
use App\Domain\Billing\DTOs\CheckoutSessionData;
use RuntimeException;

final class StripeCheckoutGateway implements CheckoutGateway
{
    public function __construct(
        private readonly string $secretKey = '',
        private readonly string $successUrl = '',
        private readonly string $cancelUrl = '',
        private readonly string $apiBase = 'https://api.stripe.com/v1',
    ) {
    }

    public function providerName(): string
    {
        return 'stripe';
    }

    public function createSession(CheckoutRequest $request): CheckoutSessionData
    {
        if ($this->secretKey === '') {
            throw new RuntimeException('Stripe secret key is not configured.');
        }

        $response = $this->postForm('/checkout/sessions', [
            'mode' => 'payment',
            'success_url' => $this->resolveSuccessUrl(),
            'cancel_url' => $this->resolveCancelUrl(),
            'customer_email' => $request->customerEmail,
            'line_items[0][quantity]' => '1',
            'line_items[0][price_data][currency]' => strtolower($request->currency),
            'line_items[0][price_data][unit_amount]' => (string) $request->amountCents,
            'line_items[0][price_data][product_data][name]' => $request->productKey,
            'metadata[product_key]' => $request->productKey,
        ]);

        $id = (string) ($response['id'] ?? '');
        $checkoutUrl = (string) ($response['url'] ?? '');

        if ($id === '' || $checkoutUrl === '') {
            throw new RuntimeException('Stripe checkout session response is missing required fields.');
        }

        return new CheckoutSessionData(
            $id,
            $this->providerName(),
            $request->productKey,
            $request->currency,
            $request->amountCents,
            $request->customerEmail,
            'pending',
            $checkoutUrl,
            gmdate(DATE_ATOM),
        );
    }

    private function resolveSuccessUrl(): string
    {
        if ($this->successUrl !== '') {
            return $this->successUrl;
        }

        $profileUrl = with_lang(page_url('account'));
        $separator = str_contains($profileUrl, '?') ? '&' : '?';

        return absolute_url($profileUrl . $separator . 'checkout=success');
    }

    private function resolveCancelUrl(): string
    {
        if ($this->cancelUrl !== '') {
            return $this->cancelUrl;
        }

        $profileUrl = with_lang(page_url('account'));
        $separator = str_contains($profileUrl, '?') ? '&' : '?';

        return absolute_url($profileUrl . $separator . 'checkout=cancel');
    }

    private function postForm(string $path, array $params): array
    {
        $url = rtrim($this->apiBase, '/') . $path;
        $body = http_build_query($params);
        $headers = [
            'Authorization: Bearer ' . $this->secretKey,
            'Content-Type: application/x-www-form-urlencoded',
        ];

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_TIMEOUT => 20,
            ]);

            $rawResponse = curl_exec($ch);
            $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            if ($rawResponse === false) {
                throw new RuntimeException('Stripe request failed: ' . $error);
            }

            return $this->decodeResponse((string) $rawResponse, $status);
        }

        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $headers),
                'content' => $body,
                'timeout' => 20,
                'ignore_errors' => true,
            ],
        ]);

        $rawResponse = file_get_contents($url, false, $context);
        $statusLine = $http_response_header[0] ?? 'HTTP/1.1 500';
        preg_match('/\s(\d{3})\s/', $statusLine, $matches);
        $status = isset($matches[1]) ? (int) $matches[1] : 500;

        if ($rawResponse === false) {
            throw new RuntimeException('Stripe request failed.');
        }

        return $this->decodeResponse($rawResponse, $status);
    }

    private function decodeResponse(string $rawResponse, int $status): array
    {
        $decoded = json_decode($rawResponse, true);
        if (!is_array($decoded)) {
            throw new RuntimeException('Stripe returned an invalid JSON response.');
        }

        if ($status < 200 || $status >= 300) {
            $message = (string) ($decoded['error']['message'] ?? 'Stripe request failed.');
            throw new RuntimeException($message);
        }

        return $decoded;
    }
}
