<?php
$copy = [
    'es' => [
        'title' => 'Acceder | Swap',
        'description' => 'Pantalla de acceso de Swap.',
        'eyebrow' => 'Acceso',
        'heading' => 'Acceder a Swap',
        'text' => 'Base para autenticacion y sesion.',
        'email' => 'Correo',
        'password' => 'Contrasena',
        'submit' => 'Entrar',
    ],
    'en' => [
        'title' => 'Sign in | Swap',
        'description' => 'Swap sign-in screen.',
        'eyebrow' => 'Access',
        'heading' => 'Sign in to Swap',
        'text' => 'Base for authentication and session handling.',
        'email' => 'Email',
        'password' => 'Password',
        'submit' => 'Sign in',
    ],
];
$page = $copy[$pageLang] ?? $copy['es'];
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$extraCss = ['css/auth.css'];
require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
?>
<main class="auth-page">
  <section class="auth-shell">
    <div class="auth-copy">
      <span class="auth-eyebrow"><?= e($page['eyebrow']) ?></span>
      <h1><?= e($page['heading']) ?></h1>
      <p><?= e($page['text']) ?></p>
    </div>
    <form class="auth-card" action="<?= e(with_lang(page_url('login'))) ?>" method="post">
      <?php if (!empty($authError)): ?><p><?= e((string) $authError) ?></p><?php endif; ?>
      <label><span><?= e($page['email']) ?></span><input type="email" name="email" autocomplete="email"></label>
      <label><span><?= e($page['password']) ?></span><input type="password" name="password" autocomplete="current-password"></label>
      <button type="submit" class="auth-submit"><?= e($page['submit']) ?></button>
    </form>
  </section>
</main>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
