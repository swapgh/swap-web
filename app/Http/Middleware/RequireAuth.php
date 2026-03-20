<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Core\Auth;

final class RequireAuth
{
    public function handle(): void
    {
        if (!Auth::check()) {
            header('Location: ' . with_lang(page_url('login')));
            exit;
        }
    }
}
