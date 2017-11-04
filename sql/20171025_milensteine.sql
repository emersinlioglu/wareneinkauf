CREATE TABLE `projekt_abschlag` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `kaufvertrag_prozent` FLOAT NULL DEFAULT '0',
  `projekt_id` INT(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_projekt_abschlag_projekt` (`projekt_id`),
  CONSTRAINT `FK_projekt_abschlag_projekt` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  AUTO_INCREMENT=5
;

CREATE TABLE `meilenstein` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `number` INT(10) UNSIGNED NULL DEFAULT NULL,
  `kaufvertrag_prozent` FLOAT NULL DEFAULT NULL,
  `projekt_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `projekt_abschlag_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_meilenstein_projekt_abschlag` (`projekt_id`),
  INDEX `FK_meilenstein_projekt_abschlag_2` (`projekt_abschlag_id`),
  CONSTRAINT `FK_meilenstein_projekt_abschlag` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_meilenstein_projekt_abschlag_2` FOREIGN KEY (`projekt_abschlag_id`) REFERENCES `projekt_abschlag` (`id`) ON DELETE SET NULL
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  AUTO_INCREMENT=11
;

CREATE TABLE `abschlag_meilenstein` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `meilenstein_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `abschlag_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_abschlag_meilenstein_meilenstein` (`meilenstein_id`),
  INDEX `FK_abschlag_meilenstein_abschlag` (`abschlag_id`),
  CONSTRAINT `FK_abschlag_meilenstein_abschlag` FOREIGN KEY (`abschlag_id`) REFERENCES `abschlag` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_abschlag_meilenstein_meilenstein` FOREIGN KEY (`meilenstein_id`) REFERENCES `meilenstein` (`id`) ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;
