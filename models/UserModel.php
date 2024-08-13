<?php
require_once '../config/connection.php'; // Include the database connection file.

class UserModel
{
    private $conn; // Private variable to hold the database connection.

    public function __construct()
    {
        $this->conn = openConnection(); // Open the database connection when an instance of this class is created.
    }

    // Method to register a new user
    public function register($name, $gender, $date_of_birth, $email, $phone_number, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the user's password for secure storage.
        $sql = "INSERT INTO users (name, gender, date_of_birth, email, phone_number, password) VALUES (?, ?, ?, ?, ?, ?)"; // SQL query to insert a new user.
        $stmt = $this->conn->prepare($sql); // Prepare the SQL statement.
        $stmt->bind_param("ssssss", $name, $gender, $date_of_birth, $email, $phone_number, $hashed_password); // Bind the parameters to the SQL query.

        if ($stmt->execute()) { // Execute the query.
            header("Location: ../views/count.php"); // Redirect to the count page (this seems to be a placeholder or a mistake).
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error; // Display an error if the query fails.
        }
    }

    // Method to log in a user
    public function login($email)
    {
        $sql = "SELECT * FROM users WHERE email=?"; // SQL query to select a user by email.
        $stmt = $this->conn->prepare($sql); // Prepare the SQL statement.
        $stmt->bind_param("s", $email); // Bind the email parameter to the SQL query.
        $stmt->execute(); // Execute the query.
        $result = $stmt->get_result(); // Get the result of the query.

        if ($result->num_rows == 1) { // Check if exactly one user was found.
            $user = $result->fetch_assoc(); // Fetch the user's data.
            return $user; // Return the user data.
        } else {
            return null; // Return null if no user was found.
        }
    }

    // Method to get a user by their ID
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id=?"; // SQL query to select a user by ID.
        $stmt = $this->conn->prepare($sql); // Prepare the SQL statement.
        $stmt->bind_param("i", $id); // Bind the ID parameter to the SQL query.
        $stmt->execute(); // Execute the query.
        $result = $stmt->get_result(); // Get the result of the query.

        if ($result->num_rows == 1) { // Check if exactly one user was found.
            $user = $result->fetch_assoc(); // Fetch the user's data.
            return $user; // Return the user data.
        } else {
            return null; // Return null if no user was found.
        }
    }

    // Method to close the database connection
    public function closeConnection()
    {
        $this->conn->close(); // Close the database connection.
    }
}
?>
