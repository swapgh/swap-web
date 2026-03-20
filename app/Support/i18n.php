<?php
declare(strict_types=1);

///////////////////////////////////////////////
// 1. Load translations for supported languages
///////////////////////////////////////////////

$translations = [
    'es' => require __DIR__ . '/../../lang/es.php', // Spanish translations
    'en' => require __DIR__ . '/../../lang/en.php', // English translations
];

///////////////////////////////////////////////
// 2. Translation helper function
///////////////////////////////////////////////

/**
 * Translate a key into the current page language.
 *
 * @param string $key Translation key, e.g. 'nav.home'
 * @return string Translated string, or key if not found
 */
function t(string $key): string
{
    // Determine current language, defaulting to app locale
    $lang = $GLOBALS['pageLang'] ?? config('app.locale', 'es');

    // Load the translation catalogue for the current language
    $catalogue = $GLOBALS['translations'][$lang] ?? [];

    // Return translated value if it exists
    if (array_key_exists($key, $catalogue)) {
        return (string) $catalogue[$key];
    }

    // Fallback: try the fallback locale
    $fallback = $GLOBALS['translations'][config('app.fallback_locale', 'es')] ?? [];
    return (string) ($fallback[$key] ?? $key); // If all else fails, return the key itself
}