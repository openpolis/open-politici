ALTER TABLE `op_education_level` ADD `oid` INTEGER(10);
ALTER TABLE `op_education_level` ADD `odescription` VARCHAR(255);
ALTER TABLE `op_education_level` CHANGE `description` `description` VARCHAR(255)  NOT NULL;
CREATE UNIQUE INDEX op_education_description_idx ON op_education_level (description);

ALTER TABLE `op_profession` CHANGE `description` `description` VARCHAR(255)  NOT NULL;
CREATE UNIQUE INDEX op_profession_description_idx ON op_profession (description);
