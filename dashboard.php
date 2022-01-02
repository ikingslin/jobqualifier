<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/index.css">
</head>
<body>
    <header class="d-flex flex-wrap justify-content-left py-2 border-bottom bg-light">
        <div class="d-flex align-items-center  me-md-auto">
            <img src="assets/images/logo.png" alt="No Image" id="logo" style="margin-left: 2%;">
            <h4 class="fs-4" id="companytitle" style="margin-left: 2%;">JobQualifier</h4>
            <span>AdminConsole</span>
        </div>
        
        <ul class="nav nav-pills align-items-center" style="margin-right:2%">
            <li class="nav-item">
                <a href="index.html">Logout</a>
            </li>
        </ul>
    </header><br>
    <div class="d-flex" style = "height:85vh;max-height:100%;min-height:fitcontent">
        <div class="container-fluid  border-end" style ="max-width:fit-content">
            <ul class="list-group" style = "text-decoration:none;">
                <li class="list-group-item"><a href="home.html" target="maincontent">Home</a></li>
                <li class="list-group-item"><a href="#" target="maincontent">Drive Settings</a></li>
                <li class="list-group-item"><a href="#" target="maincontent">Candidate Filtering</a></li>
                <li class="list-group-item"><a href="index.html">Logout</a></li>
            </ul>
        </div>
        <div class="container-fluid embed-responsive">
        <iframe src="home.html" name="maincontent" class="embed-responsive-item col-sm-12" style="height:85vh;"></iframe>

        </div>
    </div>
</body>
</html>