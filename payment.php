<?php

require_once 'includes/functions.php';

session_start();
$functions = new Functions;
$guest = $functions->state();


if(isset($_POST['submit'])) {
    print_r($_POST);
    $check = 0;
    foreach($_POST as $data){
        if($data === "") {
            $check = 1;
            echo $check;
        }
    }

    if ($check === 0){
        $functions->payment($_SESSION['user'], $_SESSION['total'], $_SESSION['count']);
    } else {
        $functions->setMessage("Some fields are not filled. Try again.");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payment - Music Locker</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">

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
                        <a href="profile.php"><?=$_SESSION['user'];?></a>
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
                    <div class="row">
                        <label for="fullname" class="form-label">Name on Card</label>
                        <input  type="text" name="fullname" class="form-label">
                    </div>

                    <div class="row">
                        <label for="card" class="form-label">Card Number</label>
                        <input  type="text" name="card" class="form-label">
                    </div>

                    <div class="row">
                        <label for="address" class="address">CVV</label>
                        <input  type="text" name="address" class="form-label">
                    </div>

                    <div class="row">
                    <div class="mb-3 form-check">
                    <input type="checkbox" name="tos" value="ok" id="tos" class="form-check-input">
                    <label class="form-check-label" for="tos">Accept TOS</label>
                </div>
                    </div>
                    <button class="btn btn-primary" type="submit" name="submit" value="payment">Confirm Payment</button>
                </form>
            </div>
        </header>
    </div>
    <?php }?>

    <?php if($guest === true) { ?>
        <h3 class="text-center">Log in first to proceed</h3>
        <div class=text-center>
            <a class="btn btn-primary" href="login.php">Login</a>
        </div>
    <?php }?>
    </div>
    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Music Locker 2023</p>
                </div>
            </div>
        </footer>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>