<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageLang = 'es';
$pageTitle = 'Swap RPG - Portfolio';
$pageDescription = 'Portfolio/promo page for Swap RPG: ECS architecture, roadmap, and media.';

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>

<section class="carousel" aria-label="Swap RPG highlights">
  <div class="carousel-inner">
    <div class="carousel-slides" id="slides">
      <div class="slide">
        <div class="slide-content">
          <img src="<?= e($assetBase) ?>img/logo.png" alt="Swap RPG logo">
          <div class="slide-caption">
            <h3>Swap RPG</h3>
            <p>Prototipo 2D en Java con enfoque en ECS.</p>
          </div>
        </div>
      </div>

      <div class="slide">
        <div class="slide-content">
          <img src="<?= e($assetBase) ?>img/1_Title.png" alt="Title screen screenshot">
          <div class="slide-caption">
            <h3>Bucle de juego</h3>
            <p>Update/render desacoplados y rendimiento estable.</p>
          </div>
        </div>
      </div>

      <div class="slide">
        <div class="slide-content">
          <img src="<?= e($assetBase) ?>img/1_Class.png" alt="Class selection screenshot">
          <div class="slide-caption">
            <h3>ECS</h3>
            <p>Entidades + componentes (datos) + sistemas (lógica).</p>
          </div>
        </div>
      </div>

      <div class="slide">
        <div class="slide-content">
          <img src="<?= e($assetBase) ?>img/1_Npc.png" alt="NPC interaction screenshot">
          <div class="slide-caption">
            <h3>Interacciones</h3>
            <p>NPCs, eventos y triggers reutilizables.</p>
          </div>
        </div>
      </div>

      <div class="slide">
        <div class="slide-content">
          <img src="<?= e($assetBase) ?>img/1_Enemy.png" alt="Enemy screenshot">
          <div class="slide-caption">
            <h3>Enemigos</h3>
            <p>IA simple y sistemas de combate extensibles.</p>
          </div>
        </div>
      </div>

      <div class="slide">
        <div class="slide-content">
          <img src="<?= e($assetBase) ?>img/1_Key.png" alt="Key item screenshot">
          <div class="slide-caption">
            <h3>Inventario</h3>
            <p>Items, equipamiento y estados persistentes.</p>
          </div>
        </div>
      </div>

      <div class="slide">
        <div class="slide-content">
          <img src="<?= e($assetBase) ?>img/1_Door.png" alt="Door interaction screenshot">
          <div class="slide-caption">
            <h3>Mundo e interacción</h3>
            <p>Puertas, llaves, colisiones y reglas de mapa.</p>
          </div>
        </div>
      </div>

      <div class="slide">
        <div class="slide-content">
          <img src="<?= e($assetBase) ?>img/1_Dialogue.png" alt="Dialogue screenshot">
          <div class="slide-caption">
            <h3>Diálogos</h3>
            <p>Sistema de texto y UI pensados para quests.</p>
          </div>
        </div>
      </div>

      <div class="slide">
        <div class="slide-content">
          <img src="<?= e($assetBase) ?>img/1_Teleport.png" alt="Teleport screenshot">
          <div class="slide-caption">
            <h3>Transiciones</h3>
            <p>Teleports, cambios de escena y streaming de mapas.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <button id="prev" class="carousel-btn left" aria-label="Previous slide"><i class="fas fa-chevron-left"></i></button>
  <button id="next" class="carousel-btn right" aria-label="Next slide"><i class="fas fa-chevron-right"></i></button>
  <div class="carousel-dots" aria-hidden="true"></div>
</section>

<section id="intro" class="section section-hero">
  <div class="container">
    <h2>Swap RPG</h2>
    <p>
      Un RPG 2D en Java construido como proyecto educativo, con la meta de evolucionar hacia una arquitectura ECS
      clara, modular y fácil de extender (jugador, enemigos, inventario, UI, mapas y más).
    </p>

    <div class="hero-actions">
      <a class="btn btn-primary" href="<?= e($site['github_rpg']) ?>" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-github"></i> Ver swap-rpg
      </a>
      <a class="btn btn-ghost" href="<?= e($assetBase) ?>downloads/Demo.zip">
        <i class="fas fa-download"></i> Descargar demo
      </a>
    </div>
  </div>
</section>

<section id="architecture" class="section dark">
  <div class="container">
    <h2>Arquitectura (ECS)</h2>
    <p>
      El objetivo principal es separar datos (componentes) de la lógica (sistemas) para iterar rápido y añadir
      features sin romper el juego.
    </p>

    <div class="feature-grid">
      <div class="feature-card">
        <h3><i class="fas fa-cubes"></i> Componentes</h3>
        <p>Datos puros: posición, velocidad, sprite, colisionador, vida, inventario, diálogo…</p>
      </div>
      <div class="feature-card">
        <h3><i class="fas fa-cogs"></i> Sistemas</h3>
        <p>Movimiento, colisiones, combate, IA, items, renderizado, UI y eventos del mundo.</p>
      </div>
      <div class="feature-card">
        <h3><i class="fas fa-stream"></i> Flujo</h3>
        <p>Update determinista + render separado, con assets y configuración orientados a contenido.</p>
      </div>
    </div>
  </div>
</section>

<section id="roadmap" class="section">
  <div class="container">
    <h2>Projects / Roadmap</h2>
    <p>Lista corta de lo esencial para el RPG y cómo encaja en ECS.</p>

    <div class="roadmap-grid">
      <div class="roadmap-card">
        <h3><i class="fas fa-user"></i> Jugador</h3>
        <ul>
          <li>Movimiento, animaciones, estados</li>
          <li>Interacción con mundo (puertas, llaves, triggers)</li>
          <li>Stats (vida, daño, defensa) como componentes</li>
        </ul>
      </div>

      <div class="roadmap-card">
        <h3><i class="fas fa-skull"></i> Enemigos</h3>
        <ul>
          <li>IA básica (patrulla/aggro)</li>
          <li>Combate por sistemas (hit, knockback, invulnerabilidad)</li>
          <li>Spawns y variaciones vía datos</li>
        </ul>
      </div>

      <div class="roadmap-card">
        <h3><i class="fas fa-box-open"></i> Inventario</h3>
        <ul>
          <li>Items stackeables y equipamiento</li>
          <li>UI + hotbar</li>
          <li>Guardado/carga (estado persistente)</li>
        </ul>
      </div>

      <div class="roadmap-card">
        <h3><i class="fas fa-diagram-project"></i> Metas ECS</h3>
        <ul>
          <li>Reducir acoplamiento (sin herencia rígida)</li>
          <li>Eventos/sistema de mensajes entre sistemas</li>
          <li>Contenido data-driven (config, mapas, drops)</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="devlog" class="section dark">
  <div class="container">
    <h2>Devlog (Hitos)</h2>
    <p>Notas del proceso y milestones técnicos del motor/juego.</p>
    <ul class="milestone-list">
      <li><a href="<?= e($assetBase) ?>html/hito1.php"><i class="fas fa-layer-group"></i> Hito 1: Ventana y mapa</a></li>
      <li><a href="<?= e($assetBase) ?>html/hito2.php"><i class="fas fa-gamepad"></i> Hito 2: Input y jugador</a></li>
      <li><a href="<?= e($assetBase) ?>html/hito3.php"><i class="fas fa-map"></i> Hito 3: Tiles y cámara</a></li>
      <li><a href="<?= e($assetBase) ?>html/hito4.php"><i class="fas fa-bolt"></i> Hito 4: Colisiones</a></li>
      <li><a href="<?= e($assetBase) ?>html/hito5.php"><i class="fas fa-ghost"></i> Hito 5: Entidades y enemigos</a></li>
      <li><a href="<?= e($assetBase) ?>html/hito6.php"><i class="fas fa-heart"></i> Hito 6: UI, combate y efectos</a></li>
    </ul>
  </div>
</section>

<section id="gallery" class="section">
  <div class="container">
    <h2>Galería</h2>
    <p>Capturas seleccionadas y assets copiados manualmente desde <code>Swap/res</code>.</p>
    <div class="gallery">
      <div class="gallery-item"><img src="<?= e($assetBase) ?>img/Dark_Tree.png" alt="Environment concept art"></div>
      <div class="gallery-item"><img src="<?= e($assetBase) ?>img/liminal.png" alt="Environment screenshot"></div>
      <div class="gallery-item"><img src="<?= e($assetBase) ?>img/Tree_Dark.png" alt="Tree asset"></div>
      <div class="gallery-item"><img src="<?= e($assetBase) ?>img/liminal2.png" alt="Environment screenshot"></div>
      <div class="gallery-item"><img src="<?= e($assetBase) ?>img/rogue.png" alt="Character concept"></div>
      <div class="gallery-item"><img src="<?= e($assetBase) ?>img/liminal3.jpg" alt="Space concept"></div>
    </div>
  </div>
</section>

<div id="lightbox" class="lightbox" aria-hidden="true">
  <span class="lightbox-close" aria-label="Close">&times;</span>
  <img id="lightbox-img" src="" alt="Preview">
  <a id="lightbox-download" download class="download-btn"><i class="fas fa-download"></i> Descargar</a>
</div>

<?php
require __DIR__ . '/includes/footer.php';
require __DIR__ . '/includes/scripts.php';
?>
