<?php
// ----------------------------
// Default page meta values
// ----------------------------

// Page title, defaulting to the site name if not set
$pageTitle = $pageTitle ?? $site['name'];

// Page description, using a translation fallback if not set
$pageDescription = $pageDescription ?? t('meta.default_description');

// Additional CSS files to include
$extraCss = $extraCss ?? [];

// Robots meta behavior, overridable per page
$robotsContent = $robotsContent ?? 'index,follow';

// Canonical URL for SEO, defaulting to current path
$canonicalUrl = $canonicalUrl ?? absolute_url(
    ltrim((string) parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH), '/')
);

// Open Graph (OG) meta type
$ogType = $ogType ?? 'website';

// OG image for social sharing, defaulting to site's default image
$ogImage = $ogImage ?? absolute_url($site['default_og_image']);
?>
<!DOCTYPE html>
<html lang="<?= e((string) $pageLang) ?>">
<head>
  <!-- Character encoding -->
  <meta charset="UTF-8">

  <!-- Responsive viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Page title -->
  <title><?= e((string) $pageTitle) ?></title>

  <!-- SEO description -->
  <meta name="description" content="<?= e((string) $pageDescription) ?>">

  <!-- Search engine robots -->
  <meta name="robots" content="<?= e((string) $robotsContent) ?>">

  <!-- Browser theme color -->
  <meta name="theme-color" content="#0a1220">

  <!-- Canonical URL for SEO -->
  <link rel="canonical" href="<?= e((string) $canonicalUrl) ?>">

  <!-- Open Graph meta tags for social sharing -->
  <meta property="og:site_name" content="<?= e((string) $site['name']) ?>">
  <meta property="og:locale" content="<?= e($pageLang === 'en' ? 'en_US' : 'es_ES') ?>">
  <meta property="og:type" content="<?= e((string) $ogType) ?>">
  <meta property="og:title" content="<?= e((string) $pageTitle) ?>">
  <meta property="og:description" content="<?= e((string) $pageDescription) ?>">
  <meta property="og:url" content="<?= e((string) $canonicalUrl) ?>">
  <meta property="og:image" content="<?= e((string) $ogImage) ?>">

  <!-- Twitter card meta tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e((string) $pageTitle) ?>">
  <meta name="twitter:description" content="<?= e((string) $pageDescription) ?>">
  <meta name="twitter:image" content="<?= e((string) $ogImage) ?>">

  <!-- Favicon links -->
  <link rel="icon" type="image/png" sizes="32x32" href="<?= e(asset_url('images/favicons/favicon.png')) ?>">
  <link rel="icon" type="image/x-icon" href="<?= e(asset_url('images/favicons/favicon.ico')) ?>">

  <!-- Main CSS file -->
  <link rel="stylesheet" href="<?= e(asset_url('css/system/base.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset_url('css/system/components.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset_url('css/system/layout.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset_url('css/system/chrome.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset_url('css/system/pages.css')) ?>">

  <!-- Extra CSS files (can be local or external) -->
  <?php foreach ($extraCss as $href): ?>
    <?php
    // If the CSS file is external, use as-is; otherwise prepend assets URL
    $finalHref = is_external_href((string) $href) ? (string) $href : asset_url((string) $href);
    ?>
    <link rel="stylesheet" href="<?= e($finalHref) ?>">
  <?php endforeach; ?>

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
