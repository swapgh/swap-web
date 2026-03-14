<?php
$pageTitle = 'Profile | Swap';
$pageDescription = 'User profile page.';
$extraCss = ['css/auth.css'];
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
?>
<main class="auth-page">
  <section class="auth-shell">
    <div class="auth-copy">
      <span class="auth-eyebrow">Profile</span>
      <h1><?= e((string) ($user['name'] ?? 'Swap User')) ?></h1>
      <p><?= e((string) ($user['email'] ?? '')) ?></p>
      <p><?= e((string) ($user['role'] ?? '')) ?></p>
    </div>
    <div class="auth-card">
      <a class="auth-submit" href="<?= e(with_lang(page_url('characters'))) ?>">Open characters</a>
    </div>
  </section>
</main>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
