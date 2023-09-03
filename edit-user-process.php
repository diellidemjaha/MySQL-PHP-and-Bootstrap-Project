<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "phpdb";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
if (isset($_POST['_method']) && $_POST['_method'] === "PUT") {
    // Retrieve form data
    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
}

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id='$user_id'";

    
 // Execute the SQL query
 if ($conn->query($sql) === TRUE) {
    // Check if the 'search' query parameter is set
    if (isset($_GET['search'])) {
        // Redirect back to index.php with the search query parameter
        header("Location: index.php?search=" . urlencode($_GET['search']));
    } else {
        // Redirect back to index.php without search query parameter
        header("Location: index.php");
    }
} else {
    echo "Error updating user: " . $conn->error;
}
}

// Close the database connection
$conn->close();
?>
