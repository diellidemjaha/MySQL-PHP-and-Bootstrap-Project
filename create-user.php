<?php

session_start();

// Check if the user is authenticated
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php"); // Redirect to the login page if not authenticated
    exit(); }
  ?>

<html>
    <head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    </head>

    <body>
        <?php 
        include("header.php");
        ?>
       

       <div class="card w-75 mx-auto mt-5">
  <div class="card-body">
    <h5 class="card-title">Create a Freelancer</h5>
    <p class="card-text">Create a Freelancer in the form below.</p>
       <form action="create-user-process.php" method="POST" enctype="multipart/form-data">
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">Name Lastname</label>
             <input type="text" class="form-control" id="exampleInputNameLastname1" name="nameAndLastName" placeholder="Type Name and Lastname here...">    
           </div>
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">Phone Number</label>
             <input type="text" class="form-control" id="InputPhoneNumber" name="phone_number" placeholder="Type Phone Number here...">    
           </div>
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">LinkedIn</label>
             <input type="text" class="form-control" id="InputLinkedInLink" name="linkedin_link" placeholder="https://www.linkedin.com/...">    
           </div>
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">Professional Field</label>
             <input type="text" class="form-control" id="InputLinkedInLink" name="professional_field" placeholder="Type your Expertise here...">    
           </div>
           <div class="mb-3 m-5">
             <label for="exampleInputNameLastname1" class="form-label">Your Website</label>
             <input type="text" class="form-control" id="InputLinkedInLink" name="website_link" placeholder="https://www...">    
           </div>
        <div class="mb-3 m-5">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Type E-mail here...">
        </div>
        <div class="mb-3 m-5">
    <label for="customFile"" class="form-label">Profile Picture</label>
    <input type="file" class="form-control" id="customFile" name="profile_pic"> 
        </div>
    <button type="submit" class="btn btn-primary m-5 float-end">Create Freelancer</button>
        </form>
  </div></div>

    </body>
</html>