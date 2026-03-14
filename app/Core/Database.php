<?php
declare(strict_types=1);

namespace App\Core;

final class Database
{
    public static function config(): array
    {
        return (array) config('database', []);
    }
}
