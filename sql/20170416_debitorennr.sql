ALTER TABLE `datenblatt`
  ADD COLUMN `sap_debitor_nr` VARCHAR(50) NULL AFTER `creator_user_id`;

ALTER TABLE `datenblatt`
  ADD COLUMN `intern_debitor_nr` VARCHAR(50) NULL DEFAULT NULL AFTER `sap_debitor_nr`;

ALTER TABLE `einheitstyp`
  ADD COLUMN `prefix_debitor_nr` VARCHAR(3) NULL AFTER `einheit`;
