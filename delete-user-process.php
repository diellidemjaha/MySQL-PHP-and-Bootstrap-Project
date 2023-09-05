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
        $database = "test-api-php";
        
        try {
            // Create a PDO connection
            $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            
            // Prepare the SQL statement with a placeholder
            $sql = "DELETE FROM users WHERE id=?";
            $stmt = $pdo->prepare($sql);
            
            // Bind the user ID parameter
            $stmt->bindParam(1, $delete_id, PDO::PARAM_INT);
            
            // Execute the prepared statement
            if ($stmt->execute()) {
                // Redirect back to the index.php with a success message
                header("Location: index.php?success=true");
                exit();
            } else {
                echo "Error deleting user.";
            }
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    }
}
?>
