<?php
use App\Core\Auth;

$copy = [
    'es' => [
        'title' => 'Perfil | Swap',
        'description' => 'Resumen de cuenta de Swap.',
        'eyebrow' => 'Perfil',
        'summary' => 'Una vista de cuenta mas clara, centrada en tu sesion, el ultimo estado de pago y las acciones que si importan.',
        'signin' => 'Acceso',
        'session' => 'Sesion',
        'session_live' => 'Activa',
        'billing' => 'Pagos',
        'enabled' => 'Activo',
        'disabled' => 'Desactivado',
        'latest' => 'Ultimo',
        'no_checkout' => 'Sin checkout',
        'billing_eyebrow' => 'Pagos',
        'billing_heading' => 'Ultimo checkout',
        'success_banner' => 'Checkout completado. La ultima sesion aparece aqui.',
        'cancel_banner' => 'El checkout se cancelo antes de completar el pago.',
        'supporter_pack' => 'Supporter pack',
        'session_id' => 'ID de sesion',
        'customer' => 'Cliente',
        'product' => 'Producto',
        'provider' => 'Proveedor',
        'created' => 'Creado',
        'updated' => 'Actualizado',
        'open_checkout' => 'Abrir checkout',
        'view_history' => 'Ver historial',
        'empty_heading' => 'Todavia no hay checkout',
        'empty_body' => 'La primera sesion de pago aparecera aqui sin obligarte a saltar a otra pagina.',
        'actions_eyebrow' => 'Acciones',
        'actions_heading' => 'Accesos rapidos',
        'start_checkout' => 'Iniciar checkout',
        'view_characters' => 'Ver personajes',
        'logout' => 'Cerrar sesion',
    ],
    'en' => [
        'title' => 'Profile | Swap',
        'description' => 'Swap account overview.',
        'eyebrow' => 'Profile',
        'summary' => 'A cleaner account view focused on your session, latest billing state, and the next useful actions.',
        'signin' => 'Sign-in',
        'session' => 'Session',
        'session_live' => 'Live',
        'billing' => 'Billing',
        'enabled' => 'Enabled',
        'disabled' => 'Disabled',
        'latest' => 'Latest',
        'no_checkout' => 'No checkout',
        'billing_eyebrow' => 'Billing',
        'billing_heading' => 'Latest checkout',
        'success_banner' => 'Checkout completed. The latest session is shown below.',
        'cancel_banner' => 'Checkout was canceled before payment completed.',
        'supporter_pack' => 'Supporter pack',
        'session_id' => 'Session ID',
        'customer' => 'Customer',
        'product' => 'Product',
        'provider' => 'Provider',
        'created' => 'Created',
        'updated' => 'Updated',
        'open_checkout' => 'Open checkout',
        'view_history' => 'View history',
        'empty_heading' => 'No checkout session yet',
        'empty_body' => 'Your first billing session will appear here instead of sending you to a separate page immediately.',
        'actions_eyebrow' => 'Actions',
        'actions_heading' => 'Quick actions',
        'start_checkout' => 'Start checkout',
        'view_characters' => 'View characters',
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
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$extraCss = ['css/pages/auth.css'];
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
            <span class="auth-stat-label"><?= e($page['billing']) ?></span>
            <strong><?= e($isBillingAvailable ? $page['enabled'] : $page['disabled']) ?></strong>
          </article>
          <article class="auth-kpi-card">
            <span class="auth-stat-label"><?= e($page['latest']) ?></span>
            <strong><?= e($currentBillingSession !== null ? $billingStatus['label'] : $page['no_checkout']) ?></strong>
          </article>
        </div>
      </div>
    </div>

    <div class="auth-stage-grid">
      <div class="auth-card auth-stage-main">
        <div class="auth-section-heading">
          <span class="auth-eyebrow"><?= e($page['billing_eyebrow']) ?></span>
          <h2><?= e($page['billing_heading']) ?></h2>
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
                <span class="auth-stat-label"><?= e($page['supporter_pack']) ?></span>
                <h3><?= e(format_money_from_cents((int) ($currentBillingSession['amount_cents'] ?? 0), (string) ($currentBillingSession['currency'] ?? 'EUR'))) ?></h3>
              </div>
              <span class="auth-status-badge <?= e($billingStatus['class']) ?>"><?= e($billingStatus['label']) ?></span>
            </div>
            <div class="auth-billing-meta-grid">
              <div>
                <span class="auth-stat-label"><?= e($page['session_id']) ?></span>
                <p><?= e((string) ($currentBillingSession['id'] ?? '')) ?></p>
              </div>
              <div>
                <span class="auth-stat-label"><?= e($page['customer']) ?></span>
                <p><?= e((string) ($currentBillingSession['customer_email'] ?? $accountEmail)) ?></p>
              </div>
              <div>
                <span class="auth-stat-label"><?= e($page['product']) ?></span>
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
              <a class="auth-secondary auth-link-button" href="<?= e((string) ($currentBillingSession['checkout_url'] ?? '#')) ?>"><?= e($page['open_checkout']) ?></a>
              <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('billing/history'))) ?>"><?= e($page['view_history']) ?></a>
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
          <form action="<?= e(with_lang(page_url('billing/checkout'))) ?>" method="post" class="auth-inline-form">
            <?= csrf_field() ?>
            <input type="hidden" name="product_key" value="supporter_pack">
            <input type="hidden" name="currency" value="EUR">
            <input type="hidden" name="amount_cents" value="499">
            <button type="submit" class="auth-submit"<?= $isBillingAvailable ? '' : ' disabled' ?>><?= e($page['start_checkout']) ?></button>
          </form>
          <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('characters'))) ?>"><?= e($page['view_characters']) ?></a>
          <form action="<?= e(with_lang(page_url('logout'))) ?>" method="post">
            <?= csrf_field() ?>
            <button type="submit" class="auth-secondary"><?= e($page['logout']) ?></button>
          </form>
        </div>
      </aside>
    </div>
  </section>
</main>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
