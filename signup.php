<?php
    $conn = mysqli_connect("localhost","root","","jobqualifier");
    if(!$conn)
    {
        die("Connection to DB failed with : ".mysqli_connect_error());
    }
    if(isset($_POST['submit']))
    {
        $sql="select * from candidate";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==0)
            $id='C0001';
        else
        {
            $sql="select id from candidate order by id desc limit 1";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_row($result);
            $id=$row[0];
            $id++;
        }
        $name = $_POST['cname'];
        $pass = $_POST['cpass'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $contact = $_POST['contact'];
        $pincode = $_POST['pincode'];
        $per10 = $_POST['per10'];
        $per12 = $_POST['per12'];
        $ugcgpa = $_POST['ugcgpa'];
        $pgcgpa = $_POST['pgcgpa'];
        $email = $_POST['email'];
        $work = $_POST['work'];
        $projects = $_POST['projects'];
        $intern = $_POST['intern'];
        $interests = $_POST['interests'];
        $resume = $_POST['resume'];
        $sql = " select * from candidate where contact='".$contact."' and email='".$email."'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==0)
        {
            $sql = "insert into candidate values('$name','$pass','$address','$gender','$dob','$contact','$pincode','$per10','$per12','$ugcgpa','$pgcgpa','$email','$work','$projects','$intern','$interests','$resume','$id')";
            $insert = mysqli_query($conn,$sql);
            if(!$insert)
                echo '<script>alert("Cannot Create Account")</script>';
            else
            {
                echo '<script>alert("Account created successfully")</script>';
                header("Location:index.php");
            }
        }
        else
        {
            echo '<script>alert("You already have an account")</script>';
        }
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="h/ttps://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/index.css">
</head>
<body>
    <header class="d-flex justify-content-left align-items-center py-2 border-bottom bg-light">
        <img src="assets/images/logo.png" alt="No Image" id="logo" style="margin-left: 2%;">
        <h4 class="fs-4" id="companytitle" style="margin-left: 2%;">JobQualifier</h4>
    </header><br>
    <div class="container">
        <form action="signup.php" method="post">
            <div class="row">
                <div class="col">
                    <label for="cname">Name</label>
                    <input type="text" name="cname" id="cname" class="form-control" required/>
                </div>
                <div class="col">
                    <label for="cpass">Password</label>
                    <input type="password" name="cpass" id="cpass" class="form-control" required/>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label for="address">Address</label>
                    <input type="textarea" name="address" id="address" class="form-control" required/>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" required>
                        <option selected>Select</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                </div>
                <div class="col">
                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" id="dob-" class="form-control" required/>
                </div>
                <div class="col">
                    <label for="contact">Contact Number</label>
                    <input type="tel" name="contact" id="contact" pattern="[0-9]{10}" class="form-control" required/>
                </div>
                <div class="col">
                    <label for="pincode">Pincode</label>
                    <input type="tel" name="pincode" id="pincode" pattern="[0-9]{6}" class="form-control" required/>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label for="per10">10th Percentage</label>
                    <input type="text" name="per10" id="per10" min="0.0" max="100.0" class="form-control" required/>
                </div>
                <div class="col">
                    <label for="per12">12th Percentage</label>
                    <input type="text" name="per12" id="per12" min="0.0" max="100.0" class="form-control" required/>
                </div>
                <div class="col">
                    <label for="ugcgpa">UG CGPA</label>
                    <input type="text" name="ugcgpa" id="ugcgpa" min="0.0" max="10.0" class="form-control" required/>
                </div>
                <div class="col">
                    <label for="pgcgpa">PG CGPA</label>
                    <input type="text" name="pgcgpa" id="pgcgpa" min="0.0" max="10.0" class="form-control" required/>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required/> 
                </div>
                <div class="col">
                    <label for="work">Work Experience</label>
                    <input type="text" name="work" id="work" class="form-control" required/>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label for="projects">Projects</label>
                    <input type="text" name="projects" id="projects" class="form-control" required/>
                </div>
                <div class="col">
                    <label for="intern">Internship</label>
                    <input type="text" name="intern" id="intern" class="form-control" required/> 
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label for="interests">Area of interests</label>
                    <input type="text" name="interests" id="interests" class="form-control" required/>
                </div>
                <div class="col">
                    <label for="resume">Resume</label>
                    <input type="file" name="resume" id="resume" class="form-control" required/>
                </div>
            </div><br>
            <div class="form-group">
                <center>
                    <input type="submit" value="Create Account" name="submit" class="btn btn-primary">
                    <input type="reset" value="Reset" class="btn btn-primary">
                    <input type="button" value="Back" class="btn btn-primary" onClick="history.go(-1);">
                </center>
            </div>
        </form>
    </div>  
</body>
</html>