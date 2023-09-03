<?php
include("create-user.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $nameAndLastName = $_POST["nameAndLastName"];
    $email = $_POST["email"];

    // Database configuration
    $host = "localhost";
    $username = "diellidemjaha";
    $password = "33-Tea-rks@";
    $database = "phpdb";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user data into the database
    $sql = "INSERT INTO users (name, email) VALUES ('$nameAndLastName', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the index.php with a success message
        header("Location: index.php?success=true");
    } else {    
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
