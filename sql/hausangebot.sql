-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Jan 2016 um 23:21
-- Server-Version: 10.1.8-MariaDB
-- PHP-Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hausangebot`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `abschlag`
--

CREATE TABLE `abschlag` (
  `id` int(11) NOT NULL,
  `datenblatt_id` int(11) NOT NULL,
  `sonderwunch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datenblatt`
--

CREATE TABLE `datenblatt` (
  `id` int(11) NOT NULL,
  `haus_id` int(11) DEFAULT NULL,
  `nummer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `datenblatt`
--

INSERT INTO `datenblatt` (`id`, `haus_id`, `nummer`) VALUES
(1, NULL, 111),
(2, NULL, 222),
(3, NULL, 999);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `einheitstyp`
--

CREATE TABLE `einheitstyp` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `haus`
--

CREATE TABLE `haus` (
  `id` int(11) NOT NULL,
  `projekt_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kaeufer`
--

CREATE TABLE `kaeufer` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kaeufer_has_datenblatt`
--

CREATE TABLE `kaeufer_has_datenblatt` (
  `kaeufer_id` int(11) NOT NULL,
  `datenblatt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nachlass`
--

CREATE TABLE `nachlass` (
  `id` int(10) UNSIGNED NOT NULL,
  `datenblatt_id` int(11) NOT NULL,
  `preis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `nachlass`
--

INSERT INTO `nachlass` (`id`, `datenblatt_id`, `preis`) VALUES
(1, 1, NULL),
(2, 2, NULL),
(3, 3, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projekt`
--

CREATE TABLE `projekt` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `projekt`
--

INSERT INTO `projekt` (`id`, `name`) VALUES
(1, 'Projekt 1'),
(2, 'Projekt 2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sonderwunch`
--

CREATE TABLE `sonderwunch` (
  `id` int(11) NOT NULL,
  `datenblatt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teileigentumseinheit`
--

CREATE TABLE `teileigentumseinheit` (
  `id` int(11) NOT NULL,
  `haus_id` int(11) NOT NULL,
  `einheitstyp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zaehlerstand`
--

CREATE TABLE `zaehlerstand` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `stand` varchar(45) DEFAULT NULL,
  `haus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlung`
--

CREATE TABLE `zahlung` (
  `id` int(10) UNSIGNED NOT NULL,
  `datenblatt_id` int(11) NOT NULL,
  `betrag` float NOT NULL DEFAULT '0',
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `zahlung`
--

INSERT INTO `zahlung` (`id`, `datenblatt_id`, `betrag`, `datum`) VALUES
(1, 1, 100, '0000-00-00 00:00:00'),
(2, 1, 200, '0000-00-00 00:00:00'),
(3, 2, 11, '0000-00-00 00:00:00'),
(4, 2, 22, '0000-00-00 00:00:00'),
(5, 2, 33, '0000-00-00 00:00:00'),
(6, 2, 44, '0000-00-00 00:00:00'),
(9, 1, 888, '0000-00-00 00:00:00'),
(10, 1, 9999, '0000-00-00 00:00:00'),
(11, 3, 9, '0000-00-00 00:00:00'),
(12, 3, 8, '0000-00-00 00:00:00'),
(14, 3, 855, '0000-00-00 00:00:00'),
(15, 3, 955, '0000-00-00 00:00:00');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `abschlag`
--
ALTER TABLE `abschlag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_abschlag_datenblatt1_idx` (`datenblatt_id`),
  ADD KEY `fk_abschlag_sonderwunch1_idx` (`sonderwunch_id`);

--
-- Indizes für die Tabelle `datenblatt`
--
ALTER TABLE `datenblatt`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_datenblatt_haus_idx` (`haus_id`);

--
-- Indizes für die Tabelle `einheitstyp`
--
ALTER TABLE `einheitstyp`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `haus`
--
ALTER TABLE `haus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_haus_projekt1_idx` (`projekt_id`);

--
-- Indizes für die Tabelle `kaeufer`
--
ALTER TABLE `kaeufer`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kaeufer_has_datenblatt`
--
ALTER TABLE `kaeufer_has_datenblatt`
  ADD PRIMARY KEY (`kaeufer_id`,`datenblatt_id`),
  ADD KEY `fk_kaeufer_has_datenblatt_datenblatt1_idx` (`datenblatt_id`),
  ADD KEY `fk_kaeufer_has_datenblatt_kaeufer1_idx` (`kaeufer_id`);

--
-- Indizes für die Tabelle `nachlass`
--
ALTER TABLE `nachlass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nachlass_datenblatt1_idx` (`datenblatt_id`);

--
-- Indizes für die Tabelle `projekt`
--
ALTER TABLE `projekt`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `sonderwunch`
--
ALTER TABLE `sonderwunch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sonderwunch_datenblatt1_idx` (`datenblatt_id`);

--
-- Indizes für die Tabelle `teileigentumseinheit`
--
ALTER TABLE `teileigentumseinheit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_teileigentumseinheit_haus1_idx` (`haus_id`),
  ADD KEY `fk_teileigentumseinheit_einheitstyp1_idx` (`einheitstyp_id`);

--
-- Indizes für die Tabelle `zaehlerstand`
--
ALTER TABLE `zaehlerstand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_zaehlerstand_haus1_idx` (`haus_id`);

--
-- Indizes für die Tabelle `zahlung`
--
ALTER TABLE `zahlung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_zahlung_datenblatt1_idx` (`datenblatt_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `datenblatt`
--
ALTER TABLE `datenblatt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `haus`
--
ALTER TABLE `haus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `nachlass`
--
ALTER TABLE `nachlass`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `projekt`
--
ALTER TABLE `projekt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `zaehlerstand`
--
ALTER TABLE `zaehlerstand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `zahlung`
--
ALTER TABLE `zahlung`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `abschlag`
--
ALTER TABLE `abschlag`
  ADD CONSTRAINT `fk_abschlag_datenblatt1` FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_abschlag_sonderwunch1` FOREIGN KEY (`sonderwunch_id`) REFERENCES `sonderwunch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `datenblatt`
--
ALTER TABLE `datenblatt`
  ADD CONSTRAINT `fk_datenblatt_haus` FOREIGN KEY (`haus_id`) REFERENCES `haus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `haus`
--
ALTER TABLE `haus`
  ADD CONSTRAINT `fk_haus_projekt1` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `kaeufer_has_datenblatt`
--
ALTER TABLE `kaeufer_has_datenblatt`
  ADD CONSTRAINT `fk_kaeufer_has_datenblatt_datenblatt1` FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kaeufer_has_datenblatt_kaeufer1` FOREIGN KEY (`kaeufer_id`) REFERENCES `kaeufer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `nachlass`
--
ALTER TABLE `nachlass`
  ADD CONSTRAINT `fk_nachlass_datenblatt1` FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `sonderwunch`
--
ALTER TABLE `sonderwunch`
  ADD CONSTRAINT `fk_sonderwunch_datenblatt1` FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `teileigentumseinheit`
--
ALTER TABLE `teileigentumseinheit`
  ADD CONSTRAINT `fk_teileigentumseinheit_einheitstyp1` FOREIGN KEY (`einheitstyp_id`) REFERENCES `einheitstyp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teileigentumseinheit_haus1` FOREIGN KEY (`haus_id`) REFERENCES `haus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `zaehlerstand`
--
ALTER TABLE `zaehlerstand`
  ADD CONSTRAINT `fk_zaehlerstand_haus1` FOREIGN KEY (`haus_id`) REFERENCES `haus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `zahlung`
--
ALTER TABLE `zahlung`
  ADD CONSTRAINT `fk_zahlung_datenblatt1` FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
