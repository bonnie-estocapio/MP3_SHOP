<?php

namespace App\Public;

use App\Operation\Functions;
use App\Order\Cart;

require '../vendor/autoload.php';

session_start();

$functions = new Functions;
$cart = new Cart;

$guest = $functions->state();
?>

<?php include '../src/app/Templates/header.php'; ?>
<title>Checkout - Music Locker</title>
</head>

<body>
    <?php include '../src/app/Templates/navbar.php'; ?>
    <!-- Page Content -->
    <div class="container">
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

            <div class="col-xs-4 pull-right">
                <h2>Cart Totals</h2>
                <table class="table table-bordered" cellspacing="0">
                    <tbody>   
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
        <?php include '../src/app/Templates/footer.php'; ?>