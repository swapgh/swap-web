<?php
require_once __DIR__ . '/../includes/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>[MILESTONE_TITLE] - Swap RPG Devlog</title>

  <!-- Main CSS for the overall site -->
  <link rel="stylesheet" href="../css/style.css">

  <!-- Documentation-specific CSS -->
  <link rel="stylesheet" href="../css/documentation.css">

  <!-- Other external CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/vs2015.min.css">

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">
  <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
</head>

<body>
  <!-- HEADER PLACEHOLDER -->
  <?php require __DIR__ . '/../includes/header.php'; ?>

  <!-- MAIN CONTENT -->
  <main class="documentation-content">
    <div class="container">
      <section class="milestone-header">
        <h1>[MILESTONE_TITLE]</h1>
        <div class="milestone-meta">
          <span class="milestone-date"><i class="far fa-calendar"></i> [MILESTONE_DATE]</span>
          <span class="milestone-status"><i class="fas fa-check-circle"></i> [MILESTONE_STATUS]</span>
        </div>
        <div class="milestone-description">
          <p>[MILESTONE_DESCRIPTION]</p>
        </div>
      </section>

      <section class="milestone-content">
        <div class="content-grid">
          <div class="content-main">
            <!-- Main content goes here -->
          </div>

          <div class="content-sidebar">
            <div class="sidebar-section">
              <h3><i class="fas fa-code-branch"></i> Código Fuente</h3>
              <p>Puedes descargar el código completo de este hito:</p>
              <a href="../downloads/[MILESTONE_CODE_FILE]" class="btn">
                <i class="fas fa-download"></i> Descargar código
              </a>
            </div>

            <div class="sidebar-section">
              <h3><i class="fas fa-tasks"></i> Próximos Pasos</h3>
              <ul>
                <li><a href="[NEXT_MILESTONE_LINK]"><i class="fas fa-arrow-right"></i> [NEXT_MILESTONE_TITLE]</a></li>
                <!-- Add more milestones as needed -->
              </ul>
            </div>

            <div class="sidebar-section">
              <h3><i class="fas fa-book"></i> Recursos</h3>
              <ul>
                <li><a href="[RESOURCE_LINK]" target="_blank"><i class="fas fa-external-link-alt"></i>
                    [RESOURCE_TITLE]</a></li>
                <!-- Add more resources as needed -->
              </ul>
            </div>
          </div>
        </div>
      </section>

      <section class="milestone-demo">
        <h2><i class="fas fa-play-circle"></i> Demostración</h2>
        <div class="demo-container">
          <div class="demo-placeholder">
            <img src="../img/[MILESTONE_DEMO_IMAGE]" alt="Demostración del [MILESTONE_TITLE]" class="demo-image">
            <p class="demo-caption">Demostración de [MILESTONE_TITLE]</p>
          </div>
        </div>
      </section>
    </div>
  </main>

  <!-- FOOTER PLACEHOLDER -->
  <?php require __DIR__ . '/../includes/footer.php'; ?>

  <!-- Scripts -->
  <script src="../js/script.js"></script>
  <!-- Code highlighting JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
  <script>hljs.highlightAll();</script>
</body>

</html>
