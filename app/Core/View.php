<?php
declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $data = []): void
    {
        $path = __DIR__ . '/../Views/' . str_replace('.', '/', $view) . '.php';
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
