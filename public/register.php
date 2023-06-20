<?php

namespace App\Public;

use App\Operation\Message;
use App\User\User;

require '../vendor/autoload.php';

$user = new User;
$message = new Message;

$user->register();
?>

<?php include '../src/app/Templates/header.php'; ?>
<title>Register - Music Locker</title>
</head>

<body>
    <?php include '../src/app/Templates/navbar.php'; ?>

    <!-- Page Content -->
    <div class="container">
        <header>
            <h1 class="text-center">SIGN-UP</h1>
            <h3 class="text-center"><?php $message->show(); ?></h3>
            <div class="text-center">
                <form method="post" action="register.php">
                    <div class="row">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" class="form-label" />
                        <h6>* Must have 3-20 Characters</h4>
                    </div>

                    <div class="row">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-label" />
                        <h6>* Must have atleast 1 of each: uppercase letter, lowercase letter, number, and symbol</h4>
                    </div>

                    <div class="row">
                        <label for="fullname" class="form-label">Full Name:</label>
                        <input type="text" name="fullname" class="form-label" />
                        <h6>* Must contain letters only</h4>
                    </div>

                    <div class="row">
                        <label for="address" class="address">Address:</label>
                        <input type="text" name="address" class="form-label" />
                        <h6>* Must follow the format: House#/Street# Street, Barangay, City, Province </h4>
                    </div>

                    <div class="row">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-label" class="form-control">
                        <h6>* Must follow the usual email format </h4>
                    </div>
                    <button class="btn btn-primary" type="submit" name="submit" value="register">Register</button>
                </form>
            </div>
        </header>
    </div>
    </div>
    <div class="container">
        <hr>
        <?php include '../src/app/Templates/footer.php'; ?>