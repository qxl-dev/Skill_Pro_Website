<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('instructor');
require __DIR__ . '/../partials/header.php';

$instructor_id = $_SESSION['user_id'];

// Fetch courses taught by this instructor
$stmt = $pdo->prepare("
  SELECT o.id, c.title, o.mode, o.location, o.start_date, o.end_date
  FROM course_offerings o
  JOIN courses c ON o.course_id=c.id
  WHERE o.instructor_id = ?
");
$stmt->execute([$instructor_id]);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>My Courses</h2>

<?php if ($courses): ?>
<table border="1" cellpadding="6">
  <tr>
    <th>Course</th><th>Mode</th><th>Location</th><th>Start</th><th>End</th><th>Students</th>
  </tr>
  <?php foreach($courses as $c): ?>
  <tr>
    <td><?= htmlspecialchars($c['title']) ?></td>
    <td><?= $c['mode'] ?></td>
    <td><?= $c['location'] ?></td>
    <td><?= $c['start_date'] ?></td>
    <td><?= $c['end_date'] ?></td>
    <td><a href="students.php?offering=<?= $c['id'] ?>">View Students</a></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php else: ?>
  <p>You are not assigned to any courses yet.</p>
<?php endif; ?>

<?php require __DIR__ . '/../partials/footer.php'; ?>
