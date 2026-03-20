<?php
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$pageSlug = (string) ($pageSlug ?? '');
$isLegalPage = in_array($pageSlug, ['legal-notice', 'privacy', 'cookies', 'payment-disclaimer', 'support-terms'], true);
$currentRequestUri = (string) ($_SERVER['REQUEST_URI'] ?? '');
$normalizeInternalTarget = static function (string $href): string {
    $path = (string) parse_url($href, PHP_URL_PATH);
    $query = (string) parse_url($href, PHP_URL_QUERY);

    parse_str($query, $params);
    $route = isset($params['route']) ? rawurldecode((string) $params['route']) : '';

    if ($route !== '') {
        return 'route:' . rtrim($route, '/');
    }

    return 'path:' . rtrim($path, '/');
};
$currentInternalTarget = $normalizeInternalTarget($currentRequestUri);
$extraCss = [
    'https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap',
    'css/pages/site.css',
];
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
?>
<section class="section section-page<?= $isLegalPage ? ' section-page-legal' : '' ?>" aria-labelledby="page-title">
  <div class="container">
    <article class="page-card<?= $isLegalPage ? ' page-card-legal' : '' ?>">
      <div class="page-hero">
        <div class="page-hero-copy">
          <span class="page-eyebrow"><?= e($page['eyebrow']) ?></span>
          <h1 id="page-title"><?= e($page['heading']) ?></h1>
          <p class="page-lead"><?= e($page['lead']) ?></p>
        </div>
      </div>

      <ul class="page-highlights<?= $isLegalPage ? ' page-highlights-legal' : '' ?>">
        <?php foreach ($page['highlights'] as $highlight): ?>
          <li><?= e($highlight) ?></li>
        <?php endforeach; ?>
      </ul>

      <div class="page-grid<?= $isLegalPage ? ' page-grid-legal' : '' ?>">
        <?php foreach ($page['sections'] as $section): ?>
          <section class="page-panel<?= $isLegalPage ? ' page-panel-legal' : '' ?>">
            <h2><?= e($section['title']) ?></h2>
            <p><?= e($section['body']) ?></p>
          </section>
        <?php endforeach; ?>
      </div>

      <div class="hero-actions page-actions<?= $isLegalPage ? ' page-actions-legal' : '' ?>">
        <?php foreach ($page['actions'] as $action): ?>
          <?php
          $actionHref = (string) $action['href'];
          $isCurrentLegalAction = $isLegalPage
              && !$action['external']
              && $normalizeInternalTarget($actionHref) === $currentInternalTarget;
          $actionClasses = 'btn btn-' . e($action['variant'])
              . (!empty($action['align']) ? ' is-' . e((string) $action['align']) : '')
              . ($isCurrentLegalAction ? ' is-current' : '');
          ?>
          <a class="<?= $actionClasses ?>" href="<?= e($action['href']) ?>"<?= $action['external'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>
            <?php if (!empty($action['icon'])): ?>
              <i class="<?= e($action['icon']) ?>" aria-hidden="true"></i>
            <?php endif; ?>
            <span><?= e($action['label']) ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </article>
  </div>
</section>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
