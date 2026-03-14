<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\User;

final class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->render('pages.login');
    }

    public function login(): void
    {
        $email = trim((string) ($_POST['email'] ?? ''));
        if ($email === '') {
            $this->render('pages.login', ['authError' => 'Email is required.']);
            return;
        }

        Auth::login(User::fake($email));
        $this->redirect(with_lang(page_url('profile')));
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect(with_lang(page_url('login')));
    }
}
