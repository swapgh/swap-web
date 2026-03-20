<?php
// Ensure $extraScripts and $inlineScripts are always arrays
$extraScripts = $extraScripts ?? [];  // External JS files to load
$inlineScripts = $inlineScripts ?? []; // Inline JS snippets to execute
?>

<!-- Main JavaScript file for site functionality -->
<script src="<?= e(asset_url('js/main.js')) ?>"></script>

<?php foreach ($extraScripts as $src): ?>
  <?php 
  // Determine if the script is an external URL or a local asset
  $finalSrc = is_external_href((string) $src) ? (string) $src : asset_url((string) $src); 
  ?>
  <!-- Load each extra script -->
  <script src="<?= e($finalSrc) ?>"></script>
<?php endforeach; ?>

<?php foreach ($inlineScripts as $js): ?>
  <!-- Output inline JavaScript safely -->
  <script><?= $js ?></script>
<?php endforeach; ?>

</body>
</html>