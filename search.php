<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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


if (isset($_GET['search'])) {
    $filtersearchdata = $_GET['search'];
    $sql = "SELECT * FROM users WHERE CONCAT(name, email) LIKE '%$filtersearchdata%'";

    $result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

$results = array(); // Initialize an array to store results

while ($row = $result->fetch_assoc()) {
    $results[] = $row; // Store each result in the array
}

// Return the results as JSON
echo json_encode($results); }