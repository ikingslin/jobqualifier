<?php
    $conn = mysqli_connect("localhost","root","","jobqualifier");
    if(!$conn)
    {
      die("Connection to DB failed with : ".mysqli_connect_error());
    }
   
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"select `email` from candidate where email = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   //$login_session = $row['email'];
   mysqli_close($conn);
   if(!isset($_SESSION['login_user'])&&!($ses_sql->num_rows==1)){
      header("location:http://localhost:8000/jobqualifier/index.php");
      die();
   }
?>