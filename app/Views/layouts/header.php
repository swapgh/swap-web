<?php
use App\Core\Auth;

$homeUrl = page_url('');
$homeLangUrl = with_lang($homeUrl);
$navItems = [
    ['label' => t('nav.home'), 'href' => $homeLangUrl],
    ['label' => t('nav.login'), 'href' => with_lang(page_url('login'))],
];

if (Auth::check()) {
    $navItems[1] = ['label' => 'Profile', 'href' => with_lang(page_url('profile'))];
}
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
        <li class="dropdown">
          <button type="button" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
            <?= e(t('nav.devlog')) ?> <i class="fas fa-chevron-down" aria-hidden="true"></i>
          </button>
          <ul class="dropdown-menu">
            <?php for ($i = 1; $i <= 6; $i++): ?>
              <li><a href="<?= e(with_lang(page_url('devlog/hito' . $i))) ?>">Hito <?= e((string) $i) ?></a></li>
            <?php endfor; ?>
          </ul>
        </li>
        <li class="nav-cta">
          <a class="nav-btn" href="<?= e($site['github_rpg']) ?>" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-github" aria-hidden="true" focusable="false"></i> <?= e(t('nav.github')) ?>
          </a>
        </li>
        <?php if (Auth::check()): ?>
          <li><a href="<?= e(with_lang(page_url('characters'))) ?>">Characters</a></li>
          <li><a href="<?= e(with_lang(page_url('logout'))) ?>">Logout</a></li>
        <?php endif; ?>
        <li class="header-lang" aria-label="<?= e(t('lang.label')) ?>">
          <a class="lang-link<?= $pageLang === 'es' ? ' active' : '' ?>" href="<?= e(with_lang($_SERVER['REQUEST_URI'] ?? $homeUrl, 'es')) ?>"><?= e(t('lang.es')) ?></a>
          <a class="lang-link<?= $pageLang === 'en' ? ' active' : '' ?>" href="<?= e(with_lang($_SERVER['REQUEST_URI'] ?? $homeUrl, 'en')) ?>"><?= e(t('lang.en')) ?></a>
        </li>
      </ul>
      <button type="button" class="hamburger" id="hamburger" aria-label="<?= e(t('nav.toggle')) ?>" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </nav>
  </div>
</header>
