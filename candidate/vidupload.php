<?php
	include('../cauth.php');
	if(!isset($_SESSION)) 
	{ 
	  session_start(); 
	}
	$conn = mysqli_connect("localhost","root","","jobqualifier");
	if(!$conn)
	{
		die("DB Connect failed".mysqli_connect_error());
	}
	

	extract($_POST);
	$app = $_SESSION['appid'];
    $can = $_SESSION['cid'];
    $qid = $_POST['qid'];
	echo "Q:".$_POST['qid'];
	$vid = addslashes(file_get_contents($_FILES['videofile']['tmp_name']));
	$sql = "INSERT INTO answers VALUES('".$app."','".$can."','".$qid."','".$vid."')";
	
	mysqli_query($conn,$sql) or die ("Not Inserted ".mysqli_error($conn));
	
	mysqli_close($conn);
?>