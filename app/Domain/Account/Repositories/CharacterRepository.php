<?php
declare(strict_types=1);

namespace App\Domain\Account\Repositories;

final class CharacterRepository
{
    public function __construct(
        private readonly ProgressionRepository $progression = new ProgressionRepository(),
    ) {
    }

    public function allForCurrentUser(): array
    {
        $progress = $this->progression->currentForUser();
        $character = is_array($progress['character'] ?? null) ? $progress['character'] : [];
        $inventory = is_array($character['inventory'] ?? null) ? $character['inventory'] : [];

        return [
            [
                'name' => (string) ($character['name'] ?? 'Hero'),
                'class' => ucfirst(str_replace('_', ' ', (string) ($character['class_id'] ?? 'adventurer'))),
                'level' => (int) ($character['level'] ?? 1),
                'hp' => (int) ($character['hp'] ?? 6),
                'inventory' => $inventory !== [] ? implode(', ', array_map('strval', $inventory)) : '',
            ],
        ];
    }
}
