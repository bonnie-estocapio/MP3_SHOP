<?php

require_once 'send.php';

Class Functions
{
    public float $totalOrder = 0;
    public int $countOrder = 0;
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
                $this->readData();
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

    public function state()
    {
        $guest = true;
        if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) {
            $guest = true;
            for($i = 1; $i<=9; $i++) {
                $_SESSION['product_'.$i] = 0;
            }
            $_SESSION['loggedin'] = false;
            $_SESSION['user'] = 'Guest';
         } else if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $guest = false;
        }
        return $guest;
    }

    public function payment($username, $total, $count)
    {
        $dataArray = [];
        $send = new Send;
        $email = mysqli_fetch_assoc($this->query("SELECT email FROM users WHERE username='{$username}'"));
        $body = "Good day " . $_SESSION['user'] ."
                You have purchased the following: ";

        if(isset($_POST['submit'])) {
            foreach($_SESSION as $data => $value) {
                if($value === 1 && substr($data, 0, 8)== "product_") {
                    $id = substr($data, 8, strlen($data)-8);
                    $query = $this->query("SELECT * FROM tracks WHERE id =". $id);
                    while($row = mysqli_fetch_assoc($query)) {
                        $dataArray['product_'.$id] = $_SESSION['product_'.$id];
                        $body = $body . "
                            Title: {$row['title']} - Artist: {$row['artist']} - Price: {$row['price']}";
                    }
                }
            }
            $this->writeOrderHistory($dataArray);
            $query = $this->query("SELECT id FROM history ORDER BY id DESC LIMIT 1");
            $orderID = mysqli_fetch_assoc($query);
            $body .="
                    with a total of $ {$total} for {$count} items.
                    
                    Thank you for your purchase.
                    
                    Link for Order Details: http://localhost/Music_shop/orderHistory.php?orderID=" . $orderID['id'];
            $body = nl2br($body);
            $send->sendMail($email['email'], $body);
            $this->owned();
            $_SESSION['count'] = 0;
            $_SESSION['total'] = 0;
        }
    }

    public function owned()
    {
        foreach($_SESSION as $data => $value) {
            if($value > 0 && substr($data, 0, 8)== "product_") {
                $id = substr($data, 8, strlen($data)-8);
                $query = $this->query("SELECT * FROM tracks WHERE id =". $id);
                while($row = mysqli_fetch_assoc($query)) {
                    $_SESSION['product_'.$id] = 2;
                }
            }
        }
        $this->writeData($_SESSION['user']);
    }

    public function writeOrderHistory($dataArray)
    {
        $dataString = http_build_query($dataArray);
        $query = $this->query("INSERT INTO history (username, data, total, count) VALUES ('{$_SESSION['user']}', '{$dataString}', '{$_SESSION['total']}', '{$_SESSION['count']}')");
        if(!$query) {
            echo "failed to input data";
        }
    }

    public function viewOrderHistory($orderID, $username)
    {
        if($orderID === NULL){
            $orderQuery = $this->query("SELECT id, data FROM history WHERE username = '{$username}'");
            while($row = mysqli_fetch_assoc($orderQuery)){
                $this->showOrderTable($row);
            }
        } else {
            $orderQuery = $this->query("SELECT id, data FROM history WHERE username = '{$username}' && id = '{$orderID}'");
            while($row = mysqli_fetch_assoc($orderQuery)){
                $this->showOrderTable($row);
            }
        }
    }

    public function showOrderTable($orderData)
    {
        $orderArray = [];
        parse_str($orderData['data'], $orderArray);
        foreach($orderArray as $data => $value) {
            if($value == 1 && substr($data, 0, 8)== "product_"){
                $id = substr($data, 8, strlen($data)-8);
                $trackQuery = $this->query("SELECT * FROM tracks WHERE id =". $id);
                while($row = mysqli_fetch_assoc($trackQuery)) {
                    $order = <<<DELIMETER
                        <tr>
                            <td>{$orderData['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['price']}</td>
                        </tr>
                    DELIMETER;
                    $this->totalOrder = $this->totalOrder + $row['price'];
                    $this->countOrder++;
                    echo $order;
                }
            }
        }
    }

    public function writeData($username)
    {
        $dataArray = [];
        foreach($_SESSION as $data => $value) {
            if($value > 0 && substr($data, 0, 8)== "product_") {
                $id = substr($data, 8, strlen($data)-8);
                $query = $this->query("SELECT * FROM tracks WHERE id =". $id);
                while($row = mysqli_fetch_assoc($query)) {
                    $dataArray['product_'.$id] = $_SESSION['product_'.$id];
                }
            }
        }
        $dataString = http_build_query($dataArray);
        $query = $this->query("UPDATE users SET data = '{$dataString}' WHERE username = '{$username}'");
        if(!$query) {
            echo "failed to input data";
        }
    }

    public function readData()
    {
        $newArray = [];
        $query = $this->query("SELECT data FROM users WHERE username = '{$_SESSION['user']}'");
        $data = mysqli_fetch_assoc($query);
        $data['data'] = trim($data['data'], '{()}');
        parse_str($data['data'], $newArray);

        foreach($_SESSION as $data => $value) {
            if(substr($data, 0, 8)== "product_") {
                $id = substr($data, 8, strlen($data)-8);
                $query = $this->query("SELECT * FROM tracks WHERE id =". $id);
                while($row = mysqli_fetch_assoc($query)) {
                    $_SESSION['product_'.$id] = $newArray['product_'.$id];
                }
            }
        }
    }
}