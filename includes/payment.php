<?php

require_once 'autoload.php';

$autoload = new Autoload;

Class Payment
{
    public function pay($username, $total, $count)
    {
        $send = new Mail;
        $dbase = new Database;

        $dataArray = [];
        $email = mysqli_fetch_assoc($dbase->query("SELECT email FROM users WHERE username='{$username}'"));
        $body = "Good day " . $_SESSION['user'] ."
                You have purchased the following: ";

        if (isset($_POST['submit'])) {
            foreach ($_SESSION as $data => $value) {
                if ($value === 1 && substr($data, 0, 8)== "product_") {
                    $id = substr($data, 8, strlen($data)-8);
                    $query = $dbase->query("SELECT * FROM tracks WHERE id =". $id);
                    while ($row = mysqli_fetch_assoc($query)) {
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

    public function validate($paymentArray)
    {
        $check = 0;
        foreach ($paymentArray as $data) {
            if ($data === '') {
                $check = 1;
            }
        }
        if ($check === 1) {
            $this->setMessage("Incomplete details. Try again.");
        } else {
            $this->payment($_SESSION['user'], $_SESSION['total'], $_SESSION['count']);
        }
    }
}