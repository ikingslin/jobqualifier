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
    $email = $_SESSION['login_user'];
    $sql = "SELECT id FROM candidate WHERE email='$email';";
    $res = mysqli_query($conn,$sql);
    $cid = $res->fetch_assoc();
  	$roles = "SELECT Name,hires.status as stat,application.application_id from hires LEFT JOIN application ON hires.application_id=application.application_id  LEFT JOIN roles ON roles.roleid=application.roleid WHERE cid='".$cid['id']."';";
  	$result = mysqli_query($conn,$roles);
 	mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Application</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" href="../assets/index.css">
		<link rel="stylesheet" href="../assets/sidebar.css">
		<script src="../assets/application.js"></script>
	</head>
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
			<a href="editProfile.php">Profile Edit</a>
			<a href="selectapplication.php">Apply for job</a>
			<a class="active" href="candidate/statusview.php">Status of Application</a>
			<a href="../logout.php">Logout</a>
		</div>
		<div class="content">
			<div class="container"><br>
                <?php 
                    if($result->num_rows>0)
                    {
						echo "<div class=\"table-responsive\">";
                        echo "<table class = \"table\"><br><tr><thead class=\"table-dark\"><th>Application ID</th><th>Name</th><th>Status</th></thead></tr>";
                        while($row = $result->fetch_assoc())
                        {
							echo "<tr>";
                            echo "<td>".$row['application_id']."</td>";
                            echo "<td>".$row['Name']."</td>";
                            echo "<td>".$row['stat']."</td>";
							echo "<tr>";
                        }
                        echo "</table>";
						echo "</div>";
					}
					else
					{
						echo "<h3>No Applications</h3>";
					}
                    
                ?>
            </div>
        </div>
</body>
</hmtl>
