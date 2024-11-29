<?php
session_start();
require_once "config.php";

class Login {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Authenticate user
    public function authenticate($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['status'] = $row['status'];
                return true;
            }
        }
        return false;
    }

    // Logout user
    public function logout() {
        session_unset();  // Unset all session variables
        session_destroy(); // Destroy the session
        header("Location: index.php"); // Redirect to login page
        exit;
    }
}

// Example process login (commented out for flexibility)
/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = (new Database())->connect();
    $login = new Login($db);

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($login->authenticate($email, $password)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid login credentials!";
    }

    $db = null; // Close the connection
}
*/
?>
