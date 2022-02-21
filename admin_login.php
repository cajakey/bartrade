<?php
    require_once 'controllers/admin_controller.php';

    if (isset($_SESSION['admin_id'])) {
        header('location: admin_home.php');
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
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="bg">
    <div class="container-fluid h-100">
    <div class="row align-items-center h-100">
        <div class="col-lg-4 col-xl-4 col-md-8 mx-auto">
        <div class="card">
            <div class="card-body rounded">
            <a href=""> <img src="images\bt_icon_withtext.png" alt="" style="width: 125px;" class="mx-auto mt-3"></a>
                <br>
                <h1 class="text-center pb-3"><strong>Login</strong></h1>
                <form action="admin_login.php" method="post">
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
                            <a href="admin_forgot.php" class="textcolor-black">Forgot Password?</a> <br>
                        </div>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn btn-dark w-50" name="login_button">Login</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
     </div>
    </div>
 
    </div>

    <script type="text/javascript">
        var alerted = localStorage.getItem('alerted') || '';
        if (alerted != 'yes') {
            alert("You are about to enter admin's login page");
            localStorage.setItem('alerted','yes');
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>