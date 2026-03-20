<?php
declare(strict_types=1);

namespace App\Domain\Account\Services;

use App\Core\Auth;
use App\Domain\Account\DTOs\ProfileData;

final class ProfileReader
{
    public function current(): ?array
    {
        $user = Auth::user();
        if ($user === null) {
            return null;
        }

        return ProfileData::fromUser($user);
    }
}
