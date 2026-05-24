<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | Announcements</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="cursor-circle" id="cursorCircle"></div>

<nav class="navbar">
  <div class="logo">
    <span></span>
    UniClub
  </div>

  <div class="nav-links">
    <a href="../index.php">Home</a>
    <a href="about.php">About</a>
    <a href="membership.php">Membership</a>
    <a href="announcements.php" class="active">Announcements</a>
    <a href="events.php">Events</a>
    <?php if (isset($_SESSION['username'])): ?>

        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="admin_profilepage.php">Profile</a>
        <?php else: ?>
            <a href="member_profilepage.php">Profile</a>
        <?php endif; ?>

        <a href="logout.php">Logout</a>

    <?php else: ?>

        <a href="login.php">Log in</a>

    <?php endif; ?>
  </div>
</nav>
<main>

  <section class="page-header">
    <p class="eyebrow">ANNOUNCEMENTS</p>

    <h1>
      Latest club
      <span>updates.</span>
    </h1>

    <p>
      Check the newest club notices, meeting reminders, event updates, and important
      student announcements.
    </p>
  </section>

  <section class="filter-buttons">
    <button class="filter-btn active" data-filter="all">All</button>
    <button class="filter-btn" data-filter="event">Events</button>
    <button class="filter-btn" data-filter="meeting">Meetings</button>
    <button class="filter-btn" data-filter="deadline">Deadlines</button>
  </section>

  <section class="announcement-grid">

    <div class="announcement-card" data-category="event">
      <p class="date">20 MAY</p>
      <h2>Careers Fair Registration Open</h2>
      <p>Students can now register for the Annual Careers Fair happening this semester.</p>
    </div>

    <div class="announcement-card" data-category="deadline">
      <p class="date">24 MAY</p>
      <h2>Membership Registration Reminder</h2>
      <p>Students are encouraged to complete membership registration before the end of the month.</p>
    </div>

    <div class="announcement-card" data-category="meeting">
      <p class="date">28 MAY</p>
      <h2>Club Meeting This Friday</h2>
      <p>Members are invited to attend the monthly planning and activity meeting.</p>
    </div>

    <div class="announcement-card" data-category="event">
      <p class="date">10 JUN</p>
      <h2>Resume Workshop Coming Soon</h2>
      <p>A student-focused resume and LinkedIn workshop will be held next month.</p>
    </div>

  </section>

</main>

<footer class="footer">
  <div class="footer-logo">
    <span></span>
    UniClub
  </div>

  <div class="footer-links">
    <a href="../index.php">Home</a>
    <a href="about.php">About</a>
    <a href="membership.php">Membership</a>
    <a href="announcements.php">Announcements</a>
    <a href="events.php">Events</a>
  </div>

  <p>© 2026 UniClub. All rights reserved.</p>
</footer>

<script src="../backend/java.js"></script>

</body>
</html>