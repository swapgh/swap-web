<?php
/** @var string $assetBase */
/** @var array $site */

$homeUrl = $assetBase . 'index.php';
?>
<footer id="contact">
  <div class="footer-content">
    <div class="footer-top">
      <div class="footer-links">
        <a href="<?= e($homeUrl) ?>#architecture">Arquitectura</a>
        <a href="<?= e($homeUrl) ?>#roadmap">Roadmap</a>
        <a href="<?= e($homeUrl) ?>#gallery">Galería</a>
        <a href="mailto:<?= e($site['contact_email']) ?>">Contacto</a>
      </div>
      <div class="footer-links">
        <a href="<?= e($site['github_rpg']) ?>" target="_blank" rel="noopener noreferrer">swap-rpg</a>
        <a href="<?= e($site['github_web']) ?>" target="_blank" rel="noopener noreferrer">swap-web</a>
        <a href="<?= e($assetBase) ?>downloads/Demo.zip"><i class="fas fa-download"></i> Demo</a>
      </div>
    </div>

    <div class="footer-bottom">
      <span><?= e($site['name']) ?> © <?= e((string)date('Y')) ?></span>
    </div>
  </div>
</footer>

