<?php
	include('../aauth.php');
	if(!isset($_SESSION)) 
	{ 
	  session_start(); 
	}
	$conn = mysqli_connect("localhost","root","","jobqualifier");
	if(!$conn)
	{
		die("DB Connect failed".mysqli_connect_error());
	}
	if($_SERVER["REQUEST_METHOD"] == "POST")
    {
    $qid = $_POST['qid'];
    $appid = $_POST['appid'];
	//echo "Q:".$_POST['qid'];
    //echo "Q:".$_POST['appid'];
	
	$sql = "SELECT video from answers where questionid='".$qid."';";
	
	$result = mysqli_query($conn,$sql) or die ("Not Inserted ".mysqli_error($conn));
	
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            $vid = $row['video'];
        }
    }
    }
    //$data = stripslashes($vid;
    echo $vid;
	mysqli_close($conn);
?>