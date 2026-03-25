<?php
$copy = [
    'es' => [
        'title' => 'Personajes | Swap',
        'description' => 'Vista del roster de Swap dentro del area de cuenta.',
        'eyebrow' => 'Cuenta',
        'heading' => 'Personajes',
        'summary' => 'Una vista compacta del roster actual y de como los sistemas del jugador pueden vivir dentro del area de cuenta.',
        'active_slots' => 'espacios activos',
        'prototype_roster' => 'Roster sincronizado',
        'account_area' => 'Panel',
        'overview' => 'Inicio',
        'support' => 'Apoyo',
        'store' => 'Store',
        'history' => 'Historial',
        'roster_eyebrow' => 'Roster',
        'roster_heading' => 'Alineacion actual',
        'level' => 'Nivel',
        'hp' => 'HP',
        'inventory_empty' => 'Inventario vacio por ahora',
        'back_profile' => 'Volver a cuenta',
    ],
    'en' => [
        'title' => 'Characters | Swap',
        'description' => 'Roster view inside the Swap account area.',
        'eyebrow' => 'Account',
        'heading' => 'Party overview',
        'summary' => 'A compact view of the current roster and how player-facing systems can live inside the account area.',
        'active_slots' => 'active slots',
        'prototype_roster' => 'Synced roster',
        'account_area' => 'Panel',
        'overview' => 'Home',
        'support' => 'Support',
        'store' => 'Tienda',
        'history' => 'History',
        'roster_eyebrow' => 'Roster',
        'roster_heading' => 'Current lineup',
        'level' => 'Level',
        'hp' => 'HP',
        'inventory_empty' => 'Inventory is empty for now',
        'back_profile' => 'Back to account',
    ],
];

$page = $copy[$pageLang] ?? $copy['es'];
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$extraCss = ['css/layouts/account.css'];
$accountNavActive = 'characters';
$accountNavLabel = $page['account_area'];
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
      <?php require __DIR__ . '/../../partials/account-nav.php'; ?>
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
              <p><?= e((string) ($character['inventory'] !== '' ? $character['inventory'] : $page['inventory_empty'])) ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
</main>
