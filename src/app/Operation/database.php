<?php

namespace App\Operation;

class Database
{
    protected $dbUsername = 'root';
    protected $dbPassword = 'root';
    protected $dbHost = 'localhost';
    protected $dbName = 'music_shop';
    public $conn;

    public function __construct()
    {
        $this->db_connect();
    }

    public function db_connect(): void
    {
        try {
            $this->conn = new \PDO(
                "mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName,
                $this->dbUsername,
                $this->dbPassword
            );
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function query($sql): mixed
    {
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query;
    }
}