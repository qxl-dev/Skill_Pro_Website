<?php
require __DIR__ . '/config/db.php';
require __DIR__ . '/partials/header.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? AND role=?");
    $stmt->execute([$email, $role]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && hash('sha256', $password) === $user['password_hash']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['full_name'];

        if ($role === 'admin') header("Location: /admin/index.php");
        elseif ($role === 'instructor') header("Location: /instructor/dashboard.php");
        else header("Location: /student/dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials. Please try again.";
    }
}
?>

<link rel="stylesheet" href="assets/css/login.css">

<div class="login-page">
  <div class="login-card">
    <h2>Welcome Back 👋</h2>
    <p class="tagline">Log in to access your dashboard</p>

    <?php if ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>
      </div>

      <div class="form-group">
        <label>Role</label>
        <select name="role" required>
          <option value="student">Student</option>
          <option value="instructor">Instructor</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button type="submit" class="btn-login">Login</button>
    </form>

    <p class="register-link">Don’t have an account? <a href="register.php">Register here</a></p>
  </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
