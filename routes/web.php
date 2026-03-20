<?php
declare(strict_types=1);

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CharacterController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\SupportController;
use App\Http\Middleware\RequireAuth;

return static function (\App\Core\Router $router): void {
    $router->get('/', [HomeController::class, 'index']);
    $router->get('/index.php', [HomeController::class, 'index']);
    $router->get('/projects/swap-rpg', [PageController::class, 'project']);
    $router->get('/contact', [PageController::class, 'contact']);
    $router->get('/help', [PageController::class, 'help']);
    $router->get('/store', [PageController::class, 'store']);
    $router->get('/privacy', [PageController::class, 'privacy']);
    $router->get('/cookies', [PageController::class, 'cookies']);
    $router->get('/games/class-select', [PageController::class, 'classSelect']);
    $router->get('/games/combat-slice', [PageController::class, 'combatSlice']);
    $router->get('/games/dark-biome', [PageController::class, 'darkBiome']);
    $router->get('/games/rogue-build', [PageController::class, 'rogueBuild']);
    $router->get('/games/liminal-zone', [PageController::class, 'liminalZone']);
    $router->get('/login', [AuthController::class, 'showLogin']);
    $router->post('/login', [AuthController::class, 'login']);
    $router->post('/logout', [AuthController::class, 'logout'], [RequireAuth::class]);
    $router->get('/profile', [ProfileController::class, 'index'], [RequireAuth::class]);
    $router->post('/support/contribute', [SupportController::class, 'checkout'], [RequireAuth::class]);
    $router->get('/support/history', [SupportController::class, 'history'], [RequireAuth::class]);
    $router->post('/billing/checkout', [SupportController::class, 'checkout'], [RequireAuth::class]);
    $router->get('/billing/history', static function (): void {
        header('Location: ' . with_lang(page_url('support/history')));
        exit;
    }, [RequireAuth::class]);
    $router->get('/characters', [CharacterController::class, 'index'], [RequireAuth::class]);
};
