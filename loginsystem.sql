-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Mrz 2017 um 12:37
-- Server-Version: 10.1.10-MariaDB
-- PHP-Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `loginsystem`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_em`
--

CREATE TABLE `user_em` (
  `id` int(11) NOT NULL,
  `user_em` varchar(255) NOT NULL,
  `user_em_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_em_pas`
--

CREATE TABLE `user_em_pas` (
  `id` int(11) NOT NULL,
  `user_em_id` int(11) NOT NULL,
  `user_pas_id` int(11) NOT NULL,
  `user_em_pas_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_pas`
--

CREATE TABLE `user_pas` (
  `id` int(11) NOT NULL,
  `user_pas` varchar(255) NOT NULL,
  `user_pas_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Indizes für die Tabelle `user_em`
--
ALTER TABLE `user_em`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_E_E` (`user_em`),
  ADD KEY `user_E_id` (`id`);

--
-- Indizes für die Tabelle `user_em_pas`
--
ALTER TABLE `user_em_pas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_E_P_id` (`id`),
  ADD KEY `user_E_id` (`user_em_id`),
  ADD KEY `user_P_id` (`user_pas_id`);

--
-- Indizes für die Tabelle `user_pas`
--
ALTER TABLE `user_pas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_P_id` (`id`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `user_em_pas`
--
ALTER TABLE `user_em_pas`
  ADD CONSTRAINT `user_em_pas_ibfk_1` FOREIGN KEY (`user_pas_id`) REFERENCES `user_pas` (`id`),
  ADD CONSTRAINT `user_em_pas_ibfk_2` FOREIGN KEY (`user_em_id`) REFERENCES `user_em` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
