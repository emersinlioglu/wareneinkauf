-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.1.36-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             9.4.0.5139
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für wareneinkauf
CREATE DATABASE IF NOT EXISTS `wareneinkauf` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `wareneinkauf`;

-- Exportiere Struktur von Tabelle wareneinkauf.artikel
CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nummer` varchar(255) NOT NULL,
  `bezeichnung` varchar(512) DEFAULT NULL,
  `seriennummer` varchar(255) DEFAULT NULL,
  `hersteller_artikelnr` varchar(255) DEFAULT NULL,
  `hersteller_id` int(11) DEFAULT NULL,
  `warenart_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_artikel_hersteller` (`hersteller_id`),
  KEY `FK_artikel_warenart` (`warenart_id`),
  CONSTRAINT `FK_artikel_hersteller` FOREIGN KEY (`hersteller_id`) REFERENCES `hersteller` (`id`),
  CONSTRAINT `FK_artikel_warenart` FOREIGN KEY (`warenart_id`) REFERENCES `warenart` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle wareneinkauf.artikel: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `artikel` DISABLE KEYS */;
/*!40000 ALTER TABLE `artikel` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle wareneinkauf.auth_assignment: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  KEY `fk_auth_item_group_code` (`group_code`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_auth_item_group_code` FOREIGN KEY (`group_code`) REFERENCES `auth_item_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle wareneinkauf.auth_item: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle wareneinkauf.auth_item_child: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.auth_item_group
CREATE TABLE IF NOT EXISTS `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle wareneinkauf.auth_item_group: ~2 rows (ungefähr)
/*!40000 ALTER TABLE `auth_item_group` DISABLE KEYS */;
REPLACE INTO `auth_item_group` (`code`, `name`, `created_at`, `updated_at`) VALUES
  ('userCommonPermissions', 'User common permission', 1467393899, 1467418368),
  ('userManagement', 'User management', 1467393899, 1467393899);
/*!40000 ALTER TABLE `auth_item_group` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle wareneinkauf.auth_rule: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.hersteller
CREATE TABLE IF NOT EXISTS `hersteller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Exportiere Daten aus Tabelle wareneinkauf.hersteller: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `hersteller` DISABLE KEYS */;
/*!40000 ALTER TABLE `hersteller` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.kunde
CREATE TABLE IF NOT EXISTS `kunde` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Exportiere Daten aus Tabelle wareneinkauf.kunde: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `kunde` DISABLE KEYS */;
REPLACE INTO `kunde` (`id`, `name`) VALUES
  (1, 'Lager');
/*!40000 ALTER TABLE `kunde` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.lieferant
CREATE TABLE IF NOT EXISTS `lieferant` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle wareneinkauf.lieferant: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `lieferant` DISABLE KEYS */;
/*!40000 ALTER TABLE `lieferant` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.rechnung
CREATE TABLE IF NOT EXISTS `rechnung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `lieferant_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_rechnung_lieferant` (`lieferant_id`),
  CONSTRAINT `FK_rechnung_lieferant` FOREIGN KEY (`lieferant_id`) REFERENCES `lieferant` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle wareneinkauf.rechnung: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `rechnung` DISABLE KEYS */;
/*!40000 ALTER TABLE `rechnung` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.rechnung_item
CREATE TABLE IF NOT EXISTS `rechnung_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rechnung_id` int(11) DEFAULT NULL,
  `anzahl` int(11) DEFAULT '0',
  `netto_einzel_betrag` decimal(10,2) DEFAULT NULL,
  `kunde_rechnungsnr` varchar(255) DEFAULT NULL,
  `kunde_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_rechnung_item_rechnung` (`rechnung_id`),
  KEY `FK_rechnung_item_kunde` (`kunde_id`),
  CONSTRAINT `FK_rechnung_item_kunde` FOREIGN KEY (`kunde_id`) REFERENCES `kunde` (`id`),
  CONSTRAINT `FK_rechnung_item_rechnung` FOREIGN KEY (`rechnung_id`) REFERENCES `rechnung` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle wareneinkauf.rechnung_item: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `rechnung_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `rechnung_item` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.tbl_dynagrid
CREATE TABLE IF NOT EXISTS `tbl_dynagrid` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid setting identifier',
  `filter_id` varchar(100) DEFAULT NULL COMMENT 'Filter setting identifier',
  `sort_id` varchar(100) DEFAULT NULL COMMENT 'Sort setting identifier',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid configuration',
  PRIMARY KEY (`id`),
  KEY `tbl_dynagrid_FK1` (`filter_id`),
  KEY `tbl_dynagrid_FK2` (`sort_id`),
  CONSTRAINT `tbl_dynagrid_FK1` FOREIGN KEY (`filter_id`) REFERENCES `tbl_dynagrid_dtl` (`id`),
  CONSTRAINT `tbl_dynagrid_FK2` FOREIGN KEY (`sort_id`) REFERENCES `tbl_dynagrid_dtl` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Dynagrid personalization configuration settings';

-- Exportiere Daten aus Tabelle wareneinkauf.tbl_dynagrid: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `tbl_dynagrid` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_dynagrid` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.tbl_dynagrid_dtl
CREATE TABLE IF NOT EXISTS `tbl_dynagrid_dtl` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid detail setting identifier',
  `category` varchar(10) NOT NULL COMMENT 'Dynagrid detail setting category "filter" or "sort"',
  `name` varchar(150) NOT NULL COMMENT 'Name to identify the dynagrid detail setting',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid detail configuration',
  `dynagrid_id` varchar(100) NOT NULL COMMENT 'Related dynagrid identifier',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_dynagrid_dtl_UK1` (`name`,`category`,`dynagrid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Dynagrid detail configuration settings';

-- Exportiere Daten aus Tabelle wareneinkauf.tbl_dynagrid_dtl: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `tbl_dynagrid_dtl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_dynagrid_dtl` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `superadmin` smallint(6) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `registration_ip` varchar(15) DEFAULT NULL,
  `bind_to_ip` varchar(255) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `email_confirmed` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle wareneinkauf.user: ~1 rows (ungefähr)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `confirmation_token`, `status`, `superadmin`, `created_at`, `updated_at`, `registration_ip`, `bind_to_ip`, `email`, `email_confirmed`) VALUES
  (1, 'superadmin', 'Bc4mLXv91briehYdYqXzVoDPpBk7ToGh', '$2y$13$QAfJ0ezYIX1zOBICPngCBOdtPIlhdncjfXNp6OpihQbKTAfZvsR7O', NULL, 1, 1, 1467393898, 1471334658, NULL, '', NULL, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.user_visit_log
CREATE TABLE IF NOT EXISTS `user_visit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `language` char(2) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visit_time` int(11) NOT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_visit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportiere Daten aus Tabelle wareneinkauf.user_visit_log: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `user_visit_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_visit_log` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle wareneinkauf.warenart
CREATE TABLE IF NOT EXISTS `warenart` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Exportiere Daten aus Tabelle wareneinkauf.warenart: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `warenart` DISABLE KEYS */;
/*!40000 ALTER TABLE `warenart` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
