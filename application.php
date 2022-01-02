<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Requisites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/index.css">
    <script src="assets/application.js"></script>
</head>
<body>
    <header class="d-flex justify-content-left align-items-center py-2 border-bottom bg-light">
          <img src="assets/images/logo.png" alt="No Image" id="logo" style="margin-left: 2%;">
          <h4 class="fs-4" id="companytitle" style="margin-left: 2%;">JobQualifier</h4>
      </header>
      <br>
      <div class="container" name="details" style="max-width: fit-content;">
        <div class="progress">
            <div class="progress-bar" style="width:25%">1</div>
        </div><br>
        <div class="container">
            <form action="questions.php" method="post" class="needs-validation">
                <div class="form-group">
                    <label for="jobpost">POST</label>
                    <input type="text" name="cjobpost" id="jobpost" value = "<?php $posting = $_GET['post']; echo $posting;?>" class="form-control" disabled>
                        
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"></div>
                </div><br>
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="firstname" id="fname" class="form-control" required/>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"></div>
                </div><br>
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lastname" id="lname" class="form-control" required/>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"></div>
                </div><br>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="clocation" id="location" class="form-control" required/>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"></div>
                </div><br>
                <div class="form-group">
                    <label for="project">Projects</label>
                    <input type="text" name="cproject" id="project" class="form-control" required/>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"></div>
                </div><br>
                <div class="form-group">
                    <label for="resume">Resume</label>
                    <input type="file" name="cresume" id="resume" class="form-control" accept=".pdf" required/>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"></div>
                </div><br>
                <div class="form-group">
                    <input type="submit" id="submit" class="form-control"/>
                </div>
            </form>

        </div>
      </div>
</body>
</html>