<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/Support/bootstrap.php';

use App\Support\PageCatalog;

header('Content-Type: application/xml; charset=UTF-8');

function url(string $path): string
{
    return absolute_url($path);
}

$urls = [[
    'loc' => url(''),
    'lastmod' => is_file(__DIR__ . '/../app/Content/Pages/home.php') ? date('c', filemtime(__DIR__ . '/../app/Content/Pages/home.php')) : null,
]];

foreach (PageCatalog::sitemapEntries() as $page) {
    $urls[] = [
        'loc' => url((string) $page['path']),
        'lastmod' => is_file(__DIR__ . '/../app/Content/Pages/public-pages.php') ? date('c', filemtime(__DIR__ . '/../app/Content/Pages/public-pages.php')) : null,
    ];
}

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $url): ?>
  <url>
    <loc><?= e($url['loc']) ?></loc>
    <?php if ($url['lastmod']): ?>
    <lastmod><?= e($url['lastmod']) ?></lastmod>
    <?php endif; ?>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
<?php endforeach; ?>
</urlset>
