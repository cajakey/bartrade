<?php
    require_once 'controllers/admin_controller.php';
    include 'controllers/admin_home_controller.php';
    if (isset($_GET['password_token'])) {
        $password_token = $_GET['password_token'];
        reset_password($password_token);
    }

    if (!isset($_SESSION['admin_id'])) {
        header('location: admin_login.php');
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
    <nav class="navbar navbar-expand-md navbar-light bg-white mb-3 sticky-top">
        <div class="container-fluid">
            <a href="admin_home.php" class="navbar-brand textcolor-black"> <strong>BARTRADE</strong> </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="admin_home.php?logout=1" class="nav-item nav-link textcolor-black"><strong> LOGOUT </strong></a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="bg">
    <div class="container-fluid h-100">
        <div class="row align-items-center h-100">
        <div class="card mx-auto px-5 py-5">
            <div>
                Deactivate an account:
            </div> 
            <form action="admin_home.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="account_id" id="account_id">
                <?php if(count($accountArray) > 0): ?>
                    <?php for ($x = 0; $x < count($accountArray); $x++): ?> 
                        <div class="container">
                            <?php echo $accountArray[$x]['username']; ?>
                            <?php if ($accountArray[$x]['deactivate']==0): ?>
                                <a id="<?php echo $accountArray[$x]['id']; ?>" onclick="get_id(this.id)"  class="btn fas fa-user-times" data-toggle="modal" data-target="#deactivateAccount"></a>
                            <?php endif;?>
                            <?php if ($accountArray[$x]['deactivate']==1): ?>       
                                <a id="<?php echo $accountArray[$x]['id']; ?>" onclick="get_id(this.id)"  class="btn fas fa-user-check" data-toggle="modal" data-target="#reactivateAccount"></a>
                            <?php endif;?><br>
                            Report: <?php echo $accountArray[$x]['report']; ?>           
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>
                    Add category:<br>
                    <input type="text" name="category">
                    <button type="submit" name="add_button" class="btn btn-dark">Add</button>
                <!--Deactivate Account Modal -->
                <div class="modal fade" id="deactivateAccount" tabindex="-1" role="dialog" aria-labelledby="deactivation" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Deactivate Account?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p> This will <span style="color:red;"> deactivate </span> this account. Deactivation can be undone. </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="deactivate_button" class="btn btn-dark" >Deactivate</button>
                            </div>
                        </div>
                    </div>
                </div>  
                <!-- Reactivate Account Modal -->
                <div class="modal fade" id="reactivateAccount" tabindex="-1" role="dialog" aria-labelledby="reactivation" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Reactivate Account?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p> This will <span style="color:green;"> reactivate </span> this account. </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="reactivate_button" class="btn btn-success" >Reactivate</button>
                            </div>
                        </div>
                    </div>
                </div>   
            </form>
        </div>
        </div>
    </div>
    </div>

    <script>
        function get_id(id) {
            document.getElementById("account_id").value = id;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>