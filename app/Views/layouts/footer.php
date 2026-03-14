<?php $homeUrl = page_url(''); ?>
<footer id="contact">
  <div class="footer-content">
    <div class="footer-top">
      <div class="footer-links">
        <a href="<?= e(with_lang($homeUrl . '#architecture')) ?>"><?= e(t('footer.architecture')) ?></a>
        <a href="<?= e(with_lang($homeUrl . '#devlog')) ?>"><?= e(t('footer.devlog')) ?></a>
        <a href="<?= e(with_lang($homeUrl . '#gallery')) ?>"><?= e(t('footer.gallery')) ?></a>
        <a href="mailto:<?= e($site['contact_email']) ?>"><?= e(t('footer.contact')) ?></a>
      </div>
      <div class="footer-links">
        <a href="<?= e($site['github_rpg']) ?>" target="_blank" rel="noopener noreferrer">swap-rpg</a>
        <a href="<?= e($site['github_web']) ?>" target="_blank" rel="noopener noreferrer">swap-web</a>
        <a href="<?= e(asset_url('downloads/demo.zip')) ?>"><i class="fas fa-download"></i> <?= e(t('footer.demo')) ?></a>
      </div>
    </div>
    <div class="footer-bottom">
      <span><?= e($site['name']) ?> © <?= e((string) date('Y')) ?></span>
    </div>
  </div>
</footer>
