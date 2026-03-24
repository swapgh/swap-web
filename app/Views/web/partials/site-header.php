<?php
use App\Core\Auth;

$homeUrl = page_url('');
$homeLangUrl = with_lang($homeUrl);
$gamesUrl = with_lang(page_url('#featured-games'));
$downloadUrl = asset_url('downloads/demo.zip');
$supportUrl = with_lang(page_url('help'));
$projectUrl = with_lang(page_url('projects/swap-rpg'));
$storeUrl = with_lang(page_url('store'));
$accountUrl = with_lang(page_url('account'));
$currentRequestUri = (string) ($_SERVER['REQUEST_URI'] ?? $homeUrl);
$langEsUrl = with_lang($currentRequestUri, 'es');
$langEnUrl = with_lang($currentRequestUri, 'en');
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
$settingsCopy = [
  'es' => [
    'button' => 'Ajustes',
    'appearance' => 'Tema',
    'language' => 'Idioma',
    'theme_classic' => 'Classic',
    'theme_moon' => 'Moon',
    'theme_mist' => 'Mist',
    'theme_forest' => 'Forest',
    'theme_light' => 'Light',
  ],
  'en' => [
    'button' => 'Settings',
    'appearance' => 'Theme',
    'language' => 'Language',
    'theme_classic' => 'Classic',
    'theme_moon' => 'Moon',
    'theme_mist' => 'Mist',
    'theme_forest' => 'Forest',
    'theme_light' => 'Light',
  ],
];
$settingsUi = $settingsCopy[$pageLang] ?? $settingsCopy['en'];
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
        <li class="nav-settings nav-dropdown">
          <button type="button" class="nav-settings-btn dropdown-toggle" aria-label="<?= e($settingsUi['button']) ?>" aria-expanded="false" aria-haspopup="true">
            <span class="settings-icon" aria-hidden="true">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h0A1.65 1.65 0 0 0 9.91 3H10a2 2 0 1 1 4 0h.09a1.65 1.65 0 0 0 1 1.51h0a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v0A1.65 1.65 0 0 0 21 9.91H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1.09z"></path></svg>
            </span>
            <span class="settings-label"><?= e($settingsUi['button']) ?></span>
          </button>
          <div class="dropdown-menu dropdown-menu-settings" role="menu">
            <div class="dropdown-section">
              <span class="dropdown-section-title"><?= e($settingsUi['language']) ?></span>
              <div class="language-switcher" role="group" aria-label="<?= e($settingsUi['language']) ?>">
                <a class="lang-link<?= $pageLang === 'es' ? ' active' : '' ?>" href="<?= e($langEsUrl) ?>" role="menuitem"><?= e(t('lang.es')) ?></a>
                <a class="lang-link<?= $pageLang === 'en' ? ' active' : '' ?>" href="<?= e($langEnUrl) ?>" role="menuitem"><?= e(t('lang.en')) ?></a>
              </div>
            </div>
            <div class="dropdown-section">
              <span class="dropdown-section-title"><?= e($settingsUi['appearance']) ?></span>
              <div class="theme-switcher" role="group" aria-label="<?= e($settingsUi['appearance']) ?>">
                <button type="button" class="theme-option" data-theme-value="classic"><?= e($settingsUi['theme_classic']) ?></button>
                <button type="button" class="theme-option" data-theme-value="moon"><?= e($settingsUi['theme_moon']) ?></button>
                <button type="button" class="theme-option" data-theme-value="mist"><?= e($settingsUi['theme_mist']) ?></button>
                <button type="button" class="theme-option" data-theme-value="forest"><?= e($settingsUi['theme_forest']) ?></button>
                <button type="button" class="theme-option" data-theme-value="light"><?= e($settingsUi['theme_light']) ?></button>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-cta nav-dropdown">
          <button type="button" class="nav-btn<?= $isAuthenticated ? ' logged-in' : ' is-guest' ?> dropdown-toggle" aria-expanded="false" aria-haspopup="true">
            <span class="user-icon" aria-hidden="true">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </span>
            <?php if ($isAuthenticated): ?>
              <span class="user-label"><?= e($accountLabel) ?></span>
            <?php else: ?>
              <?= e($accountLabel) ?>
            <?php endif; ?>
            <svg class="chevron" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="dropdown-menu dropdown-menu-account" role="menu">
            <?php if ($isAuthenticated): ?>
              <a href="<?= e($accountUrl) ?>" role="menuitem"><?= e(t('nav.account_settings')) ?></a>
            <?php else: ?>
              <a href="<?= e(with_lang(page_url('login'))) ?>" role="menuitem"><?= e(t('nav.login')) ?></a>
              <a href="<?= e(with_lang(page_url('login'))) ?>" role="menuitem" class="nav-optional"><?= e(t('nav.signup')) ?></a>
            <?php endif; ?>
            <a href="<?= e($supportUrl) ?>" role="menuitem" class="nav-optional"><?= e(t('nav.support')) ?></a>
            <a href="<?= e($storeUrl) ?>" role="menuitem" class="nav-optional"><?= e(t('nav.shop')) ?></a>
            <a href="<?= e($downloadUrl) ?>" role="menuitem"><?= e(t('nav.download')) ?></a>
            <?php if ($isAuthenticated): ?>
              <a href="<?= e($projectUrl) ?>" role="menuitem" class="nav-optional"><?= e(t('nav.project')) ?></a>
              <form action="<?= e(with_lang(page_url('logout'))) ?>" method="post" class="dropdown-form">
                <?= csrf_field() ?>
                <button type="submit" class="dropdown-item"><?= e(t('nav.logout')) ?></button>
              </form>
            <?php endif; ?>
          </div>
        </li>
      </ul>
      <button type="button" class="hamburger" id="hamburger" aria-label="<?= e(t('nav.toggle')) ?>" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </nav>
  </div>
</header>
