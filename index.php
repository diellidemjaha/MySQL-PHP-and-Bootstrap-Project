
<html>
    <head>
        <title>
            PHP API Users Test
        </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    </head>
    <body>
<?php 
include("header.php");

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
  // Check if the 'search' query parameter is set
  if (isset($_GET['search'])) {
    $filtersearchdata = $_GET['search'];
    $sql = "SELECT * FROM users WHERE CONCAT(name, email) LIKE '%$filtersearchdata%'";
} else {
    // If 'search' is not set, fetch all users
    $sql = "SELECT * FROM users";
}
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) { 

?>
<h2 class="m-3">Users Listed</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#id</th>
      <th scope="col">Name Lastname</th>
      <th scope="col">E-mail</th>
      <th scope="col">Edit user</th>
    </tr>
  </thead>
  <tbody>

    <?php 
    //fetch the results from Database into the Bootstrap Table data cells
    while ($row = $result->fetch_assoc()) { ?>
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><form action="edit-user-process.php" method="POST"><input type="hidden" name="_method" value="PUT"><input type="hidden" name="user_id" value="<?php echo $row['id'] ?>"><a href="http://localhost/php-api-frontend/edit-user.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a></form><form action="delete-user-process.php" method="POST"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>"><button type="submit" class="btn btn-danger">Delete</div></form>
      </td>
    </tr>
    <?php }}?>
  
  </tbody>
</table>
<!-- -->
</body>
</html>
