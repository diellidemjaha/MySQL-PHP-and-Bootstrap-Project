<?php include("header.php");
session_start();
?>
<html>
<head>
    <title>Welcome to Freelancers</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<?php
    // Display an error message if the "error" parameter is set
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo "<div class=\"fixed-top\"><div class=\"alert alert-danger\" role=\"alert\">
        <b>Authentication Failed! Wrong username or password.</b>
      </div></div>";
    }
    ?>


<div class="card w-75 mx-auto mt-5 p-3">
  <div class="card-body">
    <h5 class="card-title">Please Log in</h5>
    <p class="card-text">to search for Users or Edit them.</p>
    <form class="m-1 p-5" action="authenticate.php" method="POST">
      <!-- Email input -->
      <div class="form-outline mb-4">
        <input type="username" id="form2Example1" class="form-control" name="username" />
        <label class="form-label" for="form2Example1">Username</label>
      </div>
    
      <!-- Password input -->
      <div class="form-outline mb-4">
        <input type="password" id="form2Example2" class="form-control" name="password" />
        <label class="form-label" for="form2Example2">Password</label>
      </div>
    
      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4" value="Login">Log in</button>
      </div>
    </form>
</div></div>
</body>
</html>