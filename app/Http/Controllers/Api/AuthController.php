<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Core\Auth;
use App\Core\Controller;
use App\Domain\Auth\DTOs\LoginCredentials;
use App\Domain\Auth\Services\LoginManager;
use App\Services\AnalyticsService;

final class AuthController extends Controller
{
    public function login(): never
    {
        $credentials = LoginCredentials::fromArray($this->requestInput());
        $result = (new LoginManager())->attempt($credentials);

        if (!$result->success || $result->user === null) {
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

        $this->json([
            'ok' => true,
            'user' => $result->user,
        ]);
    }

    public function logout(): never
    {
        $user = Auth::user();

        (new AnalyticsService())->trackEvent('auth.api_logout', [
            'auth_source' => (string) ($user['auth_source'] ?? 'unknown'),
        ]);

        (new LoginManager())->logout();

        $this->json([
            'ok' => true,
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
