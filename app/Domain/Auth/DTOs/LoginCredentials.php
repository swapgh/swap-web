<?php
declare(strict_types=1);

namespace App\Domain\Auth\DTOs;

final class LoginCredentials
{
    public function __construct(
        public readonly string $identifier,
        public readonly string $password,
    ) {
    }

    public static function fromArray(array $input): self
    {
        $identifier = (string) ($input['identifier'] ?? $input['email'] ?? $input['username'] ?? '');

        return new self(
            trim($identifier),
            (string) ($input['password'] ?? ''),
        );
    }
}
