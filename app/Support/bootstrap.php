<?php
declare(strict_types=1);

///////////////////////////////////////////////
// 1. Autoloader
///////////////////////////////////////////////

/**
 * PSR-4 style autoloader for the App namespace.
 * Automatically includes PHP class files based on namespace and class name.
 */
spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';

    // Only handle classes in the App namespace
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    // Convert namespace to file path
    $relative = substr($class, strlen($prefix));
    $path = __DIR__ . '/../' . str_replace('\\', '/', $relative) . '.php';

    if (is_file($path)) {
        require_once $path;
    }
});

///////////////////////////////////////////////
// 2. Config
///////////////////////////////////////////////

$config = [
    'app' => require __DIR__ . '/../../config/app.php',
    'database' => require __DIR__ . '/../../config/database.php',
];

/**
 * Retrieve nested configuration value using dot notation.
 *
 * @param string $key Example: 'app.name'
 * @param mixed $default Value to return if key doesn't exist
 * @return mixed
 */
function config(string $key, mixed $default = null): mixed
{
    $segments = explode('.', $key);
    $value    = $GLOBALS['config'] ?? [];

    foreach ($segments as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }
        $value = $value[$segment];
    }

    return $value;
}

///////////////////////////////////////////////
// 3. Utility functions
///////////////////////////////////////////////

/**
 * Escape string for safe HTML output.
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Check if a URL is external (starts with http:// or https://)
 */
function is_external_href(string $href): bool
{
    return (bool) preg_match('#^https?://#i', $href);
}

/**
 * Format a minor-unit money amount such as cents.
 */
function format_money_from_cents(int|string $amountCents, string $currency = 'EUR'): string
{
    $amount = ((int) $amountCents) / 100;
    $currency = strtoupper(trim($currency));

    if (class_exists(\NumberFormatter::class)) {
        $formatter = new \NumberFormatter(
            ($GLOBALS['pageLang'] ?? config('app.locale', 'en')) === 'es' ? 'es_ES' : 'en_US',
            \NumberFormatter::CURRENCY
        );

        $formatted = $formatter->formatCurrency($amount, $currency);
        if (is_string($formatted)) {
            return $formatted;
        }
    }

    return number_format($amount, 2, '.', ',') . ' ' . $currency;
}

/**
 * Normalize billing status for labels and CSS hooks.
 */
function billing_status_meta(?string $status): array
{
    return match (strtolower(trim((string) $status))) {
        'paid' => ['label' => 'Paid', 'class' => 'is-paid'],
        'failed' => ['label' => 'Failed', 'class' => 'is-failed'],
        'expired' => ['label' => 'Expired', 'class' => 'is-expired'],
        default => ['label' => 'Pending', 'class' => 'is-pending'],
    };
}

/**
 * Format an ISO or strtotime-compatible datetime for UI display.
 */
function format_datetime_ui(?string $value): string
{
    $value = trim((string) $value);
    if ($value === '') {
        return 'Unknown date';
    }

    $timestamp = strtotime($value);
    if ($timestamp === false) {
        return $value;
    }

    $locale = (($GLOBALS['pageLang'] ?? config('app.locale', 'en')) === 'es') ? 'es_ES' : 'en_US';

    if (class_exists(\IntlDateFormatter::class)) {
        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::MEDIUM,
            \IntlDateFormatter::SHORT,
            date_default_timezone_get() ?: 'UTC'
        );

        $formatted = $formatter->format($timestamp);
        if (is_string($formatted)) {
            return $formatted;
        }
    }

    return date('Y-m-d H:i', $timestamp);
}

/**
 * Localized account/game dictionary loaded from content.
 */
function game_dictionary(): array
{
    static $cache = null;
    if ($cache === null) {
        $cache = require __DIR__ . '/../Content/Game/account-rpg.php';
    }

    $lang = ($GLOBALS['pageLang'] ?? config('app.locale', 'en')) === 'es' ? 'es' : 'en';
    return is_array($cache[$lang] ?? null) ? $cache[$lang] : ($cache['en'] ?? []);
}

/**
 * Resolve a localized game label by section/key.
 */
function game_label(string $section, string $key, ?string $fallback = null): string
{
    $dictionary = game_dictionary();
    $items = is_array($dictionary[$section] ?? null) ? $dictionary[$section] : [];
    $value = $items[$key] ?? null;
    if (is_string($value) && $value !== '') {
        return $value;
    }

    if ($fallback !== null && $fallback !== '') {
        return $fallback;
    }

    return ucwords(str_replace(['_', '-'], ' ', $key));
}

///////////////////////////////////////////////
// 4. URL Helpers
///////////////////////////////////////////////

/**
 * Get the base path of the application (useful for local dev with PHP server)
 */
function page_base_path(): string
{
    $scriptName = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? '/'));
    $dir        = rtrim(str_replace('\\', '/', (string) dirname($scriptName)), '/');

    if ($dir === '' || $dir === '.') {
        return '';
    }

    return $dir === '/' ? '' : $dir;
}

/**
 * Return a URL to an asset in the /assets/ directory
 */
function asset_url(string $path = ''): string
{
    $base = page_base_path();
    return $base . '/assets/' . ltrim($path, '/');
}

/**
 * Determines if we are using "index.php?route=..." style links
 */
function uses_front_controller_links(): bool
{
    $requestPath = parse_url((string) ($_SERVER['REQUEST_URI'] ?? ''), PHP_URL_PATH) ?: '';
    return basename($requestPath) === 'index.php';
}

/**
 * Generate URL to a page, optionally using front controller routing
 */
function page_url(string $path = ''): string
{
    $normalizedPath = ltrim($path, '/');
    $scriptName     = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php'));

    if (uses_front_controller_links()) {
        if ($normalizedPath === '') {
            return $scriptName;
        }
        if (str_starts_with($normalizedPath, '#')) {
            return $scriptName . $normalizedPath;
        }
        return $scriptName . '?route=' . rawurlencode('/' . $normalizedPath);
    }

    $base = page_base_path();
    return $base . '/' . $normalizedPath;
}

/**
 * Return current scheme (http or https)
 */
function current_scheme(): string
{
    $https     = $_SERVER['HTTPS'] ?? '';
    $forwarded = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '';
    if ($https === 'on' || $https === '1' || $forwarded === 'https') {
        return 'https';
    }
    return 'http';
}

/**
 * Return the full site base URL
 */
function site_base_url(): string
{
    $configured = trim((string) ($_ENV['SITE_URL'] ?? $_SERVER['SITE_URL'] ?? ''));
    if ($configured !== '') {
        return rtrim($configured, '/');
    }

    $host = (string) ($_SERVER['HTTP_HOST'] ?? 'localhost');
    $base = page_base_path();
    return current_scheme() . '://' . $host . $base;
}

/**
 * Convert a path to an absolute URL (prepends site_base_url)
 */
function absolute_url(string $path = ''): string
{
    if (is_external_href($path)) {
        return $path;
    }

    return rtrim(site_base_url(), '/') . '/' . ltrim($path, '/');
}

///////////////////////////////////////////////
// 5. Language Helpers
///////////////////////////////////////////////

/**
 * Determine a valid page language from candidate, defaulting to fallback
 */
function resolve_page_lang(?string $candidate, string $fallback = 'es'): string
{
    $supported = ['es', 'en'];
    if ($candidate !== null && in_array($candidate, $supported, true)) {
        return $candidate;
    }
    return $fallback;
}

/**
 * Add lang query parameter to a URL
 */
function with_lang(string $url, ?string $lang = null): string
{
    if (is_external_href($url)) {
        return $url;
    }

    $lang     = resolve_page_lang($lang ?? ($GLOBALS['pageLang'] ?? config('app.locale', 'es')), config('app.fallback_locale', 'es'));
    $fragment = '';

    // Separate fragment/hash
    $hashPos  = strpos($url, '#');
    if ($hashPos !== false) {
        $fragment = substr($url, $hashPos);
        $url      = substr($url, 0, $hashPos);
    }

    // Separate query string
    $path     = $url;
    $query    = [];
    $queryPos = strpos($url, '?');
    if ($queryPos !== false) {
        $path = substr($url, 0, $queryPos);
        parse_str(substr($url, $queryPos + 1), $query);
    }

    $query['lang'] = $lang;
    $queryString   = http_build_query($query);

    return $path . ($queryString !== '' ? '?' . $queryString : '') . $fragment;
}

///////////////////////////////////////////////
// 6. CSRF Helpers
///////////////////////////////////////////////

/**
 * Generate or retrieve a CSRF token
 */
function csrf_token(): string
{
    $token = \App\Core\Session::get('_csrf.token');
    if (is_string($token) && $token !== '') {
        return $token;
    }

    $token = bin2hex(random_bytes(32));
    \App\Core\Session::put('_csrf.token', $token);

    return $token;
}

/**
 * Generate hidden input field for CSRF token
 */
function csrf_field(): string
{
    return '<input type="hidden" name="_token" value="' . e(csrf_token()) . '">';
}

/**
 * Verify submitted CSRF token
 */
function verify_csrf_token(mixed $token): bool
{
    $sessionToken = \App\Core\Session::get('_csrf.token');

    return is_string($token)
        && is_string($sessionToken)
        && $sessionToken !== ''
        && hash_equals($sessionToken, $token);
}

///////////////////////////////////////////////
// 7. Site & Page Language Initialization
///////////////////////////////////////////////

$site = [
    'name'             => (string) config('app.name'),
    'github_rpg'       => (string) config('app.github_rpg'),
    'github_web'       => (string) config('app.github_web'),
    'contact_email'    => (string) config('app.contact_email'),
    'default_og_image' => asset_url((string) config('app.default_og_image')),
];

// Determine current page language
$pageLang = resolve_page_lang(
    (string) ($_GET['lang'] ?? $_COOKIE['swap_lang'] ?? config('app.locale', 'es')),
    config('app.fallback_locale', 'es')
);

// Save language preference in a cookie if needed
if (isset($_GET['lang']) && $_GET['lang'] === $pageLang && !headers_sent()) {
    setcookie('swap_lang', $pageLang, [
        'expires'  => time() + (86400 * 30), // 30 days
        'path'     => '/',
        'samesite' => 'Lax',
    ]);
}

// Load i18n translations
require_once __DIR__ . '/i18n.php';
