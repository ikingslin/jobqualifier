<?php
$conn = mysqli_connect("localhost", "root", "", "jobqualifier");
if (!$conn) {
    die("Connection to DB failed with : " . mysqli_connect_error());
}
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['loginname']);
    $pass = mysqli_real_escape_string($conn, $_POST['apass']);
    $mode = $_POST['lmode'];
    if ($mode == "admin") {
        $query = "SELECT `email`, `password` FROM admin WHERE email='$name' AND password='$pass';";
    } else if ($mode == "candidate") {
        $query = "SELECT `email`,`password`,`name`,`account_status` FROM candidate WHERE email='$name'";
    }
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        echo '<script>alert("Invalid Credentials")</script>';
    } else if (mysqli_num_rows($result) == 1) {
        if ($mode == "admin") {
            $_SESSION['login_user'] = $name;
            header("Location:home.php");
        } else if ($mode == "candidate") {
            $row = mysqli_fetch_array($result);
            if (password_verify($pass, $row["password"])) {
                $_SESSION['login_mail'] = $row['email'];
                $_SESSION['login_name'] = $row["name"];
                $_SESSION['verified'] = $row["account_status"];
                echo $_SESSION['verified'];
                $_SESSION['login_user'] = $name;
                if ($_SESSION['verified'] == 0) {
                    header("Location:verifyotp.php");
                    exit();
                }
                header("Location:candidatedashboard.php");
            } else {
                echo password_verify($pass, $row["password"]);
                print_r($row);
                echo '<script>alert("Invalid Credentials")</script>';
            }
        }
    }
}
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/admin.js"></script>
    <link rel="stylesheet" href="assets/index.css">
</head>
<!-- <style>
        body, html 
        {
            height: 100%;
        }
        * {
           box-sizing: border-box;
        }

        .bg-img 
        {
            background-image: url("assets/images/bg.jpg");
            min-height: 91vmin;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .container 
        {
            position: fixed;
            margin: 50px;
            right: 500px;
            width: 25%;
            height: 500px;
            padding: 40px;
            background-color: white;
        }

        .btn
        {
            background-color: #1E90FF;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style> -->
<style>
    /* body{
            background-image: url("assets/images/bg.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        } */
</style>

<body>
    <div class="bg-image" style="background-image: url('assets/images/bg.jpg');
            height: 100vh">
        <header class="d-flex justify-content-left align-items-center py-1 border-bottom bg-light">
            <img src="assets/images/logo.webp" alt="No Image" id="logo" style="margin-left: 2%;" class="rounded-circle">
            <h5 class="fs-2" id="companytitle" style="margin-left: 2%;">JobQualifier</h5>
        </header>


        <div class="bg-img">
            <div class="container" style="max-width: fit-content;background-color:white;padding:4%;margin-top:5%;border-radius:3%;">
                <h1>LOGIN</h1><br />
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" name="loginname" id="name" class="form-control" required />
                    </div><br>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" name="apass" id="pass" class="form-control" required />
                    </div><br>
                    <div class="form-group">
                        <input type="radio" name="lmode" id="candidate" value="candidate" checked />
                        <label for="candidate">Candidate</label>
                        <input type="radio" name="lmode" id="admin" value="admin" />
                        <label for="admin">Admin</label>
                    </div><br>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-dark">
                        <a  href="signup.php" class="btn btn-dark">SignUp</a>
                        <span id="error"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>