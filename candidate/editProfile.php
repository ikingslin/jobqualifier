<?php
    include('../cauth.php');
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $conn = mysqli_connect("localhost","root","","jobqualifier");
    if(!$conn)
    {
        die("Connection to DB failed with : ".mysqli_connect_error());
    }
    
    if($_SERVER["REQUEST_METHOD"]=="POST"&&isset($_POST['submit']))
    {
        $name = $_POST['cname'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $pincode = $_POST['pincode'];
        $ugcgpa = $_POST['ugcgpa'];
        $pgcgpa = $_POST['pgcgpa'];
        $email = $_POST['uemail'];
        $work = $_POST['work'];
        $projects = $_POST['projects'];
        $intern = $_POST['intern'];
        $interests = $_POST['interests'];
        
        if(is_uploaded_file($_FILES['resume']['tmp_name'])&&is_uploaded_file($_FILES['pic']['tmp_name']))
        {
            $pic = addslashes(file_get_contents($_FILES['resume']['tmp_name']));
            $resume = addslashes(file_get_contents($_FILES['resume']['tmp_name']));
            $sql = "UPDATE `candidate` SET `address`='$address',`contact`='$contact',`pincode`='$pincode',`ugcgpa`='$ugcgpa',`pgcgpa`='$pgcgpa',`work`='$work',`projects`='$projects',`intern`='$intern',`interests`='$interests', resume='$resume', `profile`='$pic' WHERE `email`='$email'";
        }
        else if(is_uploaded_file($_FILES['pic']['tmp_name']))
        {
            $pic = addslashes(file_get_contents($_FILES['pic']['tmp_name']));
            $sql = "UPDATE `candidate` SET `address`='$address',`contact`='$contact',`pincode`='$pincode',`ugcgpa`='$ugcgpa',`pgcgpa`='$pgcgpa',`work`='$work',`projects`='$projects',`intern`='$intern',`interests`='$interests', `profile`='$pic' WHERE `email`='$email'";
        }
        else if(is_uploaded_file($_FILES['resume']['tmp_name']))
        {
            $resume = addslashes(file_get_contents($_FILES['resume']['tmp_name']));
            $sql = "UPDATE `candidate` SET `address`='$address',`contact`='$contact',`pincode`='$pincode',`ugcgpa`='$ugcgpa',`pgcgpa`='$pgcgpa',`work`='$work',`projects`='$projects',`intern`='$intern',`interests`='$interests', resume='$resume' WHERE `email`='$email'";
        }
        else{
        $sql = "UPDATE `candidate` SET `address`='$address',`contact`='$contact',`pincode`='$pincode',`ugcgpa`='$ugcgpa',`pgcgpa`='$pgcgpa',`work`='$work',`projects`='$projects',`intern`='$intern',`interests`='$interests' WHERE `email`='$email'";
    }
        $insert = mysqli_query($conn,$sql);
        if(!$insert)
            echo '<script>alert("Cannot Update Account")</script>';
        else 
        {
            echo '<script>alert("Account Updated successfully")</script>';
        }
    }
    $sql = "select * from candidate where `email`='".$_SESSION['login_user']."'";
    $profile = mysqli_query($conn,$sql);
    $arr = mysqli_fetch_assoc($profile);
    file_put_contents($arr['id'].".".'jpg',$arr['profile']);
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../assets/index.css">
        <link rel="stylesheet" href="../assets/sidebar.css">
    </head>
    <style>
        #pic{
            width: auto;
            height: 150px;
        }
    </style>
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
                    <a href="../logout.php">
                        <input type="button" value="Logout"  class="btn btn-primary">
                    </a>
                </li>
            </ul>
        </header>
        <div class="sidebar">
            <a href="../candidatedashboard.php">Home</a>
            <a class="active" href="editProfile.php">Profile Edit</a>
            <a href="selectapplication.php">Apply for job</a>
            <a href="statusview.php">Status of Application</a>
            <a href="../logout.php">Logout</a>
        </div>
        <div class="content">
            <div class="container"><br><br>
                <form action="editProfile.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-10">
                            <label for="cname">Name</label>
                            <input type="text" name="name" id="cname" value="<?php echo $arr['name']; ?>" class="form-control" disabled/>
                            <input type="hidden" name="cname" value="<?php echo $arr['name']; ?>">
                        </div>
                        <div class="col-lg-2">
                            <img src="<?php echo $arr['id'].".jpg"; ?>" alt="No Image" id="pic" name="pic">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <label for="address">Address</label>
                            <input type="textarea" name="address" id="address" value="<?php echo $arr['address']; ?>" class="form-control" required/>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="gender">Gender</label>
                            <select class="form-control" name="gender" disabled>
                                <option >Select</option>
                                <option value="female" <?php if ($arr['gender'] == 'female')  echo "selected"?>>Female</option>
                                <option value="male" <?php if ($arr['gender'] == 'male')  echo "selected"?>>Male</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" value="<?php echo $arr['dob']; ?>" class="form-control" disabled/>
                        </div>
                        <div class="col-lg-3">
                            <label for="contact">Contact Number</label>
                            <input type="tel" name="contact" id="contact" pattern="[0-9]{10}" value="<?php echo $arr['contact']; ?>" class="form-control" required/>
                        </div>
                        <div class="col-lg-3">
                            <label for="pincode">Pincode</label>
                            <input type="tel" name="pincode" id="pincode" pattern="[0-9]{6}" value="<?php echo $arr['pincode']; ?>" class="form-control" required/>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="per10">10th Percentage</label>
                            <input type="text" name="per10" id="per10" min="0.0" max="100.0" value="<?php echo $arr['per10']; ?>" class="form-control" disabled/>
                        </div>
                        <div class="col-lg-3">
                            <label for="per12">12th Percentage</label>
                            <input type="text" name="per12" id="per12" min="0.0" max="100.0" value="<?php echo $arr['per12']; ?>" class="form-control" disabled/>
                        </div>
                        <div class="col-lg-3">
                            <label for="ugcgpa">UG CGPA</label>
                            <input type="text" name="ugcgpa" id="ugcgpa" min="0.0" max="10.0" value="<?php echo $arr['ugcgpa']; ?>" class="form-control" required/>
                        </div>
                        <div class="col-lg-3">
                            <label for="pgcgpa">PG CGPA</label>
                            <input type="text" name="pgcgpa" id="pgcgpa" min="0.0" max="10.0" value="<?php echo $arr['pgcgpa']; ?>" class="form-control" required/>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo $arr['email']; ?>" class="form-control" disabled/> 
                            <input type="hidden" name="uemail" value="<?php echo $arr['email']; ?>">
                        </div>
                        <div class="col-lg-6">
                            <label for="work">Work Experience</label>
                            <input type="text" name="work" id="work" value="<?php echo $arr['work']; ?>" class="form-control" required/>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="projects">Projects</label>
                            <input type="text" name="projects" id="projects" value="<?php echo $arr['projects']; ?>" class="form-control" required/>
                        </div>
                        <div class="col-lg-6">
                            <label for="intern">Internship</label>
                            <input type="text" name="intern" id="intern" value="<?php echo $arr['intern']; ?>" class="form-control" required/> 
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="interests">Area of interests</label>
                            <input type="text" name="interests" id="interests" value="<?php echo $arr['interests']; ?>" class="form-control" required/>
                        </div>
                        <div class="col-lg-4">
                            <label for="resume">Resume</label>
                            <input type="file" name="resume" id="resume" class="form-control" accept=".pdf"/>
                        </div>
                        <div class="col-lg-4">
                            <label for="pic">Profile Picture</label>
                            <input type="file" name="pic" id="profile" class="form-control" accept=".jpg" />
                        </div>
                    </div><br>
                    <div class="form-group">
                        <center>
                            <input type="submit" value="Update Account" name="submit" class="btn btn-primary">
                        </center>
                    </div><br><br>
                </form>
            </div>
        </div>  
        <!-- <script src="../assets/application.js"></script> -->
    </body>
</html>