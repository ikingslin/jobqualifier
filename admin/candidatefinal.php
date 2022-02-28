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
    $roles = 'SELECT * FROM `roles`';
    $result = mysqli_query($conn,$roles);
    $jsroles = array();
    $jsnames = array();
    if($result->num_rows>0)
    {
        $i = 0;
        while($row=$result->fetch_assoc())
        {
            $jsroles[$i] = $row['roleid'];
            $jsnames[$i] = $row['Name'];
            $i++;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Candidate Final</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../assets/index.css">
        <link rel="stylesheet" href="../assets/sidebar.css">
        <link rel="stylesheet" href="../assets/formlabel.css">
        
    </head>
    <script>
        let roles = <?php echo json_encode($jsnames); ?>;
        let rolid = <?php echo json_encode($jsroles); ?>;
    </script>
    <body onload="finalitem()">
        <header class="d-flex flex-wrap justify-content-left py-2 border-bottom bg-light">
            <div class="d-flex align-items-center  me-md-auto">
                <img src="../assets/images/logo.webp" alt="No Image" id="logo" style="margin-left: 2%;" class="rounded">
                <h5 class="fs-2 companytitle" style="margin-left: 2%;">JobQualifier</h5>
            </div>
            <ul class="nav nav-pills align-items-center" style="margin-right:2%">
                <li class="nav-item" style="margin-right:15px;">
                    Admin
                </li>
                <li class="nav-item">
                    <a href="../logout.php">
                        <input type="button" value="Logout"  class="btn btn-primary">
                    </a>
                </li>
            </ul>
        </header>
        
        <div class="sidebar">
            <a href="../home.php">Home</a>
            <a href="roles.php">Adding Roles</a>
            <a href="questions.php">Adding Questions</a>
            <a href="rolequestions.php">Question Update</a>
            <a href="candidatelist.php">Candidate Grading</a>
            <a href="candidatefilter.php">Candidate Filtering</a>
            <a class="active" href="candidatefinal.php">Qualified Candidates</a>
            <a href="../logout.php">Logout</a>
        </div>
        <div class="content">
            <div class="container"><br>
            <form action="candidatefinal.php" method="post" class="d-flex">
                <select name="roles" id="role" class="form-select form-select-lg" onchange="this.form.submit()"></select>&nbsp;&nbsp;
                <button type="submit" class="btn btn-success">Show</button>
            </form><br><br>
                <?php
                    if($_SERVER['REQUEST_METHOD']=="POST"||isset($_SESSION['finalrole']))
                    {
                        $selected = "";
                        if(isset($_POST['roles']))
                        {
                            $_SESSION['finalrole'] = $_POST['roles'];
                        }
                    $selected = $_SESSION['finalrole'];
                                
                    $roles = "SELECT * FROM canfilter WHERE application_id is not null AND selrole='".$selected."' AND vidscore is not null and status IN ('Selected');";
                    $result = mysqli_query($conn,$roles);
                    if($result->num_rows>0)
                    {
                        echo "<div class=\"table-responsive\">";
                        echo "<table class = \"table\"><br><tr><thead class=\"table-dark\"><th>Candidate ID</th><th>Name</th><th>Gender</th><th>Email</th><th>Application No</th></tr></thead>";
                        while($row = $result->fetch_assoc())
                        {
                            echo "<tr>";
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['gender']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "<td>".$row['application_id']."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "</div>";
                    }
                    else
                    {
                        echo "<h3>No records found</h3>";
                    }
                    echo "<script>sessionStorage.setItem(\"finalitem\",\"$selected\")</script>";
                }
                ?>
            </div>
        </div>
        <script src="../assets/canlist.js"></script>
    </body>
</html>
            