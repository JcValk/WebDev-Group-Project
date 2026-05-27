<?php
// Start session 
session_start();
// Connect layout file
require_once 'layout.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Website settings -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Page title --> 
  <title>UniClub | About</title>
  <!-- Connect CSS File -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<!-- Custom cursor circle -->
<div class="cursor-circle" id="cursorCircle"></div>

<?php // Show header 
render_header('about'); ?>
<main>

<!-- About title section --> 
  <section class="page-header">
    <!-- Small heading --> 
    <p class="eyebrow">ABOUT UNICLUB</p>
    <!-- Main title --> 
    <h1>
      A space for students to
      <span>connect and grow.</span>
    </h1>
    <!-- Description --> 
    <p>
      UniClub supports students through workshops, networking, social activities,
      and opportunities to build confidence outside the classroom.
    </p>
  </section>
  <!-- About cards--> 

  <section class="about-grid">
    <!-- Purpose card --> 

    <div class="about-card">
      <h2>Purpose</h2>
      <p>We help students build meaningful connections, practical skills, and a stronger university experience.</p>
    </div>

    <!-- Community card --> 
    <div class="about-card">
      <h2>Community</h2>
      <p>UniClub welcomes students from different courses, interests, and backgrounds.</p>
    </div>  

    <!-- Energy card --> 
    <div class="about-card">
      <h2>Energy</h2>
      <p>Our activities are designed to feel active, useful, and student-friendly.</p>
    </div>

    <!-- Growth card --> 
    <div class="about-card">
      <h2>Growth</h2>
      <p>Members can develop leadership, communication, teamwork, and event participation skills.</p>
    </div>

  </section>

</main>

<?php 
//Show footer
render_footer(); ?>

<!-- Connect JavaScript --> 
<script src="../backend/java.js"></script>

</body>
</html>
