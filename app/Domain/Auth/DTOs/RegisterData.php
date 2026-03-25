<?php
declare(strict_types=1);

namespace App\Domain\Auth\DTOs;

final class RegisterData
{
    public function __construct(
        public readonly string $username,
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    public static function fromArray(array $input): self
    {
        return new self(
            trim((string) ($input['username'] ?? '')),
            strtolower(trim((string) ($input['email'] ?? ''))),
            (string) ($input['password'] ?? ''),
        );
    }
}
