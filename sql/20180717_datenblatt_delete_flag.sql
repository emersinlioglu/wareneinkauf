ALTER TABLE `datenblatt`
  ADD COLUMN `deleted` DATETIME NULL DEFAULT NULL AFTER `intern_debitor_nr`;
ALTER TABLE `haus`
  ADD COLUMN `deleted` DATETIME NULL DEFAULT NULL AFTER `creator_user_id`;
