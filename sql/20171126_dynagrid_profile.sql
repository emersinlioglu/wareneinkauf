CREATE TABLE `dynagrid_profile` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `user_id` INT(11) NOT NULL,
  `aktive` TINYINT(1) UNSIGNED NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `FK_dynagrid_profile_user` (`user_id`),
  CONSTRAINT `FK_dynagrid_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;
