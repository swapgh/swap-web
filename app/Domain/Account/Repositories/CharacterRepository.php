<?php
declare(strict_types=1);

namespace App\Domain\Account\Repositories;

final class CharacterRepository
{
    public function allForCurrentUser(): array
    {
        return [
            ['name' => 'Rogue', 'class' => 'Dexterity', 'level' => 8, 'hp' => 54, 'inventory' => 'Daggers, cloak, keys'],
            ['name' => 'Sentinel', 'class' => 'Defense', 'level' => 5, 'hp' => 71, 'inventory' => 'Shield, herbs, map'],
        ];
    }
}
