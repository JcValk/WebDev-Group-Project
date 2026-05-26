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

<?php render_header('admin_announcements'); ?>
<main>

<section class="announce-table">

<?php

require 'db.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['create_announcement'])) {
    $announcementSubject = '';
    $announcementDetail = '';

    if (isset($_POST['announcement_subject'])) {
        $announcementSubject = $_POST['announcement_subject'];
    }

    if (isset($_POST['announcement_detail'])) {
        $announcementDetail = $_POST['announcement_detail'];
    }

    $stmt = $conn->prepare(
        "INSERT INTO announcements
        (announcement_subject, announcement_detail, announcement_date)
        VALUES (?, ?, CURDATE())"
    );

    $stmt->bind_param(
        "ss",
        $announcementSubject,
        $announcementDetail
    );

    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();

}

$sql = "SELECT announcement_subject, announcement_detail, announcement_date
        FROM announcements
        WHERE MONTH(announcement_date) = MONTH(CURDATE())
        AND YEAR(announcement_date) = YEAR(CURDATE())
        ORDER BY announcement_date ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table class='announce-table'>";
    echo "<tr>
            <th>Subject</th>
            <th>Announcement</th>
            <th>Date</th>
          </tr>";

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


$conn->close();

?>

</section>


<?php
if (isset($message)) {
    echo "<p>$message</p>";
}
?>


<section class="create_announcement">
<h3>Create an announcement</h3><br></br>
<form id="create_announcement" method="POST" action="">
<p>Subject</p>
<input type="text" name="announcement_subject" required>
<p>Announcement</p>
<input type="text" name="announcement_detail" required>
<button type="submit" name="create_announcement">Create Announcement</button>
</form>
</section>

</main>

<?php render_footer(); ?>

<script src="../backend/java.js"></script>

</body>
</html>
