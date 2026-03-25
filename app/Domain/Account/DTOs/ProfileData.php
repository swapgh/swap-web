<?php
declare(strict_types=1);

namespace App\Domain\Account\DTOs;

final class ProfileData
{
    public static function fromUser(array $user): array
    {
        return [
            'id' => (string) ($user['id'] ?? ''),
            'username' => (string) ($user['username'] ?? ''),
            'name' => (string) ($user['name'] ?? ''),
            'email' => (string) ($user['email'] ?? ''),
            'role' => (string) ($user['role'] ?? ''),
            'auth_source' => (string) ($user['auth_source'] ?? ''),
        ];
    }
}
