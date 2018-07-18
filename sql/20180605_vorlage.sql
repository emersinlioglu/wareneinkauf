ALTER TABLE `vorlage`
  ADD COLUMN `projekt_id` INT UNSIGNED NULL DEFAULT NULL AFTER `vorlage_typ_id`,
  ADD CONSTRAINT `FK_vorlage_projekt` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON UPDATE SET NULL ON DELETE SET NULL;
