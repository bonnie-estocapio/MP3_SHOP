<?php

require_once 'includes/functions.php';
require_once 'includes/showTrack.php';
require_once 'includes/download.php';

session_start();

$functions = new Functions;
$tracks = new ShowTrack;
$guest = $functions->state();

$_POST['searchtext'] = '';
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
                    <?php if ($guest === true) {?>
                    <li>                        
                        <a href="login.php">Login</a>
                    </li>
                    <?php } ?>
                    <?php if ($guest === false) {?>
                    <li>                        
                        <a href="logout.php">Logout</a>
                    </li>
                    <?php } ?>
                     <li>
                        <a href="checkout.php">Checkout</a>
                    </li>
                    <li>
                        <a href="profile.php"><?=$functions->myHtmlspecialchars($_SESSION['user'] ??"", ENT_QUOTES);?></a>
                    </li>
                    <li>
                        <a href="orderHistory.php">Order History</a>
                    </li>
                </ul>
                </div>
            </div>
    </nav>

    <!-- Page Content -->
    
    <div class="container">
        <div class="search">
            <form method="post">
                <input type="text" name="searchtext" placeholder="Search here">
                <input type="radio" name="category" value="title"> Title
                <input type="radio" name="category" value="artist"> Artist
                <input type="radio" name="category" value="album"> Album 
                <input type="radio" name="category" value="year"> Year
                <input type="radio" name="category" value="genre"> Genre
                <input type="submit" name="search" value="search">
            </form>
        </div>
        <div class="row">

            <div class="col-md-9">
                <div class="row">
                    <?php
                    if ($guest === true) {
                        echo "Login to view Library";
                    } elseif ($guest === false) {
                        $tracks->showOwnedTracks();
                    }
                    ?>
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
