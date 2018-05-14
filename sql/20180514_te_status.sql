ALTER TABLE `teileigentumseinheit`
    ADD COLUMN `status` ENUM('frei','reserviert','verkauft') NULL DEFAULT 'frei' AFTER `zimmer`;

ALTER TABLE `teileigentumseinheit`
    ADD COLUMN `rechnung_vertrieb` TINYINT(1) NULL DEFAULT '0' AFTER `status`;

update teileigentumseinheit te
    left join haus h on h.id = te.haus_id
set te.`status` = h.status;