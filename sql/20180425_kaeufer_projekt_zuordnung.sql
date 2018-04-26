CREATE TABLE `kaeufer_projekt` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `kaeufer_id` INT(10) UNSIGNED NOT NULL,
    `projekt_id` INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `FK_kaeufer_projekt_kaeufer` (`kaeufer_id`),
    INDEX `FK_kaeufer_projekt_projekt` (`projekt_id`),
    CONSTRAINT `FK_kaeufer_projekt_kaeufer` FOREIGN KEY (`kaeufer_id`) REFERENCES `kaeufer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `FK_kaeufer_projekt_projekt` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
    ENGINE=InnoDB
;

ALTER TABLE `kaeufer_projekt`
    ADD UNIQUE INDEX `kaeufer_id_projekt_id` (`kaeufer_id`, `projekt_id`);


replace into kaeufer_projekt (kaeufer_id, projekt_id)
    select
        db.kaeufer_id, db.projekt_id
    from datenblatt db
        left join kaeufer k on k.id = db.kaeufer_id
    where db.kaeufer_id is not null
    group by db.kaeufer_id, db.projekt_id