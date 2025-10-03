<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('instructor');
require __DIR__ . '/../partials/header.php';

$instructor_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
  SELECT c.title, o.mode, o.location, o.start_date, o.end_date
  FROM course_offerings o
  JOIN courses c ON o.course_id = c.id
  WHERE o.instructor_id = ?
");
$stmt->execute([$instructor_id]);
$myCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h2>
<p>This is your instructor dashboard.</p>

<h3>Courses You Teach</h3>
<?php if ($myCourses): ?>
  <table border="1" cellpadding="6">
    <tr>
      <th>Course</th>
      <th>Mode</th>
      <th>Location</th>
      <th>Start Date</th>
      <th>End Date</th>
    </tr>
    <?php foreach ($myCourses as $c): ?>
      <tr>
        <td><?= htmlspecialchars($c['title']) ?></td>
        <td><?= $c['mode'] ?></td>
        <td><?= $c['location'] ?></td>
        <td><?= $c['start_date'] ?></td>
        <td><?= $c['end_date'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php else: ?>
  <p>No assigned courses yet.</p>
<?php endif; ?>

<?php require __DIR__ . '/../partials/footer.php'; ?>
