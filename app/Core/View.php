<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Simple View renderer
 *
 * Allows rendering PHP templates with optional data injection.
 */
final class View
{
    /**
     * Render a view file.
     *
     * @param string $view View name in dot notation, e.g. 'web.pages.home' → Views/web/pages/home.php
     * @param array $data Optional data to pass to the view
     * @throws \RuntimeException If the view file does not exist
     */
    public static function render(string $view, array $data = []): void
    {
        // Convert dot notation to file path
        $path = __DIR__ . '/../Views/' . str_replace('.', '/', $view) . '.php';

        // Check if view file exists
        if (!is_file($path)) {
            throw new \RuntimeException('View not found: ' . $view);
        }

        // Shared global variables available in all views
        $shared = [
            'site' => $GLOBALS['site'] ?? [], // Site info (name, URLs, etc.)
            'pageLang' => $GLOBALS['pageLang'] ?? config('app.locale', 'es'), // Current page language
            'config' => $GLOBALS['config'] ?? [], // App config
        ];

        // Extract shared variables + any custom $data into local scope
        extract($shared + $data, EXTR_SKIP);

        // Include the PHP template
        require $path;
    }
}
