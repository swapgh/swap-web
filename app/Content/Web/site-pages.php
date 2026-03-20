<?php
declare(strict_types=1);

function build_site_page_content(string $slug, string $lang, array $site): array
{
    $pages = [
        'es' => [
            'project' => [
                'title' => 'Swap RPG | Proyecto principal',
                'description' => 'Pagina principal del proyecto Swap RPG con vision general, mundo, gameplay, sistemas y enlaces clave.',
                'eyebrow' => 'Proyecto Principal',
                'heading' => 'Swap RPG en una sola pagina clara.',
                'lead' => 'Esta es la pagina que debe contar el proyecto completo sin obligar a navegar por secciones fragmentadas. Resume que es, como se juega, que demuestra tecnicamente y donde seguirlo.',
                'highlights' => [
                    'RPG 2D en Java y Swing con prototype jugable.',
                    'Direccion visual de fantasia oscura con identidad propia.',
                    'Base tecnica visible: loop, camara, colisiones, entidades y combate.',
                ],
                'sections' => [
                    [
                        'title' => 'Que es Swap RPG',
                        'body' => 'Swap RPG es el proyecto principal del portfolio. Se presenta como una mezcla entre showcase jugable y case study tecnico: una demo compacta que enseña tono visual, control del jugador, construccion del mundo y decisiones de arquitectura.',
                    ],
                    [
                        'title' => 'Que debe entender un visitante rapido',
                        'body' => 'En pocos segundos alguien tiene que ver tres cosas: que el proyecto existe de verdad, que tiene una identidad reconocible y que detras hay criterio tecnico. Por eso esta pagina concentra overview, imagenes reutilizadas, sistemas principales y enlaces al repositorio.',
                    ],
                    [
                        'title' => 'Bloques del proyecto',
                        'body' => 'El contenido que antes estaba disperso por apartados separados ahora se resume aqui: gameplay y controles, atmosfera del mundo, entidades y enemigos, combate y feedback visual, y una lectura simple de la base tecnica.',
                    ],
                    [
                        'title' => 'Siguiente paso recomendado',
                        'body' => 'Si mas adelante hace falta una pagina extra, la unica division razonable es una seccion tecnica dedicada a sistemas. Todo lo demas debe seguir agrupado para que el proyecto no se fragmente innecesariamente.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Ver repositorio', 'href' => $site['github_rpg'], 'variant' => 'primary', 'external' => true, 'icon' => 'fab fa-github'],
                    ['label' => 'Descargar demo', 'href' => asset_url('downloads/demo.zip'), 'variant' => 'secondary', 'external' => true, 'icon' => 'fas fa-download'],
                    ['label' => 'Ir al contacto', 'href' => with_lang(page_url('contact')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-envelope'],
                ],
            ],
            'contact' => [
                'title' => 'Contacto | Swap RPG',
                'description' => 'Pagina de contacto para consultas sobre el proyecto, colaboraciones o seguimiento.',
                'eyebrow' => 'Contacto',
                'heading' => 'Un punto de contacto simple y directo.',
                'lead' => 'Esta web no necesita un formulario complejo todavia. Lo importante es dejar claro para que escribir y cual es el mejor canal.',
                'highlights' => [
                    'Consultas sobre el proyecto o el repositorio.',
                    'Colaboraciones, feedback o oportunidades de trabajo.',
                    'Seguimiento de futuras actualizaciones del sitio.',
                ],
                'sections' => [
                    [
                        'title' => 'Correo principal',
                        'body' => 'El canal principal es el correo del proyecto. Es la opcion correcta para contacto profesional, dudas sobre el trabajo o propuestas concretas.',
                    ],
                    [
                        'title' => 'Que incluir en el mensaje',
                        'body' => 'Para acelerar la respuesta, conviene indicar el motivo del contacto, si vienes por Swap RPG o por el portfolio web, y cualquier enlace o contexto necesario.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Escribir por email', 'href' => 'mailto:' . $site['contact_email'], 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-envelope'],
                    ['label' => 'Ver swap-rpg', 'href' => $site['github_rpg'], 'variant' => 'secondary', 'external' => true, 'icon' => 'fab fa-github'],
                ],
            ],
            'help' => [
                'title' => 'Ayuda | Swap RPG',
                'description' => 'Pagina de ayuda con orientacion rapida sobre el contenido publico del proyecto y la demo.',
                'eyebrow' => 'Ayuda',
                'heading' => 'Ayuda ligera para una web pequeña.',
                'lead' => 'Esta seccion existe para resolver dudas basicas sin convertir la web en una aplicacion de soporte completa.',
                'highlights' => [
                    'Donde encontrar el proyecto principal.',
                    'Como descargar la demo actual.',
                    'Que partes de la web son publicas y cuales son provisionales.',
                ],
                'sections' => [
                    [
                        'title' => 'Si quieres ver el proyecto',
                        'body' => 'La entrada principal es la home y la pagina del proyecto. Desde ahi deberia ser evidente como abrir el repositorio, descargar la demo o revisar las partes visuales mas importantes.',
                    ],
                    [
                        'title' => 'Si algo parece provisional',
                        'body' => 'Es normal que algunos nombres, textos o secciones cambien. Esta web sigue en transicion hacia una estructura mas clara de portfolio y showcase.',
                    ],
                    [
                        'title' => 'Si necesitas mas contexto',
                        'body' => 'Cuando una pagina no responda suficientemente a una duda concreta, el siguiente paso correcto es contactar por correo en lugar de multiplicar paginas o FAQ innecesarias.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Ir al proyecto', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                    ['label' => 'Contactar', 'href' => with_lang(page_url('contact')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-envelope'],
                ],
            ],
            'privacy' => [
                'title' => 'Privacidad | Swap RPG',
                'description' => 'Resumen actual de privacidad y tratamiento de datos del sitio.',
                'eyebrow' => 'Privacidad',
                'heading' => 'Politica de privacidad simple y honesta.',
                'lead' => 'Esta pagina debe reflejar el estado real del sitio hoy, no una politica inflada para funciones que todavia no existen.',
                'highlights' => [
                    'No hay cuenta publica obligatoria para navegar el sitio.',
                    'El sitio usa una cookie de idioma para recordar la preferencia.',
                    'No se anuncia aqui ninguna recogida de datos que no exista realmente.',
                ],
                'sections' => [
                    [
                        'title' => 'Datos minimos',
                        'body' => 'Actualmente el sitio publico no depende de formularios complejos ni de pagos. La principal informacion tratada de forma visible es la preferencia de idioma y la informacion tecnica basica que genera cualquier peticion web.',
                    ],
                    [
                        'title' => 'Contacto por correo',
                        'body' => 'Si escribes al correo del proyecto, los datos que incluyas en ese mensaje se usaran solo para responder a la consulta y continuar la conversacion relacionada.',
                    ],
                    [
                        'title' => 'Evolucion futura',
                        'body' => 'Si en el futuro se añaden analytics, formularios reales o cuentas, esta pagina debe actualizarse al mismo tiempo para describir esos cambios de forma concreta.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Ver cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Contactar', 'href' => with_lang(page_url('contact')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-envelope'],
                ],
            ],
            'cookies' => [
                'title' => 'Cookies | Swap RPG',
                'description' => 'Politica de cookies del sitio en su estado actual.',
                'eyebrow' => 'Cookies',
                'heading' => 'Solo explicar las cookies que existen.',
                'lead' => 'La politica de cookies debe mantenerse pequeña mientras la web siga siendo pequeña.',
                'highlights' => [
                    'Cookie de idioma para recordar ES o EN.',
                    'Sin prometer banners o categorias que aun no se usan.',
                    'Actualizacion obligatoria si se añaden analytics o servicios externos.',
                ],
                'sections' => [
                    [
                        'title' => 'Cookie actual',
                        'body' => 'El sitio usa la cookie de idioma para recordar la preferencia de navegacion. Su finalidad es funcional: evitar tener que elegir idioma en cada visita.',
                    ],
                    [
                        'title' => 'Sin inflar la politica',
                        'body' => 'Mientras no existan cookies de marketing, personalizacion avanzada o analytics de terceros, esta pagina debe seguir siendo corta y precisa.',
                    ],
                    [
                        'title' => 'Si se añaden mas cookies',
                        'body' => 'En ese caso habra que actualizar esta pagina y valorar si ya corresponde implementar un banner de consentimiento real.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Volver a privacidad', 'href' => with_lang(page_url('privacy')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-shield-halved'],
                    ['label' => 'Ir al inicio', 'href' => with_lang(page_url('')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-house'],
                ],
            ],
            'class-select' => [
                'title' => 'Class Select | Swap RPG Universe',
                'description' => 'Breve presentacion de Class Select como juego terminado dentro del universo del portfolio.',
                'eyebrow' => 'Featured Game',
                'heading' => 'Class Select convierte la eleccion de clase en el centro de toda la partida.',
                'lead' => 'Se presenta como un RPG tactico corto y rejugable donde cada run empieza con una decision fuerte: que rol ocupa cada miembro del grupo y como eso altera todo el combate posterior.',
                'highlights' => [
                    'RPG tactico corto para PC y PlayStation.',
                    'Enfoque en legibilidad de clases y composicion de grupo.',
                    'Partidas breves con builds muy distintas desde el inicio.',
                ],
                'sections' => [
                    [
                        'title' => 'Fantasia del juego',
                        'body' => 'La idea central es que seleccionar clase no sea una pantalla de tramite, sino el momento mas importante de la partida. Cada clase cambia habilidades, posicionamiento y ritmo tactico.',
                    ],
                    [
                        'title' => 'Porque funciona',
                        'body' => 'El juego se apoya en interfaces claras, iconografia fuerte y decisiones rapidas. La lectura del equipo es inmediata, y eso hace que la estrategia empiece antes del primer combate.',
                    ],
                    [
                        'title' => 'Tipo de experiencia',
                        'body' => 'Es una experiencia compacta, pensada para sesiones cortas donde la preparacion del grupo y la variedad de combinaciones generan la rejugabilidad.',
                    ],
                    [
                        'title' => 'Relacion con el portfolio',
                        'body' => 'Sirve para enseñar criterio en UX, flujo de seleccion y claridad visual, no solo direccion artistica.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Volver a la home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Ver proyecto principal', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
            'combat-slice' => [
                'title' => 'Combat Slice | Swap RPG Universe',
                'description' => 'Breve presentacion de Combat Slice como juego terminado dentro del portfolio.',
                'eyebrow' => 'Featured Game',
                'heading' => 'Combat Slice empuja el combate directo y la lectura de amenazas al primer plano.',
                'lead' => 'Se imagina como un action RPG breve donde la gracia no esta en el mapa enorme, sino en encuentros tensos, enemigos legibles y una progresion de combate muy concentrada.',
                'highlights' => [
                    'Action RPG compacto para PC y Xbox.',
                    'Encuentros intensos con telegraphs claros.',
                    'Progresion corta basada en dominio del sistema.',
                ],
                'sections' => [
                    [
                        'title' => 'Fantasia del juego',
                        'body' => 'La fantasia principal es sentir que cada encuentro importa. El jugador entra, lee patrones, castiga aperturas y mejora por conocimiento, no por relleno.',
                    ],
                    [
                        'title' => 'Porque funciona',
                        'body' => 'La claridad de animaciones, espacios y comportamiento enemigo deja que el sistema sea exigente sin volverse confuso.',
                    ],
                    [
                        'title' => 'Tipo de experiencia',
                        'body' => 'Es una experiencia de sesiones cortas y repetibles, pensada para quien disfruta aprender timings, respuesta y priorizacion de amenazas.',
                    ],
                    [
                        'title' => 'Relacion con el portfolio',
                        'body' => 'Esta pieza pone el foco en systems design, feedback visual y legibilidad del combate.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Volver a la home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Ver proyecto principal', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
            'dark-biome' => [
                'title' => 'Dark Biome | Swap RPG Universe',
                'description' => 'Breve presentacion de Dark Biome como juego atmosferico terminado dentro del portfolio.',
                'eyebrow' => 'Featured Game',
                'heading' => 'Dark Biome se apoya en atmosfera, exploracion y tension ambiental.',
                'lead' => 'La propuesta es un juego corto de exploracion donde el mapa, la vegetacion y el tono visual llevan el peso principal. La narrativa se descubre caminando y observando.',
                'highlights' => [
                    'Aventura atmosferica para Switch.',
                    'Mundo compacto con narrativa ambiental.',
                    'Direccion artistica por encima del exceso de sistemas.',
                ],
                'sections' => [
                    [
                        'title' => 'Fantasia del juego',
                        'body' => 'La fantasia es perderse en un lugar hostil y bello a la vez. El jugador avanza por curiosidad, inquietud y pequeñas recompensas visuales.',
                    ],
                    [
                        'title' => 'Porque funciona',
                        'body' => 'El ritmo pausado, el color contenido y la forma del entorno construyen identidad sin depender de demasiados sistemas paralelos.',
                    ],
                    [
                        'title' => 'Tipo de experiencia',
                        'body' => 'Es una experiencia contemplativa pero tensa, ideal para sesiones cortas donde la inmersion importa mas que la velocidad.',
                    ],
                    [
                        'title' => 'Relacion con el portfolio',
                        'body' => 'Sirve para enseñar worldbuilding, mood art y coherencia visual en una sola pieza.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Volver a la home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Ver proyecto principal', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
            'rogue-build' => [
                'title' => 'Rogue Build | Swap RPG Universe',
                'description' => 'Breve presentacion de Rogue Build como juego de accion y sigilo terminado.',
                'eyebrow' => 'Featured Game',
                'heading' => 'Rogue Build mezcla sigilo ligero, movilidad y lectura clara del personaje.',
                'lead' => 'Se plantea como un dungeon crawler rapido donde el placer viene de moverse bien, desaparecer a tiempo y ejecutar rutas limpias con una silueta muy reconocible.',
                'highlights' => [
                    'Dungeon crawler para PlayStation.',
                    'Stealth ligero y movilidad agresiva.',
                    'Identidad visual sostenida por una protagonista muy clara.',
                ],
                'sections' => [
                    [
                        'title' => 'Fantasia del juego',
                        'body' => 'La fantasia es dominar el espacio sin hacer ruido. Cada sala invita a leer lineas de vision, rutas y ventanas de escape.',
                    ],
                    [
                        'title' => 'Porque funciona',
                        'body' => 'La legibilidad del personaje y el ritmo de movimiento permiten que la experiencia sea rapida sin perder claridad.',
                    ],
                    [
                        'title' => 'Tipo de experiencia',
                        'body' => 'Es un juego pensado para runs cortas, con sensacion de dominio creciente y recompensa inmediata por ejecutar mejor.',
                    ],
                    [
                        'title' => 'Relacion con el portfolio',
                        'body' => 'Aporta una pieza centrada en character readability, silueta y animacion funcional.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Volver a la home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Ver proyecto principal', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
            'liminal-zone' => [
                'title' => 'Liminal Zone | Swap RPG Universe',
                'description' => 'Breve presentacion de Liminal Zone como experiencia narrativa terminada.',
                'eyebrow' => 'Featured Game',
                'heading' => 'Liminal Zone funciona como una experiencia narrativa corta y extraña.',
                'lead' => 'La idea es un juego breve donde el espacio es el protagonista: pasillos silenciosos, arquitectura imposible y una tension sutil que nunca desaparece.',
                'highlights' => [
                    'Experiencia narrativa para Switch y Xbox.',
                    'Espacios surrealistas y tension sostenida.',
                    'Progreso basado en curiosidad y atmosfera.',
                ],
                'sections' => [
                    [
                        'title' => 'Fantasia del juego',
                        'body' => 'La fantasia es entrar en un lugar que no deberia existir y seguir avanzando por pura necesidad de entenderlo.',
                    ],
                    [
                        'title' => 'Porque funciona',
                        'body' => 'La experiencia depende de tono, encuadre y silencio. Todo esta calibrado para que el jugador permanezca inquieto y curioso.',
                    ],
                    [
                        'title' => 'Tipo de experiencia',
                        'body' => 'Es una obra corta, contemplativa y con un final muy definido, mas cercana a una pieza atmosferica que a un sandbox.',
                    ],
                    [
                        'title' => 'Relacion con el portfolio',
                        'body' => 'Permite enseñar atmosfera, direccion visual y control del ritmo emocional en una sola pagina.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Volver a la home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Ver proyecto principal', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
        ],
        'en' => [
            'project' => [
                'title' => 'Swap RPG | Main project',
                'description' => 'Main Swap RPG project page with overview, world, gameplay, systems, and key links.',
                'eyebrow' => 'Main Project',
                'heading' => 'Swap RPG on one clear page.',
                'lead' => 'This page is meant to tell the whole project story without forcing people through six small sections. It explains what the project is, how it plays, what it proves technically, and where to follow it.',
                'highlights' => [
                    '2D RPG built in Java and Swing with a playable prototype.',
                    'Dark fantasy visual direction with its own identity.',
                    'Visible technical foundation: loop, camera, collisions, entities, and combat.',
                ],
                'sections' => [
                    [
                        'title' => 'What Swap RPG is',
                        'body' => 'Swap RPG is the flagship project of the portfolio. It is positioned as a mix of playable showcase and technical case study: a compact demo that presents visual tone, player control, worldbuilding, and architecture decisions.',
                    ],
                    [
                        'title' => 'What a fast visitor should understand',
                        'body' => 'Within a few seconds, someone should see that the project is real, that it has a recognizable identity, and that there is technical judgment behind it. That is why this page concentrates the overview, reused images, main systems, and repository links.',
                    ],
                    [
                        'title' => 'Project blocks',
                        'body' => 'The content that used to be spread across separate milestones is summarized here instead: gameplay and controls, world atmosphere, entities and enemies, combat and visual feedback, and a simple reading of the technical base.',
                    ],
                    [
                        'title' => 'Recommended next split',
                        'body' => 'If an extra page is needed later, the only strong split is a dedicated systems page. Everything else should stay grouped so the project does not become unnecessarily fragmented.',
                    ],
                ],
                'actions' => [
                    ['label' => 'View repository', 'href' => $site['github_rpg'], 'variant' => 'primary', 'external' => true, 'icon' => 'fab fa-github'],
                    ['label' => 'Download demo', 'href' => asset_url('downloads/demo.zip'), 'variant' => 'secondary', 'external' => true, 'icon' => 'fas fa-download'],
                    ['label' => 'Go to contact', 'href' => with_lang(page_url('contact')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-envelope'],
                ],
            ],
            'contact' => [
                'title' => 'Contact | Swap RPG',
                'description' => 'Contact page for project questions, collaborations, or follow-up.',
                'eyebrow' => 'Contact',
                'heading' => 'A simple, direct contact point.',
                'lead' => 'This site does not need a complex contact form yet. What matters is being clear about why to reach out and which channel to use.',
                'highlights' => [
                    'Project and repository questions.',
                    'Collaboration, feedback, or work opportunities.',
                    'Follow-up on future site updates.',
                ],
                'sections' => [
                    [
                        'title' => 'Main email',
                        'body' => 'The main channel is the project email. It is the right option for professional contact, project questions, or concrete proposals.',
                    ],
                    [
                        'title' => 'What to include',
                        'body' => 'To speed things up, include the reason for your message, whether it is about Swap RPG or the portfolio site, and any useful links or context.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Send email', 'href' => 'mailto:' . $site['contact_email'], 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-envelope'],
                    ['label' => 'View swap-rpg', 'href' => $site['github_rpg'], 'variant' => 'secondary', 'external' => true, 'icon' => 'fab fa-github'],
                ],
            ],
            'help' => [
                'title' => 'Help | Swap RPG',
                'description' => 'Lightweight help page for the public project site and demo.',
                'eyebrow' => 'Help',
                'heading' => 'Light help for a small site.',
                'lead' => 'This section exists to answer basic questions without turning the site into a full support application.',
                'highlights' => [
                    'Where to find the main project.',
                    'How to download the current demo.',
                    'Which parts of the site are public and which are provisional.',
                ],
                'sections' => [
                    [
                        'title' => 'If you want to see the project',
                        'body' => 'The main entry points are the homepage and the project page. From there it should be clear how to open the repository, download the demo, or review the most important visual material.',
                    ],
                    [
                        'title' => 'If something looks provisional',
                        'body' => 'Some names, text, or sections may still change. This site is still transitioning from a milestone-based structure to a clearer portfolio and showcase structure.',
                    ],
                    [
                        'title' => 'If you need more context',
                        'body' => 'When a page does not answer a specific question well enough, the correct next step is to use the contact page instead of multiplying FAQ pages.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Open project page', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                    ['label' => 'Contact', 'href' => with_lang(page_url('contact')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-envelope'],
                ],
            ],
            'privacy' => [
                'title' => 'Privacy | Swap RPG',
                'description' => 'Current privacy summary and data handling notes for the site.',
                'eyebrow' => 'Privacy',
                'heading' => 'A simple, honest privacy page.',
                'lead' => 'This page should reflect the real state of the site today, not an inflated policy for features that do not exist yet.',
                'highlights' => [
                    'No public account is required to browse the site.',
                    'The site uses a language cookie to remember preference.',
                    'It does not claim data collection that is not actually happening.',
                ],
                'sections' => [
                    [
                        'title' => 'Minimal data',
                        'body' => 'The public site does not currently depend on complex forms or payments. The main visible information handled is the language preference and the basic technical information generated by any web request.',
                    ],
                    [
                        'title' => 'Contact by email',
                        'body' => 'If you contact the project by email, the data you include in that message is used only to reply and continue the related conversation.',
                    ],
                    [
                        'title' => 'Future changes',
                        'body' => 'If analytics, real forms, or user accounts are added later, this page must be updated at the same time to describe those changes concretely.',
                    ],
                ],
                'actions' => [
                    ['label' => 'View cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Contact', 'href' => with_lang(page_url('contact')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-envelope'],
                ],
            ],
            'cookies' => [
                'title' => 'Cookies | Swap RPG',
                'description' => 'Cookie policy for the site in its current state.',
                'eyebrow' => 'Cookies',
                'heading' => 'Explain only the cookies that exist.',
                'lead' => 'The cookie policy should stay small while the site stays small.',
                'highlights' => [
                    'Language cookie to remember ES or EN.',
                    'No false promise of banners or categories that are not in use.',
                    'Must be updated if analytics or external services are added later.',
                ],
                'sections' => [
                    [
                        'title' => 'Current cookie',
                        'body' => 'The site uses the language cookie to remember browsing preference. Its purpose is functional: it avoids asking for the language on every visit.',
                    ],
                    [
                        'title' => 'Keep the policy honest',
                        'body' => 'As long as there are no marketing cookies, advanced personalization, or third-party analytics, this page should stay short and precise.',
                    ],
                    [
                        'title' => 'If more cookies are added',
                        'body' => 'At that point this page must be updated and the site should be evaluated for a real consent banner if it becomes necessary.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Back to privacy', 'href' => with_lang(page_url('privacy')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-shield-halved'],
                    ['label' => 'Go home', 'href' => with_lang(page_url('')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-house'],
                ],
            ],
            'class-select' => [
                'title' => 'Class Select | Swap RPG Universe',
                'description' => 'Brief overview of Class Select as a finished game in the portfolio universe.',
                'eyebrow' => 'Featured Game',
                'heading' => 'Class Select turns class choice into the core of the whole run.',
                'lead' => 'It is framed as a short tactical RPG where every run begins with a strong decision: which role each party member fills and how that changes the combat that follows.',
                'highlights' => [
                    'Short tactical RPG for PC and PlayStation.',
                    'Focused on class readability and party composition.',
                    'Short runs with sharply different builds from the start.',
                ],
                'sections' => [
                    [
                        'title' => 'Game fantasy',
                        'body' => 'The core idea is that choosing a class should not feel like a formality. It should be the most important moment in the run. Each class changes abilities, positioning, and tactical rhythm.',
                    ],
                    [
                        'title' => 'Why it works',
                        'body' => 'The game leans on clear interfaces, strong iconography, and fast decisions. Team readability is immediate, so strategy starts before the first fight.',
                    ],
                    [
                        'title' => 'Experience type',
                        'body' => 'It is a compact experience built for short sessions where party setup and combination variety create replayability.',
                    ],
                    [
                        'title' => 'Portfolio role',
                        'body' => 'It helps present UX judgment, selection flow, and visual clarity, not just art direction.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Back home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Open flagship project', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
            'combat-slice' => [
                'title' => 'Combat Slice | Swap RPG Universe',
                'description' => 'Brief overview of Combat Slice as a finished game in the portfolio.',
                'eyebrow' => 'Featured Game',
                'heading' => 'Combat Slice pushes direct combat and threat readability to the front.',
                'lead' => 'It is imagined as a short action RPG where the appeal comes from tense encounters, readable enemies, and a tightly concentrated combat arc rather than a huge map.',
                'highlights' => [
                    'Compact action RPG for PC and Xbox.',
                    'Intense encounters with clear telegraphs.',
                    'Short progression built around system mastery.',
                ],
                'sections' => [
                    [
                        'title' => 'Game fantasy',
                        'body' => 'The main fantasy is that every encounter matters. The player enters, reads patterns, punishes openings, and improves through knowledge rather than filler progression.',
                    ],
                    [
                        'title' => 'Why it works',
                        'body' => 'Animation clarity, space readability, and enemy behavior keep the system demanding without becoming noisy.',
                    ],
                    [
                        'title' => 'Experience type',
                        'body' => 'It is a short, repeatable experience for players who enjoy learning timings, response windows, and target priority.',
                    ],
                    [
                        'title' => 'Portfolio role',
                        'body' => 'This piece emphasizes systems design, visual feedback, and combat readability.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Back home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Open flagship project', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
            'dark-biome' => [
                'title' => 'Dark Biome | Swap RPG Universe',
                'description' => 'Brief overview of Dark Biome as a finished atmospheric game in the portfolio.',
                'eyebrow' => 'Featured Game',
                'heading' => 'Dark Biome leans on atmosphere, exploration, and environmental tension.',
                'lead' => 'The concept is a short exploration game where the map, vegetation, and visual tone carry most of the weight. The story is discovered by moving and observing.',
                'highlights' => [
                    'Atmospheric adventure for Switch.',
                    'Compact world with environmental storytelling.',
                    'Art direction prioritized over system excess.',
                ],
                'sections' => [
                    [
                        'title' => 'Game fantasy',
                        'body' => 'The fantasy is to get lost in a place that feels hostile and beautiful at the same time. The player moves forward through curiosity, unease, and small visual rewards.',
                    ],
                    [
                        'title' => 'Why it works',
                        'body' => 'Measured pacing, restrained color, and the shape of the environment build identity without relying on too many side systems.',
                    ],
                    [
                        'title' => 'Experience type',
                        'body' => 'It is contemplative but tense, built for short sessions where immersion matters more than speed.',
                    ],
                    [
                        'title' => 'Portfolio role',
                        'body' => 'It presents worldbuilding, mood art, and visual coherence in one piece.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Back home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Open flagship project', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
            'rogue-build' => [
                'title' => 'Rogue Build | Swap RPG Universe',
                'description' => 'Brief overview of Rogue Build as a finished stealth-action game.',
                'eyebrow' => 'Featured Game',
                'heading' => 'Rogue Build mixes light stealth, mobility, and clear character readability.',
                'lead' => 'It is framed as a fast dungeon crawler where the pleasure comes from moving well, vanishing on time, and executing clean routes with a very readable protagonist.',
                'highlights' => [
                    'Dungeon crawler for PlayStation.',
                    'Light stealth and aggressive mobility.',
                    'Strong visual identity built around a readable lead character.',
                ],
                'sections' => [
                    [
                        'title' => 'Game fantasy',
                        'body' => 'The fantasy is to master the space without making noise. Each room invites the player to read sightlines, routes, and escape windows.',
                    ],
                    [
                        'title' => 'Why it works',
                        'body' => 'Character readability and movement rhythm keep the experience fast without sacrificing clarity.',
                    ],
                    [
                        'title' => 'Experience type',
                        'body' => 'It is designed for short runs, growing mastery, and immediate reward for cleaner execution.',
                    ],
                    [
                        'title' => 'Portfolio role',
                        'body' => 'It adds a piece centered on character readability, silhouette, and functional animation.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Back home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Open flagship project', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
            'liminal-zone' => [
                'title' => 'Liminal Zone | Swap RPG Universe',
                'description' => 'Brief overview of Liminal Zone as a finished narrative experience.',
                'eyebrow' => 'Featured Game',
                'heading' => 'Liminal Zone works as a short, strange narrative experience.',
                'lead' => 'The concept is a brief game where space itself is the protagonist: silent corridors, impossible architecture, and a quiet tension that never disappears.',
                'highlights' => [
                    'Narrative experience for Switch and Xbox.',
                    'Surreal spaces and sustained tension.',
                    'Progress built around curiosity and atmosphere.',
                ],
                'sections' => [
                    [
                        'title' => 'Game fantasy',
                        'body' => 'The fantasy is to step into a place that should not exist and keep walking out of pure need to understand it.',
                    ],
                    [
                        'title' => 'Why it works',
                        'body' => 'The experience depends on tone, framing, and silence. Everything is tuned to keep the player curious and unsettled.',
                    ],
                    [
                        'title' => 'Experience type',
                        'body' => 'It is a short, contemplative work with a defined ending, closer to an atmospheric piece than a sandbox.',
                    ],
                    [
                        'title' => 'Portfolio role',
                        'body' => 'It showcases atmosphere, visual direction, and control of emotional pacing on a single page.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Back home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Open flagship project', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
        ],
    ];

    $localized = $pages[$lang] ?? $pages['es'];
    if (!isset($localized[$slug])) {
        throw new InvalidArgumentException('Unknown site page: ' . $slug);
    }

    return $localized[$slug];
}
