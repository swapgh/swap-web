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
    $router->get('/html/hito1.php', static fn() => (new HomeController())->milestone('hito1'));
    $router->get('/html/hito2.php', static fn() => (new HomeController())->milestone('hito2'));
    $router->get('/html/hito3.php', static fn() => (new HomeController())->milestone('hito3'));
    $router->get('/html/hito4.php', static fn() => (new HomeController())->milestone('hito4'));
    $router->get('/html/hito5.php', static fn() => (new HomeController())->milestone('hito5'));
    $router->get('/html/hito6.php', static fn() => (new HomeController())->milestone('hito6'));
};
