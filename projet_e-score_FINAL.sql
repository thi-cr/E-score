-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2021 at 11:59 AM
-- Server version: 5.7.31-log
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_e-score`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
CREATE TABLE IF NOT EXISTS `equipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `tag` varchar(10) COLLATE utf8_bin NOT NULL,
  `capitaine_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `equipes capitaine_id` (`capitaine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `equipes`
--

INSERT INTO `equipes` (`id`, `nom`, `tag`, `capitaine_id`) VALUES
(1, 'test1EQ', 'test1EQ', 1),
(2, 'test6EQ', 'test6EQ', 6);

-- --------------------------------------------------------

--
-- Table structure for table `equipe_jeu`
--

DROP TABLE IF EXISTS `equipe_jeu`;
CREATE TABLE IF NOT EXISTS `equipe_jeu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipe_id` int(11) NOT NULL,
  `jeu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `equipe_jeu equipe_id` (`equipe_id`),
  KEY `equipe_jeu jeu_id` (`jeu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `equipe_jeu`
--

INSERT INTO `equipe_jeu` (`id`, `equipe_id`, `jeu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `jeux`
--

INSERT INTO `jeux` (`id`, `nom`) VALUES
(1, 'Counter-Strike'),
(2, 'League Of Legends'),
(3, 'DotA 2'),
(4, 'World of Tanks');

-- --------------------------------------------------------

--
-- Table structure for table `joueurs`
--

DROP TABLE IF EXISTS `joueurs`;
CREATE TABLE IF NOT EXISTS `joueurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `pseudo` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `equipe_id` int(11) DEFAULT NULL,
  `session_token` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `session_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`),
  KEY `joueurs equipe_id` (`equipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `joueurs`
--

INSERT INTO `joueurs` (`id`, `nom`, `prenom`, `password`, `pseudo`, `email`, `equipe_id`, `session_token`, `session_time`) VALUES
(1, 'test1', 'test1', '$2y$10$2CDibs7JlXZocLurmb3M..uslwchgTUmaUAkLY0wv4Ehb5Y/RjyzC', 'test1', 'test1@hotmail.com', 1, '9c568f1d1ff25fd0.1624103207', '2021-06-19 13:46:47'),
(2, 'test2', 'test2', '$2y$10$s0BPVqRFlF66qAF2.S0/XukKfQrXeF/58xV0D3OrrhS9XDLP0.D7y', 'test2', 'test2@hotmail.com', 1, NULL, NULL),
(3, 'test3', 'test3', '$2y$10$aD9GIl0Z2hFkR0BM/vqiQuiYVVq99da0AwWoKD3JSfWyZNa/HC6q.', 'test3', 'test3@hotmail.com', 1, NULL, NULL),
(4, 'test4', 'test4', '$2y$10$KcyKs37JjN.yMGSWKtkzu.G3a97SnTTgXsH5H4WjzMxL096meFeTW', 'test4', 'test4@hotmail.com', 1, NULL, NULL),
(5, 'test5', 'test5', '$2y$10$x2DTiCbDjixGlA8SIw0cF.blt8pW5/CBeXqhBn/.gTLUljO/L3CDC', 'test5', 'test5@hotmail.com', NULL, NULL, NULL),
(6, 'test6', 'test6', '$2y$10$wxPbsvhI5kQYwFj28T7m2uqkpgft7tFZ3euozbIcJIAVS7WFMnzR.', 'test6', 'test6@hotmail.com', 2, '2ff37e380e95604a.1624103252', '2021-06-19 13:47:32'),
(7, 'test7', 'test7', '$2y$10$nKYtvkdjfd/urTs0R3dSUuq8GHWVd7v7gAHNRsp9.sUXGg9TcvP8W', 'test7', 'test7@hotmail.com', 2, NULL, NULL),
(8, 'test8', 'test8', '$2y$10$IeaT1uKgNlGkv/e3hOA6ZOMEVRZSTDJRZMUXLjJ5GZihki8wNC5lq', 'test8', 'test8@hotmail.com', 2, NULL, NULL),
(9, 'test9', 'test9', '$2y$10$zOM1rDTNEUfhqE3InArG0eZWleURUWpWaKXIe6C44DyO8gqRPu4YK', 'test9', 'test9@hotmail.com', 2, NULL, NULL),
(10, 'test10', 'test10', '$2y$10$/oLSmTTuVvYp7Hyo6XVBEOfq7S9SFM3DReRoqvYVfA9bcsS.geqe2', 'test10', 'test10@hotmail.com', NULL, NULL, NULL),
(11, 'test11', 'test11', '$2y$10$2fhMQbXNy4GNYIP1efU4Lu0fVL5Nh3FjFAeczqXX2eRE27rGGliLW', 'test11', 'test11@hotmail.com', NULL, '86fc128e68ec13b0.1624103355', '2021-06-19 13:49:15'),
(12, 'test12', 'test12', '$2y$10$GK/HyibXG1EwYRYDdXMdgO3oKJJiNibzr9AQTJa6otHUKL2VmxjMK', 'test12', 'test12@hotmail.com', NULL, NULL, NULL),
(13, 'test13', 'test13', '$2y$10$5V7wfVSFOdcda/wQUmQKDuXN4fDguVI/p5andK9d7vb2w2WUC3uGG', 'test13', 'test13@hotmail.com', NULL, NULL, NULL),
(14, 'test14', 'test14', '$2y$10$nWgBHpqIXu2Ew23QvYUzj.DYmbH/BLJVxrjMsKpOK5avOY1JcuBuO', 'test14', 'test14@hotmail.com', NULL, NULL, NULL),
(15, 'test15', 'test15', '$2y$10$fK7gNxpYvMvt6WSprbADjeu03e3f4BuO2P3.5StdzG61J6rGFXvLO', 'test15', 'test15@hotmail.com', NULL, NULL, NULL),
(16, 'test16', 'test16', '$2y$10$EUhM3tKcpI0nJvUuNqQZ5eT6RufQ0SzGfMqtzBpzrtZYoRLPXm6C2', 'test16', 'test16@hotmail.com', NULL, NULL, NULL),
(17, 'test17', 'test17', '$2y$10$5H635n.hm1hQ84yY2dwVGubdHWhJr7X8Ia87.OedydxAmH1m5U7Zq', 'test17', 'test17@hotmail.com', NULL, NULL, NULL),
(18, 'test18', 'test18', '$2y$10$k42w4.0sS./qlo7KUTjFNuAKZbHaln36mzT35UDIXRYMbAPuCSO/G', 'test18', 'test18@hotmail.com', NULL, NULL, NULL),
(19, 'test19', 'test19', '$2y$10$fExSi9AQmh/567sz9BKjuOA839eRDmlCbuDgwuDuEnOqD2d1JzY.a', 'test19', 'test19@hotmail.com', NULL, NULL, NULL),
(20, 'test20', 'test20', '$2y$10$ejcSSQvtSu2RjuKocyHVK.SVQbCUQWcccTMXSYbKz.OqQFpogo4Aq', 'test20', 'test20@hotmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `joueur_match`
--

DROP TABLE IF EXISTS `joueur_match`;
CREATE TABLE IF NOT EXISTS `joueur_match` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `joueur_id` int(255) NOT NULL,
  `match_id` int(255) NOT NULL,
  `equipe_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `joueur_match`
--

INSERT INTO `joueur_match` (`id`, `joueur_id`, `match_id`, `equipe_id`) VALUES
(2, 7, 1, 2),
(3, 8, 1, 2),
(5, 2, 1, 1),
(6, 3, 1, 1),
(7, 9, 1, 2),
(8, 4, 1, 1),
(9, 7, 2, 2),
(10, 8, 2, 2),
(11, 2, 2, 1),
(12, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `matchs`
--

DROP TABLE IF EXISTS `matchs`;
CREATE TABLE IF NOT EXISTS `matchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipe1` int(11) NOT NULL,
  `equipe2` int(11) NOT NULL,
  `ScoreEquipe1` int(11) DEFAULT NULL,
  `ScoreEquipe2` int(11) DEFAULT NULL,
  `jeu_id` int(11) NOT NULL,
  `statut` varchar(255) COLLATE utf8_bin NOT NULL,
  `createur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matchs jeu_id` (`jeu_id`),
  KEY `matchs idCreateur` (`createur_id`),
  KEY `matchs equipe1` (`equipe1`),
  KEY `matchs equipe2` (`equipe2`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `matchs`
--

INSERT INTO `matchs` (`id`, `equipe1`, `equipe2`, `ScoreEquipe1`, `ScoreEquipe2`, `jeu_id`, `statut`, `createur_id`) VALUES
(1, 2, 1, 100, 0, 1, 'Ã  venir', 6);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipes capitaine_id` FOREIGN KEY (`capitaine_id`) REFERENCES `joueurs` (`id`);

--
-- Constraints for table `equipe_jeu`
--
ALTER TABLE `equipe_jeu`
  ADD CONSTRAINT `equipe_jeu equipe_id` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id`),
  ADD CONSTRAINT `equipe_jeu jeu_id` FOREIGN KEY (`jeu_id`) REFERENCES `jeux` (`id`);

--
-- Constraints for table `joueurs`
--
ALTER TABLE `joueurs`
  ADD CONSTRAINT `joueurs equipe_id` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id`);

--
-- Constraints for table `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `matchs equipe1` FOREIGN KEY (`equipe1`) REFERENCES `equipes` (`id`),
  ADD CONSTRAINT `matchs equipe2` FOREIGN KEY (`equipe2`) REFERENCES `equipes` (`id`),
  ADD CONSTRAINT `matchs idCreateur` FOREIGN KEY (`createur_id`) REFERENCES `joueurs` (`id`),
  ADD CONSTRAINT `matchs jeu_id` FOREIGN KEY (`jeu_id`) REFERENCES `jeux` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
