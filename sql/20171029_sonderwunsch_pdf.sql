CREATE TABLE `vorlage_typ` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  AUTO_INCREMENT=3
;

REPLACE INTO `vorlage_typ` (`id`, `name`) VALUES (1, 'Abschlag');
REPLACE INTO `vorlage_typ` (`id`, `name`) VALUES (2, 'Sonderwunsch');

ALTER TABLE `vorlage`
  ADD COLUMN `vorlage_typ_id` INT UNSIGNED NULL DEFAULT NULL AFTER `deleted`,
  ADD CONSTRAINT `FK_vorlage_vorlage_typ` FOREIGN KEY (`vorlage_typ_id`) REFERENCES `vorlage_typ` (`id`) ON UPDATE CASCADE ON DELETE SET NULL;

UPDATE vorlage SET vorlage_typ_id = 1;

ALTER TABLE `vorlage`
  ALTER `vorlage_typ_id` DROP DEFAULT;
ALTER TABLE `vorlage`
  CHANGE COLUMN `vorlage_typ_id` `vorlage_typ_id` INT(10) UNSIGNED NULL AFTER `deleted`;

INSERT INTO `vorlage` (`name`, `betreff`, `text`, `deleted`, `vorlage_typ_id`) VALUES ('Sonderwunsch Vorlge 1', 'Sonderwunsch Betreff 1', '<p>Wohnbauprojekt &bdquo;Parkcubes&ldquo;, [projekt-strasse] in [projekt-ort]<br />Rechnung &uuml;ber Sonderw&uuml;nsche/Ausstattung, Ihre Wohnung Nr.: [wohnung-nr]<br />Debitoren Nr.: [debitor-nr]<br />Rechnung Nr.:&nbsp;[wohnung-nr]</p>\r\n<p>&nbsp;</p>\r\n<p>Sehr geehrte Damen und Herren,</p>\r\n<p>&nbsp;</p>\r\n<p>die von Ihnen schriftlich beauftragten Sonder- bzw. Ausstattungsw&uuml;nsche rechnen wir wie folgt ab:</p>\r\n<p>[sonderwuensche-zusammenfassung]</p>\r\n<p>&nbsp;</p>\r\n<p>Bitte beachten Sie, dass der Zahlungsbetrag erst von Ihnen zur Zahlung f&auml;llig ist, sobald wir Sie hierzu mit dem Abruf der 5. Zahlungsrate auffordern.</p>\r\n<p>&nbsp;</p>\r\n<p>Als Verwendungszweck geben Sie bitte dann die Debitoren Nr.:&nbsp;[debitor-nr]&nbsp;an.</p>\r\n<p>&nbsp;</p>\r\n<p>Mit freundlichen Gr&uuml;&szlig;en</p>', NULL, 2);
