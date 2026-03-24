<?php
$accountNavActive = (string) ($accountNavActive ?? 'dashboard');
$accountNavLabel = (string) ($accountNavLabel ?? t('nav.account'));
$accountNavItems = [
    'dashboard' => ['label' => $page['overview'] ?? 'Overview', 'href' => with_lang(page_url('account'))],
    'characters' => ['label' => $page['characters_nav'] ?? $page['characters'] ?? 'Characters', 'href' => with_lang(page_url('account/characters'))],
    'support' => ['label' => $page['support_nav'] ?? $page['support'] ?? 'Support', 'href' => with_lang(page_url('account')) . '#support-area'],
    'history' => ['label' => $page['history_nav'] ?? $page['heading'] ?? 'History', 'href' => with_lang(page_url('account/support/history'))],
];
?>
<aside class="auth-card auth-account-nav-card" data-account-nav>
  <div class="auth-section-heading">
    <span class="auth-eyebrow"><?= e($page['eyebrow'] ?? $page['actions_eyebrow'] ?? 'Account') ?></span>
    <h2><?= e($accountNavLabel) ?></h2>
  </div>
  <nav class="auth-account-nav" aria-label="<?= e($accountNavLabel) ?>">
    <?php foreach ($accountNavItems as $key => $item): ?>
      <a class="auth-account-nav-link<?= $accountNavActive === $key ? ' is-active' : '' ?>" href="<?= e($item['href']) ?>" data-account-nav-key="<?= e($key) ?>"<?= $accountNavActive === $key ? ' aria-current="page"' : '' ?>><?= e($item['label']) ?></a>
    <?php endforeach; ?>
  </nav>
</aside>
