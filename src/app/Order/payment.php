<?php

namespace App\Order;

use App\Mail\Mail;
use App\Operation\Database;
use App\Operation\Message;
use App\User\UserData;

class Payment
{
    public function pay($username, $total, $count): void
    {
        $mail = new Mail;
        $dbase = new Database;
        $userdata = new UserData;
        $order = new Order;

        $query = $dbase->query("SELECT email FROM users WHERE username='{$username}'");
        $email = $query->fetch(\PDO::FETCH_ASSOC);

        $userdata->change("cart", "checkout");
        $order->log($_SESSION);
        $body = $mail->setBody($total, $count);
        $mail->send($email['email'], $body);
        $userdata->change("checkout", "owned");
        $_SESSION['count'] = 0;
        $_SESSION['total'] = 0;
    }

    public function validate($paymentInfo): void
    {
        $message = new Message;

        $cardName = $paymentInfo['name'];
        $cardNumber = preg_replace('/\D/', '', $paymentInfo['ccnum']);
        $cardCVV = preg_replace('/\D/', '', $paymentInfo['cvv']);
        $expiry = $paymentInfo['expiry'];
        $valid = true;

        $currentYear = date('y');
        $currentMonth = date('m');
        $expiryMonth = substr($expiry, 0, 2);
        $expiryYear = substr($expiry, 3, 2);

        if (empty($cardName) || !preg_match('/^[a-zA-Z\s]+$/', $cardName)) {
            $valid = false;
        }

        if (!preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $cardNumber)) {
            $valid = false;
        }

        if (!preg_match('/^\d{3,4}$/', $cardCVV)) {
            $valid = false;
        }

        if ($expiryYear < $currentYear || ($expiryYear == $currentYear && $expiryMonth <= $currentMonth)) {
            $valid = false;
        }

        if (!$valid) {
            $message->set("Invalid Card Details. Try again.");
        } elseif (!isset($paymentInfo['tos'])) {
            $message->set("Please agree to the Terms of Service");
        } else {
            $this->pay($_SESSION['user'], $_SESSION['total'], $_SESSION['count']);
        }
    }
}