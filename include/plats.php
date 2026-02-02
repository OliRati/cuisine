<?php

function getAllPlats($pdo) {
    $sql = "SELECT * FROM plats";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute();

    if ($state) {
        $plats = $stmt->fetchAll();
        return $plats;
    }

    return [];
}

function getAllPlatsByUser($pdo, $idCuisinier) {
    $sql = "SELECT * FROM plats WHERE id_cuisinier = :id_cuisinier";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([
        ":id_cuisinier" => $idCuisinier
    ]);

    if ($state) {
        $plats = $stmt->fetchAll();
        return $plats;
    }

    return [];
}

function getPlatsById($pdo, $idPlat) {
    $sql = "SELECT * FROM plats WHERE id_plat = :id_plat";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([
        ":id_plat" => $idPlat
    ]);

    if ($state) {
        $plat = $stmt->fetch();
        return $plat;
    }

    return [];
}

function ajouterPlats($pdo, $nom, $type, $description, $idCuisinier, $idCategorie = 1)
{
    $sql = "INSERT INTO plats ( nom, type, description, id_cuisinier, id_categorie )
            VALUES (:nom, :type, :description, :id_cuisinier, :id_categorie )";

    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([
        ":nom" => $nom,
        ":type" => $type,
        ":description" => $description,
        ":id_cuisinier" => $idCuisinier,
        ":id_categorie" => $idCategorie
    ]);

    return $state;
}

function modifierPlats($pdo, $idPlat, $nom, $type, $description, $idCuisinier) {
    $sql = "UPDATE plats SET nom = :nom, type = :type, description = :description WHERE id_plat = :id_plat";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([
        ":nom" => $nom,
        ":type" => $type,
        ":description" => $description,
        ":id_plat" => $idPlat
    ]);

    return $state;
}

function supprimerPlats($pdo, $idPlat) {
    $sql = "DELETE FROM plats WHERE id_plat = :id_plat";
    $stmt = $pdo->prepare($sql);
    $state = $stmt->execute([
        ":id_plat" => $idPlat
    ]);

    return $state;
}
