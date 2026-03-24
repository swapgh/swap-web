<?php
declare(strict_types=1);

use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PublicPageController;
use App\Http\Middleware\RequireAuth;
use App\Support\PageCatalog;

return static function (\App\Core\Router $router): void {
    $router->get('/', [HomeController::class, 'index']);
    $router->get('/index.php', [HomeController::class, 'index']);

    foreach (PageCatalog::all() as $page) {
        $slug = (string) $page['slug'];
        $path = '/' . ltrim((string) $page['path'], '/');

        $router->get($path, static function () use ($slug): void {
            (new PublicPageController())->show($slug);
        });
    }

    $router->get('/login', [AuthController::class, 'showLogin']);
    $router->post('/login', [AuthController::class, 'login']);
    $router->post('/logout', [AuthController::class, 'logout'], [RequireAuth::class]);

    $router->get('/account', [AccountController::class, 'dashboard'], [RequireAuth::class]);
    $router->get('/account/characters', [AccountController::class, 'characters'], [RequireAuth::class]);
    $router->get('/account/support/history', [AccountController::class, 'supportHistory'], [RequireAuth::class]);
    $router->post('/account/support/checkout', [AccountController::class, 'checkout'], [RequireAuth::class]);
};
