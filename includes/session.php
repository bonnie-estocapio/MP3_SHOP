<?php

Class Session
{
    public function write($sessionID, $username)
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $query = $this->query("INSERT INTO sessions (session_id, user) VALUES ('$sessionID', '$username')");
        }
    }
}