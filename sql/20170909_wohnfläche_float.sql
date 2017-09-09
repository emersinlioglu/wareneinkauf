UPDATE teileigentumseinheit
  SET wohnflaeche = REPLACE (wohnflaeche, ',', '.');

UPDATE teileigentumseinheit
  SET wohnflaeche = null
  WHERE wohnflaeche REGEXP '^[a-zA-Z.]+$';

ALTER TABLE `teileigentumseinheit`
  CHANGE COLUMN `wohnflaeche` `wohnflaeche` FLOAT(11,2) UNSIGNED NULL DEFAULT NULL AFTER `me_anteil`;

ALTER TABLE `teileigentumseinheit`
  CHANGE COLUMN `kaufpreis` `kaufpreis` FLOAT(11,2) NULL DEFAULT NULL AFTER `wohnflaeche`;

ALTER TABLE `teileigentumseinheit`
  CHANGE COLUMN `kp_einheit` `kp_einheit` FLOAT(11,2) NULL DEFAULT NULL AFTER `kaufpreis`;
