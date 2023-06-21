<?php

namespace App\User;

use App\Operation\Database;
use App\Operation\Message;
use App\Operation\Navigation;

class User
{
    public function login(): void
    {
        $database = new Database;
        $userdata = new UserData;
        $message = new Message;
        $session = new Session;
        $navigation = new Navigation;

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = $database->conn->prepare("SELECT id, username FROM users WHERE username = :username AND password = :password");
            $query->bindParam(':username', $username);
            $query->bindParam(':password', $password);
            $query->execute();

            $data = $query->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                $message->set("Invalid Login Details");
            } else {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $username;
                $userdata->read();
                $session->write(session_id(), $_SESSION['user']);
                $navigation->goTo("index.php");
                $session->setExpiry();
            }
        }
    }

    public function create($username, $password, $fullname, $address, $email)
    {
        $database = new Database;
        $message = new Message;

        $query = $database->conn->prepare("INSERT INTO users (username, password, fullname, address, email) VALUES (:username, :password, :fullname, :address, :email)");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':fullname', $fullname);
        $query->bindParam(':address', $address);
        $query->bindParam(':email', $email);
        $query->execute();
        
        if ($query) {
            $message->set("Account Created, Please login");
        }
    }

    public function logout()
    {
        $database = new Database;
        $userdata = new UserData;

        session_start();
        $userdata->write($_SESSION['user']);
        $database->query("DELETE FROM sessions");
        $_SESSION = [];
        $ses_params = session_get_cookie_params();
        $options = array(
            'expires' => time() - 60,
            'path' => $ses_params['path'],
            'domain' => $ses_params['domain'],
            'secure' => $ses_params['secure'],
            'httponly' => $ses_params['httponly'],
            'samesite' => $ses_params['samesite']
        );
        setcookie(session_name(), '', $options);
        session_destroy();
        session_start();
        $_SESSION['loggedin'] = false;
        $_SESSION['user'] = 'Guest';
        header("Location: index.php");
    }

    public function signUp()
    {
        $navigation = new Navigation;

        if (isset($_POST['signup'])) {
            $navigation->goTo("register.php");
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

        if (!preg_match( '/^\d+ [a-zA-Z ]+, [a-zA-Z ]+, [a-zA-Z ]+, [a-zA-Z ]+$/', $address)) {
            $errorMessage .= "Invalid Address. </br>";
            $valid = false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage .= "Invalid Email. </br>";
            $valid = false;
        }
        
        if ($valid) {
            $this->create($username, $password, $fullname, $address, $email);
        } else {
            $message->set($errorMessage . "Please try again.");
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
}