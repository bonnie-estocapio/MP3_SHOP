<?php

require_once 'includes/functions.php';

$functions = new Functions;
if(isset($_POST['submit'])) {
    $check = 0;
    foreach($_POST as $data){
        if($data === "") {
            $check = 1;
        }
    }
    if ($check === 0){
        $functions->createUser(
            $_POST['username'], 
            $_POST['password'], 
            $_POST['fullname'], 
            $_POST['address'], 
            $_POST['email']    
        );
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

    <title>Login Page - Music Locker</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>
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
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                    <li>
                        <a href="Shop.php">Shop</a>
                    </li>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                     <li>
                        <a href="checkout.php">Checkout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <header>
            <h1 class="text-center">SIGN-UP</h1>
            <h3 class="text-center"><?php $functions->showMessage();?></h3> 
            <div class="text-center">

                <form method="post" action="register.php">
                    <div class="row">
                        <label for="username" class="form-label">Username:</label>
                        <input  type="text" name="username" class="form-label" />
                    </div>
                    
                    <div class="row">
                        <label for="password" class="form-label">Password:</label>
                        <input  type="password" name="password" class="form-label" />
                    </div>

                    <div class="row">
                        <label for="fullname" class="form-label">Full Name:</label>
                        <input  type="text" name="fullname" class="form-label" />
                    </div>

                    <div class="row">
                        <label for="address" class="address">Address:</label>
                        <input  type="text" name="address" class="form-label" />
                    </div>

                    <div class="row">
                        <label for="email" class="form-label">Email:</label>
                        <input  type="email" name="email" id="email" class="form-label" class="form-control">
                    </div>
                    <button class="btn btn-primary" type="submit" name="submit" value="register">Register</button>
                </form>
            </div>
            </header>
        </div>
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