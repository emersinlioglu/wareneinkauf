CREATE TABLE `abgproject`.`zinsverzug` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datenblatt_id` INT(11) NOT NULL,
  `schreiben_vom` DATE NULL DEFAULT NULL,
  `betrag` DOUBLE NULL DEFAULT NULL,
  `bemerkung` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_zinsverzug_datenblatt1_idx` (`datenblatt_id`),
  FOREIGN KEY (`datenblatt_id`) REFERENCES `datenblatt` (`id`) ON UPDATE NO ACTION ON DELETE CASCADE
)
  COLLATE 'utf8_general_ci' ENGINE=InnoDB ROW_FORMAT=Compact AUTO_INCREMENT=1;
