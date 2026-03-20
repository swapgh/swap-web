<?php
declare(strict_types=1);

namespace App\Domain\Auth\Repositories;

use App\Domain\Auth\Entities\User;

final class PlaceholderUserRepository
{
    public function findByEmail(string $email): ?array
    {
        if (!(bool) config('app.features.placeholder_auth', true)) {
            return null;
        }

        return User::placeholder($email);
    }
}
