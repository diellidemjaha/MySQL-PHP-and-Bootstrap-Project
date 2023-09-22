<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nameAndLastName = $_POST["nameAndLastName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone_number"];
    $linkedInLink = $_POST["linkedin_link"];
    $professionalField = $_POST["professional_field"];
    $websiteLink = $_POST["website_link"];
    
    // Specify the upload directory for profile picture
    $uploadDir = 'profile_pics/';
    $timestamp = time();
    
    // Create the directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    // Check if a file was uploaded
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $tempName = $_FILES['profile_pic']['tmp_name'];
        $originalName = $_FILES['profile_pic']['name'];
        $file_extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $unique_filename = "user_" . $timestamp . "." . $file_extension;
        $filePath = $uploadDir . $unique_filename;
        
        // Move the uploaded file to the desired location
        if (move_uploaded_file($tempName, $filePath)) {
            // Save the file path in the database for the user
            $profilePicPath = $filePath;
        }
    }
    
    // Database configuration
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "usermanagementdb";
    
    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        
        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO users (name, email, linkedin_link, profile_pic_path, phone_number, professional_field, website_link) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        
        // Bind parameters to the placeholders
        $stmt->bindParam(1, $nameAndLastName);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $linkedInLink);
        $stmt->bindParam(4, $profilePicPath);
        $stmt->bindParam(5, $phoneNumber);
        $stmt->bindParam(6, $professionalField);
        $stmt->bindParam(7, $websiteLink);
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "<div class=\"fixed-top\"><div class=\"alert alert-success\" role=\"alert\">
                <b>Freelancer Created!</b>
                </div></div>";
            // Redirect back to the index.php with a success message
            header("Location: index.php?success=true");
            exit();
        } else {
            echo "Error inserting user.";
        }
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
}
?>
