<?php
    require_once 'controllers/auth_controller.php';
    include 'controllers/transaction_controller.php';
    
    if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
    }
    if (!isset($_GET['item_transac_id'])) {
        header('location: profile.php');
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
    <link rel="stylesheet" href="user_profile_style.css">
    <link rel="stylesheet" href="notification.css">
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
                    <a href="index.php" class="nav-item nav-link textcolor-black" alt="Home" data-toggle="tooltip" data-placement="bottom" title="Home"><i class="fas fa-home"></i></a>
                    <div class="btn-group dropleft">
                        <span class="nav-item nav-link textcolor-black" type="button" alt="Notification" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                        <div class="notification">
                        <span class="fas fa-bell"></span>
                        <span class="badge"><?php echo 2?></span>
                        </div>
                        </span>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php if(count($array) > 0): ?>
                                    <?php for ($x = 0; $x < count($array); $x++): ?>
                                        <div class="dropdown-item">
                                            <a href="#" class="dropdown-item" >
                                                <div class="">
                                                    <strong class=""><?php echo $array[$x]['item_owne']; ?></strong>
                                                        <div>
                                                        Offered you a <?php echo $array[$x]['item_name']; ?>
                                                        </div>
                                                    <small class="text-primary">13 Jan 2021, 9:18pm</small>
                                                </div> 
                                            </a>     
                                        </div>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="index.php?logout=1" class="nav-item nav-link textcolor-black" alt="Signout" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <div class="row justify-content-center mt-5 py-2" style="background:rgb(255, 255, 255); border-radius:2%;">
            <div class="col-5 my-3">
                <img src="product_images/<?php echo $offer['offer_imag'];?>" alt="" class="w-100">
                <hr>
                <div class="">
                    <h5><?php echo $offer['offer_name']; ?></h5>
                    <div class="d-flex justify-content-end">
                        <p><?php echo $offer['offer_owne']; ?></p>
                    </div>
                    Condition: <br>
                    <?php echo $offer['offer_cond']; ?> <br>
                    Description: <br>
                    <?php echo $offer['offer_desc'];?> <br>
                    Owner Address: <br>
                    <?php echo $user['address']; ?>
                </div>
            </div>
            <div class="col-5 my-3">
                <img src="product_images/<?php echo $item['item_imag'];?>" alt="" class="w-100">
                <hr>
                <div class="">
                    <h5><?php echo $item['item_name']; ?></h5>
                    <div class="d-flex justify-content-end">
                        <p><?php echo $item['item_owne']; ?></p>
                    </div>
                    Condition: <br>
                    <?php echo $item['item_cond']; ?> <br>
                    Description: <br>
                    <?php echo $item['item_desc'];?> <br>
                    Owner Address: <br>
                    <?php echo $_SESSION['address']; ?>
                </div>
            </div>
        </div>
        <form action="transaction.php" method="post">
        <div class="text-center py-3 my-3" style="background:rgb(255, 255, 255); border-radius:2%;">
            <div class=" py-5">
                <h5>Mode of transaction:</h5>
                <p class="text-secondary">Notice: Meetup mode of transaction is currently disabled due to ongoing pandemic</p>
                <div class="my-3">
                    <select name="select" class="btn btn-dark dropdown-toggle">
                        <option value="Shipping">Ship to Address</option>
                        <option value="Meetup" disabled>Meetup</option>
                    </select>
                </div>
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#confirmTrade">Confirm Trade</button>
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#rejectTrade">Reject Trade</button>
            </div>
        </div>
    </div>
    <!--CONFIRM TRADE MODAL-->
    <input type="hidden" name="id" value="<?php echo $_GET['item_transac_id']; ?>">
    <input type="hidden" name="user2" value="<?php echo $user['username']; ?>">
    <input type="hidden" name="location2" value="<?php echo $user['address']; ?>">
    <input type="hidden" name="item1" value="<?php echo $item['item_name']; ?>">
    <input type="hidden" name="item2" value="<?php echo $offer['offer_name']; ?>">
    <input type="hidden" name="contact2" value="<?php echo $user['phone']; ?>">
    <input type="hidden" name="email2" value="<?php echo $user['email']; ?>">
    <input type="hidden" name="item_id" value="<?php echo $offer['item_id']; ?>">
    <div class="modal fade" id="confirmTrade" tabindex="-1" role="dialog" aria-labelledby="confirmTrade" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm Trade?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        By clicking confirm trade, you will be accepting the trade from this user. <br>
                        Please check your details before your proceed.
                    </p>
                </div>
                <div class="modal-footer">    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="confirm_trade" class="btn btn-success" >Confirm Trade</button>                             
                </div>
            </div>
        </div>                                   
    </div>
    <!--REJECT TRADE MODAL-->
    <div class="modal fade" id="rejectTrade" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmation" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Reject Offer?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        This will remove the offer from your item. 
                    </p>
                </div>
                <div class="modal-footer">   
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="reject_trade" class="btn btn-danger" >Reject</button>                           
                </div>
            </div>
        </div>
    </div>
    </form>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>