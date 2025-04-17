<?php
require_once __DIR__ . '/../../controllers/ParticipantController.php';
require_once __DIR__ . '/../../controllers/InscriptionController.php';
require_once __DIR__ . '/../../controllers/EventController.php';

$participantController = new ParticipantController();
$inscriptionController = new InscriptionController();
$eventController = new EventController();

$message = "";
$events = $eventController->getAll();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $participant_id = $participantController->register($_POST['nom'], $_POST['prenom']);
    if(is_numeric($participant_id)) {
        $res = $inscriptionController->inscrire($_POST['event_id'], $participant_id);
        $message = $res === true ? "Inscription réussie" : $res;
    } else {
        $message = $participant_id;
    }
}

include __DIR__ . '/../layout/header.php';
?>

<h2>Inscription à un événement</h2>

<form method="post" action="">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom"><br>
    <label for="prenom">Email :</label>
    <input type="email" name="prenom" id="prenom"><br>
    <label for="event_id">Événement :</label>
    <select name="event_id" id="event_id">
        <option value="" disabled selected>Sélectionnez un événement</option>
        <?php foreach($events as $event) : ?>
            <option value="<?php echo $event['id']; ?>"><?php echo $event['titre']; ?> - <?= $event['date_evenement'] ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <input type="submit" value="S'inscrire">
</form>

<?php
echo "<p>$message</p>";
include '../layout/footer.php';
?>
