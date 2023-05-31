<?php

require_once 'functions.php';
require_once 'showTrack.php';

session_start();

$functions = new Functions;
$tracks = new ShowTrack;
$guest = $functions->state();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home - Music Locker</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Music Locker</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="Shop.php">Shop</a>
                    </li>
                    <?php if($guest === true) {?>
                    <li>                        
                        <a href="login.php">Login</a>
                    </li>
                    <?php } ?>
                    <?php if($guest === false) {?>
                    <li>                        
                        <a href="logout.php">Logout</a>
                    </li>
                    <?php } ?>
                     <li>
                        <a href="checkout.php">Checkout</a>
                    </li>
                    <li>
                        <a href="profile.php"><?=$_SESSION['user'];?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="row">

                    <!-- TRACK 1 -->
                    <?php $track1=$tracks->list(1); ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="images/<?=$track1['album']?>.png" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$<?=$track1['price']?></h4>
                                <h4></h4>
                                <p><?=$track1['artist']?></p>
                                <p><?=$track1['album']?></p>
                                <p><?=$track1['year']?></p>
                                <p><?=$track1['genre']?></p>
                            </div>
                            <?php if($_SESSION['product_1']==0) { ?>
                            <a class="btn btn-primary" href="cart.php?add=<?=$track1['id']?>">Add to Cart</a>
                            <?php } ?>
                            <?php if($_SESSION['product_1']==1) { ?>
                            <a class="btn btn-primary" href="cart.php?remove=<?=$track1['id']?>">Remove from Cart</a>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- TRACK 2 -->
                    <?php $track2=$tracks->list(2); ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="images/<?=$track2['album']?>.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$<?=$track2['price']?></h4>
                                <p><?=$track2['artist']?></p>
                                <p><?=$track2['album']?></p>
                                <p><?=$track2['year']?></p>
                                <p><?=$track2['genre']?></p>
                            </div>
                            <?php if($_SESSION['product_2']==0) { ?>
                            <a class="btn btn-primary" href="cart.php?add=<?=$track2['id']?>">Add to Cart</a>
                            <?php } ?>
                            <?php if($_SESSION['product_2']==1) { ?>
                            <a class="btn btn-primary" href="cart.php?remove=<?=$track2['id']?>">Remove from Cart</a>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- TRACK 3 -->
                    <?php $track3=$tracks->list(3); ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="images/<?=$track3['album']?>.png" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$<?=$track3['price']?></h4>
                                <p><?=$track3['artist']?></p>
                                <p><?=$track3['album']?></p>
                                <p><?=$track3['year']?></p>
                                <p><?=$track3['genre']?></p>
                            </div>
                            <?php if($_SESSION['product_3']==0) { ?>
                            <a class="btn btn-primary" href="cart.php?add=<?=$track3['id']?>">Add to Cart</a>
                            <?php } ?>
                            <?php if($_SESSION['product_3']==1) { ?>
                            <a class="btn btn-primary" href="cart.php?remove=<?=$track3['id']?>">Remove from Cart</a>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- TRACK 4 -->
                    <?php $track4=$tracks->list(4); ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="images/<?=$track4['album']?>.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$<?=$track4['price']?></h4>
                                <p><?=$track4['artist']?></p>
                                <p><?=$track4['album']?></p>
                                <p><?=$track4['year']?></p>
                                <p><?=$track4['genre']?></p>
                            </div>
                            <?php if($_SESSION['product_4']==0) { ?>
                            <a class="btn btn-primary" href="cart.php?add=<?=$track4['id']?>">Add to Cart</a>
                            <?php } ?>
                            <?php if($_SESSION['product_4']==1) { ?>
                            <a class="btn btn-primary" href="cart.php?remove=<?=$track4['id']?>">Remove from Cart</a>
                            <?php } ?>
                        </div>
                    </div>
                    
 
                    
                    <!-- TRACK 6 -->
                    <?php $track6=$tracks->list(6); ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="images/<?=$track6['album']?>.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$<?=$track6['price']?></h4>
                                <p><?=$track6['artist']?></p>
                                <p><?=$track6['album']?></p>
                                <p><?=$track6['year']?></p>
                                <p><?=$track6['genre']?></p>
                            </div>
                            <?php if($_SESSION['product_6']==0) { ?>
                            <a class="btn btn-primary" href="cart.php?add=<?=$track6['id']?>">Add to Cart</a>
                            <?php } ?>
                            <?php if($_SESSION['product_6']==1) { ?>
                            <a class="btn btn-primary" href="cart.php?remove=<?=$track6['id']?>">Remove from Cart</a>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- TRACK 5 -->
                    <?php $track5=$tracks->list(5); ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="images/<?=$track5['album']?>.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$<?=$track5['price']?></h4>
                                <p><?=$track5['artist']?></p>
                                <p><?=$track5['album']?></p>
                                <p><?=$track5['year']?></p>
                                <p><?=$track5['genre']?></p>
                            </div>
                            <?php if($_SESSION['product_5']==0) { ?>
                            <a class="btn btn-primary" href="cart.php?add=<?=$track5['id']?>">Add to Cart</a>
                            <?php } ?>
                            <?php if($_SESSION['product_5']==1) { ?>
                            <a class="btn btn-primary" href="cart.php?remove=<?=$track5['id']?>">Remove from Cart</a>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- TRACK 7 -->
                    <?php $track7=$tracks->list(7); ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="images/<?=$track7['album']?>.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$<?=$track7['price']?></h4>
                                <p><?=$track7['artist']?></p>
                                <p><?=$track7['album']?></p>
                                <p><?=$track7['year']?></p>
                                <p><?=$track7['genre']?></p>
                            </div>
                            <?php if($_SESSION['product_7']==0) { ?>
                            <a class="btn btn-primary" href="cart.php?add=<?=$track7['id']?>">Add to Cart</a>
                            <?php } ?>
                            <?php if($_SESSION['product_7']==1) { ?>
                            <a class="btn btn-primary" href="cart.php?remove=<?=$track7['id']?>">Remove from Cart</a>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- TRACK 8 -->
                    <?php $track8=$tracks->list(8); ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="images/<?=$track8['album']?>.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$<?=$track8['price']?></h4>
                                <p><?=$track8['artist']?></p>
                                <p><?=$track8['album']?></p>
                                <p><?=$track8['year']?></p>
                                <p><?=$track8['genre']?></p>
                            </div>
                            <?php if($_SESSION['product_8']==0) { ?>
                            <a class="btn btn-primary" href="cart.php?add=<?=$track8['id']?>">Add to Cart</a>
                            <?php } ?>
                            <?php if($_SESSION['product_8']==1) { ?>
                            <a class="btn btn-primary" href="cart.php?remove=<?=$track8['id']?>">Remove from Cart</a>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- TRACK 9 -->
                    <?php $track9=$tracks->list(9); ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="images/<?=$track9['album']?>.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$<?=$track9['price']?></h4>
                                <p><?=$track9['artist']?></p>
                                <p><?=$track9['album']?></p>
                                <p><?=$track9['year']?></p>
                                <p><?=$track9['genre']?></p>
                            </div>
                            <?php if($_SESSION['product_9']==0) { ?>
                            <a class="btn btn-primary" href="cart.php?add=<?=$track9['id']?>">Add to Cart</a>
                            <?php } ?>
                            <?php if($_SESSION['product_9']==1) { ?>
                            <a class="btn btn-primary" href="cart.php?remove=<?=$track9['id']?>">Remove from Cart</a>
                            <?php } ?>
                        </div>
                    </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2030</p>
                </div>
            </div>
        </footer>

    </div>
</body>

</html>
