<?php
require __DIR__ . '/config/db.php';
require __DIR__ . '/partials/header.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if ($role === 'admin') {
        $error = "Admins cannot register directly.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO users (role, full_name, email, password_hash) VALUES (?,?,?,?)");
            $stmt->execute([$role, $name, $email, hash('sha256', $password)]);
            $success = "✅ Account created successfully! You can now login.";
        } catch (PDOException $e) {
            $error = "❌ Registration failed: " . $e->getMessage();
        }
    }
}
?>

<link rel="stylesheet" href="assets/css/register.css">

<div class="register-page">
  <div class="register-hero">
    <h1>Create Your Account</h1>
    <p>Join SkillPro Institute today and start your journey towards skill development and career growth.</p>
  </div>

  <div class="register-container">
    <!-- Info Panel -->
    <div class="register-info">
      <h2>Why Register?</h2>
      <ul>
        <li>📘 Access course materials and schedules</li>
        <li>👨‍🏫 Connect with expert instructors</li>
        <li>🎓 Track your learning progress</li>
        <li>💼 Gain skills for future career opportunities</li>
      </ul>
      <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>

    <!-- Register Form -->
    <div class="register-form">
      <h2>Sign Up</h2>
      <?php if ($error): ?><p class="msg error"><?= $error ?></p><?php endif; ?>
      <?php if ($success): ?><p class="msg success"><?= $success ?></p><?php endif; ?>

      <form method="post">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" name="full_name" required>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" required>
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" required>
        </div>

        <div class="form-group">
          <label>Role</label>
          <select name="role" required>
            <option value="student">Student</option>
            <option value="instructor">Instructor</option>
          </select>
        </div>

        <button type="submit" class="btn-register">Register</button>
      </form>
    </div>
  </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
