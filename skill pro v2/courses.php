<?php
require __DIR__ . '/config/db.php';
require __DIR__ . '/partials/header.php';

$student_id = (isset($_SESSION['role']) && $_SESSION['role'] === 'student') ? $_SESSION['user_id'] : null;

// Handle search/filter
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$sql = "
    SELECT c.id, c.title, c.category, c.description, c.fee,
           o.id as offering_id, o.mode, o.location, o.start_date, o.end_date,
           u.full_name as instructor
    FROM courses c
    LEFT JOIN course_offerings o ON c.id=o.course_id
    LEFT JOIN users u ON o.instructor_id=u.id
    WHERE 1
";

$params = [];

if ($search) {
    $sql .= " AND c.title LIKE ? ";
    $params[] = "%$search%";
}

if ($category) {
    $sql .= " AND c.category = ? ";
    $params[] = $category;
}

$sql .= " ORDER BY c.id";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Image mapping
$imageMap = [
    'ICT'          => 'ict.jpeg',
    'Welding'      => 'welding.jpg',
    'Plumbing'     => 'plumbing.jpg',
    'Hospitality'  => 'hospitality.jpg',
    'Engineering'  => 'electrical.jpg',
    'Software'     => 'software.png',
];
?>

<link rel="stylesheet" href="assets/css/courses.css?v=<?php echo time(); ?>">

<!-- Hero Banner -->
<div class="courses-hero">
  <h1>Explore Our Courses</h1>
  <p>SkillPro Institute offers practical training programs for your future career.</p>
</div>

<!-- Search + Filter Bar -->
<div class="filter-bar">
  <form method="get" class="filter-form">
    <input type="text" name="search" placeholder="Search courses..." value="<?= htmlspecialchars($search) ?>">
    <select name="category">
      <option value="">All Categories</option>
      <option value="ICT" <?= $category=='ICT'?'selected':'' ?>>ICT</option>
      <option value="Welding" <?= $category=='Welding'?'selected':'' ?>>Welding</option>
      <option value="Plumbing" <?= $category=='Plumbing'?'selected':'' ?>>Plumbing</option>
      <option value="Hospitality" <?= $category=='Hospitality'?'selected':'' ?>>Hospitality</option>
      <option value="Engineering" <?= $category=='Engineering'?'selected':'' ?>>Engineering</option>
      <option value="Software" <?= $category=='Software'?'selected':'' ?>>Software</option>
    </select>
    <button type="submit">Filter</button>
  </form>
</div>

<!-- Courses Grid -->
<div class="course-grid">
  <?php if ($courses): ?>
    <?php foreach ($courses as $c): ?>
      <?php $imgFile = $imageMap[$c['category']] ?? 'default.jpg'; ?>
      <div class="course-card">
        <img src="assets/images/courses/<?= $imgFile ?>" alt="<?= htmlspecialchars($c['title']) ?>">
        <div class="course-info">
          <h3><a href="course.php?id=<?= $c['id'] ?>"><?= htmlspecialchars($c['title']) ?></a></h3>
          <p class="category"><?= htmlspecialchars($c['category']) ?></p>
          <p class="desc"><?= htmlspecialchars($c['description']) ?></p>
          <p class="fee">Fee: Rs <?= number_format($c['fee'], 2) ?></p>

          <?php if (!empty($c['instructor'])): ?>
            <p class="instructor">Instructor: <?= htmlspecialchars($c['instructor']) ?></p>
            <p class="schedule"><?= $c['mode'] ?> · <?= $c['location'] ?><br>
              <?= $c['start_date'] ?> → <?= $c['end_date'] ?></p>
          <?php else: ?>
            <p><em>Schedule to be announced</em></p>
          <?php endif; ?>

          <?php if ($student_id && !empty($c['offering_id'])): ?>
            <a href="courses.php?register=<?= $c['offering_id'] ?>" class="btn">Register</a>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="text-align:center; margin:40px auto;">No courses found. Try a different search.</p>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
