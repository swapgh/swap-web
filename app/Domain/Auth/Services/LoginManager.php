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
        if ($credentials->email === '') {
            return AuthResult::failure('Enter your email to continue.');
        }

        if (!filter_var($credentials->email, FILTER_VALIDATE_EMAIL)) {
            return AuthResult::failure('Enter a valid email address.');
        }

        $user = $this->registeredUsers->verifyCredentials($credentials->email, $credentials->password);
        if ($user === null && (bool) config('app.features.placeholder_auth', false)) {
            $user = $this->users->findByEmail($credentials->email);
        }

        if ($user === null) {
            return AuthResult::failure('We could not sign you in with those details.');
        }

        Auth::login($user);

        return AuthResult::success($user);
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
