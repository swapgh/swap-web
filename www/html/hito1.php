<?php
require_once __DIR__ . '/../includes/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hito 1: Motor de Juego - Swap RPG Devlog</title>
  
  <!-- CSS EXISTENTE -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- NUEVO CSS DE DOCUMENTACIÓN -->
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
          <li><a href="#main"><i class="fas fa-code"></i> Main.java</a></li>
          <li><a href="#gameloop"><i class="fas fa-play"></i> Game Loop</a></li>
          <li><a href="#tilemanager"><i class="fas fa-map"></i> TileManager</a></li>
        </ul>
      </div>

 

      <!-- Navegación entre Hitos -->
      <div>
        <h3>Hitos</h3>
        <ul class="doc-nav-list">
          <li><a href="hito2.php">Siguiente: Hito 2 <i class="fas fa-arrow-right"></i></a></li>
          <li><a href="../index.php#hitos">Volver al Inicio</a></li>
        </ul>
      </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="doc-content">
      
      <section class="milestone-card" id="intro">
        <h1>Hito 1: Motor de Juego (GamePanel)</h1>
        <div class="milestone-meta">
          <span><i class="far fa-calendar"></i> 16 de octubre de 2025</span>
          <span><i class="fas fa-check-circle"></i> Completado</span>
        </div>
        <div class="milestone-desc">
          En este primer hito, establecemos la base del motor de juego. Inicializamos el JFrame, implementamos 
          el Game Loop mediante un Thread separado y configuramos el TileManager para renderizar el mapa.
        </div>

        <h2>Objetivos</h2>
        <ul>
          <li>Crear la ventana principal e inicializar el GamePanel.</li>
          <li>Implementar el bucle del juego (Game Loop) a 60 FPS.</li>
          <li>Configurar el TileManager para cargar imágenes.</li>
          <li>Renderizar el mapa basado en el archivo <code>worldV2.txt</code>.</li>
        </ul>
      </section>

      <section class="milestone-card" id="main" style="margin-top: 40px; border: none; background: transparent; box-shadow: none; padding: 0;">
        
        <h2>Clase Main.java</h2>
        <p>Clase principal que inicia la ventana y el hilo del juego.</p>
        <div class="code-wrapper">
          <div class="code-header">
            <span class="code-title">src/main/Main.java</span>
            <button class="code-toggle" onclick="toggleCode('code-main')">Expandir</button>
          </div>
          <div class="code-container" id="code-main">
            <pre><code class="language-java">package main;
import javax.swing.JFrame;

public class Main {
    public static void main(String[] args) {
        JFrame window = new JFrame();
        window.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        window.setResizable(false);
        window.setTitle("2D Rpg");
        
        GamePanel gamePanel = new GamePanel();
        window.add(gamePanel);
        window.pack();
        
        window.setLocationRelativeTo(null);
        window.setVisible(true);
        
        gamePanel.setupGame();
        gamePanel.startGameThread();
    }
}</code></pre>
          </div>
        </div>

        <h2 id="gameloop">GamePanel.java (Game Loop)</h2>
        <p>Controla el tiempo del juego y delega el dibujado.</p>
        <div class="code-wrapper">
          <div class="code-header">
            <span class="code-title">src/main/GamePanel.java - run()</span>
            <button class="code-toggle" onclick="toggleCode('code-gameloop')">Expandir</button>
          </div>
          <div class="code-container" id="code-gameloop">
            <pre><code class="language-java">@Override
public void run() {
    double drawInterval = 1000000000 / FPS;
    double delta = 0; 
    long past = System.nanoTime(); 

    while (gameLoop != null) {
        long now = System.nanoTime();
        delta += (now - past) / drawInterval;
        past = now;

        if (delta >= 1) { 
            update();
            repaint();
            delta--; 
        }
    }
}</code></pre>
          </div>
        </div>
        
        <div class="result-visual">
            <img src="../img/square_hito1.png" alt="Resultado Hito 1" style="border-radius: 10px; max-width: 100%;">
            <p style="color: #94a3b8; margin-top: 10px; font-style: italic;">Figura 1: Inicialización del GamePanel</p>
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
