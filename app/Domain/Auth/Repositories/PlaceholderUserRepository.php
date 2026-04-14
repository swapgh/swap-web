<?php
declare(strict_types=1);

namespace App\Domain\Auth\Repositories;

use App\Domain\Auth\Entities\User;

final class PlaceholderUserRepository
{
    public function findByIdentifier(string $identifier): ?array
    {
        if (!(bool) config('app.features.placeholder_auth', true)) {
            return null;
        }

        return User::placeholder(trim($identifier));
    }

    public function findByEmail(string $email): ?array
    {
        return $this->findByIdentifier($email);
    }
}
