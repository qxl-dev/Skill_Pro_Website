<?php include __DIR__ . '/partials/header.php'; ?>





<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SkillPro Institute</title>

  <!-- Global base styles (reset, forms, containers, etc.) -->
  <!-- <link rel="stylesheet" href="assets/css/style.css"> -->

  <!-- Dark theme overrides for header/nav/footer -->
  <link rel="stylesheet" href="assets/css/theme.css">

  <!-- Page-specific styles (hero, feedbacks, etc.) -->
  <link rel="stylesheet" href="assets/css/home.css?v=<?php echo time(); ?>">

  <script defer src="assets/js/main.js"></script>
</head>


<!-- Hero Banner -->

<section class="hero">
  <div class="hero-content">
    <h1>Welcome to SkillPro Institute</h1>
    <p>Nationally recognized TVET programs in ICT, Engineering, Hospitality, and more.</p>
    <div class="hero-buttons">
      <a href="courses.php" class="btn-primary">Explore Courses</a>
      <a href="register.php" class="btn-secondary">Register Now</a>
    </div>
  </div>
</section>

<!-- About Section -->
<section class="about">
  <div class="container">
    <div class="about-text">
      <h2>About SkillPro</h2>
      <p>SkillPro Institute is a leading TVEC-accredited vocational training institute in Sri Lanka with branches in Colombo, Kandy, and Matara. We provide industry-focused training that empowers students with job-ready skills.</p>
    </div>
  </div>
</section>


<!-- Popular Courses -->
<section class="popular-courses">
  <div class="container">
    <h2>Popular Courses</h2>
    <div class="course-cards">
      <div class="course-card">
        <img src="assets/images/courses/ict.jpeg" alt="ICT">
        <h3>ICT Fundamentals</h3>
        <p>Learn the essentials of computing and networking.</p>
      </div>
      <div class="course-card">
        <img src="assets/images/courses/welding.jpg" alt="Welding">
        <h3>Welding Techniques</h3>
        <p>Hands-on training in industrial welding.</p>
      </div>
      <div class="course-card">
        <img src="assets/images/courses/hospitality.jpg" alt="Hospitality">
        <h3>Hotel Management</h3>
        <p>Professional skills in hospitality & tourism.</p>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose Us -->
<section class="why-us">
  <div class="container">
    <h2>Why Choose SkillPro?</h2>
    <div class="features">
      <div class="feature-card">
        <div class="icon">✅</div>
        <h3>Accredited by TVEC</h3>
        <p>Our programs are nationally recognized and accredited.</p>
      </div>
      <div class="feature-card">
        <div class="icon">👩‍🏫</div>
        <h3>Expert Instructors</h3>
        <p>Learn from experienced professionals in each field.</p>
      </div>
      <div class="feature-card">
        <div class="icon">🏢</div>
        <h3>Multiple Campuses</h3>
        <p>Branches in Colombo, Kandy & Matara for easy access.</p>
      </div>
      <div class="feature-card">
        <div class="icon">💼</div>
        <h3>Job-Focused Training</h3>
        <p>Programs designed to prepare you for real careers.</p>
      </div>
    </div>
  </div>
</section>



<!-- Notices Preview -->

<?php
require __DIR__ . '/config/db.php';

// fetch latest 3 notices
$notices = $pdo->query("SELECT * FROM notices ORDER BY publish_at DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="notices-preview">
  <div class="container">
    <h2>Latest Notices</h2>
    <div class="notice-cards">
      <?php if (!empty($notices)): ?>
        <?php foreach($notices as $n): ?>
          <div class="notice-card">
            <div class="notice-icon">📢</div>
            <h3><?= htmlspecialchars($n['title']) ?></h3>
            <p><?= htmlspecialchars($n['content']) ?></p>
            <small>📅 <?= date("F j, Y", strtotime($n['publish_at'])) ?></small>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No notices available at the moment.</p>
      <?php endif; ?>
    </div>
    <a href="notices.php" class="btn-secondary">View All Notices</a>
  </div>
</section>


<!-- Testimonials -->
<section class="testimonials">
  <div class="container">
    <h2>What Our Students Say</h2>
    <div class="testimonial-cards">
      <div class="testimonial">
        <p>"SkillPro helped me land my first job as a network technician. The hands-on labs were the best part!"</p>
        <h4>- Nadeesha Silva, ICT Graduate</h4>
      </div>
      <div class="testimonial">
        <p>"The welding course was practical and well-structured. Now I’m working at a top construction company."</p>
        <h4>- Malith Senanayake, Welding Student</h4>
      </div>
      <div class="testimonial">
        <p>"The hotel management program gave me confidence to apply abroad. Lecturers were very supportive."</p>
        <h4>- Gayani Ratnayake, Hospitality Student</h4>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta">
  <div class="container">
    <h2>Start Your Journey with SkillPro Today</h2>
    <a href="register.php" class="btn-primary">Register Now</a>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
