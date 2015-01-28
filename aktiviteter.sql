-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Skapad: 28 jan 2015 kl 11:44
-- Serverversion: 5.6.14
-- PHP-version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `berzanapp`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `aktiviteter`
--

CREATE TABLE IF NOT EXISTS `aktiviteter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(20) NOT NULL,
  `inlägg` varchar(250) NOT NULL,
  `plats` varchar(30) NOT NULL,
  `person` varchar(9) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tid` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumpning av Data i tabell `aktiviteter`
--

INSERT INTO `aktiviteter` (`id`, `titel`, `inlägg`, `plats`, `person`, `datum`, `tid`) VALUES
(1, 'Ny Händelse', 'Här händer det fett med grejer and stuff and shit and shit and stuff u know', 'Robin', 'Robgus420', '2015-01-05 11:00:00', 1300);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
