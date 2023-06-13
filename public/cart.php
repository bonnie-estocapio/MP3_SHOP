<?php

namespace App\Public;

require '../vendor/autoload.php';

use App\Operation\Functions;
use App\Order\Cart;

session_start();

$functions = new Functions;
$cart = new Cart;
$cart->add();
$cart->remove();