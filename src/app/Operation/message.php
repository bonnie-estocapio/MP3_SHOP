<?php

namespace App\Operation;

class Message
{
    public function set($message): void
    {
        if (!empty($message)) {
            $_SESSION['message'] = $message;
        } else {
            $message = "";
        }
    }

    public function show(): void
    {
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }
}