<?php
use App\Core\Auth;

$copy = [
    'es' => [
        'title' => 'Perfil | Swap',
        'description' => 'Resumen de cuenta de Swap.',
        'eyebrow' => 'Perfil',
        'summary' => 'Tu area de jugador: acceso rapido a personajes, apoyo al proyecto, tienda e historial desde un mismo sitio.',
        'signin' => 'Acceso',
        'session' => 'Sesion',
        'session_live' => 'Activa',
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
        'supporter_note' => 'Ahora mismo esta area solo inicia el nivel supporter. La compra de productos o merch va en la tienda.',
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
        'actions_eyebrow' => 'Acciones',
        'actions_heading' => 'Area de cuenta',
        'support_action_heading' => 'Siguiente paso',
        'store' => 'Tienda',
        'overview' => 'Resumen',
        'support_nav' => 'Apoyo',
        'history_nav' => 'Historial',
        'characters_nav' => 'Personajes',
        'view_characters' => 'Ver personajes',
        'spaces_eyebrow' => 'Navegacion',
        'spaces_heading' => 'Tus espacios',
        'characters_card_body' => 'Consulta tu grupo actual y la informacion jugable ya integrada en la web.',
        'support_card_body' => 'Apoya el proyecto si quieres hacerlo, sin que esta pantalla gire solo alrededor del pago.',
        'store_card_body' => 'La tienda queda separada para futuras compras, merch o contenido del juego.',
        'history_card_body' => 'Revisa contribuciones anteriores y el estado de tus sesiones recientes.',
        'go_to' => 'Abrir',
        'logout' => 'Cerrar sesion',
    ],
    'en' => [
        'title' => 'Profile | Swap',
        'description' => 'Swap account overview.',
        'eyebrow' => 'Profile',
        'summary' => 'Your player area: quick access to characters, project support, store, and history from one place.',
        'signin' => 'Sign-in',
        'session' => 'Session',
        'session_live' => 'Live',
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
        'supporter_note' => 'This area currently starts only the supporter tier. Product and merch purchases belong in the store.',
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
        'actions_eyebrow' => 'Actions',
        'actions_heading' => 'Account area',
        'support_action_heading' => 'Next step',
        'store' => 'Store',
        'overview' => 'Overview',
        'support_nav' => 'Support',
        'history_nav' => 'History',
        'characters_nav' => 'Characters',
        'view_characters' => 'View characters',
        'spaces_eyebrow' => 'Navigation',
        'spaces_heading' => 'Your spaces',
        'characters_card_body' => 'Check your current party and the game-facing data already living on the website.',
        'support_card_body' => 'Support the project if you want to, without making this whole screen feel like a payment wall.',
        'store_card_body' => 'The store stays separate for future merch, products, or game-related purchases.',
        'history_card_body' => 'Review past contributions and the status of your latest sessions.',
        'go_to' => 'Open',
        'logout' => 'Log out',
    ],
];

$page = $copy[$pageLang] ?? $copy['es'];
$currentUser = is_array($user ?? null) ? $user : Auth::user() ?? [];
$currentBillingSession = is_array($billingSession ?? null) ? $billingSession : null;
$isBillingAvailable = (bool) ($billingAvailable ?? false);
$billingProviderName = (string) ($billingProvider ?? 'placeholder');
$checkoutReturn = (string) ($checkoutReturn ?? '');
$billingStatus = billing_status_meta((string) ($currentBillingSession['status'] ?? 'pending'));
$accountRole = ucfirst((string) ($currentUser['role'] ?? 'developer'));
$accountName = (string) ($currentUser['name'] ?? 'Swap User');
$accountEmail = (string) ($currentUser['email'] ?? '');
$authSource = ucfirst((string) ($currentUser['auth_source'] ?? 'unknown'));
$latestCreatedAt = format_datetime_ui((string) ($currentBillingSession['created_at'] ?? ''));
$latestUpdatedAt = format_datetime_ui((string) ($currentBillingSession['updated_at'] ?? ''));
$currentBillingState = (string) ($currentBillingSession['status'] ?? '');
$hasPendingCheckout = $currentBillingState === 'pending' && !empty($currentBillingSession['checkout_url']);
$billingActionLabel = $hasPendingCheckout ? $page['complete_contribution'] : $page['make_contribution'];
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$extraCss = ['css/05-pages/profile.css'];
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
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
          </div>
        </div>
        <div class="auth-kpi-strip">
          <article class="auth-kpi-card">
            <span class="auth-stat-label"><?= e($page['signin']) ?></span>
            <strong><?= e($authSource) ?></strong>
          </article>
          <article class="auth-kpi-card">
            <span class="auth-stat-label"><?= e($page['session']) ?></span>
            <strong><?= e($page['session_live']) ?></strong>
          </article>
          <article class="auth-kpi-card">
            <span class="auth-stat-label"><?= e($page['support']) ?></span>
            <strong><?= e($isBillingAvailable ? $page['enabled'] : $page['disabled']) ?></strong>
          </article>
          <article class="auth-kpi-card">
            <span class="auth-stat-label"><?= e($page['latest']) ?></span>
            <strong><?= e($currentBillingSession !== null ? $billingStatus['label'] : $page['no_contribution']) ?></strong>
          </article>
        </div>
      </div>
    </div>

    <div class="auth-account-layout">
      <aside class="auth-card auth-account-nav-card">
        <div class="auth-section-heading">
          <span class="auth-eyebrow"><?= e($page['actions_eyebrow']) ?></span>
          <h2><?= e($page['actions_heading']) ?></h2>
        </div>
        <nav class="auth-account-nav" aria-label="<?= e($page['actions_heading']) ?>">
          <a class="auth-account-nav-link is-active" href="<?= e(with_lang(page_url('profile'))) ?>"><?= e($page['overview']) ?></a>
          <a class="auth-account-nav-link" href="<?= e(with_lang(page_url('characters'))) ?>"><?= e($page['characters_nav']) ?></a>
          <a class="auth-account-nav-link" href="<?= e(with_lang(page_url('profile'))) ?>#support-area"><?= e($page['support_nav']) ?></a>
          <a class="auth-account-nav-link" href="<?= e(with_lang(page_url('store'))) ?>"><?= e($page['store']) ?></a>
          <a class="auth-account-nav-link" href="<?= e(with_lang(page_url('support/history'))) ?>"><?= e($page['history_nav']) ?></a>
        </nav>
      </aside>

    <div class="auth-account-main">
      <div class="auth-card auth-overview-panel">
        <div class="auth-section-heading">
          <span class="auth-eyebrow"><?= e($page['spaces_eyebrow']) ?></span>
          <h2><?= e($page['spaces_heading']) ?></h2>
        </div>
        <div class="auth-grid auth-account-space-grid">
          <article class="auth-detail-card auth-account-space-card">
            <span class="auth-stat-label"><?= e($page['characters_nav']) ?></span>
            <h3><?= e($page['characters_nav']) ?></h3>
            <p><?= e($page['characters_card_body']) ?></p>
            <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('characters'))) ?>"><?= e($page['go_to']) ?></a>
          </article>
          <article class="auth-detail-card auth-account-space-card">
            <span class="auth-stat-label"><?= e($page['support_nav']) ?></span>
            <h3><?= e($page['support_nav']) ?></h3>
            <p><?= e($page['support_card_body']) ?></p>
            <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('profile'))) ?>#support-area"><?= e($page['go_to']) ?></a>
          </article>
          <article class="auth-detail-card auth-account-space-card">
            <span class="auth-stat-label"><?= e($page['store']) ?></span>
            <h3><?= e($page['store']) ?></h3>
            <p><?= e($page['store_card_body']) ?></p>
            <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('store'))) ?>"><?= e($page['go_to']) ?></a>
          </article>
          <article class="auth-detail-card auth-account-space-card">
            <span class="auth-stat-label"><?= e($page['history_nav']) ?></span>
            <h3><?= e($page['history_nav']) ?></h3>
            <p><?= e($page['history_card_body']) ?></p>
            <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('support/history'))) ?>"><?= e($page['go_to']) ?></a>
          </article>
        </div>
      </div>

      <div class="auth-stage-grid" id="support-area">
      <div class="auth-card auth-stage-main">
        <div class="auth-section-heading">
          <span class="auth-eyebrow"><?= e($page['support_eyebrow']) ?></span>
          <h2><?= e($page['support_heading']) ?></h2>
        </div>
        <?php if ($checkoutReturn === 'success'): ?>
          <div class="auth-banner auth-banner-success"><?= e($page['success_banner']) ?></div>
        <?php elseif ($checkoutReturn === 'cancel'): ?>
          <div class="auth-banner auth-banner-warning"><?= e($page['cancel_banner']) ?></div>
        <?php endif; ?>
        <?php if (!empty($billingError)): ?>
          <div class="auth-banner auth-banner-error"><?= e((string) $billingError) ?></div>
        <?php endif; ?>
        <?php if (!empty($billingSuccess)): ?>
          <div class="auth-banner auth-banner-success"><?= e((string) $billingSuccess) ?></div>
        <?php endif; ?>

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
              <div>
                <span class="auth-stat-label"><?= e($page['contribution_id']) ?></span>
                <p><?= e((string) ($currentBillingSession['id'] ?? '')) ?></p>
              </div>
              <div>
                <span class="auth-stat-label"><?= e($page['customer']) ?></span>
                <p><?= e((string) ($currentBillingSession['customer_email'] ?? $accountEmail)) ?></p>
              </div>
              <div>
                <span class="auth-stat-label"><?= e($page['tier']) ?></span>
                <p><?= e((string) ($currentBillingSession['product_key'] ?? 'supporter_pack')) ?></p>
              </div>
              <div>
                <span class="auth-stat-label"><?= e($page['provider']) ?></span>
                <p><?= e(ucfirst($billingProviderName)) ?></p>
              </div>
            </div>
            <div class="auth-billing-timeline">
              <span><?= e($page['created']) ?>: <?= e($latestCreatedAt) ?></span>
              <?php if (!empty($currentBillingSession['updated_at'])): ?>
                <span><?= e($page['updated']) ?>: <?= e($latestUpdatedAt) ?></span>
              <?php endif; ?>
            </div>
            <div class="auth-inline-actions">
              <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('support/history'))) ?>"><?= e($page['view_history']) ?></a>
            </div>
          </div>
        <?php else: ?>
          <div class="auth-empty-state">
            <h3><?= e($page['empty_heading']) ?></h3>
            <p><?= e($page['empty_body']) ?></p>
          </div>
        <?php endif; ?>
      </div>

      <aside class="auth-card auth-stage-side">
        <div class="auth-section-heading">
          <span class="auth-eyebrow"><?= e($page['actions_eyebrow']) ?></span>
          <h2><?= e($page['actions_heading']) ?></h2>
        </div>
        <div class="auth-action-list">
          <div class="auth-meta-note">
            <strong><?= e($page['support_action_heading']) ?>:</strong> <?= e($page['supporter_note']) ?>
          </div>
          <form action="<?= e(with_lang(page_url('support/contribute'))) ?>" method="post" class="auth-inline-form">
            <?= csrf_field() ?>
            <input type="hidden" name="product_key" value="supporter_pack">
            <input type="hidden" name="currency" value="EUR">
            <input type="hidden" name="amount_cents" value="499">
            <button type="submit" class="auth-submit"<?= $isBillingAvailable ? '' : ' disabled' ?>><?= e($billingActionLabel) ?></button>
          </form>
          <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('support/history'))) ?>"><?= e($page['view_history']) ?></a>
          <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('store'))) ?>"><?= e($page['store']) ?></a>
          <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('characters'))) ?>"><?= e($page['view_characters']) ?></a>
          <form action="<?= e(with_lang(page_url('logout'))) ?>" method="post">
            <?= csrf_field() ?>
            <button type="submit" class="auth-secondary"><?= e($page['logout']) ?></button>
          </form>
        </div>
      </aside>
      </div>
    </div>
    </div>
  </section>
</main>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
