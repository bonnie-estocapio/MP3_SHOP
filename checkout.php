<?php

require_once 'includes/functions.php';
require_once 'includes/cartFunctions.php';

session_start();

$functions = new Functions;
$cart = new CartFunctions;
$guest = $functions->state();
?>

<?php include 'templates/header.php'; ?>
<title>Checkout - Music Locker</title>
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
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Page Content -->
    <div class="container">
    
        <!-- /.row --> 

        <div class="row">

            <h1>Checkout</h1>

        <form action="">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                <?php $cart->viewCart(); ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="shop.php">Continue Shopping</a>
        </form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?=$_SESSION['count']?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount"><?=$_SESSION['total']?></span></strong> </td>
</tr>



</tbody>

</table>
<a class="btn btn-primary" href="payment.php">Proceed to Payment</a>
</div>

 </div>

           <hr>


<?php include 'templates/footer.php'; ?>