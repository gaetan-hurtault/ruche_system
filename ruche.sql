-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 11 mai 2021 à 18:03
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ruche`
--

-- --------------------------------------------------------

--
-- Structure de la table `information_ruche`
--

DROP TABLE IF EXISTS `information_ruche`;
CREATE TABLE IF NOT EXISTS `information_ruche` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_ruche` int NOT NULL,
  `date` datetime NOT NULL,
  `poids` decimal(10,0) NOT NULL,
  `temperature` int NOT NULL,
  `humidite` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clef etrangere` (`id_ruche`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `information_ruche`
--

INSERT INTO `information_ruche` (`id`, `id_ruche`, `date`, `poids`, `temperature`, `humidite`) VALUES
(3, 20, '2021-05-11 14:41:29', '15', 42, 11),
(4, 24, '2021-05-20 14:41:29', '16', 22, 10),
(5, 22, '2021-05-09 14:42:21', '152', 455, 45),
(6, 27, '2021-05-20 14:41:29', '54', 52, 14),
(7, 23, '2021-05-14 14:42:21', '45', 21, 74),
(8, 25, '2021-05-14 14:42:21', '12', 47, 547),
(9, 30, '2021-05-17 14:42:21', '15', 65, 45),
(10, 28, '2021-05-15 14:42:21', '15', 31, 47),
(11, 27, '2021-05-14 14:42:21', '1231', 13, 42),
(12, 28, '2021-05-29 14:42:21', '45', 47, 12),
(13, 28, '2021-05-22 14:42:21', '13', 13, 12),
(14, 25, '2021-05-21 14:42:21', '13', 12, 74);

-- --------------------------------------------------------

--
-- Structure de la table `ruche`
--

DROP TABLE IF EXISTS `ruche`;
CREATE TABLE IF NOT EXISTS `ruche` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8_bin NOT NULL,
  `latitude` decimal(8,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ruche`
--

INSERT INTO `ruche` (`id`, `nom`, `latitude`, `longitude`) VALUES
(20, 'Ruche 1', '67.614500', '-87.590500'),
(21, 'Ruche 2', '23.017000', '5.256300'),
(22, 'Ruche 3', '-36.747100', '-45.872800'),
(23, 'Ruche 4', '33.781300', '-39.201000'),
(24, 'Ruche 5', '-33.795400', '167.653500'),
(25, 'Ruche 8', '22.498300', '118.494600'),
(26, 'Ruche 6', '-48.375500', '84.098200'),
(27, 'Ruche 10', '-68.569500', '45.638300'),
(28, 'Ruche 27', '16.461200', '-141.214500'),
(29, 'Ruche 42', '-59.204100', '-21.899800'),
(30, 'Ruche 66', '82.635300', '-140.999100'),
(31, 'Ruche 99', '23.888700', '-21.499200');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `information_ruche`
--
ALTER TABLE `information_ruche`
  ADD CONSTRAINT `clef etrangere` FOREIGN KEY (`id_ruche`) REFERENCES `ruche` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
