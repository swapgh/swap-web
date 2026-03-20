<?php
declare(strict_types=1);

namespace App\Domain\Auth\DTOs;

final class AuthResult
{
    public function __construct(
        public readonly bool $success,
        public readonly ?array $user = null,
        public readonly ?string $error = null,
    ) {
    }

    public static function success(array $user): self
    {
        return new self(true, $user, null);
    }

    public static function failure(string $error): self
    {
        return new self(false, null, $error);
    }
}
