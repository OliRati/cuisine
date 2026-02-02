<?php
$errors = [];
$email = "";

if (isset($_POST['login']) && !empty($_POST['login'])) {
    $email = trim(htmlspecialchars($_POST['email']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Veuillez entrer un email valide.";

    $password = trim($_POST['password']);
    if (empty($password))
        $errors[] = "Veuillez entrer un mot de passe.";

    if (count($errors) === 0) {
        if (loginCuisiniers($pdo, $email, $password))
            header("Location: ./index.php?page=plats");

        $errors[] = "Mauvais email ou mot de passe.";
    }
}
?>

<?php
// Include head of htmp pages
require("./views/partials/head.php");
?>

<div class="login-form">
    <form action="" method="post">
        <div>
            <input type="email" name="email" placeholder="Votre email" value="<?= $email ?>">
        </div>
        <div>
            <input type="password" name="password" placeholder="Votre mot de passe">
        </div>
        <div>
            <input type="submit" name="login" value="Valider">
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