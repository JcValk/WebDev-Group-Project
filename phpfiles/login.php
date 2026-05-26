<?php
session_start();
require 'db.php';
require_once 'layout.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = '';
    $password = '';

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    $stmt = $conn->prepare("SELECT student_id, password, role FROM member WHERE student_id = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        $stmt->bind_result($db_username, $db_password, $role);
        $stmt->fetch();

        $passwordIsValid = password_verify($password, $db_password);

        if (!$passwordIsValid && $password == $db_password) {
            $passwordIsValid = true;
        }

        if ($passwordIsValid) {

            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $role;
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

<?php render_header('login'); ?>
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

<?php render_footer(); ?>

<script src="../backend/java.js"></script>

</body>
</html>
