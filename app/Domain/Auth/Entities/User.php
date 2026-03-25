<?php
declare(strict_types=1);

namespace App\Domain\Auth\Entities;

final class User
{
    public static function createStored(\App\Domain\Auth\DTOs\RegisterData $data): array
    {
        $now = gmdate('c');

        return [
            'id' => 'user:' . bin2hex(random_bytes(16)),
            'username' => $data->username,
            'name' => $data->username,
            'email' => $data->email,
            'password_hash' => password_hash($data->password, PASSWORD_DEFAULT),
            'role' => 'player',
            'auth_source' => 'local',
            'api_token' => bin2hex(random_bytes(32)),
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }

    public static function sanitize(array $user): array
    {
        unset($user['password_hash']);
        return [
            'id' => (string) ($user['id'] ?? ''),
            'username' => (string) ($user['username'] ?? ''),
            'name' => (string) ($user['name'] ?? ''),
            'email' => (string) ($user['email'] ?? ''),
            'role' => (string) ($user['role'] ?? 'player'),
            'auth_source' => (string) ($user['auth_source'] ?? 'local'),
            'api_token' => (string) ($user['api_token'] ?? ''),
            'created_at' => (string) ($user['created_at'] ?? ''),
            'updated_at' => (string) ($user['updated_at'] ?? ''),
        ];
    }

    public static function placeholder(string $email): array
    {
        return [
            'id' => 'placeholder:' . md5(strtolower($email)),
            'username' => strtok($email, '@') ?: 'swap-user',
            'name' => strtok($email, '@') ?: 'swap-user',
            'email' => $email,
            'role' => 'developer',
            'auth_source' => 'placeholder',
            'api_token' => '',
        ];
    }
}
