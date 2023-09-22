<?php
// Your database configuration
include("conection.php");

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Password to be hashed
$rawPassword = "123456";

// Hash the password
$hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

// Insert the user into the admins table
$sql = "INSERT INTO admins (username, password) VALUES ('admin', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
    echo "User 'admin' with hashed password has been created.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>