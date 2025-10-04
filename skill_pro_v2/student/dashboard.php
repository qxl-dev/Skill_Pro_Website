<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_role('student');
include_once __DIR__ . '/../partials/header.php';

$student_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
  SELECT c.title, o.mode, o.location, o.start_date, o.end_date, u.full_name AS instructor
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

<div class="dashboard-wrapper">
  <section class="welcome-section">
    <h2>Welcome back, <?= htmlspecialchars($_SESSION['name']) ?> 👋</h2>
    <p>Here’s what’s happening with your learning journey today.</p>
  </section>

  <section class="stats-cards">
    <div class="stat-card"><i class="fa-solid fa-book-open"></i><h3><?= count($registrations) ?></h3><p>Active Enrollments</p></div>
    <div class="stat-card"><i class="fa-solid fa-calendar-days"></i><h3><?= rand(2,5) ?></h3><p>Ongoing Modules</p></div>
    <div class="stat-card"><i class="fa-solid fa-trophy"></i><h3><?= rand(75,99) ?>%</h3><p>Average Progress</p></div>
  </section>

  <section class="course-section">
    <h3>My Registered Courses</h3>
    <?php if ($registrations): ?>
      <table class="dark-table">
        <thead>
          <tr><th>Course</th><th>Instructor</th><th>Mode</th><th>Location</th><th>Start</th><th>End</th></tr>
        </thead>
        <tbody>
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
        </tbody>
      </table>
    <?php else: ?>
      <p class="empty-msg">You have not registered for any courses yet.</p>
    <?php endif; ?>
  </section>

  <section class="quick-links">
    <h3>Quick Access</h3>
    <div class="links-grid">
      <a href="../calendar.php"><i class="fa-solid fa-calendar"></i> View Calendar</a>
      <a href="../courses.php"><i class="fa-solid fa-book"></i> Explore More Courses</a>
      <a href="../inquiries.php"><i class="fa-solid fa-envelope"></i> Contact Institute</a>
      <a href="../notices.php"><i class="fa-solid fa-bullhorn"></i> Latest Notices</a>
    </div>
  </section>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
