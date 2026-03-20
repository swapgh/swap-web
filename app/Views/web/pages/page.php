<?php
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$extraCss = [
    'https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap',
    'css/pages/site.css',
];
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
?>
<section class="section section-page" aria-labelledby="page-title">
  <div class="container">
    <article class="page-card">
      <span class="page-eyebrow"><?= e($page['eyebrow']) ?></span>
      <h1 id="page-title"><?= e($page['heading']) ?></h1>
      <p class="page-lead"><?= e($page['lead']) ?></p>

      <ul class="page-highlights">
        <?php foreach ($page['highlights'] as $highlight): ?>
          <li><?= e($highlight) ?></li>
        <?php endforeach; ?>
      </ul>

      <div class="page-grid">
        <?php foreach ($page['sections'] as $section): ?>
          <section class="page-panel">
            <h2><?= e($section['title']) ?></h2>
            <p><?= e($section['body']) ?></p>
          </section>
        <?php endforeach; ?>
      </div>

      <div class="hero-actions page-actions">
        <?php foreach ($page['actions'] as $action): ?>
          <a class="btn btn-<?= e($action['variant']) ?>" href="<?= e($action['href']) ?>"<?= $action['external'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>
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
