<?php 
  if(!isset($_SESSION)) 
  { 
    session_start(); 
  }
  $conn = mysqli_connect("localhost","root","","jobqualifier");
  if(!$conn)
  {
    die("Connection to DB failed with : ".mysqli_connect_error());
  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../assets/index.css">
        <link rel="stylesheet" href="../assets/sidebar.css">
    </head>
    <body>
        <header class="d-flex flex-wrap justify-content-left py-2 border-bottom bg-light">
            <div class="d-flex align-items-center  me-md-auto">
                <img src="../assets/images/logo.webp" alt="No Image" id="logo" style="margin-left: 2%;" class="rounded">
                <h5 class="fs-2 companytitle" style="margin-left: 2%;">JobQualifier</h5>
            </div>
            
            <ul class="nav nav-pills align-items-center" style="margin-right:2%">
                <li class="nav-item" style="margin-right:15px;">
                    <?php echo $_SESSION['login_name'];?>
                </li>
                <li class="nav-item">
                    <a href="../index.php">
                        <input type="button" value="Logout"  class="btn btn-primary">
                    </a>
                </li>
            </ul>
        </header>
        <div class="sidebar">
            <a href="../candidatedashboard.php">Home</a>
            <a class="active" href="editProfile.php">Profile Edit</a>
            <a href="selectapplication.php">Apply for job</a>
            <a href="#about">Status of Application</a>
            <a href="../index.php">Logout</a>
        </div>

        <div class="content">
          <div class="container">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
              Available Applications
            </button>
            <ul class="dropdown-menu" name = "available">
              <li><a class="dropdown-item" href="#">Link 1</a></li>
            </ul>
          </div>
</div>
</body>
</html>