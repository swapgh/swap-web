<?php
declare(strict_types=1); // Enforce strict typing for better type safety

// Load the bootstrap file which sets up the application environment
require_once __DIR__ . '/../app/Support/bootstrap.php';

// Start the session using the custom Session class
\App\Core\Session::start();

// Determine the HTTP request method (GET, POST, etc.)
$requestMethod = (string) ($_SERVER['REQUEST_METHOD'] ?? 'GET');

// Instantiate the router
$router = new \App\Core\Router();

foreach ([
    __DIR__ . '/../routes/web.php',
    __DIR__ . '/../routes/api.php',
] as $routeFile) {
    $registerRoutes = require $routeFile;
    $registerRoutes($router);
}

// Get the directory path of the current script (used to adjust routing)
$scriptDir = rtrim(
    str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/'))), 
    '/'
);

// Determine the requested path from the "route" GET parameter, if present
$requestPath = (string) ($_GET['route'] ?? '');

// If "route" parameter is empty, fall back to using the URL path from REQUEST_URI
if ($requestPath === '') {
    $requestPath = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
}

// Remove the script directory from the request path if present (for subdirectory installations)
if ($scriptDir !== '' && $scriptDir !== '/' && str_starts_with($requestPath, $scriptDir)) {
    $requestPath = substr($requestPath, strlen($scriptDir)) ?: '/';
}

// Track page view using the AnalyticsService
(new \App\Services\AnalyticsService())->trackPageView(
    $requestPath, // The requested URL path
    $requestMethod, // HTTP method
    (string) ($GLOBALS['pageLang'] ?? config('app.locale', 'en')) // Current language
);

// Dispatch the request to the appropriate route handler
$router->dispatch($requestMethod, $requestPath);
