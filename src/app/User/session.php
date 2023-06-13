<?php

namespace App\User;

use App\Operation\Database;

Class Session
{
    public function write($sessionID, $username): void
    {
        $database = new Database;
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $database->query("INSERT INTO sessions (session_id, user) VALUES ('$sessionID', '$username')");
        }
    }
}