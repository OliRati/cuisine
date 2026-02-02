<?php
$errors = [];

$cuisinier = getCuisinierById($pdo, $_SESSION["user_id"]);

$nom = $cuisinier["nom"];
$email = $cuisinier["email"];
$specialite = $cuisinier["specialite"];
$avatar = "";

function uploadAvatar($idCuisinier)
{
    $errors = [];

    // Check if avatar was sent
    if (!isset($_FILES['avatar'])) {
        $errors[] = "Aucun avatar n'a été transmis";
        return false;
    }

    // Check if avatar was sent without errors
    if ($_FILES['avatar']['error'] > 0) {
        $errors[] = "Le transfert de l'avatar n'a pas pu être effectué.";
        return false;
    }

    if (!preg_match("/(jpg)|(jpeg)|(png)|(webp)/", $_FILES['avatar']['type'])) {
        $errors[] = "Le type du fichier pour l'avatar doit etre jpg, jpeg, png ou webp";
        return false;
    }

    if (!file_exists("./assets/avatars"))
        mkdir("./assets/avatars", 0755);

    move_uploaded_file(
        $_FILES['avatar']['tmp_name'],
        "./assets/avatars/" . $idCuisinier . "-" . $_FILES['avatar']['full_path']
    );

    return "./assets/avatars/" . $idCuisinier . "-" . $_FILES['avatar']['full_path'];
}

if (isset($_POST['update']) && !empty($_POST['update'])) {
    $nom = trim(htmlspecialchars($_POST['nom']));
    if (empty($nom))
        $errors[] = "Veuillez entrer un nom valide";

    $specialite = trim(htmlspecialchars($_POST['specialite']));

    $email = trim(htmlspecialchars($_POST['email']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Veuillez entrer un email valide.";

    if (!isset($_FILES['avatar']))
        $errors[] = "Un avatar de moins de 2Mo au format jpg, jpeg, png, webp est requis";

    $avatar = uploadAvatar($_SESSION["user_id"]);
    if ($avatar === false) {
        $errors[] = "Le telechargement de votre avatar n'a pas été possible";
    }

    if (count($errors) === 0) {
        if (!updateCuisiniers($pdo, $_SESSION["user_id"], $nom, $specialite, $email, $avatar))
            $errors[] = "Impossible d'enregistrer les données";
    }


    if (count($errors) === 0) {
        header("Location: ./index.php?page=plats");
    }
}
?>

<?php
// Include head of htmp pages
require("./views/partials/head.php");
?>

<h1 class="title">Edition de votre profil</h1>

<div class="register-form">
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <input type="text" name="nom" placeholder="Votre nom" value="<?= $nom ?>">
        </div>
        <div>
            <input type="text" name="specialite" placeholder="Votre spécialité" value="<?= $specialite ?>">
        </div>
        <div>
            <input type="email" name="email" placeholder="Votre email" value="<?= $email ?>">
        </div>
        <div>
            <input type="file" name="avatar">
        </div>
        <div>
            <input type="submit" name="update" value="Mettre à jour">
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