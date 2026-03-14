<?php
$extraScripts = $extraScripts ?? [];
$inlineScripts = $inlineScripts ?? [];
?>
<script src="<?= e(asset_url('js/main.js')) ?>"></script>
<?php foreach ($extraScripts as $src): ?>
  <?php $finalSrc = is_external_href((string) $src) ? (string) $src : asset_url((string) $src); ?>
  <script src="<?= e($finalSrc) ?>"></script>
<?php endforeach; ?>
<?php foreach ($inlineScripts as $js): ?>
  <script><?= $js ?></script>
<?php endforeach; ?>
</body>
</html>
