<?php
declare(strict_types=1);

namespace App\Support;

final class PageCatalog
{
    public static function all(): array
    {
        /** @var array<int, array<string, mixed>> $pages */
        $pages = require dirname(__DIR__, 2) . '/config/pages.php';

        return $pages;
    }

    public static function findBySlug(string $slug): ?array
    {
        foreach (self::all() as $page) {
            if (($page['slug'] ?? '') === $slug) {
                return $page;
            }
        }

        return null;
    }

    public static function sitemapEntries(): array
    {
        return array_values(array_filter(
            self::all(),
            static fn (array $page): bool => (bool) ($page['sitemap'] ?? false)
        ));
    }
}
