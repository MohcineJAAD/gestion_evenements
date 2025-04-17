<?php
require_once __DIR__ . "/../models/InscriptionModel.php";

class InscriptionController {
    private $model;

    public function __construct()
    {
        $this->model = new InscriptionModel();
    }

    public function inscrire($eventId, $participantId) {
        if(empty($eventId) || empty($participantId))
            return "Erreur : Données manquantes.";

        try {
            $this->model->register($eventId, $participantId);
            return true;
        } catch (Exception $e) {
            return "Erreur d'inscription : ".$e->getMessage();
        }
    }

    public function getAll() {
        return $this->model->getAllInscriptions();
    }
}
