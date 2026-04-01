<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Core\Controller;
use App\Domain\Account\Services\CharacterCatalog;
use App\Domain\Account\Services\ProfileReader;
use App\Domain\Account\Repositories\ProgressionRepository;
use App\Domain\Account\Services\ProgressionReader;

final class AccountController extends Controller
{
    public function profile(): never
    {
        $this->json([
            'ok' => true,
            'profile' => (new ProfileReader())->current(),
        ]);
    }

    public function characters(): never
    {
        $this->json([
            'ok' => true,
            'characters' => (new CharacterCatalog())->allForCurrentUser(),
        ]);
    }

    public function progression(): never
    {
        $this->json([
            'ok' => true,
            'progression' => (new ProgressionReader())->current(),
        ]);
    }

    public function syncProgression(): never
    {
        $payload = $this->requestInput();
        $progression = (new ProgressionRepository())->updateCurrentUser($payload);

        $this->json([
            'ok' => true,
            'progression' => $progression,
        ]);
    }

    public function reconcileRoster(): never
    {
        $payload = $this->requestInput();
        $characterIds = is_array($payload['character_ids'] ?? null) ? $payload['character_ids'] : [];
        $progression = (new ProgressionRepository())->reconcileCurrentUserRoster($characterIds);

        $this->json([
            'ok' => true,
            'progression' => $progression,
        ]);
    }

    private function requestInput(): array
    {
        $contentType = strtolower((string) ($_SERVER['CONTENT_TYPE'] ?? ''));
        if (str_contains($contentType, 'application/json')) {
            $decoded = json_decode((string) file_get_contents('php://input'), true);
            return is_array($decoded) ? $decoded : [];
        }

        return $_POST;
    }
}
