<nav class="main-nav">
    <ul>
        <!-- Always visible -->
        <li><a href="/skill_pro_v2/courses.php">Courses</a></li>
        <li><a href="/skill_pro_v2/calendar.php">Calendar</a></li>
        <li><a href="/skill_pro_v2/notices.php">Notices</a></li>
        <li><a href="/skill_pro_v2/inquiries.php">Inquiries</a></li>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <!-- Guest -->
            <li><a href="/skill_pro_v2/login.php">Login</a></li>
            <li><a href="/skill_pro_v2/register.php">Register</a></li>

        <?php else: ?>
            <!-- Logged in -->
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <li><a href="/skill_pro_v2/admin/index.php">Admin Dashboard</a></li>

            <?php elseif ($_SESSION['role'] === 'instructor'): ?>
                <li><a href="/skill_pro_v2/instructor/dashboard.php">Instructor Dashboard</a></li>
                <li><a href="/skill_pro_v2/instructor/my_courses.php">My Courses</a></li>

            <?php elseif ($_SESSION['role'] === 'student'): ?>
                <li><a href="/skill_pro_v2/student/dashboard.php">Student Dashboard</a></li>
                <li><a href="/skill_pro_v2/student/my_registrations.php">My Registrations</a></li>
            <?php endif; ?>

            <li><a href="/skill_pro_v2/logout.php">Logout</a></li>
        <?php endif; ?>
    </ul>

    <!-- Mobile toggle (hamburger menu) -->
    <button class="nav-toggle"><i class="fas fa-bars"></i></button>
</nav>
