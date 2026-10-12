-- Run against the application's existing database, not the MariaDB mysql database.
-- Preserves existing users and IDs. No full dump reimport is needed.
-- If this ALTER was already applied manually, no migration is needed.
ALTER TABLE `user`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
