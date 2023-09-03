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

// Replace these lines with actual database queries to retrieve user data
$host = "localhost";
$username = "diellidemjaha";
$password = "33-Tea-rks@";
$database = "phpdb";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user information from the database based on $user_id
$sql = "SELECT * FROM users WHERE id = $user_id";
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
       <h2 class="m-3">Edit User</h2>   
       <form action="edit-user-process.php" method="POST">
       <input type="hidden" name="_method" value="PUT">
           <div class="mb-3 m-5">
           <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
             <label for="exampleInputNameLastname1" class="form-label">Name Lastname</label>
             <input type="text" class="form-control" id="exampleInputNameLastname1" name="name" value="<?php echo $user_data['name']; ?>">    
           </div>
  <div class="mb-3 m-5">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $user_data['email']; ?>">
  </div>
  <button type="submit" class="btn btn-primary m-5">Submit</button>
</form>

    </body>
</html>