<?php
declare(strict_types=1);

namespace App\Support;

final class RateLimiter
{
    public function tooManyAttempts(string $key, int $maxAttempts, int $decaySeconds): bool
    {
        return count($this->recentAttempts($key, $decaySeconds)) >= $maxAttempts;
    }

    public function hit(string $key, int $decaySeconds): int
    {
        $attempts = $this->recentAttempts($key, $decaySeconds);
        $attempts[] = time();
        $this->write($key, $attempts);

        return count($attempts);
    }

    public function clear(string $key): void
    {
        $path = $this->pathFor($key);
        if (is_file($path)) {
            unlink($path);
        }
    }

    public function availableIn(string $key, int $decaySeconds): int
    {
        $attempts = $this->recentAttempts($key, $decaySeconds);
        if ($attempts === []) {
            return 0;
        }

        $oldest = min($attempts);
        return max(0, ($oldest + $decaySeconds) - time());
    }

    private function recentAttempts(string $key, int $decaySeconds): array
    {
        $stored = $this->read($key);
        $cutoff = time() - $decaySeconds;

        return array_values(array_filter(
            $stored,
            static fn (mixed $timestamp): bool => is_int($timestamp) && $timestamp >= $cutoff
        ));
    }

    private function read(string $key): array
    {
        $path = $this->pathFor($key);
        if (!is_file($path)) {
            return [];
        }

        $decoded = json_decode((string) file_get_contents($path), true);
        return is_array($decoded) ? array_values($decoded) : [];
    }

    private function write(string $key, array $attempts): void
    {
        $directory = $this->storageDirectory();
        if (!is_dir($directory)) {
            mkdir($directory, 0700, true);
        }

        file_put_contents(
            $this->pathFor($key),
            json_encode(array_values($attempts), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            LOCK_EX
        );
    }

    private function pathFor(string $key): string
    {
        return $this->storageDirectory() . '/' . sha1($key) . '.json';
    }

    private function storageDirectory(): string
    {
        return dirname(__DIR__, 2) . '/storage/auth/rate-limits';
    }
}
