<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

Class Send
{
    function sendMail($email, $body)
    {
        if(isset($_POST['submit'])) {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "";
            $mail->Password = '';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('kyle.estocapio031@gmail.com');
            $mail->addAddress($email);
            $mail->isHTML(true);

            $mail->Subject = "Order from Music locker";
            $mail->Body = $body;

            $mail->send();

            echo
            "
            <script>
            alert('Purchase Successfully, Order Details sent via Email');
            document.location.href='shop.php';
            </script>
            ";
        }
    }
}