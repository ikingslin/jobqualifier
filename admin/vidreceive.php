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
		$status=unlink($_SESSION['cid'].$_SESSION['qid'].".mp4");    
		// if($status){  
		// echo "File deleted successfully";    
		// }
		// else{  
		// echo "Sorry!";    
		// }
    	$qid = $_POST['qid'];
    	$cid = $_POST['cid'];
		$appid = $_POST['appid'];
		$_SESSION['qid']=$_POST['qid'];
    	$_SESSION['cid']=$_POST['cid'];
		$_SESSION['appid']=$_POST['appid'];
	
		$sql = "SELECT video from answers where questionid='".$qid."' AND cid='".$cid."' AND application_id='".$appid."';";
		//$sql = "SELECT video from answers where questionid='Q0006';";
		
		$result = mysqli_query($conn,$sql) or die ("Not Fetched ".mysqli_error($conn));
	
    	if($result->num_rows>0)
    	{
        	while($row=$result->fetch_assoc())
        	{
            	file_put_contents($cid.$qid.".mp4",$row['video']);
				//file_put_contents("test.mp4",$row['video']);
			
			//header("Content-type: " . "video/mp4");
			//echo $row['video'];
      //  }
    //}
    //}
	//header("Content-type: " . "video/mp4");
	//echo $vid;
    //$data = file_get_contents(stripslashes($vid));
	//$data = stripslashes($vid);
	
	
	//$blob_data = fbsql_read_blob($data);
	//echo $vid;
    //echo gettype($data);
	//mysqli_close($conn);
		}
		
	}
}
?>