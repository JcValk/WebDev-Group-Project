<?php
// Start session
session_start();
// Connect database
require 'db.php';
// Connect layout file
require_once 'layout.php';

// Check form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Default inputs
    $username = '';
    $password = '';

    // Get username
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }

    // Get password
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    // Find member account
    $stmt = $conn->prepare("SELECT student_id, password, role FROM member WHERE student_id = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check account exists
    if ($stmt->num_rows > 0) {

        // Get account details
        $stmt->bind_result($db_username, $db_password, $role);
        $stmt->fetch();

        // Check hashed password
        $passwordIsValid = password_verify($password, $db_password);

        // Check plain password
        if (!$passwordIsValid && $password == $db_password) {
            $passwordIsValid = true;
        }
        // Login success
        if ($passwordIsValid) {
            // Save session data
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $role;
             // Redirect by role
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
            // Wrong password
            echo "<script>alert('Invalid password. Please try again.'); window.location.href='login.php';</script>";
        }

    } else {
        // No account found
        echo "<script>alert('No account found with that Member ID. Please try again.'); window.location.href='login.php';</script>";
    }

    // Close statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
<!-- Page settings -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Page title -->
  <title>UniClub | Log In</title>
  <!-- Connect CSS -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<!-- Cursor circle -->
<div class="cursor-circle" id="cursorCircle"></div>

<?php 
// Show header
render_header('login'); ?>

<main>

<!-- Login form section -->
<section class="login">
<h2>Log In</h2><br></br>
<form id="loginForm" method="POST" action="login.php">
<!-- Member ID input -->
<input id="username" placeholder="Member ID" type="number" name="username" required><br></br>
<!-- Password input -->
<input id="password" placeholder="Password" type="password" name="password" required><br></br>
<!-- Submit button -->
<button type="submit">Log In</button>
</form>
</section>

</main>

<?php 
// Show footer
render_footer(); ?>

<!-- Connect JavaScript -->
<script src="../backend/java.js"></script>

</body>
</html>
