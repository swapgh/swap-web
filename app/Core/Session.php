<?php
declare(strict_types=1);

namespace App\Core;

final class Session
{
    public static function start(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            $storagePath = dirname(__DIR__, 2) . '/storage/cache/sessions';
            if (!is_dir($storagePath)) {
                mkdir($storagePath, 0777, true);
            }
            session_save_path($storagePath);
            session_set_cookie_params([
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            session_start();
        }
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function put(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function flash(string $key, mixed $value): void
    {
        self::start();

        if (!isset($_SESSION['_flash']) || !is_array($_SESSION['_flash'])) {
            $_SESSION['_flash'] = [];
        }

        $_SESSION['_flash'][$key] = $value;
    }

    public static function pull(string $key, mixed $default = null): mixed
    {
        self::start();

        if (str_starts_with($key, '_flash.')) {
            $flashKey = substr($key, 7);
            if (!isset($_SESSION['_flash']) || !array_key_exists($flashKey, $_SESSION['_flash'])) {
                return $default;
            }

            $value = $_SESSION['_flash'][$flashKey];
            unset($_SESSION['_flash'][$flashKey]);

            if ($_SESSION['_flash'] === []) {
                unset($_SESSION['_flash']);
            }

            return $value;
        }

        if (!array_key_exists($key, $_SESSION)) {
            return $default;
        }

        $value = $_SESSION[$key];
        unset($_SESSION[$key]);

        return $value;
    }

    public static function regenerate(): void
    {
        self::start();
        session_regenerate_id(true);
    }

    public static function forget(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function invalidate(): void
    {
        self::start();
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
    }
}
