<?php
$pageTitle = $home['title'];
$pageDescription = $home['description'];
$extraCss = ['css/home.css'];
$extraScripts = ['js/home.js'];
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
$heroBackground = $home['showcase'][0]['src'] ?? null;
$statusItem = $home['hero']['meta'][0] ?? null;
$stackItem = $home['hero']['meta'][1] ?? null;
?>
<main class="portfolio-page">
  <!-- Carousel Section -->
  <section class="carousel-section">
    <div class="hero-shell">
      <section class="showcase-carousel showcase-carousel-wide" aria-label="Swap RPG showcase">
        <div class="showcase-viewport">
          <div class="showcase-track" data-carousel-track>
            <?php foreach ($home['showcase'] as $shot): ?>
              <figure class="showcase-slide" data-carousel-slide data-platform="all">
                <div class="showcase-slide-inner">
                  <img src="<?= e(asset_url($shot['src'])) ?>" alt="<?= e($shot['alt']) ?>">
                  <figcaption><?= e($shot['caption']) ?></figcaption>
                </div>
              </figure>
            <?php endforeach; ?>
          </div>
        </div>
        <button type="button" class="showcase-btn showcase-btn-left" data-carousel-prev aria-label="<?= e(t('carousel.previous')) ?>"><i class="fas fa-chevron-left"></i></button>
        <button type="button" class="showcase-btn showcase-btn-right" data-carousel-next aria-label="<?= e(t('carousel.next')) ?>"><i class="fas fa-chevron-right"></i></button>
        <div class="showcase-dots" data-carousel-dots></div>
      </section>
    </div>
  </section>

  <!-- Featured Games Header -->
  <section class="featured-games-section">
    <div class="hero-shell">
      <div class="featured-games-header">
        <h2 class="featured-games-title">Featured Games</h2>
        <div class="platform-filters" aria-label="Filter by platform">
          <button type="button" class="platform-btn active" data-platform="all" aria-label="All platforms">All</button>
          <button type="button" class="platform-btn" data-platform="pc" aria-label="PC"><i class="fas fa-desktop"></i> PC</button>
          <button type="button" class="platform-btn" data-platform="console" aria-label="Console"><i class="fas fa-gamepad"></i> Console</button>
          <button type="button" class="platform-btn" data-platform="mobile" aria-label="Mobile"><i class="fas fa-mobile-alt"></i> Mobile</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="section-block section-muted" id="<?= e($home['gallery']['id']) ?>">
    <div class="container">
      <div class="section-heading">
        <span class="section-eyebrow"><?= e($home['gallery']['eyebrow']) ?></span>
        <h2><?= e($home['gallery']['title']) ?></h2>
        <p><?= e($home['gallery']['description']) ?></p>
      </div>
      <div class="media-grid">
        <?php foreach ($home['gallery']['items'] as $item): ?>
          <figure class="media-card gallery-item reveal-item">
            <img src="<?= e(asset_url($item['src'])) ?>" alt="<?= e($item['alt']) ?>">
            <figcaption><?= e($item['caption']) ?></figcaption>
          </figure>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Hero Section -->
  <section class="hero-panel">
    <div class="hero-shell">
      <section
        class="hero-stage"
        <?= $heroBackground !== null ? 'style="background-image: url(\'' . e(asset_url($heroBackground)) . '\');"' : '' ?>
      >
        <div class="hero-content">
          <div class="hero-copy">
            <h1><?= e($home['hero']['title']) ?></h1>
            <p class="hero-intro"><?= e($home['hero']['description']) ?></p>
          </div>

          <div class="hero-actions hero-actions-centered">
            <a class="btn btn-primary" href="<?= e($site['github_rpg']) ?>" target="_blank" rel="noopener noreferrer">
              <i class="fab fa-github"></i>
              <?= e($home['hero']['primary_cta']) ?>
            </a>
            <a class="btn btn-secondary" href="<?= e(asset_url('downloads/demo.zip')) ?>">
              <i class="fas fa-download"></i>
              <?= e($home['hero']['secondary_cta']) ?>
            </a>
          </div>

          <div class="hero-stats hero-stats-centered">
            <?php foreach ($home['hero']['stats'] as $stat): ?>
              <article class="stat-card">
                <strong><?= e($stat['value']) ?></strong>
                <span><?= e($stat['label']) ?></span>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    </div>
  </section>

  <section class="section-block" id="<?= e($home['devlog']['id']) ?>">
    <div class="container">
      <div class="section-heading">
        <span class="section-eyebrow"><?= e($home['devlog']['eyebrow']) ?></span>
        <h2><?= e($home['devlog']['title']) ?></h2>
        <p><?= e($home['devlog']['description']) ?></p>
      </div>
      <div class="filter-bar" aria-label="<?= e($home['devlog']['filters_label']) ?>">
        <?php foreach ($home['devlog']['filters'] as $index => $filter): ?>
          <button type="button" class="filter-chip<?= $index === 0 ? ' active' : '' ?>" data-filter="<?= e($filter['key']) ?>"><?= e($filter['label']) ?></button>
        <?php endforeach; ?>
      </div>
      <div class="timeline-grid">
        <?php foreach ($home['devlog']['entries'] as $entry): ?>
          <article class="timeline-card reveal-item" data-tag="<?= e($entry['tag']) ?>" data-href="<?= e(with_lang(page_url('devlog/' . pathinfo($entry['href'], PATHINFO_FILENAME)))) ?>">
            <span class="timeline-date"><?= e($entry['date']) ?></span>
            <h3><?= e($entry['title']) ?></h3>
            <h4><?= e($entry['subtitle']) ?></h4>
            <p><?= e($entry['summary']) ?></p>
            <a class="text-link" href="<?= e(with_lang(page_url('devlog/' . pathinfo($entry['href'], PATHINFO_FILENAME)))) ?>"><?= e(t('home.read_entry')) ?></a>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>

<div id="lightbox" class="lightbox" aria-hidden="true">
  <button type="button" class="lightbox-close" aria-label="<?= e(t('lightbox.close')) ?>">&times;</button>
  <img id="lightbox-img" src="" alt="Preview">
  <a id="lightbox-download" download class="download-btn"><i class="fas fa-download"></i> <?= e(t('lightbox.download')) ?></a>
</div>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
