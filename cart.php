<?php

require_once 'autoload.php';
session_start();

$functions = new Functions;
$cart = new Cart;
$cart->add();
$cart->remove();