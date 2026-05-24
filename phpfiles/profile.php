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
    <a href="profile.php" class="active">Membership</a>
    <a href="announcements.php">Announcements</a>
    <a href="event_admin.php">Events</a>
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


<section class="profile">

<h2>Member Profile</h2>

<?php
require 'db.php';

$sql = "SELECT student_id,
               first_name,
               last_name,
               course,
               batch,
               email,
               contact_no,
               interests,
               member_status,
               date_joined
        FROM member";

$result = $conn->query($sql);
?>

<?php
if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
?>

<table class="member-table">
    <tr>
        <th>Student ID</th>
        <td><?= htmlspecialchars($row['student_id']) ?></td>
    </tr>

    <tr>
        <th>First Name</th>
        <td><?= htmlspecialchars($row['first_name']) ?></td>
    </tr>

    <tr>
        <th>Last Name</th>
        <td><?= htmlspecialchars($row['last_name']) ?></td>
    </tr>

    <tr>
        <th>Course</th>
        <td><?= htmlspecialchars($row['course']) ?></td>
    </tr>

    <tr>
        <th>Batch</th>
        <td><?= htmlspecialchars($row['batch']) ?></td>
    </tr>

    <tr>
        <th>Email</th>
        <td><?= htmlspecialchars($row['email']) ?></td>
    </tr>

    <tr>
        <th>Contact No</th>
        <td><?= htmlspecialchars($row['contact_no']) ?></td>
    </tr>

    <tr>
        <th>Interests</th>
        <td><?= htmlspecialchars($row['interests']) ?></td>
    </tr>

    <tr>
        <th>Member Status</th>
        <td><?= htmlspecialchars($row['member_status']) ?></td>
    </tr>

    <tr>
        <th>Date Joined</th>
        <td><?= htmlspecialchars($row['date_joined']) ?></td>
    </tr>
</table>

<?php
    }
} else {
    echo "<p>No members found.</p>";
}

$conn->close();
?>

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