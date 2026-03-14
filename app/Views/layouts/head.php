<?php
$pageTitle = $pageTitle ?? $site['name'];
$pageDescription = $pageDescription ?? t('meta.default_description');
$extraCss = $extraCss ?? [];
$canonicalUrl = $canonicalUrl ?? absolute_url(ltrim((string) parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH), '/'));
$ogType = $ogType ?? 'website';
$ogImage = $ogImage ?? absolute_url($site['default_og_image']);
?>
<!DOCTYPE html>
<html lang="<?= e((string) $pageLang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e((string) $pageTitle) ?></title>
  <meta name="description" content="<?= e((string) $pageDescription) ?>">
  <meta name="robots" content="index,follow">
  <link rel="canonical" href="<?= e((string) $canonicalUrl) ?>">

  <meta property="og:site_name" content="<?= e((string) $site['name']) ?>">
  <meta property="og:locale" content="<?= e($pageLang === 'en' ? 'en_US' : 'es_ES') ?>">
  <meta property="og:type" content="<?= e((string) $ogType) ?>">
  <meta property="og:title" content="<?= e((string) $pageTitle) ?>">
  <meta property="og:description" content="<?= e((string) $pageDescription) ?>">
  <meta property="og:url" content="<?= e((string) $canonicalUrl) ?>">
  <meta property="og:image" content="<?= e((string) $ogImage) ?>">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e((string) $pageTitle) ?>">
  <meta name="twitter:description" content="<?= e((string) $pageDescription) ?>">
  <meta name="twitter:image" content="<?= e((string) $ogImage) ?>">

  <link rel="icon" type="image/png" sizes="32x32" href="<?= e(asset_url('images/favicons/favicon.png')) ?>">
  <link rel="icon" type="image/x-icon" href="<?= e(asset_url('images/favicons/favicon.ico')) ?>">
  <link rel="stylesheet" href="<?= e(asset_url('css/main.css')) ?>">
  <?php foreach ($extraCss as $href): ?>
    <?php $finalHref = is_external_href((string) $href) ? (string) $href : asset_url((string) $href); ?>
    <link rel="stylesheet" href="<?= e($finalHref) ?>">
  <?php endforeach; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
