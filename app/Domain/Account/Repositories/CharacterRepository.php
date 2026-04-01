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
        $characters = is_array($progress['characters'] ?? null) ? $progress['characters'] : [];
        $activeCharacterId = (string) ($progress['active_character_id'] ?? '');
        $roster = [];

        foreach ($characters as $characterId => $character) {
            if (!is_array($character)) {
                continue;
            }

            $roster[] = [
                'character_id' => (string) ($character['character_id'] ?? $characterId),
                'is_active' => (string) ($character['character_id'] ?? $characterId) === $activeCharacterId,
                'name' => (string) ($character['name'] ?? 'Hero'),
                'class_id' => (string) ($character['class_id'] ?? 'adventurer'),
                'level' => (int) ($character['level'] ?? 1),
                'mastery_points' => (int) ($character['mastery_points'] ?? 0),
                'hp' => (int) ($character['hp'] ?? 6),
                'max_hp' => (int) ($character['max_hp'] ?? 6),
                'coins' => (int) ($character['coins'] ?? 0),
                'enemies_killed' => (int) ($character['enemies_killed'] ?? 0),
                'inventory' => array_values(array_map('strval', is_array($character['inventory'] ?? null) ? $character['inventory'] : [])),
                'quests' => array_values(array_map('strval', is_array($character['quests'] ?? null) ? $character['quests'] : [])),
                'equipment' => is_array($character['equipment'] ?? null) ? $character['equipment'] : [],
                'attributes' => is_array($character['attributes'] ?? null) ? $character['attributes'] : [],
                'stats' => is_array($character['stats'] ?? null) ? $character['stats'] : [],
                'mastery' => is_array($character['mastery'] ?? null) ? $character['mastery'] : [],
                'updated_at' => (string) ($character['updated_at'] ?? ''),
            ];
        }

        usort($roster, static function (array $left, array $right): int {
            if (($left['is_active'] ?? false) !== ($right['is_active'] ?? false)) {
                return ($left['is_active'] ?? false) ? -1 : 1;
            }

            return strcmp((string) ($right['updated_at'] ?? ''), (string) ($left['updated_at'] ?? ''));
        });

        return $roster;
    }
}
