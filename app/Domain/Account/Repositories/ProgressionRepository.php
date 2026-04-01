<?php
declare(strict_types=1);

namespace App\Domain\Account\Repositories;

use App\Core\Auth;

final class ProgressionRepository
{
    public function currentForUser(): array
    {
        $user = Auth::user();
        if ($user === null) {
            return $this->defaultProgression();
        }

        $userId = (string) ($user['id'] ?? '');
        $all = $this->all();
        $progression = $this->normalize($all[$userId] ?? [], (string) ($user['name'] ?? 'Hero'));
        $all[$userId] = $progression;
        $this->writeAll($all);

        return $progression;
    }

    public function updateCurrentUser(array $input): array
    {
        $user = Auth::user();
        if ($user === null) {
            return $this->defaultProgression();
        }

        $userId = (string) ($user['id'] ?? '');
        $all = $this->all();
        $current = $this->normalize($all[$userId] ?? [], (string) ($user['name'] ?? 'Hero'));

        $character = is_array($input['character'] ?? null) ? $input['character'] : [];
        $characterId = $this->normalizeCharacterId((string) ($character['character_id'] ?? ''));
        if ($characterId === '') {
            $characterId = $current['active_character_id'] !== ''
                    ? $current['active_character_id']
                    : 'character-' . strtolower(bin2hex(random_bytes(8)));
        }

        $characters = is_array($current['characters'] ?? null) ? $current['characters'] : [];
        $existing = is_array($characters[$characterId] ?? null)
                ? $this->normalizeCharacter($characters[$characterId], (string) ($user['name'] ?? 'Hero'), $characterId)
                : $this->defaultCharacter((string) ($user['name'] ?? 'Hero'), $characterId);

        $inventory = is_array($character['inventory'] ?? null) ? $character['inventory'] : [];
        $quests = is_array($character['quests'] ?? null) ? $character['quests'] : [];
        $equipment = is_array($character['equipment'] ?? null) ? $character['equipment'] : [];
        $attributes = is_array($character['attributes'] ?? null) ? $character['attributes'] : [];
        $stats = is_array($character['stats'] ?? null) ? $character['stats'] : [];

        $updatedCharacter = [
            'character_id' => $characterId,
            'name' => trim((string) ($character['name'] ?? $existing['name'])),
            'class_id' => trim((string) ($character['class_id'] ?? $existing['class_id'])),
            'level' => max(1, (int) ($character['level'] ?? $existing['level'])),
            'hp' => max(0, (int) ($character['hp'] ?? $existing['hp'])),
            'max_hp' => max(0, (int) ($character['max_hp'] ?? $existing['max_hp'])),
            'coins' => max(0, (int) ($character['coins'] ?? $existing['coins'])),
            'enemies_killed' => max(0, (int) ($character['enemies_killed'] ?? $existing['enemies_killed'])),
            'inventory' => array_values(array_map('strval', $inventory)),
            'quests' => array_values(array_map('strval', $quests)),
            'equipment' => [
                'weapon' => trim((string) ($equipment['weapon'] ?? $existing['equipment']['weapon'])),
                'offhand' => trim((string) ($equipment['offhand'] ?? $existing['equipment']['offhand'])),
                'armor' => trim((string) ($equipment['armor'] ?? $existing['equipment']['armor'])),
                'boots' => trim((string) ($equipment['boots'] ?? $existing['equipment']['boots'])),
                'accessory' => trim((string) ($equipment['accessory'] ?? $existing['equipment']['accessory'])),
            ],
            'attributes' => [
                'sta' => max(0, (int) ($attributes['sta'] ?? $existing['attributes']['sta'])),
                'str' => max(0, (int) ($attributes['str'] ?? $existing['attributes']['str'])),
                'int' => max(0, (int) ($attributes['int'] ?? $existing['attributes']['int'])),
                'agi' => max(0, (int) ($attributes['agi'] ?? $existing['attributes']['agi'])),
                'spi' => max(0, (int) ($attributes['spi'] ?? $existing['attributes']['spi'])),
            ],
            'stats' => [
                'mana' => max(0, (int) ($stats['mana'] ?? $existing['stats']['mana'])),
                'attack' => max(0, (float) ($stats['attack'] ?? $existing['stats']['attack'])),
                'dps' => max(0, (float) ($stats['dps'] ?? $existing['stats']['dps'])),
                'ability_power' => max(0, (float) ($stats['ability_power'] ?? $existing['stats']['ability_power'])),
                'defense' => max(0, (float) ($stats['defense'] ?? $existing['stats']['defense'])),
                'healing_power' => max(0, (float) ($stats['healing_power'] ?? $existing['stats']['healing_power'])),
            ],
            'updated_at' => gmdate('c'),
        ];

        if ($updatedCharacter['name'] === '') {
            $updatedCharacter['name'] = $existing['name'];
        }
        if ($updatedCharacter['class_id'] === '') {
            $updatedCharacter['class_id'] = $existing['class_id'];
        }

        $characters[$characterId] = $updatedCharacter;
        $updated = [
            'active_character_id' => $characterId,
            'characters' => $this->sortCharacters($characters),
        ];

        $all[$userId] = $updated;
        $this->writeAll($all);

        return $this->normalize($updated, (string) ($user['name'] ?? 'Hero'));
    }

    public function reconcileCurrentUserRoster(array $characterIds): array
    {
        $user = Auth::user();
        if ($user === null) {
            return $this->defaultProgression();
        }

        $userId = (string) ($user['id'] ?? '');
        $all = $this->all();
        $current = $this->normalize($all[$userId] ?? [], (string) ($user['name'] ?? 'Hero'));
        $characters = is_array($current['characters'] ?? null) ? $current['characters'] : [];

        $allowedIds = [];
        foreach ($characterIds as $characterId) {
            $normalizedId = $this->normalizeCharacterId((string) $characterId);
            if ($normalizedId !== '') {
                $allowedIds[$normalizedId] = true;
            }
        }

        $filtered = [];
        foreach ($characters as $characterId => $character) {
            if (isset($allowedIds[$characterId])) {
                $filtered[$characterId] = $character;
            }
        }

        $activeCharacterId = (string) ($current['active_character_id'] ?? '');
        if (!isset($filtered[$activeCharacterId])) {
            $activeCharacterId = $filtered === [] ? '' : (string) array_key_first($filtered);
        }

        $updated = [
            'active_character_id' => $activeCharacterId,
            'characters' => $this->sortCharacters($filtered),
        ];

        $all[$userId] = $updated;
        $this->writeAll($all);

        return $this->normalize($updated, (string) ($user['name'] ?? 'Hero'));
    }

    private function normalize(array $progression, string $fallbackName): array
    {
        $characters = [];

        if (is_array($progression['characters'] ?? null)) {
            foreach ($progression['characters'] as $characterId => $character) {
                if (!is_array($character)) {
                    continue;
                }
                $normalizedId = $this->normalizeCharacterId((string) $characterId);
                if ($normalizedId === '') {
                    $normalizedId = $this->normalizeCharacterId((string) ($character['character_id'] ?? ''));
                }
                if ($normalizedId === '') {
                    continue;
                }
                $characters[$normalizedId] = $this->normalizeCharacter($character, $fallbackName, $normalizedId);
            }
        }

        if ($characters === []) {
            $legacyCharacter = is_array($progression['character'] ?? null) ? $progression['character'] : [];
            if ($legacyCharacter !== []) {
                $legacyId = $this->normalizeCharacterId((string) ($legacyCharacter['character_id'] ?? 'legacy-hero'));
                $characters[$legacyId] = $this->normalizeCharacter($legacyCharacter, $fallbackName, $legacyId);
            }
        }

        $activeCharacterId = $this->normalizeCharacterId((string) ($progression['active_character_id'] ?? ''));
        if ($characters !== [] && ($activeCharacterId === '' || !isset($characters[$activeCharacterId]))) {
            $activeCharacterId = (string) array_key_first($characters);
        }
        if ($characters === []) {
            $activeCharacterId = '';
        }

        return [
            'active_character_id' => $activeCharacterId,
            'character' => $activeCharacterId !== '' ? $characters[$activeCharacterId] : [],
            'characters' => $this->sortCharacters($characters),
        ];
    }

    private function normalizeCharacter(array $character, string $fallbackName, string $characterId): array
    {
        $default = $this->defaultCharacter($fallbackName, $characterId);

        return [
            'character_id' => $characterId,
            'name' => trim((string) ($character['name'] ?? $default['name'])) ?: $default['name'],
            'class_id' => trim((string) ($character['class_id'] ?? $default['class_id'])) ?: $default['class_id'],
            'level' => max(1, (int) ($character['level'] ?? $default['level'])),
            'hp' => max(0, (int) ($character['hp'] ?? $default['hp'])),
            'max_hp' => max(0, (int) ($character['max_hp'] ?? $default['max_hp'])),
            'coins' => max(0, (int) ($character['coins'] ?? $default['coins'])),
            'enemies_killed' => max(0, (int) ($character['enemies_killed'] ?? $default['enemies_killed'])),
            'inventory' => array_values(array_map('strval', is_array($character['inventory'] ?? null) ? $character['inventory'] : $default['inventory'])),
            'quests' => array_values(array_map('strval', is_array($character['quests'] ?? null) ? $character['quests'] : $default['quests'])),
            'equipment' => $this->normalizeEquipment(is_array($character['equipment'] ?? null) ? $character['equipment'] : $default['equipment']),
            'attributes' => $this->normalizeAttributes(is_array($character['attributes'] ?? null) ? $character['attributes'] : $default['attributes']),
            'stats' => $this->normalizeStats(is_array($character['stats'] ?? null) ? $character['stats'] : $default['stats']),
            'updated_at' => trim((string) ($character['updated_at'] ?? $default['updated_at'])) ?: $default['updated_at'],
        ];
    }

    private function defaultProgression(string $fallbackName = 'Hero'): array
    {
        return [
            'active_character_id' => '',
            'character' => [],
            'characters' => [],
        ];
    }

    private function defaultCharacter(string $fallbackName, string $characterId): array
    {
        return [
            'character_id' => $characterId,
            'name' => $fallbackName !== '' ? $fallbackName : 'Hero',
            'class_id' => 'adventurer',
            'level' => 1,
            'hp' => 6,
            'max_hp' => 6,
            'coins' => 0,
            'enemies_killed' => 0,
            'inventory' => [],
            'quests' => [],
            'equipment' => [
                'weapon' => '',
                'offhand' => '',
                'armor' => '',
                'boots' => '',
                'accessory' => '',
            ],
            'attributes' => [
                'sta' => 0,
                'str' => 0,
                'int' => 0,
                'agi' => 0,
                'spi' => 0,
            ],
            'stats' => [
                'mana' => 0,
                'attack' => 0.0,
                'dps' => 0.0,
                'ability_power' => 0.0,
                'defense' => 0.0,
                'healing_power' => 0.0,
            ],
            'updated_at' => gmdate('c'),
        ];
    }

    private function normalizeEquipment(array $equipment): array
    {
        return [
            'weapon' => trim((string) ($equipment['weapon'] ?? '')),
            'offhand' => trim((string) ($equipment['offhand'] ?? '')),
            'armor' => trim((string) ($equipment['armor'] ?? '')),
            'boots' => trim((string) ($equipment['boots'] ?? '')),
            'accessory' => trim((string) ($equipment['accessory'] ?? '')),
        ];
    }

    private function normalizeAttributes(array $attributes): array
    {
        return [
            'sta' => max(0, (int) ($attributes['sta'] ?? 0)),
            'str' => max(0, (int) ($attributes['str'] ?? 0)),
            'int' => max(0, (int) ($attributes['int'] ?? 0)),
            'agi' => max(0, (int) ($attributes['agi'] ?? 0)),
            'spi' => max(0, (int) ($attributes['spi'] ?? 0)),
        ];
    }

    private function normalizeStats(array $stats): array
    {
        return [
            'mana' => max(0, (int) ($stats['mana'] ?? 0)),
            'attack' => max(0, (float) ($stats['attack'] ?? 0)),
            'dps' => max(0, (float) ($stats['dps'] ?? 0)),
            'ability_power' => max(0, (float) ($stats['ability_power'] ?? 0)),
            'defense' => max(0, (float) ($stats['defense'] ?? 0)),
            'healing_power' => max(0, (float) ($stats['healing_power'] ?? 0)),
        ];
    }

    private function normalizeCharacterId(string $characterId): string
    {
        $normalized = strtolower(trim($characterId));
        $normalized = preg_replace('/[^a-z0-9._-]+/', '-', $normalized) ?? '';
        return trim($normalized, '-');
    }

    private function sortCharacters(array $characters): array
    {
        ksort($characters);
        return $characters;
    }

    private function all(): array
    {
        $path = $this->storagePath();
        if (!is_file($path)) {
            return [];
        }

        $decoded = json_decode((string) file_get_contents($path), true);
        return is_array($decoded) ? $decoded : [];
    }

    private function writeAll(array $data): void
    {
        $path = $this->storagePath();
        $directory = dirname($path);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents(
            $path,
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        );
    }

    private function storagePath(): string
    {
        return dirname(__DIR__, 4) . '/storage/account/progression.json';
    }
}
