<?php
$pageTitle = $pageTitle ?? $site['name'];
$pageDescription = $pageDescription ?? t('meta.default_description');
$extraCss = $extraCss ?? [];
$robotsContent = $robotsContent ?? 'index,follow';
$canonicalUrl = $canonicalUrl ?? absolute_url(
    ltrim((string) parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH), '/')
);
$ogType = $ogType ?? 'website';
$ogImage = $ogImage ?? absolute_url($site['default_og_image']);
?>
<!DOCTYPE html>
<html lang="<?= e((string) $pageLang) ?>" data-theme="classic">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e((string) $pageTitle) ?></title>
  <meta name="description" content="<?= e((string) $pageDescription) ?>">
  <meta name="robots" content="<?= e((string) $robotsContent) ?>">
  <meta name="theme-color" content="#0a1220">
  <script>
    (() => {
      const allowedThemes = ["classic", "moon", "mist", "forest", "light"];
      const storedTheme = window.localStorage.getItem("swap-theme");
      const theme = allowedThemes.includes(storedTheme) ? storedTheme : "classic";
      const themeColors = {
        moon: "#0b0d10",
        classic: "#0a1220",
        mist: "#0b1118",
        forest: "#0c1412",
        light: "#f2f5f8"
      };

      document.documentElement.dataset.theme = theme;
      document.documentElement.style.colorScheme = theme === "light" ? "light" : "dark";

      const themeMeta = document.querySelector('meta[name="theme-color"]');
      if (themeMeta) {
        themeMeta.setAttribute("content", themeColors[theme] || themeColors.classic);
      }
    })();
  </script>
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
  <script>
    window.Swap = window.Swap || {};
    window.Swap.analytics = {
      tagId: <?= json_encode((string) config('app.analytics.google_tag_id', '')) ?>,
      consentVersion: <?= json_encode((string) config('app.analytics.consent_version', '')) ?>
    };
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap">
  <link rel="stylesheet" href="<?= e(asset_url('css/app.css')) ?>">
  <?php foreach ($extraCss as $href): ?>
    <?php $finalHref = is_external_href((string) $href) ? (string) $href : asset_url((string) $href); ?>
    <link rel="stylesheet" href="<?= e($finalHref) ?>">
  <?php endforeach; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
