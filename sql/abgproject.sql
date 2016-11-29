-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 27. Nov 2016 um 22:30
-- Server Version: 5.5.53-0+deb8u1
-- PHP-Version: 5.6.27-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `abgproject`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `abschlag`
--

CREATE TABLE IF NOT EXISTS `abschlag` (
`id` int(10) unsigned NOT NULL,
  `datenblatt_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `kaufvertrag_prozent` float DEFAULT NULL,
  `kaufvertrag_betrag` varchar(255) DEFAULT NULL,
  `kaufvertrag_angefordert` date DEFAULT NULL,
  `sonderwunsch_prozent` float DEFAULT NULL,
  `sonderwunsch_betrag` varchar(255) DEFAULT NULL,
  `sonderwunsch_angefordert` date DEFAULT NULL,
  `summe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=875 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `abschlag`
--

INSERT INTO `abschlag` (`id`, `datenblatt_id`, `name`, `kaufvertrag_prozent`, `kaufvertrag_betrag`, `kaufvertrag_angefordert`, `sonderwunsch_prozent`, `sonderwunsch_betrag`, `sonderwunsch_angefordert`, `summe`) VALUES
(31, 12, 'Abschlag 1', 25, '191750', NULL, NULL, '0', NULL, '0'),
(32, 12, 'Abschlag 2', 28, '214760', NULL, NULL, '0', NULL, '0'),
(33, 12, 'Abschlag 3', 16.8, '128856', NULL, NULL, '0', NULL, '0'),
(34, 12, 'Abschlag 4', 8.4, '64428', NULL, NULL, '0', NULL, '0'),
(126, 26, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 26, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 26, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 26, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 26, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 26, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 27, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 27, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 27, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 27, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 27, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 27, 'Abschlag 6', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 27, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 28, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 28, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 28, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 28, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 28, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 28, 'Abschlag 6', 0, NULL, NULL, 96.5, NULL, NULL, NULL),
(146, 28, 'Schlussrechnung', 3.5, NULL, NULL, 3.5, NULL, NULL, NULL),
(147, 29, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 29, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 29, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 29, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 29, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 29, 'Abschlag 6', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 29, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 30, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 30, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(156, 30, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 30, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 30, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 30, 'Abschlag 6', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 30, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 31, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(162, 31, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(163, 31, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 31, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(165, 31, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 31, 'Abschlag 6', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 31, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(177, 33, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(178, 33, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(179, 33, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(180, 33, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(181, 33, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(183, 33, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(184, 34, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 34, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(186, 34, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(187, 34, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(188, 34, 'Abschlag 5', 18.3, NULL, NULL, 96.5, NULL, NULL, NULL),
(190, 34, 'Schlussrechnung', 3.5, NULL, NULL, 3.5, NULL, NULL, NULL),
(191, 35, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(192, 35, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(193, 35, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(194, 35, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(195, 35, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(197, 35, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(198, 36, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(199, 36, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(200, 36, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(201, 36, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(202, 36, 'Abschlag 5', 18.3, NULL, NULL, 96.5, NULL, NULL, NULL),
(204, 36, 'Schlussrechnung', 3.5, NULL, NULL, 3.5, NULL, NULL, NULL),
(225, 40, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(226, 40, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 40, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(228, 40, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(229, 40, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(230, 40, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(231, 41, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(232, 41, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(233, 41, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(234, 41, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(235, 41, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(236, 41, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(243, 43, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(244, 43, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(245, 43, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(246, 43, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(247, 43, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(248, 43, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(249, 44, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 44, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(251, 44, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(252, 44, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(253, 44, 'Abschlag 5', 18.3, NULL, NULL, 96.5, NULL, NULL, NULL),
(254, 44, 'Schlussrechnung', 3.5, NULL, NULL, 3.5, NULL, NULL, NULL),
(261, 46, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(262, 46, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(263, 46, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(264, 46, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(265, 46, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(266, 46, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(267, 47, 'Abschlag 1', 25, '71203.75', NULL, NULL, '0', NULL, '0'),
(268, 47, 'Abschlag 2', 28, '79748.2', NULL, NULL, '0', NULL, '0'),
(269, 47, 'Abschlag 3', 16.8, '47848.92', NULL, NULL, '0', NULL, '0'),
(270, 47, 'Abschlag 4', 8.4, '23924.46', NULL, NULL, '0', NULL, '0'),
(271, 47, 'Abschlag 5', 18.3, '52121.145', NULL, NULL, '0', NULL, '0'),
(272, 47, 'Schlussrechnung', 3.5, '9968.525', NULL, NULL, '0', NULL, '0'),
(279, 49, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(280, 49, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(281, 49, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(282, 49, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(283, 49, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(284, 49, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(285, 50, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(286, 50, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(287, 50, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(288, 50, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(289, 50, 'Abschlag 5', 18.3, NULL, NULL, 96.5, NULL, NULL, NULL),
(290, 50, 'Schlussrechnung', 3.5, NULL, NULL, 3.5, NULL, NULL, NULL),
(309, 54, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(310, 54, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(311, 54, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(312, 54, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(313, 54, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(314, 54, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(321, 56, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(322, 56, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(323, 56, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(324, 56, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(325, 56, 'Abschlag 5', 18.3, NULL, NULL, 96.5, NULL, NULL, NULL),
(326, 56, 'Schlussrechnung', 3.5, NULL, NULL, 3.5, NULL, NULL, NULL),
(327, 57, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(328, 57, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(329, 57, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(330, 57, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(331, 57, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(332, 57, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(339, 59, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(340, 59, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(341, 59, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(342, 59, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(343, 59, 'Abschlag 5', 18.3, NULL, NULL, 96.5, NULL, NULL, NULL),
(344, 59, 'Schlussrechnung', 3.5, NULL, NULL, 3.5, NULL, NULL, NULL),
(345, 60, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(346, 60, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(347, 60, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(348, 60, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(349, 60, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(350, 60, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(357, 62, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(358, 62, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(359, 62, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(360, 62, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(361, 62, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(362, 62, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(375, 65, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(376, 65, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(377, 65, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(378, 65, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(379, 65, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(380, 65, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(387, 67, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(388, 67, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(389, 67, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(390, 67, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(391, 67, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(392, 67, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(393, 68, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(394, 68, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(395, 68, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(396, 68, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(397, 68, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(398, 68, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(411, 71, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(412, 71, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(413, 71, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(414, 71, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(415, 71, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(416, 71, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(417, 72, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(418, 72, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(419, 72, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(420, 72, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(421, 72, 'Abschlag 5', 18.3, NULL, NULL, 96.5, NULL, NULL, NULL),
(422, 72, 'Schlussrechnung', 3.5, NULL, NULL, 3.5, NULL, NULL, NULL),
(453, 78, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(454, 78, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(455, 78, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(456, 78, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(457, 78, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(458, 78, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(459, 79, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(460, 79, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(461, 79, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(462, 79, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(463, 79, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(464, 79, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(471, 81, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(472, 81, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(473, 81, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(474, 81, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(475, 81, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(476, 81, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(489, 84, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(490, 84, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(491, 84, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(492, 84, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(493, 84, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(494, 84, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(495, 85, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(496, 85, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(497, 85, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(498, 85, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(499, 85, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(500, 85, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(507, 87, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(508, 87, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(509, 87, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(510, 87, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(511, 87, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(512, 87, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(513, 88, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(514, 88, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(515, 88, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(516, 88, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(517, 88, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(518, 88, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(531, 91, 'Abschlag 1', 25, '71386.25', NULL, NULL, '0', NULL, '0'),
(532, 91, 'Abschlag 2', 28, '79952.6', NULL, NULL, '0', NULL, '0'),
(533, 91, 'Abschlag 3', 16.8, '47971.56', NULL, NULL, '0', NULL, '0'),
(534, 91, 'Abschlag 4', 8.4, '23985.78', NULL, NULL, '0', NULL, '0'),
(535, 91, 'Abschlag 5', 18.3, '52254.735', NULL, NULL, '0', NULL, '0'),
(536, 91, 'Schlussrechnung', 3.5, '9994.075', NULL, NULL, '0', NULL, '0'),
(537, 92, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(538, 92, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(539, 92, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(540, 92, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(541, 92, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(542, 92, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(543, 93, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(544, 93, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(545, 93, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(546, 93, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(547, 93, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(548, 93, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(549, 94, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(550, 94, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(551, 94, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(552, 94, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(553, 94, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(554, 94, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(555, 95, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(556, 95, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(557, 95, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(558, 95, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(559, 95, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(560, 95, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(567, 97, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(568, 97, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(569, 97, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(570, 97, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(571, 97, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(572, 97, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(573, 98, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(574, 98, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(575, 98, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(576, 98, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(577, 98, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(578, 98, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(579, 99, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(580, 99, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(581, 99, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(582, 99, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(583, 99, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(584, 99, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(585, 100, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(586, 100, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(587, 100, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(588, 100, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(589, 100, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(590, 100, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(591, 101, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(592, 101, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(593, 101, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(594, 101, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(595, 101, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(596, 101, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(603, 103, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(604, 103, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(605, 103, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(606, 103, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(607, 103, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(608, 103, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(615, 105, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(616, 105, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(617, 105, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(618, 105, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(619, 105, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(620, 105, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(621, 106, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(622, 106, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(623, 106, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(624, 106, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(625, 106, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(626, 106, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(627, 107, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(628, 107, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(629, 107, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(630, 107, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(631, 107, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(632, 107, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(633, 108, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(634, 108, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(635, 108, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(636, 108, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(637, 108, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(638, 108, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(645, 110, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(646, 110, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(647, 110, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(648, 110, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(649, 110, 'Abschlag 5', 18.3, NULL, NULL, 96.5, NULL, NULL, NULL),
(650, 110, 'Schlussrechnung', 3.5, NULL, NULL, 3.5, NULL, NULL, NULL),
(651, 111, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(652, 111, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(653, 111, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(654, 111, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(655, 111, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(656, 111, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(663, 113, 'Abschlag 1', 25, '112000', NULL, NULL, '0', NULL, '0'),
(664, 113, 'Abschlag 2', 28, '125440', NULL, NULL, '0', NULL, '0'),
(665, 113, 'Abschlag 3', 16.8, '75264', NULL, NULL, '0', NULL, '0'),
(666, 113, 'Abschlag 4', 8.4, '37632', NULL, NULL, '0', NULL, '0'),
(667, 113, 'Abschlag 5', 18.3, '81984', NULL, NULL, '0', NULL, '0'),
(668, 113, 'Schlussrechnung', 3.5, '15680', NULL, NULL, '0', NULL, '0'),
(669, 114, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(670, 114, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(671, 114, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(672, 114, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(673, 114, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(674, 114, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(681, 116, 'Abschlag 1', 25, '191250', NULL, NULL, '0', NULL, '0'),
(682, 116, 'Abschlag 2', 28, '214200', NULL, NULL, '0', NULL, '0'),
(683, 116, 'Abschlag 3', 16.8, '128520', NULL, NULL, '0', NULL, '0'),
(684, 116, 'Abschlag 4', 8.4, '64260', NULL, NULL, '0', NULL, '0'),
(685, 116, 'Abschlag 5', 18.3, '139995', NULL, 96.5, '2145.14675', NULL, '0'),
(686, 116, 'Schlussrechnung', 3.5, '26775', NULL, 3.5, '77.80325', NULL, '0'),
(687, 117, 'Abschlag 1', 25, '99250', NULL, NULL, '0', NULL, '0'),
(688, 117, 'Abschlag 2', 28, '111160', NULL, NULL, '0', NULL, '0'),
(689, 117, 'Abschlag 3', 16.8, '66696', NULL, NULL, '0', NULL, '0'),
(690, 117, 'Abschlag 4', 8.4, '33348', NULL, NULL, '0', NULL, '0'),
(691, 117, 'Abschlag 5', 18.3, '72651', NULL, 96.5, '4618.7795', NULL, '0'),
(692, 117, 'Schlussrechnung', 3.5, '13895', NULL, 3.5, '167.5205', NULL, '0'),
(699, 119, 'Abschlag 1', 25, '165250', NULL, NULL, '0', NULL, '0'),
(700, 119, 'Abschlag 2', 28, '185080', NULL, NULL, '0', NULL, '0'),
(701, 119, 'Abschlag 3', 16.8, '111048', NULL, NULL, '0', NULL, '0'),
(702, 119, 'Abschlag 4', 8.4, '55524', NULL, NULL, '0', NULL, '0'),
(703, 119, 'Abschlag 5', 18.3, '120963', NULL, 96.5, '3325.92075', NULL, '0'),
(704, 119, 'Schlussrechnung', 3.5, '23135', NULL, 3.5, '120.62925', NULL, '0'),
(711, 121, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(712, 121, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(713, 121, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(714, 121, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(715, 121, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(716, 121, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(717, 122, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(718, 122, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(719, 122, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(720, 122, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(721, 122, 'Abschlag 5', 18.3, NULL, NULL, NULL, NULL, NULL, NULL),
(722, 122, 'Schlussrechnung', 3.5, NULL, NULL, NULL, NULL, NULL, NULL),
(735, 12, 'Abschlag 5', 18.3, '140361', NULL, 96.5, '3864.1495', NULL, '0'),
(736, 12, 'Schlussrechnung', 3.5, '26845', NULL, 3.5, '140.1505', NULL, '0'),
(749, 126, 'Abschlag 1', 25, '194250', NULL, NULL, '0', NULL, '0'),
(750, 126, 'Abschlag 2', 28, '217560', NULL, NULL, '0', NULL, '0'),
(751, 126, 'Abschlag 3', 16.8, '130536', NULL, NULL, '0', NULL, '0'),
(752, 126, 'Abschlag 4', 8.4, '65268', NULL, NULL, '0', NULL, '0'),
(753, 126, 'Abschlag 5', 18.3, '142191', NULL, NULL, '0', NULL, '0'),
(754, 126, 'Schlussrechnung', 3.5, '27195', NULL, NULL, '0', NULL, '0'),
(761, 128, 'Abschlag 1', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(762, 128, 'Abschlag 2', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(763, 128, 'Abschlag 3', 16.8, NULL, NULL, NULL, NULL, NULL, NULL),
(764, 128, 'Abschlag 4', 8.4, NULL, NULL, NULL, NULL, NULL, NULL),
(765, 128, 'Abschlag 5', 18.3, NULL, NULL, 96.5, NULL, NULL, NULL),
(766, 128, 'Schlussrechnung', 3.5, NULL, NULL, 3.5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('betreuung_mitarbeiter', '14', 1470703282),
('betreuung_mitarbeiter', '18', 1479467777),
('betreuung_mitarbeiter', '6', 1470084713),
('buchhaltung_leitung', '5', 1470084655),
('buchhaltung_mitarbeiter', '11', 1470696742),
('buchhaltung_mitarbeiter', '13', 1470703298),
('buchhaltung_mitarbeiter', '4', 1470084671),
('facility_management', '12', 1470701044),
('facility_management', '15', 1470703265),
('rechtsabteilung_leitung', '7', 1470084751),
('rechtsabteilung_mitarbeiter', '8', 1470084837),
('vertrieb_abg', '16', 1471259819),
('vertrieb_abg', '9', 1470084883),
('vertrieb_extern', '10', 1470084967),
('vertrieb_extern', '17', 1471268071);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `group_code`) VALUES
('/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('//*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('//controller', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('//crud', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('//extension', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('//form', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('//index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('//model', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('//module', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/abschlag/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/abschlag/create', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/abschlag/delete', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/abschlag/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/abschlag/update', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/abschlag/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/asset/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/asset/compress', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/asset/template', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/auth/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/auth/default/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/auth/default/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/auth/rbac/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/auth/rbac/create', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/auth/rbac/delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/auth/rbac/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/auth/rbac/update', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/auth/rbac/view', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/cache/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/cache/flush', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/cache/flush-all', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/cache/flush-schema', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/cache/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/datecontrol/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datecontrol/parse/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datecontrol/parse/convert', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/addabschlag', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/addnachlass', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/addsonderwunsch', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/addzahlung', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/autocompletekunden', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/create', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/delete', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/deleteabschlag', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/deletenachlass', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/deletesonderwunsch', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/deletezahlung', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/pdf', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/report', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/subcat', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/update', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/datenblatt/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/debug/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/debug/default/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/debug/default/db-explain', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/debug/default/download-mail', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/debug/default/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/debug/default/toolbar', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/debug/default/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/einheitstyp/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/einheitstyp/create', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/einheitstyp/delete', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/einheitstyp/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/einheitstyp/update', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/einheitstyp/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/error/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/error/error-handler', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/filter/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/filter/create', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/filter/delete', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/filter/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/filter/update', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/filter/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/firma/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/firma/create', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/firma/delete', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/firma/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/firma/update', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/firma/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/fixture/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/fixture/load', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/fixture/unload', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/gii/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/gii/default/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/gii/default/action', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/gii/default/diff', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/gii/default/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/gii/default/preview', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/gii/default/view', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/gridview/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/gridview/export/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/gridview/export/download', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/addteileigentumseinheit', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/addzaehlerstand', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/create', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/delete', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/deleteteileigentumseinheit', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/deletezaehlerstand', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/projekte', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/update', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/haus/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/hausfilter/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/hausfilter/create', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/hausfilter/delete', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/hausfilter/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/hausfilter/update', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/hausfilter/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/hello/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/hello/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/help/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/help/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/kaeufer/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kaeufer/create', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kaeufer/delete', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kaeufer/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kaeufer/update', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kaeufer/updatedates', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kaeufer/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kunde/*', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kunde/create', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kunde/delete', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kunde/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kunde/update', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/kunde/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/message/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/message/config', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/message/extract', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/migrate/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/migrate/create', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/migrate/down', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/migrate/history', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/migrate/mark', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/migrate/new', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/migrate/redo', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/migrate/to', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/migrate/up', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/nachlass/*', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/nachlass/create', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/nachlass/delete', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/nachlass/index', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/nachlass/update', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/nachlass/view', 3, NULL, NULL, NULL, 1467418877, 1467418877, NULL),
('/projekt/*', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/projekt/create', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/projekt/delete', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/projekt/index', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/projekt/update', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/projekt/view', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/site/*', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/site/about', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/site/captcha', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/site/contact', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/site/error', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/site/index', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/site/login', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/site/logout', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/teileigentumseinheit/*', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/teileigentumseinheit/create', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/teileigentumseinheit/delete', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/teileigentumseinheit/index', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/teileigentumseinheit/update', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/teileigentumseinheit/view', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/user-management/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/bulk-activate', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/bulk-deactivate', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/bulk-delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/create', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/grid-page-size', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/grid-sort', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/toggle-attribute', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/update', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth-item-group/view', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/captcha', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/change-own-password', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/confirm-email', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/confirm-email-receive', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/confirm-registration-email', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/login', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/logout', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/password-recovery', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/password-recovery-receive', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/auth/registration', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/bulk-activate', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/bulk-deactivate', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/bulk-delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/create', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/grid-page-size', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/grid-sort', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/refresh-routes', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/set-child-permissions', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/set-child-routes', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/toggle-attribute', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/update', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/permission/view', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/bulk-activate', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/bulk-deactivate', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/bulk-delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/create', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/grid-page-size', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/grid-sort', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/set-child-permissions', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/set-child-roles', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/toggle-attribute', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/update', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/role/view', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-permission/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-permission/set', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-permission/set-roles', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/bulk-activate', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/bulk-deactivate', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/bulk-delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/create', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/grid-page-size', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/grid-sort', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/toggle-attribute', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/update', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user-visit-log/view', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/*', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/bulk-activate', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/bulk-deactivate', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/bulk-delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/change-password', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/create', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/delete', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/grid-page-size', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/grid-sort', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/index', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/toggle-attribute', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/update', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/user-management/user/view', 3, NULL, NULL, NULL, 1467393899, 1467393899, NULL),
('/zahlung/*', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/zahlung/create', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/zahlung/delete', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/zahlung/index', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/zahlung/update', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('/zahlung/view', 3, NULL, NULL, NULL, 1467418876, 1467418876, NULL),
('Admin', 1, 'Admin', NULL, NULL, 1467393899, 1467393899, NULL),
('assignRolesToUsers', 2, 'Assign roles to users', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('betreuung_mitarbeiter', 1, 'Betreuung Mitarbeiter', NULL, NULL, 1470084205, 1470085064, NULL),
('bindUserToIp', 2, 'Bind user to IP', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('buchhaltung_leitung', 1, 'Buchhaltung Leitung', NULL, NULL, 1467396689, 1470084175, NULL),
('buchhaltung_mitarbeiter', 1, 'Buchhaltung Mitarbeiter', NULL, NULL, 1467398743, 1470084119, NULL),
('changeOwnPassword', 2, 'Change own password', NULL, NULL, 1467393899, 1467393899, 'userCommonPermissions'),
('changeUserPassword', 2, 'Change user password', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('commonPermission', 2, 'Common permission', NULL, NULL, 1467393898, 1467393898, NULL),
('createUsers', 2, 'Create users', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('deleteUsers', 2, 'Delete users', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('editUserEmail', 2, 'Edit user email', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('editUsers', 2, 'Edit users', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('export', 2, 'Export/Serienbrief', NULL, NULL, 1470162749, 1470162749, 'userCommonPermissions'),
('facility_management', 1, 'Facility Management', NULL, NULL, 1470084310, 1470085039, NULL),
('read_company', 2, 'Lesen: Firmen', NULL, NULL, 1470164373, 1470164373, 'userCommonPermissions'),
('read_countinformation', 2, 'Lesen: Zählerstand Angaben', NULL, NULL, 1470163171, 1470164186, 'userCommonPermissions'),
('read_customer', 2, 'Lesen: Käufer', NULL, NULL, 1470163048, 1470164266, 'userCommonPermissions'),
('read_datasheets', 2, 'Lesen: Datenblätter', NULL, NULL, 1470163004, 1470164283, 'userCommonPermissions'),
('read_ownership', 2, 'Lesen: Teileigentumseinheiten', NULL, NULL, 1470163106, 1470164242, 'userCommonPermissions'),
('read_projects', 2, 'Lesen: Projekte', NULL, NULL, 1470163270, 1470164162, 'userCommonPermissions'),
('rechtsabteilung_leitung', 1, 'Rechtsabteilung Leitung', NULL, NULL, 1470084255, 1470084255, NULL),
('rechtsabteilung_mitarbeiter', 1, 'Rechtsabteilung Mitarbeiter', NULL, NULL, 1470084784, 1470084784, NULL),
('report', 2, 'Berichte', NULL, NULL, 1470165215, 1470165215, 'userCommonPermissions'),
('settings', 2, 'Einstellungen', NULL, NULL, 1470162952, 1470162952, 'userCommonPermissions'),
('vertrieb_abg', 1, 'Vertrieb ABG', NULL, NULL, 1470084285, 1470084285, NULL),
('vertrieb_extern', 1, 'Vertrieb Extern', NULL, NULL, 1470084955, 1470084955, NULL),
('viewall', 2, 'Alles ansehen', NULL, NULL, 1467399139, 1467579678, 'userCommonPermissions'),
('viewRegistrationIp', 2, 'View registration IP', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('viewUserEmail', 2, 'View user email', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('viewUserRoles', 2, 'View user roles', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('viewUsers', 2, 'View users', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('viewVisitLog', 2, 'View visit log', NULL, NULL, 1467393899, 1467393899, 'userManagement'),
('write_company', 2, 'Schreiben: Firmen', NULL, NULL, 1470164422, 1470164422, 'userCommonPermissions'),
('write_countinformation', 2, 'Schreiben:  Zählerstand Angaben', NULL, NULL, 1470164479, 1470164479, 'userCommonPermissions'),
('write_customer', 2, 'Schreiben: Käufer', NULL, NULL, 1470164591, 1470164591, 'userCommonPermissions'),
('write_datasheets', 2, 'Schreiben: Datenblätter', NULL, NULL, 1470164637, 1470164637, 'userCommonPermissions'),
('write_ownership', 2, 'Schreiben: Teileigentumseinheiten', NULL, NULL, 1470164532, 1470164532, 'userCommonPermissions'),
('write_projects', 2, 'Schreiben: Projekte', NULL, NULL, 1470164330, 1470164330, 'userCommonPermissions');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('viewall', '//index'),
('viewall', '/abschlag/index'),
('viewall', '/abschlag/view'),
('read_datasheets', '/datenblatt/index'),
('viewall', '/datenblatt/index'),
('export', '/datenblatt/pdf'),
('viewall', '/datenblatt/pdf'),
('export', '/datenblatt/report'),
('viewall', '/datenblatt/view'),
('viewall', '/einheitstyp/index'),
('viewall', '/einheitstyp/view'),
('write_company', '/firma/*'),
('read_company', '/firma/index'),
('viewall', '/firma/index'),
('viewall', '/firma/view'),
('export', '/gridview/export/*'),
('export', '/gridview/export/download'),
('write_ownership', '/haus/*'),
('viewall', '/haus/index'),
('write_projects', '/haus/projekte'),
('viewall', '/haus/view'),
('read_customer', '/kaeufer/index'),
('viewall', '/kaeufer/index'),
('viewall', '/kaeufer/view'),
('viewall', '/kunde/index'),
('viewall', '/kunde/view'),
('viewall', '/nachlass/index'),
('viewall', '/nachlass/view'),
('viewUsers', '/projekt/*'),
('write_projects', '/projekt/*'),
('read_projects', '/projekt/index'),
('viewall', '/projekt/index'),
('viewall', '/projekt/view'),
('viewall', '/site/*'),
('viewall', '/site/about'),
('viewall', '/site/captcha'),
('viewall', '/site/contact'),
('viewall', '/site/error'),
('viewall', '/site/index'),
('viewall', '/site/login'),
('viewall', '/site/logout'),
('write_ownership', '/teileigentumseinheit/*'),
('read_ownership', '/teileigentumseinheit/index'),
('viewall', '/teileigentumseinheit/index'),
('viewall', '/teileigentumseinheit/view'),
('viewall', '/user-management/auth/*'),
('changeOwnPassword', '/user-management/auth/change-own-password'),
('assignRolesToUsers', '/user-management/user-permission/set'),
('assignRolesToUsers', '/user-management/user-permission/set-roles'),
('viewVisitLog', '/user-management/user-visit-log/grid-page-size'),
('viewVisitLog', '/user-management/user-visit-log/index'),
('viewVisitLog', '/user-management/user-visit-log/view'),
('editUsers', '/user-management/user/bulk-activate'),
('editUsers', '/user-management/user/bulk-deactivate'),
('deleteUsers', '/user-management/user/bulk-delete'),
('changeUserPassword', '/user-management/user/change-password'),
('createUsers', '/user-management/user/create'),
('deleteUsers', '/user-management/user/delete'),
('editUsers', '/user-management/user/update'),
('viewall', '/zahlung/index'),
('viewall', '/zahlung/view'),
('Admin', 'assignRolesToUsers'),
('Admin', 'changeOwnPassword'),
('betreuung_mitarbeiter', 'changeOwnPassword'),
('buchhaltung_leitung', 'changeOwnPassword'),
('buchhaltung_mitarbeiter', 'changeOwnPassword'),
('facility_management', 'changeOwnPassword'),
('rechtsabteilung_leitung', 'changeOwnPassword'),
('rechtsabteilung_mitarbeiter', 'changeOwnPassword'),
('vertrieb_abg', 'changeOwnPassword'),
('vertrieb_extern', 'changeOwnPassword'),
('Admin', 'changeUserPassword'),
('Admin', 'createUsers'),
('Admin', 'deleteUsers'),
('Admin', 'editUsers'),
('betreuung_mitarbeiter', 'export'),
('buchhaltung_leitung', 'export'),
('facility_management', 'export'),
('rechtsabteilung_leitung', 'export'),
('rechtsabteilung_mitarbeiter', 'export'),
('vertrieb_abg', 'export'),
('betreuung_mitarbeiter', 'read_company'),
('buchhaltung_leitung', 'read_company'),
('buchhaltung_mitarbeiter', 'read_company'),
('facility_management', 'read_company'),
('rechtsabteilung_leitung', 'read_company'),
('rechtsabteilung_mitarbeiter', 'read_company'),
('vertrieb_abg', 'read_company'),
('vertrieb_extern', 'read_company'),
('betreuung_mitarbeiter', 'read_countinformation'),
('buchhaltung_leitung', 'read_countinformation'),
('buchhaltung_mitarbeiter', 'read_countinformation'),
('facility_management', 'read_countinformation'),
('rechtsabteilung_leitung', 'read_countinformation'),
('rechtsabteilung_mitarbeiter', 'read_countinformation'),
('vertrieb_abg', 'read_countinformation'),
('vertrieb_extern', 'read_countinformation'),
('betreuung_mitarbeiter', 'read_customer'),
('buchhaltung_leitung', 'read_customer'),
('buchhaltung_mitarbeiter', 'read_customer'),
('facility_management', 'read_customer'),
('rechtsabteilung_leitung', 'read_customer'),
('rechtsabteilung_mitarbeiter', 'read_customer'),
('vertrieb_abg', 'read_customer'),
('vertrieb_extern', 'read_customer'),
('betreuung_mitarbeiter', 'read_datasheets'),
('buchhaltung_leitung', 'read_datasheets'),
('buchhaltung_mitarbeiter', 'read_datasheets'),
('facility_management', 'read_datasheets'),
('rechtsabteilung_leitung', 'read_datasheets'),
('rechtsabteilung_mitarbeiter', 'read_datasheets'),
('vertrieb_abg', 'read_datasheets'),
('vertrieb_extern', 'read_datasheets'),
('betreuung_mitarbeiter', 'read_ownership'),
('buchhaltung_leitung', 'read_ownership'),
('buchhaltung_mitarbeiter', 'read_ownership'),
('facility_management', 'read_ownership'),
('rechtsabteilung_leitung', 'read_ownership'),
('rechtsabteilung_mitarbeiter', 'read_ownership'),
('vertrieb_abg', 'read_ownership'),
('vertrieb_extern', 'read_ownership'),
('betreuung_mitarbeiter', 'read_projects'),
('buchhaltung_leitung', 'read_projects'),
('buchhaltung_mitarbeiter', 'read_projects'),
('facility_management', 'read_projects'),
('rechtsabteilung_leitung', 'read_projects'),
('rechtsabteilung_mitarbeiter', 'read_projects'),
('vertrieb_abg', 'read_projects'),
('vertrieb_extern', 'read_projects'),
('betreuung_mitarbeiter', 'report'),
('buchhaltung_leitung', 'report'),
('buchhaltung_mitarbeiter', 'report'),
('facility_management', 'report'),
('rechtsabteilung_leitung', 'report'),
('rechtsabteilung_mitarbeiter', 'report'),
('vertrieb_abg', 'report'),
('vertrieb_extern', 'report'),
('betreuung_mitarbeiter', 'settings'),
('buchhaltung_leitung', 'settings'),
('buchhaltung_mitarbeiter', 'settings'),
('facility_management', 'settings'),
('rechtsabteilung_leitung', 'settings'),
('rechtsabteilung_mitarbeiter', 'settings'),
('vertrieb_abg', 'settings'),
('betreuung_mitarbeiter', 'viewall'),
('buchhaltung_leitung', 'viewall'),
('facility_management', 'viewall'),
('rechtsabteilung_leitung', 'viewall'),
('rechtsabteilung_mitarbeiter', 'viewall'),
('vertrieb_abg', 'viewall'),
('vertrieb_extern', 'viewall'),
('viewUsers', 'viewall'),
('editUserEmail', 'viewUserEmail'),
('viewall', 'viewUserEmail'),
('assignRolesToUsers', 'viewUserRoles'),
('viewall', 'viewUserRoles'),
('Admin', 'viewUsers'),
('assignRolesToUsers', 'viewUsers'),
('buchhaltung_mitarbeiter', 'viewUsers'),
('changeUserPassword', 'viewUsers'),
('createUsers', 'viewUsers'),
('deleteUsers', 'viewUsers'),
('editUsers', 'viewUsers'),
('betreuung_mitarbeiter', 'write_company'),
('betreuung_mitarbeiter', 'write_countinformation'),
('facility_management', 'write_countinformation'),
('betreuung_mitarbeiter', 'write_customer'),
('vertrieb_abg', 'write_customer'),
('vertrieb_extern', 'write_customer'),
('betreuung_mitarbeiter', 'write_datasheets'),
('buchhaltung_mitarbeiter', 'write_datasheets'),
('betreuung_mitarbeiter', 'write_ownership'),
('buchhaltung_mitarbeiter', 'write_ownership'),
('betreuung_mitarbeiter', 'write_projects');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auth_item_group`
--

CREATE TABLE IF NOT EXISTS `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `auth_item_group`
--

INSERT INTO `auth_item_group` (`code`, `name`, `created_at`, `updated_at`) VALUES
('userCommonPermissions', 'User common permission', 1467393899, 1467418368),
('userManagement', 'User management', 1467393899, 1467393899);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datenblatt`
--

CREATE TABLE IF NOT EXISTS `datenblatt` (
`id` int(11) NOT NULL,
  `firma_id` int(10) unsigned DEFAULT NULL,
  `projekt_id` int(10) unsigned DEFAULT NULL,
  `haus_id` int(10) unsigned DEFAULT NULL,
  `nummer` int(11) DEFAULT NULL,
  `kaeufer_id` int(10) unsigned DEFAULT NULL,
  `besondere_regelungen_kaufvertrag` text,
  `sonstige_anmerkungen` text,
  `aktiv` tinyint(1) DEFAULT '0',
  `beurkundung_am` date DEFAULT NULL,
  `verbindliche_fertigstellung` date DEFAULT NULL,
  `uebergang_bnl` date DEFAULT NULL,
  `abnahme_se` date DEFAULT NULL,
  `abnahme_ge` date DEFAULT NULL,
  `auflassung` tinyint(1) DEFAULT '0',
  `creator_user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `datenblatt`
--

INSERT INTO `datenblatt` (`id`, `firma_id`, `projekt_id`, `haus_id`, `nummer`, `kaeufer_id`, `besondere_regelungen_kaufvertrag`, `sonstige_anmerkungen`, `aktiv`, `beurkundung_am`, `verbindliche_fertigstellung`, `uebergang_bnl`, `abnahme_se`, `abnahme_ge`, `auflassung`, `creator_user_id`) VALUES
(12, 2, 5, 59, NULL, 13, 'Käufer möchte alle Rechnungen vorap per E-Mail erhalten ', '', 1, '2016-03-23', '2018-05-15', '2018-02-06', '2018-06-13', '2018-06-28', 1, 1),
(26, 2, 5, 48, NULL, 14, '', '', 1, '2016-03-24', NULL, NULL, NULL, NULL, 0, 1),
(27, 2, 5, 20, NULL, 15, 'Bitte Zahlungensanforderungen vorab per E-Mail versenden!', '', 1, '2016-04-01', NULL, NULL, NULL, NULL, 0, 1),
(28, 2, 5, 61, NULL, 11, '', '', 1, '2016-04-01', NULL, NULL, NULL, NULL, 0, 1),
(29, 2, 5, 45, NULL, 16, '', '', 1, '2016-04-01', NULL, NULL, NULL, NULL, 0, 1),
(30, 2, 5, 60, NULL, 17, '', '', 1, '2016-04-04', NULL, NULL, NULL, NULL, 0, 1),
(31, 2, 5, 74, NULL, 21, '', '', 1, '2016-04-07', NULL, NULL, NULL, NULL, 0, 1),
(33, 2, 5, 16, NULL, 18, '', '', 1, '2016-04-07', NULL, NULL, NULL, NULL, 0, 1),
(34, 2, 5, 82, NULL, 24, '', '', 1, '2016-04-12', NULL, NULL, NULL, NULL, 0, 1),
(35, 2, 5, 25, NULL, 22, '', '', 1, '2016-04-11', NULL, NULL, NULL, NULL, 0, 1),
(36, 2, 5, 77, NULL, 23, '', '', 1, '2016-04-11', NULL, NULL, NULL, NULL, 0, 1),
(40, 2, 5, 26, NULL, 25, '', '', 1, '2016-04-13', '2018-05-15', NULL, NULL, NULL, 0, 1),
(41, 2, 5, 11, NULL, 26, '', '', 1, '2016-04-22', '2016-04-15', NULL, NULL, NULL, 0, 1),
(43, 2, 5, 54, NULL, 27, '', '', 1, '2016-04-22', '2018-05-15', NULL, NULL, NULL, 0, 1),
(44, 2, 5, 81, NULL, 28, '', '', 1, '2016-04-21', '2018-05-15', NULL, NULL, NULL, 0, 1),
(46, 2, 5, 19, NULL, 56, '', '', 1, '2016-05-19', '2018-05-15', NULL, NULL, NULL, 0, 1),
(47, 2, 5, 35, NULL, 66, '', '', 1, '2016-05-27', NULL, NULL, NULL, NULL, 0, 1),
(49, 2, 5, 34, NULL, 45, '', '', 1, '2016-05-27', '2018-05-15', NULL, NULL, NULL, 0, 1),
(50, 2, 5, 80, NULL, 62, '', '', 1, '2016-05-12', '2018-05-15', NULL, NULL, NULL, 0, 1),
(54, 2, 5, 68, NULL, 29, 'Kunde bittet darum die Preise für die Wohnung, TG und Lager getrennt auszuweisen', '', 1, '2016-04-28', '2018-05-15', NULL, NULL, NULL, 0, 1),
(56, 2, 5, 78, NULL, 44, '', '', 1, '2016-05-26', '2018-05-15', NULL, NULL, NULL, 0, 1),
(57, 2, 5, 24, NULL, 55, '', '', 1, '2016-04-25', '2018-05-15', NULL, NULL, NULL, 0, 1),
(59, 2, 5, 41, NULL, 30, '', '', 1, '2016-04-29', '2018-05-15', NULL, NULL, NULL, 0, 1),
(60, 2, 5, 64, NULL, 53, '', 'Haben 3 Wohnungen gekauft (Whg. 31, 48, 51)', 1, '2016-04-29', '2018-05-15', NULL, NULL, NULL, 0, 1),
(62, 2, 5, 67, NULL, 54, '', 'Kaufen 3 Wohnungen 31,48, 51', 1, '2016-04-29', '2018-05-15', NULL, NULL, NULL, 0, 1),
(65, 2, 5, 33, NULL, 31, '', '', 1, '2016-05-02', '2018-05-15', NULL, NULL, NULL, 0, 1),
(67, 2, 5, 8, NULL, 35, '', '', 1, '2016-05-06', '2018-05-15', NULL, NULL, NULL, 0, 1),
(68, 2, 5, 29, NULL, 37, '', '', 1, '2016-05-09', '2018-05-15', NULL, NULL, NULL, 0, 1),
(71, 2, 5, 62, NULL, 38, '', '', 1, '2016-05-10', '2018-05-15', NULL, NULL, NULL, 0, 1),
(72, 2, 5, 58, NULL, 48, '', '', 1, '2016-05-17', '2018-05-15', NULL, NULL, NULL, 0, 1),
(78, 2, 5, 14, NULL, 40, '', '', 1, '2016-05-17', '2018-05-15', NULL, NULL, NULL, 0, 1),
(79, 2, 5, 51, NULL, 41, '', '', 1, '2016-05-17', '2018-05-15', NULL, NULL, NULL, 0, 1),
(81, 2, 5, 76, NULL, 42, '', '', 1, '2016-05-20', '2016-11-15', NULL, NULL, NULL, 0, 1),
(84, 2, 5, 36, NULL, 50, '', '', 1, '2016-05-23', '2018-05-15', NULL, NULL, NULL, 0, 1),
(85, 2, 5, 21, NULL, 63, '', '', 1, '2016-05-23', '2018-05-15', NULL, NULL, NULL, 0, 1),
(87, 2, 5, 18, NULL, 43, '', '', 1, '2016-05-23', '2018-05-15', NULL, NULL, NULL, 0, 1),
(88, 2, 5, 22, NULL, 64, '', '', 1, '2016-06-24', '2018-05-15', NULL, NULL, NULL, 0, 1),
(91, 2, 5, 15, NULL, 33, '', 'Kaufen keinen Stellplatz', 1, '2016-05-23', NULL, NULL, NULL, NULL, 0, 1),
(92, 2, 5, 70, NULL, 68, '', '', 1, '2016-06-06', '2018-05-15', NULL, NULL, NULL, 0, 1),
(93, 2, 5, 43, NULL, 67, '', '', 1, '2016-06-07', '2018-05-15', NULL, NULL, NULL, 0, 1),
(94, 2, 5, 42, NULL, 69, '', '', 1, '2016-06-10', '2018-05-15', NULL, NULL, NULL, 0, 1),
(95, 2, 5, 28, NULL, 70, '', '', 1, '2016-06-16', '2018-05-15', NULL, NULL, NULL, 0, 1),
(97, 2, 5, 23, NULL, 51, '', '', 1, '2016-05-30', '2018-05-15', NULL, NULL, NULL, 0, 1),
(98, 2, 5, 71, NULL, 49, '', '', 1, '2016-05-30', '2018-05-15', NULL, NULL, NULL, 0, 1),
(99, 2, 5, 40, NULL, 46, '', '', 1, '2016-05-31', '2018-05-15', NULL, NULL, NULL, 0, 1),
(100, 2, 5, 30, NULL, 52, '', '', 1, '2016-06-02', '2018-05-15', NULL, NULL, NULL, 0, 1),
(101, 2, 5, 50, NULL, 74, '', '', 1, '2016-06-02', '2018-05-15', NULL, NULL, NULL, 0, 1),
(103, 2, 5, 17, NULL, 34, '', '', 1, '2016-05-03', '2018-05-15', NULL, NULL, NULL, 0, 1),
(105, 2, 5, 27, NULL, 19, '', '', 1, '2016-04-05', '2018-05-15', NULL, NULL, NULL, 0, 1),
(106, 2, 5, 31, NULL, 32, '', '', 1, '2016-05-02', '2018-05-15', NULL, NULL, NULL, 0, 1),
(107, 2, 5, 32, NULL, 79, '', '', 1, '2016-07-29', '2018-05-15', NULL, NULL, NULL, 0, 1),
(108, 2, 5, 37, NULL, 75, '', '', 1, '2016-06-24', '2018-05-15', NULL, NULL, NULL, 0, 1),
(110, 2, 5, 38, NULL, 36, '', '', 1, '2016-05-06', '2018-05-15', NULL, NULL, NULL, 0, 1),
(111, 2, 5, 39, NULL, 71, '', '', 1, '2016-06-24', '2018-05-15', NULL, NULL, NULL, 0, 1),
(113, 2, 5, 47, NULL, 72, '', '', 1, '2016-06-27', NULL, NULL, NULL, NULL, 0, 1),
(114, 2, 5, 57, NULL, 76, '', '', 1, '2016-04-15', '2018-05-15', NULL, NULL, NULL, 0, 1),
(116, 2, 5, 63, NULL, 20, '', '', 1, '2016-04-05', NULL, NULL, NULL, NULL, 0, 1),
(117, 2, 5, 65, NULL, 77, '', '', 1, '2016-04-15', NULL, NULL, NULL, NULL, 0, 1),
(119, 2, 5, 79, NULL, 78, '', '', 1, '2016-06-28', NULL, NULL, NULL, NULL, 0, 1),
(121, 2, 5, 73, NULL, 73, '', '', 1, NULL, NULL, NULL, NULL, NULL, 0, 1),
(122, 2, 5, 12, NULL, 80, '', '', 1, '2016-07-12', '2018-05-15', NULL, NULL, NULL, 0, 1),
(126, 2, 5, 46, NULL, 81, '', '', 1, '2016-07-25', NULL, NULL, NULL, NULL, 0, 1),
(128, 2, 5, 66, NULL, 83, '', '', 1, '2016-07-25', '2018-05-15', NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `einheitstyp`
--

CREATE TABLE IF NOT EXISTS `einheitstyp` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `einheit` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `einheitstyp`
--

INSERT INTO `einheitstyp` (`id`, `name`, `einheit`) VALUES
(1, 'Wohnung', 'm2'),
(2, 'Stellplatz', 'Stck.'),
(3, 'Lagerraum', 'm2'),
(4, 'Garage', 'm2'),
(5, 'Außenstellplatz', 'Stück'),
(6, 'Keller', 'm2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `firma`
--

CREATE TABLE IF NOT EXISTS `firma` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `firma`
--

INSERT INTO `firma` (`id`, `name`, `nr`) VALUES
(2, 'ABG Allgemeine Bauträgergesellschaft mbH & Co. Objekt Max-Bill-Str. KG', '335'),
(3, 'ABG Allgemeine Bauträgergesellschaft mbH & Co. Objekt Bernadottestraße KG', '334');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `haus`
--

CREATE TABLE IF NOT EXISTS `haus` (
`id` int(10) unsigned NOT NULL,
  `projekt_id` int(10) unsigned DEFAULT NULL,
  `firma_id` int(10) unsigned DEFAULT NULL,
  `plz` varchar(255) DEFAULT NULL,
  `ort` varchar(255) DEFAULT NULL,
  `strasse` varchar(255) DEFAULT NULL,
  `hausnr` varchar(45) DEFAULT NULL,
  `reserviert` tinyint(1) DEFAULT '0',
  `verkauft` tinyint(1) DEFAULT '0',
  `rechnung_vertrieb` tinyint(1) DEFAULT '0',
  `creator_user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `haus`
--

INSERT INTO `haus` (`id`, `projekt_id`, `firma_id`, `plz`, `ort`, `strasse`, `hausnr`, `reserviert`, `verkauft`, `rechnung_vertrieb`, `creator_user_id`) VALUES
(8, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(11, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(12, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(14, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(15, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(16, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(17, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(18, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(19, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(20, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(21, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(22, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(23, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(24, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(25, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(26, 5, 2, '80807', 'München', 'Max-Bill-Straße ', '', 0, 1, 1, 1),
(27, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(28, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(29, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(30, 5, 2, '80809', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(31, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(32, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(33, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(34, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(35, 5, 2, '80809', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(36, 5, 2, '80809', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(37, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(38, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(39, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(40, 5, 2, '80809', 'München', 'Max-Bill-Straße ', '', 0, 1, 1, 1),
(41, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(42, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(43, 5, 2, '80807', 'München', 'Max-Bill-Straße ', '', 0, 1, 1, 1),
(45, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(46, 5, 2, '80809', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(47, 5, 2, '80809', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(48, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(50, 5, 2, '80809', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(51, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(54, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(57, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(58, 5, 2, '80809', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(59, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(60, 5, 2, '80807', 'München', 'Max-Bill-Straße ', '', 0, 1, 1, 1),
(61, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(62, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(63, 5, 2, '80807', 'München', 'Max-Bill-Straße ', '', 0, 1, 1, 1),
(64, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(65, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(66, 5, 2, '80807', 'München', 'Max-Bill-Straße ', '', 0, 1, 1, 1),
(67, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(68, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(70, 5, 2, '80809', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(71, 5, 2, '80809', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(73, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(74, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(76, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(77, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(78, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(79, 5, 2, '80807', 'München', 'Max-Bill-Straße ', '', 0, 1, 1, 1),
(80, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(81, 5, 2, '80807', 'München', 'Max-Bill-Straße ', '', 0, 1, 1, 1),
(82, 5, 2, '80807', 'München', 'Max-Bill-Straße', '', 0, 1, 1, 1),
(101, 5, 2, '80809', 'München ', 'Max-BillStraße', '', 0, 1, 1, 6),
(102, NULL, NULL, '', '', '', '', 0, 0, 0, 6),
(104, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(105, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(107, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(108, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(109, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(110, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(111, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(112, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(113, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(114, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(115, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(116, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(117, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(118, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(119, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(121, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(122, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(123, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(124, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(125, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(126, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(127, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(128, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(129, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(130, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(131, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(132, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(133, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(134, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(135, NULL, NULL, '', '', '', '', 0, 0, 0, 6),
(141, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(142, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(143, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(144, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18),
(145, 6, 3, '', 'Hamburg', 'Bernadottestraße', '83', 0, 0, 0, 18);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kaeufer`
--

CREATE TABLE IF NOT EXISTS `kaeufer` (
`id` int(10) unsigned NOT NULL,
  `debitor_nr` varchar(255) DEFAULT NULL,
  `beurkundung_am` date DEFAULT NULL,
  `verbindliche_fertigstellung` date DEFAULT NULL,
  `uebergang_bnl` date DEFAULT NULL,
  `abnahme_se` date DEFAULT NULL,
  `abnahme_ge` date DEFAULT NULL,
  `auflassung` tinyint(1) DEFAULT '0',
  `anrede` tinyint(1) DEFAULT '0',
  `titel` varchar(255) DEFAULT NULL,
  `vorname` varchar(255) DEFAULT NULL,
  `nachname` varchar(255) DEFAULT NULL,
  `strasse` varchar(255) DEFAULT NULL,
  `hausnr` varchar(255) DEFAULT NULL,
  `plz` varchar(255) DEFAULT NULL,
  `ort` varchar(255) DEFAULT NULL,
  `festnetz` varchar(255) DEFAULT NULL,
  `handy` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `anrede2` tinyint(1) DEFAULT NULL,
  `titel2` varchar(255) DEFAULT NULL,
  `vorname2` varchar(255) DEFAULT NULL,
  `nachname2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kaeufer`
--

INSERT INTO `kaeufer` (`id`, `debitor_nr`, `beurkundung_am`, `verbindliche_fertigstellung`, `uebergang_bnl`, `abnahme_se`, `abnahme_ge`, `auflassung`, `anrede`, `titel`, `vorname`, `nachname`, `strasse`, `hausnr`, `plz`, `ort`, `festnetz`, `handy`, `email`, `anrede2`, `titel2`, `vorname2`, `nachname2`) VALUES
(8, '123456', '2015-01-01', '2018-01-01', '2018-01-01', '2018-01-01', '2018-01-01', 1, 0, 'Dr.', 'Karl', 'Mustermann', 'Muster Str.', '7', '80333', 'München', '08924-226', '0123456078', 'karl.muster@tlin.de', NULL, '', '', ''),
(11, '635045', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Giovanni', 'Minniti', 'Robert Koch Allee', '19', '82131', 'Gauting', '', '0151/20577808', 'minniti@t-online.de', NULL, '', '', ''),
(13, '635043', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Guillermo', 'Benedicto', 'Otl-Aicher-Straße ', '44', '80807', 'München', '', '0176/38758050', 'antrueba43@gmail.com', 1, '', 'Ana', 'Trueba'),
(14, '635037', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Josef', 'Lechner', 'Fürstbach ', '1', '84416', 'Taufkirchen', '', '01721083883', 'lechner.josef@web.de', 1, '', 'Angela', 'Lechner'),
(15, '635009', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Patrick ', 'Rauschecker', 'Neubrunnenstraße ', '31/43', 'CH-8050', 'Zürich', '', '01722506354', 'patrick.rauschecker@gmail.com', NULL, '', '', ''),
(16, '635034', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Giovanni', 'Minniti', 'Robert Koch Allee', '19', '82131', 'Gauting', '', '015120577808', 'minniti@t-online.de', 1, '', 'Beatrice', 'Minniti'),
(17, '635044', NULL, NULL, NULL, NULL, NULL, 0, 0, 'Dr. ', 'Hartmut ', 'Müller', 'Parkweg ', '12', '45768', 'Marl', '', '', 'hm.marl@t-online.de', NULL, '', '', ''),
(18, '635008', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Florian', 'Fecht', 'Kunigundenstraße ', '63', '80805', 'München', '', '0176/21993953', 'sarah.fecht@gmx.de', 1, '', 'Sarah', 'Fecht'),
(19, '635017', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Walter', 'Kuffner', 'Heisenbergstraße ', '3', '80937', 'München', '', '0173/2150355', 'wjkuffner@arcor.de', 1, '', 'Rosamunde', 'Pongartz-Kuffner'),
(20, '635047', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Stefan ', 'Wiedemann', 'Otl-Aicher-Straße ', '52', '80807', 'München', '', '0176/63418353', 'stefan.wiedemann@campusm21.de', 1, '', 'Nicole', 'Wiedemann'),
(21, '635056', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Martin', 'Straubinger', 'Georg-Elser-Weg ', '5', '85221', 'Dachau ', '', '0170/2432920', 'martin.straubinger@mail.de', 1, '', 'Christiane', 'Straubinger'),
(22, '635014', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Klaus ', 'Merkel', 'Spitzerstraße ', '22', '80939', 'München', '', '0174/7695743', 'merkel@irt.de', 1, '', 'Elisabeth', 'Merkel'),
(23, '635058', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Viktor ', 'Willmar', 'Buchäckerstraße ', '1', '80339', 'Chieming', '', '', 'dr.astrid.scheuerer@dr-willmar.de', NULL, '', '', ''),
(24, '635063', NULL, NULL, NULL, NULL, NULL, 0, 1, '', 'Petra', 'Romeike', 'Bgm-Weger-Weg ', '9', '82140', 'Olching', '', '08142/2847219', 'petra-romeike@gmx.de', NULL, '', '', ''),
(25, '635016', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Richard ', 'Götzinger', 'Löwenzahnweg ', '8 b', '80935', 'München ', '', '01515-5124750__', 'christine.boettcher-goetzinger@gmx.de', 1, '', 'Christine ', 'Böttcher-Götzinger'),
(26, '635010', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Heinz', 'Treseler', 'Hans-Döllgast-Straße ', '8', '80807 ', 'München', '', '0177/6233737', 'h.treseler@gmx.de', NULL, '', '', ''),
(27, '635040', NULL, NULL, NULL, NULL, NULL, 0, 1, '', 'Simone ', 'Kindlein', 'Feldmochinger Weg ', '10', '85748 ', 'Garching', '', '0160/8049239', 'simona_kindlein@gmx.de', NULL, '', '', ''),
(28, '635062', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Jörg Helmut ', 'Wensky', 'Schopenhauerstraße ', '42', '80807', 'München', '', '0172/9504702', 'joerg.wensky@web.de', 1, '', 'Verena', 'Heinzl'),
(29, '635052', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Michael', 'Straub', 'Wimpfener Straße ', '6', '80807', 'München', '', '0160/94969163', 'vpoeschko@gmail.de', 1, '', 'Veronika', 'Straub'),
(30, '635031', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Claus', 'Denk', 'Ulring ', '67 a', '84137', 'Vilsbiburg', '', '0170/1663393', 'die.denks@me.com', 1, '', 'Sylvia', 'Denk'),
(31, '635023', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Januz', 'Veliqi', 'Von-Knoeringen-Straße ', '8', '81737', 'München', '', '0176/61389863', 'besart.veliqi@gmx.de', 1, '', 'Hajrije', 'Veliqi'),
(32, '635021', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Abdefallah', 'Chaabane', 'Graslilienanger ', '12', '80937', 'München', '', '0178/8322373', 'a.chaabane@hotmail.de', 1, '', 'Sarra', 'Timaumi'),
(33, '635007', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Kai-Micael', 'Huß', 'Adam-Berg-Straße ', '9', '81735', 'München', '00089-64966926', '0177/9418889', 'kaimicaelhuss@gmail.com', 1, '', 'Elizabeth', 'Huß-Stannull'),
(34, '635005', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Bernhard', 'Blümelhuber', 'Einfeld', '37', '84339', 'Unterdietfurt', '', '0160/90420412', 'bernhard.bluemelhuber@unicredit.de', 1, '', 'Renate', 'Blümelhuber'),
(35, '635002', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Werner', 'Rissel', 'Maximillianstraße', '42', '82319', 'Starnberg', '', '0163/7564117', 'werner.rissel@i-m-living.de', NULL, '', '', ''),
(36, '635026', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Valbon', 'Gashi', 'Garmischer Straße ', '256', '81377', 'München', '', '0178/3037055', 'arbresha.gashi@hotmail.de', 1, '', 'Abresha', 'Valbon'),
(37, '635019', NULL, NULL, NULL, NULL, NULL, 0, 0, 'Dr. ', 'Achim', 'Holzer', 'Kirchenleite ', '20 b', '82507 ', 'Icking', '', '0152/57712719', 'achim.holzer@gmail.com', NULL, '', '', ''),
(38, '635046', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Gerhard', 'Schrödl', 'Marienburgerstraße', '3 b', '84028', 'Landshut', '', '0160/5841000', 'stephan.schroedl@kontra.eu', 1, '', 'Heidrun', 'Schrödl'),
(39, '', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Heinrich', 'Schrödl', 'Lily-Reich-Straße ', '6', '80807', 'München', '', '0176/10614433', 'mail@robert-heinrich.de', NULL, '', '', ''),
(40, '635003', NULL, NULL, NULL, NULL, NULL, 0, 1, '', 'Gertraud', 'Schwaiger', 'Taufkirchener Straße ', '7', '85649', 'Brunnthal', '', '0172/8443104', 'gertraud.schwaiger@gmx.de ', NULL, '', '', ''),
(41, '635039', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Christian', 'Remus', 'Leopoldstraße ', '101', '80807 ', 'München', '', '0172/8982892', 'chistian.remus@remus-partner.de', NULL, '', '', ''),
(42, '635057', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Stefan', 'Schmidl', 'Oberstimmerstraße ', '17', '85051', 'Ingolstadt', '', '0176/84785242', 'stefan.schmidl@gmx.de', NULL, '', '', ''),
(43, '635004', NULL, NULL, NULL, NULL, NULL, 0, 0, 'Dr.', 'Lars', 'Gerdes', 'Heimeranstraße ', '39', '80339', 'München ', '', '0176/60847338', 'gerdes.tina@gmx.net', 1, '', 'Tina ', 'Gerdes'),
(44, '635059', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Robert ', 'Heinrich', 'Lily-Reich-Straße', '6', '80807', 'München', '', '0176/10614433', 'mail@robert-heinrich.de', NULL, '', '', ''),
(45, '635028', NULL, NULL, NULL, NULL, NULL, 0, 1, '', 'Claudia', 'Helldobler', 'Düsseldorfer Straße', '5', '80804', 'München', '', '0171/7431456', 'chelldobler@yahoo.de', NULL, '', '', ''),
(46, '635030', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Felix', 'Hartmann', 'Klementinenstraße', '41', '80809', 'München', '', '0177/8374636', 'liza.hassel@web.de', 1, 'Angelica ', 'Hassel', ''),
(48, '635042', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Yusuf', 'Demir', 'Weddigenstraße ', '21', '81737', 'München', '', '0163/4472576', 'yusuf_1981@hotmail.de', 1, '', 'Bahar ', 'Yusuf'),
(49, '635054', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Joachim', 'Lutz', 'Karlstraße ', '41', '80333', 'München', '', '0160/96311685', 'joe-man@gmx.net', NULL, '', '', ''),
(50, '635024', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Stefan ', 'Wagner', 'Ursberger Straße ', '9', '81673', 'München', '', '0176/39228805', 's-wagner@arcor.de', 1, 'Carina ', '', 'Wagner'),
(51, '635012', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Peter', 'Borowski', 'Adalbertstraße ', '10', '80799', 'München', '', '0177/9195711', 'peter.borowski@gmx.net', 1, '', 'Jana', 'Graul'),
(52, '635020', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Patrick', 'Aßmann', 'Meier-Leibnitz-Straße ', '12', '85748', 'Garching ', '', '017680403024', 'patrick.assmann@web.de', 1, '', 'Tanja', 'Stecewytsch'),
(53, '635048', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Claus ', 'Denk', 'Ulring ', '67 a', '84137', 'Vilsbiburg', '', '0170/1663393', 'die.denks@me.com', 1, '', 'Sylvia ', 'Denk '),
(54, '635051', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Claus', 'Denk', 'Ulring ', '67 a', '84137', 'Vilsbiburg', '', '0170/1663393', 'die.denks@me.com', 1, '', 'Sylvia', 'Denk'),
(55, '635013', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Wei', 'Xing', 'Pickelstraße ', '14', '80637', 'München', '', '0179/7067925', 'sonjamxx@yahoo.de', 1, '', 'Xiaoxuan', 'Ma'),
(56, '635006', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Manfred ', 'Fischer', 'Carl-Orff-Bogen', '87', '80939', 'München', '08931-15738', '', 'man.fischer@t-online.de', 1, '', 'Veronika ', 'Fischer'),
(60, '635002', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Werner', 'Rissel', 'Peter-Ostermayr-Straße ', '1', '82031', 'Grünwald', '', '0163/7564117', 'werner.rissel@i-m-living.de', NULL, '', '', ''),
(61, '635026', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Valbon', 'Gahsi', 'Garmischer Straße ', '256', '81377', 'München', '', '0178/3037055', 'arbresha.gashi@hotmail.de', 1, '', 'Arbresha', 'Gashi'),
(62, '635061', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Torben', 'Volkwein', 'Donnersbergerstraße', '57', '80634', 'München', '', '0170/1644041', 'torben@volkwein.de', 1, '', 'Alexandra ', 'Braun '),
(63, '635011', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Ali', 'Yeniviaci', 'Heinrich-Wieland-Straße ', '73', '81735', 'München', '', '0152/55907065', 'gulumser.yeniavci@t-online.de', 1, '', 'Gülümser', 'Yeniavci'),
(64, '635015', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Jeremias', 'Giebel', 'Karl-Witthalm-Straße ', '34', '81375', 'München', '', '0151/23262352', 'sonjahuber1@gmx.net', 1, '', 'Sonja', 'Giebel'),
(66, '635029', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Ali', 'Cakil', 'Bahnhofstraße ', '11 a', '85774', 'Unterföhring', '', '0176/10042724', 'cakil_77@hotmail.de', 1, '', 'Meryem', 'Cakil'),
(67, '635033', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Tom', 'Willmann', 'Pognerstraße ', '30', '81379', 'München', '', '0178/5455905', 'tom.willmann@gmx.net', NULL, '', '', ''),
(68, '635053', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Ji', 'Xu', 'Weißenseestraße ', '124', '81539', 'München', '', '0176/6151818', 'xuji.china@gmail.com', 1, '', 'Dian', 'Yu'),
(69, '635032', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Srdjan ', 'Rankovic', 'Pronner Platz ', '2', '80687', 'München', '', '017278683860', 'user2@kanzlei-kerbl.de', NULL, '', '', ''),
(70, '635018', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Johann', 'Galster', 'Hansastraße ', '149', '81373', 'München', '', '0176/60907470', 'christina.galster@googlemail.com', 1, '', 'Christine', 'Galster'),
(71, '635027', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Milan', 'Svojgr', 'Bauernfeindstraße ', '11', '80939', 'München', '', '0176/61 12 2113', '19ms64@gmx.de', 1, '', 'Monika', 'Svojgrova'),
(72, '635036', NULL, NULL, NULL, NULL, NULL, 0, 1, '', 'Karolina', 'Helldobler', 'Katharina-Eberhard-Straße ', '10', '85540', 'Haar', '', '0176/43003982', 'karolina.helldobler@muenchen-mail.de', NULL, '', '', ''),
(73, '635055', NULL, NULL, NULL, NULL, NULL, 0, 0, 'Dr.', 'Matthias', 'Vogl', 'An der Burg ', '4', '85716', 'Unterschleißheim', '', '0176/61747270', 'mtvogl@gmail.de', 1, '', 'Anette', 'Rößle'),
(74, '635038', NULL, NULL, NULL, NULL, NULL, 0, 1, '', 'Andrea ', 'Yalta', 'Stöberlstraße ', '3', '80687', 'München', '', '0151/42464614', 'andreaausm@gmail.com', NULL, '', '', ''),
(75, '635025', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Huchen', 'Zhang', 'Goethestraße ', '142', '85055', 'Ingolstadt ', '', '0174/3236617', 'annali_china@web.de', 1, '', 'Yanqing', 'Li'),
(76, '635041', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Andreas ', 'Liebl', 'Am Kobel ', '4 a', '93128', 'Regenstauf', '', '0160/96932041', 'andreas-w.liebl@gmx.de', NULL, '', '', ''),
(77, '635049', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Markus Alexander', 'Reichert', 'Obere Beutau ', '42', '73728', 'Esslingen', '', '0170/7265295', 'markus@reichert.aero', NULL, '', '', ''),
(78, '635060', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Julien', 'Gillard', 'Friedenheimer Straße ', '150', '80686 ', 'München', '', '0162/6025284', 'juliengillard@gmail.com', 1, '', 'Valerie', 'Duesberg de la Morinerie'),
(79, '635022', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Ji', 'Li', 'Dammweg ', '82', '69123', 'Heidelberg', '', '0174/3118697', 'shufang.wang@gmx.de', NULL, '', '', ''),
(80, '635001', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Martin', 'Pfeifer', 'Schellingstraße ', '63', '80799', 'München', '', '0177/7687863', 'pfeifer_martin@gmx.de', 1, '', 'Alexandra', 'Schiedeck'),
(81, '635035', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Wolfgang', 'Hübl', 'Birkenstraße', '17', '80636', 'München', '', '0170/9652158', 'tinarauner@googlemail.com', 1, '', 'Tina', 'Rauner-Hübl'),
(82, '635130', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Johann', 'Baumgartner', 'Perlacher Straße ', '100', '81539', 'München', '', '01715-361710___', 'baum_ha@yahoo.de', NULL, '', '', ''),
(83, '635050', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Dongya', 'Yang', 'Allacher Straße ', '104', '80997', 'München', '', '0174/3118697', 'yangdongyade@gmail.com', 1, '', 'Jun', 'Cai'),
(84, '333001', NULL, NULL, NULL, NULL, NULL, 0, 0, '', 'Klaus', 'Mustermann', 'Musterstraße', '11', '22222', 'Hamburg', '', '0123456789', '', 1, '', 'Uschi', 'Mustermann');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--

CREATE TABLE IF NOT EXISTS `kunde` (
`id` int(10) unsigned NOT NULL,
  `debitor_nr` varchar(255) DEFAULT NULL,
  `anrede` tinyint(1) DEFAULT '0',
  `titel` varchar(255) DEFAULT NULL,
  `vorname` varchar(255) DEFAULT NULL,
  `nachname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `strasse` varchar(255) DEFAULT NULL,
  `hausnr` varchar(255) DEFAULT NULL,
  `plz` varchar(255) DEFAULT NULL,
  `ort` varchar(255) DEFAULT NULL,
  `festnetz` varchar(255) DEFAULT NULL,
  `handy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kunde`
--

INSERT INTO `kunde` (`id`, `debitor_nr`, `anrede`, `titel`, `vorname`, `nachname`, `email`, `strasse`, `hausnr`, `plz`, `ort`, `festnetz`, `handy`) VALUES
(1, '12300', 1, 'a', 'Test 1', 'mmm', 'emr@gmail.co', 'pupinweg', '6', '616161', 'darmstadt', '123456789', '987987987'),
(2, '12311', 1, 'b', 'Test 2', 'aaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '12344', 1, 'c', 'Test 3', 'sss', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '12399', 1, 'a', 'Test 99', 'mmm 99', 'emr99@gmail.co', 'pupinweg99', '699', '61616199', 'darmstadt', NULL, NULL),
(6, '22233', 1, 'a', 'Test 233', 'mmm233', 'emr233@gmail.co', 'pupinweg233', '233', '233', 'darmstadt', NULL, NULL),
(7, '', 0, '', '', '', '', '', '', '', '', NULL, NULL),
(8, '123456', 0, 'Dr', 'Karl', 'Mustermann', 'karl.muster@tlin.de', 'Muster Str.', '7', '80333', 'München', NULL, NULL),
(9, '635043', NULL, '', '', '', '', '', '', '', '', '', ''),
(10, '99999', 0, 'Dr', 'Karl', 'Mustermann', 'karl.muster@tlin.de', 'Muster Str.', '7', '80333', 'München', '', ''),
(11, '635045', NULL, '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nachlass`
--

CREATE TABLE IF NOT EXISTS `nachlass` (
`id` int(10) unsigned NOT NULL,
  `datenblatt_id` int(11) NOT NULL,
  `schreiben_vom` date DEFAULT NULL,
  `betrag` double DEFAULT NULL,
  `bemerkung` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projekt`
--

CREATE TABLE IF NOT EXISTS `projekt` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `firma_id` int(10) unsigned NOT NULL,
  `creator_user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `projekt`
--

INSERT INTO `projekt` (`id`, `name`, `firma_id`, `creator_user_id`) VALUES
(5, 'Parkcubes', 2, 1),
(6, 'Blanche83', 3, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projekt_user`
--

CREATE TABLE IF NOT EXISTS `projekt_user` (
  `projekt_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Project user assignments';

--
-- Daten für Tabelle `projekt_user`
--

INSERT INTO `projekt_user` (`projekt_id`, `user_id`) VALUES
(5, 12),
(5, 4),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(6, 10),
(6, 6),
(6, 18);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sonderwunsch`
--

CREATE TABLE IF NOT EXISTS `sonderwunsch` (
`id` int(10) unsigned NOT NULL,
  `datenblatt_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `angebot_datum` date DEFAULT NULL,
  `angebot_betrag` double DEFAULT NULL,
  `beauftragt_datum` date DEFAULT NULL,
  `beauftragt_betrag` double DEFAULT NULL,
  `rechnungsstellung_datum` date DEFAULT NULL,
  `rechnungsstellung_betrag` double DEFAULT NULL,
  `rechnungsstellung_rg_nr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `sonderwunsch`
--

INSERT INTO `sonderwunsch` (`id`, `datenblatt_id`, `name`, `angebot_datum`, `angebot_betrag`, `beauftragt_datum`, `beauftragt_betrag`, `rechnungsstellung_datum`, `rechnungsstellung_betrag`, `rechnungsstellung_rg_nr`) VALUES
(1, 36, '', '2016-06-20', 0, '2016-06-20', 2044.7, NULL, 2044.7, ''),
(2, 117, '', '2016-07-06', 318.55, '2016-07-08', 318.55, NULL, 318.55, ''),
(3, 117, '', '2016-06-21', 4467.75, '2016-07-04', 4467.75, NULL, 4467.75, ''),
(4, 116, 'SoWu 1', '2016-06-20', 2222.95, '2016-06-24', 2222.95, NULL, 2222.95, ''),
(5, 126, '', '2016-08-18', 7686.15, '2016-08-23', 7686.15, NULL, 7686.15, ''),
(6, 28, '', '2016-07-06', 3185.5, '2016-07-11', 3185.5, NULL, 3185.5, '3185,50'),
(7, 30, '', '2016-07-06', 4048, '2016-07-10', 4048, NULL, NULL, '4.048,00'),
(8, 43, '', '2016-06-29', 3298.2, '2016-07-01', 3298.2, NULL, 3298.2, ''),
(9, 35, '', '2016-06-27', 611.65, '2016-06-29', 611.65, NULL, 611.65, ''),
(10, 57, '', '2016-06-20', 829.15, '2016-07-06', 829.15, NULL, 829.15, ''),
(11, 103, '', '2016-08-01', 1934.3, '2016-08-04', 1934.3, NULL, 1934.3, ''),
(12, 41, '', '2016-06-27', 7475, '2016-07-12', 7475, NULL, 7475, ''),
(15, 121, '', '2016-06-21', 4531, '2016-08-09', 4531, NULL, 4531, ''),
(16, 92, '', '2016-08-12', 5131.3, '2016-08-16', 5131.3, NULL, 5131.3, ''),
(17, 60, '', '2016-07-28', 1423.7, '2016-08-10', 1423.7, NULL, 1423.7, ''),
(19, 114, '', '2016-08-18', 4594.25, '2016-08-18', 4594.25, NULL, 4594.25, ''),
(20, 114, '', NULL, NULL, NULL, NULL, NULL, NULL, ''),
(21, 79, '', '2016-08-05', 3382.15, '2016-08-25', 3382.15, NULL, 3382.15, ''),
(22, 41, '', '2016-09-01', 446.2, '2016-09-23', 446.2, NULL, 446.2, ''),
(23, 46, '', '2016-08-24', 10269.5, '2016-08-29', 10269.5, NULL, 10269.5, ''),
(24, 46, '', '2016-09-02', 960.25, '2016-09-02', 960.25, NULL, 960.25, ''),
(25, 33, '', '2016-09-05', 3265.4, '2016-09-05', 3265.4, NULL, 3265.4, ''),
(26, 97, '', '2016-10-11', 3008.4, '2016-10-12', 3008.4, NULL, 3008.4, ''),
(27, 40, '', '2016-08-30', 14749.85, '2016-09-13', 14749.85, NULL, 14749.85, ''),
(28, 105, '', '2016-06-02', 19937.55, '2016-06-05', 19937.55, NULL, 19937.55, ''),
(29, 107, '', '2016-09-08', 4595.55, '2016-09-15', 4595.55, NULL, 4595.55, ''),
(30, 108, '', '2016-08-29', 3266, '2016-08-30', 3266, NULL, 3266, ''),
(31, 49, '', '2016-10-11', 6815.9, '2016-10-19', 6815.9, NULL, 6815.9, ''),
(32, 99, '', '2016-10-05', 8727.3, '2016-10-06', 8727.3, NULL, 8727.3, ''),
(33, 59, '', '2016-07-28', 1423.7, '2016-08-10', 1423.7, NULL, 1423.7, ''),
(34, 93, '', '2016-09-27', 6318.6, '2016-10-05', 6318.6, NULL, 6318.6, ''),
(35, 113, '', '2016-08-01', 2923.3, '2016-08-08', 2923.3, NULL, 2923.3, ''),
(36, 12, '', '2016-07-20', 3736.35, '2016-07-25', 3736.35, NULL, 3736.35, ''),
(37, 12, '', '2016-08-01', 267.95, '2016-08-02', 267.95, NULL, 267.95, ''),
(38, 128, '', '2016-09-21', 4863.15, '2016-09-23', 4863.15, NULL, 4863.15, ''),
(39, 62, '', '2016-09-20', 1347.5, '2016-10-05', 1347.5, NULL, 1347.5, ''),
(40, 54, '', '2016-09-26', 9290.7, '2016-10-05', 9290.7, NULL, 9290.7, ''),
(41, 98, '', '2016-09-02', 8878.35, '2016-09-06', 8878.35, NULL, 8878.35, ''),
(42, 31, '', '2016-08-31', 4896.65, '2016-09-09', 4896.65, NULL, 4896.65, ''),
(43, 119, '', '2016-10-18', 3446.55, '2016-10-18', 3446.55, NULL, 3446.55, ''),
(45, 50, '', '2016-10-12', 4536.75, '2016-10-12', 4536.75, NULL, 4536.75, ''),
(46, 44, '', '2016-09-19', 6676.5, '2016-09-23', 6676.5, NULL, 6676.5, ''),
(47, 34, '', '2016-08-29', 2350.6, '2016-09-26', 2350.6, NULL, 2350.6, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_dynagrid`
--

CREATE TABLE IF NOT EXISTS `tbl_dynagrid` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid setting identifier',
  `filter_id` varchar(100) DEFAULT NULL COMMENT 'Filter setting identifier',
  `sort_id` varchar(100) DEFAULT NULL COMMENT 'Sort setting identifier',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid configuration'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Dynagrid personalization configuration settings';

--
-- Daten für Tabelle `tbl_dynagrid`
--

INSERT INTO `tbl_dynagrid` (`id`, `filter_id`, `sort_id`, `data`) VALUES
('dynagrid-datenblatt_4', NULL, NULL, '{"page":"10","theme":"panel-primary","keys":["a8a7a518","b3d070bf","eda801a7","8bc8cab9","0e6c3687","e5911466","d5bd1133","2e82bee6","8bd4df70","536fa8e1","a232a6ff","d6d1f1da","e0cba64d","19e34057","9c42a938","25b97e90","e82123c4","bccfd67a","dcf4ead2","ae0a7e3d","5ab0589f","5ab0589f_1","bd7c785b","c2ea0ba8","c91ff2a7","db6f46fa","da171cd5","94b5c912","9b7eafd8","9b7eafd8_1","cf9d7786","9fdbd8bf","bbfefd7a","6121cba2","d79d34a3","b9c236c2","b4412caf","124e301d","bc0fae34","10c752dc","1d03ca42","6619ea2d","dca39f78","712e0040","a9f57b4b","29180dfa","dfb48817","a5e7d297","468164f0","f52de7d8","bb1aa212","d2c33c2b","7d3975ba","077d6aa4","0225f59a","a83473b8","76a12567","49bcb2d4","e9bdd984","80531a3f","06dbf16d","730305fb","b035c28e","f5857dbe","d6f2bd6b","d53e0335","3f8c80b8","67800935","e62f5978","ef81b41a","66049bb2","12566eb4","3606157e","a1406c6a","8d9cb7ac","3a310733","467cc174","9bffdb45","d414aca6","4fe760b2","96558d72","7b7e4b6c","c4fc0ee9","523f22f9","067db594","6ea72976","7b6b4a62"],"filter":"","sort":""}'),
('dynagrid-datenblatt_6', NULL, NULL, '{"page":"10","theme":"panel-primary","keys":["d6d1f1da","e82123c4","c91ff2a7","6121cba2","8bd4df70","10c752dc","536fa8e1","124e301d","bc0fae34","712e0040","a9f57b4b","29180dfa","dfb48817","4191b72c","7b6b4a62"],"filter":"","sort":""}');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_dynagrid_dtl`
--

CREATE TABLE IF NOT EXISTS `tbl_dynagrid_dtl` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid detail setting identifier',
  `category` varchar(10) NOT NULL COMMENT 'Dynagrid detail setting category "filter" or "sort"',
  `name` varchar(150) NOT NULL COMMENT 'Name to identify the dynagrid detail setting',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid detail configuration',
  `dynagrid_id` varchar(100) NOT NULL COMMENT 'Related dynagrid identifier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Dynagrid detail configuration settings';

--
-- Daten für Tabelle `tbl_dynagrid_dtl`
--

INSERT INTO `tbl_dynagrid_dtl` (`id`, `category`, `name`, `data`, `dynagrid_id`) VALUES
('dynagrid-datenblatt_filter_05102aa1_1', 'filter', 'Erweitert', '[]', 'dynagrid-datenblatt_1'),
('dynagrid-datenblatt_sort_943d49dd_6', 'sort', '1. TE-Nummer', '[]', 'dynagrid-datenblatt_6'),
('dynagrid-datenblatt_sort_d4344ba8_6', 'sort', 'Serienbrief Abschlag1', '{"te_nummer":4}', 'dynagrid-datenblatt_6');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teileigentumseinheit`
--

CREATE TABLE IF NOT EXISTS `teileigentumseinheit` (
`id` int(10) unsigned NOT NULL,
  `haus_id` int(10) unsigned NOT NULL,
  `einheitstyp_id` int(10) unsigned NOT NULL,
  `te_nummer` varchar(255) DEFAULT NULL,
  `gefoerdert` tinyint(1) NOT NULL DEFAULT '0',
  `geschoss` varchar(45) DEFAULT NULL,
  `zimmer` varchar(45) DEFAULT NULL,
  `me_anteil` varchar(45) DEFAULT NULL,
  `wohnflaeche` varchar(45) DEFAULT NULL,
  `kaufpreis` float DEFAULT NULL,
  `kp_einheit` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `teileigentumseinheit`
--

INSERT INTO `teileigentumseinheit` (`id`, `haus_id`, `einheitstyp_id`, `te_nummer`, `gefoerdert`, `geschoss`, `zimmer`, `me_anteil`, `wohnflaeche`, `kaufpreis`, `kp_einheit`) VALUES
(37, 11, 1, '10', 0, '2 OG', '3', '12,60', '79,13', 545000, 6898.73),
(38, 12, 1, '1', 1, 'EG', '4', '16,76', '105,30', 342225, 3259.29),
(43, 14, 1, '3', 1, 'EG', '3', '16,50', '103,62', 336765, 0),
(44, 16, 1, '8', 0, '2 OG ', '4', '17,19', '107,97', 729000, 6813.08),
(45, 17, 1, '5', 0, '1 OG', '2', '9,39', '58,96', 405000, 6879.31),
(46, 18, 1, '4', 1, '1 OG ', '4', '16,75', '105,18', 341835, 3255.57),
(47, 19, 1, '6', 0, '1 OG', '3', '13,09', '82,25', 556000, 6780.49),
(48, 8, 1, '2', 0, 'EG', '1', '6,10', '38,34', 259000, 0),
(49, 15, 1, '7', 1, '1 OG', '3', '13,99', '87,86', 285545, 3282.13),
(50, 20, 1, '9', 0, '2 OG', '2', '9,21', '57,88', 408000, 7157.89),
(51, 21, 1, '11', 1, '2 OG', '3', '14,01', '87,99', 285968, 3286.99),
(52, 23, 1, '12', 0, '3 OG', '4', '17,19', '107,97', 743000, 6943.93),
(53, 24, 1, '13', 0, '3 OG', '2', '9,21', '57,83', 412000, 7228.07),
(54, 25, 1, '14', 0, '3 OG', '3', '12,60', '79,13', 553000, 0),
(55, 22, 1, '15', 1, '3 OG', '3', '13,99', '87,86', 285545, 0),
(56, 26, 1, '16', 0, 'DG', '4', '19,15', '120,31', 883500, 7325),
(57, 27, 1, '17', 0, 'DG', '4', '22,96', '144,14', 1055000, 0),
(58, 28, 1, '18', 1, 'EG ', '3', '14,11', '88,63', 288048, 0),
(59, 29, 1, '19', 0, 'EG', '1', '8,77', '55,08', 374000, 6800),
(60, 30, 1, '20', 0, 'EG', '1', '7,59', '47,68', 329000, 7000),
(61, 31, 1, '21', 1, '1 OG', '4', '16,97', '106,59', 346418, 0),
(62, 32, 1, '22', 0, '1 OG', '3', '15,43', '96,90', 658000, 0),
(63, 33, 1, '23', 1, '1 OG ', '3', '12,58', '79,02', 256815, 3250.82),
(64, 34, 1, '28', 0, '3 OG', '3', '14,95', '93,91', 648000, 6967.74),
(65, 36, 1, '24', 1, '2 OG', '4', '16,96', '106,52', 346190, 0),
(66, 37, 1, '25', 0, '2 OG', '3', '15,10', '94,82', 654000, 0),
(67, 38, 1, '26', 1, '2 OG', '3', '12,56', '78,92', 256490, 0),
(68, 39, 1, '27', 0, '3 OG', '4', '17,47', '109,71', 745000, 6834.86),
(69, 35, 1, '29', 1, '3 OG', '3', '12,58', '79,02', 256815, 3250.82),
(70, 40, 1, '30', 0, '4 OG ', '4', '17,47', '109,71 ', 759000, 0),
(71, 41, 1, '31', 0, '4 OG', '3', '14,40', '90,45', 629000, 6988.89),
(72, 42, 1, '32', 1, '4 OG', '3', '12,56', '78,92', 256490, 0),
(73, 43, 1, '33', 0, 'DG', '4', '17,09', '107,36', 775000, 0),
(74, 45, 1, '34', 0, 'DG', '3', '19,52', '122,60', 894000, 0),
(75, 46, 1, '35', 0, 'EG', '4', '18,04', '113,32', 749000, 6628.32),
(76, 47, 1, '36', 0, 'EG', '2', '9,63', '60,50', 420000, 0),
(77, 48, 1, '37', 0, 'EG', '1', '6,38', '40,06', 275000, 6875),
(79, 50, 1, '38', 1, 'EG', '3', '12,88', '80,93', 263023, 0),
(80, 51, 1, '39', 1, '1 OG', '4', '17,45', '109,62', 727000, 0),
(82, 54, 1, '40', 0, '1 OG', '2', '9,48', '59,56', 405000, 0),
(85, 57, 1, '41', 0, '1 OG', '2', '8,60', '54,03', 369000, 0),
(86, 58, 1, '42', 1, '1 OG', '3', '12,80', '80,40', 261300, 0),
(87, 59, 1, '43', 0, '2. OG', '4', '17,49', '109,89', 739000, 0),
(88, 60, 1, '44', 0, '2 OG', '2', '9,13', '57,32', 399000, 0),
(89, 61, 1, '45', 0, '2 OG', '2', '8,60', '54,03', 379000, 7018.52),
(90, 62, 1, '46', 1, '2 OG', '3', '12,80', '80,39', 261268, 3265.85),
(91, 63, 1, '47', 0, '3 OG', '4', '17,05', '107,12', 737000, 0),
(92, 64, 1, '48', 0, ' OG', '2', '9,63', '60,48', 427000, 0),
(93, 65, 1, '49', 0, '3 OG', '2', '8,26', '51,88', 369000, 0),
(94, 66, 1, '50', 0, '3 OG', '50', '13,18', '82,79', 569000, 0),
(95, 67, 1, '51', 0, 'DG ', '3', '19,28', '121,12', 885000, 0),
(96, 68, 1, '52', 0, 'DG', '4', '16,95', '119,89', 785000, 7311.32),
(98, 70, 1, '53', 0, 'EG', '4', '18,57', '116,65', 775000, 6681.03),
(99, 71, 1, '54', 0, 'EG', '3', '15,70', '98,61', 659000, 0),
(100, 73, 1, '55', 0, 'EG', '3', '13,46', '84,53', 567000, 0),
(101, 74, 1, '56', 0, '1 OG', '4', '18,30', '114,95', 749000, 6570.18),
(102, 76, 1, '57', 0, '1 OG', '3', '14,87', '93,42', 628000, 6752.69),
(103, 77, 1, '58', 0, '1 OG', '3', '13,86', '87,06', 587000, 0),
(104, 78, 1, '59', 0, '2 OG', '4', '18,43', '115,79', 779000, 6773.91),
(105, 79, 1, '60', 0, '2', '3', '14,31', '89,87', 633000, 7000),
(106, 80, 1, '61', 0, '2 OG', '3', '13,86', '87,06', 604000, 0),
(107, 81, 1, '62', 0, 'DG', '3', '17,75', '111,50', 827000, 0),
(108, 82, 1, '63', 0, 'DG', '3', '20,76', '130,43', 967000, 0),
(119, 59, 2, '104', 0, '', '', '1,5', '', 28000, NULL),
(120, 61, 2, '110', 0, '', '', '1,5', '', 28000, NULL),
(121, 82, 2, '75', 0, '', '', '1,5', '', 28000, NULL),
(122, 82, 2, '76', 0, '', '', '1,5', '', 28000, NULL),
(123, 48, 2, '85', 0, '', '', '1,5', '', 28000, NULL),
(124, 45, 2, '111', 0, '', '', '1,5', '', 28000, NULL),
(125, 20, 2, '89', 0, '', '', '1,5', '', 28000, NULL),
(126, 60, 2, '95', 0, '', '', '1,5', '', 28000, NULL),
(127, 27, 2, '86', 0, '', '', '1,5', '', 28000, NULL),
(128, 74, 2, '80', 0, '', '', '1,5', '', 28000, NULL),
(129, 77, 2, '74', 0, '', '', '1,5', '', 28000, NULL),
(130, 57, 2, '81', 0, '', '', '', '1,5', 28000, NULL),
(132, 81, 2, '83', 0, '', '', '1,5', '', 28000, NULL),
(133, 81, 2, '84', 0, '', '', '1,5', '', 28000, NULL),
(134, 16, 2, '125', 0, '', '', '1,5', '', 28000, NULL),
(135, 25, 2, '90', 0, '', '', '1,5', '', 28000, NULL),
(136, 54, 2, '101', 0, '', '', '1,5', '', 28000, NULL),
(137, 65, 2, '100', 0, '', '', '1,5', '', 28000, NULL),
(138, 11, 2, '70', 0, '', '', '1,5', '', 28000, NULL),
(140, 41, 2, '93', 0, '', '', '1,5', '', 28000, NULL),
(141, 64, 2, '94', 0, '', '', '1,5', '', 28000, NULL),
(142, 67, 2, '117', 0, '', '', '1,5', '', 28000, NULL),
(143, 63, 2, '92', 0, '', '', '1,5', '', 28000, NULL),
(144, 24, 2, '123', 0, '', '', '1,5', '', 28000, NULL),
(146, 26, 2, '121', 0, '', '', '1,5', '', 28000, NULL),
(147, 26, 2, '122', 0, '', '', '1,5', '', 28000, NULL),
(155, 68, 2, '102', 0, '', '', '1,5', '', 28000, NULL),
(156, 68, 3, '127', 0, '', '', '2,99', '', 20800, NULL),
(159, 8, 2, '124', 0, '', '', '1,5', '', 24000, NULL),
(160, 31, 2, '105', 1, '', '', '1,5', '', 28000, NULL),
(162, 14, 2, '88', 1, '', '', '1,5', '', 28000, NULL),
(163, 17, 2, '87', 0, '', '', '1,5', '', 28000, NULL),
(164, 29, 2, '114', 0, '', '', '1,5', '', 28000, NULL),
(165, 18, 2, '64', 1, '', '', '1,5', '', 28000, NULL),
(166, 51, 2, '96', 1, '', '', '1,5', '', 28000, NULL),
(167, 76, 2, '77', 0, '', '', '1,5', '', 28000, NULL),
(168, 34, 2, '106', 0, '', '', '1,5', '', 28000, NULL),
(169, 80, 2, '71', 0, '', '', '1,5', '', 28000, NULL),
(171, 78, 2, '68', 0, '', '', '1,5', '', 28000, NULL),
(172, 78, 2, '69', 0, '', '', '1,5', '', 28000, NULL),
(173, 78, 6, '132', 0, '', '', '15,4', '', 13000, NULL),
(174, 40, 2, '120', 0, '', '', '1,5', '', 28000, NULL),
(175, 46, 2, '79', 0, '', '', '1,5', '', 28000, NULL),
(176, 58, 2, '97', 0, '', '', '1,5', '', 28000, NULL),
(177, 71, 2, '72', 0, '', '', '1,5', '', 28000, NULL),
(178, 71, 6, '131', 0, '', '', '11,68', '', 10000, NULL),
(179, 36, 2, '116', 0, '', '', '1,5', '', 28000, NULL),
(180, 23, 2, '91', 0, '', '', '1,5', '', 28000, NULL),
(181, 23, 6, '129', 0, '', '', '8,41', '', 7000, NULL),
(182, 30, 2, '113', 0, '', '', '1,5', '', 28000, NULL),
(183, 19, 2, '66', 0, '', '', '1,5', '', 28000, NULL),
(184, 19, 6, '128', 0, '', '', '14,62', '', 12000, NULL),
(185, 70, 2, '82', 0, '', '', '1,5', '', 28000, NULL),
(186, 22, 2, '67', 1, '', '', '1,5', '', 28000, NULL),
(187, 21, 2, '65', 0, '', '', '1,5', '', 28000, NULL),
(188, 50, 2, '98', 0, '', '', '1,5', '', 28000, NULL),
(189, 35, 2, '109', 0, '', '', '1,5', '', 28000, NULL),
(190, 43, 2, '118', 0, '', '', '1,5', '', 25000, NULL),
(191, 28, 2, '108', 0, '', '', '1,5', '', 28000, NULL),
(192, 42, 2, '107', 0, '', '', '1,5', '', 28000, NULL),
(193, 39, 2, '112', 0, '', '', '', '1,5', 28000, NULL),
(194, 47, 2, '103', 0, '', '', '1,5', '', 28000, NULL),
(195, 73, 2, '78', 0, '', '', '1,5', '', 28000, NULL),
(196, 37, 2, '119', 0, '', '', '1,5', '', 28000, NULL),
(197, 79, 2, '73', 0, '', '', '1,5', '', 28000, NULL),
(198, 32, 2, '115', 0, '', '', '1,5', '', 28000, NULL),
(199, 12, 2, '126', 1, '', '', '1,5', '', 28000, NULL),
(200, 66, 2, '99', 0, '', '', '1,5', '', 28000, NULL),
(209, 101, 2, '130', 0, '', '', '1,5', '', 14000, NULL),
(212, 104, 1, '634101', 0, 'EG', '3', '', '', NULL, NULL),
(213, 105, 1, '634102', 0, 'EG', '3', '', '', NULL, NULL),
(217, 107, 1, '634103', 0, '1. OG', '3', '', '', NULL, NULL),
(218, 108, 1, '634104', 0, '1. OG', '3', '', '', NULL, NULL),
(219, 109, 1, '634105', 0, '2. OG', '4', '', '', NULL, NULL),
(220, 110, 1, '634201', 0, 'EG', '4', '', '', NULL, NULL),
(221, 111, 1, '634202', 0, 'EG', '4', '', '', NULL, NULL),
(222, 112, 1, '634203', 0, '1. OG', '4', '', '', NULL, NULL),
(223, 113, 1, '634204', 0, '1. OG', '4', '', '', NULL, NULL),
(224, 114, 1, '634205', 0, '2. OG', '5', '', '', NULL, NULL),
(225, 115, 1, '634301', 0, 'EG', '3', '', '', NULL, NULL),
(226, 116, 1, '634302', 0, 'EG', '2', '', '', NULL, NULL),
(227, 117, 1, '634303', 0, 'EG', '4', '', '', NULL, NULL),
(228, 118, 1, '634304', 0, '1. OG', '3', '', '', NULL, NULL),
(229, 119, 1, '634305', 0, '1. OG', '2', '', '', NULL, NULL),
(231, 121, 1, '634306', 0, '1. OG', '4', '', '', NULL, NULL),
(232, 122, 1, '634307', 0, '2. OG', '5', '', '', NULL, NULL),
(233, 123, 1, '634401', 0, 'EG', '5', '', '', NULL, NULL),
(234, 124, 1, '634402', 0, 'EG', '2', '', '', NULL, NULL),
(235, 125, 1, '634403', 0, 'EG', '4', '', '', NULL, NULL),
(236, 126, 1, '634404', 0, '1. OG', '3', '', '', NULL, NULL),
(237, 127, 1, '634405', 0, '1. OG', '2', '', '', NULL, NULL),
(238, 128, 1, '634406', 0, '1. OG', '4', '', '', NULL, NULL),
(239, 129, 1, '634407', 0, '2. OG', '5', '', '', NULL, NULL),
(240, 130, 2, 'P01', 0, 'TG', '', '', 'schmal', 30000, NULL),
(241, 131, 2, 'P02', 0, 'TG', '', '', 'schmal', 30000, NULL),
(242, 132, 2, 'P03', 0, 'TG', '', '', 'schmal', 30000, NULL),
(243, 133, 2, 'P04', 0, 'TG', '', '', 'schmal', 30000, NULL),
(244, 134, 2, 'P05', 0, 'TG', '', '', 'schmal', 30000, NULL),
(245, 135, 1, '', 0, '', '', '', '', 30000, NULL),
(259, 141, 2, 'P06', 0, 'TG', '', '', 'schmal', 30000, NULL),
(260, 142, 2, 'P07', 0, 'TG', '', '', 'schmal', 30000, NULL),
(261, 143, 2, 'P08', 0, 'TG', '', '', 'breit', 37500, NULL),
(262, 144, 2, 'P09', 0, 'TG', '', '', 'breit', 37500, NULL),
(263, 145, 2, 'P10', 0, 'TG', '', '', 'breit', 37500, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
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
  `email_confirmed` smallint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `confirmation_token`, `status`, `superadmin`, `created_at`, `updated_at`, `registration_ip`, `bind_to_ip`, `email`, `email_confirmed`) VALUES
(1, 'superadmin', 'Bc4mLXv91briehYdYqXzVoDPpBk7ToGh', '$2y$13$QAfJ0ezYIX1zOBICPngCBOdtPIlhdncjfXNp6OpihQbKTAfZvsR7O', NULL, 1, 1, 1467393898, 1471334658, NULL, '', NULL, 0),
(4, 'naglic', '1Rk4h1efzS5Kw30lkGGgiT7zl4axEXAt', '$2y$13$QDKlRcJp1uKvZlBK.MdpGubr5F1OYqK/Q6QqeHEiE3GCDml/2x7xa', NULL, 1, 0, 1470084565, 1479201206, '127.0.0.1', '', 'naglic@abg.local', 1),
(5, 'biebel', 'NWa2AkOM3F3c7GGTnFfcOU_INbLCO3QT', '$2y$13$Xk/gsXfkfClFAbFTOjbFS.I9wQvSMbb/aZTwwrmwnvU1372Ifirci', NULL, 1, 0, 1470084597, 1470700281, '127.0.0.1', '', 'biebel@abg.local', 1),
(6, 'schmautzer', '0ADpz2rSyV5CrM8w0WJVFjjVdST2u4Uq', '$2y$13$EoMpU40.4718IpFjMkiLwO6ynonbxcGRpAur4SOzidCbTX55d95fi', NULL, 1, 0, 1470084701, 1471330278, '127.0.0.1', '', 'schmautzer@abg.local', 1),
(7, 'kresin', 't7lROCUOaedggY0k2GUxGLKh8zQ6dat9', '$2y$13$YyHHqiLuuKdxyvs9MiYIKejjfPbKzmhMmtPlRdguyR1/te.zSnZ2C', NULL, 1, 0, 1470084741, 1470700249, '127.0.0.1', '', 'kresin@abg.local', 1),
(8, 'bollinger', 'QWHSgGiQWzpzHEXUBIhIbY1AT4EU1SEB', '$2y$13$JrjBgwr61P/BHtnyOU5nkey9NjB7nkabBM4RbfYp2wVCoLGu1tdDS', NULL, 1, 0, 1470084828, 1470700230, '127.0.0.1', '', 'bollinger@abg.local', 1),
(9, 'oppermann', 'h-vYAfG4Hg33Ij37nRcf0YILbuAFxHSU', '$2y$13$a7HVdTyPpQl4jbGAHZk1YOrPaUv7BPKb52qjq5cVvT1pcTm/927GO', NULL, 1, 0, 1470084874, 1470700212, '127.0.0.1', '', 'oppermann@abg.local', 1),
(10, 'vertrieb_extern', 'TXU7GpXMCr5x0znwu25RVNCH9d-NZhNN', '$2y$13$ctfLInyf6YurIiuG5A2XT.HFUxiSnov4FJl1qZ.rViQ5Fyhd2qYfS', NULL, 1, 0, 1470084924, 1471331729, '127.0.0.1', '', 'vertrieb_extern@abg.local', 1),
(12, 'scheffer', '8N4A82pLP-YK9deYFrOXIQ6weuIrH5sH', '$2y$13$lqUR73nsT9r39AhLp2IJ9OiWwXgVbW.0bIqzcMmXN8WLHEOIma7Yq', NULL, 1, 0, 1470700389, 1470701015, '192.168.17.5', '', 'scheffer@abg.local', 1),
(13, 'stephan', 'ZAaEJsFP_HRy_iZ33Ad_rWQT38sQFKdn', '$2y$13$NlDeHOu9d0NDLZD0n5keq.lfBGbT9A/jE16VA1pU0cmdNSyoepjeK', NULL, 1, 0, 1470703086, 1470703086, '192.168.17.5', '', 'stephan@abg.local', 1),
(14, 'repke', '1FfIXzFqMIyvHQOz3Ltk0tsoxzBs7Y8O', '$2y$13$CIL4w1igVxgZUbyBvWoeNONr4/hCpry0ytdpCAkGlsepLczlqf7D.', NULL, 1, 0, 1470703132, 1470703132, '192.168.17.5', '', 'repke@abg.local', 1),
(15, 'hübel', '52CvkujkpmSUXrc69YB7BwmFVMCEOI4L', '$2y$13$cEgLH4hpTVBPEZSi0HNBlOaSgkf1tugHm.EaYFitvWzxrVoj9hXnC', NULL, 1, 0, 1470703232, 1470703232, '192.168.17.5', '', 'huebel@abg.local', 1),
(16, 'Testuser', 'IIp5Z9LVfHlY4XvasxRTYohUpGiYCXFa', '$2y$13$.sK6ZCzwBQ93h94OaNStJuEIaKFeuYy2ZLa8eXm9pAqRb4/NuEmJO', NULL, 1, 0, 1471259523, 1475076538, '192.168.15.136', '', 'bakir@cpn-gmbh.de', 1),
(18, 'hilt', 'gEpeX1nihK-w9Jtd-wKVXINxH0mL3kYw', '$2y$13$X2HuP2x26qeicXm4cvRU1.mbw30cLqjZE2RJv0l7edscDTexkbxSO', NULL, 1, 0, 1471330513, 1471332582, '192.168.15.136', '', 'annett.hilt@abg-gruppe.de', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_visit_log`
--

CREATE TABLE IF NOT EXISTS `user_visit_log` (
`id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `language` char(2) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visit_time` int(11) NOT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user_visit_log`
--

INSERT INTO `user_visit_log` (`id`, `token`, `ip`, `language`, `user_agent`, `user_id`, `visit_time`, `browser`, `os`) VALUES
(1, '5776a9036349b', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36', 1, 1467394307, 'Chrome', 'Windows'),
(2, '5776ab0bb830d', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36', 1, 1467394827, 'Chrome', 'Windows'),
(3, '5776acb3aebae', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36', 1, 1467395251, 'Chrome', 'Windows'),
(4, '5776af8dabfbf', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36', 1, 1467395981, 'Chrome', 'Windows'),
(5, '5776bae3a0fe6', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0', NULL, 1467398883, 'Firefox', 'Windows'),
(6, '57793ade7f7aa', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36', 1, 1467562718, 'Chrome', 'Windows'),
(7, '5779492625e6c', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', NULL, 1467566374, 'Internet Explorer', 'Windows'),
(8, '577966ec263fa', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36', 1, 1467573996, 'Chrome', 'Windows'),
(9, '57797b60128ec', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0', NULL, 1467579232, 'Firefox', 'Windows'),
(10, '57797b7f0ce30', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0', NULL, 1467579263, 'Firefox', 'Windows'),
(11, '578549e4c9975', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', NULL, 1468352996, 'Firefox', 'Windows'),
(12, '578549ed7b57e', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', NULL, 1468353005, 'Firefox', 'Windows'),
(13, '57854a21d994a', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', NULL, 1468353057, 'Firefox', 'Windows'),
(14, '57854acbaae12', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', NULL, 1468353227, 'Firefox', 'Windows'),
(15, '57854ad64017e', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', NULL, 1468353238, 'Firefox', 'Windows'),
(16, '5785525a14283', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', NULL, 1468355162, 'Firefox', 'Windows'),
(17, '578554a9d1d12', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', NULL, 1468355753, 'Firefox', 'Windows'),
(18, '578554b4612bd', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', NULL, 1468355764, 'Firefox', 'Windows'),
(19, '578bd391a492a', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36', 1, 1468781457, 'Chrome', 'Windows'),
(20, '5793d41eb76a1', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', 1, 1469305886, 'Chrome', 'Windows'),
(21, '579c7ae5695cd', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', 1, 1469872869, 'Chrome', 'Windows'),
(22, '579ca32249cdd', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', NULL, 1469883170, 'Chrome', 'Windows'),
(23, '579ca701c879a', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 1, 1469884161, 'Firefox', 'Windows'),
(24, '579caa690064b', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', NULL, 1469885033, 'Firefox', 'Windows'),
(25, '579fb3f05392a', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 1, 1470084080, 'Firefox', 'Windows'),
(26, '579fb8e64b909', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', 9, 1470085350, 'Chrome', 'Windows'),
(27, '57a0dfe04fc76', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', NULL, 1470160864, 'Chrome', 'Windows'),
(28, '57a0dfee12ef9', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', 1, 1470160878, 'Chrome', 'Windows'),
(29, '57a0e4dc9f200', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 7, 1470162140, 'Firefox', 'Windows'),
(30, '57a1035c7d976', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 6, 1470169948, 'Firefox', 'Windows'),
(31, '57a90beea27e8', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 10, 1470696430, 'Firefox', 'Windows'),
(32, '57a90d55e1199', '127.0.0.1', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', NULL, 1470696789, 'Firefox', 'Windows'),
(33, '57a918d05d70c', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1, 1470699728, 'Chrome', 'Windows'),
(34, '57a926d55edef', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 14, 1470703317, 'Chrome', 'Windows'),
(35, '57a92ecb150ff', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1, 1470705355, 'Chrome', 'Windows'),
(36, '57a99e0b4617e', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 1, 1470733835, 'Firefox', 'Windows'),
(37, '57a9a0d2382cf', '192.168.8.60', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1, 1470734546, 'Internet Explorer', 'Windows'),
(38, '57a9b2e8804c4', '192.168.8.60', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1, 1470739176, 'Internet Explorer', 'Windows'),
(39, '57a9cdf951846', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 1, 1470746105, 'Firefox', 'Windows'),
(40, '57a9d4bd7f89d', '192.168.8.60', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1, 1470747837, 'Internet Explorer', 'Windows'),
(41, '57a9da0c08704', '192.168.8.60', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1, 1470749196, 'Internet Explorer', 'Windows'),
(42, '57aa39f2033e2', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1, 1470773746, 'Chrome', 'Windows'),
(43, '57aa4907b7f3a', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1, 1470777607, 'Chrome', 'Windows'),
(44, '57aadf46c1ed0', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1470816070, 'Edge', 'Windows'),
(45, '57aae04b5a786', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1470816331, 'Edge', 'Windows'),
(46, '57ab3105a3fcf', '192.168.8.57', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1, 1470836997, 'Internet Explorer', 'Windows'),
(47, '57ac3c2ae6ae1', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 1, 1470905386, 'Firefox', 'Windows'),
(48, '57ac422653657', '192.168.8.57', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1, 1470906918, 'Internet Explorer', 'Windows'),
(49, '57ac461ff1c07', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 1, 1470907935, 'Firefox', 'Windows'),
(50, '57ad81de62c75', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 1, 1470988766, 'Firefox', 'Windows'),
(51, '57adbbd3823a4', '192.168.8.51', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1, 1471003603, 'Internet Explorer', 'Windows'),
(52, '57b1a3204cded', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471259424, 'Edge', 'Windows'),
(53, '57b1a46927858', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 16, 1471259753, 'Edge', 'Windows'),
(54, '57b1a48b2e86a', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471259787, 'Edge', 'Windows'),
(55, '57b1a4cbb74ca', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 16, 1471259851, 'Edge', 'Windows'),
(56, '57b1a66940fae', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1, 1471260265, 'Chrome', 'Windows'),
(57, '57b1a740cffbf', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471260480, 'Edge', 'Windows'),
(58, '57b1bed6c639f', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 16, 1471266518, 'Edge', 'Windows'),
(59, '57b1bfc44db6c', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471266756, 'Edge', 'Windows'),
(60, '57b1c037844e2', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471266871, 'Edge', 'Windows'),
(61, '57b1c07369aa8', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', NULL, 1471266931, 'Edge', 'Windows'),
(62, '57b1c0cda39f4', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', NULL, 1471267021, 'Edge', 'Windows'),
(63, '57b1c0de11772', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471267038, 'Edge', 'Windows'),
(64, '57b1d0e786a43', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', NULL, 1471271143, 'Edge', 'Windows'),
(65, '57b2b765cea6a', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471330149, 'Edge', 'Windows'),
(66, '57b2bdb6e38b2', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 18, 1471331766, 'Edge', 'Windows'),
(67, '57b2bf795f1ee', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471332217, 'Edge', 'Windows'),
(68, '57b2c0abefea9', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471332523, 'Edge', 'Windows'),
(69, '57b2c0f07161e', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', 18, 1471332592, 'Firefox', 'Windows'),
(70, '57b2c51d3dfb6', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 6, 1471333661, 'Edge', 'Windows'),
(71, '57b2c59322b96', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 10, 1471333779, 'Edge', 'Windows'),
(72, '57b2c67c23254', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', 1, 1471334012, 'Firefox', 'Windows'),
(73, '57b2c78e8efe3', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471334286, 'Edge', 'Windows'),
(74, '57b2c972dbaa1', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', 1, 1471334770, 'Firefox', 'Windows'),
(75, '57b5869c195aa', '192.168.8.65', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1471514268, 'Internet Explorer', 'Windows'),
(76, '57ba1681b1f81', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1, 1471813249, 'Chrome', 'Windows'),
(77, '57bb147a8ee91', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 6, 1471878266, 'Firefox', 'Windows'),
(78, '57bbf1898aa3b', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', 6, 1471934857, 'Firefox', 'Windows'),
(79, '57bc182897397', '192.168.17.67', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1471944744, 'Edge', 'Windows'),
(80, '57bdf2ea439f5', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1, 1472066282, 'Chrome', 'Windows'),
(81, '57bed302e175a', '192.168.15.136', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1472123650, 'Edge', 'Windows'),
(82, '57c3f8abbef80', '192.168.8.51', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1472460971, 'Internet Explorer', 'Windows'),
(83, '57c53ee64bc78', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 6, 1472544486, 'Firefox', 'Windows'),
(84, '57c5502febd40', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 6, 1472548911, 'Firefox', 'Windows'),
(85, '57c830fd65df6', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 6, 1472737533, 'Firefox', 'Windows'),
(86, '57d900d1f1f47', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 6, 1473839313, 'Firefox', 'Windows'),
(87, '57d908be705e5', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 6, 1473841342, 'Firefox', 'Windows'),
(88, '57e2921f711ab', '192.168.17.68', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1474466335, 'Edge', 'Windows'),
(89, '57e526e9a2d8a', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 6, 1474635497, 'Firefox', 'Windows'),
(90, '57e529bde530c', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 6, 1474636221, 'Firefox', 'Windows'),
(91, '57ebdee4a0630', '192.168.17.68', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1475075812, 'Edge', 'Windows'),
(92, '57ebe196a5d0c', '192.168.17.68', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1475076502, 'Edge', 'Windows'),
(93, '57ebe20ead63e', '192.168.17.68', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 16, 1475076622, 'Edge', 'Windows'),
(94, '57ed2bdaa04ab', '192.168.17.68', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1475161050, 'Edge', 'Windows'),
(95, '57ed5d85326ac', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', 1, 1475173765, 'Chrome', 'Windows'),
(96, '57ee33c5848ca', '192.168.17.68', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1475228613, 'Edge', 'Windows'),
(97, '57ee3b144ad0c', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1475230484, 'Firefox', 'Windows'),
(98, '57f38c827aa16', '192.168.15.138', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1475579010, 'Edge', 'Windows'),
(99, '5800e45827799', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1476453464, 'Firefox', 'Windows'),
(100, '5808a963e37e3', '192.168.8.54', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1476962659, 'Internet Explorer', 'Windows'),
(101, '5808d151af4e2', '192.168.8.54', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1476972881, 'Internet Explorer', 'Windows'),
(102, '580f6fbfafd15', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1477406655, 'Firefox', 'Windows'),
(103, '581074dc77ad0', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1477473500, 'Firefox', 'Windows'),
(104, '5810a84636fb5', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1477486662, 'Firefox', 'Windows'),
(105, '581b37007e5fb', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478178560, 'Firefox', 'Windows'),
(106, '581b3a9f21d31', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478179487, 'Firefox', 'Windows'),
(107, '581b418fca60e', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478181263, 'Firefox', 'Windows'),
(108, '581b641d06509', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478190109, 'Firefox', 'Windows'),
(109, '581c3f1d4278d', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478246173, 'Firefox', 'Windows'),
(110, '581c537fc30ef', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478251391, 'Firefox', 'Windows'),
(111, '581c85321007b', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478264114, 'Firefox', 'Windows'),
(112, '581c8da052f6b', '192.168.8.50', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1478266272, 'Internet Explorer', 'Windows'),
(113, '581c937c3a9ff', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478267772, 'Firefox', 'Windows'),
(114, '5821d38beb566', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478611851, 'Firefox', 'Windows'),
(115, '5821d95c2d201', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478613340, 'Firefox', 'Windows'),
(116, '582232f3ddede', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1, 1478636275, 'Chrome', 'Windows'),
(117, '5822e29250864', '192.168.17.68', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1478681234, 'Edge', 'Windows'),
(118, '5822ff4b15bcc', '192.168.17.68', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1478688587, 'Edge', 'Windows'),
(119, '582302250d22b', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1, 1478689317, 'Chrome', 'Windows'),
(120, '582323f146f56', '192.168.17.68', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1478697969, 'Edge', 'Windows'),
(121, '58233fe6428aa', '192.168.17.68', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1478705126, 'Edge', 'Windows'),
(122, '5823949642566', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1, 1478726806, 'Chrome', 'Windows'),
(123, '5824373530f68', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478768437, 'Firefox', 'Windows'),
(124, '58243a73a3492', '192.168.15.138', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1478769267, 'Edge', 'Windows'),
(125, '582442e6c187c', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1, 1478771430, 'Chrome', 'Windows'),
(126, '5824462048a99', '192.168.15.138', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1478772256, 'Edge', 'Windows'),
(127, '582475a4ce83d', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478784420, 'Firefox', 'Windows'),
(128, '58247709b37ac', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478784777, 'Firefox', 'Windows'),
(129, '582580c850735', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1478852808, 'Firefox', 'Windows'),
(130, '58297ee1237b8', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479114465, 'Firefox', 'Windows'),
(131, '58299c50af9f5', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479122000, 'Firefox', 'Windows'),
(132, '5829ad93b305e', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479126419, 'Firefox', 'Windows'),
(133, '5829e60c07fbc', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479140876, 'Firefox', 'Windows'),
(134, '582aca55c68a9', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479199317, 'Firefox', 'Windows'),
(135, '582ad07b172c6', '172.19.4.40', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 6, 1479200891, 'Internet Explorer', 'Windows'),
(136, '582ad191408d0', '192.168.15.138', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1479201169, 'Edge', 'Windows'),
(137, '582ad1ff23488', '172.19.4.40', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 4, 1479201279, 'Internet Explorer', 'Windows'),
(138, '582af5587e362', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479210328, 'Firefox', 'Windows'),
(139, '582c2c10cb5f1', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479289872, 'Firefox', 'Windows'),
(140, '582c3bf830fe3', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479293944, 'Firefox', 'Windows'),
(141, '582c5592cb0c7', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479300498, 'Firefox', 'Windows'),
(142, '582cd330d9182', '192.168.17.5', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1, 1479332656, 'Chrome', 'Windows'),
(143, '582dbe97b43b9', '172.19.4.40', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 4, 1479392919, 'Internet Explorer', 'Windows'),
(144, '582dd05c951cb', '192.168.8.57', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1479397468, 'Internet Explorer', 'Windows'),
(145, '582ec54a1c975', '192.168.8.50', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1479460170, 'Internet Explorer', 'Windows'),
(146, '582ec5fc03350', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479460348, 'Firefox', 'Windows'),
(147, '582ec995267da', '192.168.8.74', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1479461269, 'Internet Explorer', 'Windows'),
(148, '582ed48f43eef', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', 6, 1479464079, 'Firefox', 'Windows'),
(149, '582ed53474396', '192.168.8.74', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1479464244, 'Internet Explorer', 'Windows'),
(150, '582ee1649d9dd', '192.168.15.138', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1479467364, 'Edge', 'Windows'),
(151, '582ee1a42c5dd', '192.168.8.50', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1479467428, 'Internet Explorer', 'Windows'),
(152, '582f097674e71', '192.168.8.50', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1479477622, 'Internet Explorer', 'Windows'),
(153, '58330c7a5a50d', '192.168.8.50', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1479740538, 'Internet Explorer', 'Windows'),
(154, '58331d0446ee2', '192.168.8.50', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1479744772, 'Internet Explorer', 'Windows'),
(155, '5834199319bd7', '192.168.15.138', 'de', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1, 1479809427, 'Edge', 'Windows'),
(156, '583472d7a3947', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', 6, 1479832279, 'Firefox', 'Windows'),
(157, '5835c323bc6c8', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', 6, 1479918371, 'Firefox', 'Windows'),
(158, '5838113141e48', '192.168.8.55', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1480069425, 'Internet Explorer', 'Windows'),
(159, '58383a6fadc07', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', 6, 1480079983, 'Firefox', 'Windows'),
(160, '58383d6667ae0', '192.168.8.55', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 18, 1480080742, 'Internet Explorer', 'Windows'),
(161, '5838427dc5fe1', '172.19.4.24', 'de', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', 6, 1480082045, 'Firefox', 'Windows');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zaehlerstand`
--

CREATE TABLE IF NOT EXISTS `zaehlerstand` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `nummer` varchar(45) DEFAULT NULL,
  `stand` varchar(45) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `haus_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `zaehlerstand`
--

INSERT INTO `zaehlerstand` (`id`, `name`, `nummer`, `stand`, `datum`, `haus_id`) VALUES
(26, '', '', '', NULL, 8),
(27, '', '', '', NULL, 12),
(28, '', '', '', NULL, 63),
(35, '', '', '', NULL, 30);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlung`
--

CREATE TABLE IF NOT EXISTS `zahlung` (
`id` int(10) unsigned NOT NULL,
  `datenblatt_id` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  `betrag` float DEFAULT '0',
  `bemerkung` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `abschlag`
--
ALTER TABLE `abschlag`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_abschlag_datenblatt1_idx` (`datenblatt_id`);

--
-- Indizes für die Tabelle `auth_assignment`
--
ALTER TABLE `auth_assignment`
 ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indizes für die Tabelle `auth_item`
--
ALTER TABLE `auth_item`
 ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `type` (`type`), ADD KEY `fk_auth_item_group_code` (`group_code`);

--
-- Indizes für die Tabelle `auth_item_child`
--
ALTER TABLE `auth_item_child`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indizes für die Tabelle `auth_item_group`
--
ALTER TABLE `auth_item_group`
 ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `auth_rule`
--
ALTER TABLE `auth_rule`
 ADD PRIMARY KEY (`name`);

--
-- Indizes für die Tabelle `datenblatt`
--
ALTER TABLE `datenblatt`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `fk_datenblatt_haus_idx` (`haus_id`), ADD KEY `fk_datenblatt_firma1_idx` (`firma_id`), ADD KEY `fk_datenblatt_projekt1_idx` (`projekt_id`), ADD KEY `fk_datenblatt_kaeufer1_idx` (`kaeufer_id`);

--
-- Indizes für die Tabelle `einheitstyp`
--
ALTER TABLE `einheitstyp`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `firma`
--
ALTER TABLE `firma`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `haus`
--
ALTER TABLE `haus`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_haus_projekt1_idx` (`projekt_id`), ADD KEY `fk_haus_firma1_idx` (`firma_id`);

--
-- Indizes für die Tabelle `kaeufer`
--
ALTER TABLE `kaeufer`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kunde`
--
ALTER TABLE `kunde`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `nachlass`
--
ALTER TABLE `nachlass`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_nachlass_datenblatt1_idx` (`datenblatt_id`);

--
-- Indizes für die Tabelle `projekt`
--
ALTER TABLE `projekt`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_projekt_firma1_idx` (`firma_id`);

--
-- Indizes für die Tabelle `sonderwunsch`
--
ALTER TABLE `sonderwunsch`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sonderwunch_datenblatt1_idx` (`datenblatt_id`);

--
-- Indizes für die Tabelle `tbl_dynagrid`
--
ALTER TABLE `tbl_dynagrid`
 ADD PRIMARY KEY (`id`), ADD KEY `tbl_dynagrid_FK1` (`filter_id`), ADD KEY `tbl_dynagrid_FK2` (`sort_id`);

--
-- Indizes für die Tabelle `tbl_dynagrid_dtl`
--
ALTER TABLE `tbl_dynagrid_dtl`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `tbl_dynagrid_dtl_UK1` (`name`,`category`,`dynagrid_id`);

--
-- Indizes für die Tabelle `teileigentumseinheit`
--
ALTER TABLE `teileigentumseinheit`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_teileigentumseinheit_haus1_idx` (`haus_id`), ADD KEY `fk_teileigentumseinheit_einheitstyp1_idx` (`einheitstyp_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_visit_log`
--
ALTER TABLE `user_visit_log`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `zaehlerstand`
--
ALTER TABLE `zaehlerstand`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_zaehlerstand_haus1_idx` (`haus_id`);

--
-- Indizes für die Tabelle `zahlung`
--
ALTER TABLE `zahlung`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_zahlung_datenblatt1_idx` (`datenblatt_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `abschlag`
--
ALTER TABLE `abschlag`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=875;
--
-- AUTO_INCREMENT für Tabelle `datenblatt`
--
ALTER TABLE `datenblatt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT für Tabelle `einheitstyp`
--
ALTER TABLE `einheitstyp`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `firma`
--
ALTER TABLE `firma`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `haus`
--
ALTER TABLE `haus`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT für Tabelle `kaeufer`
--
ALTER TABLE `kaeufer`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT für Tabelle `kunde`
--
ALTER TABLE `kunde`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT für Tabelle `nachlass`
--
ALTER TABLE `nachlass`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `projekt`
--
ALTER TABLE `projekt`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `sonderwunsch`
--
ALTER TABLE `sonderwunsch`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT für Tabelle `teileigentumseinheit`
--
ALTER TABLE `teileigentumseinheit`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=264;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT für Tabelle `user_visit_log`
--
ALTER TABLE `user_visit_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT für Tabelle `zaehlerstand`
--
ALTER TABLE `zaehlerstand`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT für Tabelle `zahlung`
--
ALTER TABLE `zahlung`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `abschlag`
--
ALTER TABLE `abschlag`
ADD CONSTRAINT `fk_abschlag_datenblatt1` FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `auth_assignment`
--
ALTER TABLE `auth_assignment`
ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `auth_item`
--
ALTER TABLE `auth_item`
ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `fk_auth_item_group_code` FOREIGN KEY (`group_code`) REFERENCES `auth_item_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `auth_item_child`
--
ALTER TABLE `auth_item_child`
ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `datenblatt`
--
ALTER TABLE `datenblatt`
ADD CONSTRAINT `fk_datenblatt_firma1` FOREIGN KEY (`firma_id`) REFERENCES `firma` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_datenblatt_haus` FOREIGN KEY (`haus_id`) REFERENCES `haus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_datenblatt_kaeufer1` FOREIGN KEY (`kaeufer_id`) REFERENCES `kaeufer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_datenblatt_projekt1` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `haus`
--
ALTER TABLE `haus`
ADD CONSTRAINT `fk_haus_firma1` FOREIGN KEY (`firma_id`) REFERENCES `firma` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_haus_projekt1` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `nachlass`
--
ALTER TABLE `nachlass`
ADD CONSTRAINT `fk_nachlass_datenblatt1` FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `projekt`
--
ALTER TABLE `projekt`
ADD CONSTRAINT `fk_projekt_firma1` FOREIGN KEY (`firma_id`) REFERENCES `firma` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `sonderwunsch`
--
ALTER TABLE `sonderwunsch`
ADD CONSTRAINT `fk_sonderwunch_datenblatt1` FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tbl_dynagrid`
--
ALTER TABLE `tbl_dynagrid`
ADD CONSTRAINT `tbl_dynagrid_FK1` FOREIGN KEY (`filter_id`) REFERENCES `tbl_dynagrid_dtl` (`id`),
ADD CONSTRAINT `tbl_dynagrid_FK2` FOREIGN KEY (`sort_id`) REFERENCES `tbl_dynagrid_dtl` (`id`);

--
-- Constraints der Tabelle `teileigentumseinheit`
--
ALTER TABLE `teileigentumseinheit`
ADD CONSTRAINT `fk_teileigentumseinheit_einheitstyp1` FOREIGN KEY (`einheitstyp_id`) REFERENCES `einheitstyp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_teileigentumseinheit_haus1` FOREIGN KEY (`haus_id`) REFERENCES `haus` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `user_visit_log`
--
ALTER TABLE `user_visit_log`
ADD CONSTRAINT `user_visit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `zaehlerstand`
--
ALTER TABLE `zaehlerstand`
ADD CONSTRAINT `fk_zaehlerstand_haus1` FOREIGN KEY (`haus_id`) REFERENCES `haus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `zahlung`
--
ALTER TABLE `zahlung`
ADD CONSTRAINT `fk_zahlung_datenblatt1` FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
