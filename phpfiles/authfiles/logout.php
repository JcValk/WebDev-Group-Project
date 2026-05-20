<?php
session_start();
session_destroy();
header('Location: /WebDev-Group-Project/index.php');
exit;
?>
