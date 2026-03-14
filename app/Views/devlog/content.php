<?php
declare(strict_types=1);

function milestone_shared_content(): array
{
    return [
        'hito1' => [
            'date' => '2025-10-16',
            'image' => ['src' => 'images/milestones/square_hito1.png', 'alt' => 'Milestone 1 result'],
            'nav' => ['prev' => null, 'next' => 'hito2'],
            'toc' => [
                ['id' => 'intro', 'icon' => 'fa-info-circle'],
                ['id' => 'main', 'icon' => 'fa-code'],
                ['id' => 'gameloop', 'icon' => 'fa-play'],
            ],
            'sections' => [
                [
                    'id' => 'main',
                    'code_id' => 'code-main',
                    'file' => 'src/main/Main.java',
                    'language' => 'java',
                    'code' => <<<'CODE'
package main;
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
}
CODE,
                ],
                [
                    'id' => 'gameloop',
                    'code_id' => 'code-gameloop',
                    'file' => 'src/main/GamePanel.java - run()',
                    'language' => 'java',
                    'code' => <<<'CODE'
@Override
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
}
CODE,
                ],
            ],
            'translations' => [
                'es' => [
                    'title' => 'Hito 1: Motor de Juego (GamePanel)',
                    'page_description' => 'Hito 1 del devlog de Swap RPG: ventana, game loop y mapa.',
                    'display_date' => '16 de octubre de 2025',
                    'toc' => [
                        'intro' => 'Introduccion',
                        'main' => 'Main.java',
                        'gameloop' => 'Game Loop',
                    ],
                    'intro' => [
                        'description' => 'En este primer hito se establece la base del motor del juego. Se inicializa el JFrame, se implementa el game loop en un hilo independiente y se configura el TileManager para renderizar el mapa.',
                        'goals' => [
                            'Crear la ventana principal e inicializar el GamePanel.',
                            'Implementar el bucle del juego a 60 FPS.',
                            'Configurar el TileManager para cargar imagenes.',
                            'Renderizar el mapa basado en el archivo worldV2.txt.',
                        ],
                    ],
                    'sections' => [
                        'main' => [
                            'title' => 'Clase Main.java',
                            'description' => 'Clase principal que inicia la ventana y el hilo del juego.',
                        ],
                        'gameloop' => [
                            'title' => 'GamePanel.java (Game Loop)',
                            'description' => 'Controla el tiempo del juego y delega el dibujado.',
                        ],
                    ],
                    'figure' => 'Figura 1: Inicializacion del GamePanel',
                ],
                'en' => [
                    'title' => 'Milestone 1: Game Engine Base (GamePanel)',
                    'page_description' => 'Milestone 1 of the Swap RPG dev log: window, game loop, and map.',
                    'display_date' => 'October 16, 2025',
                    'toc' => [
                        'intro' => 'Introduction',
                        'main' => 'Main.java',
                        'gameloop' => 'Game Loop',
                    ],
                    'intro' => [
                        'description' => 'This first milestone establishes the base of the game engine. It initializes the JFrame, implements the game loop on a separate thread, and sets up the TileManager to render the map.',
                        'goals' => [
                            'Create the main window and initialize the GamePanel.',
                            'Implement the game loop at 60 FPS.',
                            'Set up the TileManager to load images.',
                            'Render the map from the worldV2.txt file.',
                        ],
                    ],
                    'sections' => [
                        'main' => [
                            'title' => 'Main.java Class',
                            'description' => 'Entry point that starts the window and the game thread.',
                        ],
                        'gameloop' => [
                            'title' => 'GamePanel.java (Game Loop)',
                            'description' => 'Controls game timing and delegates drawing.',
                        ],
                    ],
                    'figure' => 'Figure 1: GamePanel initialization',
                ],
            ],
        ],
        'hito2' => [
            'date' => '2025-10-23',
            'image' => ['src' => 'images/milestones/hito1-demo.gif', 'alt' => 'Milestone 2 result'],
            'nav' => ['prev' => 'hito1', 'next' => 'hito3'],
            'toc' => [
                ['id' => 'intro', 'icon' => 'fa-info-circle'],
                ['id' => 'keymanager', 'icon' => 'fa-keyboard'],
                ['id' => 'player', 'icon' => 'fa-user'],
            ],
            'sections' => [
                [
                    'id' => 'keymanager',
                    'code_id' => 'code-keymanager',
                    'file' => 'src/manager/KeyManager.java',
                    'language' => 'java',
                    'code' => <<<'CODE'
@Override
public void keyPressed(KeyEvent e) {
    int code = e.getKeyCode();

    if (gp.gameState == gp.playState) {
        if (code == KeyEvent.VK_W) upPressed = true;
        if (code == KeyEvent.VK_S) downPressed = true;
        if (code == KeyEvent.VK_A) leftPressed = true;
        if (code == KeyEvent.VK_D) rightPressed = true;

        if (code == KeyEvent.VK_P) gp.gameState = gp.pauseState;
    }
}
CODE,
                ],
                [
                    'id' => 'player',
                    'code_id' => 'code-player',
                    'file' => 'src/entity/Player.java - update()',
                    'language' => 'java',
                    'code' => <<<'CODE'
public void update() {

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
}
CODE,
                ],
            ],
            'translations' => [
                'es' => [
                    'title' => 'Hito 2: Control del Jugador y Estados',
                    'page_description' => 'Hito 2 del devlog de Swap RPG: input, movimiento y estados del jugador.',
                    'display_date' => '23 de octubre de 2025',
                    'toc' => [
                        'intro' => 'Introduccion',
                        'keymanager' => 'KeyManager',
                        'player' => 'Player',
                    ],
                    'intro' => [
                        'description' => 'Implementacion del sistema de entrada mediante KeyManager y de la logica de movimiento, animacion y estados del jugador.',
                        'goals' => [
                            'Detectar input con teclado (WASD).',
                            'Actualizar la posicion del jugador.',
                            'Cambiar sprites segun la direccion.',
                            'Gestionar estados de juego (Play / Pause).',
                        ],
                    ],
                    'sections' => [
                        'keymanager' => [
                            'title' => 'KeyManager.java',
                            'description' => 'Gestiona los eventos del teclado y controla los estados del input.',
                        ],
                        'player' => [
                            'title' => 'Player.java - Movimiento',
                            'description' => 'Actualiza direccion, colisiones y desplazamiento del jugador.',
                        ],
                    ],
                ],
                'en' => [
                    'title' => 'Milestone 2: Player Control and States',
                    'page_description' => 'Milestone 2 of the Swap RPG dev log: input, movement, and player states.',
                    'display_date' => 'October 23, 2025',
                    'toc' => [
                        'intro' => 'Introduction',
                        'keymanager' => 'KeyManager',
                        'player' => 'Player',
                    ],
                    'intro' => [
                        'description' => 'Implementation of the input system through KeyManager and of the player movement, animation, and state logic.',
                        'goals' => [
                            'Detect keyboard input (WASD).',
                            'Update player position.',
                            'Swap sprites based on direction.',
                            'Manage game states (Play / Pause).',
                        ],
                    ],
                    'sections' => [
                        'keymanager' => [
                            'title' => 'KeyManager.java',
                            'description' => 'Handles keyboard events and controls input states.',
                        ],
                        'player' => [
                            'title' => 'Player.java - Movement',
                            'description' => 'Updates direction, collisions, and player movement.',
                        ],
                    ],
                ],
            ],
        ],
        'hito3' => [
            'date' => '2025-10-30',
            'image' => null,
            'nav' => ['prev' => 'hito2', 'next' => 'hito4'],
            'toc' => [
                ['id' => 'intro', 'icon' => 'fa-info-circle'],
                ['id' => 'tilemanager', 'icon' => 'fa-map'],
                ['id' => 'entity', 'icon' => 'fa-user-astronaut'],
            ],
            'sections' => [
                [
                    'id' => 'tilemanager',
                    'code_id' => 'code-tilemanager',
                    'file' => 'src/tile/TileManager.java - draw()',
                    'language' => 'java',
                    'code' => <<<'CODE'
public void draw(Graphics2D g2) {
    int worldCol = 0;
    int worldRow = 0;
    
    while(worldCol < gp.maxWorldCol && worldRow < gp.maxWorldRow) {
        int tileNum = mapTileNum[worldCol][worldRow];
        int worldX = worldCol * gp.tileSize;
        int worldY = worldRow * gp.tileSize;

        int screenX = worldX - gp.player.worldX + gp.player.screenX;
        int screenY = worldY - gp.player.worldY + gp.player.screenY;

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
}
CODE,
                ],
                [
                    'id' => 'entity',
                    'code_id' => 'code-entity-draw',
                    'file' => 'src/entity/Entity.java - draw()',
                    'language' => 'java',
                    'code' => <<<'CODE'
public void draw(Graphics2D g2) {
    BufferedImage image = null;
    
    int screenX = worldX - gp.player.worldX + gp.player.screenX;
    int screenY = worldY - gp.player.worldY + gp.player.screenY;

    if (worldX + gp.tileSize > gp.player.worldX - gp.player.screenX
            && worldX - gp.tileSize < gp.player.worldX + gp.player.screenX
            && worldY + gp.tileSize > gp.player.worldY - gp.player.screenY
            && worldY - gp.tileSize < gp.player.worldY + gp.player.screenY) {

         switch (direction) {
             case "up": image = (spriteNum == 1) ? up1 : up2; break;
         }

         if (invincible == true) {
             changeAlpha(g2, 0.4F);
         }
         
         g2.drawImage(image, screenX, screenY, gp.tileSize, gp.tileSize, null);
         changeAlpha(g2, 1F);
    }
}
CODE,
                ],
            ],
            'translations' => [
                'es' => [
                    'title' => 'Hito 3: Camara y Renderizado Relativo',
                    'page_description' => 'Hito 3 del devlog de Swap RPG: tiles, camara y renderizado relativo.',
                    'display_date' => '30 de octubre de 2025',
                    'toc' => [
                        'intro' => 'Introduccion',
                        'tilemanager' => 'TileManager.java',
                        'entity' => 'Entity.java',
                    ],
                    'intro' => [
                        'description' => 'Implementacion del sistema de camara 2D. En lugar de mover la ventana, se mueve el contenido del mundo en direccion opuesta a la posicion del jugador para crear la ilusion de desplazamiento.',
                        'goals' => [
                            'Calcular el offset de pantalla basandose en la posicion del jugador.',
                            'Renderizar solo lo visible dentro de los limites de la pantalla.',
                            'Aplicar la logica de camara a tiles y entidades.',
                        ],
                    ],
                    'sections' => [
                        'tilemanager' => [
                            'title' => 'TileManager.java (Camara para Tiles)',
                            'description' => 'Calcula si cada tile debe dibujarse y en que posicion de pantalla.',
                        ],
                        'entity' => [
                            'title' => 'Entity.java (Camara para Entidades)',
                            'description' => 'Jugador, NPC y enemigos comparten la misma logica base de renderizado relativo.',
                        ],
                    ],
                ],
                'en' => [
                    'title' => 'Milestone 3: Camera and Relative Rendering',
                    'page_description' => 'Milestone 3 of the Swap RPG dev log: tiles, camera, and relative rendering.',
                    'display_date' => 'October 30, 2025',
                    'toc' => [
                        'intro' => 'Introduction',
                        'tilemanager' => 'TileManager.java',
                        'entity' => 'Entity.java',
                    ],
                    'intro' => [
                        'description' => 'Implementation of the 2D camera system. Instead of moving the window, the world content moves in the opposite direction of the player position to create the scrolling illusion.',
                        'goals' => [
                            'Calculate screen offset based on the player position.',
                            'Render only what is visible inside the screen bounds.',
                            'Apply the camera logic to both tiles and entities.',
                        ],
                    ],
                    'sections' => [
                        'tilemanager' => [
                            'title' => 'TileManager.java (Tile Camera)',
                            'description' => 'Calculates whether each tile should be drawn and where it appears on screen.',
                        ],
                        'entity' => [
                            'title' => 'Entity.java (Entity Camera)',
                            'description' => 'Player, NPC, and enemies share the same base relative-rendering logic.',
                        ],
                    ],
                ],
            ],
        ],
        'hito4' => [
            'date' => '2025-11-06',
            'image' => null,
            'nav' => ['prev' => 'hito3', 'next' => 'hito5'],
            'toc' => [
                ['id' => 'intro', 'icon' => 'fa-info-circle'],
                ['id' => 'collision', 'icon' => 'fa-bolt'],
                ['id' => 'entity', 'icon' => 'fa-cube'],
            ],
            'sections' => [
                [
                    'id' => 'collision',
                    'code_id' => 'code-collision',
                    'file' => 'src/manager/CollisionManager.java - checkTile()',
                    'language' => 'java',
                    'code' => <<<'CODE'
public void checkTile(Entity entity) {
    int entityLeftWorldX = entity.worldX + entity.solidArea.x;
    int entityRightWorldX = entity.worldX + entity.solidArea.x + entity.solidArea.width;
    int entityTopWorldY = entity.worldY + entity.solidArea.y;
    int entityBottomWorldY = entity.worldY + entity.solidArea.y + entity.solidArea.height;

    int entityLeftCol = entityLeftWorldX / gp.tileSize;
    int entityRightCol = entityRightWorldX / gp.tileSize;
    int entityTopRow = entityTopWorldY / gp.tileSize;
    int entityBottomRow = entityBottomWorldY / gp.tileSize;

    int tileNum1, tileNum2;

    switch (entity.direction) {
        case "up":
            entityTopRow = (entityTopWorldY - entity.speed) / gp.tileSize;
            tileNum1 = gp.tileM.mapTileNum[entityLeftCol][entityTopRow];
            tileNum2 = gp.tileM.mapTileNum[entityRightCol][entityTopRow];
            
            if (gp.tileM.tile[tileNum1].collision == true || 
                gp.tileM.tile[tileNum2].collision == true) {
                entity.collisionOn = true;
            }
            break;
    }
}
CODE,
                ],
                [
                    'id' => 'entity',
                    'code_id' => 'code-solidarea',
                    'file' => 'src/entity/Entity.java - Declaration',
                    'language' => 'java',
                    'code' => <<<'CODE'
public class Entity {
    public Rectangle solidArea = new Rectangle(0, 0, 48, 48);
    
    public int solidAreaDefaultX = 0;
    public int solidAreaDefaultY = 0;

    // Example customization in Mon_GreenSlime
    // solidArea.x = 3;
    // solidArea.y = 18;
}
CODE,
                ],
            ],
            'translations' => [
                'es' => [
                    'title' => 'Hito 4: Sistema de Colisiones',
                    'page_description' => 'Hito 4 del devlog de Swap RPG: colisiones, tiles y hitboxes.',
                    'display_date' => '6 de noviembre de 2025',
                    'toc' => [
                        'intro' => 'Introduccion',
                        'collision' => 'CollisionManager.java',
                        'entity' => 'Entity (SolidArea)',
                    ],
                    'intro' => [
                        'description' => 'Implementacion de colisiones precisas usando rectangulos de colision (solidArea). El sistema evita que el jugador atraviese muros, agua o rocas y detecta contacto con otras entidades.',
                        'goals' => [
                            'Definir areas de colision personalizadas para cada entidad.',
                            'Verificar colisiones con el mapa (checkTile).',
                            'Verificar colisiones con objetos y NPCs (checkEntity).',
                            'Detener el movimiento cuando se detecta una colision.',
                        ],
                    ],
                    'sections' => [
                        'collision' => [
                            'title' => 'CollisionManager.java (checkTile)',
                            'description' => 'Convierte posiciones en pixeles a coordenadas de matriz y revisa la propiedad collision del tile.',
                        ],
                        'entity' => [
                            'title' => 'Entity.java (SolidArea)',
                            'description' => 'Las entidades no ocupan todo el tile, sino una zona de colision mas ajustada.',
                        ],
                    ],
                ],
                'en' => [
                    'title' => 'Milestone 4: Collision System',
                    'page_description' => 'Milestone 4 of the Swap RPG dev log: collisions, tiles, and hitboxes.',
                    'display_date' => 'November 6, 2025',
                    'toc' => [
                        'intro' => 'Introduction',
                        'collision' => 'CollisionManager.java',
                        'entity' => 'Entity (SolidArea)',
                    ],
                    'intro' => [
                        'description' => 'Implementation of precise collisions using collision rectangles (solidArea). The system prevents the player from crossing walls, water, or rocks and detects contact with other entities.',
                        'goals' => [
                            'Define custom collision areas for each entity.',
                            'Check map collisions (checkTile).',
                            'Check collisions with objects and NPCs (checkEntity).',
                            'Stop movement when a collision is detected.',
                        ],
                    ],
                    'sections' => [
                        'collision' => [
                            'title' => 'CollisionManager.java (checkTile)',
                            'description' => 'Converts pixel positions into grid coordinates and checks the tile collision property.',
                        ],
                        'entity' => [
                            'title' => 'Entity.java (SolidArea)',
                            'description' => 'Entities do not occupy the entire tile, only a tighter collision area.',
                        ],
                    ],
                ],
            ],
        ],
        'hito5' => [
            'date' => '2025-11-13',
            'image' => null,
            'nav' => ['prev' => 'hito4', 'next' => 'hito6'],
            'toc' => [
                ['id' => 'intro', 'icon' => 'fa-info-circle'],
                ['id' => 'asset', 'icon' => 'fa-boxes'],
                ['id' => 'slime', 'icon' => 'fa-ghost'],
            ],
            'sections' => [
                [
                    'id' => 'asset',
                    'code_id' => 'code-asset',
                    'file' => 'src/manager/AssetManager.java',
                    'language' => 'java',
                    'code' => <<<'CODE'
public class AssetManager {
    GamePanel gp;

    public AssetManager(GamePanel gp) {
        this.gp = gp;
    }

    public void setObject() {
        // Instantiate objects such as doors or chests...
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
        gp.enemy[i] = new Mon_GreenSlime(gp);
        gp.enemy[i].worldX = gp.tileSize * 23;
        gp.enemy[i].worldY = gp.tileSize * 36;
        i++;
        gp.enemy[i] = new Mon_GreenSlime(gp);
        gp.enemy[i].worldX = gp.tileSize * 23;
        gp.enemy[i].worldY = gp.tileSize * 37;
        i++;
    }
}
CODE,
                ],
                [
                    'id' => 'slime',
                    'code_id' => 'code-slime',
                    'file' => 'src/enemy/Mon_GreenSlime.java - setAction()',
                    'language' => 'java',
                    'code' => <<<'CODE'
public class Mon_GreenSlime extends Entity {
    public Mon_GreenSlime(GamePanel gp) {
        super(gp);
        name = "Green Slime";
        speed = 1;
        maxLife = 4;
        getImage();
    }

    public void setAction() {
        aiLockMove++;
        
        if (aiLockMove == 200) {
            int u = UtilityTool.randomNumber(1, 100);

            if (u <= 25) { direction = "up"; }
            else if (u > 25 && u <= 50) { direction = "down"; }
            else if (u > 50 && u < 75) { direction = "left"; }
            else if (u > 75 && u <= 100) { direction = "right"; }
            
            aiLockMove = 0;
        }
    }
}
CODE,
                ],
            ],
            'translations' => [
                'es' => [
                    'title' => 'Hito 5: Entidades y Enemigos',
                    'page_description' => 'Hito 5 del devlog de Swap RPG: entidades, enemigos y AssetManager.',
                    'display_date' => '13 de noviembre de 2025',
                    'toc' => [
                        'intro' => 'Introduccion',
                        'asset' => 'AssetManager.java',
                        'slime' => 'Mon_GreenSlime (IA)',
                    ],
                    'intro' => [
                        'description' => 'El mundo empieza a poblarse con vida. Se usa AssetManager para instanciar NPCs y enemigos, y los enemigos reciben una IA basica para moverse aleatoriamente.',
                        'goals' => [
                            'Crear subclases de Entity para NPCs y enemigos.',
                            'Implementar un AssetManager para configurar el mundo.',
                            'Programar un comportamiento de movimiento aleatorio.',
                        ],
                    ],
                    'sections' => [
                        'asset' => [
                            'title' => 'AssetManager.java',
                            'description' => 'Gestiona arrays de objetos, NPCs y enemigos y los coloca en coordenadas worldX concretas.',
                        ],
                        'slime' => [
                            'title' => 'Mon_GreenSlime.java (IA del enemigo)',
                            'description' => 'El enemigo usa un contador aiLockMove para cambiar de direccion periodicamente.',
                        ],
                    ],
                ],
                'en' => [
                    'title' => 'Milestone 5: Entities and Enemies',
                    'page_description' => 'Milestone 5 of the Swap RPG dev log: entities, enemies, and AssetManager.',
                    'display_date' => 'November 13, 2025',
                    'toc' => [
                        'intro' => 'Introduction',
                        'asset' => 'AssetManager.java',
                        'slime' => 'Mon_GreenSlime (AI)',
                    ],
                    'intro' => [
                        'description' => 'The world starts to feel alive. AssetManager is used to instantiate NPCs and enemies, and enemies receive simple AI to move around randomly.',
                        'goals' => [
                            'Create Entity subclasses for NPCs and enemies.',
                            'Implement an AssetManager to set up the world.',
                            'Program a random movement behavior.',
                        ],
                    ],
                    'sections' => [
                        'asset' => [
                            'title' => 'AssetManager.java',
                            'description' => 'Manages object, NPC, and enemy arrays and places them at specific worldX coordinates.',
                        ],
                        'slime' => [
                            'title' => 'Mon_GreenSlime.java (Enemy AI)',
                            'description' => 'The enemy uses an aiLockMove counter to change direction periodically.',
                        ],
                    ],
                ],
            ],
        ],
        'hito6' => [
            'date' => '2025-11-20',
            'image' => ['src' => 'images/milestones/square_hito4.png', 'alt' => 'Milestone 6 result'],
            'nav' => ['prev' => 'hito5', 'next' => null],
            'toc' => [
                ['id' => 'intro', 'icon' => 'fa-info-circle'],
                ['id' => 'ui', 'icon' => 'fa-heart'],
                ['id' => 'attack', 'icon' => 'fa-fist-raised'],
            ],
            'sections' => [
                [
                    'id' => 'ui',
                    'code_id' => 'code-ui-life',
                    'file' => 'src/main/UI.java - drawPlayerLife()',
                    'language' => 'java',
                    'code' => <<<'CODE'
public void drawPlayerLife() {
    int x = gp.tileSize/2;
    int y = gp.tileSize/2;
    int i = 0;

    while (i < gp.player.maxLife/2) {
        g2.drawImage(heart_blank, x, y, null);
        i++;
        x += gp.tileSize;
    }

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
}
CODE,
                ],
                [
                    'id' => 'attack',
                    'code_id' => 'code-player-attack',
                    'file' => 'src/entity/Player.java - attacking()',
                    'language' => 'java',
                    'code' => <<<'CODE'
public void attacking() {
    spriteCounter++;
    if (spriteCounter <= 5) {
        spriteNum = 1;
    }
    if (spriteCounter > 5 && spriteCounter <= 25) {
        spriteNum = 2;
        
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
        
        solidArea.width = attackArea.width;
        solidArea.height = attackArea.height;
        
        int enemyIndex = gp.cManager.checkEntity(this, gp.enemy);
        damageEnemy(enemyIndex);
        
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
}
CODE,
                ],
            ],
            'translations' => [
                'es' => [
                    'title' => 'Hito 6: UI, Combate y Feedback Visual',
                    'page_description' => 'Hito 6 del devlog de Swap RPG: UI, combate y feedback visual.',
                    'display_date' => '20 de noviembre de 2025',
                    'toc' => [
                        'intro' => 'Introduccion',
                        'ui' => 'UI (Vida)',
                        'attack' => 'Player (Ataque)',
                    ],
                    'intro' => [
                        'description' => 'El juego gana vida con interfaz de usuario, combate, sonido y feedback visual como el parpadeo al recibir dano y las animaciones de ataque.',
                        'goals' => [
                            'Dibujar la barra de vida en pantalla.',
                            'Implementar el sistema de ataque del jugador.',
                            'Gestionar la invencibilidad temporal tras recibir dano.',
                            'Mostrar dialogos y estadisticas.',
                        ],
                    ],
                    'sections' => [
                        'ui' => [
                            'title' => 'UI.java (Barra de Vida)',
                            'description' => 'La clase UI dibuja la vida del jugador con sprites de corazones en la esquina superior izquierda.',
                        ],
                        'attack' => [
                            'title' => 'Player.java (Sistema de Ataque)',
                            'description' => 'Al pulsar Enter/E se activa el estado attacking, se cambian sprites y se verifican colisiones con enemigos.',
                        ],
                    ],
                    'figure' => 'Figura 1: Barra de vida y combate activo',
                ],
                'en' => [
                    'title' => 'Milestone 6: UI, Combat, and Visual Feedback',
                    'page_description' => 'Milestone 6 of the Swap RPG dev log: UI, combat, and visual feedback.',
                    'display_date' => 'November 20, 2025',
                    'toc' => [
                        'intro' => 'Introduction',
                        'ui' => 'UI (Life)',
                        'attack' => 'Player (Attack)',
                    ],
                    'intro' => [
                        'description' => 'The game gains life with user interface work, combat, sound, and visual feedback such as blinking on damage and attack animations.',
                        'goals' => [
                            'Draw the life bar on screen.',
                            'Implement the player attack system.',
                            'Handle temporary invincibility after taking damage.',
                            'Display dialogue and stats.',
                        ],
                    ],
                    'sections' => [
                        'ui' => [
                            'title' => 'UI.java (Life Bar)',
                            'description' => 'The UI class draws the player life in the upper-left corner using heart sprites.',
                        ],
                        'attack' => [
                            'title' => 'Player.java (Attack System)',
                            'description' => 'Pressing Enter/E activates the attacking state, swaps sprites, and checks collisions against enemies.',
                        ],
                    ],
                    'figure' => 'Figure 1: Life bar and active combat',
                ],
            ],
        ],
    ];
}

function milestone_content(string $slug, string $lang): array
{
    $milestones = milestone_shared_content();
    if (!isset($milestones[$slug])) {
        throw new InvalidArgumentException('Unknown milestone: ' . $slug);
    }

    $milestone = $milestones[$slug];
    $translated = $milestone['translations'][$lang] ?? $milestone['translations']['es'];
    $milestone['translated'] = $translated;
    return $milestone;
}
