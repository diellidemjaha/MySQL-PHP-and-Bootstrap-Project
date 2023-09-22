<?php
include("conection.php");
session_start();

// Check if the user is authenticated
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
  header("Location: login.php"); // Redirect to the login page if not authenticated
  exit();
}
?>
<html>

<head>
  <title>
    Freelance Network
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body>
  <?php
  include("header.php");

  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

  ?>


    <div class="card w-75 mx-auto mt-5">
      <div class="card-body">
        <h5 class="card-title">Users Listed</h5>
        <p class="card-text">Search for Users or Edit them below.</p>

        <table class="table" id="resultsTable">
          <thead>
            <tr>
              <!-- <th scope="col">#id</th> -->
              <th scope="col">Name Lastname</th>
              <th scope="col">Professional Field</th>
              <th scope="col">E-mail</th>
              <th scope="col">Edit user</th>
            </tr>
          </thead>
          <tbody id="searchResults">

            <?php
            //fetch the results from Database into the Bootstrap Table data cells
            while ($row = $result->fetch_assoc()) { ?>
              <tr>
                <!-- <th scope="row"></th> -->
                <td><a href="user_profile.php?user_id=<?php echo $row['user_id']; ?>"><?php echo $row['name']; ?></a></td>
                <td><?php echo $row['professional_field']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                  <form action="edit-user-process.php" method="POST"><input type="hidden" name="_method" value="PUT"><input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>"><a href="/user-management-php/edit-user.php?id=<?php echo $row['user_id'] ?>" class="btn btn-primary">Edit</a></form>
                  <form action="delete-user-process.php" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
    <button type="submit" class="btn btn-danger">Delete</button>
</form>

                </td>
              </tr>
            <?php }
          } else {
            ?>
            <tr>
              <td>
                <h4 class="m-4 p-2">No Freelancers found.</h4>
              </td>
            </tr>
          <?php
          } ?>

          </tbody>
        </table>

      </div>
    </div>
</body>

</html>
