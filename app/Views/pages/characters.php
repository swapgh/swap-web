<?php
$pageTitle = 'Characters | Swap';
$pageDescription = 'User characters page.';
$extraCss = ['css/auth.css'];
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
?>
<main class="auth-page">
  <section class="auth-shell auth-shell-single">
    <div class="auth-copy">
      <span class="auth-eyebrow">Characters</span>
      <h1>Party overview</h1>
    </div>
    <div class="auth-grid">
      <?php foreach ($characters as $character): ?>
        <article class="auth-card auth-detail-card">
          <h3><?= e($character['name']) ?></h3>
          <p>Class: <?= e($character['class']) ?></p>
          <p>Level: <?= e((string) $character['level']) ?></p>
          <p>HP: <?= e((string) $character['hp']) ?></p>
          <p><?= e($character['inventory']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
