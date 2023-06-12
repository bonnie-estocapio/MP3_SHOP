<?php

require_once 'autoload.php';

Class Payment
{
    public function pay($username, $total, $count)
    {
        $mail = new Mail;
        $dbase = new Database;
        $userdata = new UserData;

        $query = $dbase->query("SELECT email FROM users WHERE username='{$username}'");
        $email = $query->fetch(PDO::FETCH_ASSOC);

        $body = $mail->setBody($total, $count);
        $mail->send($email['email'], $body);

        $userdata->owned();
        $_SESSION['count'] = 0;
        $_SESSION['total'] = 0;
    }

    public function validate($paymentInfo)
    {
        $message = new Message;

        $check = 0;

        foreach ($paymentInfo as $data) {
            if ($data === '') {
                $check = 1;
            }
        }
        if ($check === 1) {
            $message->set("Incomplete details. Try again.");
        } else {
            $this->pay($_SESSION['user'], $_SESSION['total'], $_SESSION['count']);
        }
    }
}