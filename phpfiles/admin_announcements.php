<?php
// Start session
session_start();
// Connect layout file
require_once 'layout.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get user role
$role = '';
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
}

// Allow admin only
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
  <!-- Page settings -->
  <title>UniClub | Admin</title>
  <!-- Connect CSS -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<!-- Custom cursur circle -->
<div class="cursor-circle" id="cursorCircle"></div>

<?php 
// Show header 
render_header('admin_announcements'); ?>
<main>

<section class="announce-table">

<?php
// Connect database
require 'db.php';

// Show database errors
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create announcement
if (isset($_POST['create_announcement'])) {
    $announcementSubject = '';
    $announcementDetail = '';

    // Get subject
    if (isset($_POST['announcement_subject'])) {
        $announcementSubject = $_POST['announcement_subject'];
    }

    // Get announcement detail
    if (isset($_POST['announcement_detail'])) {
        $announcementDetail = $_POST['announcement_detail'];
    }

    // Insert announcement
    $stmt = $conn->prepare(
        "INSERT INTO announcements
        (announcement_subject, announcement_detail, announcement_date)
        VALUES (?, ?, CURDATE())"
    );

    // Add form data
    $stmt->bind_param(
        "ss",
        $announcementSubject,
        $announcementDetail
    );

    // Run query
    $stmt->execute();
    $stmt->close();

    // Refresh page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();

}

// Get current month announcements
$sql = "SELECT announcement_subject, announcement_detail, announcement_date
        FROM announcements
        WHERE MONTH(announcement_date) = MONTH(CURDATE())
        AND YEAR(announcement_date) = YEAR(CURDATE())
        ORDER BY announcement_date ASC";

$result = $conn->query($sql);

// Display announcements
if ($result->num_rows > 0) {

    echo "<table class='announce-table'>";
    echo "<tr>
            <th>Subject</th>
            <th>Announcement</th>
            <th>Date</th>
          </tr>";

    // Show each announcement
    while ($event = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . htmlspecialchars($event['announcement_subject']) . "</td>";
        echo "<td>" . htmlspecialchars($event['announcement_detail']) . "</td>";
        echo "<td>" . $event['announcement_date'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "<p>No announcements found for this year.</p>";
}

// Close database
$conn->close();

?>

</section>


<?php
// Show message if available
if (isset($message)) {
    echo "<p>$message</p>";
}
?>

<!-- Create announcement form -->
<section class="create_announcement">
<h3>Create an announcement</h3><br></br>
<form id="create_announcement" method="POST" action="">
<!-- Subject input -->
<p>Subject</p>
<input type="text" name="announcement_subject" required>
<!-- Announcement input --> 
<p>Announcement</p>
<input type="text" name="announcement_detail" required>
<!-- Submit button --> 
<button type="submit" name="create_announcement">Create Announcement</button>
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
