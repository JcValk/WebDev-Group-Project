<?php
session_start();
require_once 'layout.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | About</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="cursor-circle" id="cursorCircle"></div>

<?php render_header('about'); ?>
<main>

  <section class="page-header">
    <p class="eyebrow">ABOUT UNICLUB</p>

    <h1>
      A space for students to
      <span>connect and grow.</span>
    </h1>

    <p>
      UniClub supports students through workshops, networking, social activities,
      and opportunities to build confidence outside the classroom.
    </p>
  </section>

  <section class="about-grid">

    <div class="about-card">
      <h2>Purpose</h2>
      <p>We help students build meaningful connections, practical skills, and a stronger university experience.</p>
    </div>

    <div class="about-card">
      <h2>Community</h2>
      <p>UniClub welcomes students from different courses, interests, and backgrounds.</p>
    </div>

    <div class="about-card">
      <h2>Energy</h2>
      <p>Our activities are designed to feel active, useful, and student-friendly.</p>
    </div>

    <div class="about-card">
      <h2>Growth</h2>
      <p>Members can develop leadership, communication, teamwork, and event participation skills.</p>
    </div>

  </section>

</main>

<?php render_footer(); ?>

<script src="../backend/java.js"></script>

</body>
</html>
