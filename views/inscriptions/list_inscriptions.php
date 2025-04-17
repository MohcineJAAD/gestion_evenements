<?php
require_once '../../controllers/InscriptionController.php';
$controller = new InscriptionController();
$inscriptions = $controller->getAll();
include '../layout/header.php';
?>

<h2>Liste des inscriptions</h2>

<table>
    <tr>
        <th>Participant</th>
        <th>Email</th>
        <th>Événement</th>
        <th>Date d’inscription</th>
    </tr>
    <?php foreach($inscriptions as $i) : ?>
        <tr>
            <td><?php echo $i['nom']; ?></td>
            <td><?php echo $i['email']; ?></td>
            <td><?php echo $i['titre']; ?></td>
            <td><?php echo $i['date_inscription']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
include '../layout/footer.php';
?>