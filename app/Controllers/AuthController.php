<?php
require_once __DIR__ . '/../Models/User.php';

class AuthController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function register($data) {
        $name = trim($data['name']);
        $email = trim($data['email']);
        $password = $data['password'];

        if (empty($name) || empty($email) || empty($password)) {
            return "All fields are required";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format";
        }

        if ($this->user->emailExists($email)) {
            return "Email already registered";
        }

        if (strlen($password) < 6) {
            return "Password must be at least 6 characters";
        }

        return $this->user->create($name, $email, $password)
            ? "success"
            : "Registration failed";
    }
}
