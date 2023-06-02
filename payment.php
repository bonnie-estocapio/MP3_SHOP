<?php

require_once 'includes/functions.php';

session_start();
$functions = new Functions;
$guest = $functions->state();


if (isset($_POST['submit'])) {
    $functions->paymentValidation($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'templates/header.php'; ?>
<title>Payment - Music Locker</title>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Music Locker</a>
            </div>
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
                        <a href="profile.php"><?=$functions->myHtmlspecialchars($_SESSION['user'] ??"", ENT_QUOTES);?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php if($guest === false) { ?>
    <div class="container">
      <header>
            <h1 class="text-center">Input Payment Details</h1>
            <div class="text-center">

                <form method="post" action="payment.php">
                <h3 class="text-center"><?php $functions->showMessage();?></h3>
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

<?php include 'templates/footer.php'; ?>