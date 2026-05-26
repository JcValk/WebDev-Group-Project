<?php
session_start();
require_once 'phpfiles/layout.php';

$profileLink = 'phpfiles/member_profilepage.php';
if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
    $profileLink = 'phpfiles/admin_profilepage.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | Home</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="cursor-circle" id="cursorCircle"></div>

<?php render_header('home', true); ?>

<main>

  <section class="hero">
    <div class="hero-left">
      <p class="eyebrow">UNIVERSITY CLUB — STUDENT COMMUNITY</p>

      <h1>
        <span class="move-word">Connect.</span>
        <span class="move-word delay-one">Build.</span>
        <span class="outline move-word delay-two">Belong.</span>
      </h1>

      <p class="hero-text">
        A student-run community for networking, learning, socialising, and building real university experiences beyond the classroom.
      </p>

      <div class="hero-buttons">
        <?php if (isset($_SESSION['username'])): ?>
          <a href="<?= $profileLink ?>" class="btn primary">View Profile</a>
        <?php else: ?>
          <a href="phpfiles/membership.php" class="btn primary">Join the Club →</a>
        <?php endif; ?>
        <a href="phpfiles/events.php" class="btn secondary">View Events</a>
      </div>
    </div>

    <div class="hero-right">
      <div class="stat-box">
        <h2>10+</h2>
        <p>Active Members</p>
      </div>

      <div class="stat-box">
        <h2>4</h2>
        <p>Main Activities</p>
      </div>

      <div class="stat-box">
        <h2>2026</h2>
        <p>Club Year</p>
      </div>
    </div>
  </section>

  <section class="ticker">
    <div class="ticker-track">
      <span>NETWORK</span>
      <span>LEARN</span>
      <span>SOCIALISE</span>
      <span>LAUNCH</span>
      <span>WORKSHOPS</span>
      <span>EVENTS</span>
      <span>NETWORK</span>
      <span>LEARN</span>
      <span>SOCIALISE</span>
      <span>LAUNCH</span>
      <span>WORKSHOPS</span>
      <span>EVENTS</span>
    </div>
  </section>

  <section class="section-intro">
    <p class="eyebrow">WHY JOIN?</p>
    <h2>Everything you need to <span>level up</span></h2>
  </section>

  <section class="feature-grid">

    <div class="feature-card">
      <p class="number">01</p>
      <h3>Network</h3>
      <p>Meet students from different courses and build useful connections across campus.</p>
    </div>

    <div class="feature-card">
      <p class="number">02</p>
      <h3>Learn</h3>
      <p>Join workshops and activities that help you improve practical and professional skills.</p>
    </div>

    <div class="feature-card">
      <p class="number">03</p>
      <h3>Socialise</h3>
      <p>Take part in student-friendly events, meet new people, and enjoy university life.</p>
    </div>

    <div class="feature-card">
      <p class="number">04</p>
      <h3>Launch</h3>
      <p>Build confidence, leadership experience, and a stronger student portfolio.</p>
    </div>

  </section>

</main>

<?php render_footer(); ?>

<script src="backend/java.js"></script>

</body>
</html>
