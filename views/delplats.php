<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idPlat = $_GET['id'];

    if (supprimerPlats($pdo, $idPlat))
        header("Location: ./index.php?page=plats");
}
?>

<?php
// Include head of htmp pages
require("./views/partials/head.php");
?>

<h1 class="title">Une erreur s'est produite.</h1>
<p class="subtitle">Impossible de supprimer ce plat.</p>

<?php
// Include tail of html pages
require("./views/partials/tail.php");
?>