ALTER TABLE `op_similar_politician` ADD `compares_birth_locations` TINYINT default 0 NOT NULL;
ALTER TABLE `op_similar_politician` ADD `created_at` DATETIME;
ALTER TABLE `op_similar_politician` ADD `updated_at` DATETIME;
ALTER TABLE `op_similar_politician` ADD `user_id` INT(10) unsigned;
ALTER TABLE `op_similar_politician` ADD  INDEX `op_similar_politician_user_id_index` (`user_id`);
ALTER TABLE `op_similar_politician` ADD CONSTRAINT `op_similar_politician_FK_3`
                FOREIGN KEY (`user_id`)
                REFERENCES `op_user` (`id`)
                ON DELETE CASCADE;
