<?php

Class Database
{
    public $connection;

    public function __construct()
    {
        $this->db_connect();
    }

    public function db_connect()
    {
        
        $this->connection = mysqli_connect('localhost', 'root', 'root', 'music_shop');
        if (!$this->connection) {
            echo "Not Connected";
        }
    }

    public function query($sql)
    {
        return mysqli_query($this->connection, $sql);
    }
}