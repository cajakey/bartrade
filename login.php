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

    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-md-8 col-lg-8 col-xl-8 box">
                <img src="images\login-bg.jpg" class="rounded">
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4  my-auto">
                <h1 class="py-4 mt-3"><strong>Login</strong></h1>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email or username" name="username" value="<?php echo $username; ?>">
                    </div>
                    <div class="form-group pb-3">
                        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                        <?php if(count($errors) > 0): ?>
                        <p>
                            <?php foreach($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </p>
                        <?php endif; ?>
                        <div class="mt-3">
                            <a href="forgot_password.php" class="textcolor-black">Forgot Password?</a> <br>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark w-50" name="login_button">Login</button>
                </form>
                <div class="my-3">
                    Not a member? <a href="register.php" class="textcolor-black">Register.</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>