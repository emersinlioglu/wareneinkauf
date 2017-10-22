ALTER TABLE `teileigentumseinheit`
  ADD COLUMN `forecast_preis` DECIMAL(11,2) NULL DEFAULT '0' AFTER `kp_einheit`,
  ADD COLUMN `verkaufspreis` DECIMAL(11,2) NULL DEFAULT '0' AFTER `forecast_preis`,
  ADD COLUMN `verkaufspreis_begruendung` TEXT NULL AFTER `verkaufspreis`;

ALTER TABLE `teileigentumseinheit`
  DROP FOREIGN KEY `fk_teileigentumseinheit_haus1`;

ALTER TABLE `teileigentumseinheit`
  CHANGE COLUMN `haus_id` `haus_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `id`;
