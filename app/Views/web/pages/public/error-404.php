<?php
$pageTitle = t('error.title');
$pageDescription = t('error.description');
$extraCss = ['css/pages/error-404.css'];
?>
<main>
  <section class="section section-error">
    <div class="container">
      <div class="error-card">
        <span class="error-code">404</span>
        <h2><?= e(t('error.heading')) ?></h2>
        <p><?= e(t('error.body')) ?></p>
        <div class="hero-actions page-actions">
          <a class="btn btn-primary" href="<?= e(with_lang(page_url(''))) ?>"><i class="fas fa-home"></i> <?= e(t('error.home')) ?></a>
        </div>
      </div>
    </div>
  </section>
</main>
