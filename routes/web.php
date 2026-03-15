<?php
declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\CharacterController;
use App\Controllers\HomeController;
use App\Controllers\ProfileController;
use App\Middleware\AuthMiddleware;

return static function (\App\Core\Router $router): void {
    $router->get('/', [HomeController::class, 'index']);
    $router->get('/index.php', [HomeController::class, 'index']);
    $router->get('/login', [AuthController::class, 'showLogin']);
    $router->post('/login', [AuthController::class, 'login']);
    $router->get('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);
    $router->get('/profile', [ProfileController::class, 'index'], [AuthMiddleware::class]);
    $router->get('/characters', [CharacterController::class, 'index'], [AuthMiddleware::class]);
    $router->get('/devlog/hito1', static fn() => (new HomeController())->milestone('hito1'));
    $router->get('/devlog/hito2', static fn() => (new HomeController())->milestone('hito2'));
    $router->get('/devlog/hito3', static fn() => (new HomeController())->milestone('hito3'));
    $router->get('/devlog/hito4', static fn() => (new HomeController())->milestone('hito4'));
    $router->get('/devlog/hito5', static fn() => (new HomeController())->milestone('hito5'));
    $router->get('/devlog/hito6', static fn() => (new HomeController())->milestone('hito6'));
};
