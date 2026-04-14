<?php
declare(strict_types=1);

namespace App\Domain\Auth\Repositories;

use App\Domain\Auth\DTOs\RegisterData;
use App\Domain\Auth\Entities\User;

final class UserRepository
{
    public function findByEmail(string $email): ?array
    {
        $stored = $this->findStoredByEmail($email);
        return $stored === null ? null : User::sanitize($stored);
    }

    public function findStoredByEmail(string $email): ?array
    {
        $needle = strtolower(trim($email));
        if ($needle === '') {
            return null;
        }

        foreach ($this->all() as $user) {
            if (strtolower((string) ($user['email'] ?? '')) === $needle) {
                return $user;
            }
        }

        return null;
    }

    public function findByUsername(string $username): ?array
    {
        $stored = $this->findStoredByUsername($username);
        return $stored === null ? null : User::sanitize($stored);
    }

    public function findStoredByUsername(string $username): ?array
    {
        $needle = trim($username);
        if ($needle === '') {
            return null;
        }

        foreach ($this->all() as $user) {
            if ((string) ($user['username'] ?? '') === $needle) {
                return $user;
            }
        }

        return null;
    }

    public function findByIdentifier(string $identifier): ?array
    {
        $stored = $this->findStoredByIdentifier($identifier);
        return $stored === null ? null : User::sanitize($stored);
    }

    public function findStoredByIdentifier(string $identifier): ?array
    {
        $needle = trim($identifier);
        if ($needle === '') {
            return null;
        }

        if (str_contains($needle, '@')) {
            return $this->findStoredByEmail($needle);
        }

        foreach ($this->all() as $user) {
            if ((string) ($user['username'] ?? '') === $needle) {
                return $user;
            }
        }

        return null;
    }

    public function findByApiToken(string $token): ?array
    {
        $needle = trim($token);
        if ($needle === '') {
            return null;
        }

        $needleHash = hash('sha256', $needle);

        foreach ($this->all() as $user) {
            $storedHash = (string) ($user['api_token_hash'] ?? '');
            if ($storedHash !== '' && hash_equals($storedHash, $needleHash) && !$this->isTokenExpired($user)) {
                return User::sanitize($user);
            }
        }

        return null;
    }

    public function create(RegisterData $data): array
    {
        $users = $this->all();
        $stored = User::createStored($data);
        $users[] = $this->forStorage($stored);
        $this->writeAll($users);

        return [
            'user' => User::sanitize($stored),
            'api_token' => (string) ($stored['api_token'] ?? ''),
            'api_token_expires_at' => (string) ($stored['api_token_expires_at'] ?? ''),
        ];
    }

    public function verifyCredentials(string $email, string $password): ?array
    {
        $user = $this->findStoredByIdentifier($email);
        if ($user === null) {
            return null;
        }

        $hash = (string) ($user['password_hash'] ?? '');
        if ($hash === '' || !password_verify($password, $hash)) {
            return null;
        }

        return User::sanitize($user);
    }

    public function rotateApiToken(string $email): ?array
    {
        return $this->rotateApiTokenByIdentifier($email);
    }

    public function rotateApiTokenByIdentifier(string $identifier): ?array
    {
        $needle = trim($identifier);
        if ($needle === '') {
            return null;
        }

        $useEmail = str_contains($needle, '@');
        $users = $this->all();
        foreach ($users as $index => $user) {
            $email = (string) ($user['email'] ?? '');
            $username = (string) ($user['username'] ?? '');
            if ($useEmail ? strtolower($email) !== strtolower($needle) : $username !== $needle) {
                continue;
            }

            $token = bin2hex(random_bytes(32));
            $user['api_token_hash'] = hash('sha256', $token);
            $user['api_token_expires_at'] = gmdate('c', time() + max(60, (int) config('app.auth.api_token_ttl', 2592000)));
            unset($user['api_token']);
            $user['updated_at'] = gmdate('c');
            $users[$index] = $user;
            $this->writeAll($users);

            return [
                'token' => $token,
                'expires_at' => (string) $user['api_token_expires_at'],
            ];
        }

        return null;
    }

    public function revokeApiToken(string $email): void
    {
        $this->revokeApiTokenByIdentifier($email);
    }

    public function revokeApiTokenByIdentifier(string $identifier): void
    {
        $needle = trim($identifier);
        if ($needle === '') {
            return;
        }

        $useEmail = str_contains($needle, '@');
        $users = $this->all();
        $changed = false;

        foreach ($users as $index => $user) {
            $email = (string) ($user['email'] ?? '');
            $username = (string) ($user['username'] ?? '');
            if ($useEmail ? strtolower($email) !== strtolower($needle) : $username !== $needle) {
                continue;
            }

            unset($user['api_token'], $user['api_token_hash'], $user['api_token_expires_at']);
            $user['updated_at'] = gmdate('c');
            $users[$index] = $user;
            $changed = true;
            break;
        }

        if ($changed) {
            $this->writeAll($users);
        }
    }

    public function all(): array
    {
        $path = $this->storagePath();
        if (!is_file($path)) {
            return [];
        }

        $decoded = json_decode((string) file_get_contents($path), true);
        return is_array($decoded) ? array_values(array_filter($decoded, 'is_array')) : [];
    }

    private function writeAll(array $users): void
    {
        $path = $this->storagePath();
        $directory = dirname($path);
        if (!is_dir($directory)) {
            mkdir($directory, 0700, true);
        }

        file_put_contents(
            $path,
            json_encode(array_values($users), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        );
    }

    private function storagePath(): string
    {
        return dirname(__DIR__, 4) . '/storage/auth/users.json';
    }

    private function forStorage(array $user): array
    {
        if (($user['api_token_hash'] ?? '') !== '') {
            unset($user['api_token']);
        }

        return $user;
    }

    private function isTokenExpired(array $user): bool
    {
        $expiresAt = trim((string) ($user['api_token_expires_at'] ?? ''));
        if ($expiresAt === '') {
            return true;
        }

        $timestamp = strtotime($expiresAt);
        if ($timestamp === false) {
            return true;
        }

        return $timestamp < time();
    }
}
