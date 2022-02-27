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
        <link rel="stylesheet" href="../assets/formlabel.css">
        
    </head>
    <style>
        object{
            width: 100%;
            height: 100%;
        }
        .modal-dialog {
            width: 1300px;
            height:800px;
        }
        .modal-content {
            height: 80%;        
        }   
    </style>
    <script>
        let roles = <?php echo json_encode($jsnames); ?>;
        let rolid = <?php echo json_encode($jsroles); ?>;
    </script>
    <body onload="selectionitem()">
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
            <a class="active" href="candidatefilter.php">Candidate Filtering</a>
            <a href="candidatefinal.php">Qualified Candidates</a>
            <a href="../logout.php">Logout</a>
        </div>
        <div class="content">
            <div class="container"><br>
            <form action="candidatefilter.php" method="post" class="d-flex">
                <select name="roles" id="role" class="form-select form-select-lg" onchange="this.form.submit()"></select>&nbsp;&nbsp;
                <button type="submit" class="btn btn-success">Show</button>
            </form><br><br>
            <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <script>
                            function display(a)
                            {
                                console.log(a);
                                //document.getElementById('pdfdisplay').src = a;
                                // var pdf = new PDFObject({
                                //     url: a,
                                //     id: "pdfdisplay",
                                //     pdfOpenParams: {
                                //     view: "FitH"
                                //     }
                                // }).embed("psfdisplay");
                                var displ = document.getElementById('disp');
                                displ.data=a;
                            }
                        </script>
                        <div id="pdfdisplay"></div>
                        <object id="disp" data="" type="application/pdf" width="300" height="200">
                                    
                        </object>
                    </div>
                
            </div>
        </div>
            </div>
            <button data-bs-toggle="collapse" class="btn btn-info" data-bs-target="#filters">Filters</button>
            <div class="collapse" id="filters">
                <form method="POST" class="form" action="candidatefilter.php">
                    <div class="row">
                        <div class="col input-group-sm">
                            <label for="tenth">10th Percentage</label>
                            <span class="input-group-text">Between</span>
                            <input  class="form-control" type="number" name="ten" id="tenth">
                            <span class="input-group-text">AND</span>
                            <input  class="form-control" type="number" name="eten" id="etenth">
                        </div>
                        <div class="col input-group-sm">
                            <label for="twelfth">12th Percentage</label>
                            <span class="input-group-text">Between</span>
                            <input class="form-control" type="number" name="twel" id="twelfth">
                            <span class="input-group-text">AND</span>
                            <input class="form-control" type="number" name="etwel" id="etwelfth">
                        </div>
                        <div class="col input-group-sm">
                            <label for="ugcgpa">UG Percentage</label>
                            <span class="input-group-text">Between</span>
                            <input class="form-control" type="number" name="ug" id="ugp">
                            <span class="input-group-text">AND</span>
                            <input class="form-control" type="number" name="eug" id="eugp">
                        </div>
                        <div class="col input-group-sm">
                            <label for="pgcgpa">PG Percentage</label>
                            <span class="input-group-text">Between</span>
                            <input class="form-control" type="number" name="pg" id="pgp">
                            <span class="input-group-text">AND</span>
                            <input class="form-control" type="number" name="epg" id="epgp">
                        </div>
                    </div><br>
                    
                    <input type="submit" value="Apply" class="btn btn-info">
                    
                </form>
                </div>
                
                <script>
                    function search()
                    {
                        var ten = document.getElementById('tenth').value;
                        var eten = document.getElementById('etenth').value;
                        var twel = document.getElementById('twelfth').value;
                        var etwel = document.getElementById('etwelfth').value;
                        var ug = document.getElementById('ug').value;
                        var eug = document.getElementById('eug').value;
                        var pg = document.getElementById('pg').value;
                        var epg = document.getElementById('epg').value;

                        var filter = new FormData();
                        //filter.append('roles',a);
                        if(ten && eten)
                        {
                            filter.append('ten',ten);
                            filter.append('eten',ten);
                        }
                        if(twel && etwel)
                        {
                            filter.append('twel',twel);
                            filter.append('etwel',etwel);
                        }
                        if(ug && eug)
                        {
                            filter.append('ug',ug);
                            filter.append('eug',eug);
                        }
                        if(pg && epg)
                        {
                            filter.append('pg',pg);
                            filter.append('epg',epg);
                        }
                        $.ajax({
                            url:"candidatefilter.php",
                            method:"POST",
                            data:filter,
                            processData: false,
		                    contentType: false
                        }).done(function(datum)
                        {
                            console.log(datum);
                        });

                        // var tencon = document.getElementById('tenselect').options.selectedIndex;
                        // var tensel = document.getElementById('tenselect').options.item(tencon).value;

                        // var twelcon = document.getElementById('tenselect').options.selectedIndex;
                        // var twelsel = document.getElementById('tenselect').options.item(twelcon).value;

                        // var ugcon = document.getElementById('tenselect').options.selectedIndex;
                        // var ugsel = document.getElementById('tenselect').options.item(ugsel).value;

                        // var pgcon = document.getElementById('tenselect').options.selectedIndex;
                        // var pgsel = document.getElementById('tenselect').options.item(pgcon).value;
                        // //console.log(tensel,ten);
                        
                    }
                </script>
                <?php
                            if($_SERVER['REQUEST_METHOD']=="POST"||isset($_SESSION['selectedrole']))
                            {
                                $selected = "";
                                if(isset($_POST['roles']))
                                {
                                    $_SESSION['selectedrole'] = $_POST['roles'];
                                }
                                $selected = $_SESSION['selectedrole'];
                                
                                $condition = "";
                                $ten=0;
                                $eten=0;
                                $twel=0;
                                $etwel=0;
                                $ug=0;
                                $eug=0;
                                $pg=0;
                                $epg=0;
                                if(isset($_POST['ten'])&&$_POST['ten']!="")
                                {
                                    $ten=$_POST['ten'];
                                    $eten=$_POST['eten'];
                                    $condition = "AND (per10 BETWEEN ".$ten." AND ".$eten.")";
                                    echo "<br>10th Percentage BETWEEN $ten AND $eten<br>";
                                }
                                if(isset($_POST['twel'])&&$_POST['twel']!="")
                                {
                                    $twel=$_POST['twel'];
                                    $etwel=$_POST['etwel'];
                                    $condition = "AND (per12 BETWEEN ".$twel." AND ".$etwel.")";
                                    echo "<br>12th Percentage BETWEEN $twel AND $etwel<br>";
                                }
                                if(isset($_POST['ug'])&&$_POST['ug']!="")
                                {
                                    $ug=$_POST['ug'];
                                    $eug=$_POST['eug'];
                                    $condition = "AND (ugcgpa BETWEEN ".$ug." AND ".$eug.")";
                                    echo "<br>UG CGPA BETWEEN $ug AND $eug<br>";
                                }
                                if(isset($_POST['pg'])&&$_POST['pg']!="")
                                {
                                    $pg=$_POST['pg'];
                                    $epg=$_POST['epg'];
                                    $condition = "AND (pgcgpa BETWEEN ".$pg." AND ".$epg.")";
                                    echo "<br>UG CGPA BETWEEN $pg AND $epg<br>";
                                }
                                
                                $sql = "select * from canfilter where selrole='$selected' ".$condition." AND vidscore IS NOT NULL AND application_id not in (select application_id from hires)";
                                //echo $sql;
                                $res = mysqli_query($conn,$sql);
                                if($res->num_rows>0)
                                {
                                    echo "<form method=\"POST\" action=\"selected.php\">";
                                    echo "<div class=\"table-responsive\">";
                                    echo "<table class = \"table\"><br><tr><thead class=\"table-dark\"><th>Candidate ID</th><th>Name</th><th>Gender</th><th>10th Percentage</th><th>12th Percentage</th><th>UG CGPA</th><th>PG CGPA</th><th>Work Experience</th><th>Projects</th><th>Internship</th><th>Area of Interests</th><th>Resume</th><th>Application No</th><th>Video Score</th><th>Select</th><th>Reject</th></tr></thead>";
                                    while($row = $res->fetch_assoc())
                                    {
                                        file_put_contents($row['id'].".pdf",$row['resume']);
                                        echo "<tr>";
                                        echo "<td>".$row['id']."</td>";
                                        echo "<td>".$row['name']."</td>";
                                        echo "<td>".$row['gender']."</td>";
                                        echo "<td>".$row['per10']."</td>";
                                        echo "<td>".$row['per12']."</td>";
                                        echo "<td>".$row['ugcgpa']."</td>";
                                        echo "<td>".$row['pgcgpa']."</td>";
                                        echo "<td>".$row['work']."</td>";
                                        echo "<td>".$row['projects']."</td>";
                                        echo "<td>".$row['intern']."</td>";
                                        echo "<td>".$row['interests']."</td>";
                                        echo "<td><button type=\"button\" class=\"btn btn-info\" data-bs-toggle=\"modal\" data-bs-target=\"#myModal\" onclick=\"display('".$row['id'].".pdf')\">".$row['name']."</button></td>";
                                        echo "<td>".$row['application_id']."</td>";
                                        echo "<td>".$row['vidscore']."</td>";
                                        echo "<td><input type=\"radio\" name=\"canset[]\" value=\"".$row['id']."/".$row['application_id']."/"."Selected"."\"</td>";
                                        echo "<td><input type=\"radio\" name=\"canset[]\" value=\"".$row['id']."/".$row['application_id']."/"."Rejected"."\"</td>";
                                        //echo "<td>".$row['cid']."</td>";
                                        //echo "<td>".$row['cid']."</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                    echo "<button type=\"submit\" class=\"btn btn-info\" value=\"Update\">Update</button>";
                                    echo "</div>";
                                    echo "</form>";
                                }
                                else
                                {
                                    echo "<br><br><h3>No records found</h3>";
                                }
                                echo "<script>sessionStorage.setItem(\"selitem\",\"$selected\")</script>";
                            }
                        ?>
                        
            </div>
        </div>
        
        <script src="../assets/canlist.js"></script>
        

    </body>
</html> 