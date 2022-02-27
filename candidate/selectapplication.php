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
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$word = $_POST['role'];
  		$roles = "select * from roles where last_date > sysdate() AND Name LIKE '%$word%';";
	}
	else{
		$roles = "select * from roles where last_date > sysdate();";
	}
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
			<a class="active"href="selectapplication.php">Apply for job</a>
			<a href="statusview.php">Status of Application</a>
			<a href="../logout.php">Logout</a>
		</div>
		<div class="content">
			<div class="container"><br>
				<h3> Available Applications </h3><br/>

				<form action="selectapplication.php" method="post">
					<div class="form-group">
						<div class="row">
							<div class="col">
								<input type="text" name="role" class="form-control" id="srole">
							</div>
							<div class="col">
								<button type="submit" name="Search" class="btn btn-primary">Search</button>
							</div>
						</div>
					</div>
				</form>
				<br><br>
				<?php if ($result->num_rows > 0) :?>
				<?php while($row = $result->fetch_assoc()) :?>
				<div class="card card-default">
					<div class="card-header">
						<h4 class="card-title"><?php echo $row['Name'];?></h4>
					</div>
					<div class="card-body">
						<p>Requirements  : <?php echo $row['requirement'];?></p>
						<p>Qualification : <?php echo $row['qualification'];?></p>
						<p>Last to apply : <?php echo $row['last_date'];?></p>
						<a href="terms.php?roleid=<?php echo $row['roleid']; ?>">
							<button class="btn btn-primary">Apply</button>
						</a>
					</div>
				</div>
				<br/>
				<?php endwhile; ?>
				<?php else: ?>
					<h4> Wait for our updates </h4>
				<?php endif; ?>
				<?php mysqli_free_result($result); ?>
			</div>
		</div>
		<script src="../assets/application.js"></script>
	</body>
</html>