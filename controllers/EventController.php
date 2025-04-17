<?php
require_once __DIR__ . '/../models/EventModel.php';
// require_once "../models/EventModel.php";

class EventController {
    private $model;

    public function __construct() {
        $this->model = new EventModel();
    }

    public function create($title, $date, $description) {
        if (empty($title) || empty($date))
            return "Le titre et la date sont obligatoires.";

        if(!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date))
            return "Format de date invalide (AAAA-MM-JJ).";
        
        try {
            $this->model->createEvent($title, $description, $date);
            return true;
        } catch (Exception $e) {
            return "Erreur lors de l'ajout : ".$e->getMessage();
        }
    }

    public function update($id, $title, $date, $description) {
        if (empty($title) || empty($date))
            return "Le titre et la date sont obligatoires.";

        if(!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date))
            return "Format de date invalide (AAAA-MM-JJ).";

        try {
            $this->model->updateEvent($id, $title, $description, $date);
            return true;
        } catch (Exception $e) {
            return "Erreur lors de la mise à jour : ".$e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $this->model->deleteEvent($id);
            return true;
        } catch (Exception $e) {
            return "Erreur lors de la suppression : ".$e->getMessage();
        }
    }

    public function getAll() {
        try {
            return $this->model->getAllEvents();
        } catch (Exception $e) {
            return "Erreur lors de la récupération des événements : ".$e->getMessage();
        }
    }

    public function getById($id) {
        try {
            return $this->model->getEventById($id);
        } catch (Exception $e) {
            return "Erreur lors de la récupération de l'événement : ".$e->getMessage();
        }
    }
}
