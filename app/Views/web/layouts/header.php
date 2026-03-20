<?php
use App\Core\Auth;

$homeUrl = page_url('');
$homeLangUrl = with_lang($homeUrl);
$gamesUrl = with_lang(page_url('#featured-games'));
$downloadUrl = asset_url('downloads/demo.zip');
$supportUrl = with_lang(page_url('help'));
$projectUrl = with_lang(page_url('projects/swap-rpg'));
$isAuthenticated = Auth::check();
$currentUser = Auth::user();
$accountLabel = t('nav.account');
if ($isAuthenticated && is_array($currentUser)) {
  $rawName = trim((string) ($currentUser['name'] ?? ''));
  $shortName = $rawName !== '' ? strtok($rawName, " \t\n\r\0\x0B") : '';
  $accountLabel = $shortName !== '' ? ucfirst($shortName) : t('nav.account');
}
$navItems = [
  ['label' => t('nav.home'), 'href' => $homeLangUrl],
  ['label' => t('nav.games'), 'href' => $gamesUrl],
];
?>
<header id="top">
  <div class="header-inner">
    <div class="logo-wrapper">
      <a href="<?= e($homeLangUrl) ?>" class="logo-link" aria-label="<?= e($site['name']) ?>">
        <img src="<?= e(asset_url('images/favicons/favicon.png')) ?>" alt="Swap" class="logo-icon">
        <span class="logo-text">SWAP</span>
      </a>
    </div>

    <nav aria-label="Main navigation">
      <ul class="nav-list">
        <?php foreach ($navItems as $item): ?>
          <li><a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a></li>
        <?php endforeach; ?>
        <li class="nav-cta nav-dropdown">
          <button
            type="button"
            class="nav-btn<?= $isAuthenticated ? ' logged-in' : ' is-guest' ?> dropdown-toggle"
            aria-expanded="false"
            aria-haspopup="true">
            <span class="user-icon" aria-hidden="true">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
              </svg>
            </span>
            <?php if ($isAuthenticated): ?>
              <span class="user-label"><?= e($accountLabel) ?></span>
            <?php else: ?>
              <?= e($accountLabel) ?>
            <?php endif; ?>
            <svg class="chevron" width="11" height="11" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </button>
          <div class="dropdown-menu dropdown-menu-account" role="menu">
            <?php if ($isAuthenticated): ?>
              <a href="<?= e(with_lang(page_url('profile'))) ?>" role="menuitem">
                <?= e(t('nav.account_settings')) ?>
              </a>
            <?php else: ?>
              <a href="<?= e(with_lang(page_url('login'))) ?>" role="menuitem">
                <?= e(t('nav.login')) ?>
              </a>
              <a href="<?= e(with_lang(page_url('login'))) ?>" role="menuitem">
                <?= e(t('nav.signup')) ?>
              </a>
            <?php endif; ?>
            <a href="<?= e($supportUrl) ?>" role="menuitem">
              <?= e(t('nav.support')) ?>
            </a>
            <button type="button" class="dropdown-item disabled" disabled>
              <?= e(t('nav.shop')) ?>
            </button>
            <a href="<?= e($downloadUrl) ?>" role="menuitem">
              <?= e(t('nav.download')) ?>
            </a>
            <?php if ($isAuthenticated): ?>
              <a href="<?= e($projectUrl) ?>" role="menuitem">
                <?= e(t('nav.project')) ?>
              </a>
              <form action="<?= e(with_lang(page_url('logout'))) ?>" method="post" class="dropdown-form">
                <?= csrf_field() ?>
                <button type="submit" class="dropdown-item">
                  <?= e(t('nav.logout')) ?>
                </button>
              </form>
            <?php endif; ?>
          </div>
        </li>
        <li class="header-lang" aria-label="<?= e(t('lang.label')) ?>">
          <a class="lang-link<?= $pageLang === 'es' ? ' active' : '' ?>"
            href="<?= e(with_lang($_SERVER['REQUEST_URI'] ?? $homeUrl, 'es')) ?>"><?= e(t('lang.es')) ?></a>
          <a class="lang-link<?= $pageLang === 'en' ? ' active' : '' ?>"
            href="<?= e(with_lang($_SERVER['REQUEST_URI'] ?? $homeUrl, 'en')) ?>"><?= e(t('lang.en')) ?></a>
        </li>
      </ul>
      <button type="button" class="hamburger" id="hamburger" aria-label="<?= e(t('nav.toggle')) ?>"
        aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </nav>
  </div>
</header>