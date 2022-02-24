<?php
include('cauth.php');

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
                <h5 class="fs-2 companytitle" style="margin-left: 2%;">JobQualifier</h5>
            </div>
            
            <ul class="nav nav-pills align-items-center" style="margin-right:2%">
                <li class="nav-item" style="margin-right:15px;">
                    <?php echo $_SESSION['login_name'];?>
                </li>
                <li class="nav-item">
                    <a href="logout.php">
                        <input type="button" value="Logout"  class="btn btn-primary">
                    </a>
                </li>
            </ul>
        </header>
        <div class="sidebar">
            <a class="active" href="candidatedashboard.php">Home</a>
            <a href="candidate/editProfile.php">Profile Edit</a>
            <a href="candidate/selectapplication.php">Apply for job</a>
            <a href="candidate/statusview.php">Status of Application</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="content">
            <section id="section-jumbotron" class="jumbotron jumbotron-fluid d-flex justify-content-center align-items-center" style="height:70vh">
                <div class="container text-center">
                    <h1 class="display-1 text-info companytitle"><b>JOB QUALIFIER</b></h1>
                    <p class="display-4 d-none d-sm-block">Welcome <?php echo $_SESSION['login_name'];?></p>
                    <p class="lead">Your portal to opportunities</p>
                    <p class="lead">We make it easier to hire and get hired</p>
                </div>
            </section>
        </div>
    </body>
</html>