<!DOCTYPE html>
<head>
  <title>
    Search Freelancers
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body>
  <?php
  include("header.php");

include("conection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (isset($_GET['search'])) {
    $filtersearchdata = $_GET['search'];
    $sql = "SELECT * FROM users WHERE CONCAT(name, email) LIKE '%$filtersearchdata%'";

    $result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
} ?>
<div class="card w-75 mx-auto mt-5">
<div class="card-body">
  <h5 class="card-title">Freelancer Search</h5>
  <p class="card-text">Search for Freelancers or Edit them below.</p>
    
    <?php if ($result->num_rows > 0) {
    // Output the search results in an HTML table
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Name Lastname</th>';
    echo '<th>Professional Field</th>';
    echo '<th>E-mail</th>';
    echo '<th>Edit user</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td><a href="user_profile.php?user_id=' . $row['user_id'] . '">' . $row['name'] . '</a></td>';
        echo '<td>' . $row['professional_field'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td><a href="edit-user.php?id=' . $row['user_id'] . '" class="btn btn-primary">Edit</a></td>';
        echo '<td>';
        echo '<form action="delete-user-process.php" method="POST">';
        echo '<input type="hidden" name="_method" value="DELETE">';
        echo '<input type="hidden" name="user_id" value="' . $row['user_id'] . '">';
        echo '<button type="submit" class="btn btn-danger">Delete</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
        
    }
    
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
} else {
    echo '<p>No results found.</p>';
}
} ?>