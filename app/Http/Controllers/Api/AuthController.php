<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Core\Auth;
use App\Core\Controller;
use App\Domain\Auth\DTOs\LoginCredentials;
use App\Domain\Auth\DTOs\RegisterData;
use App\Domain\Auth\Repositories\UserRepository;
use App\Domain\Auth\Services\LoginManager;
use App\Domain\Auth\Services\RegisterManager;
use App\Support\RateLimiter;
use App\Services\AnalyticsService;

final class AuthController extends Controller
{
    public function login(): never
    {
        $payload = $this->requestInput();
        $credentials = LoginCredentials::fromArray($payload);
        $limiter = new RateLimiter();
        $rateKey = $this->rateLimitKey('auth.login', $credentials->email);

        if ($limiter->tooManyAttempts($rateKey, 5, 300)) {
            $this->json([
                'ok' => false,
                'error' => 'Too many login attempts. Please try again later.',
                'retry_after' => $limiter->availableIn($rateKey, 300),
            ], 429);
        }

        $result = (new LoginManager())->attempt($credentials);

        if (!$result->success || $result->user === null) {
            $limiter->hit($rateKey, 300);
            (new AnalyticsService())->trackEvent('auth.api_login_failed', [
                'email' => $credentials->email,
            ]);

            $this->json([
                'ok' => false,
                'error' => $result->error ?? 'We could not sign you in with those details.',
            ], 422);
        }

        (new AnalyticsService())->trackEvent('auth.api_login_succeeded', [
            'auth_source' => (string) ($result->user['auth_source'] ?? 'unknown'),
        ]);
        $limiter->clear($rateKey);

        $this->json([
            'ok' => true,
            'user' => $result->user,
            'api_token' => $result->apiToken,
            'api_token_expires_at' => $result->apiTokenExpiresAt,
        ]);
    }

    public function logout(): never
    {
        $user = Auth::user();
        $email = is_array($user) ? (string) ($user['email'] ?? '') : '';

        (new AnalyticsService())->trackEvent('auth.api_logout', [
            'auth_source' => (string) ($user['auth_source'] ?? 'unknown'),
        ]);

        if ($email !== '') {
            (new UserRepository())->revokeApiToken($email);
        }

        (new LoginManager())->logout();

        $this->json([
            'ok' => true,
        ]);
    }

    public function register(): never
    {
        $payload = $this->requestInput();
        $data = RegisterData::fromArray($payload);
        $limiter = new RateLimiter();
        $rateKey = $this->rateLimitKey('auth.register', $data->email !== '' ? $data->email : $data->username);

        if ($limiter->tooManyAttempts($rateKey, 5, 600)) {
            $this->json([
                'ok' => false,
                'error' => 'Too many registration attempts. Please try again later.',
                'retry_after' => $limiter->availableIn($rateKey, 600),
            ], 429);
        }

        $result = (new RegisterManager())->attempt($data);

        if (!$result->success || $result->user === null) {
            $limiter->hit($rateKey, 600);
            (new AnalyticsService())->trackEvent('auth.api_register_failed', [
                'email' => $data->email,
                'username' => $data->username,
            ]);

            $this->json([
                'ok' => false,
                'error' => $result->error ?? 'We could not create your account.',
            ], 422);
        }

        (new AnalyticsService())->trackEvent('auth.api_register_succeeded', [
            'auth_source' => (string) ($result->user['auth_source'] ?? 'unknown'),
        ]);
        $limiter->clear($rateKey);

        $this->json([
            'ok' => true,
            'user' => $result->user,
            'api_token' => $result->apiToken,
            'api_token_expires_at' => $result->apiTokenExpiresAt,
        ], 201);
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

    private function rateLimitKey(string $action, string $identifier): string
    {
        $ip = (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown');

        return strtolower($action . '|' . $ip . '|' . trim($identifier));
    }
}
