<?php
declare(strict_types=1);

$translations = [
    'es' => require __DIR__ . '/../../lang/es.php',
    'en' => require __DIR__ . '/../../lang/en.php',
];

function t(string $key): string
{
    $lang = $GLOBALS['pageLang'] ?? config('app.locale', 'es');
    $catalogue = $GLOBALS['translations'][$lang] ?? [];
    if (array_key_exists($key, $catalogue)) {
        return (string) $catalogue[$key];
    }

    $fallback = $GLOBALS['translations'][config('app.fallback_locale', 'es')] ?? [];
    return (string) ($fallback[$key] ?? $key);
}
