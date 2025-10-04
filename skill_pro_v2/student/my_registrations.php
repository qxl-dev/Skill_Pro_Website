<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role('student');
include_once __DIR__ . '/../partials/header.php';

$student_id = $_SESSION['user_id'];

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

<link rel="stylesheet" href="/skill_pro_v2/assets/css/theme.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="/skill_pro_v2/assets/css/student.css?v=<?php echo time(); ?>">

<div class="student-page">
  <div class="student-header">
    <h2>📚 My Registrations</h2>
    <p>Welcome back, <strong><?= htmlspecialchars($_SESSION['name']) ?></strong>! Here are all your active and past course enrollments.</p>
  </div>

  <?php if ($registrations): ?>
  <div class="table-container">
    <table class="styled-table">
      <thead>
        <tr><th>Course</th><th>Instructor</th><th>Mode</th><th>Location</th><th>Start Date</th><th>End Date</th></tr>
      </thead>
      <tbody>
        <?php foreach($registrations as $r): ?>
        <tr>
          <td><?= htmlspecialchars($r['title']) ?></td>
          <td><?= htmlspecialchars($r['instructor'] ?: 'TBA') ?></td>
          <td><?= htmlspecialchars($r['mode']) ?></td>
          <td><?= htmlspecialchars($r['location']) ?></td>
          <td><?= htmlspecialchars($r['start_date']) ?></td>
          <td><?= htmlspecialchars($r['end_date']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php else: ?>
    <p class="empty-message">You are not registered in any courses yet.</p>
  <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
