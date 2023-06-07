<?php

Class Functions
{
    public float $totalOrder = 0;
    public int $countOrder = 0;
    private bool $guest = true;

    public function filter($s, $flags=null)
    {
        if (is_string($s))
        {
            return($flags === null) ? htmlspecialchars($s) : htmlspecialchars($s, $flags);
        }
        else
        {
            return "";
        }
    }

    public function state()
    {
        $guest = true;
        if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) {
            $guest = true;
            for ($i = 1; $i<=9; $i++) {
                $_SESSION['product_'.$i] = 0;
            }
            $_SESSION['loggedin'] = false;
            $_SESSION['user'] = 'Guest';
         } elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $guest = false;
        }
        return $guest;
    }

    public function getID()
    {

    }

    public function prefix()
    {
        
    }
}