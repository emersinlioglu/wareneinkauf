ALTER TABLE `projekt`
  ADD COLUMN `mail_header` TEXT NULL DEFAULT NULL AFTER `hausnr`,
  ADD COLUMN `mail_footer` TEXT NULL DEFAULT NULL AFTER `mail_header`;

CREATE TABLE `mail_vorlage` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `betreff` VARCHAR(512) NOT NULL,
  `text` TEXT NOT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;

ALTER TABLE `abschlag`
  ADD COLUMN `mail_vorlage_id` INT(11) NULL DEFAULT NULL AFTER `summe`;
ALTER TABLE `abschlag`
  ADD COLUMN `mail_datum` DATE NULL DEFAULT NULL AFTER `mail_vorlage_id`;

ALTER TABLE `abschlag`
  ADD CONSTRAINT `FK_abschlag_mail_vorlage` FOREIGN KEY (`mail_vorlage_id`) REFERENCES `mail_vorlage` (`id`);

