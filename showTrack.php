<?php

require_once 'functions.php';


class ShowTrack
{
    public function list($trackId)
    {
        $functions = new Functions;
        $query = $functions->query("SELECT id, title, artist, year, album, genre,price FROM tracks WHERE id=$trackId");
        $data = mysqli_fetch_assoc($query);
        return $data;
    }
}