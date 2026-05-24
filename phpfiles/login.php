<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT username, password, role FROM entitlements WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        $stmt->bind_result($db_username, $db_password, $role);
        $stmt->fetch();

        if ($password == $db_password) {

            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $role;
            echo "<script>alert('Login successful! Welcome, " . htmlspecialchars($role) . ".');</script>";
            switch ($role) {
                case 'Admin':
                    header("Location: admin_profilepage.php");
                    break;

                case 'Member':
                    header("Location: member_profilepage.php");
                    break;

                default:
                    header("Location: login.php");
                    break;
            }

            exit();

        } else {
            echo "<script>alert('Invalid password. Please try again.'); window.location.href='login.php';</script>";
        }

    } else {
        echo "<script>alert('No account found with that Member ID. Please try again.'); window.location.href='login.php';</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniClub | Log In</title>
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
    <a href="membership.php" class="active">Membership</a>
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

        <a href="login.php" class="active">Log in</a>

    <?php endif; ?>

  </div>
</nav>
<main>

<section class="login">
<h2>Log In</h2><br></br>
<form id="loginForm" method="POST" action="login.php">
<input id="username" placeholder="Member ID" type="number" name="username" required><br></br>
<input id="password" placeholder="Password" type="password" name="password" required><br></br>
<button type="submit">Log In</button>
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

<script src="../../backend/java.js"></script>

</body>
</html>