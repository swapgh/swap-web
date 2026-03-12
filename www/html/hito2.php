<?php
require_once __DIR__ . '/../includes/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hito 2: Control del Jugador y Estados - Swap RPG Devlog</title>

  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/documentation.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/vs2015.min.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">
</head>

<body>

<?php require __DIR__ . '/../includes/header.php'; ?>

<div class="doc-layout">

  <!-- SIDEBAR -->
  <aside class="doc-sidebar">

    <div>
      <h3>En esta sección</h3>
      <ul class="doc-nav-list">
        <li><a href="#intro" class="active"><i class="fas fa-info-circle"></i> Introducción</a></li>
        <li><a href="#keymanager"><i class="fas fa-keyboard"></i> KeyManager</a></li>
        <li><a href="#player"><i class="fas fa-user"></i> Player</a></li>
      </ul>
    </div>


    <div>
      <h3>Hitos</h3>
      <ul class="doc-nav-list">
        <li><a href="hito1.php"><i class="fas fa-arrow-left"></i> Hito 1</a></li>
        <li><a href="hito3.php">Siguiente: Hito 3 <i class="fas fa-arrow-right"></i></a></li>
      </ul>
    </div>

  </aside>

  <!-- CONTENIDO -->
  <main class="doc-content">

    <section class="milestone-card" id="intro">
      <h1>Hito 2: Control del Jugador y Estados</h1>

      <div class="milestone-meta">
        <span><i class="far fa-calendar"></i> 23 de octubre de 2025</span>
        <span><i class="fas fa-check-circle"></i> Completado</span>
      </div>

      <div class="milestone-desc">
        Implementación del sistema de entrada mediante <code>KeyManager</code> y la lógica
        de movimiento, animación y estados del jugador.
      </div>

      <h2>Objetivos</h2>
      <ul>
        <li>Detectar input con teclado (WASD).</li>
        <li>Actualizar posición del jugador.</li>
        <li>Cambiar sprites según dirección.</li>
        <li>Gestionar estados de juego (Play / Pause).</li>
      </ul>
    </section>

    <section class="milestone-card" id="keymanager" style="margin-top:40px;">
      <h2>KeyManager.java</h2>
      <p>Gestiona los eventos del teclado y controla los estados del input.</p>

      <div class="code-wrapper">
        <div class="code-header">
          <span class="code-title">src/manager/KeyManager.java</span>
          <button class="code-toggle" onclick="toggleCode('code-keymanager')">Expandir</button>
        </div>
        <div class="code-container" id="code-keymanager">
<pre><code class="language-java">@Override
public void keyPressed(KeyEvent e) {
    int code = e.getKeyCode();

    if (gp.gameState == gp.playState) {
        if (code == KeyEvent.VK_W) upPressed = true;
        if (code == KeyEvent.VK_S) downPressed = true;
        if (code == KeyEvent.VK_A) leftPressed = true;
        if (code == KeyEvent.VK_D) rightPressed = true;

        if (code == KeyEvent.VK_P) gp.gameState = gp.pauseState;
    }
}</code></pre>
        </div>
      </div>
    </section>

    <section class="milestone-card" id="player" style="margin-top:40px;">
      <h2>Player.java – Movimiento</h2>

      <div class="code-wrapper">
        <div class="code-header">
          <span class="code-title">src/entity/Player.java - update()</span>
          <button class="code-toggle" onclick="toggleCode('code-player')">Expandir</button>
        </div>
        <div class="code-container" id="code-player">
<pre><code class="language-java">public void update() {

    if (km.upPressed) direction = "up";
    else if (km.downPressed) direction = "down";
    else if (km.leftPressed) direction = "left";
    else if (km.rightPressed) direction = "right";

    collisionOn = false;
    gp.cManager.checkTile(this);

    if (!collisionOn) {
        switch(direction) {
            case "up": worldY -= speed; break;
            case "down": worldY += speed; break;
            case "left": worldX -= speed; break;
            case "right": worldX += speed; break;
        }
    }
}</code></pre>
        </div>
      </div>

      <div class="result-visual">
        <img src="../img/hito1-demo.gif" alt="Resultado Hito 2">
      </div>
    </section>

  </main>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script src="../js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
<script>hljs.highlightAll();</script>

</body>
</html>
