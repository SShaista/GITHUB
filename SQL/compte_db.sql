SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Création de la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS compte_db;
USE compte_db;

-- Création de la table `utilisateurs`
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

 
COMMIT;
