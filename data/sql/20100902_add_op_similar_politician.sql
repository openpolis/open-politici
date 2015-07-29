CREATE TABLE `op_similar_politician`
(
        `id` INTEGER  NOT NULL AUTO_INCREMENT,
        `original_id` INT(10) unsigned  NOT NULL,
        `similar_id` INT(10) unsigned  NOT NULL,
        `is_resolved` TINYINT default 0 NOT NULL,
        PRIMARY KEY (`id`),
        KEY `op_similar_politician_original_id_index`(`original_id`),
        KEY `op_similar_politician_similar_id_index`(`similar_id`),
        CONSTRAINT `op_similar_politician_FK_1`
          FOREIGN KEY (`original_id`) REFERENCES `op_politician` (`content_id`)
          ON DELETE CASCADE,
        CONSTRAINT `op_similar_politician_FK_2`
          FOREIGN KEY (`similar_id`)  REFERENCES `op_politician` (`content_id`)
          ON DELETE CASCADE
)Type=InnoDB;
