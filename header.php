<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="#">Freelance Network</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/php-api-frontend/">Freelancers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/php-api-frontend/create-user.php">Register a Freelancer</a>
        </li>
      </ul>
      <form class="d-flex" action="index.php" method="GET">
        <input class="form-control me-2" type="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" name="search" placeholder="Search">
        <button class="btn btn-outline-warning" type="submit">Search</button>
      </form>
      <a class="nav-link text-white p-2 m-1" href="logout.php">Logout</a>
    </div>
  </div>
</nav>