<?php
$copy = [
    'es' => [
        'title' => 'Personajes | Swap',
        'description' => 'Vista del roster de Swap dentro del area de cuenta.',
        'eyebrow' => 'Cuenta',
        'heading' => 'Personajes',
        'summary' => 'Una vista compacta del roster actual y de como los sistemas del jugador pueden vivir dentro del area de cuenta.',
        'active_slots' => 'slots sincronizados',
        'prototype_roster' => 'Roster sincronizado',
        'active_badge' => 'Activo',
        'updated_badge' => 'Sync',
        'account_area' => 'Panel',
        'overview' => 'Inicio',
        'characters_nav' => 'Personajes',
        'support_nav' => 'Apoyo',
        'history_nav' => 'Historial',
        'roster_eyebrow' => 'Roster',
        'roster_heading' => 'Alineacion actual',
        'level' => 'Nivel',
        'mastery' => 'Mastery',
        'hp' => 'HP',
        'coins' => 'Monedas',
        'kills' => 'Bajas',
        'equipment' => 'Equipo',
        'inventory' => 'Inventario',
        'quests' => 'Quests',
        'attributes' => 'Atributos',
        'stats' => 'Stats',
        'mastery_build' => 'Build de mastery',
        'mastery_empty' => 'Sin puntos asignados por ahora',
        'empty_equipment' => 'Sin equipo',
        'inventory_empty' => 'Inventario vacio por ahora',
        'quests_empty' => 'Sin quests completadas por ahora',
        'updated' => 'Ultima sync',
        'items' => 'Items',
        'completed' => 'Completadas',
        'back_profile' => 'Volver a cuenta',
    ],
    'en' => [
        'title' => 'Characters | Swap',
        'description' => 'Roster view inside the Swap account area.',
        'eyebrow' => 'Account',
        'heading' => 'Characters',
        'summary' => 'A compact view of the current roster and how player-facing systems can live inside the account area.',
        'active_slots' => 'synced slots',
        'prototype_roster' => 'Synced roster',
        'active_badge' => 'Active',
        'updated_badge' => 'Sync',
        'account_area' => 'Panel',
        'overview' => 'Home',
        'characters_nav' => 'Characters',
        'support_nav' => 'Support',
        'history_nav' => 'History',
        'roster_eyebrow' => 'Roster',
        'roster_heading' => 'Current lineup',
        'level' => 'Level',
        'mastery' => 'Mastery',
        'hp' => 'HP',
        'coins' => 'Coins',
        'kills' => 'Kills',
        'equipment' => 'Equipment',
        'inventory' => 'Inventory',
        'quests' => 'Quests',
        'attributes' => 'Attributes',
        'stats' => 'Stats',
        'mastery_build' => 'Mastery build',
        'mastery_empty' => 'No allocated points yet',
        'empty_equipment' => 'No equipment yet',
        'inventory_empty' => 'Inventory is empty for now',
        'quests_empty' => 'No completed quests yet',
        'updated' => 'Last sync',
        'items' => 'Items',
        'completed' => 'Completed',
        'back_profile' => 'Back to account',
    ],
];

$page = $copy[$pageLang] ?? $copy['es'];
$pageTitle = $page['title'];
$pageDescription = $page['description'];
$extraCss = ['css/layouts/account.css'];
$accountNavActive = 'characters';
$accountNavLabel = $page['account_area'];
$compactRoster = count($characters) > 1;
?>
<main class="auth-page">
  <section class="auth-shell auth-shell-single auth-characters-shell">
    <div class="auth-copy auth-characters-hero">
      <span class="auth-eyebrow"><?= e($page['eyebrow']) ?></span>
      <h1><?= e($page['heading']) ?></h1>
      <p><?= e($page['summary']) ?></p>
      <div class="auth-account-chips">
        <span class="auth-chip"><?= e((string) count($characters) . ' ' . $page['active_slots']) ?></span>
        <span class="auth-chip"><?= e($page['prototype_roster']) ?></span>
      </div>
    </div>
    <div class="auth-account-layout">
      <?php require __DIR__ . '/../../partials/account-nav.php'; ?>
      <div class="auth-card auth-characters-panel">
        <div class="auth-section-heading">
          <span class="auth-eyebrow"><?= e($page['roster_eyebrow']) ?></span>
          <h2><?= e($page['roster_heading']) ?></h2>
        </div>
        <div class="auth-grid auth-character-grid<?= $compactRoster ? ' is-compact' : '' ?>">
          <?php foreach ($characters as $character): ?>
            <?php
            $equipment = is_array($character['equipment'] ?? null) ? $character['equipment'] : [];
            $inventory = is_array($character['inventory'] ?? null) ? $character['inventory'] : [];
            $quests = is_array($character['quests'] ?? null) ? $character['quests'] : [];
            $attributes = is_array($character['attributes'] ?? null) ? $character['attributes'] : [];
            $stats = is_array($character['stats'] ?? null) ? $character['stats'] : [];
            $mastery = is_array($character['mastery'] ?? null) ? $character['mastery'] : [];
            $masteryPoints = (int) ($character['mastery_points'] ?? 0);
            $masterySpent = (int) (($mastery['offense'] ?? 0) + ($mastery['skill'] ?? 0) + ($mastery['defense'] ?? 0));
            $filledEquipment = array_filter($equipment, static fn ($itemId): bool => trim((string) $itemId) !== '');
            $classId = (string) ($character['class_id'] ?? 'adventurer');
            $classLabel = game_label('classes', $classId, $classId);
            $characterInitial = strtoupper(substr($classLabel, 0, 1));
            $portraitClass = match ($classId) {
                'mage' => 'is-mage',
                'druid' => 'is-druid',
                default => 'is-warrior',
            };
            $portraitAsset = match ($classId) {
                'mage' => 'images/characters/swap-rpg/druid-base.png',
                'druid' => 'images/characters/swap-rpg/mage-base.png',
                default => 'images/characters/swap-rpg/hero-base.png',
            };
            $equipmentCount = count($filledEquipment);
            $inventoryCount = count($inventory);
            $questCount = count($quests);
            ?>
            <article class="auth-detail-card auth-character-card<?= $compactRoster ? ' is-compact' : '' ?>">
              <div class="auth-character-band">
                <div class="auth-character-crest">
                  <span><?= e($characterInitial) ?></span>
                </div>
                <div class="auth-character-header">
                  <div class="auth-character-title">
                    <span class="auth-stat-label"><?= e($classLabel) ?></span>
                    <h3><?= e($character['name']) ?></h3>
                  </div>
                  <div class="auth-character-badges">
                    <?php if (!empty($character['is_active'])): ?>
                      <span class="auth-pill auth-pill-success"><?= e($page['active_badge']) ?></span>
                    <?php endif; ?>
                    <span class="auth-pill auth-pill-muted"><?= e($page['updated_badge']) ?></span>
                  </div>
                </div>
              </div>
              <div class="auth-character-kpis">
                <article class="auth-character-kpi">
                  <span class="auth-stat-label"><?= e($page['level']) ?></span>
                  <strong><?= e((string) $character['level']) ?></strong>
                </article>
                <article class="auth-character-kpi">
                  <span class="auth-stat-label"><?= e($page['mastery']) ?></span>
                  <strong><?= e((string) $masteryPoints) ?></strong>
                </article>
                <article class="auth-character-kpi">
                  <span class="auth-stat-label"><?= e($page['hp']) ?></span>
                  <strong><?= e((string) $character['hp']) ?>/<?= e((string) ($character['max_hp'] ?? $character['hp'])) ?></strong>
                </article>
                <article class="auth-character-kpi auth-character-kpi-optional">
                  <span class="auth-stat-label"><?= e($page['coins']) ?></span>
                  <strong><?= e((string) ($character['coins'] ?? 0)) ?></strong>
                </article>
                <article class="auth-character-kpi auth-character-kpi-optional">
                  <span class="auth-stat-label"><?= e($page['kills']) ?></span>
                  <strong><?= e((string) ($character['enemies_killed'] ?? 0)) ?></strong>
                </article>
              </div>

              <?php if ($compactRoster): ?>
                <div class="auth-character-compact-layout">
                  <section class="auth-character-panel auth-character-panel-tight auth-character-portrait-panel auth-character-portrait-panel-compact">
                    <div class="auth-character-portrait-frame <?= e($portraitClass) ?>">
                      <div class="auth-character-portrait-aura"></div>
                      <img
                        class="auth-character-portrait-sprite <?= e($portraitClass) ?>"
                        src="<?= e(asset_url($portraitAsset)) ?>"
                        alt="<?= e($character['name'] . ' portrait') ?>">
                    </div>
                    <div class="auth-character-portrait-meta">
                      <span class="auth-stat-label"><?= e($classLabel) ?></span>
                      <strong><?= e($character['name']) ?></strong>
                    </div>
                  </section>

                  <section class="auth-character-panel auth-character-panel-tight">
                    <div class="auth-character-panel-head">
                      <span class="auth-stat-label"><?= e($page['attributes']) ?></span>
                    </div>
                    <div class="auth-micro-grid auth-micro-grid-strong auth-micro-grid-pairs">
                      <?php foreach ($attributes as $key => $value): ?>
                        <span><?= e(game_label('attributes', (string) $key, strtoupper((string) $key))) ?> <strong><?= e((string) $value) ?></strong></span>
                      <?php endforeach; ?>
                    </div>
                  </section>

                  <section class="auth-character-panel auth-character-panel-tight">
                    <div class="auth-character-panel-head">
                      <span class="auth-stat-label"><?= e($page['mastery_build']) ?></span>
                    </div>
                    <div class="auth-micro-grid auth-micro-grid-strong auth-micro-grid-pairs auth-micro-grid-mastery">
                      <span>Offense <strong><?= e((string) ($mastery['offense'] ?? 0)) ?></strong></span>
                      <span>Skill <strong><?= e((string) ($mastery['skill'] ?? 0)) ?></strong></span>
                      <span>Defense <strong><?= e((string) ($mastery['defense'] ?? 0)) ?></strong></span>
                      <span>Spent <strong><?= e((string) $masterySpent) ?></strong></span>
                    </div>
                    <?php if ($masterySpent <= 0 && $masteryPoints <= 0): ?>
                      <span class="auth-pill auth-pill-empty"><?= e($page['mastery_empty']) ?></span>
                    <?php endif; ?>
                  </section>

                  <section class="auth-character-panel auth-character-panel-tight">
                    <div class="auth-character-panel-head">
                      <span class="auth-stat-label"><?= e($page['stats']) ?></span>
                    </div>
                    <div class="auth-micro-grid auth-micro-grid-strong auth-micro-grid-pairs auth-micro-grid-stats">
                      <span><?= e(game_label('stats', 'mana')) ?> <strong><?= e((string) ($stats['mana'] ?? 0)) ?></strong></span>
                      <span><?= e(game_label('stats', 'attack')) ?> <strong><?= e(number_format((float) ($stats['attack'] ?? 0), 1)) ?></strong></span>
                      <span><?= e(game_label('stats', 'dps')) ?> <strong><?= e(number_format((float) ($stats['dps'] ?? 0), 1)) ?></strong></span>
                      <span><?= e(game_label('stats', 'defense')) ?> <strong><?= e(number_format((float) ($stats['defense'] ?? 0), 1)) ?></strong></span>
                    </div>
                  </section>
                </div>

                <div class="auth-character-meta-strip">
                  <span class="auth-pill"><?= e($page['mastery']) ?>: <?= e((string) $masterySpent) ?></span>
                  <span class="auth-pill"><?= e($page['equipment']) ?>: <?= e((string) $equipmentCount) ?></span>
                  <span class="auth-pill"><?= e($page['inventory']) ?>: <?= e((string) $inventoryCount) ?></span>
                  <span class="auth-pill"><?= e($page['quests']) ?>: <?= e((string) $questCount) ?></span>
                </div>
              <?php else: ?>
              <div class="auth-character-layout auth-character-layout-compact">
                <section class="auth-character-panel auth-character-portrait-panel">
                  <div class="auth-character-portrait-frame <?= e($portraitClass) ?>">
                    <div class="auth-character-portrait-aura"></div>
                    <img
                      class="auth-character-portrait-sprite <?= e($portraitClass) ?>"
                      src="<?= e(asset_url($portraitAsset)) ?>"
                      alt="<?= e($character['name'] . ' portrait') ?>">
                  </div>
                  <div class="auth-character-portrait-meta">
                    <span class="auth-stat-label"><?= e($classLabel) ?></span>
                    <strong><?= e($character['name']) ?></strong>
                  </div>
                </section>

                <section class="auth-character-panel">
                  <div class="auth-character-panel-head">
                    <span class="auth-stat-label"><?= e($page['attributes']) ?></span>
                  </div>
                  <div class="auth-micro-grid auth-micro-grid-strong auth-micro-grid-pairs">
                    <?php foreach ($attributes as $key => $value): ?>
                      <span><?= e(game_label('attributes', (string) $key, strtoupper((string) $key))) ?> <strong><?= e((string) $value) ?></strong></span>
                    <?php endforeach; ?>
                  </div>
                </section>

                <section class="auth-character-panel">
                  <div class="auth-character-panel-head">
                    <span class="auth-stat-label"><?= e($page['mastery_build']) ?></span>
                  </div>
                  <div class="auth-micro-grid auth-micro-grid-strong auth-micro-grid-pairs auth-micro-grid-mastery">
                    <span>Offense <strong><?= e((string) ($mastery['offense'] ?? 0)) ?></strong></span>
                    <span>Skill <strong><?= e((string) ($mastery['skill'] ?? 0)) ?></strong></span>
                    <span>Defense <strong><?= e((string) ($mastery['defense'] ?? 0)) ?></strong></span>
                    <span>Spent <strong><?= e((string) $masterySpent) ?></strong></span>
                  </div>
                  <?php if ($masterySpent <= 0 && $masteryPoints <= 0): ?>
                    <span class="auth-pill auth-pill-empty"><?= e($page['mastery_empty']) ?></span>
                  <?php endif; ?>
                </section>

                <section class="auth-character-panel">
                  <div class="auth-character-panel-head">
                    <span class="auth-stat-label"><?= e($page['stats']) ?></span>
                  </div>
                  <div class="auth-micro-grid auth-micro-grid-strong auth-micro-grid-pairs auth-micro-grid-stats">
                    <span><?= e(game_label('stats', 'mana')) ?> <strong><?= e((string) ($stats['mana'] ?? 0)) ?></strong></span>
                    <span><?= e(game_label('stats', 'attack')) ?> <strong><?= e(number_format((float) ($stats['attack'] ?? 0), 1)) ?></strong></span>
                    <span><?= e(game_label('stats', 'dps')) ?> <strong><?= e(number_format((float) ($stats['dps'] ?? 0), 1)) ?></strong></span>
                    <span><?= e(game_label('stats', 'ability_power')) ?> <strong><?= e(number_format((float) ($stats['ability_power'] ?? 0), 1)) ?></strong></span>
                    <span><?= e(game_label('stats', 'defense')) ?> <strong><?= e(number_format((float) ($stats['defense'] ?? 0), 1)) ?></strong></span>
                    <span><?= e(game_label('stats', 'healing_power')) ?> <strong><?= e(number_format((float) ($stats['healing_power'] ?? 0), 1)) ?></strong></span>
                  </div>
                </section>
              </div>

              <div class="auth-character-summary-grid">
                <section class="auth-character-panel auth-character-panel-tight">
                  <span class="auth-stat-label"><?= e($page['equipment']) ?></span>
                  <div class="auth-pill-list">
                    <?php foreach ($filledEquipment as $slot => $itemId): ?>
                      <span class="auth-pill"><?= e(game_label('equipment_slots', (string) $slot, (string) $slot)) ?>: <?= e(game_label('items', (string) $itemId, (string) $itemId)) ?></span>
                    <?php endforeach; ?>
                    <?php if ($filledEquipment === []): ?>
                      <span class="auth-pill auth-pill-empty"><?= e($page['empty_equipment']) ?></span>
                    <?php endif; ?>
                  </div>
                </section>

                <section class="auth-character-panel auth-character-panel-tight">
                  <span class="auth-stat-label"><?= e($page['inventory']) ?></span>
                  <div class="auth-pill-list">
                    <?php foreach (array_slice($inventory, 0, 4) as $itemId): ?>
                      <span class="auth-pill"><?= e(game_label('items', (string) $itemId, (string) $itemId)) ?></span>
                    <?php endforeach; ?>
                    <?php if ($inventory === []): ?>
                      <span class="auth-pill auth-pill-empty"><?= e($page['inventory_empty']) ?></span>
                    <?php elseif (count($inventory) > 4): ?>
                      <span class="auth-pill auth-pill-muted">+<?= e((string) (count($inventory) - 4)) ?> <?= e($page['items']) ?></span>
                    <?php endif; ?>
                  </div>
                </section>

                <section class="auth-character-panel auth-character-panel-tight">
                  <span class="auth-stat-label"><?= e($page['quests']) ?></span>
                  <div class="auth-pill-list">
                    <?php foreach (array_slice($quests, 0, 3) as $questId): ?>
                      <span class="auth-pill"><?= e(game_label('quests', (string) $questId, (string) $questId)) ?></span>
                    <?php endforeach; ?>
                    <?php if ($quests === []): ?>
                      <span class="auth-pill auth-pill-empty"><?= e($page['quests_empty']) ?></span>
                    <?php elseif (count($quests) > 3): ?>
                      <span class="auth-pill auth-pill-muted">+<?= e((string) (count($quests) - 3)) ?> <?= e($page['completed']) ?></span>
                    <?php endif; ?>
                  </div>
                </section>
              </div>
              <?php endif; ?>

              <p class="auth-character-updated"><?= e($page['updated']) ?>: <?= e(format_datetime_ui((string) ($character['updated_at'] ?? ''))) ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
</main>
