<?php

require_once 'includes/autoload.php';

$autoload = new Autoload;
$message = new Message;
$user = new User;
$navigation = new Navigation;

session_start();

$user->login();

if (isset($_POST['signup'])) {
    $navigation->goTo("register.php");
}
?>

<?php include 'templates/header.php'; ?>
<title>Login - Music Locker</title>
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
            <h1 class="text-center">Login</h1>
            <h3 class="text-center"><?php $message->show();?></h3>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="form-group"><label for="">
                    username<input type="text" name="username" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" value="submit" class="btn btn-primary" >
                <h5>No account yet? Sign up here:</h5>
                  <input type="submit" name="signup" value="signup" class="btn btn-primary" >
                </div>
            </form>
        </div>  
    </header>
        </div>
    </div>
    <div class="container">
        <hr>

<?php include 'templates/footer.php'; ?>
