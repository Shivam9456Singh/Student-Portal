<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other page
header("Location: index.php"); // Change this to the desired page
exit();
?>
