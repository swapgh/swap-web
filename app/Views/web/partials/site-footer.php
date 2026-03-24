<?php
use App\Core\Auth;

$homeUrl = page_url('');
$gamesUrl = page_url('#featured-games');
?>
<footer id="contact">
  <div class="footer-content">
    <div class="footer-grid">
      <div class="footer-column" data-footer-section>
        <button type="button" class="footer-section-toggle" aria-expanded="false" aria-controls="footer-panel-main-nav">
          <span class="footer-title"><?= e(t('footer.main_nav')) ?></span>
          <span class="footer-toggle-icon" aria-hidden="true"></span>
        </button>
        <div class="footer-links" id="footer-panel-main-nav" data-footer-panel>
          <a href="<?= e(with_lang($homeUrl)) ?>"><?= e(t('footer.home')) ?></a>
          <a href="<?= e(with_lang($gamesUrl)) ?>"><?= e(t('footer.games')) ?></a>
          <?php if (Auth::check()): ?>
            <a href="<?= e(with_lang(page_url('account'))) ?>"><?= e(t('footer.profile')) ?></a>
            <a href="<?= e(with_lang(page_url('account/characters'))) ?>"><?= e(t('footer.characters')) ?></a>
          <?php else: ?>
            <a href="<?= e(with_lang(page_url('login'))) ?>"><?= e(t('footer.login')) ?></a>
          <?php endif; ?>
        </div>
      </div>

      <div class="footer-column" data-footer-section>
        <button type="button" class="footer-section-toggle" aria-expanded="false" aria-controls="footer-panel-project-links">
          <span class="footer-title"><?= e(t('footer.project_links')) ?></span>
          <span class="footer-toggle-icon" aria-hidden="true"></span>
        </button>
        <div class="footer-links" id="footer-panel-project-links" data-footer-panel>
          <a href="<?= e(with_lang(page_url('projects/swap-rpg'))) ?>"><?= e(t('footer.project')) ?></a>
          <a href="<?= e(with_lang(page_url('store'))) ?>">Store</a>
          <a href="<?= e(asset_url('downloads/demo.zip')) ?>"><?= e(t('footer.demo')) ?></a>
          <a href="<?= e(with_lang(page_url('help'))) ?>"><?= e(t('footer.help')) ?></a>
          <a href="<?= e(with_lang(page_url('contact'))) ?>"><?= e(t('footer.contact')) ?></a>
        </div>
      </div>

      <div class="footer-column footer-optional" data-footer-section>
        <button type="button" class="footer-section-toggle" aria-expanded="false" aria-controls="footer-panel-repositories">
          <span class="footer-title"><?= e(t('footer.repositories')) ?></span>
          <span class="footer-toggle-icon" aria-hidden="true"></span>
        </button>
        <div class="footer-links" id="footer-panel-repositories" data-footer-panel>
          <a href="<?= e($site['github_rpg']) ?>" target="_blank" rel="noopener noreferrer">swap-rpg</a>
          <a href="<?= e($site['github_web']) ?>" target="_blank" rel="noopener noreferrer">swap-web</a>
        </div>
      </div>

      <div class="footer-column" data-footer-section>
        <button type="button" class="footer-section-toggle" aria-expanded="false" aria-controls="footer-panel-legal">
          <span class="footer-title"><?= e(t('footer.legal')) ?></span>
          <span class="footer-toggle-icon" aria-hidden="true"></span>
        </button>
        <div class="footer-links" id="footer-panel-legal" data-footer-panel>
          <a href="<?= e(with_lang(page_url('aviso-legal'))) ?>"><?= e(t('footer.legal_notice')) ?></a>
          <a href="<?= e(with_lang(page_url('privacy'))) ?>"><?= e(t('footer.privacy')) ?></a>
          <a href="<?= e(with_lang(page_url('cookies'))) ?>"><?= e(t('footer.cookies')) ?></a>
          <a href="<?= e(with_lang(page_url('payment-disclaimer'))) ?>"><?= e(t('footer.payment_disclaimer')) ?></a>
          <a href="<?= e(with_lang(page_url('support-terms'))) ?>"><?= e(t('footer.support_terms')) ?></a>
        </div>
      </div>

      <div class="footer-column footer-contact-column" data-footer-section data-footer-default-open>
        <button type="button" class="footer-section-toggle" aria-expanded="true" aria-controls="footer-panel-contact">
          <span class="footer-title"><?= e(t('footer.contact_title')) ?></span>
          <span class="footer-toggle-icon" aria-hidden="true"></span>
        </button>
        <div class="footer-links" id="footer-panel-contact" data-footer-panel>
          <a href="mailto:<?= e($site['contact_email']) ?>"><?= e($site['contact_email']) ?></a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <span><?= e($site['name']) ?> © <?= e((string) date('Y')) ?> · <?= e(t('footer.rights')) ?></span>
    </div>
  </div>
</footer>
<div class="cookie-banner" id="cookie-banner" hidden>
  <div class="cookie-banner-inner">
    <div class="cookie-banner-copy">
      <strong><?= e(t('cookies.banner_title')) ?></strong>
      <p><?= e(t('cookies.banner_body')) ?></p>
    </div>
    <div class="cookie-banner-actions">
      <button type="button" class="btn btn-secondary cookie-banner-button" data-cookie-consent="essential"><?= e(t('cookies.banner_essential')) ?></button>
      <button type="button" class="btn btn-primary cookie-banner-button" data-cookie-consent="accepted"><?= e(t('cookies.banner_accept')) ?></button>
      <a class="btn btn-ghost cookie-banner-link" href="<?= e(with_lang(page_url('cookies'))) ?>"><?= e(t('cookies.banner_more')) ?></a>
    </div>
  </div>
</div>
