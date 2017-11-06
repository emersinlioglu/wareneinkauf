ALTER TABLE `abschlag_meilenstein`
  ADD UNIQUE INDEX `meilenstein_id_abschlag_id` (`meilenstein_id`, `abschlag_id`);
