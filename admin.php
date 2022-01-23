<?php
    $conn = mysqli_connect("localhost","root","","jobqualifier");
    if(!$conn)
    {
        die("Connection to DB failed with : ".mysqli_connect_error());
    }
    if(isset($_GET['check'])){
    $aname = $_POST['adminname'];
    $apass = $_POST['apass'];
    
    $query = "SELECT `AdminName`, `Password` FROM admin WHERE AdminName='$aname' AND Password='$apass';";
    $result = mysqli_query($conn,$query);
    
    if($result==false)    
    {
        echo '<script type="text/javascript">','validate(0);','</script>';
    }
    else if(mysqli_num_rows($result) > 0)
    {
        header("Location:dashboard.php");
    }
    mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/admin.js"></script>
    <link rel="stylesheet" href="assets/index.css">
</head>
<body>
    <header class="d-flex justify-content-left align-items-center py-2 border-bottom bg-light">
        <img src="assets/images/logo.png" alt="No Image" id="logo" style="margin-left: 2%;">
        <h4 class="fs-4" id="companytitle" style="margin-left: 2%;">JobQualifier</h4>
    </header><br>
    <div class="container" style="max-width: fit-content;">
        <form action="admin.php?check=true" method="post">
            <div class="form-group">
                <label for="aname">Admin Name</label>
                <input type="text" name="adminname" id="aname" class="form-control" required/>
            </div><br>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" name="apass" id="pass" class="form-control" required/>
            </div><br>
            <div class="form-group">
                <input type="submit" value="Login" class="btn btn-success">
                <span id="error"></span>
            </div>
        </form>
    </div>
    
</body>
</html>

