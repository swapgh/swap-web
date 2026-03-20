<?php
$pageTitle = $home['title'];
$pageDescription = $home['description'];
$extraCss = [
    'https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap',
    'css/05-pages/home.css',
];
$extraScripts = ['js/home.js'];
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
?>
<main class="portfolio-page">
  <section class="hero-panel">
    <div class="hero-shell">
      <div class="hero-carousel-wrap reveal-item">
        <section class="showcase-carousel" aria-label="<?= e($home['carousel']['aria_label']) ?>">
          <div class="showcase-viewport">
            <div class="showcase-track" data-carousel-track>
                <?php foreach ($home['carousel']['slides'] as $slide): ?>
                  <figure class="showcase-slide" data-carousel-slide>
                    <div class="showcase-slide-inner">
                      <img src="<?= e(asset_url($slide['image'])) ?>" alt="<?= e($slide['alt']) ?>">
                      <figcaption>
                        <div class="carousel-actions">
                          <?php foreach ($home['carousel']['actions'] as $action): ?>
                            <?php $actionHref = $action['external'] ? $action['href'] : with_lang(page_url($action['href'])); ?>
                            <a class="carousel-link" href="<?= e($actionHref) ?>"<?= $action['external'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>
                              <?php if (!empty($action['icon'])): ?>
                                <i class="<?= e($action['icon']) ?>" aria-hidden="true"></i>
                              <?php endif; ?>
                              <span><?= e($action['label']) ?></span>
                            </a>
                          <?php endforeach; ?>
                        </div>
                      </figcaption>
                    </div>
                  </figure>
              <?php endforeach; ?>
            </div>
          </div>
          <button type="button" class="showcase-btn showcase-btn-left" data-carousel-prev aria-label="<?= e(t('carousel.previous')) ?>">
            <i class="fas fa-chevron-left"></i>
          </button>
          <button type="button" class="showcase-btn showcase-btn-right" data-carousel-next aria-label="<?= e(t('carousel.next')) ?>">
            <i class="fas fa-chevron-right"></i>
          </button>
          <div class="showcase-dots" data-carousel-dots></div>
        </section>
      </div>
    </div>
  </section>

  <section class="games-section" id="featured-games">
    <div class="container">
      <div class="section-heading section-heading-compact reveal-item">
        <h2><?= e($home['games']['title']) ?></h2>
      </div>

      <div class="filter-bar reveal-item" aria-label="<?= e($home['games']['filters_label']) ?>" data-filter-group>
        <?php foreach ($home['games']['filters'] as $index => $filter): ?>
          <button type="button" class="filter-chip<?= $index === 0 ? ' active' : '' ?>" data-filter="<?= e($filter['key']) ?>"><?= e($filter['label']) ?></button>
        <?php endforeach; ?>
      </div>

      <div class="games-grid">
        <?php foreach ($home['games']['cards'] as $card): ?>
          <?php $href = $card['external'] ? $card['href'] : with_lang(page_url($card['href'])); ?>
          <article class="game-card reveal-item" data-filter-item data-tag="<?= e(implode(' ', $card['platform_tags'])) ?>">
            <div class="game-card-media" style="background-image: linear-gradient(180deg, rgba(8, 11, 18, 0.08), rgba(8, 11, 18, 0.82)), url('<?= e(asset_url($card['image'])) ?>');">
              <span class="game-card-focus"><?= e($card['focus']) ?></span>
            </div>
            <div class="game-card-body">
              <div class="game-card-topline">
                <h3><?= e($card['name']) ?></h3>
                <span class="featured-platform"><?= e($card['platform_label']) ?></span>
              </div>
              <p class="game-card-summary"><?= e($card['summary']) ?></p>
              <a class="text-link" href="<?= e($href) ?>"<?= $card['external'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>
                <?php if (!empty($card['icon'])): ?>
                  <i class="<?= e($card['icon']) ?>" aria-hidden="true"></i>
                <?php endif; ?>
                <span><?= e($card['cta']) ?></span>
              </a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="hero-banner">
    <div class="container">
      <div class="hero-copy reveal-item" style="background-image: linear-gradient(180deg, rgba(8, 12, 20, 0.42), rgba(8, 12, 20, 0.76)), url('<?= e(asset_url($home['hero']['background_image'])) ?>');">
        <span class="section-eyebrow"><?= e($home['hero']['eyebrow']) ?></span>
        <h1><?= e($home['hero']['title']) ?></h1>
        <p class="hero-subtitle"><?= e($home['hero']['subtitle']) ?></p>
        <p class="hero-description"><?= e($home['hero']['description']) ?></p>

        <div class="hero-chip-row">
          <?php foreach ($home['hero']['chips'] as $chip): ?>
            <span class="hero-chip"><?= e($chip) ?></span>
          <?php endforeach; ?>
        </div>

        <div class="hero-actions hero-actions-left">
          <?php foreach ($home['hero']['actions'] as $index => $action): ?>
            <?php $actionHref = $action['external'] ? $action['href'] : with_lang(page_url($action['href'])); ?>
            <a class="btn btn-<?= e($action['variant']) ?><?= $index > 1 ? ' hero-action-optional' : '' ?>" href="<?= e($actionHref) ?>"<?= $action['external'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>
              <?php if (!empty($action['icon'])): ?>
                <i class="<?= e($action['icon']) ?>" aria-hidden="true"></i>
              <?php endif; ?>
              <span><?= e($action['label']) ?></span>
            </a>
          <?php endforeach; ?>
        </div>

        <div class="hero-stats">
          <?php foreach ($home['hero']['stats'] as $stat): ?>
            <article class="stat-card">
              <strong><?= e($stat['value']) ?></strong>
              <span><?= e($stat['label']) ?></span>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="intro-feature">
    <div class="container">
      <div class="intro-feature-card reveal-item">
        <div class="intro-copy">
          <span class="section-eyebrow"><?= e($home['intro_feature']['eyebrow']) ?></span>
          <h2><?= e($home['intro_feature']['title']) ?></h2>
          <p><?= e($home['intro_feature']['description']) ?></p>
          <div class="hero-actions hero-actions-left">
            <a class="btn btn-primary" href="<?= e(with_lang(page_url('projects/swap-rpg'))) ?>">
              <i class="fas fa-arrow-right"></i><span><?= e($home['intro_feature']['primary_cta']) ?></span>
            </a>
            <a class="btn btn-secondary" href="<?= e(with_lang(page_url('contact'))) ?>">
              <i class="fas fa-envelope"></i><span><?= e($home['intro_feature']['secondary_cta']) ?></span>
            </a>
          </div>
        </div>

        <aside class="intro-side">
          <ul class="intro-points">
            <?php foreach ($home['intro_feature']['points'] as $point): ?>
              <li><?= e($point) ?></li>
            <?php endforeach; ?>
          </ul>
        </aside>
      </div>
    </div>
  </section>
</main>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
