<?php

namespace App\Templates;

use App\Operation\Functions;

require '../vendor/autoload.php';

$functions = new Functions;
$guest = $functions->state();
?>

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

                    <?php if ($guest) {?>
                    <li>                        
                        <a href="login.php">Login</a>
                    </li>
                    <?php } ?>

                    <li>
                        <a href="checkout.php">Checkout</a>
                    </li>
                    
                    <?php if (!$guest) {?>
                    <li>                        
                        <a href="logout.php">Logout</a>
                    </li>
                    <li>
                        <a href="profile.php"><?php echo $_SESSION['user']; ?></a>
                    </li>
                    <li>
                        <a href="orderHistory.php">Order History</a>
                    </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>