<?php

require_once 'includes/autoload.php';

$functions = new Functions;

session_start();

$guest = $functions->state();

?>

<?php include 'templates/header.php'; ?>
<title>Home - Music Locker</title>

<?php include 'templates/navbar.php'; ?>

    <h1 class='text-center'> WELCOME TO MUSIC LOCKER</h1>

<?php include 'templates/footer.php'; ?>