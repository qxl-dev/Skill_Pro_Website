<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('admin');
require __DIR__ . '/../partials/header.php';

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM users WHERE id=?")->execute([$id]);
    echo "<p style='color:green'>User deleted.</p>";
}

// Fetch users
$users = $pdo->query("SELECT id, role, full_name, email FROM users ORDER BY role, full_name")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Manage Users</h2>

<table border="1" cellpadding="6">
  <tr>
    <th>ID</th><th>Role</th><th>Name</th><th>Email</th><th>Actions</th>
  </tr>
  <?php foreach ($users as $u): ?>
    <tr>
      <td><?= $u['id'] ?></td>
      <td><?= $u['role'] ?></td>
      <td><?= htmlspecialchars($u['full_name']) ?></td>
      <td><?= htmlspecialchars($u['email']) ?></td>
      <td><a href="?delete=<?= $u['id'] ?>" onclick="return confirm('Delete user?')">Delete</a></td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require __DIR__ . '/../partials/footer.php'; ?>
