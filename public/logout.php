<?php

namespace App\Public;

require '../vendor/autoload.php';

use App\User\User;

$user = new User;

$user->logout();
