<?php
require_once __DIR__ . '/../../config/database.php';

class User {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );

        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        return $stmt->execute();
    }

    public function emailExists($email) {
        $stmt = $this->db->prepare(
            "SELECT id FROM users WHERE email = ? LIMIT 1"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }
}
public function findByEmail($email) {
    $stmt = $this->db->prepare(
        "SELECT * FROM users WHERE email = ? AND status = 'active' LIMIT 1"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
