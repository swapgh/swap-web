<?php
$copy = [
    'es' => [
        'title' => 'Personajes | Swap',
        'description' => 'Resumen del grupo de Swap.',
        'eyebrow' => 'Personajes',
        'heading' => 'Vista del grupo',
        'summary' => 'Una vista compacta de como el roster, la progresion y los sistemas del jugador pueden vivir dentro del sitio.',
        'active_slots' => 'espacios activos',
        'prototype_roster' => 'Roster prototipo',
        'account_area' => 'Area de cuenta',
        'overview' => 'Resumen',
        'support' => 'Apoyo',
        'store' => 'Store',
        'history' => 'Historial',
        'roster_eyebrow' => 'Roster',
        'roster_heading' => 'Alineacion actual',
        'level' => 'Nivel',
        'hp' => 'HP',
        'back_profile' => 'Volver al perfil',
    ],
    'en' => [
        'title' => 'Characters | Swap',
        'description' => 'Swap party overview.',
        'eyebrow' => 'Characters',
        'heading' => 'Party overview',
        'summary' => 'A compact preview of how party data, progression, and player-facing systems can live inside the site.',
        'active_slots' => 'active slots',
        'prototype_roster' => 'Prototype roster',
        'account_area' => 'Account area',
        'overview' => 'Overview',
        'support' => 'Support',
        'store' => 'Store',
        'history' => 'History',
        'roster_eyebrow' => 'Roster',
        'roster_heading' => 'Current lineup',
        'level' => 'Level',
        'hp' => 'HP',
        'back_profile' => 'Back to profile',
    ],
];

$page = $copy[$pageLang] ?? $copy['es'];
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$extraCss = ['css/pages/auth.css'];
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
?>
<main class="auth-page">
  <section class="auth-shell auth-shell-single auth-characters-shell">
    <div class="auth-copy auth-characters-hero">
      <span class="auth-eyebrow"><?= e($page['eyebrow']) ?></span>
      <h1><?= e($page['heading']) ?></h1>
      <p><?= e($page['summary']) ?></p>
      <div class="auth-account-chips">
        <span class="auth-chip"><?= e((string) count($characters) . ' ' . $page['active_slots']) ?></span>
        <span class="auth-chip"><?= e($page['prototype_roster']) ?></span>
      </div>
    </div>
    <div class="auth-account-layout">
    <aside class="auth-card auth-account-nav-card">
      <div class="auth-section-heading">
        <span class="auth-eyebrow"><?= e($page['eyebrow']) ?></span>
        <h2><?= e($page['account_area']) ?></h2>
      </div>
      <nav class="auth-account-nav" aria-label="<?= e($page['account_area']) ?>">
        <a class="auth-account-nav-link" href="<?= e(with_lang(page_url('profile'))) ?>"><?= e($page['overview']) ?></a>
        <a class="auth-account-nav-link is-active" href="<?= e(with_lang(page_url('characters'))) ?>"><?= e($page['heading']) ?></a>
        <a class="auth-account-nav-link" href="<?= e(with_lang(page_url('profile'))) ?>#support-area"><?= e($page['support']) ?></a>
        <a class="auth-account-nav-link" href="<?= e(with_lang(page_url('store'))) ?>"><?= e($page['store']) ?></a>
        <a class="auth-account-nav-link" href="<?= e(with_lang(page_url('support/history'))) ?>"><?= e($page['history']) ?></a>
      </nav>
    </aside>
    <div class="auth-card auth-characters-panel">
      <div class="auth-section-heading">
        <span class="auth-eyebrow"><?= e($page['roster_eyebrow']) ?></span>
        <h2><?= e($page['roster_heading']) ?></h2>
      </div>
      <div class="auth-grid auth-character-grid">
      <?php foreach ($characters as $character): ?>
        <article class="auth-detail-card auth-character-card">
          <span class="auth-stat-label"><?= e($character['class']) ?></span>
          <h3><?= e($character['name']) ?></h3>
          <div class="auth-character-metrics">
            <span><?= e($page['level']) ?> <?= e((string) $character['level']) ?></span>
            <span><?= e((string) $character['hp']) ?> <?= e($page['hp']) ?></span>
          </div>
          <p><?= e($character['inventory']) ?></p>
        </article>
      <?php endforeach; ?>
      </div>
      <div class="auth-action-list">
        <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('profile'))) ?>"><?= e($page['back_profile']) ?></a>
      </div>
    </div>
    </div>
  </section>
</main>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
