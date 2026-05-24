<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | Events</title>
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
    <a href="announcements.php">Announcements</a>
    <a href="events.php" class="active">Events</a>
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
    <p class="eyebrow">EVENTS</p>

    <h1>
      Explore student
      <span>activities.</span>
    </h1>

    <p>
      Browse upcoming workshops, networking activities, meetings, and social events
      organised for UniClub members.
    </p>
  </section>

  <section class="event-tools">
    <input type="text" id="eventSearch" placeholder="Search events...">

    <select id="eventCategory">
      <option value="all">All Categories</option>
      <option value="careers">Careers</option>
      <option value="workshop">Workshop</option>
      <option value="social">Social</option>
      <option value="meeting">Meeting</option>
    </select>
  </section>

  <section class="event-grid">

    <div class="event-card" data-category="careers">
      <p class="event-type">CAREERS</p>
      <h2>Annual Careers Fair</h2>
      <p class="event-date">31 MAY 2026</p>
      <p>Meet employers and explore internship and career opportunities.</p>
    </div>

    <div class="event-card" data-category="workshop">
      <p class="event-type">WORKSHOP</p>
      <h2>Resume Workshop</h2>
      <p class="event-date">10 JUNE 2026</p>
      <p>Improve your resume and LinkedIn profile with student mentors.</p>
    </div>

    <div class="event-card" data-category="social">
      <p class="event-type">SOCIAL</p>
      <h2>Social Mixer Night</h2>
      <p class="event-date">18 JUNE 2026</p>
      <p>Meet fellow students through games, food, and friendly activities.</p>
    </div>

    <div class="event-card" data-category="meeting">
      <p class="event-type">MEETING</p>
      <h2>Monthly Club Meeting</h2>
      <p class="event-date">25 JUNE 2026</p>
      <p>Join the meeting to hear updates and contribute activity ideas.</p>
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