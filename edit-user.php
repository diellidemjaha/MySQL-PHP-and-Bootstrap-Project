<?php
session_start(); ?>
<html>
    <head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    </head>

    <body>
        <?php 
        include("header.php");

        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];

// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "usermanagementdb";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user information from the database based on $user_id
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user_data = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}

// Close the database connection
$conn->close();
}
?>

<div class="card w-75 mx-auto mt-5">
  <div class="card-body">
    <h5 class="card-title">Edit Freelancer</h5>
    <p class="card-text">Edit the Freelancer in the form below.</p>  
       <form action="edit-user-process.php" method="POST" enctype="multipart/form-data">
       <input type="hidden" name="_method" value="PUT">
       <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">Edit Name Lastname</label>
             <input type="text" class="form-control" id="exampleInputNameLastname1" name="name" value="<?php echo $user_data['name']; ?>">    
           </div>
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">Edit Phone Number</label>
             <input type="text" class="form-control" id="exampleInputNameLastname1" name="phone_number" value="<?php echo $user_data['phone_number']; ?>">    
           </div>
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">Edit LinkedIn</label>
             <input type="text" class="form-control" id="exampleInputNameLastname1" name="linkedin_link" value="<?php echo $user_data['linkedin_link']; ?>">    
           </div>
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">Edit Professional Field</label>
             <input type="text" class="form-control" id="exampleInputNameLastname1" name="professional_field" value="<?php echo $user_data['professional_field']; ?>">    
           </div>
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">Edit Your Website</label>
             <input type="text" class="form-control" id="exampleInputNameLastname1" name="website_link" value="<?php echo $user_data['website_link']; ?>">    
           </div>
          <div class="mb-3 m-5">
            <label for="exampleInputEmail1" class="form-label">Edit Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $user_data['email']; ?>">
          </div>
          <div class="mb-3 m-5">
          <label for="customFile"" class="form-label">Edit Profile Picture</label>
          <input type="file" class="form-control" id="customFile" name="profile_pic"> 
          </div>
  <button type="submit" class="btn btn-primary m-5 float-end">Update Freelancer</button>
</form>
  </div></div>

    </body>
</html>
