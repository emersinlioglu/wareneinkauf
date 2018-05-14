ALTER TABLE `teileigentumseinheit`
    ADD COLUMN `status` ENUM('frei','reserviert','verkauft') NULL DEFAULT 'frei' AFTER `zimmer`;

ALTER TABLE `teileigentumseinheit`
    ADD COLUMN `rechnung_vertrieb` TINYINT(1) NULL DEFAULT '0' AFTER `status`;
