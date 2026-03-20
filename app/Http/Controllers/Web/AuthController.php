<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;
use App\Domain\Auth\DTOs\LoginCredentials;
use App\Domain\Auth\Services\LoginManager;
use App\Services\AnalyticsService;

/**
 * Controlador para manejo de autenticación (login/logout)
 */
final class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->protectSensitivePage();

        $this->render('web.pages.login', [
            'authError' => Session::pull('_flash.auth_error'),
            'robotsContent' => 'noindex,nofollow,noarchive',
        ]);
    }

    public function login(): void
    {
        if (!verify_csrf_token($_POST['_token'] ?? null)) {
            Session::flash('auth_error', 'Your session expired. Please try again.');
            $this->redirect(with_lang(page_url('login')));
        }

        $credentials = LoginCredentials::fromArray($_POST);
        $result = (new LoginManager())->attempt($credentials);

        if (!$result->success || $result->user === null) {
            (new AnalyticsService())->trackEvent('auth.login_failed', [
                'email' => $credentials->email,
            ]);

            $this->protectSensitivePage();
            $this->render('web.pages.login', [
                'authError' => $result->error ?? 'We could not sign you in with those details.',
                'robotsContent' => 'noindex,nofollow,noarchive',
            ]);
            return;
        }
        $user = $result->user;

        (new AnalyticsService())->trackEvent('auth.login_succeeded', [
            'auth_source' => (string) ($user['auth_source'] ?? 'unknown'),
        ]);

        $this->redirect(with_lang(page_url('profile')));
    }

    public function logout(): void
    {
        if (!verify_csrf_token($_POST['_token'] ?? null)) {
            Session::flash('auth_error', 'Your session expired. Please sign in again.');
            $this->redirect(with_lang(page_url('login')));
        }

        $user = Auth::user();
        (new AnalyticsService())->trackEvent('auth.logout', [
            'auth_source' => (string) ($user['auth_source'] ?? 'unknown'),
        ]);

        (new LoginManager())->logout();

        $this->redirect(with_lang(page_url('login')));
    }
}
