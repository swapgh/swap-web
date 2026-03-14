<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/Support/bootstrap.php';

\App\Core\Session::start();

$router = new \App\Core\Router();
$registerRoutes = require __DIR__ . '/../routes/web.php';
$registerRoutes($router);

$scriptDir = rtrim(str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/'))), '/');
$requestPath = (string) ($_GET['route'] ?? '');
if ($requestPath === '') {
    $requestPath = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
}
if ($scriptDir !== '' && $scriptDir !== '/' && str_starts_with($requestPath, $scriptDir)) {
    $requestPath = substr($requestPath, strlen($scriptDir)) ?: '/';
}

$router->dispatch((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'), $requestPath);
