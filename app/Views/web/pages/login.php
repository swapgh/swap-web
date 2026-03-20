<?php
// Copias de contenido para el login en español e inglés
$copy = [
    'es' => [
        'title' => 'Acceder | Swap', // título de la página en español
        'description' => 'Pantalla de acceso de Swap.', // meta descripción
        'heading' => 'Sign in', // título del formulario
        'submit' => 'Continue with email', // texto del botón principal
        'or' => 'More sign-in options', // texto entre líneas de separación
        'providers_note' => 'Google, GitHub, Steam, and other providers can be added here later.', // nota de proveedores externos
        'banner_eyebrow' => 'Account layer', // texto pequeño encima del banner
        'banner_heading' => 'One sign-in point for the site, the game, and future account features.', // título del banner
        'banner_text' => 'Email works first. External providers and deeper account flows can be added on top without changing the overall layout.', // descripción del banner
        'email' => 'Correo', // etiqueta del input email
        'password' => 'Contrasena', // etiqueta del input password
        'provider_google' => 'Continue with Google', // botón de proveedor (deshabilitado)
        'provider_github' => 'Continue with GitHub', // botón de proveedor (deshabilitado)
        'provider_steam' => 'Continue with Steam', // botón de proveedor (deshabilitado)
    ],
    'en' => [ // versión en inglés
        'title' => 'Sign in | Swap',
        'description' => 'Swap sign-in screen.',
        'heading' => 'Sign in',
        'submit' => 'Continue with email',
        'or' => 'More sign-in options',
        'providers_note' => 'Google, GitHub, Steam, and other providers can be added here later.',
        'banner_eyebrow' => 'Account layer',
        'banner_heading' => 'One sign-in point for the site, the game, and future account features.',
        'banner_text' => 'Email works first. External providers and deeper account flows can be added on top without changing the overall layout.',
        'email' => 'Email',
        'password' => 'Password',
        'provider_google' => 'Continue with Google',
        'provider_github' => 'Continue with GitHub',
        'provider_steam' => 'Continue with Steam',
    ],
];

// Selecciona el idioma de la página, por defecto español
$page = $copy[$pageLang] ?? $copy['es'];

// Variables de título y descripción para el head
$pageTitle = $page['title'];
$pageDescription = $page['description'];

// CSS extra específico para la página de autenticación
$extraCss = ['css/pages/auth.css'];

// Carga la plantilla del head y header
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
?>

<!-- Contenido principal de la página -->
<main class="auth-page">
  <section class="auth-shell auth-shell-single auth-login-shell">
    <!-- Formulario de login -->
    <form class="auth-card" action="<?= e(with_lang(page_url('login'))) ?>" method="post">
      <h1 class="auth-card-title"><?= e($page['heading']) ?></h1>

      <!-- Token CSRF para seguridad -->
      <?= csrf_field() ?>

      <!-- Muestra error de autenticación si existe -->
      <?php if (!empty($authError)): ?>
        <p><?= e((string) $authError) ?></p>
      <?php endif; ?>

      <!-- Inputs de email y contraseña -->
      <label>
        <span><?= e($page['email']) ?></span>
        <input type="email" name="email" autocomplete="email">
      </label>
      <label>
        <span><?= e($page['password']) ?></span>
        <input type="password" name="password" autocomplete="current-password">
      </label>

      <!-- Botón de submit -->
      <button type="submit" class="auth-submit"><?= e($page['submit']) ?></button>

      <!-- Separador con texto "or" -->
      <div class="auth-divider"><span><?= e($page['or']) ?></span></div>

      <!-- Botones de proveedores externos (deshabilitados por ahora) -->
      <div class="auth-provider-list">
        <button type="button" class="auth-provider" disabled><?= e($page['provider_google']) ?></button>
        <button type="button" class="auth-provider" disabled><?= e($page['provider_github']) ?></button>
        <button type="button" class="auth-provider" disabled><?= e($page['provider_steam']) ?></button>
      </div>

      <!-- Nota sobre proveedores externos -->
      <p class="auth-meta-note"><?= e($page['providers_note']) ?></p>
    </form>

    <!-- Banner informativo al lado del formulario -->
    <div class="auth-copy auth-copy-banner">
      <span class="auth-eyebrow"><?= e($page['banner_eyebrow']) ?></span>
      <h2><?= e($page['banner_heading']) ?></h2>
      <p><?= e($page['banner_text']) ?></p>
    </div>
  </section>
</main>

<?php
// Carga footer y scripts de la página
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
?>
