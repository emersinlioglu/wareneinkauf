ALTER TABLE `haus`
  ADD COLUMN `status` ENUM('frei','reserviert','verkauft') NULL DEFAULT 'frei' AFTER `hausnr`;

update haus h
set
  h.`status` = 'frei'
where
  h.reserviert = 0
  and
  h.verkauft = 0;

update haus h
set
  h.`status` = 'reserviert'
where
  h.reserviert = 1;

update haus h
set
  h.`status` = 'verkauft'
where
  h.verkauft = 1;