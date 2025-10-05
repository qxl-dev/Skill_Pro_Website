<?php
require __DIR__ . '/partials/header.php';
?>

<link rel="stylesheet" href="assets/css/theme.css">

<div class="admin-wrapper">
  <h2>SkillPro Institute – Sitemap</h2>
  <p>This page lists all available sections for quick access.</p>

  <ul style="line-height:1.8; font-size:1.1rem;">
    <li><a href="index.php">Home</a></li>
    <li><a href="courses.php">Courses</a></li>
    <li><a href="calendar.php">Event Calendar</a></li>
    <li><a href="notices.php">Notices</a></li>
    <li><a href="inquiries.php">Inquiries</a></li>
    <li><a href="login.php">Login</a></li>
    <li><a href="register.php">Register</a></li>

    <h3>Student Portal</h3>
    <ul>
      <li><a href="student/dashboard.php">Student Dashboard</a></li>
      <li><a href="student/my_registrations.php">My Registrations</a></li>
    </ul>

    <h3>Instructor Portal</h3>
    <ul>
      <li><a href="instructor/dashboard.php">Instructor Dashboard</a></li>
      <li><a href="instructor/my_courses.php">My Courses</a></li>
    </ul>

    <h3>Admin Panel</h3>
    <ul>
      <li><a href="admin/index.php">Admin Dashboard</a></li>
      <li><a href="admin/manage_users.php">Manage Users</a></li>
      <li><a href="admin/manage_courses.php">Manage Courses</a></li>
      <li><a href="admin/manage_schedules.php">Manage Schedules</a></li>
      <li><a href="admin/manage_notices.php">Manage Notices</a></li>
      <li><a href="admin/manage_inquiries.php">Manage Inquiries</a></li>
    </ul>
  </ul>
</div>

<?php
require __DIR__ . '/partials/footer.php';
?>
