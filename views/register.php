<?php
$errors = [];
$nom = "";
$email = "";
$specialite = "";
$avatar = "";

function uploadAvatar( $idCuisinier )
{
    $errors = [];

    // Check if avatar was sent
    if (!isset($_FILES['avatar']))
        return false;

    // Check if avatar was sent without errors
    if ($_FILES['avatar']['error'] > 0) {
        return "Le transfert de l'avatar n'a pas pu être effectué.";
    }
    
    if (!preg_match("/(jpg)|(jpeg)|(png)|(webp)/", $_FILES['avatar']['type']))
        return "Le type du fichier pour l'avatar doit etre jpg, jpeg, png ou webp";

    if (!file_exists("./assets/avatars")) 
        mkdir("./assets/avatars", 0755);

    move_uploaded_file($_FILES['avatar']['tmp_name'],
                       "./assets/avatars/".$idCuisinier."-". $_FILES['avatar']['full_path']);
    return true;
}

if (isset($_POST['register']) && !empty($_POST['register'])) {
    $nom = trim(htmlspecialchars($_POST['nom']));
    if (empty($nom))
        $errors[] = "Veuillez entrer un nom valide";

    $specialite = trim(htmlspecialchars($_POST['specialite']));

    $email = trim(htmlspecialchars($_POST['email']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Veuillez entrer un email valide.";

    $password = trim($_POST['password']);
    $passwordConfirm = trim($_POST['password-confirm']);

    if (empty($password) || empty($passwordConfirm))
        $errors[] = "Veuillez enter un mot de passe et sa confirmation";

    if ($password !== $passwordConfirm)
        $errors[] = "Les mots de passe ne correspondent pas";

    if (strlen($password) < 8)
        $errors[] = "Le mot de passe doit avoir 8 caractères minimum";

    if (isEmailInCuisiniers($pdo, $email))
        $errors[] = "Cet email est déjà utilisé.";

    if (!isset($_FILES['avatar']))
        $errors[] = "Un avatar de moins de 2Mo au format jpg, jpeg, png, webp est requis";

    if (count($errors) === 0) {
        if (!registerCuisiniers($pdo, $nom, $specialite, $email, $password, $avatar))
            $errors[] = "Impossible d'enregistrer les données";
    }

    if (count($errors) === 0) {
        $cuisinier = getCuisinierbyEmail($pdo, $email);
        $state = uploadAvatar($cuisinier["id_cuisinier"]);
        if ($state !== true)
            $errors[] = "Votre compte est crée. Le telechargement de votre avatar n'a pas été possible";
    }

    if (count($errors) === 0) {
        header("Location: ./index.php?page=home");
    }
}
?>

<?php
// Include head of htmp pages
require("./views/partials/head.php");
?>

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
            <label for="password">Le mot de passe doit contenir au minimunm 8 caractères.</label>
        </div>
        <div>
            <input type="password" name="password" placeholder="Votre mot de passe">
        </div>
        <div>
            <input type="password" name="password-confirm" placeholder="Confirmez votre mot de passe">
        </div>
        <div>
            <input type="file" name="avatar">
        </div>
        <div>
            <input type="submit" name="register" value="Valider">
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