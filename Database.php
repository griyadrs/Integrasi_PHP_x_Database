<?php

class Database
{
    private string 
        $host     = 'localhost',
        $username = 'root',
        $password = '',
        $database = 'demo_intern';
    private mysqli $connection;

    public function __construct() 
    {
        $connect = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        // if connect failed
        if ($connect->connect_error) {
            die("connection failed {$connect->connect_error}");
        }

        $this->connection = $connect;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function connection(): mysqli
    {
        return $this->connection;
    }
}