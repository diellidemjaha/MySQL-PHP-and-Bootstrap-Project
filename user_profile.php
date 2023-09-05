<html>
    <head>
        <title>Freelancer Profile</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
    <body>
    <?php
    include("header.php");
    
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = $user_id";


        // Database configuration
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "test-api-php";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

        $result = $conn->query($sql);
    
        // Check if a user with the specified ID exists
        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();
        } else {
            echo "User not found.";
            exit;
        }
    } else {
        echo "User ID not provided.";
        exit;
    }
    ?>

        <section class="vh-100" style="background-color: #eee;">
          <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-md-12 col-xl-4">
        
                <div class="card" style="border-radius: 15px;">
                  <div class="card-body text-center">
                    <div class="mt-3 mb-4">
                      <img src="<?php echo $user_data['profile_pic_path']; ?>"
                        class="rounded-circle img-fluid" style="width: 100px;" />
                    </div>
                    <h4 class="mb-2"><?php echo $user_data['name']; ?></h4>
                    <p class="text-muted mb-4">@<?php echo $user_data['professional_field']; ?><span class="mx-2">|</span> <a
                        href="<?php echo $user_data['website_link']; ?>"><?php echo $user_data['website_link']; ?></a></p>
                    <div class="mb-4 pb-2">
                    </div>
                    <button type="button" class="btn btn-primary btn-rounded btn-lg"><a class="link-light" href="mailto:<?php echo $user_data['email']; ?>">
                      Contact Now</a>
                    </button>
                    <div class="text-center mt-5 mb-2">
                        <?php
                        ?>
                        <a class="text-center" href="<?php echo $user_data['linkedin_link']; ?>"><p>LinkedIn Account</p></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </body>
</html>