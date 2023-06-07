<?php

Class User
{
    public function login()
    {
        if (isset($_POST['submit'])) {
            // $connection = $this->db_connect();
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = $this->query("SELECT id,username FROM users WHERE username = '{$username}' AND password = '{$password}'");
            $data = mysqli_fetch_assoc($query);

            if (!$data) {
                $this->setMessage("Invalid Login Details");
            } else {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $username;
                $this->writeSession(session_id(), $_SESSION['user']);
                $this->navigate("index.php");
                $this->readData();
            }
        }
    }

    public function create($username, $password, $fullname, $address, $email)
    {
        $username = mysqli_real_escape_string($this->connection, $username);//clean data
        $password = mysqli_real_escape_string($this->connection, $password);//clean data
        $fullname = mysqli_real_escape_string($this->connection, $fullname);//clean data
        $address = mysqli_real_escape_string($this->connection, $address);//clean data 
        $email = mysqli_real_escape_string($this->connection, $email);//clean data 

        $query = $this->query("INSERT INTO users (username, password, fullname, address, email) VALUES ('$username', '$password', '$fullname', '$address', '$email')");

        if ($query) {
            $this->setMessage("Account Created, Please login");
        }
    }

    public function logout()
    {
        session_start();
        $this->writeData($_SESSION['user']);
        $query = $this->query("DELETE FROM sessions");
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