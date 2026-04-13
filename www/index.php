<?php
declare(strict_types=1);

// Carga la base del proyecto: config, helpers y autoload.
require_once __DIR__ . '/../app/Support/bootstrap.php';

// Inicia la sesión para login, tokens y datos temporales.
\App\Core\Session::start();

// Prepara el router y le carga las rutas web y API.
$requestMethod = (string) ($_SERVER['REQUEST_METHOD'] ?? 'GET');
$router = new \App\Core\Router();
foreach ([
    __DIR__ . '/../routes/web.php',
    __DIR__ . '/../routes/api.php',
] as $routeFile) {
    $registerRoutes = require $routeFile;
    $registerRoutes($router);
}

// Resuelve la ruta pedida desde ?route=... o desde la URL real.
$scriptDir = rtrim(
    str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/'))), 
    '/'
);
$requestPath = (string) ($_GET['route'] ?? '');
if ($requestPath === '') {
    $requestPath = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
}
if ($scriptDir !== '' && $scriptDir !== '/' && str_starts_with($requestPath, $scriptDir)) {
    $requestPath = substr($requestPath, strlen($scriptDir)) ?: '/';
}

// Guarda la visita y envía la petición al controlador correcto.
(new \App\Services\AnalyticsService())->trackPageView(
    $requestPath,
    $requestMethod,
    (string) ($GLOBALS['pageLang'] ?? config('app.locale', 'en'))
);

$router->dispatch($requestMethod, $requestPath);
