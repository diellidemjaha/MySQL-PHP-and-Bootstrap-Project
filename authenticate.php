<?php

session_start();
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "test-api-php";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Get user input
    $username = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // Query the database to check if the provided credentials are valid
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // Check if a row with the given username exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedHashedPassword = $row["password"];

        // Verify the entered password against the stored hashed password
        if (password_verify($enteredPassword, $storedHashedPassword)) {
            
            // Password is correct; authentication successful
            $_SESSION["authenticated"] = true;
            header("Location: index.php");
            exit();
        }
    }
}

// Authentication failed
header("Location: login.php?error=1"); 
exit();

// Close the database connection
$conn->close();
?>
