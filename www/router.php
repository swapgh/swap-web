<?php
/**
 * Router for PHP's built-in development server
 * Serves assets from ../assets/ directory
 * Usage: php -S localhost:3000 router.php
 */

// Fix SCRIPT_NAME for proper URL generation
$_SERVER['SCRIPT_NAME'] = '/index.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve assets from ../assets/
if (strpos($uri, '/assets/') === 0) {
    $file = __DIR__ . '/..' . $uri;

    if (is_file($file)) {
        // Determine MIME type
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $mimeTypes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'webp' => 'image/webp',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'zip' => 'application/zip',
        ];

        $mimeType = $mimeTypes[$ext] ?? 'application/octet-stream';
        header('Content-Type: ' . $mimeType);
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}

// Route everything else to index.php
require __DIR__ . '/index.php';
