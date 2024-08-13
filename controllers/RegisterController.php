<?php

session_start(); // Start or resume the current session.

require_once '../models/UserModel.php'; // Include the UserModel class file.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name']; // Get the user's name from the POST request.
    $gender = $_POST['gender']; // Get the user's gender from the POST request.
    $date_of_birth = $_POST['date_of_birth']; // Get the user's date of birth from the POST request.
    $email = $_POST['email']; // Get the user's email from the POST request.
    $phone_number = $_POST['phone_number']; // Get the user's phone number from the POST request.
    $password = $_POST['password']; // Get the user's password from the POST request.
    $confirm_password = $_POST['confirm_password']; // Get the confirmation password from the POST request.

    if ($password != $confirm_password) { // Check if the passwords match.
        echo "Konfirmasi password tidak sesuai"; // Display an error if passwords do not match.
        exit; // Terminate the script.
    }

    $userModel = new UserModel(); // Create a new instance of the UserModel class.

    $userModel->register($name, $gender, $date_of_birth, $email, $phone_number, $password); // Register the user.

    $_SESSION['id'] = $userModel->login($email)['id']; // Log the user in by setting the session ID.

    $userModel->closeConnection(); // Close the database connection.
    
    header("Location: ../views/home.php"); // Redirect to the home page.
    exit();
}
?>
