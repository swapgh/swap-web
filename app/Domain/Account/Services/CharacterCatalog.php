<?php
declare(strict_types=1);

namespace App\Domain\Account\Services;

use App\Domain\Account\Repositories\CharacterRepository;

final class CharacterCatalog
{
    public function __construct(
        private readonly CharacterRepository $characters = new CharacterRepository(),
    ) {
    }

    public function allForCurrentUser(): array
    {
        return $this->characters->allForCurrentUser();
    }
}
