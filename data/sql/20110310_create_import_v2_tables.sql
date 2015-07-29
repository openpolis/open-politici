CREATE TABLE `op_import_similar`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`new_csv_rec` VARCHAR(255)  NOT NULL,
	`old_csv_rec` VARCHAR(255)  NOT NULL,
	`context` VARCHAR(10) NOT NULL,
	`location_id` INTEGER(10) unsigned,
	`created_at` DATETIME,
	`deleted_at` DATETIME,
	`deleting_user_id` INTEGER(10) unsigned,
	PRIMARY KEY (`id`),
	UNIQUE KEY `import_similar_idx` (`new_csv_rec`, `old_csv_rec`),
	KEY `op_import_similar_new_csv_rec_index`(`new_csv_rec`),
	KEY `op_import_similar_old_csv_rec_index`(`old_csv_rec`),
	KEY `op_import_similar_location_id_index`(`location_id`),
	KEY `op_import_similar_deleting_user_id_index`(`deleting_user_id`),
	KEY `op_import_similar_context_index` (`context`),
	CONSTRAINT `op_import_similar_FK_1`
    FOREIGN KEY (`location_id`)
    REFERENCES `op_location` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `op_import_similar_FK_2`
    FOREIGN KEY (`deleting_user_id`)
    REFERENCES `op_user` (`id`)
    ON DELETE CASCADE
)Engine=InnoDB;


CREATE TABLE `op_import_modifications`
(
  `id` INTEGER  NOT NULL AUTO_INCREMENT,
  `rec_type` VARCHAR(3)  NOT NULL,
  `context` VARCHAR(10)  NOT NULL,
  `csv_rec` VARCHAR(255)  NOT NULL,
  `blocked_at` DATETIME,
  `concretised_at` DATETIME,
  `import_id` INTEGER(10) unsigned,
  `location_id` INTEGER(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `import_modifications_idx` (`rec_type`, `csv_rec`, `import_id`),
  KEY `op_import_modifications_context_index`(`context`),
  KEY `op_import_modifications_import_id_index`(`import_id`),
  KEY `op_import_modifications_location_id_index`(`location_id`),
  CONSTRAINT `op_import_modifications_FK_1`
    FOREIGN KEY (`import_id`)
    REFERENCES `op_import_minint` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `op_import_modifications_FK_2`
    FOREIGN KEY (`location_id`)
    REFERENCES `op_location` (`id`)
    ON DELETE CASCADE
)Engine=InnoDB;


CREATE TABLE `op_import_block`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`rec_type` VARCHAR(3)  NOT NULL,
	`csv_rec` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`creating_user_id` INTEGER(10) unsigned,
	PRIMARY KEY (`id`),
	UNIQUE KEY `import_block_idx` (`rec_type`, `csv_rec`),
	KEY `op_import_block_creating_user_id_index`(`creating_user_id`),
	CONSTRAINT `op_import_block_FK_1`
    FOREIGN KEY (`creating_user_id`)
    REFERENCES `op_user` (`id`)
    ON DELETE CASCADE
)Engine=InnoDB;
