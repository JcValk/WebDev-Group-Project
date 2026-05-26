USE `uniclub`;

ALTER TABLE `member`
  ADD COLUMN IF NOT EXISTS `password` varchar(255) NOT NULL AFTER `student_id`,
  ADD COLUMN IF NOT EXISTS `role` enum('Admin','Member') NOT NULL DEFAULT 'Member' AFTER `password`;

ALTER TABLE `member`
  MODIFY COLUMN `password` varchar(255) NOT NULL;

SET @entitlements_exists = (
  SELECT COUNT(*)
  FROM information_schema.TABLES
  WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'entitlements'
);

SET @copy_entitlements_sql = IF(
  @entitlements_exists > 0,
  'UPDATE `member` m INNER JOIN `entitlements` e ON m.`student_id` = e.`username` SET m.`password` = e.`password`, m.`role` = e.`role`',
  'DO 1'
);

PREPARE copy_entitlements_stmt FROM @copy_entitlements_sql;
EXECUTE copy_entitlements_stmt;
DEALLOCATE PREPARE copy_entitlements_stmt;

SET @old_interests_exists = (
  SELECT COUNT(*)
  FROM information_schema.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'member'
    AND BINARY COLUMN_NAME = 'Interests'
);

SET @rename_interests_sql = IF(
  @old_interests_exists > 0,
  'ALTER TABLE `member` CHANGE COLUMN `Interests` `interests` varchar(250) NOT NULL',
  'DO 1'
);

PREPARE rename_interests_stmt FROM @rename_interests_sql;
EXECUTE rename_interests_stmt;
DEALLOCATE PREPARE rename_interests_stmt;

DROP TABLE IF EXISTS `entitlements`;
