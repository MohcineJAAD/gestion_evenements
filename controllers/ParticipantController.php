<?php
require_once __DIR__ . "/../models/ParticipantModel.php";

class ParticipantController {
    private $model;

    public function __construct()
    {
        $this->model = new ParticipantModel();
    }
    
    public function register($nom, $email) {
        if(empty($nom) || empty($email))
            return "Nom et email sont requis.";

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            return "Email invalide.";

        try {
            $existe = $this->model->getParticipantByEmail($email);
            if($existe)
                return $existe['id'];
            $this->model->createParticipant($nom, $email);
            $participant = $this->model->getParticipantByEmail($email);
            return $participant['id'];
        } catch (Exception $e) {
            return "Erreur d'enregistrement : ".$e->getMessage();
        }
    }
}
