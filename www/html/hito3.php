<?php
require_once __DIR__ . '/../includes/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hito 3: Cámara y Renderizado Relativo - Swap RPG Devlog</title>
  
  <!-- CSS EXISTENTE -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- NUEVO CSS DE DOCUMENTACIÓN (Layout con Sidebar) -->
  <link rel="stylesheet" href="../css/documentation.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/vs2015.min.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">
</head>

<body>
  <?php require __DIR__ . '/../includes/header.php'; ?>

  <!-- NUEVO LAYOUT: SIDEBAR IZQUIERDO + CONTENIDO -->
  <div class="doc-layout">
    
    <!-- SIDEBAR (Navegación y Descargas) -->
    <aside class="doc-sidebar">
      <!-- Navegación On-Page -->
      <div>
        <h3>En esta sección</h3>
        <ul class="doc-nav-list">
          <li><a href="#intro" class="active"><i class="fas fa-info-circle"></i> Introducción</a></li>
          <li><a href="#tilemanager"><i class="fas fa-map"></i> TileManager.java</a></li>
          <li><a href="#entity"><i class="fas fa-user-astronaut"></i> Entity.java</a></li>
        </ul>
      </div>



      <!-- Navegación entre Hitos -->
      <div>
        <h3>Hitos</h3>
        <ul class="doc-nav-list">
          <li><a href="hito2.php"><i class="fas fa-arrow-left"></i> Anterior: Hito 2</a></li>
          <li><a href="hito4.php">Siguiente: Hito 4 <i class="fas fa-arrow-right"></i></a></li>
          <li><a href="../index.php#hitos">Volver al Inicio</a></li>
        </ul>
      </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="doc-content">
      
      <!-- SECCIÓN DE INTRODUCCIÓN -->
      <section class="milestone-card" id="intro">
        <h1>Hito 3: Cámara y Renderizado Relativo</h1>
        <div class="milestone-meta">
          <span><i class="far fa-calendar"></i> 30 de octubre de 2025</span>
          <span><i class="fas fa-check-circle"></i> Completado</span>
        </div>
        <div class="milestone-desc">
          Implementación del sistema de cámara 2D. En lugar de mover la ventana, movemos todo el contenido 
          (tiles y entidades) en dirección opuesta a la posición del jugador, creando la ilusión de desplazamiento 
          (scrolling).
        </div>

        <h2>Objetivos</h2>
        <ul>
          <li>Calcular el offset de pantalla basado en la posición del jugador.</li>
          <li>Renderizar solo lo que está visible dentro de los límites de la pantalla.</li>
          <li>Aplicar la lógica de cámara tanto a tiles como a entidades.</li>
        </ul>
      </section>

      <!-- SECCIÓN DE CÓDIGO TILE MANAGER -->
      <section class="milestone-card" id="tilemanager" style="margin-top: 40px; border: none; background: transparent; box-shadow: none; padding: 0;">
        
        <h2>TileManager.java (Cámara para Tiles)</h2>
        <p>En cada tile del mapa, calculamos si se debe dibujar y en qué posición de la pantalla.</p>
        <div class="code-wrapper">
          <div class="code-header">
            <span class="code-title">src/tile/TileManager.java - draw()</span>
            <button class="code-toggle" onclick="toggleCode('code-tilemanager')">Expandir</button>
          </div>
          <div class="code-container" id="code-tilemanager">
            <pre><code class="language-java">public void draw(Graphics2D g2) {
    int worldCol = 0;
    int worldRow = 0;
    
    while(worldCol < gp.maxWorldCol && worldRow < gp.maxWorldRow) {
        int tileNum = mapTileNum[worldCol][worldRow];
        int worldX = worldCol * gp.tileSize;
        int worldY = worldRow * gp.tileSize;

        // CÁMARA: La posición en pantalla es la posición en el mundo 
        // menos la posición del jugador más la posición fija del jugador en pantalla.
        int screenX = worldX - gp.player.worldX + gp.player.screenX;
        int screenY = worldY - gp.player.worldY + gp.player.screenY;

        // OPTIMIZACIÓN: Solo dibujar si el tile está dentro de la pantalla visible
        if (worldX + gp.tileSize > gp.player.worldX - gp.player.screenX && 
            worldX - gp.tileSize < gp.player.worldX + gp.player.screenX &&
            worldY + gp.tileSize > gp.player.worldY - gp.player.screenY && 
            worldY - gp.tileSize < gp.player.worldY + gp.player.screenY) {
            
            g2.drawImage(tile[tileNum].image, screenX, screenY, null);
        }
        worldCol++;
        if (worldCol == gp.maxWorldCol) {
            worldCol = 0; 
            worldRow++;
        }
    }
}</code></pre>
          </div>
        </div>

        <!-- SECCIÓN DE CÓDIGO ENTITY -->
        <h2 id="entity">Entity.java (Cámara para Entidades)</h2>
        <p>Todas las entidades (Jugador, NPC, Enemigos) comparten la misma lógica de renderizado en la clase base.</p>
        <div class="code-wrapper">
          <div class="code-header">
            <span class="code-title">src/entity/Entity.java - draw()</span>
            <button class="code-toggle" onclick="toggleCode('code-entity-draw')">Expandir</button>
          </div>
          <div class="code-container" id="code-entity-draw">
            <pre><code class="language-java">public void draw(Graphics2D g2) {
    BufferedImage image = null;
    
    // CÁMARA: Mismo cálculo que los tiles
    int screenX = worldX - gp.player.worldX + gp.player.screenX;
    int screenY = worldY - gp.player.worldY + gp.player.screenY;

    // OPTIMIZACIÓN: Solo dibujar si está en pantalla
    if (worldX + gp.tileSize > gp.player.worldX - gp.player.screenX
            && worldX - gp.tileSize < gp.player.worldX + gp.player.screenX
            && worldY + gp.tileSize > gp.player.worldY - gp.player.screenY
            && worldY - gp.tileSize < gp.player.worldY + gp.player.screenY) {

         switch (direction) {
             case "up": image = (spriteNum == 1) ? up1 : up2; break;
             // ... casos down, left, right
         }

         if (invincible == true) {
             changeAlpha(g2, 0.4F); // Parpadeo si es invencible
         }
         
         g2.drawImage(image, screenX, screenY, gp.tileSize, gp.tileSize, null);
         changeAlpha(g2, 1F); // Reset opacidad
    }
}</code></pre>
          </div>
        </div>

      </section>
    </main>
  </div>

  <?php require __DIR__ . '/../includes/footer.php'; ?>

  <!-- SCRIPTS -->
  <script src="../js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
  <script>hljs.highlightAll();</script>
</body>
</html>
