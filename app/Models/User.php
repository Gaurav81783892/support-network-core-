<?php
require_once __DIR__ . '/../../config/database.php';

class User {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }
}
