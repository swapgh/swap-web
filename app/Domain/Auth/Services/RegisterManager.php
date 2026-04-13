<?php
declare(strict_types=1);

namespace App\Domain\Auth\Services;

use App\Core\Auth;
use App\Domain\Auth\DTOs\AuthResult;
use App\Domain\Auth\DTOs\RegisterData;
use App\Domain\Auth\Repositories\UserRepository;

final class RegisterManager
{
    public function __construct(
        private readonly UserRepository $users = new UserRepository(),
    ) {
    }

    public function attempt(RegisterData $data): AuthResult
    {
        if ($data->username === '') {
            return AuthResult::failure('Choose a username to continue.');
        }

        if (!preg_match('/^[a-zA-Z0-9_-]{3,24}$/', $data->username)) {
            return AuthResult::failure('Use 3 to 24 characters: letters, numbers, underscore, or dash.');
        }

        if ($data->email === '' || !filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
            return AuthResult::failure('Enter a valid email address.');
        }

        if (strlen($data->password) < 6) {
            return AuthResult::failure('Use a password with at least 6 characters.');
        }

        if ($this->users->findByEmail($data->email) !== null) {
            return AuthResult::failure('That email is already registered.');
        }

        if ($this->users->findByUsername($data->username) !== null) {
            return AuthResult::failure('That username is already taken.');
        }

        $created = $this->users->create($data);
        $user = is_array($created['user'] ?? null) ? $created['user'] : null;
        $apiToken = is_string($created['api_token'] ?? null) ? $created['api_token'] : null;
        $apiTokenExpiresAt = is_string($created['api_token_expires_at'] ?? null) ? $created['api_token_expires_at'] : null;
        if ($user === null) {
            return AuthResult::failure('We could not create your account.');
        }

        Auth::login($user);

        return AuthResult::success($user, $apiToken, $apiTokenExpiresAt);
    }
}
