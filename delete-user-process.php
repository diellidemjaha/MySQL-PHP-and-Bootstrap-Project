<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if a delete request is submitted
    if (isset($_POST['_method']) && $_POST['_method'] === "DELETE" && isset($_POST['delete_id'])) {
        // Get the user ID to be deleted
        $delete_id = $_POST["delete_id"];

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

        // Delete the user from the database
        $sql = "DELETE FROM users WHERE id=$delete_id";

        if ($conn->query($sql) === TRUE) {
            // Redirect back to the index.php with a success message
            header("Location: index.php?success=true");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
}
?>
