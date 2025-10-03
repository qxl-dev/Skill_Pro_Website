<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('admin');
require __DIR__ . '/../partials/header.php';
?>

<h2>Admin Dashboard</h2>
<p>Welcome, <?= htmlspecialchars($_SESSION['name']) ?>. Use the tools below:</p>

<div class="grid">
  <div class="card">
    <h3>Users</h3>
    <p>Approve instructors, manage students.</p>
    <a class="btn" href="/admin/manage_users.php">Manage Users</a>
  </div>
  <div class="card">
    <h3>Courses</h3>
    <p>Create/update course info and assign instructors.</p>
    <a class="btn" href="/admin/manage_courses.php">Manage Courses</a>
  </div>
  <div class="card">
    <h3>Schedules</h3>
    <p>Classes, exams, workshops.</p>
    <a class="btn" href="/admin/manage_schedules.php">Manage Schedules</a>
  </div>
  <div class="card">
    <h3>Notices</h3>
    <p>Upcoming batches, holidays, events.</p>
    <a class="btn" href="/admin/manage_notices.php">Manage Notices</a>
  </div>
  <div class="card">
    <h3>Inquiries</h3>
    <p>View/respond to student inquiries.</p>
    <a class="btn" href="/admin/manage_inquiries.php">Manage Inquiries</a>
  </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
