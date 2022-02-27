<?php
  include('aauth.php');
  if(!isset($_SESSION)) 
  { 
    session_start(); 
  }
  $conn = mysqli_connect("localhost","root","","jobqualifier");
  if(!$conn)
  {
    die("Connection to DB failed with : ".mysqli_connect_error());
  }
  $roles = 'SELECT `Name`,COUNT(roles.roleid) as rcount FROM (select * from roles) AS roles RIGHT join application on roles.roleid = application.roleid group by roles.roleid HAVING Name IS NOT NULL;';
  $result = mysqli_query($conn,$roles);
  $rol = array();
  $count = array();
  $i=0;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $rol[$i] = $row["Name"];
      $count[$i] = $row["rcount"];
      $i++;
    }
  } else {
    echo "";
  }
  mysqli_close($conn);
?>
<html>
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="assets/index.css">
        <link rel="stylesheet" href="assets/sidebar.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    </head>
    <body>
    <header class="d-flex flex-wrap justify-content-left py-2 border-bottom bg-light">
            <div class="d-flex align-items-center  me-md-auto">
                <img src="assets/images/logo.webp" alt="No Image" id="logo" style="margin-left: 2%;" class="rounded">
                <h5 class="fs-2 companytitle" style="margin-left: 2%;">JobQualifier</h5>
            </div>
            
            <ul class="nav nav-pills align-items-center" style="margin-right:2%">
                <li class="nav-item" style="margin-right:15px;">
                    <?php echo "Admin"?>
                </li>
                <li class="nav-item">
                    <a href="logout.php">
                        <input type="button" value="Logout"  class="btn btn-primary">
                    </a>
                </li>
            </ul>
        </header>
        <div class="sidebar">
            <a class="active" href="home.php">Home</a>
            <a href="admin/roles.php">Adding Roles</a>
            <a href="admin/questions.php">Adding Questions</a>
            <a href="admin/rolequestions.php">Question Update</a>
            <a href="admin/candidatelist.php">Candidate Grading</a>
            <a href="admin/candidatefilter.php">Candidate Filtering</a>
            <a href="admin/candidatefinal.php">Qualified Candidates</a>
            <a href="logout.php">Logout</a>
        </div>
        
    <div class="content">
            <div class="container">
              <br><br>
              <canvas id="myChart" style="position: relative;width:100%;max-width:700px"></canvas>
            </div>
    </div>
    </body>
    <script>
        var xValues = <?php echo json_encode($rol); ?>;
        var yValues = <?php echo json_encode($count); ?>;
        var barColors = ["red", "green","blue","orange","brown"];
        
        new Chart("myChart", {
          type: "bar",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            legend: {display: false},
            responsive : true,
            title: {
              display: true,
              text: "Applicants"
            }
          }
        });
    </script>
</html>