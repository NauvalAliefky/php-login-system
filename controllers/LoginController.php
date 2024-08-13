<?php
session_start(); // Start a new session or resume the existing session.
require_once '../models/UserModel.php'; // Include the UserModel class file.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email']; // Get the email from the POST request.
    $password = $_POST['password']; // Get the password from the POST request.

    $userModel = new UserModel(); // Create a new instance of the UserModel class.
    $user = $userModel->login($email); // Attempt to retrieve the user by email.

    if ($user) { // If the user is found
        if (password_verify($password, $user['password'])) { // Verify the provided password against the stored hash.
            $_SESSION['id'] = $user['id']; // Store the user ID in the session.
            $_SESSION['password'] = $user['password']; // Store the user password in the session (not recommended for security reasons).
            header("Location: ../views/home.php"); // Redirect to the home page.
            exit();
        } else {
            $_SESSION['password_error'] = "Password yang Anda masukkan salah"; // Set an error message for incorrect password.
            header("Location: ../views/login.php"); // Redirect back to the login page.
            exit();
        }
    } else {
        $_SESSION['email_error'] = "Email tidak terdaftar"; // Set an error message if the email is not registered.

        $userModel->closeConnection(); // Close the database connection.
        
        header("Location: ../views/login.php"); // Redirect back to the login page.
        exit();
    }
}
?>
