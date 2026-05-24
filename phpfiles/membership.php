<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | Membership</title>
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
    <a href="membership.php" class="active">Membership</a>
    <a href="announcements.php">Announcements</a>
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
    <p class="eyebrow">MEMBERSHIP</p>

    <h1>
      Join the club and start
      <span>building connections.</span>
    </h1>

    <p>
      Register as a member to receive club updates, join events, and become part
      of the student community.
    </p>
  </section>

  <section class="plan-grid">

    <div class="plan-card">
      <h2>Explorer</h2>
      <h3>Free</h3>
      <ul>
        <li>Club event access</li>
        <li>Community updates</li>
        <li>Student activities</li>
      </ul>
      <a href="#joinForm" class="plan-button">Get Started</a>
    </div>

    <div class="plan-card featured-plan">
      <p class="plan-tag">MOST POPULAR</p>
      <h2>Member</h2>
      <h3>Free</h3>
      <ul>
        <li>Workshops access</li>
        <li>Networking events</li>
        <li>Career support</li>
        <li>Leadership activities</li>
      </ul>
      <a href="#joinForm" class="plan-button">Join Now</a>
    </div>

    <div class="plan-card">
      <h2>Committee</h2>
      <h3>Selected</h3>
      <ul>
        <li>Event planning</li>
        <li>Team leadership</li>
        <li>Club operations</li>
      </ul>
      <a href="#joinForm" class="plan-button">Apply</a>
    </div>

  </section>

  <section class="form-section">
    <form id="joinForm" class="join-form">
      <h2>Register as Member</h2>

      <div class="form-row">
        <input type="text" id="firstName" placeholder="First Name">
        <input type="text" id="lastName" placeholder="Last Name">
      </div>

      <input type="email" id="email" placeholder="Email Address">
      <input type="text" id="studentId" placeholder="Student ID">
      <input type="text" id="course" placeholder="Course">
      <input type="text" id="interests" placeholder="Interests">

      <button type="submit">Submit Registration</button>

      <p id="formMessage"></p>
    </form>
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