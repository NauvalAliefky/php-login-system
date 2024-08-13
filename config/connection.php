<?php

// Function to open a connection to the database
function openConnection()
{
    $hostname = "localhost"; // Database server hostname.
    $username = "root"; // Database username.
    $password = ""; // Database password.
    $database = "php_login_system"; // The database to connect to.

    // Establish a connection to the MySQL database
    $conn = new mysqli($hostname, $username, $password, $database);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // If failed, terminate the script with an error message.
    }

    return $conn; // Return the database connection object.
}
?>
