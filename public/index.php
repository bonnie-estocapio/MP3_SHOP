<?php

namespace App\Public;

use App\Operation\Functions;

require '../vendor/autoload.php';

$functions = new Functions;

session_start();

$guest = $functions->state();

?>

<?php include '../src/app/Templates/header.php'; ?>
<title>Home - Music Locker</title>

<?php include '../src/app/Templates/navbar.php'; ?>

    <h1 class='text-center'> WELCOME TO MUSIC LOCKER</h1>

<?php include '../src/app/Templates/footer.php'; ?>