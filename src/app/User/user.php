<?php

namespace App\User;

use App\Operation\Database;
use App\Operation\Message;
use App\Operation\Navigation;

Class User
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

            $query = $database->query("SELECT id,username FROM users WHERE username = '{$username}' AND password = '{$password}'");
            $data = $query->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                $message->set("Invalid Login Details");
            } else {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $username;
                $userdata->read();
                $session->write(session_id(), $_SESSION['user']);
                $navigation->goTo("index.php");
            }
        }
    }

    public function create($username, $password, $fullname, $address, $email)
    {
        $database = new Database;
        $message = new Message;

        $username = $database->conn->quote($username);
        $password = $database->conn->quote($password);
        $fullname = $database->conn->quote($fullname);
        $address = $database->conn->quote($address);
        $email = $database->conn->quote($email);

        $query = $database->query("INSERT INTO users (username, password, fullname, address, email) VALUES ($username, $password, $fullname, $address, $email)");
        
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
}