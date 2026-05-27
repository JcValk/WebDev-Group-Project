<?php
// Start session
session_start();
// Connect layout file
require_once 'layout.php';
// Connect database
require_once 'db.php';

// Get events
$sql = "SELECT event_name, event_date, venue, event_details
        FROM events
        ORDER BY event_date ASC";
$events = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Page settings -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Page title -->
  <title>UniClub | Events</title>
   <!-- Connect CSS -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<!-- Cursor circle -->
<div class="cursor-circle" id="cursorCircle"></div>

<?php 
// Show header
render_header('events'); ?>

<main>

 <!-- Page heading -->
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

  <!-- Search box -->
  <section class="event-tools">
    <input type="text" id="eventSearch" placeholder="Search events...">
  </section>

  <!-- Event cards -->
  <section class="event-grid">

    <?php if ($events && $events->num_rows > 0): ?>
      <!-- Show all events -->
      <?php while ($event = $events->fetch_assoc()): ?>
        <div class="event-card" data-category="event">
          <!-- Venue -->
          <p class="event-type"><?= htmlspecialchars($event['venue']) ?></p>
          <!-- Event name -->
          <h2><?= htmlspecialchars($event['event_name']) ?></h2>
          <!-- Event date -->
          <p class="event-date"><?= htmlspecialchars(date('d M Y', strtotime($event['event_date']))) ?></p>
          <!-- Event details -->
          <p><?= htmlspecialchars($event['event_details']) ?></p>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <!-- No event message -->
      <div class="event-card">
        <h2>No events yet.</h2>
        <p>Check back soon for upcoming UniClub activities.</p>
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
