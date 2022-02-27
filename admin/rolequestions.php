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
        <title>Candidate Filter</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../assets/index.css">
        <link rel="stylesheet" href="../assets/sidebar.css">
        
        
    </head>
    <body>
        <script>
            let roles = <?php echo json_encode($jsnames); ?>;
            let rolid = <?php echo json_encode($jsroles); ?>;
        </script>
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
            <a class="active" href="rolequestions.php">Question Update</a>
            <a href="candidatelist.php">Candidate Grading</a>
            <a href="candidatefilter.php">Candidate Filtering</a>
            <a href="candidatefinal.php">Qualified Candidates</a>
            <a href="../logout.php">Logout</a>
        </div>
        <div class="content">
            <div class="container"><br>
            <form action="rolequestions.php" method="get" class="d-flex">
                <select name="roles" id="role" class="form-select form-select-lg" onchange="this.form.submit()">
                <?php
                    $j = 0;
                    while($j<$i){
                        if(array_key_exists("roles",$_GET)){
                            if($_GET['roles']==$jsroles[$j]){
                                echo '<option value="'.$jsroles[$j].'" selected>'.$jsnames[$j].'</option>';
                            }
                            else{
                                echo '<option value="'.$jsroles[$j].'">'.$jsnames[$j].'</option>';
                            }
                        }
                        else{
                            echo '<option value="'.$jsroles[$j].'">'.$jsnames[$j].'</option>';
                        }
                        $j = $j+1;
                    }
                ?>
            </select>&nbsp;&nbsp;
                <button type="submit" class="btn btn-success">Show</button>
            </form>
            <?php
                if(array_key_exists("roles",$_GET)){
                    $roleid = $_GET['roles'];
                    $questions = mysqli_query($conn,"SELECT * FROM QUESTION WHERE ROLE_ID='$roleid';");
                }
                else{
                    $questions = mysqli_query($conn,"SELECT * FROM QUES; ");
                }
            ?>
            <br><br>
            <form method="post">
                <div class="container">
                    <div class="row">
                        <h5>Question(s):</h5>
                    </div>
                    <div class="row" style="margin-left: 20px;">
                    <?php
                    while($row = mysqli_fetch_assoc($questions)){
                        echo "<br>";
                        echo "<div class='row' style='display:flex; flex-wrap: nowrap;'>";
                        echo "<input type='checkbox' name='".$row['questionid']."' id='".$row['questionid']."' value='".$row['questionid']."' class='form-check-input'/>";
                        echo "<label for='".$row['questionid']."'>".$row["question"]."</label>";
                        echo "<br>";
                        echo "</div>";
                    }
                    ?>
                    </div>
                </div>
                <br><br>
                <div class="container">
                    <div class="row" style="flex-direction:column;">
                        <div class="col">            
                            <select name="selectedrole" id="selectedrole" class="form-select form-select-lg">
                                <?php
                                    $j = 0;
                                    while($j<$i){
                                        if(array_key_exists("roles",$_GET)){
                                            if($_GET['roles']==$jsroles[$j]){
                                                echo '<option value="'.$jsroles[$j].'" selected>'.$jsnames[$j].'</option>';
                                            }
                                            else{
                                                echo '<option value="'.$jsroles[$j].'">'.$jsnames[$j].'</option>';
                                            }
                                        }
                                        else{
                                            echo '<option value="'.$jsroles[$j].'">'.$jsnames[$j].'</option>';
                                        }
                                        $j = $j+1;
                                    }
                                ?>
                            </select>&nbsp;&nbsp;
                        </div>
                        <div class="col-lg">
                                <button type="submit" class="btn btn-success">Add Question(s) to Role</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $selectedrole = $_POST['selectedrole'];
                    $selectedquestions = $_POST;
                    foreach($selectedquestions as $x => $x_value) {
                        if($x!="selectedrole"){
                            $questionid = $x;
                            $exists = mysqli_query($conn,"SELECT * FROM QUESTION WHERE ROLE_ID='$selectedrole' AND QUESTIONID='$questionid';");
                            if(mysqli_num_rows($exists)==0){
                                $res = mysqli_query($conn,"SELECT * FROM QUES WHERE QUESTIONID='$questionid';");
                                $row = mysqli_fetch_assoc($res);
                                $question = $row['question'];
                                $sql = "INSERT INTO question (ROLE_ID,QUESTIONID,question) VALUES ('$selectedrole','$questionid','$question');";
                                $result = mysqli_query($conn,$sql);
                            }
                        }
                    }
                }
            ?>
