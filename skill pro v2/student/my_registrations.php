<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('student');
require __DIR__ . '/../partials/header.php';

$student_id = $_SESSION['user_id'];

// Fetch registrations
$stmt = $pdo->prepare("
  SELECT r.id, c.title, o.mode, o.location, o.start_date, o.end_date, u.full_name AS instructor
  FROM registrations r
  JOIN course_offerings o ON r.offering_id = o.id
  JOIN courses c ON o.course_id = c.id
  LEFT JOIN users u ON o.instructor_id=u.id
  WHERE r.student_id = ?
");
$stmt->execute([$student_id]);
$registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>My Registrations</h2>

<?php if ($registrations): ?>
<table border="1" cellpadding="6">
  <tr>
    <th>Course</th><th>Instructor</th><th>Mode</th><th>Location</th><th>Start</th><th>End</th>
  </tr>
  <?php foreach($registrations as $r): ?>
  <tr>
    <td><?= htmlspecialchars($r['title']) ?></td>
    <td><?= htmlspecialchars($r['instructor']) ?></td>
    <td><?= $r['mode'] ?></td>
    <td><?= $r['location'] ?></td>
    <td><?= $r['start_date'] ?></td>
    <td><?= $r['end_date'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php else: ?>
  <p>You are not registered in any courses yet.</p>
<?php endif; ?>

<?php require __DIR__ . '/../partials/footer.php'; ?>
