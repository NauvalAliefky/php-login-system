<?php
session_destroy(); // Destroy all data registered to a session.
session_unset(); // Free all session variables.
header("Location: ../views/login.php"); // Redirect to the login page.
exit; // Terminate the script.
?>
