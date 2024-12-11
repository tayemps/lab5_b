<?php
class User {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($matric, $name, $password, $role) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO $this->table (matric, name, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $matric, $name, $passwordHash, $role);
        return $stmt->execute();
    }

    public function getUsers() {
        return $this->conn->query("SELECT matric, name, role FROM $this->table");
    }

    public function getUser($matric) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE matric = ?");
        $stmt->bind_param("s", $matric);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($matric, $name, $role) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET name = ?, role = ? WHERE matric = ?");
        $stmt->bind_param("sss", $name, $role, $matric);
        return $stmt->execute();
    }

    public function deleteUser($matric) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE matric = ?");
        $stmt->bind_param("s", $matric);
        return $stmt->execute();
    }
}
?>
