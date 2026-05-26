<?php
session_start();
require_once 'layout.php';
require_once 'db.php';

$sql = "SELECT announcement_subject, announcement_detail, announcement_date
        FROM announcements
        ORDER BY announcement_date DESC";
$announcements = $conn->query($sql);
?>

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

<?php render_header('announcements'); ?>
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

  <section class="announcement-grid">

    <?php if ($announcements && $announcements->num_rows > 0): ?>
      <?php while ($announcement = $announcements->fetch_assoc()): ?>
        <div class="announcement-card" data-category="announcement">
          <p class="date"><?= htmlspecialchars(date('d M', strtotime($announcement['announcement_date']))) ?></p>
          <h2><?= htmlspecialchars($announcement['announcement_subject']) ?></h2>
          <p><?= htmlspecialchars($announcement['announcement_detail']) ?></p>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="announcement-card">
        <h2>No announcements yet.</h2>
        <p>Check back soon for club updates.</p>
      </div>
    <?php endif; ?>

  </section>

</main>

<?php render_footer(); ?>

<?php $conn->close(); ?>

<script src="../backend/java.js"></script>

</body>
</html>
