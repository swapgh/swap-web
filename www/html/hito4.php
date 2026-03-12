<?php
require_once __DIR__ . '/../includes/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hito 4: Sistema de Colisiones - Swap RPG Devlog</title>
  
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
          <li><a href="#collision"><i class="fas fa-bolt"></i> CollisionManager.java</a></li>
          <li><a href="#entity"><i class="fas fa-cube"></i> Entity (SolidArea)</a></li>
        </ul>
      </div>


      <div>
        <h3>Hitos</h3>
        <ul class="doc-nav-list">
          <li><a href="hito3.php"><i class="fas fa-arrow-left"></i> Anterior: Hito 3</a></li>
          <li><a href="hito5.php">Siguiente: Hito 5 <i class="fas fa-arrow-right"></i></a></li>
          <li><a href="../index.php#hitos">Volver al Inicio</a></li>
        </ul>
      </div>
    </aside>

    <main class="doc-content">
      <section class="milestone-card" id="intro">
        <h1>Hito 4: Sistema de Colisiones</h1>
        <div class="milestone-meta">
          <span><i class="far fa-calendar"></i> 6 de noviembre de 2025</span>
          <span><i class="fas fa-check-circle"></i> Completado</span>
        </div>
        <div class="milestone-desc">
          Implementación de colisiones precisas usando rectángulos de colisión (<code>solidArea</code>). 
          El sistema impide que el jugador atraviese muros, agua o rocas, y detecta el contacto con otras entidades.
        </div>

        <h2>Objetivos</h2>
        <ul>
          <li>Definir áreas de colisión personalizadas para cada entidad.</li>
          <li>Verificar colisiones con el mapa (<code>checkTile</code>).</li>
          <li>Verificar colisiones con objetos y NPCs (<code>checkEntity</code>).</li>
          <li>Detener el movimiento cuando se detecta una colisión.</li>
        </ul>
      </section>

      <section class="milestone-card" id="collision" style="margin-top: 40px; border: none; background: transparent; box-shadow: none; padding: 0;">
        
        <h2>CollisionManager.java (checkTile)</h2>
        <p>Convierte la posición en píxeles a coordenadas de la matriz (columnas y filas) y verifica la propiedad <code>.collision</code> del tile.</p>
        <div class="code-wrapper">
          <div class="code-header">
            <span class="code-title">src/manager/CollisionManager.java - checkTile()</span>
            <button class="code-toggle" onclick="toggleCode('code-collision')">Expandir</button>
          </div>
          <div class="code-container" id="code-collision">
            <pre><code class="language-java">public void checkTile(Entity entity) {
    // 1. Calcular las coordenadas de la esquina del hitbox de la entidad
    int entityLeftWorldX = entity.worldX + entity.solidArea.x;
    int entityRightWorldX = entity.worldX + entity.solidArea.x + entity.solidArea.width;
    int entityTopWorldY = entity.worldY + entity.solidArea.y;
    int entityBottomWorldY = entity.worldY + entity.solidArea.y + entity.solidArea.height;

    // 2. Convertir píxeles a índices de tiles
    int entityLeftCol = entityLeftWorldX / gp.tileSize;
    int entityRightCol = entityRightWorldX / gp.tileSize;
    int entityTopRow = entityTopWorldY / gp.tileSize;
    int entityBottomRow = entityBottomWorldY / gp.tileSize;

    int tileNum1, tileNum2;

    switch (entity.direction) {
        case "up":
            // Predecir la siguiente fila hacia arriba
            entityTopRow = (entityTopWorldY - entity.speed) / gp.tileSize;
            tileNum1 = gp.tileM.mapTileNum[entityLeftCol][entityTopRow];
            tileNum2 = gp.tileM.mapTileNum[entityRightCol][entityTopRow];
            
            // Verificar propiedad 'collision' en TileManager
            if (gp.tileM.tile[tileNum1].collision == true || 
                gp.tileM.tile[tileNum2].collision == true) {
                entity.collisionOn = true;
            }
            break;
        // ... casos down, left, right
    }
}</code></pre>
          </div>
        </div>
            
        <h2 id="entity">Entity.java (SolidArea)</h2>
        <p>Las entidades no ocupan todo el tile (48x48), sino una parte más pequeña para evitar chocar con el aire.</p>
        <div class="code-wrapper">
          <div class="code-header">
            <span class="code-title">src/entity/Entity.java - Declaración</span>
            <button class="code-toggle" onclick="toggleCode('code-solidarea')">Expandir</button>
          </div>
          <div class="code-container" id="code-solidarea">
            <pre><code class="language-java">public class Entity {
    // Área de colisión (Hitbox)
    public Rectangle solidArea = new Rectangle(0, 0, 48, 48);
    
    // Valores por defecto para resetear el hitbox después de una comprobación
    public int solidAreaDefaultX = 0;
    public int solidAreaDefaultY = 0;

    // Ejemplo de personalización en Mon_GreenSlime
    // solidArea.x = 3;
    // solidArea.y = 18; // Hitbox más pequeño centrado abajo
}</code></pre>
          </div>
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
