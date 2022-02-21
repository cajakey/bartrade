<?php
    require_once 'controllers/auth_controller.php';
    include 'controllers/visit_controller.php';
    
    if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
    }

    if (!isset($_GET['owner'])) {
        header('location: visit.php?owner=');
        exit();
    }

    if($_GET['owner'] === $_SESSION['username']) {
        header('location: profile.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en"  >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/bt_icon_withouttext.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="user_profile_style.css">
    <link rel="stylesheet" href="cards.scss">
    <title>Bartrade</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white mb-3 sticky-top">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand"> <img src="images\bt_icon_withouttext.png" style="width: 75px;"></a>
            <div class="d-xl-none d-lg-none d-md-none" id=""></div>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="index.php" class="nav-item nav-link textcolor-black"><strong> Home </strong></a>
                    <a href="index.php?logout=1" class="nav-item nav-link textcolor-black"><strong> LOGOUT </strong></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="p-1 profile-sidebar">
                    <div class="mt-3" >
                        <?php if(!$user['profile_image']): ?>
                            <img src="images/placeholder.png" class="rounded-circle img-fluid mx-auto d-block"><br>
                        <?php endif; ?>
                        <?php if($user['profile_image']): ?>
                            <img src="profile_images/<?php echo $user['profile_image']; ?>" class="rounded-circle img-fluid mx-auto d-block"><br>
                        <?php endif; ?> 
                        <div class="d-flex justify-content-center">
                            <div class="mx-1">
                                <button class="btn btn-dark" data-toggle="modal" data-target="#ratingsModal">
                                Rate Me!
                                </button>
                            </div>
                            <div class="mx-1">
                                <button class="btn btn-dark">
                                    <span class="fa fa-envelope" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Message me!"></span>
                                </button>
                            </div>
                            <div class="mx-1">
                                <form action="visit.php" method="get">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
                                    <button type="submit" name="report_button" onclick="alert('Account reported successfully')" class="btn btn-dark">
                                        <span class="fa fa-exclamation-circle" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Report User"></span>
                                    </button>
                                </form>
                            </div>
                            <!--Rate user Modal-->
                            <div class="modal fade" id="ratingsModal" tabindex="-1" role="dialog" aria-labelledby="ratingsModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ratingsModal">Rate Me!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="visit.php" method="get">
                                                <textarea maxlength="160" name="review" class="form-control" placeholder="Enter your review"></textarea>
                                                <div class="my-2 text-center">
                                                    <span onclick="starmark(this)" id="1one" style="font-size:20px;cursor:pointer;" class="fa fa-star"></span>
                                                    <span onclick="starmark(this)" id="2one" style="font-size:20px;cursor:pointer;" class="fa fa-star"></span>
                                                    <span onclick="starmark(this)" id="3one" style="font-size:20px;cursor:pointer;" class="fa fa-star"></span>
                                                    <span onclick="starmark(this)" id="4one" style="font-size:20px;cursor:pointer;" class="fa fa-star"></span>
                                                    <span onclick="starmark(this)" id="5one" style="font-size:20px;cursor:pointer;" class="fa fa-star"></span>
                                                </div>
                                                <input type="hidden" name="stars" id="stars">
                                                <input type="hidden" name="owner_id" id="owner_id">
                                                <input type="hidden" name="owner_us" value="<?php echo $user['username']; ?>">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit_button" id="rate_button" class="btn btn-dark" disabled>Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-3 p-3">
                        <div class="profile-user-name text-center">
                            <?php
                                if($user_count == 0) {
                                    echo '<h1 style="font-size:100px">PROFILE NOT FOUND</h1>'; 
                                } else {
                                    Username: 
                                    echo $user['username'];
                                }
                            ?>
                            <br>
                        </div>
                        <div class="profile-user-rating text-center">
                            Rating: <?php echo $user['rating']; ?><br>
                            <div>
                                <?php
                                    if ($user['rating']>=1) {
                                        echo '<span style="font-size:20px;" class="fas fa-star"></span>';
                                    } 
                                    elseif ($user['rating']>=0.5) {
                                        echo '<span style="font-size:20px;" class="fas fa-star-half-alt"></span>';
                                    }
                                    else {
                                        echo '<span style="font-size:20px;" class="far fa-star"></span>';
                                    }
                                ?>
                                <?php
                                    if ($user['rating']>=2) {
                                        echo '<span style="font-size:20px;" class="fas fa-star"></span>';
                                    }
                                    elseif ($user['rating']>=1.5) {
                                        echo '<span style="font-size:20px;" class="fas fa-star-half-alt"></span>';
                                    }
                                    else {
                                        echo '<span style="font-size:20px;" class="far fa-star"></span>';
                                    }
                                ?>
                                <?php
                                    if ($user['rating']>=3) {
                                        echo '<span style="font-size:20px;" class="fas fa-star"></span>';
                                    }
                                    elseif ($user['rating']>=2.5) {
                                        echo '<span style="font-size:20px;" class="fas fa-star-half-alt"></span>';
                                    }
                                    else {
                                        echo '<span style="font-size:20px;" class="far fa-star"></span>';
                                    }
                                ?>
                                <?php
                                    if ($user['rating']>=4) {
                                        echo '<span style="font-size:20px;" class="fas fa-star"></span>';
                                    } 
                                    elseif ($user['rating']>=3.5) {
                                        echo '<span style="font-size:20px;" class="fas fa-star-half-alt"></span>';
                                    }
                                    else {
                                        echo '<span style="font-size:20px;" class="far fa-star"></span>';
                                    }
                                ?>
                                <?php
                                    if ($user['rating']>=5) {
                                        echo '<span style="font-size:20px;" class="fas fa-star"></span>';
                                    } 
                                    elseif ($user['rating']>=4.5) {
                                        echo '<span style="font-size:20px;" class="fas fa-star-half-alt"></span>';
                                    }
                                    else {
                                        echo '<span style="font-size:20px;" class="far fa-star"></span>';
                                    }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="text-break">
                            <div class="mb-3">
                                Bio:
                                <br>
                                <?php echo $user['bio']; ?><br>
                                <br>
                            </div>
                        </div>
                        <div class="mb-3">
                            Interests:<br>
                            <?php 
                                $showInterests = explode(",", $user['interests']);
                                foreach ($showInterests as $value) {
                                    echo $value, "<br>";
                                }
                            ?>
                        </div>
                        <hr>
                        <div class="mb-3">
                            Email: <?php echo $user['email']; ?><br>
                            Phone: <?php echo $user['phone']; ?>
                        </div>
                    </div>
                </div>
                <div class="p-3"></div>
            </div>       
            
            <div class="col-md-6">
                <div class="p-1 profile-feed">
                    <div class="p-3">
                        <!--POSTS BY THIS USER -->
                        Posts by this User
                        <div class="row py-5 text-left">
                            <div class="card">
                                <form action="visit.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="item_id" id="item_id">
                                    <input type="hidden" name="item_owne" value="<?php echo $user['username']; ?>">
                                    <?php if(count($arrayITEMS) > 0): ?>
                                        <?php for ($x = 0; $x < count($arrayITEMS); $x++): ?>
                                            <div class="card border-0">
                                                <div class="card-body">
                                                    <img src="product_images/<?php echo $arrayITEMS[$x]['item_imag']; ?>" class="card-img-top" alt="...">
                                                    <h5 class="card-title mt-2"><?php echo $arrayITEMS[$x]['item_name']; ?></h5>
                                                    <p class="card-text"><?php echo $arrayITEMS[$x]['item_cond']; ?><br><?php echo $arrayITEMS[$x]['item_desc']; ?></p>
                                                    <button id="<?php echo $arrayITEMS[$x]['id']; ?>" onclick="get_id1(this.id)" type="button" data-toggle="modal" data-target="#tradeButton" class="btn btn-dark">Trade now</button>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                    <!-- Propose a trade modal -->
                                    <div class="modal fade" id="tradeButton" tabindex="-1" role="dialog" aria-labelledby="proposeItemModal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content" id="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Propose a Trade</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" id="modal-body">
                                                    <p>
                                                        <a onclick="change_content1()" type="button" class="card-text">Posted</a>
                                                    </p>
                                                    <input type="text" name="offer_name" onkeyup="success()" placeholder="Item name" id="itemName" class="form-control inputField"><br>
                                                    <select name="offer_cond" id="itemCondition" onchange="success()" class="btn btn-dark dropdown-toggle mb-3 ">
                                                        <option value="">-- select --</option>
                                                        <option value="New">New</option>
                                                        <option value="Used (like new)">Used (like new)</option>
                                                        <option value="Used (very good)">Used (very good)</option>
                                                        <option value="Used (good)">Used (good)</option>
                                                        <option value="Used (acceptable)">Used (acceptable)</option>
                                                    </select><br>
                                                    <input type="text" name="offer_desc" onkeyup="success()" placeholder="Item description" id="itemDesc" class="form-control inputField"><br>
                                                    <p>Add photo:</p> 
                                                    <input type="file" name="offer_imag" id="itemImage" onchange="success()"><br>
                                                </div>
                                                <div class="modal-footer justify-content-center" id="modal-footer">
                                                    <p style="color: #e84118; font-size: 14px;"><?php if($_SESSION['verified'] == 0) {
                                                        echo "You have to be verified before you can make a transaction";
                                                    }?></p>
                                                    <button type="submit" name="propose_button" id="submitItem" class="btn btn-dark" style="width:90%" disabled>Submit</button>
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
            
            <div class="col-md-3">
                <div class="profile-reviews p-3">
                    <!-- USER REVIEWS SECTION -->
                    <div class="">
                        User Rating and Reviews:
                        <br>
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
                                <br>     
                                by  <?php echo $arrayRATINGS[$x]['username'];?><br>
                                    <?php echo $arrayRATINGS[$x]['review']; ?><br>                      
                            <?php endfor; ?>
                        <?php endif; ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/template" id="myHtml1">
      <input type="hidden" name="offer_id" id="offer_id">
      <p>
        <a onclick="change_content2()" type="button" class="card-text">Form</a>
      </p>
      <?php if(count($arrayPOSTED) > 0): ?>
        <?php for ($x = 0; $x < count($arrayPOSTED); $x++): ?>
          </p>
            <?php echo $arrayPOSTED[$x]['item_name']; ?>
            <button type="submit" name="trade_button" id="<?php echo $arrayPOSTED[$x]['id']; ?>" onmouseover="get_id2(this.id)"class="btn btn-dark" style="margin-left: 1rem">Trade</button>
          </p>
        <?php endfor; ?>
      <?php endif; ?>
    </script>

    <script type="text/template" id="myHtml2">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Propose a Trade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">
        <p>
          <a onclick="change_content1()" type="button" class="card-text">Posted</a>
        </p>
        <input type="text" name="offer_name" onkeyup="success()" placeholder="Item name" id="itemName" class="form-control inputField"><br>
        <select name="offer_cond" id="itemCondition" onchange="success()" class="btn btn-dark dropdown-toggle mb-3 ">
            <option value="">-- select --</option>
            <option value="New">New</option>
            <option value="Used (like new)">Used (like new)</option>
            <option value="Used (very good)">Used (very good)</option>
            <option value="Used (good)">Used (good)</option>
            <option value="Used (acceptable)">Used (acceptable)</option>
        </select><br>
        <input type="text" name="offer_desc" onkeyup="success()" placeholder="Item description" id="itemDesc" class="form-control inputField"><br>
        <p>Add photo:</p> 
        <input type="file" name="offer_imag" id="itemImage" onchange="success()"><br>
      </div>
      <div class="modal-footer justify-content-center" id="modal-footer">
        <p style="color: #e84118; font-size: 14px;">
          <?php if($_SESSION['verified'] == 0) {
            echo "You have to be verified before you can make a transaction";
          }?>
        </p>
        <button type="submit" name="propose_button" id="submitItem" class="btn btn-dark" style="width: 90%" disabled>Submit</button>
      </div>
    </script>

    <script>
        var count;
        var isVerified = <?php echo $_SESSION['verified']?>;
        function starmark(item) {
            count = item.id[0];
            sessionStorage.starRating = count;
            var subid= item.id.substring(1);
            for(var i = 0; i < 5; i++) {
                if(i < count) {
                    document.getElementById((i + 1) + subid).style.color = "#f6e58d";
                }
                else {
                    document.getElementById((i + 1) + subid).style.color = "black";
                }
            }
            if(count.value==0) {
                document.getElementById("rate_button").disabled = true;
            } else {
                document.getElementById("rate_button").disabled = false;
            }
            document.getElementById("stars").value = count;
            document.getElementById("owner_id").value = <?php echo $user['id']; ?>;
        }
        function get_id1(id) {
            document.getElementById("item_id").value = id;
        }
        function get_id2(id) {
            document.getElementById("offer_id").value = id;
        }
        function success() {
            if ((document.getElementById("itemName").value==="") || (document.getElementById("itemDesc").value==="") ||
            (document.getElementById("itemCondition").value==="") || (document.getElementById("itemImage").value==="" || isVerified.value===0)) {
                document.getElementById('submitItem').disabled = true;
            } else {
                document.getElementById('submitItem').disabled = false;
            }
        }
        function change_content1() {
            var myHtml = document.getElementById('myHtml1').innerHTML;
            document.getElementById("modal-body").innerHTML = myHtml;
            document.getElementById("modal-footer").style.display = "none";
        }
        function change_content2() {
            var myHtml = document.getElementById('myHtml2').innerHTML;
            document.getElementById("modal-content").innerHTML = myHtml;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>