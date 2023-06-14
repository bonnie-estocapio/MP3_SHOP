<?php

namespace App\Public;

use App\User\User;

require '../vendor/autoload.php';

$user = new User;

$user->logout();