<?php
$extraScripts = $extraScripts ?? [];
$inlineScripts = $inlineScripts ?? [];
$bootstrapScripts = [
    'js/modules/theme.js',
    'js/modules/cookie-consent.js',
    'js/modules/dropdowns.js',
    'js/modules/mobile-nav.js',
    'js/modules/code-toggle.js',
    'js/modules/lightbox.js',
    'js/modules/footer-accordion.js',
    'js/modules/account-nav.js',
    'js/app.js',
];
?>
<?php foreach ($bootstrapScripts as $src): ?>
  <script src="<?= e(asset_url($src)) ?>"></script>
<?php endforeach; ?>
<?php foreach ($extraScripts as $src): ?>
  <?php $finalSrc = is_external_href((string) $src) ? (string) $src : asset_url((string) $src); ?>
  <script src="<?= e($finalSrc) ?>"></script>
<?php endforeach; ?>
<?php foreach ($inlineScripts as $js): ?>
  <script><?= $js ?></script>
<?php endforeach; ?>
</body>
</html>
