<?php
declare(strict_types=1);

namespace App\Models;

final class Character
{
    public static function allForCurrentUser(): array
    {
        return [
            ['name' => 'Rogue', 'class' => 'Dexterity', 'level' => 8, 'hp' => 54, 'inventory' => 'Daggers, cloak, keys'],
            ['name' => 'Sentinel', 'class' => 'Defense', 'level' => 5, 'hp' => 71, 'inventory' => 'Shield, herbs, map'],
        ];
    }
}
