<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Core\Controller;
use App\Domain\Account\Services\CharacterCatalog;

final class CharacterController extends Controller
{
    public function index(): void
    {
        $this->protectSensitivePage();

        $characters = (new CharacterCatalog())->allForCurrentUser();

        $this->render('web.pages.characters', [
            'characters' => $characters,
            'robotsContent' => 'noindex,nofollow,noarchive',
        ]);
    }
}
