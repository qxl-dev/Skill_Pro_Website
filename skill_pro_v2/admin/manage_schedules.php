<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/auth.php';
require_role('admin');
require __DIR__ . '/../partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cid = $_POST['course_id'];
    $iid = $_POST['instructor_id'];
    $mode = $_POST['mode'];
    $loc = $_POST['location'];
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $pdo->prepare("INSERT INTO course_offerings (course_id,instructor_id,mode,location,start_date,end_date) VALUES (?,?,?,?,?,?)")
        ->execute([$cid,$iid,$mode,$loc,$start,$end]);
    echo "<p style='color:lime;'>✅ Schedule added successfully.</p>";
}

$courses = $pdo->query("SELECT id,title FROM courses")->fetchAll();
$instructors = $pdo->query("SELECT id,full_name FROM users WHERE role='instructor'")->fetchAll();
$schedules = $pdo->query("
  SELECT o.id, c.title, u.full_name, o.mode, o.location, o.start_date, o.end_date
  FROM course_offerings o 
  JOIN courses c ON o.course_id=c.id
  LEFT JOIN users u ON o.instructor_id=u.id
")->fetchAll();
?>
<link rel="stylesheet" href="/skill_pro_v2/assets/css/admin.css">

<div class="admin-wrapper">
  <h2>Manage Schedules</h2>
  <form method="post">
    <select name="course_id" required>
      <option disabled selected>Select Course</option>
      <?php foreach($courses as $c): ?>
        <option value="<?= $c['id'] ?>"><?= $c['title'] ?></option>
      <?php endforeach; ?>
    </select>

    <select name="instructor_id" required>
      <option disabled selected>Select Instructor</option>
      <?php foreach($instructors as $i): ?>
        <option value="<?= $i['id'] ?>"><?= $i['full_name'] ?></option>
      <?php endforeach; ?>
    </select>

    <select name="mode">
      <option>Online</option>
      <option>On-site</option>
    </select>

    <input type="text" name="location" placeholder="Location" required>
    <input type="date" name="start_date" required>
    <input type="date" name="end_date" required>
    <button type="submit">Add Schedule</button>
  </form>

  <h3>Current Offerings</h3>
  <table>
    <tr><th>ID</th><th>Course</th><th>Instructor</th><th>Mode</th><th>Location</th><th>Dates</th></tr>
    <?php foreach($schedules as $s): ?>
    <tr>
      <td><?= $s['id'] ?></td>
      <td><?= htmlspecialchars($s['title']) ?></td>
      <td><?= htmlspecialchars($s['full_name']) ?></td>
      <td><?= $s['mode'] ?></td>
      <td><?= $s['location'] ?></td>
      <td><?= $s['start_date'] ?> → <?= $s['end_date'] ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
