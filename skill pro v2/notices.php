<?php
require __DIR__ . '/config/db.php';
require __DIR__ . '/partials/header.php';

// Fetch notices (most recent first)
$notices = $pdo->query("SELECT * FROM notices ORDER BY publish_at DESC")
               ->fetchAll(PDO::FETCH_ASSOC);

function notice_type_and_class(string $title): array {
    $t = strtolower($title);
    if (str_contains($t, 'holiday'))   return ['Holiday',   'badge-holiday'];
    if (str_contains($t, 'workshop'))  return ['Workshop',  'badge-workshop'];
    if (str_contains($t, 'job'))       return ['Job Fair',  'badge-job'];
    if (str_contains($t, 'batch'))     return ['New Batch', 'badge-batch'];
    return ['Notice', 'badge-default'];
}
?>

<link rel="stylesheet" href="assets/css/notices.css?v=<?= time(); ?>">

<!-- Hero -->
<section class="notices-hero">
  <div class="container">
    <h1>📣 Institute Notices</h1>
    <p>Stay updated with the latest announcements, holidays, job fairs, workshops, and events from SkillPro Institute.</p>
  </div>
</section>

<!-- Grid -->
<section class="notices-section">
  <div class="container">
    <?php if (!empty($notices)): ?>
      <div class="notices-grid">
        <?php foreach ($notices as $n): ?>
          <?php
            // Work with either `content` or `body`
            $message = $n['content'] ?? $n['body'] ?? '';
            $snippet = trim($message) !== '' ? mb_strimwidth(strip_tags($message), 0, 160, '…', 'UTF-8') : '—';
            [$typeLabel, $typeClass] = notice_type_and_class($n['title'] ?? '');
          ?>
          <article class="notice-card">
            <div class="notice-card__head">
              <span class="badge <?= $typeClass; ?>"><?= htmlspecialchars($typeLabel); ?></span>
              <h3><?= htmlspecialchars($n['title']); ?></h3>
              <time class="date"><?= date("F j, Y, g:i a", strtotime($n['publish_at'])); ?></time>
            </div>
            <p class="message"><?= htmlspecialchars($snippet); ?></p>
            <!-- If you add a single notice page later, point this href to it -->
            <a class="btn-secondary" href="#">Read more</a>
          </article>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="empty-state">
        <h3>No notices yet</h3>
        <p>Check back soon for new announcements and events.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
