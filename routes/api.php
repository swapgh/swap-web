<?php
declare(strict_types=1);

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillingController;
use App\Http\Controllers\Api\BillingWebhookController;
use App\Http\Controllers\Api\HealthController;
use App\Http\Middleware\RequireApiAuth;

return static function (\App\Core\Router $router): void {
    $router->get('/api/health', [HealthController::class, 'show']);
    $router->post('/api/auth/login', [AuthController::class, 'login']);
    $router->post('/api/auth/register', [AuthController::class, 'register']);
    $router->post('/api/auth/logout', [AuthController::class, 'logout'], [RequireApiAuth::class]);
    $router->get('/api/account/profile', [AccountController::class, 'profile'], [RequireApiAuth::class]);
    $router->get('/api/account/characters', [AccountController::class, 'characters'], [RequireApiAuth::class]);
    $router->get('/api/account/progression', [AccountController::class, 'progression'], [RequireApiAuth::class]);
    $router->post('/api/account/progression', [AccountController::class, 'syncProgression'], [RequireApiAuth::class]);
    $router->get('/api/billing/config', [BillingController::class, 'config']);
    $router->post('/api/billing/checkout', [BillingController::class, 'createCheckout'], [RequireApiAuth::class]);
    $router->get('/api/billing/checkout', [BillingController::class, 'currentCheckout'], [RequireApiAuth::class]);
    $router->post('/api/billing/webhook', [BillingWebhookController::class, 'handle']);
};
