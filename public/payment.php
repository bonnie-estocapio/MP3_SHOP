<?php

namespace App\Public;

use App\Operation\Functions;
use App\Operation\Message;
use App\Order\Payment;

require '../vendor/autoload.php';

session_start();

$functions = new Functions;
$payment = new Payment;
$message = new Message;

$guest = $functions->state();


if (isset($_POST['submit'])) {
    $payment->validate($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
    
<?php include '../src/app/Templates/header.php'; ?>
<title>Payment - Music Locker</title>
</head>

<body>
    <?php include '../src/app/Templates/navbar.php'; ?>

    <?php if($guest === false) { ?>
    <div class="container">
      <header>
            <h1 class="text-center">Input Payment Details</h1>
            <div class="text-center">

                <form method="post" action="payment.php">
                <h3 class="text-center"><?php $message->show();?></h3>
                <div class="col-50">
                    <h3>Payment</h3>
                </div>
                <div class="text-center">
                        <label for="cname">Name on Card</label>
                        <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                </div>
                <div class="text-center">
                    <label for="ccnum">Credit card number</label>
                    <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                </div>
                <div class="text-center">
                    <label for="exp">Expiry</label>
                    <input type="text" id="expmonth" name="expmonth" placeholder="03-25">
                </div>
                <div class="col-50">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="352">
                </div>

            <div class="text-center">
                <div class="mb-3 form-check">
                    <input type="checkbox" name="tos" value="ok" id="tos" class="form-check-input">
                    <label class="form-check-label" for="tos">Accept TOS</label>
                </div>
                    <button class="btn btn-primary" type="submit" name="submit" value="payment">Confirm Payment</button>
                </form>
            </div>
        </header>
    </div>
    <?php }?>

    <?php if ($guest === true) { ?>
        <h3 class="text-center">Log in first to proceed<a class="btn btn-primary" href="login.php">Login</a></h3>
        <div class=text-center>
        </div>
    <?php }?>
    </div>
    <div class="container">
        <hr>
        <!-- Footer -->

<?php include '../src/app/Templates/footer.php'; ?>