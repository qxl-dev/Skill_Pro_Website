<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('admin');
require __DIR__ . '/../partials/header.php';
?>
<link rel="stylesheet" href="/skill_pro_v2/assets/css/admin.css">

<div class="admin-wrapper">
  <h2>Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h2>
  <p>Manage all institute operations using the tools below.</p>

  <div class="grid">
    <div class="card">
      <h3>Users</h3>
      <p>Approve instructors and manage student accounts.</p>
      <a class="btn" href="manage_users.php">Manage Users</a>
    </div>
    <div class="card">
      <h3>Courses</h3>
      <p>Create, update, and assign instructors to courses.</p>
      <a class="btn" href="manage_courses.php">Manage Courses</a>
    </div>
    <div class="card">
      <h3>Schedules</h3>
      <p>Control classes, exams, and workshop timetables.</p>
      <a class="btn" href="manage_schedules.php">Manage Schedules</a>
    </div>
    <div class="card">
      <h3>Notices</h3>
      <p>Publish institute updates, events, or announcements.</p>
      <a class="btn" href="manage_notices.php">Manage Notices</a>
    </div>
    <div class="card">
      <h3>Inquiries</h3>
      <p>View and respond to student or staff inquiries.</p>
      <a class="btn" href="manage_inquiries.php">Manage Inquiries</a>
    </div>
  </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
