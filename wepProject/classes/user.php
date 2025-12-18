<?php
class User
{
    private $conn;
    private $table = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['password'] === hash('sha256', $password)) {
                return $row;
            }
        }
        return false;
    }

    public function getAllUsers() {
        $query = "SELECT id, username, level FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
        }
        
        
        public function createUser($username, $password, $level) {
        $query = "INSERT INTO users (username, password, level)
        VALUES (:username, :password, :level)";
        $stmt = $this->conn->prepare($query);
        
        
        $hash = hash('sha256', $password);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':level', $level);
        
        
        return $stmt->execute();
        }
        
        
        public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
        }
}
