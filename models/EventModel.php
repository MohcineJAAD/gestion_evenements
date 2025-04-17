<?php
require_once __DIR__ . '/../config/Database.php';
// require_once '../config/database.php';

class EventModel {
    private $conn;

    public function __construct()
    {
        $db = new database();
        $this->conn = $db->getConnection();
    }

    public function getAllEvents()
    {
        $sql = "select * from events";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventById($id) {
        $sql = "select * from events where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createEvent($title, $description, $date) {
        $sql = "insert into events (titre, description, date_evenement) values (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $description, PDO::PARAM_STR);
        $stmt->bindParam(3, $date, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateEvent($id, $title, $description, $date) {
        $sql = "update events set titre = ?, description = ?, date_evenement = ? where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $description, PDO::PARAM_STR);
        $stmt->bindParam(3, $date, PDO::PARAM_STR);
        $stmt->bindParam(4, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteEvent($id) {
        $sql = "delete from events where id = ?";
        $stmt = $this->conn->prepare(($sql));
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}