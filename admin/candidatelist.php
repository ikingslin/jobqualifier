<?php
    include('../aauth.php');
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
    $vid = "";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Candidate List</title>
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
    <style>
        video 
        {
            background-color: black;
            display: block;
            margin: 6px auto;
            width: 420px;
            height: 240px;
        }
    </style>
    <body onload="selection()">
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
            <a class="active" href="candidatelist.php">Candidate Grading</a>
            <a href="candidatefilter.php">Candidate Filtering</a>
            <a href="candidatefinal.php">Qualified Candidates</a>
            <a href="../logout.php">Logout</a>
        </div>
        <div class="content">
            <div class="container"><br>
                <form action="candidatelist.php" method="post" class="d-flex">
                    <select name="roles" id="role" class="form-select form-select-lg" onload="this.form.submit()" onchange="this.form.submit()"></select>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Show</button>
                    
                </form>
            <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="stopVideo()"></button>
                    </div>
                    <div class="modal-body">
                        
                        <script>
                            
                            function videoplay(a,b,c)
                            {
                                var fd = new FormData();
                                //console.log("Inside videoplay");
	                            fd.append('qid', a);
                                fd.append('cid', b);
                                fd.append('appid', c);
                                $.ajax({
		                            url: 'vidreceive.php',
		                            type: 'POST',
		                            data: fd,
		                            processData: false,
		                            contentType: false
	                            }).done(function(datum) {
                                    //console.log(datum);                                    
                                    //var create = document.createElement("video");
                                    //create.setAttribute("id","player");
                                    var video = document.getElementById("player");
                                     video.src ="";
                                     video.load();
                                     video.src = b+a+".mp4";
                                    //video.src="test.mp4";
                                    video.load();

		                            //console.log(typeof datum);
                                    //chunks = new array(datum);
                                   // let def = new FileReader();
                                    //def.readAsDataURL(datum);
                                    /*something(datum);
                                    async function something(datum)
                                    {
                                    //const base64Response = await fetch(`data:video/mp4;string,${datum}`);
                                    //const blob = await base64Response.blob().then((value) => console.log(value));
                                    
                                    const recordedMedia = document.createElement("video");
                                    recordedMedia.controls = true;
                                    const recordedMediaURL = URL.createObjectURL(blob);
                                    recordedMedia.src = blob;
                                    }*/
                                    /*var binaryData = [];
                                    binaryData.push(datum);
                                    
                                    const recordedMedia = document.createElement("video");
                                    recordedMedia.controls = true;
                                    const blob = new Blob(binaryData, {type: "video/mp4"});
                                    console.log(blob);
                                    const recordedMediaURL = window.URL.createObjectURL(blob);
                                    
                                    recordedMedia.src = recordedMediaURL;*/
                                    //const blob = new Blob(datum);
                                    //console.log(res);
                                    
                                
	                            });
                                
                                
                            }
                            
                        </script>
                        <div id="vid">
                            
                        <video width="300" preload="none" height="200" id="player" controls><source src="" type="video/mp4"></video>
                        </div>
                        <div>
                            <input type="number" name="credit" id="credits">
                            <input type="button" class="btn btn-success" value="Mark" onclick="credit()">        
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="stopVideo()">Close</button>
                    </div>

                </div>
            </div>
        </div>
                <?php
                
                    if($_SERVER["REQUEST_METHOD"] == "POST"||isset($_SESSION['selectedlrole']))
                    {
                        $selected="";
                        if(isset($_POST['roles']))
                        {
                            $_SESSION['selectedlrole'] = $_POST['roles'];
                        }
                        $selected = $_SESSION['selectedlrole'];
                        $sql = "SELECT * FROM `answers` join application on answers.application_id=application.application_id join question on application.roleid=question.role_id and answers.questionid=question.questionid where question.role_id='".$selected."';";
                        $result = mysqli_query($conn,$sql);
                        
                        if($result->num_rows>0)
                        {
                            echo "<div class=\"table-responsive\">";
                            echo "<table class = \"table\"><br><tr><thead class=\"table-dark\"><th>Candidate ID</th><th>Question</th><th>Video</th><th>Status</th></thead></tr>";
                            while($row=$result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo "<td>".$row['cid']."</td>";
                                echo "<td>".$row['question']."</td>";
                                echo "<td><button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#myModal\" onclick=\"videoplay("."'".$row['questionid']."','".$row['cid']."','".$row['application_id']."')\">"."Play Video</button></td>";
                                echo "<td>".$row['status']."</td>";
                                echo "</tr>";
                            }
                        echo "<table>";
                        echo "</div>";
                        }
                        else
                        {
                            echo "<br><h3>No records found</h3>";
                        }
                        echo "<script>sessionStorage.setItem(\"seitem\",\"$selected\")</script>";
                    }
                    mysqli_close($conn);
                ?>
            </div>
        </div>
        
        <script src="../assets/canlist.js"></script>
    </body>
</html>
