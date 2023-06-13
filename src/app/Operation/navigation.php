<?php

namespace App\Operation;

Class Navigation
{
    public function getCurrent(): string
    {
        return $_SERVER['REQUEST_URI'];
    }
    
    public function goTo($location): void
    {
        header("Location: {$location}");
    }
}
