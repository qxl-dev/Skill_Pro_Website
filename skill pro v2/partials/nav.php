<nav class="main-nav">
    <ul>
        <!-- Always visible -->
        <li><a href="courses.php">Courses</a></li>
        <li><a href="calendar.php">Calendar</a></li>
        <li><a href="notices.php">Notices</a></li>
        <li><a href="inquiries.php">Inquiries</a></li>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <!-- Guest -->
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>

        <?php else: ?>
            <!-- Logged in -->
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <li><a href="admin/index.php">Admin Dashboard</a></li>

            <?php elseif ($_SESSION['role'] === 'instructor'): ?>
                <li><a href="instructor/dashboard.php">Instructor Dashboard</a></li>
                <li><a href="instructor/my_courses.php">My Courses</a></li>

            <?php elseif ($_SESSION['role'] === 'student'): ?>
                <li><a href="student/dashboard.php">Student Dashboard</a></li>
                <li><a href="student/my_registrations.php">My Registrations</a></li>
            <?php endif; ?>

            <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
    </ul>

    <!-- Mobile toggle (hamburger menu) -->
    <button class="nav-toggle"><i class="fas fa-bars"></i></button>
</nav>
