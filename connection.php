<?php
class DatabaseConnection
{
    private $host = 'localhost';
    private $db = 'ecomm_2024june';
    private $user = 'root';
    private $pass = 'uditha321';
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
?>