<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Core\Controller;
use App\Domain\Account\Services\CharacterCatalog;
use App\Domain\Account\Services\ProfileReader;

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
}
