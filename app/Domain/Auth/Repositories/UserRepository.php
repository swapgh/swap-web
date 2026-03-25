<?php
declare(strict_types=1);

namespace App\Domain\Auth\Repositories;

use App\Domain\Auth\DTOs\RegisterData;
use App\Domain\Auth\Entities\User;

final class UserRepository
{
    public function findByEmail(string $email): ?array
    {
        $needle = strtolower(trim($email));
        if ($needle === '') {
            return null;
        }

        foreach ($this->all() as $user) {
            if (strtolower((string) ($user['email'] ?? '')) === $needle) {
                return User::sanitize($user);
            }
        }

        return null;
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
        $needle = strtolower(trim($username));
        if ($needle === '') {
            return null;
        }

        foreach ($this->all() as $user) {
            if (strtolower((string) ($user['username'] ?? '')) === $needle) {
                return User::sanitize($user);
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

        foreach ($this->all() as $user) {
            if ((string) ($user['api_token'] ?? '') === $needle) {
                return User::sanitize($user);
            }
        }

        return null;
    }

    public function create(RegisterData $data): array
    {
        $users = $this->all();
        $stored = User::createStored($data);
        $users[] = $stored;
        $this->writeAll($users);

        return User::sanitize($stored);
    }

    public function verifyCredentials(string $email, string $password): ?array
    {
        $user = $this->findStoredByEmail($email);
        if ($user === null) {
            return null;
        }

        $hash = (string) ($user['password_hash'] ?? '');
        if ($hash === '' || !password_verify($password, $hash)) {
            return null;
        }

        return User::sanitize($user);
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
            mkdir($directory, 0777, true);
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
}
