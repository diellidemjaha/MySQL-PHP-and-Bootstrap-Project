<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['_method']) && $_POST['_method'] === "PUT") {
        $user_id = $_POST["user_id"];
        $name = $_POST["name"];
        $phoneNumber = $_POST["phone_number"];
        $linkedInLink = $_POST["linkedin_link"];
        $professionalField = $_POST["professional_field"];
        $websiteLink = $_POST["website_link"];
        $email = $_POST["email"];
        
        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
            echo "File upload condition met.";
            $uploadDir = 'profile_pics/';
            $timestamp = time();
            
            $tempName = $_FILES['profile_pic']['tmp_name'];
            $originalName = $_FILES['profile_pic']['name'];
            $file_extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $unique_filename = "updated_" . $timestamp . "." . $file_extension;
            $filePath = $uploadDir . $unique_filename;
            
            if (move_uploaded_file($tempName, $filePath)) {
                $profilePicPath = $filePath;

            } else {
                echo "Error uploading profile picture.";
                exit;
            }
        } else {
            // If no file was uploaded, retain the existing profile pic path
            $profilePicPath = ''; // You can modify this based on your database schema 
        }
                
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "usermanagementdb";
                
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                    
                    // Prepare the SQL statement with placeholders
                    $sql = "UPDATE users SET name=?, phone_number=?, linkedin_link=?, professional_field=?, website_link=?, profile_pic_path=?, email=? WHERE user_id=?";
                    $stmt = $pdo->prepare($sql);
                    
                    // Bind parameters to the placeholders
                    $stmt->bindParam(1, $name);
                    $stmt->bindParam(2, $phoneNumber);
                    $stmt->bindParam(3, $linkedInLink);
                    $stmt->bindParam(4, $professionalField);
                    $stmt->bindParam(5, $websiteLink);
                    $stmt->bindParam(6, $profilePicPath);
                    $stmt->bindParam(7, $email);
                    $stmt->bindParam(8, $user_id);
                    
                    if ($stmt->execute()) {
                        if (isset($_GET['search'])) {
                            header("Location: index.php?search=" . urlencode($_GET['search']));
                            exit;
                        } else {
                            header("Location: index.php");
                            exit;
                        }
                    } else {
                        echo "Error updating user.";
                    }
                } catch (PDOException $e) {
                    echo "Database Error: " . $e->getMessage();
                }
            } else {
                echo "Error uploading profile picture.";
            }
        }
?>
