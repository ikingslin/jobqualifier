<?php
    include('../aauth.php');
    $conn = mysqli_connect("localhost","root","","jobqualifier");
    if(!$conn)
    {
        die("Connection to DB failed with : ".mysqli_connect_error());
    }
    if(isset($_POST['submit']))
    {
        $sql="select * from ques";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==0)
            $id='Q0001';
        else
        {
            $sql="select questionid from ques order by questionid desc limit 1";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_row($result);
            $id=$row[0];
            $id++;
        }
        $ques = $_POST['ques'];
        $sql = "INSERT INTO `ques`(`questionid`, `question`) VALUES ('$id','$ques')";
        $insert = mysqli_query($conn,$sql);
        if(!$insert)
            echo '<script>alert("Cannot add the question")</script>';
        else
        {
            header("Location:questions.php");
            echo '<script>alert("Question added successfully")</script>';
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
            <a href="roles.php">Adding Roles</a>
            <a class="active" href="questions.php">Adding Questions</a>
            <a href="rolequestions.php">Question Update</a>
            <a href="candidatelist.php">Candidate Grading</a>
            <a href="candidatefilter.php">Candidate Filtering</a>
            <a href="candidatefinal.php">Qualified Candidates</a>
            <a href="../logout.php">Logout</a>
        </div>
        <div class="content">
            <div class="container">
                <form action="questions.php" method="post">
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="ques">Question</label>
                            <input type="text" name="ques" id="ques" class="form-control form-control-lg" required/>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <center>
                            <input type="submit" value="    Add    " name="submit" class="btn btn-primary">
                            <input type="reset" value="    Reset   " class="btn btn-primary">
                        </center>
                    </div>
                </form>
            </div>
        </div>          
    </body>
</html>