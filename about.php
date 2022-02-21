<?php
    require_once 'controllers/auth_controller.php';

    if (isset($_SESSION['id'])) {
        header('location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bartrade</title>
    <link rel="icon" href="images/bt_icon_withouttext.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="general_styles.css">
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-light bg-white mb-3 sticky-top">
        <div class="container-fluid">
        <a href="index.php" class="navbar-brand textcolor-black"> <img src="images\bt_icon_withouttext.png" style="width: 75px;"></a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="login.php" class="nav-item nav-link textcolor-black"><strong> LOGIN </strong></a>
                    <a href="register.php" class="nav-item nav-link textcolor-black"><strong> REGISTER </strong></a>
                    <a href="about.php" class="nav-item nav-link textcolor-black"><strong> ABOUT BARTRADE </strong></a>
                </div>
            </div>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mx-auto">
                <img src="images\about2.jpg" alt="" style="">
            </div>
            <div class="col-8 mx-auto text-center py-5">
                <h1><strong>Bartrade is the leading e-Trading platform for bartering in Southeast Asia</strong></h1>
                <p class="lead text-muted">Founded and launched in 2020, an e-Trading platform providing customers and traders with an easy, secure, and fast online barter experience</p>
            </div>
            <div class="col-12 mx-auto">
                <img src="images\about1.jpg" alt="">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>