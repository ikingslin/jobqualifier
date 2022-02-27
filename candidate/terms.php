<?php 
  if(!isset($_SESSION)) 
  { 
    session_start(); 
  }
  $conn = mysqli_connect("localhost","root","","jobqualifier");
  if(!$conn)
  {
    die("Connection to DB failed with : ".mysqli_connect_error());
  }
    $rol = $_GET['roleid'];
    $_SESSION['roleid'] =$rol;
    $roles = 'select `Name`,`qualification`,`requirement` from roles where roleid = \''.$rol.'\';';
    $result = mysqli_query($conn,$roles);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Terms and Conditions</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../assets/index.css">
        <link rel="stylesheet" href="../assets/sidebar.css">
        <script src="../assets/application.js"></script>
    </head>
    <body onload="allows()">
        <header class="d-flex flex-wrap justify-content-left py-2 border-bottom bg-light">
            <div class="d-flex align-items-center  me-md-auto">
                <img src="../assets/images/logo.webp" alt="No Image" id="logo" style="margin-left: 2%;" class="rounded">
                <h5 class="fs-2 companytitle" style="margin-left: 2%;">JobQualifier</h5>
            </div>
            
            <ul class="nav nav-pills align-items-center" style="margin-right:2%">
                <li class="nav-item" style="margin-right:15px;">
                    <?php echo $_SESSION['login_name'];?>
                </li>
                <li class="nav-item">
                    <a href="../logout.php">
                        <input type="button" value="Logout"  class="btn btn-primary">
                    </a>
                </li>
            </ul>
        </header>
        <div class="sidebar">
            <a href="../candidatedashboard.php">Home</a>
            <a href="editProfile.php">Profile Edit</a>
            <a class="active"href="selectapplication.php">Apply for job</a>
            <a href="candidate/statusview.php">Status of Application</a>
            <a href="../logout.php">Logout</a>
        </div>

        <div class="content">
          <div class="container">
          <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" ></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <b class="fs-3">Read before proceeding:</b><br>
                            <p>The Candidate will have 15 seconds to read and preapre an answer for the given question.</p>
                            <p>The Answers can be for 60 seconds duration.</p>
                            <p>The portal will proceed to the next question immediately after recording the response.</p>        
                        </div>
                    </div>

                    <div class="modal-footer">
                        <form action="questions.php" method="post">
                            <input type="hidden" name="role" value="<?= $rol?>" />
                            <input type="submit" value="Agree" id = "capplication" class="btn btn-success">
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">DisAgree</button>
                    </div>

                </div>
            </div>
        </div>
          <?php 
                if($result){
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<center><span class=\"fs-2\">";
                            echo $row['Name']." Application";
                            echo "</span></center>";
                            echo "<b class=\"fs-4\">Qualification:</b><br>\t\t\t\t\t\t\t".$row['qualification']."<br><br>";
                            echo "<b class=\"fs-4\">Requirements:</b><br>\t\t\t\t\t\t\t".$row['requirement']."<br><br>";
                        }
                    }
                }
                mysqli_close($conn);
            ?>
            <b class="fs-3">Read before proceeding:</b><br>
            <p>The Candidate will have 15 seconds to read and preapre an answer for the given question.</p>
            <p>The Answers can be for 60 seconds duration.</p>
            <p>The portal will proceed to the next question immediately after recording the response.</p>
            <b class="fs-3">Terms and Conditions:</b><br>
            <p>I understand that all employment offers are contingent upon the results of employment and educational background checks.</p>
            <p>I agree to execute any consent forms necessary for R/GA to conduct its lawful pre-employment checks.</p>
            <p>By submitting this form, I authorize all present or prior employers, schools, companies, corporations, credit bureaus and law enforcement agencies to supply R/GA with any information concerning my background, and hereby release them from any liability and responsibility arising from their doing so.</p>
            <p>I understand that all employment offers are contingent upon the results of employment and educational background checks. </p>
            <p>Should my employment terminate, I understand that R/GA may supply my complete record in response to any bona fide request, and I hereby release R/GA and any of its staff from any liability and responsibility in connection therewith.</p>
            <p>If hired, I agree to abide by all of the Company rules and regulations. I agree that in the event R/GA should employ me, my employment may be terminated at any time by either party for any reason or for no reason.</p>
            <input type="checkbox" name="cagreement" id="agreement" onchange="allows()"/> I agree<br><br>

            
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="oapplication">Agree</button>

            </div>
            <br><br>
      </div>
</body>
</html>