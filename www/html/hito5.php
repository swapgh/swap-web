<?php
require_once __DIR__ . '/../includes/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hito 5: Entidades y Enemigos - Swap RPG Devlog</title>
  
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
          <li><a href="#asset"><i class="fas fa-boxes"></i> AssetManager.java</a></li>
          <li><a href="#slime"><i class="fas fa-ghost"></i> Mon_GreenSlime (IA)</a></li>
        </ul>
      </div>


      <div>
        <h3>Hitos</h3>
        <ul class="doc-nav-list">
          <li><a href="hito4.php"><i class="fas fa-arrow-left"></i> Anterior: Hito 4</a></li>
          <li><a href="hito6.php">Siguiente: Hito 6 <i class="fas fa-arrow-right"></i></a></li>
          <li><a href="../index.php#hitos">Volver al Inicio</a></li>
        </ul>
      </div>
    </aside>

    <main class="doc-content">
      <section class="milestone-card" id="intro">
        <h1>Hito 5: Entidades y Enemigos</h1>
        <div class="milestone-meta">
          <span><i class="far fa-calendar"></i> 13 de noviembre de 2025</span>
          <span><i class="fas fa-check-circle"></i> Completado</span>
        </div>
        <div class="milestone-desc">
          Populamos el mundo con vida. Utilizamos la clase <code>AssetManager</code> para instanciar NPCs y Enemigos. 
          Los enemigos poseen Inteligencia Artificial (IA) básica para moverse aleatoriamente.
        </div>

        <h2>Objetivos</h2>
        <ul>
          <li>Crear subclases de <code>Entity</code> para NPCs y Enemigos.</li>
          <li>Implementar un AssetManager para configurar el mundo.</li>
          <li>Programar un comportamiento de movimiento aleatorio (IA simple).</li>
        </ul>
      </section>

      <section class="milestone-card" id="asset" style="margin-top: 40px; border: none; background: transparent; box-shadow: none; padding: 0;">
        
        <h2>AssetManager.java</h2>
        <p>Gestiona los arrays de objetos, NPCs y enemigos, colocándolos en coordenadas <code>worldX</code> específicas.</p>
        <div class="code-wrapper">
          <div class="code-header">
            <span class="code-title">src/manager/AssetManager.java</span>
            <button class="code-toggle" onclick="toggleCode('code-asset')">Expandir</button>
          </div>
          <div class="code-container" id="code-asset">
            <pre><code class="language-java">public class AssetManager {
    GamePanel gp;

    public AssetManager(GamePanel gp) {
        this.gp = gp;
    }

    public void setObject() {
        // Instanciar objetos como puertas, cofres...
        // gp.obj[i] = new Obj_Door(gp);
        // gp.obj[i].worldX = gp.tileSize * 21;
    }

    public void setNpc() {
        int i = 0;
        gp.npc[i] = new Npc_OldMan(gp);
        gp.npc[i].worldX = gp.tileSize * 21;
        gp.npc[i].worldY = gp.tileSize * 22;
        i++;
    }

    public void setEnemy() {
        int i = 0;
        // Colocar varios Green Slimes
        gp.enemy[i] = new Mon_GreenSlime(gp);
        gp.enemy[i].worldX = gp.tileSize * 23;
        gp.enemy[i].worldY = gp.tileSize * 36;
        i++;
        gp.enemy[i] = new Mon_GreenSlime(gp);
        gp.enemy[i].worldX = gp.tileSize * 23;
        gp.enemy[i].worldY = gp.tileSize * 37;
        i++;
        // ... más enemigos
    }
}</code></pre>
          </div>
        </div>

        <h2 id="slime">Mon_GreenSlime.java (IA del Enemigo)</h2>
        <p>El enemigo utiliza un contador <code>aiLockMove</code> para cambiar dirección periódicamente de forma aleatoria.</p>
        <div class="code-wrapper">
          <div class="code-header">
            <span class="code-title">src/enemy/Mon_GreenSlime.java - setAction()</span>
            <button class="code-toggle" onclick="toggleCode('code-slime')">Expandir</button>
          </div>
          <div class="code-container" id="code-slime">
            <pre><code class="language-java">public class Mon_GreenSlime extends Entity {
    public Mon_GreenSlime(GamePanel gp) {
        super(gp);
        name = "Green Slime";
        speed = 1; // Velocidad más lenta que el jugador
        maxLife = 4;
        getImage(); // Cargar sprites
    }

    public void setAction() {
        // Incrementar contador de IA
        aiLockMove++;
        
        // Cada 200 frames, tomar una decisión
        if (aiLockMove == 200) {
            // Generar número aleatorio entre 1 y 100
            int u = UtilityTool.randomNumber(1, 100);

            if (u <= 25) { direction = "up"; }
            else if (u > 25 && u <= 50) { direction = "down"; }
            else if (u > 50 && u < 75) { direction = "left"; }
            else if (u > 75 && u <= 100) { direction = "right"; }
            
            aiLockMove = 0; // Resetear contador
        }
    }
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
