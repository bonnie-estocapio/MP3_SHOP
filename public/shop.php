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
?>

<?php include '../src/app/Templates/header.php'; ?>
<title>Shop - Music Locker</title>
</head>

<body>
    <?php include '../src/app/Templates/navbar.php'; ?>

    <!-- Page Content -->
    <div class="container">
    <h3 class="text-center"><?php $message->show();?></h3>
        <div class="search">
            <form method="post">
                <input type="text" name="searchtext" placeholder="Search here">
                <input type="radio" name="category" value="title"> Title
                <input type="radio" name="category" value="artist"> Artist
                <input type="radio" name="category" value="album"> Album
                <input type="radio" name="category" value="year"> Year
                <input type="radio" name="category" value="genre"> Genre
                <input type="submit" name="search" value="search">
            </form>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <!-- TRACK 1 -->
                    <?php
                    if (!isset($_POST['search'])) {
                        $tracks->all();
                    } else {
                        $tracks->search();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <hr>
        <?php include '../src/app/Templates/footer.php'; ?>