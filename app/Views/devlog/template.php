<?php
require_once __DIR__ . '/content.php';

$milestoneSlug = $milestoneSlug ?? null;
if (!is_string($milestoneSlug) || $milestoneSlug === '') {
    throw new RuntimeException('Missing $milestoneSlug.');
}

$milestone = milestone_content($milestoneSlug, $pageLang);
$text = $milestone['translated'];
$pageTitle = $text['title'] . ' - Swap RPG Devlog';
$pageDescription = $text['page_description'];
$extraCss = [
    'css/devlog.css',
    'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/vs2015.min.css',
];
$extraScripts = ['https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js'];
$inlineScripts = ['hljs.highlightAll();'];

require __DIR__ . '/../layouts/head.php';
require __DIR__ . '/../layouts/header.php';
?>
<div class="doc-layout">
  <aside class="doc-sidebar">
    <div>
      <h3><?= e(t('milestone.in_section')) ?></h3>
      <ul class="doc-nav-list">
        <?php foreach ($milestone['toc'] as $index => $item): ?>
          <li><a href="#<?= e($item['id']) ?>"<?= $index === 0 ? ' class="active"' : '' ?>><i class="fas <?= e($item['icon']) ?>"></i> <?= e($text['toc'][$item['id']]) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3><?= e(t('milestone.milestones')) ?></h3>
      <ul class="doc-nav-list">
        <?php if ($milestone['nav']['prev'] !== null): ?>
          <?php $prev = milestone_content($milestone['nav']['prev'], $pageLang); ?>
          <li><a href="<?= e(with_lang(page_url('devlog/' . $milestone['nav']['prev']))) ?>"><i class="fas fa-arrow-left"></i> <?= e(t('milestone.previous')) ?>: <?= e($prev['translated']['title']) ?></a></li>
        <?php endif; ?>
        <?php if ($milestone['nav']['next'] !== null): ?>
          <?php $next = milestone_content($milestone['nav']['next'], $pageLang); ?>
          <li><a href="<?= e(with_lang(page_url('devlog/' . $milestone['nav']['next']))) ?>"><?= e(t('milestone.next')) ?>: <?= e($next['translated']['title']) ?> <i class="fas fa-arrow-right"></i></a></li>
        <?php endif; ?>
        <li><a href="<?= e(with_lang(page_url('#devlog'))) ?>"><?= e(t('milestone.back_home')) ?></a></li>
      </ul>
    </div>
  </aside>
  <main class="doc-content">
    <section class="milestone-card" id="intro">
      <h1><?= e($text['title']) ?></h1>
      <div class="milestone-meta">
        <span><i class="far fa-calendar"></i> <?= e($text['display_date']) ?></span>
        <span><i class="fas fa-check-circle"></i> <?= e(t('milestone.completed')) ?></span>
      </div>
      <div class="milestone-desc"><?= e($text['intro']['description']) ?></div>
      <h2><?= e(t('milestone.goals')) ?></h2>
      <ul><?php foreach ($text['intro']['goals'] as $goal): ?><li><?= e($goal) ?></li><?php endforeach; ?></ul>
    </section>
    <?php foreach ($milestone['sections'] as $section): ?>
      <?php $sectionText = $text['sections'][$section['id']]; ?>
      <section class="milestone-card" id="<?= e($section['id']) ?>" style="margin-top: 40px; border: none; background: transparent; box-shadow: none; padding: 0;">
        <h2><?= e($sectionText['title']) ?></h2>
        <p><?= e($sectionText['description']) ?></p>
        <div class="code-wrapper" id="<?= e($section['code_id']) ?>">
          <div class="code-header">
            <span class="code-title"><?= e($section['file']) ?></span>
            <button type="button" class="code-toggle" data-code-target="<?= e($section['code_id']) ?>" data-label-expand="<?= e(t('code.expand')) ?>" data-label-collapse="<?= e(t('code.collapse')) ?>"><?= e(t('code.expand')) ?></button>
          </div>
          <div class="code-container"><pre><code class="language-<?= e($section['language']) ?>"><?= e($section['code']) ?></code></pre></div>
        </div>
      </section>
    <?php endforeach; ?>
    <?php if ($milestone['image'] !== null): ?>
      <section class="milestone-card" style="margin-top: 40px; border: none; background: transparent; box-shadow: none; padding: 0;">
        <div class="result-visual">
          <img src="<?= e(asset_url($milestone['image']['src'])) ?>" alt="<?= e($milestone['image']['alt']) ?>" class="result-image">
          <?php if (isset($text['figure'])): ?><p style="color: #94a3b8; margin-top: 10px; font-style: italic;"><?= e($text['figure']) ?></p><?php endif; ?>
        </div>
      </section>
    <?php endif; ?>
  </main>
</div>
<?php
require __DIR__ . '/../layouts/footer.php';
require __DIR__ . '/../layouts/scripts.php';
