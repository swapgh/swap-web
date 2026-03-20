<?php
declare(strict_types=1);

/**
 * Router for PHP's built-in development server.
 *
 * Usage:
 * php -S 127.0.0.1:3000 -t www www/router.php
 */

$_SERVER['SCRIPT_NAME'] = '/index.php';

$uri = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
$publicFile = realpath(__DIR__ . $uri);
$publicRoot = realpath(__DIR__);

if (
    $publicFile !== false
    && $publicRoot !== false
    && str_starts_with($publicFile, $publicRoot)
    && is_file($publicFile)
) {
    return false;
}

require __DIR__ . '/index.php';
