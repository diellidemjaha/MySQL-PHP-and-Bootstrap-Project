<?php
include("conection.php");
session_start();

// Check if the user is authenticated
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php"); // Redirect to the login page if not authenticated
    exit(); }
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
          <td><a href="user_profile.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
          <td><?php echo $row['professional_field']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><form action="edit-user-process.php" method="POST"><input type="hidden" name="_method" value="PUT"><input type="hidden" name="user_id" value="<?php echo $row['id'] ?>"><a href="http://localhost/php-api-frontend/edit-user.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a></form><form action="delete-user-process.php" method="POST"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>"><button type="submit" class="btn btn-danger">Delete</div></form>
          </td>
        </tr>
        <?php }} else {
          ?>
        <tr><td><h4 class="m-4 p-2">No Freelancers found.</h4></td></tr>
          <?php
          }?>
      
      </tbody>
    </table>

  </div>
</div>

<script>
  // Wait for the document to be ready
$(document).ready(function() {
    // Add an event listener for the form submission
    $('form').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        var searchValue = $('#searchInput').val().trim(); // Get the search input value

        // Make an AJAX request to fetch search results
        $.ajax({
            type: 'GET',
            url: 'search.php', // Replace with the correct URL to your search.php file
            data: { search: searchValue },
            success: function(results) {
                console.log(results);
                displayResults(results);
            },
            dataType: 'json'
        });
    });

    // Function to display search results
    function displayResults(results) {
         var searchResults = $('#searchResults'); // Get the results container
         searchResults.empty(); // Clear previous results
         
         if (results.length > 0) {
            // Populate the table with search results
            $.each(results, function(index, row) {
               var tableRow = $('<tr>');
               tableRow.append($('<td>').html('<a href="user_profile.php?id=' + row.id + '">' + row.name + '</a>'));
               tableRow.append($('<td>').text(row.professional_field));
               tableRow.append($('<td>').text(row.email));
               tableRow.append($('<td>').html('<form action="edit-user-process.php" method="POST"><input type="hidden" name="_method" value="PUT"><input type="hidden" name="user_id" value="' + row.id + '"><a href="http://localhost/php-api-frontend/edit-user.php?id=' + row.id + '" class="btn btn-primary">Edit</a></form><form action="delete-user-process.php" method="POST"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="delete_id" value="' + row.id + '"><button type="submit" class="btn btn-danger">Delete</div></form>'));

               searchResults.append(tableRow);
               console.log(tableRow);
            });
         } else {
            // Handle case when no results are found
            searchResults.html('<tr><td colspan="4"><h4 class="m-4 p-2">No Freelancers found.</h4></td></tr>');
         }
      }
   });
</script>

</body>
</html>
