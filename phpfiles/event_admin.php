<?php
session_start();
require_once 'layout.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$role = '';
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
}

if ($role !== 'Admin') {
    header("Location: member_profilepage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | Admin</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="cursor-circle" id="cursorCircle"></div>

<?php render_header('event_admin'); ?>
<main>

<section class="event-table">

<?php

require 'db.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['create_event'])) {
    $eventName = '';
    $eventDate = '';
    $venue = '';
    $eventDetails = '';

    if (isset($_POST['event_name'])) {
        $eventName = $_POST['event_name'];
    }

    if (isset($_POST['event_date'])) {
        $eventDate = $_POST['event_date'];
    }

    if (isset($_POST['venue'])) {
        $venue = $_POST['venue'];
    }

    if (isset($_POST['event_details'])) {
        $eventDetails = $_POST['event_details'];
    }

    $stmt = $conn->prepare(
        "INSERT INTO events
        (event_name, event_date, venue, event_details)
        VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssss",
        $eventName,
        $eventDate,
        $venue,
        $eventDetails
    );

    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();

}

$sql = "SELECT event_name, event_date, venue, event_details
        FROM events
        WHERE YEAR(event_date) = YEAR(CURDATE())
        ORDER BY event_date ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table>";
    echo "<tr>
            <th>Event Name</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Details</th>
          </tr>";

    while ($event = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . htmlspecialchars($event['event_name']) . "</td>";
        echo "<td>" . $event['event_date'] . "</td>";
        echo "<td>" . htmlspecialchars($event['venue']) . "</td>";
        echo "<td>" . htmlspecialchars($event['event_details']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "<p>No events found for this year.</p>";
}


$conn->close();

?>

</section>
<?php
if (isset($message)) {
    echo "<p>$message</p>";
}
?>
<section class="create-event">
<h3>Create an event</h3><br></br>
<form id="create-event" method="POST" action="">
<p>Event name</p>
<input type="text" name="event_name" required>
<p>Event date</p>
<input type="date" name="event_date" required>
<p>Venue</p>
<input type="text" name="venue" required>
<p>Event details</p>
<input type="text" name="event_details" required><br></br>
<button type="submit" name="create_event">Create Event</button>
</form>
</section>

</main>

<?php render_footer(); ?>

<script src="../backend/java.js"></script>

</body>
</html>
