ALTER TABLE `teileigentumseinheit`
    ADD COLUMN `hausnr` VARCHAR(50) NULL DEFAULT NULL AFTER `haus_id`;

ALTER TABLE `teileigentumseinheit`
    CHANGE COLUMN `me_anteil` `me_anteil` FLOAT(11,2) NULL DEFAULT NULL AFTER `zimmer`;
