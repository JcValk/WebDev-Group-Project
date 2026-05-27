<?php
// Start session
session_start();
// Connect layout file
require_once 'layout.php';

// Check login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get role
$role = '';
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
}

// Admin only
if ($role !== 'Admin') {
    header("Location: member_profilepage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page settings -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Page title -->
  <title>UniClub | Admin</title>
   <!-- Connect CSS -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<!-- Custom cursor circle -->
<div class="cursor-circle" id="cursorCircle"></div>

<?php 
// Show header 
render_header('event_admin'); ?>
<main>

<section class="event-table">

<?php
// Connect database
require 'db.php';

// Show database errors
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create event
if (isset($_POST['create_event'])) {
    $eventName = '';
    $eventDate = '';
    $venue = '';
    $eventDetails = '';

    // Get event name
    if (isset($_POST['event_name'])) {
        $eventName = $_POST['event_name'];
    }

    // Get event date
    if (isset($_POST['event_date'])) {
        $eventDate = $_POST['event_date'];
    }

     // Get venue
    if (isset($_POST['venue'])) {
        $venue = $_POST['venue'];
    }

    // Get event details
    if (isset($_POST['event_details'])) {
        $eventDetails = $_POST['event_details'];
    }

    // Insert event
    $stmt = $conn->prepare(
        "INSERT INTO events
        (event_name, event_date, venue, event_details)
        VALUES (?, ?, ?, ?)"
    );

    // Add form values
    $stmt->bind_param(
        "ssss",
        $eventName,
        $eventDate,
        $venue,
        $eventDetails
    );

    // Run insert
    $stmt->execute();
    $stmt->close();

    // Refresh page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();

}

// Get this year events
$sql = "SELECT event_name, event_date, venue, event_details
        FROM events
        WHERE YEAR(event_date) = YEAR(CURDATE())
        ORDER BY event_date ASC";

$result = $conn->query($sql);

// Show events
if ($result->num_rows > 0) {

    echo "<table>";
    echo "<tr>
            <th>Event Name</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Details</th>
          </tr>";

    // Display each event
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

// Close database
$conn->close();

?>

</section>
<?php
// Show message
if (isset($message)) {
    echo "<p>$message</p>";
}
?>

<!-- Create event form -->
<section class="create-event">
<h3>Create an event</h3><br></br>
<form id="create-event" method="POST" action="">
<!-- Event name -->
<p>Event name</p>
<input type="text" name="event_name" required>
<!-- Event date -->
<p>Event date</p>
<input type="date" name="event_date" required>
<!-- Venue -->
<p>Venue</p>
<input type="text" name="venue" required>
<!-- Event details -->
<p>Event details</p>
<input type="text" name="event_details" required><br></br>
<!-- Submit button -->
<button type="submit" name="create_event">Create Event</button>
</form>
</section>

</main>

<?php 
//Show footer 
render_footer(); ?>

<!-- Connect JavaScript -->
<script src="../backend/java.js"></script>

</body>
</html>
