<?php
declare(strict_types=1);

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $path = __DIR__ . '/../' . str_replace('\\', '/', $relative) . '.php';
    if (is_file($path)) {
        require_once $path;
    }
});

$config = [
    'app' => require __DIR__ . '/../../config/app.php',
    'database' => require __DIR__ . '/../../config/database.php',
];

function config(string $key, mixed $default = null): mixed
{
    $segments = explode('.', $key);
    $value = $GLOBALS['config'] ?? [];
    foreach ($segments as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }
        $value = $value[$segment];
    }

    return $value;
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function is_external_href(string $href): bool
{
    return (bool) preg_match('#^https?://#i', $href);
}

function page_base_path(): string
{
    $scriptName = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? '/'));
    $dir = str_replace('\\', '/', (string) dirname($scriptName));
    $dir = rtrim($dir, '/');

    if ($dir === '' || $dir === '.') {
        return '';
    }

    return $dir === '/' ? '' : $dir;
}

function asset_url(string $path = ''): string
{
    return '/assets/' . ltrim($path, '/');
}


function uses_front_controller_links(): bool
{
    $requestPath = parse_url((string) ($_SERVER['REQUEST_URI'] ?? ''), PHP_URL_PATH) ?: '';
    return basename($requestPath) === 'index.php';
}



function page_url(string $path = ''): string
{
    $normalizedPath = ltrim($path, '/');
    $scriptName = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php'));

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

function current_scheme(): string
{
    $https = $_SERVER['HTTPS'] ?? '';
    $forwarded = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '';
    if ($https === 'on' || $https === '1' || $forwarded === 'https') {
        return 'https';
    }

    return 'http';
}

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

function absolute_url(string $path = ''): string
{
    if (is_external_href($path)) {
        return $path;
    }

    return rtrim(site_base_url(), '/') . '/' . ltrim($path, '/');
}

function resolve_page_lang(?string $candidate, string $fallback = 'es'): string
{
    $supported = ['es', 'en'];
    if ($candidate !== null && in_array($candidate, $supported, true)) {
        return $candidate;
    }

    return $fallback;
}

function with_lang(string $url, ?string $lang = null): string
{
    if (is_external_href($url)) {
        return $url;
    }

    $lang = resolve_page_lang($lang ?? ($GLOBALS['pageLang'] ?? config('app.locale', 'es')), config('app.fallback_locale', 'es'));
    $fragment = '';
    $hashPos = strpos($url, '#');
    if ($hashPos !== false) {
        $fragment = substr($url, $hashPos);
        $url = substr($url, 0, $hashPos);
    }

    $path = $url;
    $query = [];
    $queryPos = strpos($url, '?');
    if ($queryPos !== false) {
        $path = substr($url, 0, $queryPos);
        parse_str(substr($url, $queryPos + 1), $query);
    }

    $query['lang'] = $lang;
    $queryString = http_build_query($query);

    return $path . ($queryString !== '' ? '?' . $queryString : '') . $fragment;
}

$site = [
    'name' => (string) config('app.name'),
    'tagline' => (string) config('app.tagline'),
    'github_rpg' => (string) config('app.github_rpg'),
    'github_web' => (string) config('app.github_web'),
    'contact_email' => (string) config('app.contact_email'),
    'default_og_image' => asset_url(config('app.default_og_image')),
];

$pageLang = resolve_page_lang((string) ($_GET['lang'] ?? $_COOKIE['swap_lang'] ?? config('app.locale', 'es')), config('app.fallback_locale', 'es'));
if (isset($_GET['lang']) && $_GET['lang'] === $pageLang && !headers_sent()) {
    setcookie('swap_lang', $pageLang, [
        'expires' => time() + (86400 * 30),
        'path' => '/',
        'samesite' => 'Lax',
    ]);
}

require_once __DIR__ . '/i18n.php';

