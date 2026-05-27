<?php
// Start session
session_start();
// Remove session data
session_destroy();
// Go back to homepage
header('Location: ../index.php');
// Stop code
exit;
?>
