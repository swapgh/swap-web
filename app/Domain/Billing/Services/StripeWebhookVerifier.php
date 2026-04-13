<?php
declare(strict_types=1);

namespace App\Domain\Billing\Services;

final class StripeWebhookVerifier
{
    private const DEFAULT_TOLERANCE_SECONDS = 300;

    public function verify(string $payload, string $signatureHeader, string $secret): bool
    {
        if ($payload === '' || $signatureHeader === '' || $secret === '') {
            return false;
        }

        $parts = [];
        foreach (explode(',', $signatureHeader) as $segment) {
            [$key, $value] = array_pad(explode('=', trim($segment), 2), 2, '');
            if ($key !== '' && $value !== '') {
                $parts[$key][] = $value;
            }
        }

        $timestamp = $parts['t'][0] ?? '';
        $signatures = $parts['v1'] ?? [];
        if ($timestamp === '' || $signatures === []) {
            return false;
        }

        $timestampInt = ctype_digit($timestamp) ? (int) $timestamp : 0;
        if ($timestampInt <= 0 || abs(time() - $timestampInt) > self::DEFAULT_TOLERANCE_SECONDS) {
            return false;
        }

        $expected = hash_hmac('sha256', $timestamp . '.' . $payload, $secret);

        foreach ($signatures as $signature) {
            if (hash_equals($expected, $signature)) {
                return true;
            }
        }

        return false;
    }
}
