<?php
use App\Core\View;

$contentView = (string) ($contentView ?? '');
$contentPath = View::path($contentView);

if ($contentView === '' || !is_file($contentPath)) {
    throw new RuntimeException('Content view not found: ' . $contentView);
}

ob_start();
require $contentPath;
$contentHtml = (string) ob_get_clean();

require __DIR__ . '/../partials/head.php';
require __DIR__ . '/../partials/site-header.php';
echo $contentHtml;
require __DIR__ . '/../partials/site-footer.php';
require __DIR__ . '/../partials/scripts.php';
