<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('admin');
require __DIR__ . '/../partials/header.php';

$inq = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC")->fetchAll();
?>
<link rel="stylesheet" href="/skill_pro_v2/assets/css/admin.css">

<div class="admin-wrapper">
  <h2>Manage Inquiries</h2>
  <table>
    <tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>
    <?php foreach ($inq as $i): ?>
      <tr>
        <td><?= htmlspecialchars($i['name']) ?></td>
        <td><?= htmlspecialchars($i['email']) ?></td>
        <td><?= htmlspecialchars($i['message']) ?></td>
        <td><?= $i['created_at'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
