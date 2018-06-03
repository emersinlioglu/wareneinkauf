ALTER TABLE `kaeufer`
    ADD COLUMN `user_id` INT(11) NULL DEFAULT NULL AFTER `nachname2`,
    ADD CONSTRAINT `FK_kaeufer_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE RESTRICT;

ALTER TABLE `teileigentumseinheit`
    ADD COLUMN `kaeufer_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `projekt_id`,
    ADD CONSTRAINT `FK_teileigentumseinheit_kaeufer` FOREIGN KEY (`kaeufer_id`) REFERENCES `kaeufer` (`id`);
