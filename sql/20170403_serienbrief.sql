ALTER TABLE `projekt`
  ADD COLUMN `mail_header` TEXT NULL DEFAULT NULL AFTER `hausnr`,
  ADD COLUMN `mail_footer` TEXT NULL DEFAULT NULL AFTER `mail_header`;

CREATE TABLE `vorlage` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `betreff` VARCHAR(512) NOT NULL,
  `text` TEXT NOT NULL,
  `deleted` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;

ALTER TABLE `abschlag`
  ADD COLUMN `vorlage_id` INT(11) NULL DEFAULT NULL AFTER `summe`;
ALTER TABLE `abschlag`
  ADD COLUMN `erstell_datum` DATE NULL DEFAULT NULL AFTER `vorlage_id`;

ALTER TABLE `abschlag`
  ADD CONSTRAINT `FK_abschlag_vorlage` FOREIGN KEY (`vorlage_id`) REFERENCES `vorlage` (`id`);

REPLACE INTO `vorlage` (`id`, `name`, `betreff`, `text`, `deleted`) VALUES (1, 'Test', 'Testvorlage Betreff', '<p><strong>Wohnbauprojekt &bdquo;[projekt-name]&ldquo; [projekt-strasse] in [projekt-ort] </strong><br /><strong>1. Zahlungsabruf sowie Leistungsstandmitteilung gem. Ziff. IV. des Kaufvertrages [wohnung-nr] </strong></p>\r\n<p>&nbsp;</p>\r\n<p>Sehr geehrte Damen und Herren, wir freuen uns, Ihnen mitteilen zu k&ouml;nnen, dass der Neubau der Wohnanlage in der [projekt-strasse] entsprechend der Zeitplanung erfolgreich voranschreitet. Die Best&auml;tigung &uuml;ber den Bautenstand k&ouml;nnen Sie der Anlage zu unserem Schreiben entnehmen.</p>\r\n<p>Ferner liegt Ihnen das Schreiben der Notarin Wilfart-Kammer vor, mit welchem die Notarin best&auml;tigt, dass die zur Rechtswirksamkeit und f&uuml;r den Vollzug des Kaufvertrages erforderlichen Genehmigungen vorliegen, die Auflassungsvormerkung zu Ihren Gunsten eingetragen worden ist und die Freistellungserkl&auml;rung der Deutschen Pfandbriefbank AG bereitliegt.</p>\r\n<p>Folglich sind die Voraussetzungen der F&auml;lligkeit f&uuml;r folgende Kaufpreisrate gem. Ziff. VI. des Kaufvertrages erf&uuml;llt:</p>\r\n<p style="text-align: center;">[kaufpreisabrechnung-kaufvertrag-in-prozent] nach Beginn der Erdarbeiten &euro; <br />[kaufpreisabrechnung-kaufvertrag-betrag]</p>\r\n<p>Wir d&uuml;rfen Sie daher bitten, die o. g. Zahlungsrate gem. Ziff. VI.3 des Kaufvertrages innerhalb von 12 Kalendertagen nach Zugang dieses Schreibens auf unser Konto bei der</p>\r\n<p style="padding-left: 30px;"><strong>Deutsche Pfandbriefbank AG </strong><br /><strong>BIC REBMDEMMXXX </strong><br /><strong>IBAN DE66 7001 0500 5520 0023 35 </strong></p>\r\n<p style="padding-left: 30px;"><strong>Empf&auml;nger: </strong><br /><strong>ABG Allgemeine Bautr&auml;gergesellschaft mbH &amp; Co. </strong><br /><strong>Objekt Max-Bill-Stra&szlig;e KG</strong></p>\r\n<p style="padding-left: 30px;"><strong>Verwendungszweck:</strong> 1. Zahlungsrate/Debitor Nr.: 635XXX</p>\r\n<p>zu &uuml;berweisen.</p>\r\n<p>&nbsp;</p>\r\n<p>Mit freundlichen Gr&uuml;&szlig;en</p>\r\n<p>&nbsp;</p>\r\n<p>ppa. Veit Oppermann &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; i. A. Patrizia Schmautzer</p>', NULL);
REPLACE INTO `vorlage` (`id`, `name`, `betreff`, `text`, `deleted`) VALUES (2, 'zweite vorlage', 'aaaaa', '<p>dfasdfasdfasdfasdf sadfas df asdf</p>', '2017-04-08 00:10:27');
