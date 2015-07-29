ALTER TABLE `op_open_content` ADD `verified_at` DATETIME;

CREATE TABLE `op_verified_content`
(
  `id` INTEGER  NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned  NOT NULL,
  `content_id` int(10) unsigned  NOT NULL,
  `created_at` DATETIME,
  `operation` VARCHAR(1),
  PRIMARY KEY (`id`),
  KEY `op_verified_content_user_id_index`(`user_id`),
  KEY `op_verified_content_content_id_index`(`content_id`),
  CONSTRAINT `op_verified_content_FK_1`
          FOREIGN KEY (`user_id`)
          REFERENCES `op_user` (`id`),
  CONSTRAINT `op_verified_content_FK_2`
          FOREIGN KEY (`content_id`)
          REFERENCES `op_open_content` (`content_id`)
          ON DELETE CASCADE
)Type=InnoDB;
