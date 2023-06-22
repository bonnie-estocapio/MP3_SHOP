<?php

namespace App\User;

use App\Operation\Database;
use App\Operation\Message;
use App\Operation\Navigation;

class Create
{
    public function signUp()
    {
        $navigation = new Navigation;

        if (isset($_POST['signup'])) {
            $navigation->goTo("register.php");
        }
    }

    public function register()
    {
        $message = new Message;
        
        if (isset($_POST['submit'])) {
            $incomplete = false;

            foreach ($_POST as $data) {
                if ($data === "") {
                    $incomplete = true;
                }
            }

            if ($incomplete === false) {
                $this->validate(
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
    }

    public function validate($username, $password, $fullname, $address, $email): void
    {
        $message = new Message;

        $valid = true;
        $errorMessage = '';

        if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
            $errorMessage = "Invalid Username </br>";
            $valid = false;
        }

        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $password)) {
            $errorMessage .= "Invalid Password.</br>";
            $valid = false;
        }

        if (!preg_match('/^[a-zA-Z ]+$/', $fullname)) {
            $errorMessage .= "Invalid Full Name. </br>";
            $valid = false;
        }

        if (!preg_match( '/^[a-zA-Z0-9_]+, [a-zA-Z ]+, [a-zA-Z ]+, [a-zA-Z ]+$/', $address)) {
            $errorMessage .= "Invalid Address. </br>";
            $valid = false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage .= "Invalid Email. </br>";
            $valid = false;
        }
        
        if ($valid) {
            $this->store($username, $password, $fullname, $address, $email);
        } else {
            $message->set($errorMessage . "Please try again.");
        }
    }

    public function generateSalt(): string
    {
        $randomChar = "/-_#*+!?()=:.@0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charLength = strlen($randomChar);
        $salt = '';

        for ($i = 0; $i < $charLength; $i++) {
            $salt .= $randomChar[rand(0, $charLength - 1)];
        }
        
        return $salt;
    }

    public function hashPassword($password, $salt): string
    {
        $password = hash('sha256', $password . $salt);
        return $password;
    }

    public function store($username, $password, $fullname, $address, $email)
    {
        $database = new Database;
        $message = new Message;

        $salt = $this->generateSalt();
        $hashedPassword = $this->hashPassword($password, $salt);

        $query = $database->conn->prepare("INSERT INTO users (username, password, salt, fullname, address, email) VALUES (:username, :password, :salt, :fullname, :address, :email)");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $hashedPassword);
        $query->bindParam(':salt', $salt);
        $query->bindParam(':fullname', $fullname);
        $query->bindParam(':address', $address);
        $query->bindParam(':email', $email);
        $query->execute();
        
        if ($query) {
            $message->set("Account Created, Please login");
        }
    }
}