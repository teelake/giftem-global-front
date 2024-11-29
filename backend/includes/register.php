<?php
require_once "config.php";

class Register {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to check if the email already exists
    public function emailExists($email) {
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Method to register a new user
    public function registerUser($name, $email, $password) {
        if ($this->emailExists($email)) {
            return "Email already exists. Please use a different email.";
        }

        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $status='1';
        $role ='Admin';

        $query = "INSERT INTO users (email, password, first_name, last_name, role, status)
         VALUES (:email, :password, :first_name, :last_name, :role, :status)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":first_name", $first_name);
        $stmt->bindParam(":last_name", $last_name);
        $stmt->bindParam(":status", $status);

        if ($stmt->execute()) {
            return "User registered successfully!";
        } else {
            return "Failed to register user.";
        }
    }
}
?>
