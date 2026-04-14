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
            'store' => [
                'title' => 'Store | Swap RPG',
                'description' => 'Pagina reservada para futuros productos y merch de Swap.',
                'eyebrow' => 'Store',
                'heading' => 'La tienda sera el espacio para merch y compras reales.',
                'lead' => 'Esta pagina separa claramente el apoyo al proyecto de las futuras compras. Las contribuciones siguen en el area de soporte; los productos, merch o extras iran aqui.',
                'highlights' => [
                    'Espacio reservado para merch y productos del proyecto.',
                    'Separacion clara entre apoyo voluntario y compras.',
                    'Base preparada para crecer sin mezclar conceptos.',
                ],
                'sections' => [
                    [
                        'title' => 'Que ira en Store',
                        'body' => 'Cuando existan articulos reales, este sera el lugar para merch, bundles, extras digitales o cualquier compra con logica de producto.',
                    ],
                    [
                        'title' => 'Que no va aqui',
                        'body' => 'Las contribuciones voluntarias y el supporter tier no deberian vivir en la tienda. Es mejor mantener el apoyo al proyecto como una accion separada y mas clara.',
                    ],
                    [
                        'title' => 'Estado actual',
                        'body' => 'Por ahora la tienda es una pagina placeholder. Existe para fijar la estructura correcta antes de mezclar donaciones, apoyo y compras en un mismo flujo.',
                    ],
                    [
                        'title' => 'Siguiente paso razonable',
                        'body' => 'Si mas adelante añades productos, esta pagina puede crecer hacia un catalogo ligero con fichas, precio y una historia de pedidos independiente del area de soporte.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Volver al inicio', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Ir al perfil', 'href' => with_lang(page_url('account')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-user'],
                    ['label' => 'Ver proyecto', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
            'legal-notice' => [
                'title' => 'Aviso legal | Swap RPG',
                'description' => 'Aviso legal y condiciones generales de uso del sitio Swap RPG.',
                'eyebrow' => 'Aviso legal',
                'heading' => 'Informacion legal basica del sitio.',
                'lead' => 'Esta pagina reune la informacion general del sitio, sus condiciones de uso y el marco minimo previo a un lanzamiento publico.',
                'highlights' => [
                    'Titular identificado por nombre del proyecto y correo de contacto.',
                    'Uso del contenido sujeto a propiedad intelectual del proyecto.',
                    'Pendiente de completar con datos fiscales o postales reales antes de actividad comercial plena.',
                ],
                'sections' => [
                    [
                        'title' => 'Titular del sitio',
                        'body' => 'El sitio Swap RPG se presenta bajo el nombre del proyecto "' . $site['name'] . '". El canal principal de contacto es ' . $site['contact_email'] . '. Si el proyecto pasa a una actividad comercial estable, esta pagina debe completarse con la identidad legal completa, domicilio y, en su caso, datos registrales o fiscales aplicables.',
                    ],
                    [
                        'title' => 'Objeto del sitio',
                        'body' => 'La web muestra informacion del proyecto, portfolio, demo descargable, enlaces publicos y una zona privada de cuenta o soporte para usuarios autenticados. El acceso y uso del sitio implican aceptar estas condiciones basicas de navegacion.',
                    ],
                    [
                        'title' => 'Propiedad intelectual',
                        'body' => 'Textos, imagenes, marcas, interfaces, codigo y materiales del proyecto pertenecen a su autor o se usan con autorizacion. No se permite la reproduccion, distribucion o reutilizacion comercial sin permiso previo, salvo cuando una licencia publica indique expresamente lo contrario.',
                    ],
                    [
                        'title' => 'Responsabilidad y enlaces externos',
                        'body' => 'El sitio intenta mantener informacion razonablemente correcta, pero puede contener errores, cambios o secciones provisionales. Los enlaces externos, incluidos repositorios o proveedores de pago, dependen de servicios de terceros y pueden tener sus propias condiciones y politicas.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Aviso legal', 'href' => with_lang(page_url('aviso-legal')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-scale-balanced'],
                    ['label' => 'Privacidad', 'href' => with_lang(page_url('privacy')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-user-shield'],
                    ['label' => 'Cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Pagos', 'href' => with_lang(page_url('payment-disclaimer')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Terminos', 'href' => with_lang(page_url('support-terms')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-hand-holding-heart'],
                    ['label' => 'Contactar', 'href' => with_lang(page_url('contact')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-envelope', 'align' => 'end'],
                ],
            ],
            'privacy' => [
                'title' => 'Privacidad | Swap RPG',
                'description' => 'Politica de privacidad y tratamiento de datos del sitio Swap RPG.',
                'eyebrow' => 'Privacidad',
                'heading' => 'Politica de privacidad basada en el funcionamiento real del sitio.',
                'lead' => 'Esta politica describe los datos que se tratan al navegar, iniciar sesion, contactar o apoyar el proyecto, sin atribuir al sitio practicas que hoy no existen.',
                'highlights' => [
                    'No se almacenan numeros completos de tarjeta ni codigos CVC/CVV en este servidor.',
                    'El tratamiento principal cubre navegacion, idioma, sesion, correo de contacto y metadatos de contribucion.',
                    'Los pagos se gestionan mediante Stripe y su propia politica de privacidad.',
                ],
                'sections' => [
                    [
                        'title' => 'Responsable y datos tratados',
                        'body' => 'El responsable del sitio opera bajo el proyecto "' . $site['name'] . '" y puede ser contactado en ' . $site['contact_email'] . '. Los datos tratados pueden incluir direccion IP, registros tecnicos de acceso, preferencia de idioma, datos de sesion, correo de contacto y, si realizas una contribucion, correo del usuario, importe, divisa, estado e identificadores tecnicos asociados a la sesion de pago.',
                    ],
                    [
                        'title' => 'Finalidades y base juridica',
                        'body' => 'Los datos se usan para prestar la navegacion basica del sitio, mantener la sesion cuando el usuario accede a su cuenta, recordar la eleccion de idioma y consentimiento de cookies, responder mensajes enviados al correo del proyecto, gestionar contribuciones voluntarias y activar analitica solo si el usuario la acepta. La base juridica depende del caso: interes legitimo para seguridad y funcionamiento tecnico, ejecucion de medidas precontractuales o contractuales para cuenta y soporte, y consentimiento cuando corresponda para preferencias o cookies no tecnicas.',
                    ],
                    [
                        'title' => 'Destinatarios y pagos',
                        'body' => 'Los datos pueden ser tratados por proveedores necesarios para alojamiento, correo o servicios tecnicos. Si realizas una contribucion, el pago se canaliza mediante Stripe. Este sitio no almacena numeros completos de tarjeta ni codigos de seguridad; solo conserva metadatos de la operacion necesarios para verificar estado, auditoria tecnica o atencion de incidencias.',
                    ],
                    [
                        'title' => 'Conservacion y derechos',
                        'body' => 'Los datos se conservan durante el tiempo necesario para la finalidad correspondiente y para cumplir obligaciones legales o defender reclamaciones. Puedes solicitar acceso, rectificacion, supresion, oposicion, limitacion o portabilidad escribiendo a ' . $site['contact_email'] . '. Si consideras que el tratamiento no es correcto, puedes acudir a la autoridad de control competente.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Aviso legal', 'href' => with_lang(page_url('aviso-legal')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-scale-balanced'],
                    ['label' => 'Privacidad', 'href' => with_lang(page_url('privacy')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-user-shield'],
                    ['label' => 'Cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Pagos', 'href' => with_lang(page_url('payment-disclaimer')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Terminos', 'href' => with_lang(page_url('support-terms')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-hand-holding-heart'],
                    ['label' => 'Contactar', 'href' => with_lang(page_url('contact')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-envelope', 'align' => 'end'],
                ],
            ],
            'cookies' => [
                'title' => 'Cookies | Swap RPG',
                'description' => 'Politica de cookies y preferencias de consentimiento del sitio Swap RPG.',
                'eyebrow' => 'Cookies',
                'heading' => 'Cookies realmente usadas por el sitio.',
                'lead' => 'La politica de cookies debe reflejar solo las cookies activas hoy y la forma en la que el usuario puede aceptar o limitar preferencias.',
                'highlights' => [
                    'Cookies tecnicas para idioma, sesion y recordatorio del consentimiento.',
                    'Sin analitica ni marketing activados por defecto en esta version.',
                    'La capa de cookies permite guardar la eleccion del usuario para futuras visitas.',
                ],
                'sections' => [
                    [
                        'title' => 'Cookies tecnicas propias',
                        'body' => 'El sitio puede usar una cookie de idioma para recordar ES o EN, una cookie o sesion tecnica de PHP cuando el usuario inicia sesion y una cookie de consentimiento para recordar la decision tomada en el banner. Estas cookies son funcionales y sirven para que la navegacion, la cuenta y las preferencias basicas funcionen correctamente.',
                    ],
                    [
                        'title' => 'Cookies de terceros y pagos',
                        'body' => 'El sitio solo carga analitica si el usuario la acepta desde el banner. Si el usuario pasa al entorno de pago de Stripe, ese proveedor puede aplicar sus propias cookies o mecanismos tecnicos dentro de su dominio y bajo sus propias politicas.',
                    ],
                    [
                        'title' => 'Gestion del consentimiento',
                        'body' => 'El banner permite aceptar o rechazar el uso de analitica y cookies no esenciales. La eleccion se guarda para no repetir la pregunta en cada visita. Si cambian las finalidades o se activan cookies nuevas, esta pagina y el banner tendran que actualizarse.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Aviso legal', 'href' => with_lang(page_url('aviso-legal')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-scale-balanced'],
                    ['label' => 'Privacidad', 'href' => with_lang(page_url('privacy')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-user-shield'],
                    ['label' => 'Cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Pagos', 'href' => with_lang(page_url('payment-disclaimer')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Terminos', 'href' => with_lang(page_url('support-terms')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-hand-holding-heart'],
                    ['label' => 'Contactar', 'href' => with_lang(page_url('contact')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-envelope', 'align' => 'end'],
                ],
            ],
            'payment-disclaimer' => [
                'title' => 'Pagos | Swap RPG',
                'description' => 'Aviso sobre procesamiento de pagos y alcance del sitio respecto a datos de pago.',
                'eyebrow' => 'Pagos',
                'heading' => 'Como se gestionan las contribuciones.',
                'lead' => 'El sitio no procesa directamente datos completos de tarjeta. Las contribuciones se redirigen a la pasarela externa configurada, actualmente Stripe.',
                'highlights' => [
                    'Pagos gestionados por Stripe, no por formularios propios del servidor.',
                    'Sin almacenamiento de PAN completo ni CVC/CVV en la base de datos local.',
                    'Solo se conservan metadatos necesarios para estado, soporte y auditoria tecnica.',
                ],
                'sections' => [
                    [
                        'title' => 'Proveedor de pago',
                        'body' => 'Las contribuciones se procesan mediante Stripe cuando el servicio esta habilitado. Este sitio puede crear una sesion de contribucion y redirigir al usuario al entorno del proveedor, pero no solicita ni almacena directamente numeros completos de tarjeta, fechas de expiracion completas ni codigos de seguridad.',
                    ],
                    [
                        'title' => 'Datos que si conserva el sitio',
                        'body' => 'Para poder mostrar historial, verificar estados y atender incidencias, el sitio puede conservar correo del usuario, importe, divisa, identificadores tecnicos de la sesion, estado de la contribucion y marcas temporales. Estos datos no sustituyen a la informacion financiera completa gestionada por el proveedor de pago.',
                    ],
                    [
                        'title' => 'Alcance del aviso',
                        'body' => 'Este aviso solo cubre el comportamiento del sitio Swap RPG. El tratamiento de datos realizado por Stripe dentro de su propio servicio se rige por la documentacion y politica de privacidad del proveedor.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Aviso legal', 'href' => with_lang(page_url('aviso-legal')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-scale-balanced'],
                    ['label' => 'Privacidad', 'href' => with_lang(page_url('privacy')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-user-shield'],
                    ['label' => 'Cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Pagos', 'href' => with_lang(page_url('payment-disclaimer')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Terminos', 'href' => with_lang(page_url('support-terms')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-hand-holding-heart'],
                    ['label' => 'Contactar', 'href' => with_lang(page_url('contact')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-envelope', 'align' => 'end'],
                ],
            ],
            'support-terms' => [
                'title' => 'Terminos de apoyo | Swap RPG',
                'description' => 'Condiciones aplicables a contribuciones voluntarias y supporter tier en Swap RPG.',
                'eyebrow' => 'Apoyo',
                'heading' => 'Condiciones de las contribuciones voluntarias.',
                'lead' => 'El area de apoyo esta pensada para contribuciones voluntarias al proyecto. No equivale automaticamente a una tienda ni a la compraventa de merch o productos fisicos.',
                'highlights' => [
                    'El supporter tier es una contribucion voluntaria al proyecto.',
                    'Las futuras compras de tienda tendran terminos separados.',
                    'Reembolsos limitados a supuestos concretos o exigidos por ley.',
                ],
                'sections' => [
                    [
                        'title' => 'Naturaleza de la contribucion',
                        'body' => 'Salvo que se indique expresamente otra cosa, el supporter tier representa una aportacion voluntaria de apoyo al proyecto y no la compra de un bien fisico ni la concesion automatica de derechos adicionales distintos de los que se describan publicamente.',
                    ],
                    [
                        'title' => 'Reembolsos',
                        'body' => 'Como regla general, las contribuciones voluntarias no son reembolsables una vez confirmadas, salvo cargo duplicado, error tecnico manifiesto, uso fraudulento acreditado o cuando una norma aplicable obligue a ello. Las solicitudes pueden dirigirse a ' . $site['contact_email'] . ' con la informacion necesaria para identificar la operacion.',
                    ],
                    [
                        'title' => 'Separacion respecto a la tienda',
                        'body' => 'Si en el futuro se habilitan productos, merch o contenidos de pago en la tienda, esas operaciones tendran sus propios terminos, condiciones de compra y politica de reembolso independientes del area de apoyo.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Aviso legal', 'href' => with_lang(page_url('aviso-legal')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-scale-balanced'],
                    ['label' => 'Privacidad', 'href' => with_lang(page_url('privacy')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-user-shield'],
                    ['label' => 'Cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Pagos', 'href' => with_lang(page_url('payment-disclaimer')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Terminos', 'href' => with_lang(page_url('support-terms')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-hand-holding-heart'],
                    ['label' => 'Contactar', 'href' => with_lang(page_url('contact')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-envelope', 'align' => 'end'],
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
            'store' => [
                'title' => 'Store | Swap RPG',
                'description' => 'Reserved page for future Swap products and merch.',
                'eyebrow' => 'Store',
                'heading' => 'The store will be the place for merch and real purchases.',
                'lead' => 'This page cleanly separates project support from future purchases. Contributions stay in the support area; products, merch, or extras will live here.',
                'highlights' => [
                    'Reserved space for merch and project products.',
                    'Clear split between voluntary support and purchases.',
                    'A cleaner structure for future growth.',
                ],
                'sections' => [
                    [
                        'title' => 'What goes in Store',
                        'body' => 'When real items exist, this is where merch, bundles, digital extras, or any product-based purchase flow should live.',
                    ],
                    [
                        'title' => 'What does not go here',
                        'body' => 'Voluntary contributions and the supporter tier should stay outside the store. It is better to keep project support as a separate, clearer action.',
                    ],
                    [
                        'title' => 'Current status',
                        'body' => 'For now the store is a placeholder page. Its purpose is to establish the right structure before support and purchases get mixed into one flow.',
                    ],
                    [
                        'title' => 'Reasonable next step',
                        'body' => 'If you add products later, this page can grow into a light catalog with product cards, price, and its own order history separate from support.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Back home', 'href' => with_lang(page_url('')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-house'],
                    ['label' => 'Go to profile', 'href' => with_lang(page_url('account')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-user'],
                    ['label' => 'View project', 'href' => with_lang(page_url('projects/swap-rpg')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-gamepad'],
                ],
            ],
            'legal-notice' => [
                'title' => 'Legal notice | Swap RPG',
                'description' => 'Legal notice and general site terms for Swap RPG.',
                'eyebrow' => 'Legal notice',
                'heading' => 'Basic legal information about the site.',
                'lead' => 'This page gathers the site’s general information, basic terms of use, and the minimum legal framework expected before a public launch.',
                'highlights' => [
                    'Site operator identified by project name and contact email.',
                    'Content use remains subject to project intellectual property rights.',
                    'Still needs real fiscal or postal details before full commercial activity.',
                ],
                'sections' => [
                    [
                        'title' => 'Site operator',
                        'body' => 'The site is presented under the project name "' . $site['name'] . '". The main contact channel is ' . $site['contact_email'] . '. If the project becomes a stable commercial activity, this page should be completed with the full legal identity, postal address, and any applicable registry or tax information.',
                    ],
                    [
                        'title' => 'Purpose of the site',
                        'body' => 'The website presents project information, a portfolio, a downloadable demo, public links, and a private account or support area for authenticated users. Accessing and using the site implies acceptance of these basic browsing terms.',
                    ],
                    [
                        'title' => 'Intellectual property',
                        'body' => 'Texts, images, brands, interfaces, code, and project materials belong to their author or are used with permission. Reproduction, distribution, or commercial reuse is not allowed without prior authorization unless a public license expressly states otherwise.',
                    ],
                    [
                        'title' => 'Liability and external links',
                        'body' => 'The site aims to keep information reasonably accurate, but it may contain errors, changes, or provisional sections. External links, including repositories or payment providers, depend on third-party services and may be subject to their own terms and policies.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Legal notice', 'href' => with_lang(page_url('aviso-legal')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-scale-balanced'],
                    ['label' => 'Privacy', 'href' => with_lang(page_url('privacy')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-user-shield'],
                    ['label' => 'Cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Payments', 'href' => with_lang(page_url('payment-disclaimer')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Terms', 'href' => with_lang(page_url('support-terms')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-hand-holding-heart'],
                    ['label' => 'Contact', 'href' => with_lang(page_url('contact')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-envelope', 'align' => 'end'],
                ],
            ],
            'privacy' => [
                'title' => 'Privacy | Swap RPG',
                'description' => 'Privacy policy and data handling information for the Swap RPG site.',
                'eyebrow' => 'Privacy',
                'heading' => 'A privacy policy based on how the site actually works.',
                'lead' => 'This policy describes the data processed when you browse, sign in, contact the project, or support it, without claiming practices the site does not currently perform.',
                'highlights' => [
                    'No full card numbers or CVC/CVV codes are stored on this server.',
                    'The main processing covers browsing, language, session, contact email, and support metadata.',
                    'Payments are handled through Stripe and subject to the provider’s own privacy documentation.',
                ],
                'sections' => [
                    [
                        'title' => 'Controller and processed data',
                        'body' => 'The site is operated under the "' . $site['name'] . '" project and can be contacted at ' . $site['contact_email'] . '. Processed data may include IP address, technical access logs, language preference, session data, contact email content, and, if you make a contribution, user email, amount, currency, status, and technical identifiers associated with the payment session.',
                    ],
                    [
                        'title' => 'Purposes and legal basis',
                        'body' => 'Data is used to provide basic browsing, maintain the session when a user signs in, remember language and cookie choices, reply to project emails, manage voluntary contributions, and enable analytics only if the user accepts it. The legal basis depends on the case: legitimate interest for security and technical operation, contract or pre-contract measures for account and support functions, and consent where applicable for preferences or non-essential cookies.',
                    ],
                    [
                        'title' => 'Recipients and payments',
                        'body' => 'Data may be processed by providers needed for hosting, email, or technical infrastructure. If you make a contribution, the payment is routed through Stripe. This site does not store full card numbers or security codes; it only keeps operation metadata needed for status verification, technical auditing, or support.',
                    ],
                    [
                        'title' => 'Retention and rights',
                        'body' => 'Data is kept only for as long as necessary for the relevant purpose and to meet legal obligations or handle claims. You can request access, rectification, erasure, objection, restriction, or portability by writing to ' . $site['contact_email'] . '. If you believe processing is not compliant, you may contact the relevant supervisory authority.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Legal notice', 'href' => with_lang(page_url('aviso-legal')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-scale-balanced'],
                    ['label' => 'Privacy', 'href' => with_lang(page_url('privacy')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-user-shield'],
                    ['label' => 'Cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Payments', 'href' => with_lang(page_url('payment-disclaimer')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Terms', 'href' => with_lang(page_url('support-terms')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-hand-holding-heart'],
                    ['label' => 'Contact', 'href' => with_lang(page_url('contact')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-envelope', 'align' => 'end'],
                ],
            ],
            'cookies' => [
                'title' => 'Cookies | Swap RPG',
                'description' => 'Cookie policy and consent preferences for the Swap RPG site.',
                'eyebrow' => 'Cookies',
                'heading' => 'Cookies the site actually uses.',
                'lead' => 'The cookie policy should reflect only the active cookies and the way users can accept or limit preferences.',
                'highlights' => [
                    'Technical cookies for language, session, and remembering consent.',
                    'No analytics or marketing cookies are enabled by default in this version.',
                    'The cookie layer stores the user’s choice for future visits.',
                ],
                'sections' => [
                    [
                        'title' => 'Own technical cookies',
                        'body' => 'The site may use a language cookie to remember ES or EN, a technical PHP session cookie when a user signs in, and a consent cookie to remember the decision taken in the banner. These cookies are functional and allow basic browsing, account access, and preference storage to work correctly.',
                    ],
                    [
                        'title' => 'Third-party cookies and payments',
                        'body' => 'The site only loads analytics if the user accepts it from the banner. If the user moves to Stripe’s payment environment, that provider may apply its own technical mechanisms or cookies inside its own domain and under its own policies.',
                    ],
                    [
                        'title' => 'Consent management',
                        'body' => 'The banner allows users to accept or reject analytics and other non-essential cookies. The decision is stored so the question is not repeated on every visit. If the purposes or cookies change later, this page and the banner will need to be updated.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Legal notice', 'href' => with_lang(page_url('aviso-legal')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-scale-balanced'],
                    ['label' => 'Privacy', 'href' => with_lang(page_url('privacy')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-user-shield'],
                    ['label' => 'Cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Payments', 'href' => with_lang(page_url('payment-disclaimer')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Terms', 'href' => with_lang(page_url('support-terms')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-hand-holding-heart'],
                    ['label' => 'Contact', 'href' => with_lang(page_url('contact')), 'variant' => 'secondary', 'external' => false, 'icon' => 'fas fa-envelope', 'align' => 'end'],
                ],
            ],
            'payment-disclaimer' => [
                'title' => 'Payments | Swap RPG',
                'description' => 'Notice about payment processing and what the site does or does not store.',
                'eyebrow' => 'Payments',
                'heading' => 'How contributions are handled.',
                'lead' => 'The site does not process full card data directly. Contributions are redirected to the configured external gateway, currently Stripe.',
                'highlights' => [
                    'Payments handled by Stripe, not by card forms hosted on this server.',
                    'No full PAN or CVC/CVV storage in the local database.',
                    'Only metadata needed for status, support, and technical auditing is kept.',
                ],
                'sections' => [
                    [
                        'title' => 'Payment provider',
                        'body' => 'Contributions are processed through Stripe when the service is enabled. This site may create a contribution session and redirect the user to the provider environment, but it does not request or store full card numbers, full expiration details, or security codes directly.',
                    ],
                    [
                        'title' => 'Data the site may retain',
                        'body' => 'To show history, verify status, and support incidents, the site may retain user email, amount, currency, technical session identifiers, contribution status, and timestamps. This does not replace the full financial data handled by the payment provider.',
                    ],
                    [
                        'title' => 'Scope of this notice',
                        'body' => 'This notice only covers the behavior of the Swap RPG site. Any data processing performed by Stripe within its own service is governed by the provider’s own documentation and privacy policy.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Legal notice', 'href' => with_lang(page_url('aviso-legal')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-scale-balanced'],
                    ['label' => 'Privacy', 'href' => with_lang(page_url('privacy')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-user-shield'],
                    ['label' => 'Cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Payments', 'href' => with_lang(page_url('payment-disclaimer')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Terms', 'href' => with_lang(page_url('support-terms')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-hand-holding-heart'],
                    ['label' => 'Contact', 'href' => with_lang(page_url('contact')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-envelope', 'align' => 'end'],
                ],
            ],
            'support-terms' => [
                'title' => 'Support terms | Swap RPG',
                'description' => 'Terms applicable to voluntary contributions and the supporter tier in Swap RPG.',
                'eyebrow' => 'Support',
                'heading' => 'Terms for voluntary contributions.',
                'lead' => 'The support area is meant for voluntary project contributions. It is not automatically the same as a store or a merch purchase flow.',
                'highlights' => [
                    'The supporter tier is a voluntary contribution to the project.',
                    'Future store purchases will have separate terms.',
                    'Refunds remain limited to specific cases or legal obligations.',
                ],
                'sections' => [
                    [
                        'title' => 'Nature of the contribution',
                        'body' => 'Unless expressly stated otherwise, the supporter tier is a voluntary contribution to support the project and not the purchase of a physical good or an automatic grant of extra rights beyond what is publicly described.',
                    ],
                    [
                        'title' => 'Refunds',
                        'body' => 'As a general rule, voluntary contributions are not refundable once confirmed, except in cases of duplicate charge, clear technical error, proven fraudulent use, or where applicable law requires it. Requests may be sent to ' . $site['contact_email'] . ' with enough information to identify the operation.',
                    ],
                    [
                        'title' => 'Separate from the store',
                        'body' => 'If products, merch, or paid content are added later in the store, those transactions will have their own purchase terms, checkout conditions, and refund policy separate from the support area.',
                    ],
                ],
                'actions' => [
                    ['label' => 'Legal notice', 'href' => with_lang(page_url('aviso-legal')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-scale-balanced'],
                    ['label' => 'Privacy', 'href' => with_lang(page_url('privacy')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-user-shield'],
                    ['label' => 'Cookies', 'href' => with_lang(page_url('cookies')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-cookie-bite'],
                    ['label' => 'Payments', 'href' => with_lang(page_url('payment-disclaimer')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Terms', 'href' => with_lang(page_url('support-terms')), 'variant' => 'primary', 'external' => false, 'icon' => 'fas fa-hand-holding-heart'],
                    ['label' => 'Contact', 'href' => with_lang(page_url('contact')), 'variant' => 'ghost', 'external' => false, 'icon' => 'fas fa-envelope', 'align' => 'end'],
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
