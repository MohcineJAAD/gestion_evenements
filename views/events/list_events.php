<?php
require_once '../../controllers/EventController.php';

$controller = new EventController();
$events = $controller->getAll();
include '../layout/header.php';
?>
<h2>Liste des événements</h2>

<table>
    <tr>
        <th>Titre</th>
        <th>Date</th>
        <th>Description</th>
    </tr>
    <?php foreach($events as $event) : ?>
        <tr>
            <td><?php echo $event['titre']; ?></td>
            <td><?php echo $event['date_evenement']; ?></td>
            <td><?php echo $event['description']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
include '../layout/footer.php';
?>