<?php

namespace App\Mail;

use App\Operation\Database;
use App\Operation\Message;
use App\User\UserData;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

class Mail
{
    public function send($email, $body): void
    {
        $userdata = new UserData;
        $message = new Message;

        try {
            if (isset($_POST['submit'])) {
                $mail = new PHPMailer(true);
    
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = '';
                $mail->Password = '';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
    
                $mail->setFrom('');
                $mail->addAddress($email);
                $mail->isHTML(true);
    
                $mail->Subject = 'Order from Music locker - ' . date('F d, Y');;
                $mail->Body = $body;
                echo "<script>
                    alert('Purchase Successfully, Order Details sent via Email');
                    document.location.href='shop.php';
                </script>";
                $userdata->change("checkout", "owned");
                $_SESSION['count'] = 0;
                $_SESSION['total'] = 0;
            } 
        } catch (Exception $e) {
            $userdata->change("checkout", "cart");
            $message->set("Payment Failed due to error in email.");
        }
    }

    public function setBody($total, $count): string
    {
        $database = new Database;

        $body = "Good day " . $_SESSION['user'] . "
            You have purchased the following: ";
        foreach ($_SESSION as $data => $value) {
            if ($value === 1 && substr($data, 0, 8) === 'product_') {
                $id = substr($data, 8);
                $query = $database->query("SELECT * FROM tracks WHERE id = " . $id);
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $dataArray['product_'.$id] = $_SESSION['product_'.$id];
                    $body .= "
                        Title: {$row['title']} - Artist: {$row['artist']} - Price: {$row['price']}";
                }
            }
        }

        $query = $database->query("SELECT id FROM history ORDER BY id DESC LIMIT 1");
        $orderID = $query->fetch(\PDO::FETCH_ASSOC);
        $body .= "
            with a total of $ {$total} for {$count} items.
                
            Thank you for your purchase.
                
            Link for Order Details: http://localhost/Music_shop/public/orderHistory.php?orderID=" . $orderID['id'];
        $body = nl2br($body);

        return $body;
    }
}