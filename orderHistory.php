<?php

require_once 'includes/functions.php';
require_once 'includes/showTrack.php';

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
                        <a href="profile.php"><?=$_SESSION['user'];?></a>
                    </li>
                </ul>
                </div>
            </div>
    </nav>

    <!-- Page Content -->
   <!-- Page Content -->
    <div class="container">
    
        <!-- /.row --> 

        <div class="row">

            <h1>Order History</h1>

        <form action="">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Track Purchased</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        if ($guest === true) {
                            echo "Login to view";
                        } elseif ($guest === false) {
                            if(!isset($_GET['orderID'])){
                                $functions->viewOrderHistory(NULL, $_SESSION['user']);
                            } elseif(isset($_GET['orderID'])) { 
                                $functions->viewOrderHistory($_GET['orderID'], $_SESSION['user']);
                            }
                        }
                        ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="profile.php">Back to Profile</a>
        </form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Order Summary</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="item"><?=$functions->countOrder?> </span></td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">$ <?=$functions->totalOrder?> </span></strong> </td>
</tr>

</tbody>

</table>
</div>

 </div>

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
