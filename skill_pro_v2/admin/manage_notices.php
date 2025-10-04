<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('admin');
require __DIR__ . '/../partials/header.php';

// Handle new notice submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $body = trim($_POST['body']);
    $visible = $_POST['visible_to'] ?? 'all';

    if ($title && $body) {
        $stmt = $pdo->prepare("INSERT INTO notices (title, body, visible_to) VALUES (?, ?, ?)");
        $stmt->execute([$title, $body, $visible]);
        echo "<p style='color:green'>✅ Notice added successfully.</p>";
    } else {
        echo "<p style='color:red'>⚠️ Please fill in both title and body.</p>";
    }
}

// Fetch all notices
$notices = $pdo->query("SELECT * FROM notices ORDER BY publish_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Manage Notices</h2>

<h3>Add New Notice</h3>
<form method="post" style="margin-bottom:20px;">
  <input type="text" name="title" placeholder="Notice Title" required><br><br>
  <textarea name="body" placeholder="Notice Body" rows="4" required></textarea><br><br>
  <label>Visible To:</label>
  <select name="visible_to">
    <option value="all">All</option>
    <option value="students">Students</option>
    <option value="instructors">Instructors</option>
  </select><br><br>
  <button type="submit">Add Notice</button>
</form>

<h3>All Notices</h3>
<div class="notices-grid">
  <?php if ($notices): ?>
    <?php foreach ($notices as $n): ?>
      <div class="notice-card">
        <h3><?= htmlspecialchars($n['title']) ?></h3>
        <p class="date"><?= date("F j, Y, g:i a", strtotime($n['publish_at'])) ?></p>
        <p class="message"><?= nl2br(htmlspecialchars($n['body'])) ?></p>
        <p class="visible"><strong>Visible To:</strong> <?= htmlspecialchars($n['visible_to']) ?></p>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No notices available.</p>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
