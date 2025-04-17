<?php
require_once __DIR__ . '/../config/Database.php';

class InscriptionModel {
    private $conn;

    public function __construct() {
        $db = new database();
        $this->conn = $db->getConnection();
    }

    public function getAllInscriptions() {
        $sql = "select i.id, p.nom, p.email, e.titre, p.nom, p.email, i.date_inscription
        from inscriptions i
        join events e on i.event_id = e.id
        join participants p on i.participant_id = p.id
        order by i.date_inscription desc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register($event_id, $participant_id) {
        $sql = "insert into inscriptions (event_id, participant_id, date_inscription) values (?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $participant_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}