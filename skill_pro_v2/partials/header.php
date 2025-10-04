<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkillPro Institute</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/skill_pro_v2/assets/css/theme.css?v=<?php echo time(); ?>">
    <script defer src="/skill_pro_v2/assets/js/main.js"></script>
</head>

<body>
    <!-- Site Header -->
    <header class="site-header">
        <div class="header-inner">
            <h1 class="logo">
                <a href="/skill_pro_v2/index.php">SkillPro Institute</a>
            </h1>

            <!-- Navigation -->
            <?php include __DIR__ . '/nav.php'; ?>
        </div>
    </header>

    <!-- Add spacer so content isn’t hidden under fixed header -->
    <div class="header-spacer"></div>

    <!-- Main -->
    <main class="page-container">
