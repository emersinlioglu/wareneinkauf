CREATE TABLE `query_builder_profile` (
  `id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `filter_rules` TEXT NULL,
  `aktive` TINYINT(1) UNSIGNED NULL DEFAULT '0',
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_query_builder_profile_user` (`user_id`),
  CONSTRAINT `FK_query_builder_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  ROW_FORMAT=COMPACT
;
