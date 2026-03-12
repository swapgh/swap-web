<?php
require_once __DIR__ . '/includes/bootstrap.php';

http_response_code(404);
$pageLang = 'es';
$pageTitle = '404 - Página no encontrada';
$pageDescription = 'Error 404 - Página no encontrada.';

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>

<section class="section section-error" aria-labelledby="error-title">
  <div class="container">
    <div class="error-card">
      <div class="error-code">404</div>
      <h2 id="error-title">Página no encontrada</h2>
      <p>
        No existe la URL que has pedido. Puede que se haya movido, renombrado o que nunca haya existido.
      </p>

      <div class="hero-actions">
        <a class="btn btn-primary" href="<?= e($assetBase) ?>index.php"><i class="fas fa-home"></i> Volver al inicio</a>
        <a class="btn btn-ghost" href="javascript:history.back()"><i class="fas fa-arrow-left"></i> Atrás</a>
        <a class="btn btn-ghost" href="<?= e($assetBase) ?>downloads/Demo.zip"><i class="fas fa-download"></i> Descargar demo</a>
      </div>

      <p class="error-help">
        Contacto: <a href="mailto:<?= e($site['contact_email']) ?>"><?= e($site['contact_email']) ?></a>
      </p>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
?>