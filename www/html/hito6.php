<?php
require_once __DIR__ . '/../includes/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hito 6: UI, Combate y Feedback - Swap RPG Devlog</title>
  
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/documentation.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/vs2015.min.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">
</head>

<body>
  <?php require __DIR__ . '/../includes/header.php'; ?>

  <div class="doc-layout">
    <aside class="doc-sidebar">
      <div>
        <h3>En esta sección</h3>
        <ul class="doc-nav-list">
          <li><a href="#intro" class="active"><i class="fas fa-info-circle"></i> Introducción</a></li>
          <li><a href="#ui"><i class="fas fa-heart"></i> UI (Vida)</a></li>
          <li><a href="#attack"><i class="fas fa-fist-raised"></i> Player (Ataque)</a></li>
        </ul>
      </div>


      <div>
        <h3>Hitos</h3>
        <ul class="doc-nav-list">
          <li><a href="hito5.php"><i class="fas fa-arrow-left"></i> Anterior: Hito 5</a></li>
          <li><a href="../index.php#hitos"><i class="fas fa-home"></i> Volver al Inicio</a></li>
        </ul>
      </div>
    </aside>

    <main class="doc-content">
      <section class="milestone-card" id="intro">
        <h1>Hito 6: UI, Combate y Feedback Visual</h1>
        <div class="milestone-meta">
          <span><i class="far fa-calendar"></i> 20 de noviembre de 2025</span>
          <span><i class="fas fa-check-circle"></i> Completado</span>
        </div>
        <div class="milestone-desc">
          En este hito final, damos vida al juego con interfaz de usuario (UI), combate, sonidos y efectos visuales 
          como el parpadeo al recibir daño y las animaciones de ataque.
        </div>

        <h2>Objetivos</h2>
        <ul>
          <li>Dibujar la barra de vida (Hearts) en pantalla.</li>
          <li>Implementar el sistema de ataque del jugador.</li>
          <li>Gestionar la invencibilidad temporal tras recibir daño.</li>
          <li>Mostrar diálogos y estadísticas.</li>
        </ul>
      </section>

      <section class="milestone-card" id="ui" style="margin-top: 40px; border: none; background: transparent; box-shadow: none; padding: 0;">
        
        <h2>UI.java (Barra de Vida)</h2>
        <p>La clase <code>UI</code> dibuja la vida del jugador en la esquina superior izquierda usando sprites de corazones.</p>
        <div class="code-wrapper">
          <div class="code-header">
            <span class="code-title">src/main/UI.java - drawPlayerLife()</span>
            <button class="code-toggle" onclick="toggleCode('code-ui-life')">Expandir</button>
          </div>
          <div class="code-container" id="code-ui-life">
            <pre><code class="language-java">public void drawPlayerLife() {
    int x = gp.tileSize/2;
    int y = gp.tileSize/2;
    int i = 0;

    // Dibujar corazón vacío para la vida máxima
    while (i < gp.player.maxLife/2) {
        g2.drawImage(heart_blank, x, y, null);
        i++;
        x += gp.tileSize;
    }

    // Dibujar corazón medio (half) si es impar, y lleno (full) si es par
    x = gp.tileSize/2; y = gp.tileSize/2; i = 0;
    while (i < gp.player.life) {
        g2.drawImage(heart_half, x, y, null);
        i++;
        if (i < gp.player.life) {
            g2.drawImage(heart_full, x, y, null);
        }
        i++;
        x += gp.tileSize;
    }
}</code></pre>
          </div>
        </div>

        <h2 id="attack">Player.java (Sistema de Ataque)</h2>
        <p>Cuando se pulsa Enter/E, se activa el estado <code>attacking</code>, cambiando los sprites del jugador y verificando colisiones con enemigos.</p>
        <div class="code-wrapper">
          <div class="code-header">
            <span class="code-title">src/entity/Player.java - attacking()</span>
            <button class="code-toggle" onclick="toggleCode('code-player-attack')">Expandir</button>
          </div>
          <div class="code-container" id="code-player-attack">
            <pre><code class="language-java">public void attacking() {
    spriteCounter++;
    if (spriteCounter <= 5) {
        spriteNum = 1;
    }
    if (spriteCounter > 5 && spriteCounter <= 25) {
        spriteNum = 2;
        
        // MOVIMIENTO TEMPORAL DEL HITBOX DE ATAQUE
        int currentWorldX = worldX;
        int currentWorldY = worldY;
        int solidAreaWidth = solidArea.width;
        int solidAreaHeight = solidArea.height;
        
        switch(direction) {
            case "up": worldY -= attackArea.height; break;
            case "down": worldY += attackArea.height; break;
            case "left": worldX -= attackArea.width; break;
            case "right": worldX += attackArea.width; break;
        }
        
        // EL HITBOX DEL JUGADOR SE VUELVE EL ÁREA DE ATAQUE
        solidArea.width = attackArea.width;
        solidArea.height = attackArea.height;
        
        int enemyIndex = gp.cManager.checkEntity(this, gp.enemy);
        damageEnemy(enemyIndex);
        
        // RESTAURAR POSICIÓN Y ÁREA
        worldX = currentWorldX;
        worldY = currentWorldY;
        solidArea.width = solidAreaWidth;
        solidArea.height = solidAreaHeight;
    }
    if (spriteCounter > 25) {
        spriteNum = 1;
        spriteCounter = 0;
        attacking = false;
    }
}</code></pre>
          </div>
        </div>
        
        <div class="result-visual">
            <img src="../img/square_hito4.png" alt="Resultado del Hito 6" class="result-image">
            <p style="color: #94a3b8; margin-top: 10px; font-style: italic;">Figura 1: Barra de vida y combate activo</p>
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
