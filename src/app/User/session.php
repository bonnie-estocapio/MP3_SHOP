<?php

namespace App\User;

use App\Operation\Database;

class Session
{
    public function __construct()
    {
        $this->ifExpired();
    }

    public function write($sessionID, $username): void
    {
        $database = new Database;
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $query = $database->conn->prepare("INSERT INTO sessions (session_id, user) VALUES (:sessionID, :username)");
            $query->bindParam(':sessionID', $sessionID);
            $query->bindParam(':username', $username);
            $query->execute();
        }
    }

    public function setExpiry()
    {
        $expiration = 3600;
        $_SESSION['expiration'] = time() + $expiration;
    }

    public function ifExpired()
    {
        $user = new User;

        if (isset($_SESSION['expiration']) && $_SESSION['expiration'] < time()) {
            $user->logout();
        } else {
            $this->setExpiry();
        }
    }
}