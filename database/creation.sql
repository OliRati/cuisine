-- 
-- Création de la base de données
-- 

CREATE DATABASE IF NOT EXISTS `cuisine` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `cuisine`;

DROP TABLE IF EXISTS `cuisiniers`;
DROP TABLE IF EXISTS `plats`;
DROP TABLE IF EXISTS `categories`;

CREATE TABLE `cuisiniers` (
    `id_cuisinier` INT NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(100) NOT NULL,
    `specialite` VARCHAR(100) DEFAULT NULL,
    `email` VARCHAR(150) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `avatar` VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`id_cuisinier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `categories` (
    `id_categorie`INT NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `plats` (
    `id_plat` INT NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(150) NOT NULL,
    `type` VARCHAR(100) NOT NULL,
    `description` TEXT,
    `id_cuisinier` INT DEFAULT NULL,
    `id_categorie` INT DEFAULT NULL,
    PRIMARY KEY (`id_plat`),
    CONSTRAINT `plats_ibfk_cuisinier` FOREIGN KEY (`id_cuisinier`) REFERENCES `cuisiniers` (`id_cuisinier`) ON DELETE SET NULL,
    CONSTRAINT `plats_ibfk_categierie` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
