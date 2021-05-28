-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 juil. 2020 à 08:16
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dropfile`
--

-- --------------------------------------------------------

--
-- Structure de la table `fichier`
--

DROP TABLE IF EXISTS `fichier`;
CREATE TABLE IF NOT EXISTS `fichier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `proprietaire` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `groupe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fichier`
--

INSERT INTO `fichier` (`id`, `nom`, `proprietaire`, `date`, `groupe`) VALUES
(2, '06-2020-xPROJ-Viva-GradingGrid.xlsx', 'user1', '2020-07-09', 'Groupe3'),
(3, '2PROJECT.rar', 'user1', '2020-07-09', 'Groupe3'),
(4, '2PROJECT.rar', 'Louis', '2020-07-13', 'Groupe1'),
(6, '06-2020-xPROJ-Viva-GradingGrid.xlsx', 'Louis', '2020-07-13', 'Groupe1'),
(7, '34703310.jpg', 'Louis', '2020-07-13', 'Groupe1'),
(8, '06-2020-xPROJ-Viva-GradingGrid.xlsx', 'Louis', '2020-07-13', 'Groupe1'),
(9, '34703310.jpg', 'Louis', '2020-07-13', 'Groupe1'),
(10, '2PROJECT.rar', 'Louis', '2020-07-13', 'Groupe1'),
(11, '06-2020-xPROJ-Viva-GradingGrid.xlsx', 'Louis', '2020-07-13', 'Groupe1'),
(12, '34703310.jpg', 'Louis', '2020-07-13', 'Groupe1'),
(13, 'b.pdf', 'Louis', '2020-07-13', 'Groupe1'),
(15, '2PROJECT.rar', 'user1', '2020-07-13', 'Groupe1'),
(17, 'latitude.sql', 'Louis', '2020-07-16', 'Groupe1'),
(19, '0267.ogg', 'Louis', '2020-07-16', 'Groupe1'),
(20, '0218.wav', 'Louis', '2020-07-16', 'Groupe1'),
(21, '0218.mp3', 'Louis', '2020-07-16', 'Groupe1');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `docs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`, `docs`) VALUES
(20, 'Groupe3', 'https://docs.google.com/document/d/e/2PACX-1vSAknbD1Nj4zBlp_sccDN54v2DfG8_b5nilWIkiclHsCXNaYUfmcBI9RKypga5VFrWiAxsCOLza6nj8/pub'),
(21, 'Groupe1', 'https://docs.google.com/document/d/e/2PACX-1vSAknbD1Nj4zBlp_sccDN54v2DfG8_b5nilWIkiclHsCXNaYUfmcBI9RKypga5VFrWiAxsCOLza6nj8/pub'),
(29, 'Groupe4', ''),
(30, 'Groupe2', 'https://docs.google.com/document/d/e/2PACX-1vSAknbD1Nj4zBlp_sccDN54v2DfG8_b5nilWIkiclHsCXNaYUfmcBI9RKypga5VFrWiAxsCOLza6nj8/pub'),
(31, 'Groupe5', '');

-- --------------------------------------------------------

--
-- Structure de la table `linkuserstogroup`
--

DROP TABLE IF EXISTS `linkuserstogroup`;
CREATE TABLE IF NOT EXISTS `linkuserstogroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idGroupe` int(11) NOT NULL,
  `ecrire` tinyint(1) NOT NULL DEFAULT 0,
  `effacer` tinyint(1) NOT NULL DEFAULT 0,
  `ecraser` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `linkuserstogroup`
--

INSERT INTO `linkuserstogroup` (`id`, `idUser`, `idGroupe`, `ecrire`, `effacer`, `ecraser`) VALUES
(19, 26, 20, 1, 1, 0),
(20, 26, 21, 1, 1, 1),
(21, 2, 30, 0, 1, 0),
(22, 2, 21, 1, 1, 1),
(23, 28, 20, 0, 0, 0),
(24, 2, 20, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `passw` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `passw`) VALUES
(1, 'admin', 'admin'),
(2, 'Louis', '12345'),
(28, 'Test', '1234'),
(26, 'User1', '1234');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
