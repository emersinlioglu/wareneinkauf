ALTER TABLE `kaeufer`
  ADD COLUMN `typ` ENUM('Kapitalanleger','Eigennutzer') NULL DEFAULT 'Kapitalanleger' AFTER `user_id`;
