<?php

namespace App\Operation;

Class Database
{
    protected $db_username = 'root';
    protected $db_password = 'root';
    protected $db_host = 'localhost';
    protected $db_name = 'music_shop';
    public $conn;

    public function __construct()
    {
        $this->db_connect();
    }

    public function db_connect()
    {
        try {
            $this->conn = new \PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name , $this->db_username, $this->db_password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function query($sql)
    {
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query;
    }
}