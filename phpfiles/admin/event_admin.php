<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | Admin</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<div class="cursor-circle" id="cursorCircle"></div>

<nav class="navbar">
  <div class="logo">
    <span></span>
    UniClub
  </div>

  <div class="nav-links">
  <div class="nav-links">
    <a href="profile.php" class="active">Membership</a>
    <a href="announcements.html">Announcements</a>
    <a href="event_admin.php">Events</a>
  </div>
  </div>
</nav>

<main>

<section class="event-table">

<?php

$conn = new mysqli("localhost", "root", "", "uniclub");

if (isset($_POST['create_event'])) {

    $stmt = $conn->prepare(
        "INSERT INTO events
        (event_name, event_date, venue, event_details)
        VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssss",
        $_POST['event_name'],
        $_POST['event_date'],
        $_POST['venue'],
        $_POST['event_details']
    );

    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();

}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


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

<footer class="footer">
  <div class="footer-logo">
    <span></span>
    UniClub
  </div>

  <div class="footer-links">
    <a href="index.html">Home</a>
    <a href="about.html">About</a>
    <a href="membership.html">Membership</a>
    <a href="announcements.html">Announcements</a>
    <a href="events.html">Events</a>
  </div>

  <p>© 2026 UniClub. All rights reserved.</p>
</footer>

<script src="java.js"></script>

</body>
</html>