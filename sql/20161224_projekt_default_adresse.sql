ALTER TABLE `projekt`
  ADD COLUMN `plz` VARCHAR(255) NULL DEFAULT NULL AFTER `creator_user_id`,
  ADD COLUMN `ort` VARCHAR(255) NULL DEFAULT NULL AFTER `plz`,
  ADD COLUMN `strasse` VARCHAR(255) NULL DEFAULT NULL AFTER `ort`,
  ADD COLUMN `hausnr` VARCHAR(45) NULL DEFAULT NULL AFTER `strasse`;
