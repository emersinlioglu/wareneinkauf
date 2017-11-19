ALTER TABLE `teileigentumseinheit`
  ADD COLUMN `projekt_id` INT UNSIGNED NULL DEFAULT NULL AFTER `verkaufspreis_begruendung`,
  ADD CONSTRAINT `FK_teileigentumseinheit_projekt` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON UPDATE SET NULL ON DELETE SET NULL;
