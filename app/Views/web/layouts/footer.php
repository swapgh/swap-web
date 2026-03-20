<?php
// Import the Auth class for checking user login status
use App\Core\Auth;

// Generate URLs for home and featured games sections
$homeUrl = page_url('');             // Homepage URL
$gamesUrl = page_url('#featured-games'); // Anchor link to featured games
?>
<footer id="contact">
  <div class="footer-content">
    <div class="footer-grid">

      <!-- =======================
           Main Navigation Links
           ======================= -->
      <div class="footer-column">
        <span class="footer-title"><?= e(t('footer.main_nav')) ?></span> <!-- Column title -->
        <div class="footer-links">
          <!-- Always visible links -->
          <a href="<?= e(with_lang($homeUrl)) ?>"><?= e(t('footer.home')) ?></a>
          <a href="<?= e(with_lang($gamesUrl)) ?>"><?= e(t('footer.games')) ?></a>

          <?php if (Auth::check()): ?>
            <!-- Links visible only for logged-in users -->
            <a href="<?= e(with_lang(page_url('profile'))) ?>"><?= e(t('footer.profile')) ?></a>
            <a href="<?= e(with_lang(page_url('characters'))) ?>"><?= e(t('footer.characters')) ?></a>
          <?php else: ?>
            <!-- Link visible only for guests -->
            <a href="<?= e(with_lang(page_url('login'))) ?>"><?= e(t('footer.login')) ?></a>
          <?php endif; ?>
        </div>
      </div>

      <!-- =======================
           Project Links
           ======================= -->
      <div class="footer-column">
        <span class="footer-title"><?= e(t('footer.project_links')) ?></span>
        <div class="footer-links">
          <a href="<?= e(with_lang(page_url('projects/swap-rpg'))) ?>"><?= e(t('footer.project')) ?></a>
          <a href="<?= e(asset_url('downloads/demo.zip')) ?>"><?= e(t('footer.demo')) ?></a>
          <a href="<?= e(with_lang(page_url('help'))) ?>"><?= e(t('footer.help')) ?></a>
          <a href="<?= e(with_lang(page_url('contact'))) ?>"><?= e(t('footer.contact')) ?></a>
        </div>
      </div>

      <!-- =======================
           Code Repositories
           ======================= -->
      <div class="footer-column footer-optional">
        <span class="footer-title"><?= e(t('footer.repositories')) ?></span>
        <div class="footer-links">
          <!-- External links to GitHub repositories -->
          <a href="<?= e($site['github_rpg']) ?>" target="_blank" rel="noopener noreferrer">swap-rpg</a>
          <a href="<?= e($site['github_web']) ?>" target="_blank" rel="noopener noreferrer">swap-web</a>
        </div>
      </div>

      <!-- =======================
           Legal Information
           ======================= -->
      <div class="footer-column footer-optional">
        <span class="footer-title"><?= e(t('footer.legal')) ?></span>
        <div class="footer-links">
          <a href="<?= e(with_lang(page_url('privacy'))) ?>"><?= e(t('footer.privacy')) ?></a>
          <a href="<?= e(with_lang(page_url('cookies'))) ?>"><?= e(t('footer.cookies')) ?></a>
        </div>
      </div>

      <!-- =======================
           Contact Information
           ======================= -->
      <div class="footer-column footer-contact-column">
        <span class="footer-title"><?= e(t('footer.contact_title')) ?></span>
        <div class="footer-links">
          <!-- Email link -->
          <a href="mailto:<?= e($site['contact_email']) ?>">
            <?= e(t('footer.email')) ?>: <?= e($site['contact_email']) ?>
          </a>
        </div>
      </div>
    </div>

    <!-- =======================
         Footer Bottom Bar
         ======================= -->
    <div class="footer-bottom">
      <span>
        <?= e($site['name']) ?> © <?= e((string) date('Y')) ?> · <?= e(t('footer.rights')) ?>
      </span>
    </div>
  </div>
</footer>
