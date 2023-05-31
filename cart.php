<?php

require_once 'functions.php';
session_start();

$functions = new Functions;
$functions->addCart();
$functions->removeCart();