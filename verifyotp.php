<?php
session_start();
require './mailjet-apiv3/vendor/autoload.php';
use \Mailjet\Resources;

// Use your saved credentials, specify that you are using Send API v3.1
$SENDER_EMAIL = 'jobqualifier1832@gmail.com';
$RECIPIENT_EMAIL = $_SESSION['login_mail'];
$RECIPIENT_NAME = $_SESSION['login_name'];
if($_SERVER['REQUEST_METHOD'] == "GET"){
    $otp = mt_rand(100000, 999999);
    $_SESSION['login_otp'] = $otp;
    $mj = new \Mailjet\Client('9942579c81a9b0958b40dfe03e07e043', 'e841c840c94b1bbadcae15c29a676d1e',true,['version' => 'v3.1']);
    
    // Define your request body
    
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "$SENDER_EMAIL",
                    'Name' => "Job Qualifier"
                ],
                'To' => [
                    [
                        'Email' => "$RECIPIENT_EMAIL",
                        'Name' => "$RECIPIENT_NAME"
                    ]
                ],
                'Subject' => "Verify your OTP for Job Qualifier!",
                'TextPart' => "Your Job Qualifier OTP is : $otp"
            ]
        ]
    ];
    
    // All resources are located in the Resources class
    
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    // Read the response
    
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if($_POST['otp'] == $_SESSION['login_otp']){
        $conn = mysqli_connect("localhost","root","","jobqualifier");
        mysqli_query($conn,"UPDATE candidate SET account_status = 1 WHERE email = '".$_SESSION['login_mail']."'");
        mysqli_close($conn);
        header("Location:candidatedashboard.php");
    }
}
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
    <style>
        body, html 
        {
            height: 100%;
        }
        * {
           box-sizing: border-box;
        }

        .bg-img 
        {
            min-height: 91vmin;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .container 
        {
            position: absolute;
            margin: 50px;
            right: 500px;
            width: 25%;
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
    </style>
    <body>
        <header class="d-flex justify-content-left align-items-center py-2 border-bottom bg-light">
            <img src="assets/images/logo.webp" alt="No Image" id="logo" style="margin-left: 2%;" class="rounded-circle">
            <h5 class="fs-2" id="companytitle" style="margin-left: 2%;">JobQualifier</h5>
        </header>
        <div class="bg-img">
            <div class="container">
                <center><h1>VERIFY OTP</h1></center><br/>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">One Time Password</label><br><br>
                        <input type="text" name="otp" placeholder="Enter OTP" class="form-control">
                    </div><br>
                    <div class="form-group">
                        <p><input type="submit" value="Verify" class="btn btn-dark"></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
