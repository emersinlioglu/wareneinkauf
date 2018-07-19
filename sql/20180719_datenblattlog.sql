ALTER TABLE `datenblatt`
  DROP COLUMN `deleted`;

CREATE TABLE `datenblatt_log` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firma_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `projekt_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `haus_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `nummer` INT(11) NULL DEFAULT NULL,
  `kaeufer_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `besondere_regelungen_kaufvertrag` TEXT NULL,
  `sonstige_anmerkungen` TEXT NULL,
  `aktiv` TINYINT(1) NULL DEFAULT '0',
  `beurkundung_am` DATE NULL DEFAULT NULL,
  `verbindliche_fertigstellung` DATE NULL DEFAULT NULL,
  `uebergang_bnl` DATE NULL DEFAULT NULL,
  `abnahme_se` DATE NULL DEFAULT NULL,
  `abnahme_ge` DATE NULL DEFAULT NULL,
  `auflassung` TINYINT(1) NULL DEFAULT '0',
  `creator_user_id` INT(10) UNSIGNED NOT NULL,
  `sap_debitor_nr` VARCHAR(50) NULL DEFAULT NULL,
  `intern_debitor_nr` VARCHAR(50) NULL DEFAULT NULL,
  `deleted_by` INT(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  ROW_FORMAT=COMPACT
;


CREATE TABLE `teileigentumseinheit_log` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datenblatt_log_id` INT(11) UNSIGNED NULL DEFAULT NULL,
  `hausnr` VARCHAR(50) NULL DEFAULT NULL,
  `einheitstyp_id` INT(10) UNSIGNED NOT NULL,
  `te_nummer` VARCHAR(255) NULL DEFAULT NULL,
  `gefoerdert` TINYINT(1) NOT NULL DEFAULT '0',
  `geschoss` VARCHAR(45) NULL DEFAULT NULL,
  `zimmer` VARCHAR(45) NULL DEFAULT NULL,
  `status` ENUM('frei','reserviert','verkauft') NULL DEFAULT 'frei',
  `rechnung_vertrieb` TINYINT(1) NULL DEFAULT '0',
  `me_anteil` FLOAT(11,2) NULL DEFAULT NULL,
  `wohnflaeche` FLOAT(11,2) UNSIGNED NULL DEFAULT NULL,
  `kaufpreis` DECIMAL(11,2) NULL DEFAULT NULL,
  `kp_einheit` FLOAT(11,2) NULL DEFAULT NULL,
  `forecast_preis` DECIMAL(11,2) NULL DEFAULT '0.00',
  `verkaufspreis` DECIMAL(11,2) NULL DEFAULT '0.00',
  `verkaufspreis_begruendung` TEXT NULL,
  `projekt_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  ROW_FORMAT=COMPACT
;
