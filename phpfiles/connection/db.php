<?php
// Database connection for XAMPP/Apache - localhost

$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is empty
$database = "uniclub";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");

?>
