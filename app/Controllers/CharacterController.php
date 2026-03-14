<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Character;

final class CharacterController extends Controller
{
    public function index(): void
    {
        $this->render('pages.characters', ['characters' => Character::allForCurrentUser()]);
    }
}
