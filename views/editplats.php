<?php
$errors = [];
$nom = "";
$type = "";
$description = "";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idPlat = $_GET['id'];

    $plat = getPlatsById($pdo, $idPlat);
    $nom = $plat["nom"];
    $type = $plat["type"];
    $description = $plat["description"];
}

if (isset($_POST['ajouter']) && !empty($_POST['ajouter'])) {
    $nom = trim(htmlspecialchars($_POST['nom']));
    if (empty($nom))
        $errors[] = "Veuillez entrer un nom de plat.";

    $type = trim(htmlspecialchars($_POST['type']));
    if (empty($type))
        $errors[] = "Veuillez entrer un type de plat.";

    $description = trim(htmlspecialchars($_POST["description"]));
    if (empty($description))
        $errors[] = "Veuillez entrer une description de plat.";

    if (count($errors) === 0) {
        if (modifierPlats($pdo, $idPlat, $nom, $type, $description, $_SESSION["user_id"]))
            header("Location: ./index.php?page=plats");

        $erreur[] = "Impossible d'ajouter ce plat.";
    }
}
?>

<?php
// Include head of htmp pages
require("./views/partials/head.php");
?>

<h1 class="title">Modifier votre plat</h1>

<div class="plats-form">
    <form action="" method="post">
        <div>
            <input type="text" name="nom" value="<?= $nom ?>" placeholder="Nom du plat">
        </div>
        <div>
            <input type="text" name="type" value="<?= $type ?>" placeholder="Type de plat">
        </div>
        <div>
            <textarea name="description"><?= $description ?></textarea>
        </div>
        <div>
            <input type="submit" name="ajouter" value="Modifier">
        </div>
        <div class="error">
            <?php foreach ($errors as $error) { ?>
                <div><?= $error ?></div>
            <?php } ?>
        </div>
    </form>
</div>

<?php
// Include tail of html pages
require("./views/partials/tail.php");
?>