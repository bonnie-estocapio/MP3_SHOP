<?php

namespace App\Operation;

Class Message
{
    public function set($message)
    {
        if (!empty($message)) {
            $_SESSION['message'] = $message;
        } else {
            $message = "";
        }
    }

    public function show()
    {
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }
}