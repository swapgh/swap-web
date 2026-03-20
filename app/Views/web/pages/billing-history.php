<?php
use App\Core\Auth;

$copy = [
    'es' => [
        'title' => 'Historial de pagos | Swap',
        'description' => 'Historial de pagos y actividad de checkout de Swap.',
        'eyebrow' => 'Pagos',
        'heading' => 'Historial de pagos',
        'summary' => 'Un registro compacto de actividad para %s con el detalle justo para leer rapido.',
        'billing_enabled' => 'Pagos activos',
        'billing_disabled' => 'Pagos desactivados',
        'sessions' => 'sesiones',
        'provider' => 'Proveedor',
        'billing' => 'Pagos',
        'enabled' => 'Activo',
        'disabled' => 'Desactivado',
        'latest' => 'Ultimo',
        'no_records' => 'Sin registros',
        'history_eyebrow' => 'Historial',
        'history_heading' => 'Sesiones recientes',
        'back_profile' => 'Volver al perfil',
        'characters' => 'Personajes',
        'empty_heading' => 'Todavia no hay registros',
        'empty_body' => 'Cuando se cree una sesion de checkout, aparecera aqui como una fila compacta.',
        'status' => 'Estado',
        'amount' => 'Importe',
        'customer' => 'Cliente',
        'created' => 'Creado',
        'open' => 'Abrir',
        'showing_latest' => 'Mostrando las ultimas %d sesiones para mantener la pagina legible.',
    ],
    'en' => [
        'title' => 'Billing history | Swap',
        'description' => 'Swap billing history and checkout activity.',
        'eyebrow' => 'Billing',
        'heading' => 'Billing history',
        'summary' => 'A compact activity log for %s with enough detail to scan fast.',
        'billing_enabled' => 'Billing enabled',
        'billing_disabled' => 'Billing disabled',
        'sessions' => 'sessions',
        'provider' => 'Provider',
        'billing' => 'Billing',
        'enabled' => 'Enabled',
        'disabled' => 'Disabled',
        'latest' => 'Latest',
        'no_records' => 'No records',
        'history_eyebrow' => 'History',
        'history_heading' => 'Recent sessions',
        'back_profile' => 'Back to profile',
        'characters' => 'Characters',
        'empty_heading' => 'No billing records yet',
        'empty_body' => 'When a checkout session is created, it will appear here as a compact activity row.',
        'status' => 'Status',
        'amount' => 'Amount',
        'customer' => 'Customer',
        'created' => 'Created',
        'open' => 'Open',
        'showing_latest' => 'Showing the latest %d sessions to keep the page readable.',
    ],
];

$page = $copy[$pageLang] ?? $copy['es'];
$currentUser = is_array($user ?? null) ? $user : Auth::user() ?? [];
$sessions = is_array($billingSessions ?? null) ? $billingSessions : [];
$isBillingAvailable = (bool) ($billingAvailable ?? false);
$billingProviderName = (string) ($billingProvider ?? 'placeholder');
$recentSessions = array_slice($sessions, 0, 8);
$latestSession = $recentSessions[0] ?? null;
$latestStatus = billing_status_meta((string) ($latestSession['status'] ?? 'pending'));
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
          <h1><?= e($page['heading']) ?></h1>
          <p class="auth-account-summary"><?= e(sprintf($page['summary'], (string) ($currentUser['email'] ?? 'your account'))) ?></p>
          <div class="auth-account-chips">
            <span class="auth-chip"><?= e($isBillingAvailable ? $page['billing_enabled'] : $page['billing_disabled']) ?></span>
            <span class="auth-chip"><?= e(ucfirst($billingProviderName)) ?></span>
            <span class="auth-chip"><?= e((string) count($sessions) . ' ' . $page['sessions']) ?></span>
          </div>
        </div>
        <div class="auth-kpi-strip">
          <article class="auth-kpi-card">
            <span class="auth-stat-label"><?= e($page['provider']) ?></span>
            <strong><?= e(ucfirst($billingProviderName)) ?></strong>
          </article>
          <article class="auth-kpi-card">
            <span class="auth-stat-label"><?= e($page['billing']) ?></span>
            <strong><?= e($isBillingAvailable ? $page['enabled'] : $page['disabled']) ?></strong>
          </article>
          <article class="auth-kpi-card">
            <span class="auth-stat-label"><?= e($page['sessions']) ?></span>
            <strong><?= e((string) count($sessions)) ?></strong>
          </article>
          <article class="auth-kpi-card">
            <span class="auth-stat-label"><?= e($page['latest']) ?></span>
            <strong><?= e($latestSession !== null ? $latestStatus['label'] : $page['no_records']) ?></strong>
          </article>
        </div>
      </div>
    </div>

    <div class="auth-card auth-records-panel">
      <div class="auth-records-toolbar">
        <div class="auth-section-heading">
          <span class="auth-eyebrow"><?= e($page['history_eyebrow']) ?></span>
          <h2><?= e($page['history_heading']) ?></h2>
        </div>
        <div class="auth-inline-actions auth-records-toolbar-actions">
          <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('profile'))) ?>"><?= e($page['back_profile']) ?></a>
          <a class="auth-secondary auth-link-button" href="<?= e(with_lang(page_url('characters'))) ?>"><?= e($page['characters']) ?></a>
        </div>
      </div>

      <?php if ($recentSessions === []): ?>
        <div class="auth-empty-state">
          <h3><?= e($page['empty_heading']) ?></h3>
          <p><?= e($page['empty_body']) ?></p>
        </div>
      <?php else: ?>
        <div class="auth-record-list auth-record-list-tight">
          <?php foreach ($recentSessions as $session): ?>
            <?php $status = billing_status_meta((string) ($session['status'] ?? 'pending')); ?>
            <?php $createdAt = format_datetime_ui((string) ($session['created_at'] ?? '')); ?>
            <article class="auth-record-row">
              <div class="auth-record-main">
                <strong><?= e((string) ($session['product_key'] ?? 'supporter_pack')) ?></strong>
                <span><?= e((string) ($session['id'] ?? '')) ?></span>
              </div>
              <div class="auth-record-meta">
                <span class="auth-stat-label"><?= e($page['status']) ?></span>
                <span class="auth-status-badge <?= e($status['class']) ?>"><?= e($status['label']) ?></span>
              </div>
              <div class="auth-record-meta">
                <span class="auth-stat-label"><?= e($page['amount']) ?></span>
                <strong><?= e(format_money_from_cents((int) ($session['amount_cents'] ?? 0), (string) ($session['currency'] ?? 'EUR'))) ?></strong>
              </div>
              <div class="auth-record-meta">
                <span class="auth-stat-label"><?= e($page['customer']) ?></span>
                <span><?= e((string) ($session['customer_email'] ?? '')) ?></span>
              </div>
              <div class="auth-record-meta">
                <span class="auth-stat-label"><?= e($page['created']) ?></span>
                <span><?= e($createdAt) ?></span>
              </div>
              <div class="auth-record-action">
                <?php if (!empty($session['checkout_url'])): ?>
                  <a class="auth-secondary auth-link-button" href="<?= e((string) $session['checkout_url']) ?>"><?= e($page['open']) ?></a>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
        <?php if (count($sessions) > count($recentSessions)): ?>
          <p class="auth-meta-note"><?= e(sprintf($page['showing_latest'], count($recentSessions))) ?></p>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
