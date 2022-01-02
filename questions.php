<?php
    $conn = mysqli_connect("localhost","root","","jobqualifier");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/index.css">
</head>
<body>
    <header class="d-flex justify-content-left align-items-center py-2 border-bottom bg-light">
          <img src="assets/images/logo.png" alt="No Image" id="logo" style="margin-left: 2%;">
          <h4 class="fs-4" id="companytitle" style="margin-left: 2%;">JobQualifier</h4>
      </header><br>
      
    <div class="container" style="max-width: fit-content;">
        <div class="progress">
            <div class="progress-bar" style="width:50%">2</div>
        </div><br>
        <span class="fs-3" id="ques">Question</span><br>
        <span class="fs-5" id="cquestion"></span><br>
        <input type="file" accept="image/*;capture=camera"><br><br>
        <button class="btn btn-success">Upload</button>
    </div>
</body>
</html>