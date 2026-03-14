<?php
declare(strict_types=1);

function home_content(string $lang, array $site): array
{
    $content = [
        'es' => [
            'title' => 'Swap RPG | Portfolio y devlog',
            'description' => 'Portfolio y devlog del RPG 2D en Java: arquitectura ECS, hitos tecnicos y progreso visual.',
            'hero' => [
                'eyebrow' => 'Portfolio tecnico + devlog',
                'title' => 'SWAP RPG',
                'description' => 'Un RPG 2D en desarrollo.',
                'primary_cta' => 'Ver repositorio del juego',
                'secondary_cta' => 'Descargar demo',
                'meta' => [
                    ['label' => 'Estado', 'value' => 'Prototipo jugable'],
                    ['label' => 'Stack', 'value' => 'Java, Swing, JSON'],
                    ['label' => 'Objetivo', 'value' => 'Base escalable para RPG 2D'],
                ],
                'stats' => [
                    ['value' => '6', 'label' => 'hitos publicados'],
                    ['value' => 'Java', 'label' => 'base tecnica'],
                    ['value' => 'Swing', 'label' => 'render y UI'],
                ],
                'highlights' => [
                    ['title' => 'Arquitectura clara', 'text' => 'Separacion entre datos, logica y rendering para reducir acoplamiento.'],
                    ['title' => 'Devlog util', 'text' => 'Cada milestone explica decisiones tecnicas, codigo y resultados visibles.'],
                ],
            ],
            'showcase' => [
                ['src' => 'images/milestones/1_Title.png', 'alt' => 'Pantalla de titulo del juego', 'caption' => 'Pantalla inicial y flujo principal'],
                ['src' => 'images/milestones/1_Class.png', 'alt' => 'Seleccion de clase del jugador', 'caption' => 'Primeras interfaces y estados de juego'],
                ['src' => 'images/milestones/1_Enemy.png', 'alt' => 'Encuentro con enemigo', 'caption' => 'Combate, entidades y lectura del mapa'],
            ],
            'pillars' => [
                'id' => 'architecture',
                'eyebrow' => 'Enfoque',
                'title' => 'El proyecto se esta ordenando como una base mantenible, no como un prototipo desechable.',
                'description' => 'La prioridad no es solo anadir features. Tambien importa que el codigo permita seguir iterando sobre jugador, enemigos, UI, inventario y mapas sin multiplicar deuda tecnica.',
                'items' => [
                    ['icon' => 'fa-cubes', 'title' => 'Componentes', 'text' => 'Estado puro para posicion, vida, sprites, colision, inventario o dialogo.'],
                    ['icon' => 'fa-gears', 'title' => 'Sistemas', 'text' => 'Movimiento, combate, IA, render y eventos se ejecutan con responsabilidades separadas.'],
                    ['icon' => 'fa-diagram-project', 'title' => 'Contenido data-driven', 'text' => 'La idea es empujar reglas, mapas y configuracion fuera de clases rigidamente acopladas.'],
                ],
            ],
            'roadmap' => [
                'eyebrow' => 'Roadmap tecnico',
                'title' => 'Lineas de trabajo actuales',
                'items' => [
                    ['title' => 'Core loop', 'text' => 'Mantener update y render desacoplados con una base estable para nuevas mecanicas.'],
                    ['title' => 'Combat & AI', 'text' => 'Expandir enemigos, knockback, estados y reacciones sin crecer en herencia.'],
                    ['title' => 'UI & persistence', 'text' => 'Integrar inventario, hotbar y guardado como sistemas coherentes.'],
                    ['title' => 'World tooling', 'text' => 'Escalar mapas, triggers, teleports y contenido reutilizable.'],
                ],
            ],
            'devlog' => [
                'id' => 'devlog',
                'eyebrow' => 'Devlog',
                'title' => 'Los hitos funcionan como notas de desarrollo y como evidencia tecnica del proyecto.',
                'description' => 'Cada entrada documenta una parte concreta del progreso del juego y enlaza a una pagina con codigo, capturas o decisiones clave.',
                'filters_label' => 'Filtrar por enfoque',
                'filters' => [
                    ['key' => 'all', 'label' => 'Todo'],
                    ['key' => 'engine', 'label' => 'Engine'],
                    ['key' => 'gameplay', 'label' => 'Gameplay'],
                    ['key' => 'render', 'label' => 'Render/UI'],
                ],
                'entries' => [
                    ['tag' => 'engine', 'title' => 'Hito 1', 'subtitle' => 'Ventana, game loop y mapa', 'date' => 'Oct 2025', 'href' => 'devlog/hito1', 'summary' => 'Base del motor, arranque del panel y estructura de renderizado inicial.'],
                    ['tag' => 'gameplay', 'title' => 'Hito 2', 'subtitle' => 'Input y jugador', 'date' => 'Oct 2025', 'href' => 'devlog/hito2', 'summary' => 'Control del personaje, lectura de teclado y primeras respuestas del gameplay.'],
                    ['tag' => 'render', 'title' => 'Hito 3', 'subtitle' => 'Tiles y camara', 'date' => 'Oct 2025', 'href' => 'devlog/hito3', 'summary' => 'Mapa visible, scrolling y composicion del mundo en pantalla.'],
                    ['tag' => 'engine', 'title' => 'Hito 4', 'subtitle' => 'Colisiones', 'date' => 'Oct 2025', 'href' => 'devlog/hito4', 'summary' => 'Reglas de movimiento, limites del escenario y deteccion de choque.'],
                    ['tag' => 'gameplay', 'title' => 'Hito 5', 'subtitle' => 'Entidades y enemigos', 'date' => 'Oct 2025', 'href' => 'devlog/hito5', 'summary' => 'Nuevas entidades activas y pasos hacia una logica mas modular.'],
                    ['tag' => 'render', 'title' => 'Hito 6', 'subtitle' => 'UI, combate y efectos', 'date' => 'Oct 2025', 'href' => 'devlog/hito6', 'summary' => 'Presentacion, feedback visual y primeras capas de combate legible.'],
                ],
            ],
            'gallery' => [
                'id' => 'gallery',
                'eyebrow' => 'Media',
                'title' => 'Capturas y assets del proyecto',
                'description' => 'Material visual extraido del trabajo del juego para mostrar tono, escenas y piezas reutilizables.',
                'items' => [
                    ['src' => 'images/misc/Dark_Tree.png', 'alt' => 'Arbol oscuro del juego', 'caption' => 'Asset de escenario'],
                    ['src' => 'images/misc/liminal.png', 'alt' => 'Entorno liminal del juego', 'caption' => 'Exploracion de atmosfera'],
                    ['src' => 'images/misc/Tree_Dark.png', 'alt' => 'Sprite de arbol', 'caption' => 'Variaciones de tileset'],
                    ['src' => 'images/characters/rogue.png', 'alt' => 'Concepto de personaje rogue', 'caption' => 'Direccion de personaje'],
                    ['src' => 'images/misc/liminal2.png', 'alt' => 'Segundo entorno del juego', 'caption' => 'Mood visual'],
                    ['src' => 'images/misc/liminal3.jpg', 'alt' => 'Escena espacial del proyecto', 'caption' => 'Pruebas de identidad visual'],
                ],
            ],
            'closing' => [
                'title' => 'El objetivo de esta web es mostrar progreso real del juego, no solo una landing.',
                'text' => 'Por eso mezcla portfolio, capturas, arquitectura y enlaces directos al devlog. A medida que el repo principal crezca, esta pagina puede seguir sirviendo como resumen tecnico del proyecto.',
                'primary_cta' => 'Abrir swap-rpg',
                'secondary_cta' => 'Ver devlog',
            ],
        ],
        'en' => [
            'title' => 'Swap RPG | Portfolio and dev log',
            'description' => 'Portfolio and dev log for the Java 2D RPG: ECS architecture, technical milestones, and visual progress.',
            'hero' => [
                'eyebrow' => 'Technical portfolio + dev log',
                'title' => 'SWAP RPG',
                'description' => 'A 2D RPG in development.',
                'primary_cta' => 'Open the game repository',
                'secondary_cta' => 'Download demo',
                'meta' => [
                    ['label' => 'Status', 'value' => 'Playable prototype'],
                    ['label' => 'Stack', 'value' => 'Java, Swing, JSON'],
                    ['label' => 'Goal', 'value' => 'Scalable 2D RPG foundation'],
                ],
                'stats' => [
                    ['value' => '6', 'label' => 'published milestones'],
                    ['value' => 'Java', 'label' => 'technical base'],
                    ['value' => 'Swing', 'label' => 'render and UI'],
                ],
                'highlights' => [
                    ['title' => 'Clear architecture', 'text' => 'Separating data, logic, and rendering to keep coupling under control.'],
                    ['title' => 'Useful dev log', 'text' => 'Each milestone explains technical decisions, code, and visible outcomes.'],
                ],
            ],
            'showcase' => [
                ['src' => 'images/milestones/1_Title.png', 'alt' => 'Game title screen', 'caption' => 'Title flow and first impression'],
                ['src' => 'images/milestones/1_Class.png', 'alt' => 'Player class selection', 'caption' => 'Early interfaces and game states'],
                ['src' => 'images/milestones/1_Enemy.png', 'alt' => 'Enemy encounter', 'caption' => 'Combat, entities, and map reading'],
            ],
            'pillars' => [
                'id' => 'architecture',
                'eyebrow' => 'Approach',
                'title' => 'The project is being shaped as a maintainable base, not a disposable prototype.',
                'description' => 'The priority is not only adding features. The code also needs to support continuous work on the player, enemies, UI, inventory, and maps without multiplying technical debt.',
                'items' => [
                    ['icon' => 'fa-cubes', 'title' => 'Components', 'text' => 'Pure state for position, health, sprites, collision, inventory, or dialogue.'],
                    ['icon' => 'fa-gears', 'title' => 'Systems', 'text' => 'Movement, combat, AI, rendering, and events run with separate responsibilities.'],
                    ['icon' => 'fa-diagram-project', 'title' => 'Data-driven content', 'text' => 'The direction is to move rules, maps, and config away from tightly coupled classes.'],
                ],
            ],
            'roadmap' => [
                'eyebrow' => 'Technical roadmap',
                'title' => 'Current workstreams',
                'items' => [
                    ['title' => 'Core loop', 'text' => 'Keep update and render decoupled with a stable base for new mechanics.'],
                    ['title' => 'Combat & AI', 'text' => 'Expand enemies, knockback, states, and reactions without leaning on inheritance.'],
                    ['title' => 'UI & persistence', 'text' => 'Integrate inventory, hotbar, and save data as coherent systems.'],
                    ['title' => 'World tooling', 'text' => 'Scale maps, triggers, teleports, and reusable content.'],
                ],
            ],
            'devlog' => [
                'id' => 'devlog',
                'eyebrow' => 'Dev log',
                'title' => 'The milestones work both as development notes and as technical proof of the project.',
                'description' => 'Each entry documents one concrete part of the game progress and links to a page with code, screenshots, or key decisions.',
                'filters_label' => 'Filter by focus',
                'filters' => [
                    ['key' => 'all', 'label' => 'All'],
                    ['key' => 'engine', 'label' => 'Engine'],
                    ['key' => 'gameplay', 'label' => 'Gameplay'],
                    ['key' => 'render', 'label' => 'Render/UI'],
                ],
                'entries' => [
                    ['tag' => 'engine', 'title' => 'Milestone 1', 'subtitle' => 'Window, game loop, and map', 'date' => 'Oct 2025', 'href' => 'devlog/hito1', 'summary' => 'Engine setup, panel startup, and the first rendering structure.'],
                    ['tag' => 'gameplay', 'title' => 'Milestone 2', 'subtitle' => 'Input and player', 'date' => 'Oct 2025', 'href' => 'devlog/hito2', 'summary' => 'Character control, keyboard input, and the first gameplay responses.'],
                    ['tag' => 'render', 'title' => 'Milestone 3', 'subtitle' => 'Tiles and camera', 'date' => 'Oct 2025', 'href' => 'devlog/hito3', 'summary' => 'Visible world, scrolling, and composition of the game scene.'],
                    ['tag' => 'engine', 'title' => 'Milestone 4', 'subtitle' => 'Collisions', 'date' => 'Oct 2025', 'href' => 'devlog/hito4', 'summary' => 'Movement rules, map limits, and collision detection.'],
                    ['tag' => 'gameplay', 'title' => 'Milestone 5', 'subtitle' => 'Entities and enemies', 'date' => 'Oct 2025', 'href' => 'devlog/hito5', 'summary' => 'New active entities and steps toward more modular logic.'],
                    ['tag' => 'render', 'title' => 'Milestone 6', 'subtitle' => 'UI, combat, and effects', 'date' => 'Oct 2025', 'href' => 'devlog/hito6', 'summary' => 'Presentation, visual feedback, and the first readable combat layer.'],
                ],
            ],
            'gallery' => [
                'id' => 'gallery',
                'eyebrow' => 'Media',
                'title' => 'Screenshots and project assets',
                'description' => 'Visual material taken from the game work to show tone, scenes, and reusable pieces.',
                'items' => [
                    ['src' => 'images/misc/Dark_Tree.png', 'alt' => 'Dark tree asset', 'caption' => 'Environment asset'],
                    ['src' => 'images/misc/liminal.png', 'alt' => 'Liminal environment', 'caption' => 'Atmosphere exploration'],
                    ['src' => 'images/misc/Tree_Dark.png', 'alt' => 'Tree sprite', 'caption' => 'Tileset variations'],
                    ['src' => 'images/characters/rogue.png', 'alt' => 'Rogue character concept', 'caption' => 'Character direction'],
                    ['src' => 'images/misc/liminal2.png', 'alt' => 'Second game environment', 'caption' => 'Visual mood'],
                    ['src' => 'images/misc/liminal3.jpg', 'alt' => 'Space scene from the project', 'caption' => 'Visual identity tests'],
                ],
            ],
            'closing' => [
                'title' => 'The point of this site is to show real game progress, not just act as a landing page.',
                'text' => 'That is why it mixes portfolio framing, screenshots, architecture, and direct links into the dev log. As the main repo grows, this page can keep serving as the technical overview of the project.',
                'primary_cta' => 'Open swap-rpg',
                'secondary_cta' => 'Browse dev log',
            ],
        ],
    ];

    return $content[$lang] ?? $content['es'];
}
