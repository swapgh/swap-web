<?php
/** @var string $assetBase */

$extraScripts = $extraScripts ?? [];
$inlineScripts = $inlineScripts ?? [];
?>
<script src="<?= e($assetBase) ?>js/script.js"></script>
<?php foreach ($extraScripts as $src): ?>
  <?php $finalSrc = is_external_href((string)$src) ? (string)$src : $assetBase . ltrim((string)$src, '/'); ?>
  <script src="<?= e($finalSrc) ?>"></script>
<?php endforeach; ?>
<?php foreach ($inlineScripts as $js): ?>
  <script><?= $js ?></script>
<?php endforeach; ?>
</body>
</html>

