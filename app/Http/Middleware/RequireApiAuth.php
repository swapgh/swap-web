<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Core\Auth;

final class RequireApiAuth
{
    public function handle(): void
    {
        if (Auth::check()) {
            return;
        }

        http_response_code(401);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode([
            'ok' => false,
            'error' => 'Authentication required.',
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
