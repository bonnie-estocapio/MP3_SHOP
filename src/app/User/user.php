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

            $query = $database->conn->prepare("SELECT id, username, password, salt FROM users WHERE username = :username");
            $query->bindParam(':username', $username);
            $query->execute();

            $data = $query->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                $message->set("Invalid Username");
            } else {
                $correct = $this->checkPassword($password, $data['password'], $data['salt']);

                if (!$correct) {
                    $message->set("Invalid Password");
                } else {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = $data['username'];
                    $userdata->read();
                    $session->write(session_id(), $_SESSION['user']);
                    $navigation->goTo("index.php");
                    $session->setExpiry();
                }
            } 
        }
    }

    public function logout(): void
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

    public function checkPassword($password, $storedPassword, $salt): bool
    {
        $create = new Create;
        $hashedPassword = $create->hashPassword($password, $salt);

        if ($hashedPassword === $storedPassword) {
            return true;
        } else {
            return false;
        }
    }
}