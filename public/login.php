<?php

namespace App\Public;

use App\Operation\Message;
use App\Operation\Navigation;
use App\User\User;

require '../vendor/autoload.php';

$message = new Message;
$user = new User;
$navigation = new Navigation;

session_start();
$user->login();

if (isset($_POST['signup'])) {
    $navigation->goTo("register.php");
}
?>

<?php include '../src/app/Templates/header.php'; ?>

<title>Login - Music Locker</title>
</head>
<body>
    <?php include '../src/app/Templates/navbar.php'; ?>
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
<?php include '../src/app/Templates/footer.php'; ?>
