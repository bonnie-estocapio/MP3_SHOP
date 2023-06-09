<?php

require_once 'includes/autoload.php';

session_start();

$functions = new Functions;
$cart = new Cart;
$guest = $functions->state();
?>

<?php include 'templates/header.php'; ?>
<title>Checkout - Music Locker</title>
</head>

<body>
      <!-- Navigation -->
      <?php include 'templates/navbar.php'; ?>
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
                <?php $cart->view(); ?>
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