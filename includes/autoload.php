<?php

spl_autoload_register(function ($path) {
    $path = __DIR__ . '/' . lcfirst(str_replace('\\','/', $path)) . '.php';
    require $path;
});