<?php
// Start session
session_start();
// Connect layout file
require_once 'layout.php';
// Connect database
require_once 'db.php';

// Get announcements
$sql = "SELECT announcement_subject, announcement_detail, announcement_date
        FROM announcements
        ORDER BY announcement_date DESC";
$announcements = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Page settings -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Page title -->
  <title>UniClub | Announcements</title>
  <!-- Connect CSS -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<!-- Custom cursor circle -->
<div class="cursor-circle" id="cursorCircle"></div>

<?php 
// Show header
render_header('announcements'); ?>
<main>

   <!-- Page heading -->
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

   <!-- Announcement cards -->
  <section class="announcement-grid">

    <?php if ($announcements && $announcements->num_rows > 0): ?>
      <!-- Show all announcements -->
      <?php while ($announcement = $announcements->fetch_assoc()): ?>
        <div class="announcement-card" data-category="announcement">
          <!-- Announcement date -->
          <p class="date"><?= htmlspecialchars(date('d M', strtotime($announcement['announcement_date']))) ?></p>
           <!-- Announcement title -->
          <h2><?= htmlspecialchars($announcement['announcement_subject']) ?></h2>
          <!-- Announcement details -->
          <p><?= htmlspecialchars($announcement['announcement_detail']) ?></p>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <!-- No announcement message -->
      <div class="announcement-card">
        <h2>No announcements yet.</h2>
        <p>Check back soon for club updates.</p>
      </div>
    <?php endif; ?>

  </section>

</main>

<?php 
// Show footer
render_footer(); ?>

<?php 
// Close database
$conn->close(); ?>

<!-- Connect JavaScript -->
<script src="../backend/java.js"></script>

</body>
</html>
