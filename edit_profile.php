<?php
    require_once 'controllers/auth_controller.php';
    include 'controllers/profile_controller.php';
    
    if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/bt_icon_withouttext.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="interests_modal.css">
     <link rel="stylesheet" href="user_profile_style.css">
    <title>Bartrade</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white mb-3 sticky-top">
        <div class="container-fluid">
        <a href="index.php" class="navbar-brand"> <img src="images\bt_icon_withouttext.png" style="width: 75px;"></a>
            <div class="d-xl-none d-lg-none d-md-none" id="">
                <i class="fa fa-search"></i>
            </div>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="index.php?logout=1" class="nav-item nav-link textcolor-black"><strong> LOGOUT </strong></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="p-1 profile-sidebar">
                    <div class="mt-3">
                        <form action="edit_profile.php" method="post" enctype="multipart/form-data">
                            <div>
                                <?php if(!empty($msg)): ?>
                                    <?php if($msg === "OK"): ?>
                                        <?php header('location: profile.php'); ?>
                                    <?php endif; ?>
                                    <?php if($msg === "NOT OK"): ?>
                                        <?php echo $msg; ?><br>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if(!$_SESSION['profile_image']): ?>
                                <div class="picture">
                                <img
                                        class="rounded img-fluid mx-auto d-block"
                                        src="images/placeholder.png"
                                        onclick="trigger_click()"
                                        id = "profile_display"
                                        style="width: 50%"
                                    >
                                    <br>
                                </div>
                                <?php endif; ?>
                                <?php if($_SESSION['profile_image']): ?>
                                <div class="picture">
                                    <img
                                        class="rounded img-fluid mx-auto d-block"
                                        src="profile_images/<?php echo $_SESSION['profile_image']; ?>"
                                        onclick="trigger_click()"
                                        id = "profile_display"
                                        style="width: 50%;"
                                    >
                                </div>
                                    <br>
                                <?php endif; ?>
                             
                                <input
                                    type="file"
                                    onchange="display_image(this)"
                                    name="profile_image"
                                    id="profile_image"
                                    style="display: none;"
                                >
                            </div> 
                    </div>
                    <div class="d-grid gap-3 p-3">
                        <div class="profile-user-name">
                            <?php echo $_SESSION['username']; ?><br>
                        </div>
                        <div class="profile-user-rating">
                        <?php if ($_SESSION['rating']>=1) {
                         echo '<span style="font-size:15px;" class="fas fa-star"></span>';
                            } 
                                elseif ($_SESSION['rating']>=0.5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star-half-alt"></span>';
                            }
                                else{
                                echo '<span style="font-size:15px;" class="far fa-star"></span>';
                            }
                            ?>
                                        <?php if ($_SESSION['rating']>=2) {
                         echo '<span style="font-size:15px;" class="fas fa-star"></span>';
                            } 
                                elseif ($_SESSION['rating']>=1.5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star-half-alt"></span>';
                            }
                                else{
                                echo '<span style="font-size:15px;" class="far fa-star"></span>';
                            }
                            ?>
                                        <?php if ($_SESSION['rating']>=3) {
                         echo '<span style="font-size:15px;" class="fas fa-star"></span>';
                            } 
                                elseif ($_SESSION['rating']>=2.5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star-half-alt"></span>';
                            }
                                else{
                                echo '<span style="font-size:15px;" class="far fa-star"></span>';
                            }
                            ?>
                                        <?php if ($_SESSION['rating']>=4) {
                         echo '<span style="font-size:15px;" class="fas fa-star"></span>';
                            } 
                                elseif ($_SESSION['rating']>=3.5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star-half-alt"></span>';
                            }
                                else{
                                echo '<span style="font-size:15px;" class="far fa-star"></span>';
                            }
                            ?>
                            <?php if ($_SESSION['rating']>=5) {
                         echo '<span style="font-size:15px;" class="fas fa-star"></span>';
                            } 
                                elseif ($_SESSION['rating']>=4.5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star-half-alt"></span>';
                            }
                                else{
                                echo '<span style="font-size:15px;" class="far fa-star"></span>';
                            }
                            ?>
                            <?php echo $_SESSION['rating']; ?><br>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div class="mx-2">
                                <label for="bio">Bio</label><br>
                                <textarea name="bio" maxlength="160"><?php echo $_SESSION['bio']; ?></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
    <div class="modal fade" id="interestsModal" tabindex="-1" role="dialog" aria-labelledby="interestsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="interestsModalLabel">Please choose your interests:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox image-checkbox" >
                        <input name="interests[]" type="checkbox" class="custom-control-input" id="ck1a" value="technology"
                        <?php echo (strpos($_SESSION['interests'],'technology')>-1?'checked':'');?>>
                            <label class="custom-control-label" for="ck1a">
                                <img src="images\technology.jpg" alt="technology" class="img-fluid">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox image-checkbox" value="plants">
                            <input name="interests[]" type="checkbox" class="custom-control-input" id="ck1b" value="plants"
                            <?php echo (strpos($_SESSION['interests'],'plants')>-1?'checked':'');?>>
                            <label class="custom-control-label" for="ck1b">
                                <img src="images\plants cat.jpg" alt="plants" class="img-fluid">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox image-checkbox">
                            <input name="interests[]" type="checkbox" class="custom-control-input" id="ck1c" value="clothes"
                            <?php echo (strpos($_SESSION['interests'],'clothes')>-1?'checked':'');?>>
                            <label class="custom-control-label" for="ck1c">
                                <img src="images\clothes.jpg" alt="clothes" class="img-fluid">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox image-checkbox">
                            <input name="interests[]" type="checkbox" class="custom-control-input" id="ck1d" value="automotives"
                            <?php echo (strpos($_SESSION['interests'],'automotives')>-1?'checked':'');?>>
                            <label class="custom-control-label" for="ck1d">
                                <img src="images\automotives.jpg" alt="automotives" class="img-fluid">
                            </label>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" data-dismiss="modal">Okay</button>
        </div>
        </div>
    </div>
    </div>
            <div class="my-1">
                <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#interestsModal">Interests</button>
            </div>
            <div>
                <button type="submit" onclick="current()" name="save_button" class="btn btn-dark btn-sm my-3">Save</button>
            </div>
        </form>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <?php if(!$_SESSION['verified']): ?>
                                Status: unverified<br>
                            <?php endif; ?>
                            <?php if($_SESSION['verified']): ?>
                                Status: verified<br>
                            <?php endif; ?>
                        
                            Email: <?php echo $_SESSION['email']; ?><br>
                            Phone: <?php echo $_SESSION['phone']; ?><br>
                        </div>
                    
                        <div class="p-3">
                                       <!-- RATING AND REVIEWS DISPLAY -->    
        <div class="">
           User Rating and Reviews:
           <br>
           <?php if(count($arrayRATINGS) > 0): ?>
                                <?php for ($x = 0; $x < count($arrayRATINGS); $x++): ?>
            <!--Start of rating display loop--> 
                <?php if ($arrayRATINGS[$x]['rating']  >=1) {
                         echo '<span style="font-size:10px;" class="fas fa-star"></span>';
                } 
                    else{
                    echo '<span style="font-size:10px;" class="far fa-star"></span>';
                }
             ?> 
                <?php if ($arrayRATINGS[$x]['rating']  >=2) {
                         echo '<span style="font-size:10px;" class="fas fa-star"></span>';
                } 
                    else{
                    echo '<span style="font-size:10px;" class="far fa-star"></span>';
                }
             ?>   
                <?php if ($arrayRATINGS[$x]['rating']  >=3) {
                         echo '<span style="font-size:10px;" class="fas fa-star"></span>';
                } 
                    else{
                    echo '<span style="font-size:10px;" class="far fa-star"></span>';
                }
             ?>   
                <?php if ($arrayRATINGS[$x]['rating']  >=4) {
                         echo '<span style="font-size:10px;" class="fas fa-star"></span>';
                } 
                    else{
                    echo '<span style="font-size:10px;" class="far fa-star"></span>';
                }
             ?>   
                <?php if ($arrayRATINGS[$x]['rating']  >=5) {
                         echo '<span style="font-size:10px;" class="fas fa-star"></span>';
                } 
                    else{
                    echo '<span style="font-size:10px;" class="far fa-star"></span>';
                }
             ?>     
                    by  <?php echo $arrayRATINGS[$x]['username'];?>   <br>
                         <?php echo $arrayRATINGS[$x]['review']; ?>      
                                <br>                      
                                    <?php endfor; ?>
                            <?php endif; ?>  
        </div>
        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="p-1 profile-feed">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="text-left">Edit Profile</div>
                            </div>
                            <div class="col-sm-4">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-3"></div>

                <div class="p-1 profile-feed2">
                    <div class="p-3">
                        <div class="container py-5">
                        <p class="text-center" style="color: #e84118;"><?php if($_SESSION['verified'] == 0) {
                                    echo "You have to be verified before you can make any transaction. <br> To enjoy our features, please verify your account.";
                                }?></p>
                            <div class="row py-5">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

        </div>
    </div>

    <script>
        function trigger_click() {
            document.querySelector('#profile_image').click();
        }

        function display_image(e) {
            if (e.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.querySelector('#profile_display').setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>