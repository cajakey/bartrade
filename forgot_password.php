<?php require_once 'controllers/auth_controller.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bartrade</title>
    <link rel="icon" href="images/bt_icon_withouttext.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="fp_style.css">
    <link rel="stylesheet" href="general_styles.css">
</head>
<body>
    <div class="bg">
        <div class="container-fluid h-100">
            <div class="row align-items-center h-100">
                <div class="col-lg-4 col-xl-4 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-body rounded">
                            <form action="forgot_password.php" method="post">
                                <h3>Recover your password</h3>
                                <p>
                                    Please enter your email address you used to sign up on this site
                                    and we will assist you in recovering your password.
                                </p>
                                <?php if(count($errors) > 0): ?>
                                    <p>
                                        <?php foreach($errors as $error): ?>
                                            <li><?php echo $error; ?></li>
                                        <?php endforeach; ?>
                                    </p>
                                <?php endif; ?>
                                <div>
                                    <input type="email" name="email" placeholder="Enter Email Address" class="form-control">
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <button type="button" name="cancel" value="cancel" onClick="window.location.href='login.php';" class="btn-dark my-2 rounded mx-2">Cancel</button>
                                    <button type="submit" name="forgot_password" class="btn-dark my-2 rounded">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>