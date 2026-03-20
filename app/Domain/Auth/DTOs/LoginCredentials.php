<?php
declare(strict_types=1);

namespace App\Domain\Auth\DTOs;

final class LoginCredentials
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    public static function fromArray(array $input): self
    {
        return new self(
            strtolower(trim((string) ($input['email'] ?? ''))),
            (string) ($input['password'] ?? ''),
        );
    }
}
