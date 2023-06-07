<?php
require_once 'autoload.php';

$autoload = new Autoload;

Class User
{
    public function login()
    {
        $database = new Database;
        $userdata = new UserData;
        $message = new Message;
        $session = new Session;
        $navigation = new Navigation;

        if (isset($_POST['submit'])) {
            // $connection = $this->db_connect();
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = $database->query("SELECT id,username FROM users WHERE username = '{$username}' AND password = '{$password}'");
            $data = mysqli_fetch_assoc($query);

            if (!$data) {
                $message->set("Invalid Login Details");
            } else {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $username;
                $session->write(session_id(), $_SESSION['user']);
                $navigation->goTo("index.php");
                $userdata->read();
            }
        }
    }

    public function create($username, $password, $fullname, $address, $email)
    {
        $database = new Database;
        $message = new Message;

        $username = mysqli_real_escape_string($database->connection, $username);//clean data
        $password = mysqli_real_escape_string($database->connection, $password);//clean data
        $fullname = mysqli_real_escape_string($database->connection, $fullname);//clean data
        $address = mysqli_real_escape_string($database->connection, $address);//clean data 
        $email = mysqli_real_escape_string($database->connection, $email);//clean data 

        $query = $database->query("INSERT INTO users (username, password, fullname, address, email) VALUES ('$username', '$password', '$fullname', '$address', '$email')");

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
        $query = $database->query("DELETE FROM sessions");
        $_SESSION = [];
        $ses_params = session_get_cookie_params();
        $options = array(
            'expires' => time() - 60,
            'path'     => $ses_params['path'],
            'domain'   => $ses_params['domain'],
            'secure'   => $ses_params['secure'],
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