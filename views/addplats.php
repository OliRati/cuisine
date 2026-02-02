<?php
$errors = [];
$nom = "";
$type = "";
$description = "";

if (isset($_POST['ajouter']) && !empty($_POST['ajouter'])) {
    $nom = trim(htmlspecialchars($_POST['nom']));
    if (empty($nom))
        $errors[] = "Veuillez entrer un nom de plat.";
    elseif (strlen($nom) <= 2)
        $errors[] = "Le nom du plat doit faire plus de 2 caractères";

    $type = trim(htmlspecialchars($_POST['type']));
    if (empty($type))
        $errors[] = "Veuillez entrer un type de plat.";
    elseif (strlen($type) <= 2)
        $errors[] = "Le type de plat doit faire plus de 2 caractères";

    $description = trim(htmlspecialchars($_POST["description"]));
    if (empty($description))
        $errors[] = "Veuillez entrer une description de plat.";

    if (count($errors) === 0) {
        if (ajouterPlats($pdo, $nom, $type, $description, $_SESSION["user_id"]))
            header("Location: ./index.php?page=plats");

        $erreur[] = "Impossible d'ajouter ce plat.";
    }
}
?>

<?php
// Include head of htmp pages
require("./views/partials/head.php");
?>

<h1>Ajouter un plat</h1>

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
            <input type="submit" name="ajouter" value="Ajouter">
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