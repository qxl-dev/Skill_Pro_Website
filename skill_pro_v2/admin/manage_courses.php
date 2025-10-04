<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('admin');
require __DIR__ . '/../partials/header.php';

$courses = $pdo->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="/skill_pro_v2/assets/css/admin.css">

<div class="admin-wrapper">
  <h2>Manage Courses</h2>
  <p>View all existing courses and assigned instructors.</p>

  <table>
    <tr><th>ID</th><th>Title</th><th>Category</th><th>Fee</th></tr>
    <?php foreach ($courses as $c): ?>
      <tr>
        <td><?= $c['id'] ?></td>
        <td><?= htmlspecialchars($c['title']) ?></td>
        <td><?= htmlspecialchars($c['category']) ?></td>
        <td>$<?= number_format($c['fee'], 2) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
