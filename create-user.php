<html>
    <head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    </head>

    <body>
        <?php 
        include("header.php");
        ?>
       
       <h2 class="m-3">Create User</h2>
       <form action="create-user-process.php" method="POST">
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">Name Lastname</label>
             <input type="text" class="form-control" id="exampleInputNameLastname1" name="nameAndLastName" placeholder="Type Name and Lastname here...">    
           </div>
  <div class="mb-3 m-5">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Type E-mail here...">
  </div>
  <button type="submit" class="btn btn-primary m-5">Submit</button>
</form>

    </body>
</html>