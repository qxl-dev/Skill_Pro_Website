<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('admin');
require __DIR__ . '/../partials/header.php';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM users WHERE id=?")->execute([$id]);
    echo "<p style='color:lime;'>✅ User deleted successfully.</p>";
}

$users = $pdo->query("SELECT id, role, full_name, email FROM users ORDER BY role, full_name")->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="/skill_pro_v2/assets/css/admin.css">

<div class="admin-wrapper">
  <h2>Manage Users</h2>
  <table>
    <thead>
      <tr><th>ID</th><th>Role</th><th>Name</th><th>Email</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php foreach ($users as $u): ?>
        <tr>
          <td><?= $u['id'] ?></td>
          <td><?= ucfirst($u['role']) ?></td>
          <td><?= htmlspecialchars($u['full_name']) ?></td>
          <td><?= htmlspecialchars($u['email']) ?></td>
          <td><a href="?delete=<?= $u['id'] ?>" onclick="return confirm('Delete this user?')">🗑 Delete</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
