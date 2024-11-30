<?php
session_start();

// Destroy the session to log out the user
session_unset();  // Remove all session variables
session_destroy(); // Destroy the session itself

// Redirect to the admin login page
header("Location: login-staff.php");
exit;
?>

