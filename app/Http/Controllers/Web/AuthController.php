<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;
use App\Domain\Auth\DTOs\LoginCredentials;
use App\Domain\Auth\DTOs\RegisterData;
use App\Domain\Auth\Services\LoginManager;
use App\Domain\Auth\Services\RegisterManager;
use App\Support\RateLimiter;
use App\Services\AnalyticsService;

final class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->protectSensitivePage();

        $this->renderPage('web.pages.auth.login', [
            'authError' => Session::pull('_flash.auth_error'),
            'robotsContent' => 'noindex,nofollow,noarchive',
        ]);
    }

    public function showRegister(): void
    {
        $this->protectSensitivePage();

        $this->renderPage('web.pages.auth.register', [
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
        $limiter = new RateLimiter();
        $rateKey = $this->rateLimitKey('auth.login', $credentials->identifier);
        if ($limiter->tooManyAttempts($rateKey, 5, 300)) {
            $this->protectSensitivePage();
            $this->renderPage('web.pages.auth.login', [
                'authError' => 'Too many login attempts. Please try again later.',
                'robotsContent' => 'noindex,nofollow,noarchive',
            ]);
            return;
        }

        $result = (new LoginManager())->attempt($credentials);

        if (!$result->success || $result->user === null) {
            $limiter->hit($rateKey, 300);
            (new AnalyticsService())->trackEvent('auth.login_failed', [
                'identifier' => $credentials->identifier,
            ]);

            $this->protectSensitivePage();
            $this->renderPage('web.pages.auth.login', [
                'authError' => $result->error ?? 'We could not sign you in with those details.',
                'robotsContent' => 'noindex,nofollow,noarchive',
            ]);
            return;
        }

        $user = $result->user;
        if (!empty($_POST['remember'])) {
            Session::rememberForSeconds((int) config('app.auth.remember_ttl', 2592000));
        }

        (new AnalyticsService())->trackEvent('auth.login_succeeded', [
            'auth_source' => (string) ($user['auth_source'] ?? 'unknown'),
        ]);
        $limiter->clear($rateKey);

        $this->redirect(with_lang(page_url('account')));
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

    public function register(): void
    {
        if (!verify_csrf_token($_POST['_token'] ?? null)) {
            Session::flash('auth_error', 'Your session expired. Please try again.');
            $this->redirect(with_lang(page_url('register')));
        }

        $data = RegisterData::fromArray($_POST);
        $limiter = new RateLimiter();
        $rateKey = $this->rateLimitKey('auth.register', $data->email !== '' ? $data->email : $data->username);
        if ($limiter->tooManyAttempts($rateKey, 5, 600)) {
            $this->protectSensitivePage();
            $this->renderPage('web.pages.auth.register', [
                'authError' => 'Too many registration attempts. Please try again later.',
                'robotsContent' => 'noindex,nofollow,noarchive',
            ]);
            return;
        }

        $result = (new RegisterManager())->attempt($data);

        if (!$result->success || $result->user === null) {
            $limiter->hit($rateKey, 600);
            (new AnalyticsService())->trackEvent('auth.register_failed', [
                'email' => $data->email,
                'username' => $data->username,
            ]);

            $this->protectSensitivePage();
            $this->renderPage('web.pages.auth.register', [
                'authError' => $result->error ?? 'We could not create your account.',
                'robotsContent' => 'noindex,nofollow,noarchive',
            ]);
            return;
        }

        (new AnalyticsService())->trackEvent('auth.register_succeeded', [
            'auth_source' => (string) ($result->user['auth_source'] ?? 'unknown'),
        ]);
        $limiter->clear($rateKey);

        $this->redirect(with_lang(page_url('account')));
    }

    private function rateLimitKey(string $action, string $identifier): string
    {
        $ip = (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown');

        return strtolower($action . '|' . $ip . '|' . trim($identifier));
    }
}
