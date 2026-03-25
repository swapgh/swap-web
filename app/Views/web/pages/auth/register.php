<?php
$copy = [
    'es' => [
        'title' => 'Registro | Swap',
        'description' => 'Crea una cuenta de Swap para la web y el juego.',
        'heading' => 'Crear cuenta',
        'submit' => 'Crear cuenta',
        'banner_eyebrow' => 'Cuenta',
        'banner_heading' => 'Una cuenta para la web, el juego y la progresion.',
        'banner_text' => 'Empieza con usuario, correo y contrasena. Luego el RPG podra iniciar sesion y sincronizar tu progreso.',
        'username' => 'Usuario',
        'email' => 'Correo',
        'password' => 'Contrasena',
        'login_hint' => 'Ya tienes cuenta?',
        'login_link' => 'Acceder',
    ],
    'en' => [
        'title' => 'Register | Swap',
        'description' => 'Create a Swap account for the site and the game.',
        'heading' => 'Create account',
        'submit' => 'Create account',
        'banner_eyebrow' => 'Account layer',
        'banner_heading' => 'One account for the site, the game, and progression.',
        'banner_text' => 'Start with username, email, and password. The RPG can log in and sync your progress on top of that.',
        'username' => 'Username',
        'email' => 'Email',
        'password' => 'Password',
        'login_hint' => 'Already have an account?',
        'login_link' => 'Sign in',
    ],
];

$page = $copy[$pageLang] ?? $copy['es'];
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$extraCss = ['css/layouts/account.css'];
?>
<main class="auth-page">
  <section class="auth-shell auth-shell-single auth-login-shell">
    <form class="auth-card" action="<?= e(with_lang(page_url('register'))) ?>" method="post">
      <h1 class="auth-card-title"><?= e($page['heading']) ?></h1>
      <?= csrf_field() ?>
      <?php if (!empty($authError)): ?><p><?= e((string) $authError) ?></p><?php endif; ?>
      <label><span><?= e($page['username']) ?></span><input type="text" name="username" autocomplete="username"></label>
      <label><span><?= e($page['email']) ?></span><input type="email" name="email" autocomplete="email"></label>
      <label><span><?= e($page['password']) ?></span><input type="password" name="password" autocomplete="new-password"></label>
      <button type="submit" class="auth-submit"><?= e($page['submit']) ?></button>
      <p class="auth-meta-note"><?= e($page['login_hint']) ?> <a href="<?= e(with_lang(page_url('login'))) ?>"><?= e($page['login_link']) ?></a></p>
    </form>
    <div class="auth-copy auth-copy-banner">
      <span class="auth-eyebrow"><?= e($page['banner_eyebrow']) ?></span>
      <h2><?= e($page['banner_heading']) ?></h2>
      <p><?= e($page['banner_text']) ?></p>
    </div>
  </section>
</main>
