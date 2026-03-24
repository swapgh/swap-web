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
    public static function path(string $view): string
    {
        return __DIR__ . '/../Views/' . str_replace('.', '/', $view) . '.php';
    }

    /**
     * Render a view file.
     *
     * @param string $view View name in dot notation, e.g. 'web.pages.home' -> Views/web/pages/home.php
     * @param array $data Optional data to pass to the view
     * @throws \RuntimeException If the view file does not exist
     */
    public static function render(string $view, array $data = []): void
    {
        $path = self::path($view);

        if (!is_file($path)) {
            throw new \RuntimeException('View not found: ' . $view);
        }

        $shared = [
            'site' => $GLOBALS['site'] ?? [],
            'pageLang' => $GLOBALS['pageLang'] ?? config('app.locale', 'es'),
            'config' => $GLOBALS['config'] ?? [],
        ];

        extract($shared + $data, EXTR_SKIP);

        require $path;
    }
}
