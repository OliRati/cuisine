<?php
$errors = [];

$cuisinier = getCuisinierById($pdo, $_SESSION["user_id"]);

$nom = $cuisinier["nom"];
$email = $cuisinier["email"];
$specialite = $cuisinier["specialite"];
$avatar = $cuisinier["avatar"];

function uploadAvatar($idCuisinier, $previousAvatar)
{
    $errors = [];

    // Check if avatar was sent
    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = "Aucun avatar n'a été transmis";
        return false;
    }

    // Check if avatar was sent without errors
    if ($_FILES['avatar']['error'] > 0) {
        $errors[] = "Le transfert de l'avatar n'a pas pu être effectué.";
        return false;
    }

    // Check if avatar have the right format
    if (!preg_match("/(jpg)|(jpeg)|(png)|(webp)/", $_FILES['avatar']['type'])) {
        $errors[] = "Le type du fichier pour l'avatar doit etre jpg, jpeg, png ou webp";
        return false;
    }

    // Create avatar directory if not already exist
    if (!file_exists("./assets/avatars"))
        mkdir("./assets/avatars", 0755);

    // Remove previous avatar
    if (file_exists($previousAvatar))
        unlink($previousAvatar);

    $newAvatar = "./assets/avatars/" . $idCuisinier . "-" . $_FILES['avatar']['full_path'];

    // Move new avator to the right place
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $newAvatar)) {
        $errors[] = "Le fichier avatar ne peux pas être mis en place";
        return false;
    }

    return $newAvatar;
}

if (isset($_POST['update']) && !empty($_POST['update'])) {
    $nom = trim(htmlspecialchars($_POST['nom']));
    if (empty($nom))
        $errors[] = "Veuillez entrer un nom valide";

    $specialite = trim(htmlspecialchars($_POST['specialite']));

    $email = trim(htmlspecialchars($_POST['email']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Veuillez entrer un email valide.";

    if (count($errors) === 0) {
        if (!updateCuisiniers($pdo, $_SESSION["user_id"], $nom, $specialite, $email))
            $errors[] = "Impossible d'enregistrer les données";
    }

    if (count($errors) === 0) {
        header("Location: ./index.php?page=plats");
    }
}

$errors_avatar = [];

if (isset($_POST["update-avatar"]) && !empty($_POST["update-avatar"])) {
    $newAvatar = $avatar;

    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] === UPLOAD_ERR_NO_FILE)
        $errors_avatar[] = "Un avatar de moins de 2Mo au format jpg, jpeg, png, webp est requis";

    if (count($errors_avatar) === 0) {
        $newAvatar = uploadAvatar($cuisinier["id_cuisinier"], $cuisinier["avatar"]);
        if ($newAvatar === false) {
            $errors_avatar[] = "Le téléchargement de votre avatar n'a pas été possible";
        }
    }

    if (count($errors_avatar) === 0) {
        if (!updateCuisiniersAvatar($pdo, $cuisinier["id_cuisinier"], $newAvatar)) {
            $errors_avatar[] = "Impossible de mettre à jour l'avatar.";
        }
    }

    if (count($errors_avatar) === 0) {
        $avatar = $newAvatar;
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
            <input type="submit" name="update" value="Mettre à jour">
        </div>
        <div class="error">
            <?php foreach ($errors as $error) { ?>
                <div><?= $error ?></div>
            <?php } ?>
        </div>
    </form>
</div>

<div class="avatar-form">
    <div class="avatar-small">
        <img src="<?= $avatar ?>" alt="Votre avatar">
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="avatar">
        </div>
        <div>
            <input type="submit" name="update-avatar" value="Modifier">
        </div>
    </form>
    <div class="error">
        <?php foreach ($errors_avatar as $error_avatar) { ?>
            <div><?= $error_avatar ?></div>
        <?php } ?>
    </div>
</div>

<?php
// Include tail of html pages
require("./views/partials/tail.php");
?>