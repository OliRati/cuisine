<?php
$plats = getAllPlats($pdo);
?>

<?php
// Include head of htmp pages
require("./views/partials/head.php");
?>

<h1 class="title">Bienvenue sur Cuisine</h1>
<h2 class="subtitle">Liste des plats disponibles</h1>

<table>
    <thead>
        <tr>
            <th>Auteur</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($plats as $plat) { ?>
            <tr>
                <td><?= getCuisinierById($pdo, $plat["id_cuisinier"])['nom'] ?></td>
                <td><?= $plat["nom"] ?></td>
                <td><?= $plat["type"] ?></td>
                <td><?= $plat["description"] ?></td>
            </tr>
        <? } ?>
    </tbody>
</table>
