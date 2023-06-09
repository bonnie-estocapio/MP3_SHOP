<?php

require_once 'includes/autoload.php';
session_start();

$functions = new Functions;
$cart = new Cart;
$cart->add();
$cart->remove();