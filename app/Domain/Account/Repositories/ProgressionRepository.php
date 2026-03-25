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
        $progression = $all[$userId] ?? null;

        if (!is_array($progression)) {
            $progression = $this->defaultProgression((string) ($user['name'] ?? 'Hero'));
            $all[$userId] = $progression;
            $this->writeAll($all);
        }

        return $this->normalize($progression, (string) ($user['name'] ?? 'Hero'));
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
        $inventory = is_array($character['inventory'] ?? null) ? $character['inventory'] : [];
        $quests = is_array($character['quests'] ?? null) ? $character['quests'] : [];

        $updated = [
            'character' => [
                'name' => trim((string) ($character['name'] ?? $current['character']['name'])),
                'class_id' => trim((string) ($character['class_id'] ?? $current['character']['class_id'])),
                'level' => max(1, (int) ($character['level'] ?? $current['character']['level'])),
                'hp' => max(0, (int) ($character['hp'] ?? $current['character']['hp'])),
                'max_hp' => max(0, (int) ($character['max_hp'] ?? $current['character']['max_hp'])),
                'coins' => max(0, (int) ($character['coins'] ?? $current['character']['coins'])),
                'enemies_killed' => max(0, (int) ($character['enemies_killed'] ?? $current['character']['enemies_killed'])),
                'inventory' => array_values(array_map('strval', $inventory)),
                'quests' => array_values(array_map('strval', $quests)),
                'updated_at' => gmdate('c'),
            ],
        ];

        if ($updated['character']['name'] === '') {
            $updated['character']['name'] = $current['character']['name'];
        }

        if ($updated['character']['class_id'] === '') {
            $updated['character']['class_id'] = $current['character']['class_id'];
        }

        $all[$userId] = $updated;
        $this->writeAll($all);

        return $updated;
    }

    private function normalize(array $progression, string $fallbackName): array
    {
        $default = $this->defaultProgression($fallbackName);
        $character = is_array($progression['character'] ?? null) ? $progression['character'] : [];

        return [
            'character' => [
                'name' => trim((string) ($character['name'] ?? $default['character']['name'])) ?: $default['character']['name'],
                'class_id' => trim((string) ($character['class_id'] ?? $default['character']['class_id'])) ?: $default['character']['class_id'],
                'level' => max(1, (int) ($character['level'] ?? $default['character']['level'])),
                'hp' => max(0, (int) ($character['hp'] ?? $default['character']['hp'])),
                'max_hp' => max(0, (int) ($character['max_hp'] ?? $default['character']['max_hp'])),
                'coins' => max(0, (int) ($character['coins'] ?? $default['character']['coins'])),
                'enemies_killed' => max(0, (int) ($character['enemies_killed'] ?? $default['character']['enemies_killed'])),
                'inventory' => array_values(array_map('strval', is_array($character['inventory'] ?? null) ? $character['inventory'] : $default['character']['inventory'])),
                'quests' => array_values(array_map('strval', is_array($character['quests'] ?? null) ? $character['quests'] : $default['character']['quests'])),
                'updated_at' => trim((string) ($character['updated_at'] ?? $default['character']['updated_at'])),
            ],
        ];
    }

    private function defaultProgression(string $fallbackName = 'Hero'): array
    {
        return [
            'character' => [
                'name' => $fallbackName !== '' ? $fallbackName : 'Hero',
                'class_id' => 'adventurer',
                'level' => 1,
                'hp' => 6,
                'max_hp' => 6,
                'coins' => 0,
                'enemies_killed' => 0,
                'inventory' => [],
                'quests' => [],
                'updated_at' => gmdate('c'),
            ],
        ];
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
