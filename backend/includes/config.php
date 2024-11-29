<?php
class Database {
    private $host = "localhost";    // Database host
    private $db_name = "giftem_db";  // Database name
    private $username = "root";     // Database username
    private $password = "";         // Database password
    public $conn;

    // Establish a connection
    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }

    // Close connection
    public function close() {
        $this->conn = null;
    }
}
?>
