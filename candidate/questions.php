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
  $candidate = "SELECT id FROM candidate WHERE email = '".$_SESSION['login_user']."';";
  $cresult = mysqli_query($conn,$candidate);
  $cid = "";
  if($cresult){
    if ($cresult->num_rows > 0) {
        while($row = $cresult->fetch_assoc()) {
            $cid = $row['id'];
            $_SESSION['cid'] = $cid;
        }
    }
  }
  
  if(isset($_POST['role']) && !isset($_SESSION['appid']))
  {

    $_SESSION['roleid'] = $_POST['role'];
    $check  = "select * from application  where application_id IN (SELECT application_id from answers where cid='$cid' and questionid IN (SELECT questionid from question where roleid='".$_SESSION['roleid']."'));";
    $rcheck = mysqli_query($conn,$check);
    if($rcheck->num_rows == 0)
    {
    $sql = " select * from application;";
    $result=mysqli_query($conn,$sql);
    $id = "";
    if($result)
    {
    if(mysqli_num_rows($result)==0)
    {
        $id='A0001';
        $_SESSION['appid'] = $id;
    }
    else
    {
        $sql="select application_id from application order by application_id desc limit 1";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_row($result);
        $id=$row[0];
        $id++;
    }
    }

    $chk = "select * from application where roleid='".$_SESSION['login_name']."';";
    $result=mysqli_query($conn,$chk);
        if(mysqli_num_rows($result)==0)
        {
            $sql = "insert into application values('$id','pending',curdate(),'".$_POST['role']."');";
            $insert = mysqli_query($conn,$sql) or die("Application not created!!".mysqli_error($conn));
            $_SESSION['appid'] = $id;
            if(!$insert)
            {
                //unset($_SESSION['appid']);
                header("Location:selectapplication.php");
                echo '<script>alert("Application failed!!")</script>';
            }
        }
        
    }
    else
        {
            echo '<script>alert("You already have applied for this post")</script>';
            header("Location:../candidatedashboard.php");
        }
}
  
  
   $roleid = $_SESSION['roleid'];
   $app="";
   if(isset($_SESSION['appid']))
   {
    $app = $_SESSION['appid'];
   }
  $sql = "SELECT * from question where role_id = '".$roleid."' AND questionid NOT IN (SELECT questionid from answers WHERE cid = '".$cid."' and application_id='".$app."');";
  $qid = "";
  $question = "";
  $qresult = mysqli_query($conn,$sql);
  if($qresult&&$app!=""){
    if ($qresult->num_rows > 0) {
        while($row = $qresult->fetch_assoc()) {
            $qid = $row['questionid'];
            $question = $row['question'];
        }
    }
    else{
        header("Location:../candidatedashboard.php");
        unset($_SESSION['appid']);
    }
  }
  else{
    header("Location:../candidatedashboard.php");
  }

?>
<html>
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Questions</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../assets/index.css">
        <link rel="stylesheet" href="../assets/sidebar.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <style>
        video {
        	background-color: black;
	        display: block;
	        margin: 6px auto;
	        width: 420px;
	        height: 240px;
        }
    </style>
    <body onload="timer(15)">
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
                
                </li>
            </ul>
        </header>
        
        
    <div class="content">
        <div class="container">
        <!--<div class="progress">
            <div class="progress-bar" style="width:50%">2</div>
        </div><br>-->
        <span class="fs-3" id="ques">Question</span><br>
        <span class="fs-5" id="cquestion"><?php echo $question; ?></span><br>
        <video autoplay id="web-cam-container"
			style="background-color: black;" muted="muted">
			Your browser doesn't support
			the video tag
		</video>
        
        <center><span class="btn btn-success" id="status">The Recording will begin in</span><span class="btn btn-success" id="counter"></span>
        
        <button value="Stop" onclick="stopRecording()" id="nextbtn" disabled="disabled" class="btn btn-danger">Stop</button>
        <!-- <input type="button" value="Next"> -->
        </center>
        
        <script src = "../assets/canrecord.js"></script>
        <script>
            qid="<?=$qid?>";
        </script>
        </div>
    </div>
</body>
</html>