<?php
session_start();
require_once 'layout.php';
require_once 'db.php';

$sql = "SELECT event_name, event_date, venue, event_details
        FROM events
        ORDER BY event_date ASC";
$events = $conn->query($sql);
?>

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

<?php render_header('events'); ?>
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
  </section>

  <section class="event-grid">

    <?php if ($events && $events->num_rows > 0): ?>
      <?php while ($event = $events->fetch_assoc()): ?>
        <div class="event-card" data-category="event">
          <p class="event-type"><?= htmlspecialchars($event['venue']) ?></p>
          <h2><?= htmlspecialchars($event['event_name']) ?></h2>
          <p class="event-date"><?= htmlspecialchars(date('d M Y', strtotime($event['event_date']))) ?></p>
          <p><?= htmlspecialchars($event['event_details']) ?></p>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="event-card">
        <h2>No events yet.</h2>
        <p>Check back soon for upcoming UniClub activities.</p>
      </div>
    <?php endif; ?>

  </section>


</main>

<?php render_footer(); ?>

<?php $conn->close(); ?>

<script src="../backend/java.js"></script>

</body>
</html>
