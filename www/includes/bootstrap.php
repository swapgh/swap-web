<?php
declare(strict_types=1);

/**
 * Shared bootstrap for all pages under `www/`.
 * - Computes `$assetBase` so pages in subfolders can reference `/css`, `/js`, `/img` reliably.
 * - Provides tiny helpers for escaping + building URLs.
 */

function swap_asset_base(): string
{
    $scriptName = (string)($_SERVER['SCRIPT_NAME'] ?? '/');
    $dir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
    if ($dir === '' || $dir === '.') {
        return '';
    }

    $trimmed = trim($dir, '/');
    if ($trimmed === '') {
        return '';
    }

    $depth = substr_count($trimmed, '/') + 1;
    return str_repeat('../', $depth);
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function is_external_href(string $href): bool
{
    return (bool)preg_match('#^https?://#i', $href);
}

$assetBase = swap_asset_base();
$site = [
    'name' => 'Swap RPG',
    'tagline' => 'ECS-based 2D RPG prototype',
    'github_rpg' => 'https://github.com/swapgh/swap-rpg',
    'github_web' => 'https://github.com/swapgh/swap-web',
    'contact_email' => 'swap@swap.com.es',
];

