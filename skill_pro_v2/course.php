<?php
require __DIR__ . '/config/db.php';
require __DIR__ . '/partials/header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch course info
$stmt = $pdo->prepare("
    SELECT c.*, u.full_name AS instructor, o.mode, o.location, o.start_date, o.end_date
    FROM courses c
    LEFT JOIN course_offerings o ON c.id = o.course_id
    LEFT JOIN users u ON o.instructor_id = u.id
    WHERE c.id = ?
    LIMIT 1
");
$stmt->execute([$id]);
$course = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$course) {
    echo "<p>Course not found.</p>";
    require __DIR__ . '/partials/footer.php';
    exit;
}
?>

<link rel="stylesheet" href="assets/css/course.css">

<div class="course-hero">
  <h1><?= htmlspecialchars($course['title']) ?></h1>
  <p class="category"><?= htmlspecialchars($course['category']) ?></p>
</div>

<div class="course-container">
  <!-- Overview -->
  <section class="overview">
    <h2>Course Overview</h2>
    <p><?= nl2br(htmlspecialchars($course['description'])) ?></p>
    <p><strong>Fee:</strong> Rs <?= number_format($course['fee'], 2) ?></p>
    <?php if ($course['instructor']): ?>
      <p><strong>Instructor:</strong> <?= htmlspecialchars($course['instructor']) ?></p>
    <?php endif; ?>
    <?php if ($course['mode']): ?>
      <p><strong>Mode:</strong> <?= $course['mode'] ?> · <strong>Location:</strong> <?= $course['location'] ?></p>
      <p><strong>Schedule:</strong> <?= $course['start_date'] ?> → <?= $course['end_date'] ?></p>
    <?php endif; ?>
  </section>

  <!-- Modules -->
  <section class="modules">
    <h2>Modules You Will Study</h2>
    <ul>
      <li>Introduction to <?= htmlspecialchars($course['category']) ?></li>
      <li>Practical Applications & Hands-on Training</li>
      <li>Industry Tools & Best Practices</li>
      <li>Project Work / Capstone Project</li>
    </ul>
  </section>

  <!-- Career Outcomes -->
  <section class="careers">
    <h2>Career Outcomes</h2>
    <p>Graduates of this course can pursue roles such as:</p>
    <ul>
      <?php if ($course['category'] == 'ICT'): ?>
        <li>IT Support Specialist</li>
        <li>Network Technician</li>
        <li>Junior Software Developer</li>
      <?php elseif ($course['category'] == 'Welding'): ?>
        <li>Certified Welder</li>
        <li>Fabrication Technician</li>
        <li>Construction Site Supervisor</li>
      <?php elseif ($course['category'] == 'Hospitality'): ?>
        <li>Hotel Operations Executive</li>
        <li>Front Office Coordinator</li>
        <li>Food & Beverage Supervisor</li>
      <?php else: ?>
        <li>Industry-relevant technical positions</li>
      <?php endif; ?>
    </ul>
  </section>

  <!-- Further Study -->
  <section class="further-study">
    <h2>Further Study Options</h2>
    <p>Successful completion of this course opens pathways to higher qualifications, such as:</p>
    <ul>
      <li>Diploma Programs in <?= htmlspecialchars($course['category']) ?></li>
      <li>Bachelor’s Degrees at partner universities</li>
      <li>Specialized Certifications for advanced skills</li>
    </ul>
  </section>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
