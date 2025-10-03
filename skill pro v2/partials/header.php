<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkillPro Institute</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Global Styles -->
    <link rel="stylesheet" href="assets/css/theme.css">

    <script defer src="assets/js/main.js"></script>
</head>

<body>
    <!-- Site Header -->
    <header class="site-header">
        <div class="container header-container">
            <h1 class="logo">
                <a href="index.php">SkillPro Institute</a>
            </h1>

            <!-- Navigation -->
            <nav class="main-nav">
                <?php include __DIR__ . '/nav.php'; ?>
            </nav>
        </div>
    </header>

    <!-- Main Container -->
    <main class="container">
