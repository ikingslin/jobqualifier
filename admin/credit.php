<?php
    include('../aauth.php');
    if(!isset($_SESSION)) 
	{ 
	  session_start(); 
	}
    $conn = mysqli_connect("localhost","root","","jobqualifier");
    if(!$conn)
    {
        die("Connection to DB failed with : ".mysqli_connect_error());
    }
    $adid = $_SESSION['login_user'];
    $admin = "SELECT adminid from admin where email='".$adid."';";
    $res = mysqli_query($conn,$admin);
    
    if($res->num_rows>0)
    {
        $id = mysqli_fetch_assoc($res);
        $adid = $id['adminid'];
    }
    $appid = $_SESSION['appid'];
    $qid = $_SESSION['qid'];
    $cid = $_SESSION['cid'];
    $score = $_POST['credit'];
    echo $appid;
    echo $cid;
    echo $qid;
    //echo $adid;
    //$sql = "INSERT INTO hires VALUES('".$adid."','".$cid."','".$appid."','".$status."','OnProgress')";
    $answer = "UPDATE answers set mark=$score WHERE application_id='$appid' AND cid='$cid' AND questionid='$qid';";
    if(mysqli_query($conn,$answer))
    {
        echo "Candidate Scored";
        $sql = "SELECT cid FROM `answers` WHERE mark is not null AND cid='$cid' AND application_id='$appid'";
        $chk = "SELECT cid from answers where cid = '$cid' AND application_id='$appid'";
        $res = mysqli_query($conn,$sql);
        $result = mysqli_query($conn,$chk);
        if($res->num_rows==$result->num_rows)
        {
            $upd = "UPDATE application SET status = 'scored' WHERE application_id='$appid';";
            if(mysqli_query($conn,$upd))
            {
                echo "Finished";
            }
        }
    }
    //header("Location:candidatelist.php");
?>