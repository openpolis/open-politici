CREATE TABLE `op_tax_declaration`
(
        `content_id` int(10) unsigned default 0 NOT NULL,
        `politician_id` int(10) unsigned default 0 NOT NULL,
        `year` INTEGER  NOT NULL,
        `url` VARCHAR(255)  NOT NULL,
        PRIMARY KEY (`content_id`),
        CONSTRAINT `op_tax_declaration_FK_1`
                FOREIGN KEY (`content_id`)
                REFERENCES `op_content` (`id`)
                ON UPDATE RESTRICT
                ON DELETE CASCADE,
        INDEX `op_tax_declaration_FI_2` (`politician_id`),
        CONSTRAINT `op_tax_declaration_FK_2`
                FOREIGN KEY (`politician_id`)
                REFERENCES `op_politician` (`content_id`)                
                ON UPDATE RESTRICT
                ON DELETE CASCADE
)Type=InnoDB;