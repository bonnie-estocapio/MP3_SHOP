<?php

Class Navigation
{
    public function getCurrent()
    {
        return $_SERVER['REQUEST_URI'];
    }
    
    public function goTo($location)
    {
        header("Location: {$location}");
    }
}
