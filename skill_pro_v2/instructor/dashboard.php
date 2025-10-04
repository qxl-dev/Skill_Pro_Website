<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('instructor');
require __DIR__ . '/../partials/header.php';

$instructor_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
  SELECT o.id, c.title, o.mode, o.location, o.start_date, o.end_date
  FROM course_offerings o
  JOIN courses c ON o.course_id = c.id
  WHERE o.instructor_id = ?
");
$stmt->execute([$instructor_id]);
$myCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/skill_pro_v2/assets/css/instructor.css">

<div class="instructor-dashboard">
  <div class="welcome-box">
    <h2>Welcome back, <?= htmlspecialchars($_SESSION['name']) ?> 👋</h2>
    <p>Manage your classes, monitor progress, and connect with your students below.</p>
  </div>

  <div class="stats-grid">
    <div class="stat-card">
      <i class="fa-solid fa-chalkboard-user"></i>
      <h3><?= count($myCourses) ?></h3>
      <p>Courses You Teach</p>
    </div>
    <div class="stat-card">
      <i class="fa-solid fa-users"></i>
      <h3><?= rand(15,40) ?></h3>
      <p>Active Students</p>
    </div>
    <div class="stat-card">
      <i class="fa-solid fa-calendar-check"></i>
      <h3><?= rand(2,6) ?></h3>
      <p>Ongoing Modules</p>
    </div>
  </div>

  <div class="table-section">
    <h3>Your Current Courses</h3>
    <?php if ($myCourses): ?>
      <table>
        <tr>
          <th>Course</th>
          <th>Mode</th>
          <th>Location</th>
          <th>Start</th>
          <th>End</th>
          <th>Students</th>
        </tr>
        <?php foreach($myCourses as $c): ?>
          <tr>
            <td><?= htmlspecialchars($c['title']) ?></td>
            <td><?= $c['mode'] ?></td>
            <td><?= $c['location'] ?></td>
            <td><?= $c['start_date'] ?></td>
            <td><?= $c['end_date'] ?></td>
            <td><a href="#" class="view-btn" onclick="showStudents(<?= $c['id'] ?>)">View</a></td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php else: ?>
      <p>No assigned courses yet.</p>
    <?php endif; ?>
  </div>
</div>

<!-- Student List Modal -->
<div id="studentModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <h3>Enrolled Students</h3>
    <ul id="studentList"></ul>
  </div>
</div>

<script>
function showStudents(offeringId) {
  fetch(`/skill_pro_v2/instructor/students_api.php?offering=${offeringId}`)
    .then(res => res.json())
    .then(data => {
      const list = document.getElementById('studentList');
      list.innerHTML = '';
      if (data.length === 0) {
        list.innerHTML = '<li>No students enrolled.</li>';
      } else {
        data.forEach(s => {
          list.innerHTML += `<li>${s.full_name} - ${s.email}</li>`;
        });
      }
      document.getElementById('studentModal').style.display = 'flex';
    })
    .catch(err => alert('Error fetching students.'));
}

function closeModal() {
  document.getElementById('studentModal').style.display = 'none';
}
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
