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
    $cid = $_POST['canset'];
    $fcid = $_POST['canfail'];
    //echo $_POST['canset'];
    $i=0;
    $email = $_SESSION['login_user'];
    //echo $email;
    $sql = "SELECT * FROM `admin` WHERE `email`='$email'";
    mysqli_query($conn,$sql);
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $admin = $row['AdminID'];
    while(isset($cid[$i]))
    {
        $var = explode('/',$cid[$i]);
        //echo $var[0]." ".$var[1];
        $sql = "INSERT INTO `hires`(`AdminID`, `cid`, `application_id`, `status`) VALUES('$admin','$var[0]','$var[1]','clearedfilter')";
        mysqli_query($conn,$sql);
         $i++;
    }
    $i=0;
    while(isset($fcid[$i]))
    {
        $var = explode('/',$fcid[$i]);
        //echo $var[0]." ".$var[1];
        $sql = "INSERT INTO `hires`(`AdminID`, `cid`, `application_id`, `status`) VALUES('$admin','$var[0]','$var[1]','failedfilter')";
        mysqli_query($conn,$sql);
         $i++;
    }
    mysqli_close($conn);
    header("Location:candidatefilter.php");
?>