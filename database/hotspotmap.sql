-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 13 Mars 2014 à 14:20
-- Version du serveur: 5.5.35
-- Version de PHP: 5.5.10-1~dotdeb.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `hotspotmap`
--

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `schedule` varchar(512) NOT NULL,
  `free_connection` tinyint(1) NOT NULL,
  `free_coffee` tinyint(1) NOT NULL,
  `rating` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Contenu de la table `locations`
--

INSERT INTO `locations` (`id`, `name`, `schedule`, `free_connection`, `free_coffee`, `rating`, `lat`, `lng`) VALUES
(69, 'Macdonald', '480;1380/480;1380/480;1380/480;1380/480;1380/480;1380/660;1260', 1, 1, 2, 45.89260684974512, 3.1116092205047607),
(68, 'Le bout du monde', '720;1140/480;1140/480;1140/480;1140/480;1140/480;1140/720;1140', 1, 1, 5, 48.41524527115701, -4.792850017547607),
(67, 'Le bar de l''Outback', '540;1140/360;1140/360;1140/360;1140/360;1140/360;1140/360;720', 0, 1, 3, -21.125497636606266, 129.88037109375),
(70, 'Le bar du parc', '480;1140/480;1140/480;1140/480;1140/480;1140/480;1140/480;1140', 1, 0, 3, 47.221710425103325, -1.5684592723846436),
(72, 'Wilmington''s pub', '480;1140/480;1140/720;1140/480;1140/480;1140/480;1140/720;1140', 1, 1, 4, 34.221135373485204, -77.94372797012329),
(73, 'Siberia''s pub ', '480;1140/480;1140/480;1140/480;1140/480;1140/480;1140/480;1140', 1, 1, 5, 68.01168485721772, 98.56178283691406);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
