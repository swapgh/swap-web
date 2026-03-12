<?php
/** @var string $assetBase */
/** @var array $site */

$pageLang = $pageLang ?? 'es';
$pageTitle = $pageTitle ?? $site['name'];
$pageDescription = $pageDescription ?? 'Swap RPG portfolio/promo page: ECS architecture, roadmap, and media.';
$extraCss = $extraCss ?? [];
?>
<!DOCTYPE html>
<html lang="<?= e((string)$pageLang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e((string)$pageTitle) ?></title>
  <meta name="description" content="<?= e((string)$pageDescription) ?>">

  <link rel="icon" type="image/png" sizes="32x32" href="<?= e($assetBase) ?>img/favicon.png">
  <link rel="icon" type="image/x-icon" href="<?= e($assetBase) ?>img/favicon.ico">

  <link rel="stylesheet" href="<?= e($assetBase) ?>css/style.css">
  <?php foreach ($extraCss as $href): ?>
    <?php $finalHref = is_external_href((string)$href) ? (string)$href : $assetBase . ltrim((string)$href, '/'); ?>
    <link rel="stylesheet" href="<?= e($finalHref) ?>">
  <?php endforeach; ?>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

