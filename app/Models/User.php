<?php
declare(strict_types=1);

namespace App\Models;

final class User
{
    public static function fake(string $email): array
    {
        return [
            'name' => strtok($email, '@') ?: 'swap-user',
            'email' => $email,
            'role' => 'developer',
        ];
    }
}

