<?php

Class Functions
{
    public bool $guest = true;
    public function __construct()
    {
        $this->db_connect();
    }

    public function db_connect()
    {
        global $connection;
        $connection = mysqli_connect('localhost', 'root', 'root', 'music_shop');
        if(!$connection)
        {
            echo "Not Connected";
        }
    }

    public function setMessage($message)
    {
        if (!empty($message)) {
            $_SESSION['message'] = $message;
        } else {
            $message = "";
        }
    }

    public function showMessage()
    {
        if(isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }

    public function navigate($location)
    {
        header("Location: {$location}");
    }

    public function query($sql)
    {
        global $connection;
        return mysqli_query($connection, $sql);
    }

    public function login()
    {
        if(isset($_POST['submit']))
        {
            // $connection = $this->db_connect();
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = $this->query("SELECT id,username FROM users WHERE username = '{$username}' AND password = '{$password}' ");
            $data = mysqli_fetch_assoc($query);
            if(!$data)
            {
                $this->setMessage("Invalid Login Details");
            } else {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $username;
                $this->writeSession(session_id(), $_SESSION['user']);
                $this->navigate("index.php");
            }
        }
    }

    public function createUser($username, $password, $fullname, $address, $email)
    {
        if (isset($_POST['submit'])) {
            $query = $this->query("INSERT INTO users (username, password, fullname, address, email) VALUES ('$username', '$password', '$fullname', '$address', '$email')");
            if($query) {
                $this->setMessage("Account Created, Please login");
            }
        }
    }

    public function writeSession($sessionID, $username)
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $query = $this->query("INSERT INTO sessions (session_id, user) VALUES ('$sessionID', '$username')");
        }
    }

    public function logout()
    {
        session_start();
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
        header("Location: login.php");
    }

    public function state()
    {
        if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) {
            $guest = true;
        } else if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $guest = false;
        }
        return $guest;
    }

    public function addCart()
    {
        if(isset($_GET['add'])) {
            $_SESSION['product_' . $_GET['add']]=1;
            $this->navigate("checkout.php");
        }
    }

    public function removeCart()
    {
        if(isset($_GET['remove'])) {
            $_SESSION['product_' . $_GET['remove']]=0;
            $this->navigate("checkout.php");
        }
    }

    public function viewCart()
    {  
        $total=0;
        $count=0;
        foreach($_SESSION as $data => $value) {
            if($value > 0 && substr($data, 0, 8)== "product_") {
                $id = substr($data, 8, strlen($data)-8);
                $query = $this->query("SELECT * FROM tracks WHERE id =". $id);
                while($row = mysqli_fetch_assoc($query)) {
                    $product = <<<DELIMETER
                        <tr>
                            <td>{$row['title']}</td>
                            <td>{$row['artist']}</td>
                            <td>{$row['price']}</td>
                            <td><a href="cart.php?remove={$row['id']}">Remove</a></td>
                        </tr>
                    DELIMETER;
                    $total = $total + $row['price'];
                    $count++;
                    echo $product;
                }
            }
        }
        $_SESSION['total'] = $total;
        $_SESSION['count'] = $count;
    }

    public function payment($username, $total, $count, $card, $cvv)
    {
        if(isset($_POST['submit'])) {
            
        }
    }

    public function sendMail()
    {

    }
}