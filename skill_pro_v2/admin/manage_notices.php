<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('admin');
require __DIR__ . '/../partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $body = trim($_POST['body']);
    $visible = $_POST['visible_to'] ?? 'all';
    if ($title && $body) {
        $stmt = $pdo->prepare("INSERT INTO notices (title, body, visible_to) VALUES (?, ?, ?)");
        $stmt->execute([$title, $body, $visible]);
        echo "<p style='color:lime;'>✅ Notice added successfully.</p>";
    }
}

$notices = $pdo->query("SELECT * FROM notices ORDER BY publish_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="/skill_pro_v2/assets/css/admin.css">

<div class="admin-wrapper">
  <h2>Manage Notices</h2>
  <form method="post">
    <input type="text" name="title" placeholder="Notice Title" required>
    <textarea name="body" placeholder="Notice Details" required></textarea>
    <select name="visible_to">
      <option value="all">All</option>
      <option value="students">Students</option>
      <option value="instructors">Instructors</option>
    </select>
    <button type="submit">Add Notice</button>
  </form>

  <div class="notices-grid">
  <?php if ($notices): ?>
    <?php foreach ($notices as $n): ?>
      <div class="notice-card">
        <h3><?= htmlspecialchars($n['title'] ?? 'Untitled Notice') ?></h3>
        <p class="date">
          <?= !empty($n['publish_at']) ? date("F j, Y", strtotime($n['publish_at'])) : 'No date' ?>
        </p>
        <p class="message">
          <?= nl2br(htmlspecialchars($n['body'] ?? 'No details available.')) ?>
        </p>
        <p class="visible">
          <strong>Visible to:</strong> <?= htmlspecialchars($n['visible_to'] ?? 'All') ?>
        </p>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No notices available.</p>
  <?php endif; ?>
</div>


<?php require __DIR__ . '/../partials/footer.php'; ?>
