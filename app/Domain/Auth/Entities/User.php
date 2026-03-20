<?php
declare(strict_types=1);

namespace App\Domain\Auth\Entities;

final class User
{
    public static function placeholder(string $email): array
    {
        return [
            'id' => 'placeholder:' . md5(strtolower($email)),
            'name' => strtok($email, '@') ?: 'swap-user',
            'email' => $email,
            'role' => 'developer',
            'auth_source' => 'placeholder',
        ];
    }
}
