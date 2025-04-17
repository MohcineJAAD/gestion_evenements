<?php
require_once '../../controllers/EventController.php';

$message = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    
    $controller = new EventController();
    $result = $controller->create($title, $date, $description);
    $message = $result === true ? "Événement créé avec succès" : $result;
}

include '../layout/header.php';
?>

<h2>Créer un événement</h2>

<form method="post" action="">
    <label for="title">Titre :</label>
    <input type="text" name="title" id="title">
    <label for="date">Date :</label>
    <input type="date" name="date" id="date">
    <label for="description">Description :</label>
    <textarea name="description" id="description"></textarea>
    <input type="submit" value="Créer">
</form>

<?php
echo "<p>$message</p>";
include '../layout/footer.php';
?>
