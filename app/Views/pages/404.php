<?php
http_response_code(404);
$pageTitle = t('error.title');
$pageDescription = t('error.title');
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
?>
<section class="section section-error" aria-labelledby="error-title">
  <div class="container">
    <div class="error-card">
      <div class="error-code">404</div>
      <h2 id="error-title"><?= e(t('error.heading')) ?></h2>
      <p><?= e(t('error.body')) ?></p>
      <div class="hero-actions">
        <a class="btn btn-primary" href="<?= e(with_lang(page_url(''))) ?>"><i class="fas fa-home"></i> <?= e(t('error.home')) ?></a>
        <a class="btn btn-ghost" href="javascript:history.back()"><i class="fas fa-arrow-left"></i> <?= e(t('error.back')) ?></a>
      </div>
    </div>
  </div>
</section>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
