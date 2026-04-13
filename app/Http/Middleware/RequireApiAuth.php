<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Core\Auth;
use App\Domain\Auth\Repositories\UserRepository;

final class RequireApiAuth
{
    public function handle(): void
    {
        $token = $this->bearerToken();
        if ($token !== '') {
            $user = (new UserRepository())->findByApiToken($token);
            if ($user !== null) {
                Auth::resolve($user);
                return;
            }
        }

        http_response_code(401);
        header('Content-Type: application/json; charset=UTF-8');
        header('WWW-Authenticate: Bearer');
        echo json_encode([
            'ok' => false,
            'error' => 'Bearer token required.',
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    private function bearerToken(): string
    {
        $header = (string) ($_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? '');
        if (!preg_match('/^Bearer\s+(.+)$/i', trim($header), $matches)) {
            return '';
        }

        return trim((string) ($matches[1] ?? ''));
    }
}
