<?php
$plats = getAllPlatsByUser($pdo, $_SESSION["user_id"]);
?>

<?php
// Include head of htmp pages
require("./views/partials/head.php");
?>

<h1 class="title">Edition de vos plats</h1>

<a href="?page=addplats">Ajouter un plat</a>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($plats as $plat) { ?>
            <tr>
                <td><?= $plat["nom"] ?></td>
                <td><?= $plat["type"] ?></td>
                <td><?= $plat["description"] ?></td>
                <td>
                    <a href="?page=editplats&id=<?= $plat['id_plat'] ?>">
                        Editer
                    </a>
                    <a href="?page=delplats&id=<?= $plat['id_plat'] ?>"
                        onclick="return confirm('Etes vous certain de vouloir supprimer ce plat ?');">
                        Supprimer
                    </a>
                </td>
            </tr>
        <? } ?>
    </tbody>
</table>

<?php
// Include tail of html pages
require("./views/partials/tail.php");
?>