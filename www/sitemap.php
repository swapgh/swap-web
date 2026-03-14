<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/Support/bootstrap.php';

header('Content-Type: application/xml; charset=UTF-8');

$pages = [
    absolute_url(''),
    absolute_url('login'),
    absolute_url('profile'),
    absolute_url('characters'),
    absolute_url('devlog/hito1'),
    absolute_url('devlog/hito2'),
    absolute_url('devlog/hito3'),
    absolute_url('devlog/hito4'),
    absolute_url('devlog/hito5'),
    absolute_url('devlog/hito6'),
];

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as $url): ?>
  <url><loc><?= e($url) ?></loc></url>
<?php endforeach; ?>
</urlset>
