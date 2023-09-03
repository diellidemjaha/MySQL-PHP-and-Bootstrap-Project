<?php
header("Content-Type: application/json");

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

// Handle POST request to create a user
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data["name"];
    $email = $data["email"];
    
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "User created successfully"]);
    } else {
        echo json_encode(["error" => "Error creating user: " . $conn->error]);
    }
}

// Handle GET request to retrieve all users
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        echo json_encode($users);
    } else {
        echo json_encode(["message" => "No users found"]);
    }
}

// Handle PUT request to update a user by ID
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data["id"];
    $name = $data["name"];
    $email = $data["email"];
    
    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating user: " . $conn->error]);
    }
}

// Handle DELETE request to delete a user by ID
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $id = $_GET["id"]; // Retrieve the user ID from the query parameter

    // Perform the delete operation
    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "User deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error deleting user: " . $conn->error]);
    }
}


// Close the database connection
$conn->close();
?>
