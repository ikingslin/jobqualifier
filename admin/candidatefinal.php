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
    $roles = 'SELECT * FROM `roles` WHERE last_date>sysdate()';
    $result = mysqli_query($conn,$roles);
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
    <body>
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
            <a href="">Question Update</a>
            <a href="candidatelist.php">Candidate Grading</a>
            <a href="candidatefilter.php">Candidate Filtering</a>
            <a class="active" href="candidatefinal.php">Level Scores</a>
            <a href="../logout.php">Logout</a>
        </div>
        <div class="content">
            <div class="container"><br>
            