-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 28 mai 2021 à 08:56
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
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fichier`
--

INSERT INTO `fichier` (`id`, `nom`, `proprietaire`, `date`, `groupe`, `path`) VALUES
(2, '06-2020-xPROJ-Viva-GradingGrid.xlsx', 'user1', '2020-07-09', 'Groupe3', 'Groupe3'),
(3, '2PROJECT.rar', 'user1', '2020-07-09', 'Groupe3', 'Groupe3'),
(4, '2PROJECT.rar', 'Louis', '2020-07-13', 'Groupe1', 'Groupe1'),
(6, '06-2020-xPROJ-Viva-GradingGrid.xlsx', 'Louis', '2020-07-13', 'Groupe1', 'Groupe1'),
(7, '34703310.jpg', 'Louis', '2020-07-13', 'Groupe1', 'Groupe1'),
(8, '06-2020-xPROJ-Viva-GradingGrid.xlsx', 'Louis', '2020-07-13', 'Groupe1', 'Groupe1'),
(9, '34703310.jpg', 'Louis', '2020-07-13', 'Groupe1', 'Groupe1'),
(10, '2PROJECT.rar', 'Louis', '2020-07-13', 'Groupe1', 'Groupe1'),
(11, '06-2020-xPROJ-Viva-GradingGrid.xlsx', 'Louis', '2020-07-13', 'Groupe1', 'Groupe1'),
(12, '34703310.jpg', 'Louis', '2020-07-13', 'Groupe1', 'Groupe1'),
(27, 'Anatomie TD1.docx', 'louis', '2020-09-06', 'Groupe2', 'Groupe2'),
(15, '2PROJECT.rar', 'user1', '2020-07-13', 'Groupe1', 'Groupe1'),
(19, '0267.ogg', 'Louis', '2020-07-16', 'Groupe1', 'Groupe1'),
(20, '0218.wav', 'Louis', '2020-07-16', 'Groupe1', 'Groupe1'),
(21, '0218.mp3', 'Louis', '2020-07-16', 'Groupe1', 'Groupe1'),
(23, 'Anglais-Semester-1-CM-2.pdf', 'louis', '2020-08-29', 'Groupe1', 'Groupe1'),
(24, 'Gymnastique acrobatique-CM1.docx', 'louis', '2020-08-29', 'Groupe1', 'Groupe1'),
(26, '', '', '2020-09-06', 'Groupe2', 'Groupe2'),
(29, 'IMG_20170912_112651.jpg', 'louis', '2020-09-06', 'Groupe2', 'Groupe2'),
(30, 'SOG-WXGP_SOG-RFXPG_DRIVER.zip', 'louis', '2020-09-07', 'Groupe1', 'Groupe1'),
(31, 'MouseServer.exe', 'louis', '2020-09-07', 'Groupe1', 'Groupe1'),
(32, 'OfficeSetup.exe', 'louis', '2020-09-07', 'Groupe1', 'Groupe1'),
(33, 'Teams_windows_x64.exe', 'louis', '2020-09-07', 'Groupe1', 'Groupe1'),
(87, 'How I Met your Mother S09.torrent', 'Louis', '2020-12-10', 'Groupe1', 'Groupe1'),
(88, 'Day-5-Noted-Quiz-3AGIL_-3AGIL-Agile-Developer_Manager.pdf', 'Louis', '2020-12-10', 'Groupe1', 'Groupe1/tes2/refsdf/refsdf/fdgddg'),
(54, 'dropfile.sql', 'louis', '2020-10-12', 'Groupe1', 'Groupe1/tes2/refsdf/test'),
(60, 'b.pdf', 'louis', '2020-10-22', 'Groupe1', 'Groupe1/tes2/refsdf/test'),
(63, 'b.pdf', 'louis', '2020-10-22', 'Groupe1', 'Groupe1'),
(64, 'IMG_20171120_080451.jpg', 'Admin', '2020-10-26', 'Groupe1', 'Groupe1/tes2/refsdf/tefsdf'),
(69, 'Anglais-Semester-1-CM-2.pdf', 'Admin', '2020-10-26', 'Groupe1', 'Groupe1/tes2/refsdf/tefsdf'),
(70, 'Application biomÃ©canique en sport et en mÃ©decine.docx', 'Admin', '2020-10-26', 'Groupe1', 'Groupe1/tes2/refsdf/tefsdf'),
(71, 'BiomÃ©ca CM4.docx', 'Admin', '2020-10-26', 'Groupe1', 'Groupe1/tes2/refsdf/tefsdf'),
(93, 'DIM0000.mp3', 'Louis', '2021-01-28', 'Groupe1', 'Groupe1/tes2/refsdf/refsdf'),
(92, 'How I Met your Mother S09.torrent', 'Louis', '2020-12-10', '', 'b'),
(91, 'How I Met your Mother S09.torrent', 'Louis', '2020-12-10', '', 'DJ'),
(90, 'How I Met your Mother S09.torrent', 'Louis', '2020-12-10', 'Groupe3', 'Groupe3'),
(89, 'How I Met your Mother S09.torrent', 'Louis', '2020-12-10', 'Groupe1', 'Groupe1/tes2/refsdf/refsdf/fdgddg'),
(85, 'Gymnastique acrobatique-CM1.docx', 'Admin', '2020-10-26', 'Groupe1', 'Groupe1/tes2/refsdf/tefsdf');

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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`, `docs`) VALUES
(20, 'Groupe3', 'https://docs.google.com/document/d/e/2PACX-1vSAknbD1Nj4zBlp_sccDN54v2DfG8_b5nilWIkiclHsCXNaYUfmcBI9RKypga5VFrWiAxsCOLza6nj8/pub'),
(21, 'Groupe1', 'https://docs.google.com/document/d/e/2PACX-1vSAknbD1Nj4zBlp_sccDN54v2DfG8_b5nilWIkiclHsCXNaYUfmcBI9RKypga5VFrWiAxsCOLza6nj8/pub'),
(29, 'Groupe4', ''),
(30, 'Groupe2', 'https://docs.google.com/document/d/e/2PACX-1vSAknbD1Nj4zBlp_sccDN54v2DfG8_b5nilWIkiclHsCXNaYUfmcBI9RKypga5VFrWiAxsCOLza6nj8/pub'),
(37, 'DJ', NULL),
(38, 'b', NULL);

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
  `createFolder` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `linkuserstogroup`
--

INSERT INTO `linkuserstogroup` (`id`, `idUser`, `idGroupe`, `ecrire`, `effacer`, `ecraser`, `createFolder`) VALUES
(28, 52, 21, 0, 0, 0, 0),
(21, 2, 30, 1, 1, 1, 0),
(22, 2, 21, 1, 1, 1, 1),
(23, 28, 20, 0, 0, 0, 0),
(24, 2, 20, 1, 1, 0, 1),
(29, 28, 21, 1, 0, 1, 0),
(30, 2, 37, 1, 1, 1, 1),
(31, 2, 38, 1, 1, 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `passw`) VALUES
(1, 'admin', 'admin'),
(2, 'Louis', '12345'),
(28, 'Test', '1234'),
(52, 'Blasdsd', 'gfddsf'),
(53, 'bvc', 'vcbcv'),
(55, 'dsfsd', 'sdfsdf'),
(51, 'Blasdsd', 'gfddsf'),
(56, 'dsfsd', 'sdfsdf'),
(57, 'Test5', '5642');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
