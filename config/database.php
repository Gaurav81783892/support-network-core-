<?php
class Database {
    private static $instance = null;
    private $connection;

    private $host = "localhost";
    private $db   = "support_network";
    private $user = "db_user";
    private $pass = "db_password";

    private function __construct() {
        $this->connection = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->db
        );

        if ($this->connection->connect_error) {
            die("Database Connection Failed");
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}
