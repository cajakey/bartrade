<?php
    require_once 'controllers/auth_controller.php';
    include 'controllers/index_controller.php';

    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        verify_user($token);
    }

    if (isset($_GET['password_token'])) {
        $password_token = $_GET['password_token'];
        reset_password($password_token);
    }
    
    if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
    }
    
    if ($_SESSION['deactivate'] === 1) {
        echo "<script> alert(\"Your account is currently deactivated\"); </script>";
        echo "<script> setTimeout(\"location.href = 'index.php?logout=1';\", 0); </script>";
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
    <link rel="stylesheet" href="cards.scss">
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
          <div class="d-none d-md-block">
            <form action="index.php" method="get">
            <div class="input-group">
              <input class="form-control my-0 py-1 input-border" type="search" name="search" placeholder="Search">
              <div class="input-group-append">
                <button class="input-group-text bg-faded-black" name="search_button">
                <i class="fas fa-search text-white"
        aria-hidden="true"></i>
                </button>
              </div>
            </div>
            </form>
          </div>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ml-auto">
              <a href="profile.php" class="nav-item nav-link textcolor-black"><strong> My Profile </strong></a>
              <a href="index.php?logout=1" class="nav-item nav-link textcolor-black"><strong> LOGOUT </strong></a>
            </div>
          </div>
        </div>
      </nav>

    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="4000">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" style="max-height: 100vh">
          <div class="carousel-item active">
            <img src="images/bg1.jpg" class="d-block w-100 img-fluid" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <div class="container">
                  <div class="row justify-content-start text-left">
                      <div class="col-lg-8 mx-auto">
                          <h1>Welcome Traders!</h1>
                          <p>Post all your unwanted items and start trading now</p>
                          <div class="row">
                            <div class="col">
                                <button class="btn0 mt-3 m1-2">Get Started</button>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <img src="images\discount.jpg" class="d-block w-100 img-fluid" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <div class="container">
                    <div class="row justify-content-start text-left">
                        <div class="col-lg-8 mx-auto">
                            <h2>Trade now! </h2>
                            <p1>Get up to 10% discount on your first trade  </p1>
                            <div class="row">
                                <div class="col">
                                    <button class="btn0 mt-3 m1-2">Get Started</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="carousel-item">
            <img src="images\xmas season.jpg" class="d-block w-100 img-fluid" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <div class="container">
                    <div class="row justify-content-start text-left">
                        <div class="col-lg-8 mx-auto">
                            <h2>Christmas Season Offer</h2>
                            <p1>Get special offer this coming Christmas Season </p1>
                            <div class="row">
                                <div class="col">
                                    <button class="btn0 mt-3 m1-2">Get Started</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>             
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

    <section class="Popular">
      <div class="container py-5">
        <h1 class="text-center">Most Popular</h1>
        <div class="row py-5">
          <div class="col-lg">
            <div class="card mb-3 h-100">
              <img src="images\plants.jpg" class="img-fluid mb-3" alt="...">
              <div class="card-body">
                <h5 class="card-title">Plants</h5>
                <p class="card-text">Check out some of this.</p>
                <a href="#" class="btn btn-dark">Show</a>
              </div>
            </div>                   
          </div>
          <div class="col-lg">
            <div class="card mb-3 h-100">
              <img src="images\gadgets.jpg" class="img-fluid mb-3" alt="...">
              <div class="card-body">
                <h5 class="card-title">Gadgets</h5>
                <p class="card-text">Check out some of this.</p>
                <a href="#" class="btn btn-dark">Show</a>
              </div>
            </div>
          </div>
          <div class="col-lg">
            <div class="card mb-3 h-100">
              <img src="images\automotives.jpg" class="img-fluid mb-3" alt="...">
              <div class="card-body">
                <h5 class="card-title">Automotives</h5>
                <p class="card-text">Check out some of this.</p>
                <a href="#" class="btn btn-dark">Show</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="trade">
      <div class="container py-5">
        <h1 class="text-center">On Trade</h1>
        <form action="index.php" method="get">
        <div class="container ">
          <select name="select" class="btn btn-dark dropdown-toggle" onchange="document.querySelector('#select_button').click();">
            <option>-- select --</option>
            <option value="">Display all</option>
            <?php if(count($arrayCATEGORY) > 0): ?>
              <?php for ($x = 0; $x < count($arrayCATEGORY); $x++): ?>
                <option value="<?php echo $arrayCATEGORY[$x]['category']; ?>"><?php echo $arrayCATEGORY[$x]['category']; ?></option>
              <?php endfor; ?>
            <?php endif; ?>
          </select>
          <button name="select_button" id="select_button" style="display: none"></button>
        </div>
        </form>
        <div class="row py-5">
          <div class="card-columns">
            <?php if(!empty($error)): ?>
              <div style="margin-left:30px"><?php echo $error; ?></div>
            <?php endif; ?>
            <a href="" id="owner" style="display: none"></a>
            <form action="index.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="item_id" id="item_id">
            <?php if(count($array) > 0): ?>
              <?php for ($x = 0; $x < count($array); $x++): ?>
                <div class="card">
                  <div class="card-body">
                    <img src="product_images/<?php echo $array[$x]['item_imag']; ?>" class="card-img-top" alt="...">
                    <h5 class="card-title mt-2"><?php echo $array[$x]['item_name']; ?></h5>
                    <p class="card-text"><?php echo $array[$x]['item_cond']; ?><br><?php echo $array[$x]['item_desc']; ?></p>
                     <a id="<?php echo $array[$x]['item_owne']; ?>" onclick="get_owner(this.id)" type="button" class="card-text"><?php echo $array[$x]['item_owne']; ?></a>
                    <?php if($array[$x]['item_owne'] === $_SESSION['username']): ?>
                      <button class="btn btn-dark" disabled>Trade now</button>
                    <?php endif; ?> 
                    <?php if($array[$x]['item_owne'] !== $_SESSION['username']): ?>
                      <button id="<?php echo $array[$x]['id']; ?>" onclick="get_id1(this.id)" type="button" data-toggle="modal" data-target="#tradeButton" class="btn btn-dark">Trade now</button>
                    <?php endif; ?> 
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
                    <p style="color: #e84118; font-size: 14px;">
                      <?php if($_SESSION['verified'] == 0) {
                        echo "You have to be verified before you can make a transaction";
                      }?>
                    </p>
                    <button type="submit" name="submit_button" id="submitItem" class="btn btn-dark" style="width: 90%" disabled>Submit</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
          </div>               
        </div>
      </div>
    </section>

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
        <button type="submit" name="submit_button" id="submitItem" class="btn btn-dark" style="width: 90%" disabled>Submit</button>
      </div>
    </script>

    <script>
      var isVerified = <?php echo $_SESSION['verified']?>;
      function get_owner(owner) {
        document.getElementById("owner").href = "visit.php?owner=" + owner;
        document.querySelector('#owner').click();
      }
      function get_id1(id) {
        document.getElementById("item_id").value = id;
      }
      function get_id2(id) {
        document.getElementById("offer_id").value = id;
      }
      function success() {
	      if ((document.getElementById("itemName").value==="") || (document.getElementById("itemDesc").value==="") ||
          (document.getElementById("itemCondition").value==="") || (document.getElementById("itemImage").value==="" || isVerified === 0)) {
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