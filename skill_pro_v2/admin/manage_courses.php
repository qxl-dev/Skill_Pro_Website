<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('admin');
require __DIR__ . '/../partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title']; $category = $_POST['category'];
    $desc = $_POST['description']; $fee = $_POST['fee'];
    $pdo->prepare("INSERT INTO courses (title,category,description,fee) VALUES (?,?,?,?)")
        ->execute([$title,$category,$desc,$fee]);
    echo "<p style='color:green'>Course added.</p>";
}

$courses = $pdo->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Manage Courses</h2>

<h3>Add New Course</h3>
<form method="post">
  <input type="text" name="title" placeholder="Title" required>
  <input type="text" name="category" placeholder="Category" required>
  <input type="text" name="description" placeholder="Description" required>
  <input type="number" name="fee" placeholder="Fee" required>
  <button type="submit">Add</button>
</form>

<h3>All Courses</h3>
<table border="1" cellpadding="6">
  <tr><th>ID</th><th>Title</th><th>Category</th><th>Fee</th></tr>
  <?php foreach ($courses as $c): ?>
    <tr>
      <td><?= $c['id'] ?></td>
      <td><?= htmlspecialchars($c['title']) ?></td>
      <td><?= htmlspecialchars($c['category']) ?></td>
      <td><?= $c['fee'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require __DIR__ . '/../partials/footer.php'; ?>
