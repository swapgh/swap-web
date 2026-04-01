<?php
use App\Core\Auth;

$copy = [
    'es' => [
        'title' => 'Cuenta | Swap',
        'description' => 'Resumen de cuenta de Swap.',
        'eyebrow' => 'Cuenta',
        'summary' => 'Tu centro de cuenta: personajes, apoyo e historial en un mismo sitio, con la tienda separada para compras.',
        'signin' => 'Acceso',
        'session' => 'Sesion',
        'session_live' => 'Activa',
        'level' => 'Nivel',
        'mastery' => 'Mastery',
        'kills' => 'Enemigos derrotados',
        'character' => 'Personaje',
        'class' => 'Clase',
        'coins' => 'Monedas',
        'support' => 'Apoyo',
        'enabled' => 'Activo',
        'disabled' => 'Desactivado',
        'latest' => 'Ultimo',
        'no_contribution' => 'Sin aporte',
        'support_eyebrow' => 'Apoyo',
        'support_heading' => 'Apoyo al proyecto',
        'success_banner' => 'Contribucion completada. La ultima sesion aparece aqui.',
        'cancel_banner' => 'La contribucion se cancelo antes de completarse.',
        'supporter_tier' => 'Nivel supporter',
        'supporter_note' => 'Retoma una contribucion pendiente o inicia una nueva aportacion supporter. La tienda sigue aparte para compras o merch.',
        'contribution_id' => 'ID de contribucion',
        'customer' => 'Cliente',
        'tier' => 'Nivel',
        'provider' => 'Proveedor',
        'created' => 'Creado',
        'updated' => 'Actualizado',
        'complete_contribution' => 'Completar contribucion',
        'make_contribution' => 'Hacer contribucion',
        'view_history' => 'Historial de apoyo',
        'empty_heading' => 'Todavia no hay contribuciones',
        'empty_body' => 'Tu primera contribucion aparecera aqui sin obligarte a saltar a otra pagina.',
        'actions_eyebrow' => 'Gestion',
        'actions_heading' => 'Panel',
        'support_action_heading' => 'Continuar apoyo',
        'store' => 'Tienda',
        'overview' => 'Inicio',
        'support_nav' => 'Apoyo',
        'history_nav' => 'Historial',
        'characters_nav' => 'Personajes',
        'view_characters' => 'Ver personajes',
        'spaces_eyebrow' => 'Accesos',
        'spaces_heading' => 'Accesos principales',
        'characters_card_body' => 'Consulta tu roster actual y la informacion jugable disponible dentro de la web.',
        'support_card_body' => 'Gestiona tu aportacion supporter sin mezclarla con compras ni merch.',
        'store_card_body' => 'La tienda queda aparte para futuras compras, bundles o merch del proyecto.',
        'history_card_body' => 'Revisa tus contribuciones anteriores y el estado de las sesiones mas recientes.',
        'characters_cta' => 'Roster',
        'support_cta' => 'Apoyo',
        'store_cta' => 'Tienda',
        'history_cta' => 'Historial',
        'logout' => 'Cerrar sesion',
    ],
    'en' => [
        'title' => 'Account | Swap',
        'description' => 'Swap account overview.',
        'eyebrow' => 'Account',
        'summary' => 'Your account hub: characters, support, and history in one place, with the store kept separate for purchases.',
        'signin' => 'Sign-in',
        'session' => 'Session',
        'session_live' => 'Live',
        'level' => 'Level',
        'mastery' => 'Mastery',
        'kills' => 'Enemies killed',
        'character' => 'Character',
        'class' => 'Class',
        'coins' => 'Coins',
        'support' => 'Support',
        'enabled' => 'Enabled',
        'disabled' => 'Disabled',
        'latest' => 'Latest',
        'no_contribution' => 'No support yet',
        'support_eyebrow' => 'Support',
        'support_heading' => 'Project support',
        'success_banner' => 'Contribution completed. The latest session is shown below.',
        'cancel_banner' => 'The contribution was canceled before completion.',
        'supporter_tier' => 'Supporter tier',
        'supporter_note' => 'Resume a pending contribution or start a new supporter checkout. The store remains separate for products or merch.',
        'contribution_id' => 'Contribution ID',
        'customer' => 'Customer',
        'tier' => 'Tier',
        'provider' => 'Provider',
        'created' => 'Created',
        'updated' => 'Updated',
        'complete_contribution' => 'Complete contribution',
        'make_contribution' => 'Make contribution',
        'view_history' => 'Support history',
        'empty_heading' => 'No contributions yet',
        'empty_body' => 'Your first contribution will appear here instead of sending you to a separate page immediately.',
        'actions_eyebrow' => 'Manage',
        'actions_heading' => 'Panel',
        'support_action_heading' => 'Continue support',
        'store' => 'Store',
        'overview' => 'Home',
        'support_nav' => 'Support',
        'history_nav' => 'History',
        'characters_nav' => 'Characters',
        'view_characters' => 'View characters',
        'spaces_eyebrow' => 'Access',
        'spaces_heading' => 'Main sections',
        'characters_card_body' => 'Check your current roster and the playable data already available inside the website.',
        'support_card_body' => 'Manage your supporter contribution without mixing it with store purchases or merch.',
        'store_card_body' => 'The store remains separate for future purchases, bundles, or project merch.',
        'history_card_body' => 'Review past contributions and the status of your most recent sessions.',
        'characters_cta' => 'Roster',
        'support_cta' => 'Support',
        'store_cta' => 'Store',
        'history_cta' => 'History',
        'logout' => 'Log out',
    ],
];

$page = $copy[$pageLang] ?? $copy['es'];
$currentUser = is_array($user ?? null) ? $user : Auth::user() ?? [];
$currentBillingSession = is_array($billingSession ?? null) ? $billingSession : null;
$currentProgression = is_array($progression ?? null) ? $progression : [];
$currentCharacter = is_array($currentProgression['character'] ?? null) ? $currentProgression['character'] : [];
$isBillingAvailable = (bool) ($billingAvailable ?? false);
$billingProviderName = (string) ($billingProvider ?? 'placeholder');
$checkoutReturn = (string) ($checkoutReturn ?? '');
$billingStatus = billing_status_meta((string) ($currentBillingSession['status'] ?? 'pending'));
$accountRole = ucfirst((string) ($currentUser['role'] ?? 'developer'));
$accountName = (string) ($currentUser['name'] ?? 'Swap User');
$accountEmail = (string) ($currentUser['email'] ?? '');
$authSource = ucfirst((string) ($currentUser['auth_source'] ?? 'unknown'));
$characterName = (string) ($currentCharacter['name'] ?? 'Hero');
$characterLevel = (int) ($currentCharacter['level'] ?? 1);
$characterMasteryPoints = (int) ($currentCharacter['mastery_points'] ?? 0);
$characterHp = (int) ($currentCharacter['hp'] ?? 6);
$characterMaxHp = (int) ($currentCharacter['max_hp'] ?? 6);
$characterKills = (int) ($currentCharacter['enemies_killed'] ?? 0);
$characterCoins = (int) ($currentCharacter['coins'] ?? 0);
$characterClassId = (string) ($currentCharacter['class_id'] ?? 'adventurer');
$characterEquipment = is_array($currentCharacter['equipment'] ?? null) ? $currentCharacter['equipment'] : [];
$characterInventory = is_array($currentCharacter['inventory'] ?? null) ? $currentCharacter['inventory'] : [];
$characterQuests = is_array($currentCharacter['quests'] ?? null) ? $currentCharacter['quests'] : [];
$latestCreatedAt = format_datetime_ui((string) ($currentBillingSession['created_at'] ?? ''));
$latestUpdatedAt = format_datetime_ui((string) ($currentBillingSession['updated_at'] ?? ''));
$currentBillingState = (string) ($currentBillingSession['status'] ?? '');
$hasPendingCheckout = $currentBillingState === 'pending' && !empty($currentBillingSession['checkout_url']);
$billingActionLabel = $hasPendingCheckout ? $page['complete_contribution'] : $page['make_contribution'];
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$extraCss = ['css/layouts/account.css'];
$accountNavActive = 'dashboard';
$accountNavLabel = $page['actions_heading'];
?>
<main class="auth-page">
  <section class="auth-shell auth-shell-single auth-account-shell">
    <div class="auth-copy auth-account-hero auth-account-hero-wide">
      <div class="auth-hero-split">
        <div class="auth-hero-copy">
          <span class="auth-eyebrow"><?= e($page['eyebrow']) ?></span>
          <h1><?= e($accountName) ?></h1>
          <p class="auth-account-summary"><?= e($page['summary']) ?></p>
          <div class="auth-account-chips">
            <span class="auth-chip"><?= e($accountEmail) ?></span>
            <span class="auth-chip"><?= e($accountRole) ?></span>
            <span class="auth-chip"><?= e(ucfirst($billingProviderName)) ?></span>
            <span class="auth-chip"><?= e($characterName) ?></span>
          </div>
        </div>
        <div class="auth-kpi-strip">
          <article class="auth-kpi-card"><span class="auth-stat-label"><?= e($page['signin']) ?></span><strong><?= e($authSource) ?></strong></article>
          <article class="auth-kpi-card"><span class="auth-stat-label"><?= e($page['session']) ?></span><strong><?= e($page['session_live']) ?></strong></article>
          <article class="auth-kpi-card"><span class="auth-stat-label"><?= e($page['level']) ?></span><strong><?= e((string) $characterLevel) ?></strong></article>
          <article class="auth-kpi-card"><span class="auth-stat-label"><?= e($page['kills']) ?></span><strong><?= e((string) $characterKills) ?></strong></article>
        </div>
      </div>
    </div>

    <div class="auth-account-layout">
      <?php require __DIR__ . '/../../partials/account-nav.php'; ?>

      <div class="auth-account-main">
        <div class="auth-card auth-overview-panel">
          <div class="auth-section-heading">
            <span class="auth-eyebrow"><?= e($page['spaces_eyebrow']) ?></span>
            <h2><?= e($page['spaces_heading']) ?></h2>
          </div>
          <div class="auth-grid auth-account-space-grid">
            <article class="auth-detail-card auth-account-space-card">
              <span class="auth-stat-label"><?= e($page['character']) ?></span>
              <h3><?= e($characterName) ?></h3>
              <p><?= e($page['class'] . ': ' . game_label('classes', $characterClassId, ucfirst(str_replace('_', ' ', $characterClassId))) . ' | HP: ' . $characterHp . '/' . $characterMaxHp . ' | ' . $page['mastery'] . ': ' . $characterMasteryPoints . ' | ' . $page['coins'] . ': ' . $characterCoins) ?></p>
              <div class="auth-pill-list">
                <?php foreach ($characterEquipment as $slot => $itemId): ?>
                  <?php if (trim((string) $itemId) !== ''): ?>
                    <span class="auth-pill"><?= e(game_label('equipment_slots', (string) $slot, (string) $slot)) ?>: <?= e(game_label('items', (string) $itemId, (string) $itemId)) ?></span>
                  <?php endif; ?>
                <?php endforeach; ?>
                <?php foreach (array_slice($characterInventory, 0, 2) as $itemId): ?>
                  <span class="auth-pill"><?= e(game_label('items', (string) $itemId, (string) $itemId)) ?></span>
                <?php endforeach; ?>
                <?php foreach (array_slice($characterQuests, 0, 1) as $questId): ?>
                  <span class="auth-pill"><?= e(game_label('quests', (string) $questId, (string) $questId)) ?></span>
                <?php endforeach; ?>
              </div>
              <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('account/characters'))) ?>"><?= e($page['characters_cta']) ?></a>
            </article>
          </div>
          <div class="auth-grid auth-account-space-grid">
            <article class="auth-detail-card auth-account-space-card">
              <span class="auth-stat-label"><?= e($page['characters_nav']) ?></span>
              <h3><?= e($page['characters_nav']) ?></h3>
              <p><?= e($page['characters_card_body']) ?></p>
              <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('account/characters'))) ?>"><?= e($page['characters_cta']) ?></a>
            </article>
            <article class="auth-detail-card auth-account-space-card">
              <span class="auth-stat-label"><?= e($page['support_nav']) ?></span>
              <h3><?= e($page['support_nav']) ?></h3>
              <p><?= e($page['support_card_body']) ?></p>
              <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('account'))) ?>#support-area"><?= e($page['support_cta']) ?></a>
            </article>
            <article class="auth-detail-card auth-account-space-card">
              <span class="auth-stat-label"><?= e($page['store']) ?></span>
              <h3><?= e($page['store']) ?></h3>
              <p><?= e($page['store_card_body']) ?></p>
              <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('store'))) ?>"><?= e($page['store_cta']) ?></a>
            </article>
            <article class="auth-detail-card auth-account-space-card">
              <span class="auth-stat-label"><?= e($page['history_nav']) ?></span>
              <h3><?= e($page['history_nav']) ?></h3>
              <p><?= e($page['history_card_body']) ?></p>
              <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('account/support/history'))) ?>"><?= e($page['history_cta']) ?></a>
            </article>
          </div>
        </div>

        <div class="auth-stage-grid" id="support-area">
          <div class="auth-card auth-stage-main">
            <div class="auth-section-heading">
              <span class="auth-eyebrow"><?= e($page['support_eyebrow']) ?></span>
              <h2><?= e($page['support_heading']) ?></h2>
            </div>
            <?php if ($checkoutReturn === 'success'): ?><div class="auth-banner auth-banner-success"><?= e($page['success_banner']) ?></div><?php elseif ($checkoutReturn === 'cancel'): ?><div class="auth-banner auth-banner-warning"><?= e($page['cancel_banner']) ?></div><?php endif; ?>
            <?php if (!empty($billingError)): ?><div class="auth-banner auth-banner-error"><?= e((string) $billingError) ?></div><?php endif; ?>
            <?php if (!empty($billingSuccess)): ?><div class="auth-banner auth-banner-success"><?= e((string) $billingSuccess) ?></div><?php endif; ?>

            <?php if ($currentBillingSession !== null): ?>
              <div class="auth-billing-spotlight">
                <div class="auth-billing-spotlight-head">
                  <div>
                    <span class="auth-stat-label"><?= e($page['supporter_tier']) ?></span>
                    <h3><?= e(format_money_from_cents((int) ($currentBillingSession['amount_cents'] ?? 0), (string) ($currentBillingSession['currency'] ?? 'EUR'))) ?></h3>
                  </div>
                  <span class="auth-status-badge <?= e($billingStatus['class']) ?>"><?= e($billingStatus['label']) ?></span>
                </div>
                <div class="auth-billing-meta-grid">
                  <div><span class="auth-stat-label"><?= e($page['contribution_id']) ?></span><p><?= e((string) ($currentBillingSession['id'] ?? '')) ?></p></div>
                  <div><span class="auth-stat-label"><?= e($page['customer']) ?></span><p><?= e((string) ($currentBillingSession['customer_email'] ?? '')) ?></p></div>
                  <div><span class="auth-stat-label"><?= e($page['provider']) ?></span><p><?= e(ucfirst((string) ($currentBillingSession['provider'] ?? $billingProviderName))) ?></p></div>
                  <div><span class="auth-stat-label"><?= e($page['tier']) ?></span><p><?= e((string) ($currentBillingSession['product_key'] ?? 'supporter_tier')) ?></p></div>
                </div>
                <div class="auth-billing-timeline">
                  <span><strong><?= e($page['created']) ?>:</strong> <?= e($latestCreatedAt) ?></span>
                  <span><strong><?= e($page['updated']) ?>:</strong> <?= e($latestUpdatedAt) ?></span>
                </div>
              </div>
            <?php else: ?>
              <div class="auth-empty-state"><h3><?= e($page['empty_heading']) ?></h3><p><?= e($page['empty_body']) ?></p></div>
            <?php endif; ?>
          </div>

          <aside class="auth-card auth-actions-panel">
            <div class="auth-section-heading">
              <span class="auth-eyebrow"><?= e($page['actions_eyebrow']) ?></span>
              <h2><?= e($page['support_action_heading']) ?></h2>
            </div>
            <p class="auth-meta-note"><?= e($page['supporter_note']) ?></p>
            <?php if ($isBillingAvailable): ?>
              <form action="<?= e(with_lang(page_url('account/support/checkout'))) ?>" method="post" class="auth-inline-form">
                <?= csrf_field() ?>
                <input type="hidden" name="product_key" value="supporter_tier">
                <input type="hidden" name="currency" value="EUR">
                <input type="hidden" name="amount_cents" value="500">
                <button type="submit" class="auth-submit"><?= e($billingActionLabel) ?></button>
              </form>
            <?php endif; ?>
          </aside>
        </div>
      </div>
    </div>
  </section>
</main>
