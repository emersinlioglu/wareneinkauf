ALTER TABLE `teileigentumseinheit`
  ADD COLUMN `forecast_preis` DECIMAL(11,2) NULL DEFAULT '0' AFTER `kp_einheit`,
  ADD COLUMN `verkaufspreis` DECIMAL(11,2) NULL DEFAULT '0' AFTER `forecast_price`,
  ADD COLUMN `verkaufspreis_begruendung` TEXT NULL AFTER `verkaufspreis`;
