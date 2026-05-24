<?php session_start(); ?>

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

<nav class="navbar">
  <div class="logo">
    <span></span>
    UniClub
  </div>

  <div class="nav-links">
    <a href="../index.php">Home</a>
    <a href="about.php">About</a>
    <a href="membership.php">Membership</a>
    <a href="announcements.php">Announcements</a>
    <a href="events.php">Events</a>
    <?php if (isset($_SESSION['username'])): ?>

        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="admin_profilepage.php">Profile</a>
        <?php else: ?>
            <a href="member_profilepage.php">Profile</a>
        <?php endif; ?>

        <a href="logout.php">Logout</a>

    <?php else: ?>

        <a href="login.php">Log in</a>

    <?php endif; ?>

  </div>
</nav>
<main>

<section class="announce-table">

<?php

require 'db.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['create_announcement'])) {

    $stmt = $conn->prepare(
        "INSERT INTO announcements
        (announcement_subject, announcement_detail)
        VALUES (?, ?)"
    );

    $stmt->bind_param(
        "ss",
        $_POST['announcement_subject'],
        $_POST['announcement_detail']
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

<footer class="footer">
  <div class="footer-logo">
    <span></span>
    UniClub
  </div>

  <div class="footer-links">
    <a href="../index.php">Home</a>
    <a href="about.php">About</a>
    <a href="membership.php">Membership</a>
    <a href="announcements.php">Announcements</a>
    <a href="events.php">Events</a>
  </div>

  <p>© 2026 UniClub. All rights reserved.</p>
</footer>

<script src="java.js"></script>

</body>
</html>