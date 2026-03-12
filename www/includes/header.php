<?php
/** @var string $assetBase */
/** @var array $site */

$homeUrl = $assetBase . 'index.php';
$navItems = [
    ['label' => 'Inicio', 'href' => $homeUrl . '#top'],
    ['label' => 'Arquitectura', 'href' => $homeUrl . '#architecture'],
    ['label' => 'Roadmap', 'href' => $homeUrl . '#roadmap'],
    ['label' => 'Galería', 'href' => $homeUrl . '#gallery'],
];
?>
<header id="top">
  <div class="header-inner">
    <div class="logo-wrapper">
      <a href="<?= e($homeUrl) ?>" class="logo-link" aria-label="<?= e($site['name']) ?>">
        <img src="<?= e($assetBase) ?>img/favicon.png" alt="Swap RPG" class="logo-icon">
        <span class="logo-text">SWAP RPG</span>
      </a>
    </div>

    <nav aria-label="Main navigation">
      <ul class="nav-list">
        <?php foreach ($navItems as $item): ?>
          <li><a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a></li>
        <?php endforeach; ?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle">Devlog <i class="fas fa-chevron-down"></i></a>
          <ul class="dropdown-menu">
            <li><a href="<?= e($assetBase) ?>html/hito1.php">Hito 1</a></li>
            <li><a href="<?= e($assetBase) ?>html/hito2.php">Hito 2</a></li>
            <li><a href="<?= e($assetBase) ?>html/hito3.php">Hito 3</a></li>
            <li><a href="<?= e($assetBase) ?>html/hito4.php">Hito 4</a></li>
            <li><a href="<?= e($assetBase) ?>html/hito5.php">Hito 5</a></li>
            <li><a href="<?= e($assetBase) ?>html/hito6.php">Hito 6</a></li>
          </ul>
        </li>

        <li class="nav-cta">
          <a class="nav-btn" href="<?= e($site['github_rpg']) ?>" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-github"></i> swap-rpg
          </a>
        </li>
      </ul>

      <div class="hamburger" id="hamburger" aria-label="Toggle navigation" role="button" tabindex="0">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </nav>
  </div>
</header>

