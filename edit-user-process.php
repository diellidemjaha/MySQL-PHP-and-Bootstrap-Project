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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['_method']) && $_POST['_method'] === "PUT") {
        // Retrieve form data
        $user_id = $_POST["user_id"];
        $name = $_POST["name"];
        $phoneNumber = $_POST["phone_number"];
        $linkedInLink = $_POST["linkedin_link"];
        $professionalField = $_POST["professional_field"];
        $websiteLink = $_POST["website_link"];
        $email = $_POST["email"];
        
        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        
            echo "File upload condition met.";
            // Specify the upload directory for profile picture

        $uploadDir = 'profile_pics/';
        $timestamp = time();
        
        $tempName = $_FILES['profile_pic']['tmp_name'];
        $originalName = $_FILES['profile_pic']['name'];
        $file_extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $unique_filename = "updated_" . $timestamp . "." . $file_extension;
        $filePath = $uploadDir . $unique_filename;
        
        // Move the uploaded file to the desired location
        if (move_uploaded_file($tempName, $filePath)) {
            // Save the file path in the database for the user
            $profilePicPath = $filePath;
            
            // Insert or update the user's profile_pic_path in the users table
            $sql = "UPDATE users SET name='$name', phone_number='$phoneNumber', linkedin_link='$linkedInLink', professional_field='$professionalField', website_link='$websiteLink', profile_pic_path='$profilePicPath', email='$email' WHERE id='$user_id'";
            
            // Execute the SQL query
            if ($conn->query($sql) === TRUE) {
                // Check if the 'search' query parameter is set
                if (isset($_GET['search'])) {
                    // Redirect back to index.php with the search query parameter
                    header("Location: index.php?search=" . urlencode($_GET['search']));
                    exit; // Important to stop executing further code
                } else {
                    // Redirect back to index.php without search query parameter
                    header("Location: index.php");
                    exit; // Important to stop executing further code
                }
            } else {
                echo "Error updating user: " . $conn->error;
            }
        } else {
            echo "Error uploading profile picture.";
        }
    }
}
}

// Close the database connection
$conn->close();
?>
