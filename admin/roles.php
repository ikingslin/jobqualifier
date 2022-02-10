<?php
    $conn = mysqli_connect("localhost","root","","jobqualifier");
    if(!$conn)
    {
        die("Connection to DB failed with : ".mysqli_connect_error());
    }
    if(isset($_POST['submit']))
    {
        $id= $_POST['roleid'];
        $role = $_POST['role'];
        $require = $_POST['require'];
        $qualify = $_POST['qualify'];
        $ldate = $_POST['ldate'];
        $sql = " select * from roles where roleid='".$id."'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==0)
        {
            $sql = "insert into roles values('$id','$role','$require','$qualify','$ldate')";
            $insert = mysqli_query($conn,$sql);
            if(!$insert)
                echo '<script>alert("Cannot add the rule")</script>';
            else
            {
                echo '<script>alert("Role added successfully")</script>';
                header("Location:../dashboard.php");
            }
        }
        else
        {
            echo '<script>alert("Role Id already exists")</script>';
        }
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Adding Roles</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../assets/index.css">
        <link rel="stylesheet" href="../assets/sidebar.css">
        <link rel="stylesheet" href="../assets/formlabel.css">
    </head>
    <body>
        <header class="d-flex flex-wrap justify-content-left py-2 border-bottom bg-light">
            <div class="d-flex align-items-center  me-md-auto">
                <img src="../assets/images/logo.webp" alt="No Image" id="logo" style="margin-left: 2%;" class="rounded">
                <h5 class="fs-2 companytitle" style="margin-left: 2%;">JobQualifier</h5>
            </div>
            <ul class="nav nav-pills align-items-center" style="margin-right:2%">
                <li class="nav-item" style="margin-right:15px;">
                    Admin
                </li>
                <li class="nav-item">
                    <a href="../logout.php">
                        <input type="button" value="Logout"  class="btn btn-primary">
                    </a>
                </li>
            </ul>
        </header>
        <div class="sidebar">
            <a href="../home.php">Home</a>
            <a class="active" href="roles.php">Adding Roles</a>
            <a href="">Question Update</a>
            <a href="#list">Candidate Grading</a>
            <a href="#filter">Candidate Filtering</a>
            <a href="../logout.php">Logout</a>
        </div>
        <div class="content">
            <div class="container">
                <form action="roles.php" method="post">
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="roleid">Role ID</label>
                            <input type="text" name="roleid" id="roleid" pattern="R[0-9]{5)" class="form-control form-control-lg" required/>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <label for="role">Role</label>
                            <input type="text" name="role" id="role" class="form-control form-control-lg" required/>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <label for="require">Requirements</label>
                            <input type="text" name="require" id="require" class="form-control form-control-lg" required/>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <label for="qualify">Qualification</label>
                            <input type="text" name="qualify" id="qualify" class="form-control form-control-lg" required/>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <label for="role">Last Date to Apply</label>
                            <input type="date" name="ldate" id="ldate" class="form-control form-control-lg" required/>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <center>
                            <input type="submit" value="Add" name="submit" class="btn btn-primary">
                            <input type="reset" value="Reset" class="btn btn-primary">
                        </center>
                    </div>
                </form>
            </div>
        </div>          
    </body>
</html>