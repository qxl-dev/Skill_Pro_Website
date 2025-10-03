<?php
require __DIR__ . '/config/db.php';
require __DIR__ . '/partials/header.php';

$success = ""; 
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $msg = $_POST['message'];
    try {
        $stmt = $pdo->prepare("INSERT INTO inquiries (name,email,message) VALUES (?,?,?)");
        $stmt->execute([$name,$email,$msg]);
        $success = "✅ Inquiry submitted. We will contact you soon!";
    } catch (PDOException $e) {
        $error = "❌ Failed to submit inquiry.";
    }
}
?>

<link rel="stylesheet" href="assets/css/inquiries.css">

<div class="inquiries-page">
  <div class="inquiries-hero">
    <h1>Contact Us</h1>
    <p>Have questions? Reach out to SkillPro Institute for course details, support, or general inquiries.</p>
  </div>

  <div class="inquiries-container">
    <!-- Contact Info Sidebar -->
    <div class="contact-info">
      <h2>Get in Touch</h2>
      <p><strong>📍 Address:</strong> Colombo, Sri Lanka</p>
      <p><strong>📞 Phone:</strong> +94 11 234 5678</p>
      <p><strong>✉️ Email:</strong> info@skillpro.lk</p>
      <p>We typically respond within 24 hours.</p>
    </div>

    <!-- Inquiry Form -->
    <div class="inquiry-form">
      <h2>Submit Inquiry</h2>
      <?php if ($success): ?><p class="msg success"><?= $success ?></p><?php endif; ?>
      <?php if ($error): ?><p class="msg error"><?= $error ?></p><?php endif; ?>

      <form method="post">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" required>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" required>
        </div>

        <div class="form-group">
          <label>Message</label>
          <textarea name="message" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn-send">Send Inquiry</button>
      </form>
    </div>
  </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
