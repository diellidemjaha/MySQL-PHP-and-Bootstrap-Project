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
    $database = "test-api-php";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Check if user exists
    $checkUserExistsQuery = mysqli_query($conn, "SELECT * FROM users WHERE name = '$nameAndLastName'");
    $checkEmailExistsQuery = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($checkUserExistsQuery) > 0 || mysqli_num_rows($checkEmailExistsQuery) == 1) {
    echo "<div class=\"fixed-top\"><div class=\"alert alert-danger\" role=\"alert\">
    <b>Sorry, this user Already Exists!</b>
    </div></div>";
    exit();
    } else {
    // Insert user data into the database
    $sql = "INSERT INTO users (name, email, linkedin_link, profile_pic_path, phone_number, professional_field, website_link) VALUES ('$nameAndLastName', '$email', '$linkedInLink', '$profilePicPath', '$phoneNumber', '$professionalField', '$websiteLink')";

    if ($conn->query($sql) === TRUE) {

        echo "<div class=\"fixed-top\"><div class=\"alert alert-success\" role=\"alert\">
    <b>Freelancer Created!</b>
    </div></div>";
        // Redirect back to the index.php with a success message
        header("Location: index.php?success=true");
        exit();
    } else {    
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
    }}
?>
