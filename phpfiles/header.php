<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : "University Club"; ?></title>
    <link rel="stylesheet" href="/WebDev-Group-Project/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <h1><a href="/WebDev-Group-Project/index.php" style="color: white; text-decoration: none;">University Club</a></h1>
            </div>
            <button class="nav-toggle" id="navToggle">☰</button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="/WebDev-Group-Project/index.php" class="nav-link">Home</a></li>
                <li><a href="/WebDev-Group-Project/phpfiles/announcement.php" class="nav-link">Announcements</a></li>
                <li><a href="/WebDev-Group-Project/phpfiles/events.php" class="nav-link">Events</a></li>
                <li><a href="/WebDev-Group-Project/phpfiles/about.php" class="nav-link">About</a></li>
                <li><a href="/WebDev-Group-Project/phpfiles/gallery.php" class="nav-link">Gallery</a></li>
                <li><a href="/WebDev-Group-Project/phpfiles/membership.php" class="nav-link">Membership</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="/WebDev-Group-Project/phpfiles/authfiles/logout.php" class="nav-link">Logout</a></li>
                <?php else: ?>
                    <li><a href="/WebDev-Group-Project/phpfiles/authfiles/login.php" class="nav-link">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
