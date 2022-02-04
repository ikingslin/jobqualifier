<?php
session_start();
session_abort();
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
        <link rel="stylesheet" href="assets/index.css">
        <link rel="stylesheet" href="assets/sidebar.css">
    </head>
    <body>
        <header class="d-flex flex-wrap justify-content-left py-2 border-bottom bg-light">
            <div class="d-flex align-items-center  me-md-auto">
                <img src="assets/images/logo.webp" alt="No Image" id="logo" style="margin-left: 2%;" class="rounded">
                <h5 class="fs-2" id="companytitle" style="margin-left: 2%;">JobQualifier</h5>
            </div>
            
            <ul class="nav nav-pills align-items-center" style="margin-right:2%">
                <li class="nav-item" style="margin-right:15px;">
                    <?php echo $_SESSION['login_name'];?>
                </li>
                <li class="nav-item">
                    <a href="index.php">
                        <input type="button" value="Logout"  class="btn btn-primary">
                    </a>
                </li>
            </ul>
        </header>
        <div class="sidebar">
            <a class="active" href="#home">Home</a>
            <a href="candidate/editProfile.php">Profile Edit</a>
            <a href="#contact">Apply for job</a>
            <a href="#about">Status of Application</a>
            <a href="#about">Logout</a>
        </div>

        <!-- Page content -->
        <div class="content">
        ..
        </div>
        <!--<div class="container-fluid">
            <div class="d-flex">
                <div class="container-fluid border-end" style ="max-width:fit-content">
                    <ul class="list-group" style = "text-decoration:none;">
                        <li class="list-group-item"><a href="#">Home</a></li>
                        <li class="list-group-item"><a href="candidate/editProfile.php" >Profile Edit</a></li>
                        <li class="list-group-item"><a href="candidate/selectapplication.php" >Application</a></li>
                        <li class="list-group-item"><a href="index.php">Logout</a></li>
                    </ul>
                </div>
                <div class="container-fluid embed-responsive" style = "height:100%;">
                    <div class = "wrapper" style = "height:100vh;"> -->
                        <!-- <iframe id="content" name="maincontent" frameborder="0" width="100%" height="100%" class="responsive-iframe">

                        </iframe> -->
                        <!-- <iframe src="https://psgtech.edu/" scrolling="no" id="content"  name="maincontent" class="responsive-iframe"  style="width:100%;height:inherit;"></iframe> -->
                    <!-- </div>
                </div>
            </div>
        </div>
    </body>
</html> -->  