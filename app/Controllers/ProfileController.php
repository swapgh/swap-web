<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;

final class ProfileController extends Controller
{
    public function index(): void
    {
        $this->render('pages.profile', ['user' => Auth::user()]);
    }
}
