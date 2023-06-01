<?php

require_once 'includes/functions.php';
require_once 'includes/cartFunctions.php';
session_start();

$functions = new Functions;
$cart = new CartFunctions;
$cart->addCart();
$cart->removeCart();