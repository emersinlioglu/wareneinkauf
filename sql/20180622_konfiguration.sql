CREATE TABLE `konfiguration_typ` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  AUTO_INCREMENT=3
;


REPLACE INTO `konfiguration_typ` (`id`, `name`) VALUES (1, 'Information');
REPLACE INTO `konfiguration_typ` (`id`, `name`) VALUES (2, 'Datenschutz');
REPLACE INTO `konfiguration_typ` (`id`, `name`) VALUES (3, 'Lizenzberechtigung');


CREATE TABLE `konfiguration` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `text` TEXT NOT NULL,
  `zustimmung` TINYINT(1) UNSIGNED NULL DEFAULT '0',
  `deleted` DATE NULL DEFAULT NULL,
  `konfiguration_typ_id` INT(10) UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_konfiguration_konfiguration_typ` (`konfiguration_typ_id`),
  CONSTRAINT `FK_konfiguration_konfiguration_typ` FOREIGN KEY (`konfiguration_typ_id`) REFERENCES `konfiguration_typ` (`id`) ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;



CREATE TABLE `konfiguration_user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `konfiguration_id` INT(11) NULL DEFAULT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  `zustimmung_datum` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_konfiguration_user_konfiguration` (`konfiguration_id`),
  INDEX `FK_konfiguration_user_user` (`user_id`),
  CONSTRAINT `FK_konfiguration_user_konfiguration` FOREIGN KEY (`konfiguration_id`) REFERENCES `konfiguration` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_konfiguration_user_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;