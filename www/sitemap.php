<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/Support/bootstrap.php';

header('Content-Type: application/xml; charset=UTF-8');

function url(string $path): string
{
    return absolute_url($path);
}

$pageEntries = [
    ['path' => '', 'source' => __DIR__ . '/../app/Views/web/pages/home.php'],
    ['path' => 'projects/swap-rpg', 'source' => __DIR__ . '/../app/Content/Web/site-pages.php'],
    ['path' => 'contact', 'source' => __DIR__ . '/../app/Content/Web/site-pages.php'],
    ['path' => 'help', 'source' => __DIR__ . '/../app/Content/Web/site-pages.php'],
    ['path' => 'privacy', 'source' => __DIR__ . '/../app/Content/Web/site-pages.php'],
    ['path' => 'cookies', 'source' => __DIR__ . '/../app/Content/Web/site-pages.php'],
    ['path' => 'games/class-select', 'source' => __DIR__ . '/../app/Content/Web/site-pages.php'],
    ['path' => 'games/combat-slice', 'source' => __DIR__ . '/../app/Content/Web/site-pages.php'],
    ['path' => 'games/dark-biome', 'source' => __DIR__ . '/../app/Content/Web/site-pages.php'],
    ['path' => 'games/rogue-build', 'source' => __DIR__ . '/../app/Content/Web/site-pages.php'],
    ['path' => 'games/liminal-zone', 'source' => __DIR__ . '/../app/Content/Web/site-pages.php'],
];

$urls = array_map(static function (array $entry): array {
    $source = $entry['source'];

    return [
        'loc' => url($entry['path']),
        'lastmod' => is_file($source) ? date('c', filemtime($source)) : null,
    ];
}, $pageEntries);

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
