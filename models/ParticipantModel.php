<?php
require_once __DIR__ . '/../config/Database.php';

class ParticipantModel {
    private $conn;

    public function __construct() {
        $db = new database();
        $this->conn = $db->getConnection();
    }

    public function getAllParticipants() {
        $sql = "select * from participants";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getParticipantById($id) {
        $sql = "select * from participants wher id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getParticipantByEmail($email) {
        $sql = "select * from participants where email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createParticipant($nom, $email) {
        $sql = "insert into participants (nom, email) values (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $email);
        return $stmt->execute();
    }
}