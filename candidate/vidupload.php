<?php
	$conn = mysqli_connect("localhost","root","","jobqualifier");
	if(!$conn)
	{
		die("DB Connect failed".mysqli_connect_error());
	}
	
	
	$app = $_POST['appid'];
    $can = $_POST['cid'];
    $qid = $_POST['qid'];
	
	$vid = addslashes(file_get_contents($_FILES['videofile']['tmp_name']));
	$sql = "INSERT INTO answers VALUES('".$app."','".$can."','".$qid."','".$vid."')";
	
	mysqli_query($conn,$sql) or die ("Not Inserted ".mysqli_error($conn));
	
	mysqli_close($conn);
?>