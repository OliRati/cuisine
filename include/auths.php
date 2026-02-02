<?php

function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    }

    return false;
}

function logoutCuisiniers()
{
    session_destroy();
}

function loginCuisiniers($pdo, $email, $password)
{
    $sql = "SELECT * FROM cuisiniers WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([":email" => $email]);

    if (!$state)
        return false;

    $cuisinier = $stmt->fetch();
    if ($cuisinier === false)
        return false;

    if (!password_verify($password, $cuisinier["password"]))
        return false;

    $_SESSION["user_id"] = $cuisinier["id_cuisinier"];
    $_SESSION["name"] = $cuisinier["nom"];

    return true;
}

function isEmailInCuisiniers($pdo, $email)
{
    $sql = "SELECT COUNT(*) AS nb FROM cuisiniers WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $email]);
    $count = $stmt->fetch();

    if ($count['nb'] != 0)
        return true;

    return false;
}

function registerCuisiniers($pdo, $nom, $specialite, $email, $password, $avatar)
{
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO cuisiniers ( nom, specialite, email, password, avatar)
            VALUES ( :nom, :specialite, :email, :password, :avatar )";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([
        ":nom" => $nom,
        ":specialite" => $specialite,
        ":email" => $email,
        ":password" => $hashed_password,
        ":avatar" => $avatar
    ]);

    return $state;
}

function getCuisinierByEmail($pdo, $email)
{
    $sql = "SELECT * FROM cuisiniers WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([":email" => $email]);

    if (!$state)
        return false;

    $cuisinier = $stmt->fetch();
    if ($cuisinier === false)
        return false;

    return $cuisinier;
}

function getCuisinierById($pdo, $idCuisinier)
{
    $sql = "SELECT * FROM cuisiniers WHERE id_cuisinier = :id_cuisinier";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([":id_cuisinier" => $idCuisinier]);

    if (!$state)
        return false;

    $cuisinier = $stmt->fetch();
    if ($cuisinier === false)
        return false;

    return $cuisinier;
}

function updateCuisiniers($pdo, $idCuisinier, $nom, $specialite, $email)
{
    $sql = "UPDATE cuisiniers SET nom = :nom, specialite = :specialite, email = :email WHERE id_cuisinier = :id_cuisinier";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([
        ":nom" => $nom,
        ":specialite" => $specialite,
        ":email" => $email,
        ":id_cuisinier" => $idCuisinier
    ]);

    return $state;
}

function updateCuisiniersAvatar($pdo, $idCuisinier, $avatar)
{
    $sql = "UPDATE cuisiniers SET avatar = :avatar WHERE id_cuisinier = :id_cuisinier";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([
        ":id_cuisinier" => $idCuisinier,
        ":avatar" => $avatar
    ]);

    return $state;
}
