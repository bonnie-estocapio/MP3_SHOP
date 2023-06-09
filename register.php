<?php

require_once 'includes/autoload.php';

$user = new User;
$message = new Message;

if (isset($_POST['submit'])) {
    $check = 0;
    foreach($_POST as $data) {
        if($data === "") {
            $check = 1;
        }
    }
    if ($check === 0){
        $user->create(
            $_POST['username'], 
            $_POST['password'], 
            $_POST['fullname'], 
            $_POST['address'], 
            $_POST['email']    
        );
    } else {
        $message->set("Some fields are not filled. Try again.");
    }
}
?>

<?php include 'templates/header.php'; ?>
<title>Register - Music Locker</title>
</head>

<body>
<?php include 'templates/navbar.php'; ?>

    <!-- Page Content -->
    <div class="container">
      <header>
            <h1 class="text-center">SIGN-UP</h1>
            <h3 class="text-center"><?php $message->show();?></h3> 
            <div class="text-center">

                <form method="post" action="register.php">
                    <div class="row">
                        <label for="username" class="form-label">Username:</label>
                        <input  type="text" name="username" class="form-label" />
                    </div>
                    
                    <div class="row">
                        <label for="password" class="form-label">Password:</label>
                        <input  type="password" name="password" class="form-label" />
                    </div>

                    <div class="row">
                        <label for="fullname" class="form-label">Full Name:</label>
                        <input  type="text" name="fullname" class="form-label" />
                    </div>

                    <div class="row">
                        <label for="address" class="address">Address:</label>
                        <input  type="text" name="address" class="form-label" />
                    </div>

                    <div class="row">
                        <label for="email" class="form-label">Email:</label>
                        <input  type="email" name="email" id="email" class="form-label" class="form-control">
                    </div>
                    <button class="btn btn-primary" type="submit" name="submit" value="register">Register</button>
                </form>
            </div>
            </header>
        </div>
    </div>
    <div class="container">
        <hr>
<?php include 'templates/footer.php'; ?>