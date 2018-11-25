CREATE TABLE `entschaedigung` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datenblatt_id` INT(11) NOT NULL,
  `datum` DATE NULL DEFAULT NULL,
  `betrag` FLOAT(10,2) NULL DEFAULT '0.00',
  `bemerkung` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  ROW_FORMAT=COMPACT
;


CREATE TABLE `protokoll` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `datenblatt_id` INT(11) NOT NULL,
  `erstellt_am` DATETIME NULL DEFAULT NULL,
  `bemerkung` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_protokoll_user` (`user_id`),
  INDEX `FK_protokoll_datenblatt` (`datenblatt_id`),
  CONSTRAINT `FK_protokoll_datenblatt` FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`),
  CONSTRAINT `FK_protokoll_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  ROW_FORMAT=COMPACT
;

ALTER TABLE `zaehlerstand`
  ADD COLUMN `teileigentumseinheit_id` INT UNSIGNED NULL AFTER `haus_id`,
  ADD CONSTRAINT `FK_zaehlerstand_teileigentumseinheit` FOREIGN KEY (`teileigentumseinheit_id`) REFERENCES `teileigentumseinheit` (`id`);

update zaehlerstand zs
set
  zs.teileigentumseinheit_id = (
    select t.id from teileigentumseinheit t
      inner join haus h on h.id = t.haus_id
    where
      h.id = zs.haus_id
    limit 0, 1
  )
;

ALTER TABLE `zaehlerstand`
  ALTER `haus_id` DROP DEFAULT;
ALTER TABLE `zaehlerstand`
  CHANGE COLUMN `haus_id` `haus_id` INT(10) UNSIGNED NULL AFTER `datum`;

ALTER TABLE `teileigentumseinheit`
  ADD COLUMN `zaehler_abgemeldet` TINYINT(1) NULL DEFAULT '0' AFTER `rechnung_vertrieb`;

ALTER TABLE `teileigentumseinheit`
  DROP COLUMN `zaehler_abgemeldet`;

ALTER TABLE `zaehlerstand`
  ADD COLUMN `zaehler_abgemeldet` TINYINT(1) NULL DEFAULT '0';