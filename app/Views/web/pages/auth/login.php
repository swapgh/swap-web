<?php
$copy = [
    'es' => [
        'title' => 'Acceder | Swap',
        'description' => 'Pantalla de acceso de Swap.',
        'heading' => 'Sign in',
        'submit' => 'Continue with email',
        'or' => 'More sign-in options',
        'providers_note' => 'Google, GitHub, Steam, and other providers can be added here later.',
        'banner_eyebrow' => 'Account layer',
        'banner_heading' => 'One sign-in point for the site, the game, and future account features.',
        'banner_text' => 'Email works first. External providers and deeper account flows can be added on top without changing the overall layout.',
        'email' => 'Correo',
        'password' => 'Contrasena',
        'provider_google' => 'Continue with Google',
        'provider_github' => 'Continue with GitHub',
        'provider_steam' => 'Continue with Steam',
    ],
    'en' => [
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

$page = $copy[$pageLang] ?? $copy['es'];
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$extraCss = ['css/layouts/account.css'];
?>
<main class="auth-page">
  <section class="auth-shell auth-shell-single auth-login-shell">
    <form class="auth-card" action="<?= e(with_lang(page_url('login'))) ?>" method="post">
      <h1 class="auth-card-title"><?= e($page['heading']) ?></h1>
      <?= csrf_field() ?>
      <?php if (!empty($authError)): ?><p><?= e((string) $authError) ?></p><?php endif; ?>
      <label><span><?= e($page['email']) ?></span><input type="email" name="email" autocomplete="email"></label>
      <label><span><?= e($page['password']) ?></span><input type="password" name="password" autocomplete="current-password"></label>
      <button type="submit" class="auth-submit"><?= e($page['submit']) ?></button>
      <div class="auth-divider"><span><?= e($page['or']) ?></span></div>
      <div class="auth-provider-list">
        <button type="button" class="auth-provider" disabled><?= e($page['provider_google']) ?></button>
        <button type="button" class="auth-provider" disabled><?= e($page['provider_github']) ?></button>
        <button type="button" class="auth-provider" disabled><?= e($page['provider_steam']) ?></button>
      </div>
      <p class="auth-meta-note"><?= e($page['providers_note']) ?></p>
    </form>
    <div class="auth-copy auth-copy-banner">
      <span class="auth-eyebrow"><?= e($page['banner_eyebrow']) ?></span>
      <h2><?= e($page['banner_heading']) ?></h2>
      <p><?= e($page['banner_text']) ?></p>
    </div>
  </section>
</main>
