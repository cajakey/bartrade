<?php
    require_once 'controllers/auth_controller.php';
    include 'controllers/feed_controller.php';
    
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
        <div class="row profile">
            <div class="col-md-3">
                <div class="p-1 profile-sidebar">
                    <div class="mt-3">
                        <?php if(!$_SESSION['profile_image']): ?>
                            <img src="images/placeholder.png"  class="rounded-circle img-fluid mx-auto d-block"><br>
                        <?php endif; ?>
                        <?php if($_SESSION['profile_image']): ?>
                            <img src="profile_images/<?php echo $_SESSION['profile_image']; ?>" class="rounded-circle img-fluid mx-auto d-block"><br>
                        <?php endif; ?> 
                    </div>
                    <div class="d-grid gap-3 p-3">
                        <div class="profile-user-name text-center">
                            <?php echo $_SESSION['username']; ?><br>
                        </div>
                        <div class="profile-user-rating text-center">
                            <?php
                                if ($_SESSION['rating']>=1) {
                                    echo '<span style="font-size:15px;" class="fas fa-star"></span>';
                                } 
                                elseif ($_SESSION['rating']>=0.5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star-half-alt"></span>';
                                }
                                else {
                                    echo '<span style="font-size:15px;" class="far fa-star"></span>';
                                }
                            ?>
                            <?php
                                if ($_SESSION['rating']>=2) {
                                    echo '<span style="font-size:15px;" class="fas fa-star"></span>';
                                } 
                                elseif ($_SESSION['rating']>=1.5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star-half-alt"></span>';
                                }
                                else {
                                    echo '<span style="font-size:15px;" class="far fa-star"></span>';
                                }
                            ?>
                            <?php
                                if ($_SESSION['rating']>=3) {
                                    echo '<span style="font-size:15px;" class="fas fa-star"></span>';
                                } 
                                elseif ($_SESSION['rating']>=2.5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star-half-alt"></span>';
                                }
                                else {
                                    echo '<span style="font-size:15px;" class="far fa-star"></span>';
                                }
                            ?>
                            <?php
                                if ($_SESSION['rating']>=4) {
                                    echo '<span style="font-size:15px;" class="fas fa-star"></span>';
                                } 
                                elseif ($_SESSION['rating']>=3.5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star-half-alt"></span>';
                                }
                                else {
                                    echo '<span style="font-size:15px;" class="far fa-star"></span>';
                                }
                            ?>
                            <?php
                                if ($_SESSION['rating']>=5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star"></span>';
                                } 
                                elseif ($_SESSION['rating']>=4.5) {
                                    echo '<span style="font-size:15px;" class="fas fa-star-half-alt"></span>';
                                }
                                else {
                                    echo '<span style="font-size:15px;" class="far fa-star"></span>';
                                }
                            ?>
                            <?php echo $_SESSION['rating']; ?><br>
                        </div>
                        <hr>
                        <div class="text-break">
                            <div class="mb-3">
                                Bio:
                                <br>
                                    <?php echo $_SESSION['bio'];?>
                                <br>
                            </div>
                        </div>
                        <div class="mb-3">
                            Interests:<br>
                            <?php 
                                $showInterests = explode(",", $_SESSION['interests']);
                                foreach ($showInterests as $value) {
                                    echo $value, "<br>";
                                }
                            ?>
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
                        <div class="mb-3">
                            <a class="btn btn-dark btn-sm" href="edit_profile.php">Edit</a>
                        </div>
                        <br>
                        <hr>
                        <!-- RATING AND REVIEWS DISPLAY -->    
                        <div class="">
                            User Rating and Reviews:<br>
                        <?php if(count($arrayRATINGS) > 0): ?>
                                <?php for ($x = 0; $x < count($arrayRATINGS); $x++): ?>
                                    <!--Start of rating display loop--> 
                                    <?php
                                        if ($arrayRATINGS[$x]['rating']  >=1) {
                                            echo '<span style="font-size:10px;" class="fas fa-star"></span>';
                                        } 
                                        else {
                                            echo '<span style="font-size:10px;" class="far fa-star"></span>';
                                        }
                                    ?> 
                                    <?php
                                        if ($arrayRATINGS[$x]['rating']  >=2) {
                                            echo '<span style="font-size:10px;" class="fas fa-star"></span>';
                                        } 
                                        else {
                                            echo '<span style="font-size:10px;" class="far fa-star"></span>';
                                        }
                                    ?>   
                                    <?php
                                        if ($arrayRATINGS[$x]['rating']  >=3) {
                                            echo '<span style="font-size:10px;" class="fas fa-star"></span>';
                                        } 
                                        else {
                                            echo '<span style="font-size:10px;" class="far fa-star"></span>';
                                        }
                                    ?>   
                                    <?php
                                        if ($arrayRATINGS[$x]['rating']  >=4) {
                                            echo '<span style="font-size:10px;" class="fas fa-star"></span>';
                                        } 
                                        else {
                                            echo '<span style="font-size:10px;" class="far fa-star"></span>';
                                        }
                                    ?>   
                                    <?php
                                        if ($arrayRATINGS[$x]['rating']  >=5) {
                                            echo '<span style="font-size:10px;" class="fas fa-star"></span>';
                                        } 
                                        else {
                                            echo '<span style="font-size:10px;" class="far fa-star"></span>';
                                        }
                                    ?>     
                                    by  <?php echo $arrayRATINGS[$x]['username'];?><br>
                                        <?php echo $arrayRATINGS[$x]['review']; ?><br>                      
                                <?php endfor; ?>
                            <?php endif; ?>  
                        </div>
                    </div>
                </div>
                <div class="p-3"></div>
            </div>

            <div class="col-md-9">
                <div class="p-1 profile-feed">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="text-left">User's Feed</div>
                            </div>
                            <div class="col-sm-4">
                                <?php if(!$_SESSION['verified']): ?>
                                    <button type="button" data-toggle="modal" data-target="#post_modal" class="btn btn-dark btn-sm float-right" disabled>Post Item</button>
                                <?php endif; ?>
                                <?php if($_SESSION['verified']): ?>
                                    <button type="button" data-toggle="modal" data-target="#post_modal" class="btn btn-dark btn-sm float-right">Post Item</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Post an Item Modal -->
                <div class="modal fade" id="post_modal" tabindex="-1" role="dialog" aria-labelledby="postItem" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="post_modal">Create Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="profile.php" method="post" enctype="multipart/form-data">
                                <input type="text" name="item_name" onkeyup="success()" placeholder="Item name" id="itemName" class="form-control inputField"><br>
                                <select name="item_cond" id="itemCondition" onchange="success()" class="btn btn-dark dropdown-toggle mb-3 ">
                                    <option value="">-- select --</option>
                                    <option value="New">New</option>
                                    <option value="Used (like new)">Used (like new)</option>
                                    <option value="Used (very good)">Used (very good)</option>
                                    <option value="Used (good)">Used (good)</option>
                                    <option value="Used (acceptable)">Used (acceptable)</option>
                                </select><br>
                                <input type="text" name="item_desc" onkeyup="success()" placeholder="Item description" id="itemDesc" class="form-control inputField"><br>
                                <select name="item_cate" id="itemCategory" onchange="success()" class="btn btn-dark dropdown-toggle mb-3 ">
                                    <option value="">-- select --</option>
                                    <?php if(count($arrayCATEGORY) > 0): ?>
                                        <?php for ($x = 0; $x < count($arrayCATEGORY); $x++): ?>
                                            <option value="<?php echo $arrayCATEGORY[$x]['category']; ?>"><?php echo $arrayCATEGORY[$x]['category']; ?></option>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </select><br>
                                <p>Add photo:</p> 
                                <input type="file" name="item_imag" id="itemImage" onchange="success()"><br>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="submit" name="submit_button" id="postItem" class="btn btn-dark" style="width:90%" disabled>Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- USER'S FEED -->
                <div class="p-3"></div>
                <div class="p-1 profile-feed2">
                    <div class="p-3">
                        <div class="container py-5">
                            <p class="text-center" style="color:#e84118;">
                                <?php
                                    if ($_SESSION['verified'] == 0) {
                                        echo "You have to be verified before you can make any transaction.<br>To enjoy our features, please verify your account.";
                                    }
                                ?>
                            </p>
                            <!--
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js"></script>
                            <script type="text/javascript">
                                function send_value(id) {
                                    $.ajax ({
                                        type: "post",
                                        url: "profile.php",
                                        data: {'id': id}
                                    });
                                }
                            </script>
                            -->
                            <form action="profile.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="item_id" id="item_id">
                            <div class="text-center">Posts</div>
                            <?php if(count($array) > 0): ?>
                                <?php for ($x = 0; $x < count($array); $x++): ?>
                                    <div class="row py-5">
                                        <div class="card mx-auto mb-3 h-25 w-75">
                                            <img src="product_images/<?php echo $array[$x]['item_imag']; ?>" class="card-img img-fluid mb-3 w-100">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $array[$x]['item_name']; ?></h5>
                                                <p class="card-text"><?php echo $array[$x]['item_cond']; ?><br><?php echo $array[$x]['item_desc']; ?></p>
                                                <button id="<?php echo $array[$x]['id']; ?>" onclick="get_id(this.id)" type="button" data-toggle="modal" data-target="#editItemButton" class="btn btn-dark">Edit</button>
                                                <button id="<?php echo $array[$x]['id']; ?>" onclick="get_id(this.id)" type="button" data-toggle="modal" data-target="#deleteButton" class="btn btn-dark">Delete</button>
                                                <hr>
                                                <div class="container">
            
                                                    <?php 
                                                        $arrayITEMOFFERS = array();
                                                        $item_id = $array[$x]['id'];
                                                        $sql = "SELECT * FROM offers WHERE item_id='$item_id'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $index = 0;
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $arrayITEMOFFERS[$index] = $row;
                                                            $index++;
                                                        } 
                                                    ?> 
                                                    <?php if(count($arrayITEMOFFERS) > 0): ?>
                                                        <?php for ($z = 0; $z < count($arrayITEMOFFERS); $z++): ?>
                                                            <div class="row my-2">
                                                                <div class="col-4">
                                                                    <?php echo $arrayITEMOFFERS[$z]['offer_name'] ?>
                                                                    <p style="color:blue;"><?php echo $arrayITEMOFFERS[$z]['offer_owne'] ?></p>
                                                                </div>
                                                             
                                                                <div class="col-4">
                                                                    <a href="" id="item_transac_id" style="display: none"></a>        
                                                                    <a id="<?php echo $arrayITEMOFFERS[$z]['id']; ?>" onclick="get_item(this.id)" type="button" class="btn btn-dark w-100">View</a>
                                                                    <!--  data-toggle="modal" data-target="#acceptOfferModal" -->
                                                                </div>

                                                                <div class="col-4">
                                                                    <button class="btn btn-danger w-100" type="button" id="<?php echo $arrayITEMOFFERS[$z]['id']; ?>" onclick="get_id(this.id)" data-toggle="modal" data-target="#deleteOfferModal">Reject</button>
                                                                </div>
                                                            </div>
                                                        <?php endfor; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            <?php endif; ?>
                            <!-- OFFERS -->
                            <div class="text-center">Offers</div>
                            <a href="" id="owner" style="display:none"></a>
                            <?php if(count($arrayOFFERS) > 0): ?>
                                <?php for ($x = 0; $x < count($arrayOFFERS); $x++): ?>
                                    <div class="row py-5">
                                        <div class="card mx-auto mb-3 h-25 w-75">
                                            <img src="product_images/<?php echo $arrayOFFERS[$x]['offer_imag']; ?>" class="card-img img-fluid mb-3 w-100">
                                            <div class="card-body">
                                               
                                                <h5 class="card-title"><?php echo $arrayOFFERS[$x]['offer_name']; ?></h5>
                                                <p class="card-text"><?php echo $arrayOFFERS[$x]['offer_cond']; ?><br><?php echo $arrayOFFERS[$x]['offer_desc']; ?></p>
                                                Offered for:
                                                <?php 
                                                    $item_id = $arrayOFFERS[$x]['item_id'];
                                                    $sql = "SELECT * FROM items WHERE id='$item_id'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $arrayITEMS = mysqli_fetch_assoc($result);
                                                    echo $arrayITEMS['item_name'];
                                                ?><br>
                                                Item Owner: <a id="<?php echo $arrayITEMS['item_owne']; ?>" onclick="get_owner(this.id)" type="button" class="card-text"><?php echo $arrayITEMS['item_owne']; ?></a><br><br>
                                                <button id="<?php echo $arrayOFFERS[$x]['id']; ?>" onclick="get_id(this.id)" type="button" data-toggle="modal" data-target="#editOfferButton" class="btn btn-dark">Edit</button>
                                                <button id="<?php echo $arrayOFFERS[$x]['id']; ?>" onclick="get_id(this.id)" type="button" data-toggle="modal" data-target="#cancelButton" class="btn btn-dark">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            <?php endif; ?>
                            <!-- Accept item offer modal -->
                                 <div class="modal fade" id="acceptOfferModal" tabindex="-1" role="dialog" aria-labelledby="Accept" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Accept Offer?</h5>
                                            
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                            <p>This item will be traded to this user</p>
                                                By selecting proceed, you will be redirected to the transaction page.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a type="button" name="accept_offer" class="btn btn-success">Proceed</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete item confirmation modal -->
                            <div class="modal fade" id="deleteButton" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmation" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Item?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Deleting this item cannot be undone and it will be removed from your account. 
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="delete_button" class="btn btn-dark" >Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- Reject item offer modal -->
                             <div class="modal fade" id="deleteOfferModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmation" aria-hidden="true">
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
                                            <button type="submit" name="reject_offer" class="btn btn-danger" >Reject</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Cancel offer confirmation modal -->
                            <div class="modal fade" id="cancelButton" tabindex="-1" role="dialog" aria-labelledby="cancelConfirmation" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Cancel Offer?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Deleting this offer cannot be undone and it will be removed from your account. 
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="cancel_button" class="btn btn-dark" >Reject</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit item modal -->
                            <div class="modal fade" id="editItemButton" tabindex="-1" role="dialog" aria-labelledby="editItemModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="item_desc" id="editItemDesc" onkeyup="editItemSuccess()" placeholder="Item description" class="form-control"><br>
                                            <select name="item_cond" id="editItemCondition" onchange="editItemSuccess()" class="btn btn-dark dropdown-toggle mb-3 ">
                                                <option value="">-- select --</option>
                                                <option value="New">New</option>
                                                <option value="Used (like new)">Used (like new)</option>
                                                <option value="Used (very good)">Used (very good)</option>
                                                <option value="Used (good)">Used (good)</option>
                                                <option value="Used (acceptable)">Used (acceptable)</option>
                                            </select><br>
                                            <p>Change photo:</p> 
                                            <input type="file" name="item_imag" id="editItemImage" onchange="editItemSuccess()"><br>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="submit" name="save_item_button" id="editItem" class="btn btn-dark" style="width: 90%" disabled>Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit offer modal -->
                            <div class="modal fade" id="editOfferButton" tabindex="-1" role="dialog" aria-labelledby="editOfferModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Offer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="offer_desc" id="editOfferDesc" onkeyup="editOfferSuccess()" placeholder="Item description" class="form-control"><br>
                                            <select name="offer_cond" id="editOfferCondition" onchange="editOfferSuccess()" class="btn btn-dark dropdown-toggle mb-3 ">
                                                <option value="">-- select --</option>
                                                <option value="New">New</option>
                                                <option value="Used (like new)">Used (like new)</option>
                                                <option value="Used (very good)">Used (very good)</option>
                                                <option value="Used (good)">Used (good)</option>
                                                <option value="Used (acceptable)">Used (acceptable)</option>
                                            </select><br>
                                            <p>Change photo:</p> 
                                            <input type="file" name="offer_imag" id="editOfferImage" onchange="editOfferSuccess()"><br>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="submit" name="save_offer_button" id="editOffer" class="btn btn-dark" style="width: 90%" disabled>Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function get_id(id) {
            document.getElementById("item_id").value = id;
        }
        function get_owner(owner) {
        document.getElementById("owner").href = "visit.php?owner=" + owner;
        document.querySelector('#owner').click();
        }
        function get_item(item_transac_id) {
            document.getElementById("item_transac_id").href = "transaction.php?item_transac_id=" + item_transac_id;
            document.querySelector('#item_transac_id').click();
        }
        function success() {
	        if ((document.getElementById("itemName").value==="") || (document.getElementById("itemDesc").value==="") ||
                (document.getElementById("itemCondition").value==="") || (document.getElementById("itemCategory").value==="") ||
                (document.getElementById("itemImage").value==="")) {
                document.getElementById('postItem').disabled = true;
            } else {
                document.getElementById('postItem').disabled = false;
            }
        }
        function editItemSuccess() {
            if ((document.getElementById("editItemDesc").value==="" || document.getElementById("editItemCondition").value==="") ||
                (document.getElementById("editItemImage").value==="")){
                document.getElementById('editItem').disabled = true;
            } else {
                document.getElementById('editItem').disabled = false;
            }
        }
        function editOfferSuccess() {
            if ((document.getElementById("editOfferDesc").value==="" || document.getElementById("editOfferCondition").value==="") ||
                (document.getElementById("editOfferImage").value==="")){
                document.getElementById('editOffer').disabled = true;
            } else {
                document.getElementById('editOffer').disabled = false;
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>