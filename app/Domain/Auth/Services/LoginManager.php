<?php
declare(strict_types=1);

namespace App\Domain\Auth\Services;

use App\Core\Auth;
use App\Domain\Auth\DTOs\AuthResult;
use App\Domain\Auth\DTOs\LoginCredentials;
use App\Domain\Auth\Repositories\PlaceholderUserRepository;
use App\Domain\Auth\Repositories\UserRepository;

final class LoginManager
{
    public function __construct(
        private readonly UserRepository $registeredUsers = new UserRepository(),
        private readonly PlaceholderUserRepository $users = new PlaceholderUserRepository(),
    ) {
    }

    public function attempt(LoginCredentials $credentials): AuthResult
    {
        if ($credentials->identifier === '') {
            return AuthResult::failure('Enter your username or email to continue.');
        }

        $user = $this->registeredUsers->verifyCredentials($credentials->identifier, $credentials->password);
        $apiToken = null;
        $apiTokenExpiresAt = null;

        if ($user !== null) {
            $tokenData = $this->registeredUsers->rotateApiTokenByIdentifier($credentials->identifier);
            $apiToken = is_array($tokenData) ? (string) ($tokenData['token'] ?? '') : null;
            $apiTokenExpiresAt = is_array($tokenData) ? (string) ($tokenData['expires_at'] ?? '') : null;
        }

        if ($user === null && (bool) config('app.features.placeholder_auth', false)) {
            $user = $this->users->findByIdentifier($credentials->identifier);
        }

        if ($user === null) {
            return AuthResult::failure('We could not sign you in with those details.');
        }

        Auth::login($user);

        return AuthResult::success($user, $apiToken, $apiTokenExpiresAt);
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
