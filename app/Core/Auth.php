<?php
declare(strict_types=1);

namespace App\Core;

final class Auth
{
    public static function check(): bool
    {
        return Session::get('user') !== null;
    }

    public static function user(): ?array
    {
        $user = Session::get('user');
        return is_array($user) ? $user : null;
    }

    public static function login(array $user): void
    {
        Session::put('user', $user);
    }

    public static function logout(): void
    {
        Session::forget('user');
    }
}
