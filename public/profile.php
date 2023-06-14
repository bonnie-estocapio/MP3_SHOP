<?php

namespace App\Public;

use App\Operation\Functions;
use App\Operation\Message;
use App\Track\Track;

require '../vendor/autoload.php';

session_start();

$functions = new Functions;
$tracks = new Track;
$message = new Message;

$guest = $functions->state();
$_POST['searchtext'] = '';
?>

<?php include '../src/app/Templates/header.php'; ?>
<title>Profile - Music Locker</title>
</head>

<body>
    <!-- Navigation -->
    <?php include '../src/app/Templates/navbar.php'; ?>

    <!-- Page Content -->
    <h3 class="text-center"><?php $message->show();?></h3>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <?php
                    if ($guest) {
                        echo "Login to view Library";
                    } else {
                        $tracks->owned();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <hr>
<?php include '../src/app/Templates/footer.php'; ?>
