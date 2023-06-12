<?php

require_once 'includes/functions.php';
require_once 'includes/showTrack.php';
require_once 'includes/download.php';

session_start();

$functions = new Functions;
$tracks = new ShowTrack;
$guest = $functions->state();

$_POST['searchtext'] = '';
?>

<?php include 'templates/header.php'; ?>
<title>Profile - Music Locker</title>
</head>

<body>
    <!-- Navigation -->
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
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="Shop.php">Shop</a>
                    </li>
                    <?php if ($guest === true) {?>
                    <li>                        
                        <a href="login.php">Login</a>
                    </li>
                    <?php } ?>
                    <?php if ($guest === false) {?>
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
                    <li>
                        <a href="orderHistory.php">Order History</a>
                    </li>
                </ul>
                </div>
            </div>
    </nav>

    <!-- Page Content -->
    
    <div class="container">

        <div class="row">

            <div class="col-md-9">
                <div class="row">
                    <?php
                    if ($guest === true) {
                        echo "Login to view Library";
                    } elseif ($guest === false) {
                        $tracks->showOwnedTracks();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <hr>
<?php include 'templates/footer.php'; ?>
