<?php

namespace App\Public;

use App\Operation\Functions;
use App\Order\Order;
use App\Track\Track;

require '../vendor/autoload.php';

session_start();

$functions = new Functions;
$order = new Order;
$tracks = new Track;
$guest = $functions->state();

$_POST['searchtext'] = '';
?>
<?php include '../src/app/Templates/header.php'; ?>
<title>Order - Music Locker</title>
</head>
<body>
    <!-- Navigation -->
    <?php include '../src/app/Templates/navbar.php'; ?>

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
                                $order->readLog(NULL, $_SESSION['user']);
                            } elseif(isset($_GET['orderID'])) { 
                                $order->readLog($_GET['orderID'], $_SESSION['user']);
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
<td><span class="item"><?php $order->count; ?> </span></td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">$ <?php $order->total; ?> </span></strong> </td>
</tr>

</tbody>

</table>
</div>

 </div>

        <hr>

<?php include '../src/app/Templates/footer.php'; ?>