<?php
declare(strict_types=1);

namespace App\Services;

final class AnalyticsService
{
    public function trackPageView(string $path, string $method, string $lang): void
    {
        if (!$this->isEnabled() || strtoupper($method) !== 'GET') {
            return;
        }

        $this->appendRecord('pageviews.log', [
            'path' => $path,
            'lang' => $lang,
            'method' => strtoupper($method),
            'referrer' => (string) ($_SERVER['HTTP_REFERER'] ?? ''),
            'user_agent' => (string) ($_SERVER['HTTP_USER_AGENT'] ?? ''),
            'ip' => (string) ($_SERVER['REMOTE_ADDR'] ?? ''),
            'recorded_at' => gmdate(DATE_ATOM),
        ]);
    }

    public function trackEvent(string $name, array $payload = []): void
    {
        if (!$this->isEnabled()) {
            return;
        }

        $this->appendRecord('events.log', [
            'name' => $name,
            'payload' => $payload,
            'recorded_at' => gmdate(DATE_ATOM),
        ]);
    }

    private function isEnabled(): bool
    {
        return (bool) config('app.features.analytics', false);
    }

    private function appendRecord(string $filename, array $record): void
    {
        $directory = __DIR__ . '/../../storage/analytics';
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents(
            $directory . '/' . $filename,
            json_encode($record, JSON_UNESCAPED_SLASHES) . PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }
}
