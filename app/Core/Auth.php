<?php
declare(strict_types=1);

namespace App\Core;
final class Auth
{
    private static ?array $resolvedUser = null;
    public static function check(): bool
    {
        return self::user() !== null;
    }
    public static function user(): ?array
    {
        if (self::$resolvedUser !== null) {
            return self::$resolvedUser;
        }

        $user = Session::get('user');
        return is_array($user) ? $user : null;
    }
    public static function login(array $user): void
    {
        self::$resolvedUser = $user;
        Session::regenerate();
        Session::put('user', $user);
    }

    public static function resolve(array $user): void
    {
        self::$resolvedUser = $user;
    }
    public static function logout(): void
    {
        self::$resolvedUser = null;
        Session::invalidate();
    }
}
