
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- op_charge_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_charge_type`;


CREATE TABLE `op_charge_type`
(
	`name` VARCHAR(255),
	`short_name` VARCHAR(455),
	`priority` INTEGER default 0,
	`category` VARCHAR(1) default 'I' NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_comment`;


CREATE TABLE `op_comment`
(
	`user_id` INTEGER  NOT NULL,
	`content_id` INTEGER  NOT NULL,
	`body` TEXT,
	`html_body` TEXT,
	`relevancy_score_up` INTEGER default 0 NOT NULL,
	`relevancy_score_down` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`reports` INTEGER default 0 NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_comment_user_id_index`(`user_id`),
	KEY `op_comment_content_id_index`(`content_id`),
	CONSTRAINT `op_comment_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`),
	CONSTRAINT `op_comment_FK_2`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_opinable_content` (`content_id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_comment_report
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_comment_report`;


CREATE TABLE `op_comment_report`
(
	`user_id` INTEGER  NOT NULL,
	`comment_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`notes` TEXT,
	`report_type` VARCHAR(1),
	PRIMARY KEY (`user_id`,`comment_id`),
	CONSTRAINT `op_comment_report_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`),
	INDEX `op_comment_report_FI_2` (`comment_id`),
	CONSTRAINT `op_comment_report_FK_2`
		FOREIGN KEY (`comment_id`)
		REFERENCES `op_comment` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_constituency
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_constituency`;


CREATE TABLE `op_constituency`
(
	`election_type_id` INTEGER  NOT NULL,
	`name` VARCHAR(255),
	`valid` TINYINT,
	`slug` VARCHAR(128),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_constituency_election_type_id_index`(`election_type_id`),
	CONSTRAINT `op_constituency_FK_1`
		FOREIGN KEY (`election_type_id`)
		REFERENCES `op_election_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_constituency_location
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_constituency_location`;


CREATE TABLE `op_constituency_location`
(
	`constituency_id` INTEGER  NOT NULL,
	`location_id` INTEGER  NOT NULL,
	PRIMARY KEY (`constituency_id`,`location_id`),
	CONSTRAINT `op_constituency_location_FK_1`
		FOREIGN KEY (`constituency_id`)
		REFERENCES `op_constituency` (`id`),
	INDEX `op_constituency_location_FI_2` (`location_id`),
	CONSTRAINT `op_constituency_location_FK_2`
		FOREIGN KEY (`location_id`)
		REFERENCES `op_location` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_content
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_content`;


CREATE TABLE `op_content`
(
	`reports` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`op_table` VARCHAR(128),
	`op_class` VARCHAR(128),
	`hash` VARCHAR(32),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_content_created_at_index`(`created_at`),
	KEY `op_content_updated_at_index`(`updated_at`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_declaration
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_declaration`;


CREATE TABLE `op_declaration`
(
	`content_id` INTEGER  NOT NULL,
	`politician_id` INTEGER  NOT NULL,
	`date` DATETIME,
	`title` VARCHAR(255)  NOT NULL,
	`text` TEXT  NOT NULL,
	`relevancy_score` INTEGER default 0,
	`source_name` VARCHAR(255)  NOT NULL,
	`source_url` VARCHAR(255),
	`source_file` MEDIUMBLOB,
	`source_mime` VARCHAR(40),
	`source_size` INTEGER,
	PRIMARY KEY (`content_id`),
	KEY `op_declaration_politician_id_index`(`politician_id`),
	CONSTRAINT `op_declaration_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_opinable_content` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_declaration_FK_2`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_education_level
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_education_level`;


CREATE TABLE `op_education_level`
(
	`description` VARCHAR(255)  NOT NULL,
	`oid` INTEGER,
	`odescription` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_education_level_description_index`(`description`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_election_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_election_type`;


CREATE TABLE `op_election_type`
(
	`name` VARCHAR(32)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_faq
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_faq`;


CREATE TABLE `op_faq`
(
	`answer` TEXT,
	`question` TEXT,
	`faq_group_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_faq_faq_group_id_index`(`faq_group_id`),
	CONSTRAINT `op_faq_FK_1`
		FOREIGN KEY (`faq_group_id`)
		REFERENCES `op_faq_group` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_faq_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_faq_group`;


CREATE TABLE `op_faq_group`
(
	`name` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_friend
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_friend`;


CREATE TABLE `op_friend`
(
	`user_id` INTEGER  NOT NULL,
	`friend_id` INTEGER  NOT NULL,
	PRIMARY KEY (`user_id`,`friend_id`),
	CONSTRAINT `op_friend_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`),
	INDEX `op_friend_FI_2` (`friend_id`),
	CONSTRAINT `op_friend_FK_2`
		FOREIGN KEY (`friend_id`)
		REFERENCES `op_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_group`;


CREATE TABLE `op_group`
(
	`name` VARCHAR(255),
	`acronym` VARCHAR(80),
	`oid` INTEGER,
	`oname` VARCHAR(80),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `op_group_name_unique` (`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_group_location
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_group_location`;


CREATE TABLE `op_group_location`
(
	`group_id` INTEGER  NOT NULL,
	`location_id` INTEGER  NOT NULL,
	PRIMARY KEY (`group_id`,`location_id`),
	CONSTRAINT `op_group_location_FK_1`
		FOREIGN KEY (`group_id`)
		REFERENCES `op_group` (`id`),
	INDEX `op_group_location_FI_2` (`location_id`),
	CONSTRAINT `op_group_location_FK_2`
		FOREIGN KEY (`location_id`)
		REFERENCES `op_location` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_holder_has_position_on_theme
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_holder_has_position_on_theme`;


CREATE TABLE `op_holder_has_position_on_theme`
(
	`theme_id` INTEGER  NOT NULL,
	`party_id` INTEGER,
	`politician_id` INTEGER,
	`holder_type` VARCHAR(1)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_holder_has_position_on_theme_theme_id_index`(`theme_id`),
	KEY `op_holder_has_position_on_theme_party_id_index`(`party_id`),
	KEY `op_holder_has_position_on_theme_politician_id_index`(`politician_id`),
	CONSTRAINT `op_holder_has_position_on_theme_FK_1`
		FOREIGN KEY (`theme_id`)
		REFERENCES `op_theme` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_holder_has_position_on_theme_FK_2`
		FOREIGN KEY (`party_id`)
		REFERENCES `op_party` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_holder_has_position_on_theme_FK_3`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_import
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_import`;


CREATE TABLE `op_import`
(
	`import_type_id` INTEGER  NOT NULL,
	`import_minint_id` INTEGER  NOT NULL,
	`import_file` VARCHAR(255),
	`import_location` VARCHAR(255),
	`started_at` DATETIME,
	`finished_at` DATETIME,
	`run_type` VARCHAR(3),
	`total` INTEGER,
	`errors` INTEGER,
	`warnings` INTEGER,
	`inserted` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_import_import_type_id_index`(`import_type_id`),
	KEY `op_import_import_minint_id_index`(`import_minint_id`),
	CONSTRAINT `op_import_FK_1`
		FOREIGN KEY (`import_type_id`)
		REFERENCES `op_import_type` (`id`),
	CONSTRAINT `op_import_FK_2`
		FOREIGN KEY (`import_minint_id`)
		REFERENCES `op_import_minint` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_import_log
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_import_log`;


CREATE TABLE `op_import_log`
(
	`import_id` INTEGER  NOT NULL,
	`counter` INTEGER  NOT NULL,
	`type` VARCHAR(1)  NOT NULL,
	`created_at` DATETIME,
	`importing_data` TEXT,
	`status` VARCHAR(5)  NOT NULL,
	`message` TEXT,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_import_log_import_id_index`(`import_id`),
	KEY `op_import_log_counter_index`(`counter`),
	KEY `op_import_log_type_index`(`type`),
	KEY `op_import_log_status_index`(`status`),
	CONSTRAINT `op_import_log_FK_1`
		FOREIGN KEY (`import_id`)
		REFERENCES `op_import` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_import_minint
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_import_minint`;


CREATE TABLE `op_import_minint`
(
	`agg_date` VARCHAR(8) default '00000000' NOT NULL,
	`type` VARCHAR(2),
	`description` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `op_import_minint_agg_date_unique` (`agg_date`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_import_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_import_type`;


CREATE TABLE `op_import_type`
(
	`name` VARCHAR(32)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `op_import_type_name_unique` (`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_import_user_check
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_import_user_check`;


CREATE TABLE `op_import_user_check`
(
	`import_file` VARCHAR(255)  NOT NULL,
	`import_log_counter` INTEGER default 0 NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`import_file`,`import_log_counter`),
	KEY `op_import_user_check_user_id_index`(`user_id`),
	CONSTRAINT `op_import_user_check_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_institution
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_institution`;


CREATE TABLE `op_institution`
(
	`name` VARCHAR(255),
	`short_name` VARCHAR(45),
	`priority` INTEGER default 0,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_institution_charge
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_institution_charge`;


CREATE TABLE `op_institution_charge`
(
	`content_id` INTEGER  NOT NULL,
	`politician_id` INTEGER  NOT NULL,
	`institution_id` INTEGER  NOT NULL,
	`charge_type_id` INTEGER  NOT NULL,
	`location_id` INTEGER,
	`constituency_id` INTEGER,
	`party_id` INTEGER default 1 NOT NULL,
	`group_id` INTEGER default 1 NOT NULL,
	`date_start` DATE,
	`date_end` DATE,
	`description` VARCHAR(255),
	`minint_verified_at` DATETIME,
	PRIMARY KEY (`content_id`),
	KEY `op_institution_charge_politician_id_index`(`politician_id`),
	KEY `op_institution_charge_institution_id_index`(`institution_id`),
	KEY `op_institution_charge_charge_type_id_index`(`charge_type_id`),
	KEY `op_institution_charge_location_id_index`(`location_id`),
	KEY `op_institution_charge_constituency_id_index`(`constituency_id`),
	KEY `op_institution_charge_party_id_index`(`party_id`),
	KEY `op_institution_charge_group_id_index`(`group_id`),
	CONSTRAINT `op_institution_charge_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_open_content` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_institution_charge_FK_2`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_institution_charge_FK_3`
		FOREIGN KEY (`institution_id`)
		REFERENCES `op_institution` (`id`),
	CONSTRAINT `op_institution_charge_FK_4`
		FOREIGN KEY (`charge_type_id`)
		REFERENCES `op_charge_type` (`id`),
	CONSTRAINT `op_institution_charge_FK_5`
		FOREIGN KEY (`location_id`)
		REFERENCES `op_location` (`id`),
	CONSTRAINT `op_institution_charge_FK_6`
		FOREIGN KEY (`constituency_id`)
		REFERENCES `op_constituency` (`id`),
	CONSTRAINT `op_institution_charge_FK_7`
		FOREIGN KEY (`party_id`)
		REFERENCES `op_party` (`id`),
	CONSTRAINT `op_institution_charge_FK_8`
		FOREIGN KEY (`group_id`)
		REFERENCES `op_group` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_institution_has_charge_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_institution_has_charge_type`;


CREATE TABLE `op_institution_has_charge_type`
(
	`institution_id` INTEGER  NOT NULL,
	`charge_type_id` INTEGER  NOT NULL,
	PRIMARY KEY (`institution_id`,`charge_type_id`),
	CONSTRAINT `op_institution_has_charge_type_FK_1`
		FOREIGN KEY (`institution_id`)
		REFERENCES `op_institution` (`id`),
	INDEX `op_institution_has_charge_type_FI_2` (`charge_type_id`),
	CONSTRAINT `op_institution_has_charge_type_FK_2`
		FOREIGN KEY (`charge_type_id`)
		REFERENCES `op_charge_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_loc_adoption
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_loc_adoption`;


CREATE TABLE `op_loc_adoption`
(
	`user_id` INTEGER  NOT NULL,
	`location_id` INTEGER  NOT NULL,
	`requested_at` DATETIME,
	`granted_at` DATETIME,
	`revoked_at` DATETIME,
	`refused_at` DATETIME,
	PRIMARY KEY (`user_id`,`location_id`),
	CONSTRAINT `op_loc_adoption_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`)
		ON DELETE CASCADE,
	INDEX `op_loc_adoption_FI_2` (`location_id`),
	CONSTRAINT `op_loc_adoption_FK_2`
		FOREIGN KEY (`location_id`)
		REFERENCES `op_location` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_location
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_location`;


CREATE TABLE `op_location`
(
	`location_type_id` INTEGER  NOT NULL,
	`name` VARCHAR(255),
	`macroregional_id` INTEGER,
	`regional_id` INTEGER,
	`provincial_id` INTEGER,
	`city_id` INTEGER,
	`prov` VARCHAR(2),
	`inhabitants` INTEGER,
	`last_charge_update` DATETIME,
	`alternative_name` VARCHAR(255),
	`minint_regional_code` INTEGER,
	`minint_provincial_code` INTEGER,
	`minint_city_code` INTEGER,
	`date_end` DATE,
	`date_start` DATE,
	`new_location_id` INTEGER,
	`gps_lat` FLOAT,
	`gps_lon` FLOAT,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_location_location_type_id_index`(`location_type_id`),
	KEY `op_location_name_index`(`name`),
	KEY `op_location_macroregional_id_index`(`macroregional_id`),
	KEY `op_location_regional_id_index`(`regional_id`),
	KEY `op_location_provincial_id_index`(`provincial_id`),
	KEY `op_location_city_id_index`(`city_id`),
	KEY `op_location_prov_index`(`prov`),
	KEY `op_location_minint_regional_code_index`(`minint_regional_code`),
	KEY `op_location_minint_provincial_code_index`(`minint_provincial_code`),
	CONSTRAINT `op_location_FK_1`
		FOREIGN KEY (`location_type_id`)
		REFERENCES `op_location_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_location_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_location_type`;


CREATE TABLE `op_location_type`
(
	`name` VARCHAR(32)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_election
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_election`;


CREATE TABLE `op_election`
(
	`election_date` DATE,
	`election_type_id` INTEGER  NOT NULL,
	`location_id` INTEGER  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `uq_idx` (`election_date`, `election_type_id`, `location_id`),
	KEY `op_election_election_type_id_index`(`election_type_id`),
	KEY `op_election_location_id_index`(`location_id`),
	CONSTRAINT `op_election_FK_1`
		FOREIGN KEY (`election_type_id`)
		REFERENCES `op_election_type` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_election_FK_2`
		FOREIGN KEY (`location_id`)
		REFERENCES `op_location` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_message
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_message`;


CREATE TABLE `op_message`
(
	`user_id` INTEGER  NOT NULL,
	`subject` VARCHAR(255)  NOT NULL,
	`body` TEXT  NOT NULL,
	`body_html` TEXT,
	`archive_status` INTEGER default 0 NOT NULL,
	`delete_status` INTEGER,
	`created_at` DATETIME,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_message_user_id_index`(`user_id`),
	CONSTRAINT `op_message_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_obscured_content
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_obscured_content`;


CREATE TABLE `op_obscured_content`
(
	`user_id` INTEGER  NOT NULL,
	`content_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`reason` TEXT,
	PRIMARY KEY (`user_id`,`content_id`),
	CONSTRAINT `op_obscured_content_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`),
	INDEX `op_obscured_content_FI_2` (`content_id`),
	CONSTRAINT `op_obscured_content_FK_2`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_open_content` (`content_id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_open_content
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_open_content`;


CREATE TABLE `op_open_content`
(
	`content_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`updater_id` INTEGER,
	`verified_at` DATETIME,
	`deleted_at` DATETIME,
	PRIMARY KEY (`content_id`),
	KEY `op_open_content_user_id_index`(`user_id`),
	KEY `op_open_content_updater_id_index`(`updater_id`),
	CONSTRAINT `op_open_content_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_content` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_open_content_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`),
	CONSTRAINT `op_open_content_FK_3`
		FOREIGN KEY (`updater_id`)
		REFERENCES `op_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_verified_content
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_verified_content`;


CREATE TABLE `op_verified_content`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`content_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`operation` VARCHAR(255),
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

#-----------------------------------------------------------------------------
#-- op_opinable_content
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_opinable_content`;


CREATE TABLE `op_opinable_content`
(
	`content_id` INTEGER  NOT NULL,
	PRIMARY KEY (`content_id`),
	CONSTRAINT `op_opinable_content_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_open_content` (`content_id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_organization
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_organization`;


CREATE TABLE `op_organization`
(
	`name` VARCHAR(255),
	`url` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_organization_charge
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_organization_charge`;


CREATE TABLE `op_organization_charge`
(
	`content_id` INTEGER  NOT NULL,
	`politician_id` INTEGER  NOT NULL,
	`date_start` DATE,
	`date_end` DATE,
	`charge_name` VARCHAR(255),
	`organization_id` INTEGER,
	`current` TINYINT,
	PRIMARY KEY (`content_id`),
	KEY `op_organization_charge_politician_id_index`(`politician_id`),
	KEY `op_organization_charge_organization_id_index`(`organization_id`),
	CONSTRAINT `op_organization_charge_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_open_content` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_organization_charge_FK_2`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_organization_charge_FK_3`
		FOREIGN KEY (`organization_id`)
		REFERENCES `op_organization` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_organization_has_op_organization_tag
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_organization_has_op_organization_tag`;


CREATE TABLE `op_organization_has_op_organization_tag`
(
	`organization_id` INTEGER  NOT NULL,
	`organization_tag_id` INTEGER  NOT NULL,
	PRIMARY KEY (`organization_id`,`organization_tag_id`),
	CONSTRAINT `op_organization_has_op_organization_tag_FK_1`
		FOREIGN KEY (`organization_id`)
		REFERENCES `op_organization` (`id`),
	INDEX `op_organization_has_op_organization_tag_FI_2` (`organization_tag_id`),
	CONSTRAINT `op_organization_has_op_organization_tag_FK_2`
		FOREIGN KEY (`organization_tag_id`)
		REFERENCES `op_organization_tag` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_organization_tag
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_organization_tag`;


CREATE TABLE `op_organization_tag`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(32)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_party
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_party`;


CREATE TABLE `op_party`
(
	`istat_code` VARCHAR(15),
	`name` VARCHAR(80)  NOT NULL,
	`acronym` VARCHAR(20),
	`party` TINYINT default 0,
	`main` TINYINT default 0,
	`electoral` TINYINT default 0,
	`oid` INTEGER,
	`oname` VARCHAR(80),
	`logo` MEDIUMBLOB,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `op_party_name_unique` (`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_party_location
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_party_location`;


CREATE TABLE `op_party_location`
(
	`party_id` INTEGER  NOT NULL,
	`location_id` INTEGER  NOT NULL,
	PRIMARY KEY (`party_id`,`location_id`),
	CONSTRAINT `op_party_location_FK_1`
		FOREIGN KEY (`party_id`)
		REFERENCES `op_party` (`id`)
		ON DELETE CASCADE,
	INDEX `op_party_location_FI_2` (`location_id`),
	CONSTRAINT `op_party_location_FK_2`
		FOREIGN KEY (`location_id`)
		REFERENCES `op_location` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_phase_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_phase_type`;


CREATE TABLE `op_phase_type`
(
	`name` VARCHAR(32)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_pol_adoption
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_pol_adoption`;


CREATE TABLE `op_pol_adoption`
(
	`user_id` INTEGER  NOT NULL,
	`politician_id` INTEGER  NOT NULL,
	`requested_at` DATETIME,
	`granted_at` DATETIME,
	`revoked_at` DATETIME,
	`refused_at` DATETIME,
	PRIMARY KEY (`user_id`,`politician_id`),
	CONSTRAINT `op_pol_adoption_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`)
		ON DELETE CASCADE,
	INDEX `op_pol_adoption_FI_2` (`politician_id`),
	CONSTRAINT `op_pol_adoption_FK_2`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_political_charge
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_political_charge`;


CREATE TABLE `op_political_charge`
(
	`content_id` INTEGER  NOT NULL,
	`charge_type_id` INTEGER  NOT NULL,
	`politician_id` INTEGER  NOT NULL,
	`location_id` INTEGER  NOT NULL,
	`party_id` INTEGER  NOT NULL,
	`date_start` DATE,
	`date_end` DATE,
	`description` VARCHAR(255),
	`current` TINYINT,
	PRIMARY KEY (`content_id`),
	KEY `op_political_charge_charge_type_id_index`(`charge_type_id`),
	KEY `op_political_charge_politician_id_index`(`politician_id`),
	KEY `op_political_charge_location_id_index`(`location_id`),
	KEY `op_political_charge_party_id_index`(`party_id`),
	CONSTRAINT `op_political_charge_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_open_content` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_political_charge_FK_2`
		FOREIGN KEY (`charge_type_id`)
		REFERENCES `op_charge_type` (`id`),
	CONSTRAINT `op_political_charge_FK_3`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_political_charge_FK_4`
		FOREIGN KEY (`location_id`)
		REFERENCES `op_location` (`id`),
	CONSTRAINT `op_political_charge_FK_5`
		FOREIGN KEY (`party_id`)
		REFERENCES `op_party` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_politician
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_politician`;


CREATE TABLE `op_politician`
(
	`content_id` INTEGER  NOT NULL,
	`profession_id` INTEGER,
	`user_id` INTEGER,
	`creator_id` INTEGER,
	`first_name` VARCHAR(64),
	`last_name` VARCHAR(64),
	`sex` VARCHAR(1),
	`picture` MEDIUMBLOB,
	`birth_date` DATETIME,
	`birth_location` VARCHAR(128),
	`death_date` DATETIME,
	`last_charge_update` DATETIME,
	`is_indexed` TINYINT default 0 NOT NULL,
	`minint_aka` VARCHAR(255),
	PRIMARY KEY (`content_id`),
	UNIQUE KEY `op_politician_minint_aka_unique` (`minint_aka`),
	KEY `op_politician_profession_id_index`(`profession_id`),
	KEY `op_politician_user_id_index`(`user_id`),
	KEY `op_politician_creator_id_index`(`creator_id`),
	KEY `op_politician_first_name_index`(`first_name`),
	KEY `op_politician_last_name_index`(`last_name`),
	KEY `op_politician_sex_index`(`sex`),
	KEY `op_politician_birth_date_index`(`birth_date`),
	KEY `op_politician_birth_location_index`(`birth_location`),
	CONSTRAINT `op_politician_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_content` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_politician_FK_2`
		FOREIGN KEY (`profession_id`)
		REFERENCES `op_profession` (`id`),
	CONSTRAINT `op_politician_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`),
	CONSTRAINT `op_politician_FK_4`
		FOREIGN KEY (`creator_id`)
		REFERENCES `op_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_politician_has_op_education_level
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_politician_has_op_education_level`;


CREATE TABLE `op_politician_has_op_education_level`
(
	`politician_id` INTEGER  NOT NULL,
	`education_level_id` INTEGER  NOT NULL,
	`description` VARCHAR(255),
	PRIMARY KEY (`politician_id`,`education_level_id`),
	CONSTRAINT `op_politician_has_op_education_level_FK_1`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE,
	INDEX `op_politician_has_op_education_level_FI_2` (`education_level_id`),
	CONSTRAINT `op_politician_has_op_education_level_FK_2`
		FOREIGN KEY (`education_level_id`)
		REFERENCES `op_education_level` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_proc_phase
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_proc_phase`;


CREATE TABLE `op_proc_phase`
(
	`status_type_id` INTEGER  NOT NULL,
	`phase_type_id` INTEGER  NOT NULL,
	`procedimento_id` INTEGER  NOT NULL,
	`sentence` TEXT,
	`motivation` TEXT,
	`source_name` VARCHAR(255),
	`source_url` VARCHAR(255),
	`source_attach` MEDIUMBLOB,
	`phase_year` INTEGER,
	`tribunal_location` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_proc_phase_status_type_id_index`(`status_type_id`),
	KEY `op_proc_phase_phase_type_id_index`(`phase_type_id`),
	KEY `op_proc_phase_procedimento_id_index`(`procedimento_id`),
	CONSTRAINT `op_proc_phase_FK_1`
		FOREIGN KEY (`status_type_id`)
		REFERENCES `op_status_type` (`id`),
	CONSTRAINT `op_proc_phase_FK_2`
		FOREIGN KEY (`phase_type_id`)
		REFERENCES `op_phase_type` (`id`),
	CONSTRAINT `op_proc_phase_FK_3`
		FOREIGN KEY (`procedimento_id`)
		REFERENCES `op_procedimento` (`content_id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_procedimento
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_procedimento`;


CREATE TABLE `op_procedimento`
(
	`content_id` INTEGER  NOT NULL,
	`politician_id` INTEGER  NOT NULL,
	`date` DATE,
	`title` VARCHAR(80),
	`description` TEXT,
	`alleged_crimes` TEXT,
	PRIMARY KEY (`content_id`),
	KEY `op_procedimento_politician_id_index`(`politician_id`),
	CONSTRAINT `op_procedimento_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_opinable_content` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_procedimento_FK_2`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_profession
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_profession`;


CREATE TABLE `op_profession`
(
	`description` VARCHAR(255)  NOT NULL,
	`oid` INTEGER,
	`odescription` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_relevancy
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_relevancy`;


CREATE TABLE `op_relevancy`
(
	`content_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`score` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`content_id`,`user_id`),
	CONSTRAINT `op_relevancy_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_opinable_content` (`content_id`)
		ON DELETE CASCADE,
	INDEX `op_relevancy_FI_2` (`user_id`),
	CONSTRAINT `op_relevancy_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_relevancy_comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_relevancy_comment`;


CREATE TABLE `op_relevancy_comment`
(
	`comment_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`score` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`comment_id`,`user_id`),
	CONSTRAINT `op_relevancy_comment_FK_1`
		FOREIGN KEY (`comment_id`)
		REFERENCES `op_comment` (`id`)
		ON DELETE CASCADE,
	INDEX `op_relevancy_comment_FI_2` (`user_id`),
	CONSTRAINT `op_relevancy_comment_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_report
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_report`;


CREATE TABLE `op_report`
(
	`user_id` INTEGER  NOT NULL,
	`content_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`notes` TEXT,
	`report_type` VARCHAR(1),
	PRIMARY KEY (`user_id`,`content_id`),
	CONSTRAINT `op_report_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`),
	INDEX `op_report_FI_2` (`content_id`),
	CONSTRAINT `op_report_FK_2`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_content` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_required_funds
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_required_funds`;


CREATE TABLE `op_required_funds`
(
	`donors` INTEGER,
	`needed` INTEGER default 0 NOT NULL,
	`raised` INTEGER default 0 NOT NULL,
	`spent` INTEGER,
	`created_at` DATETIME,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_requiring_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_requiring_user`;


CREATE TABLE `op_requiring_user`
(
	`email` VARCHAR(128),
	`beta` TINYINT default 0 NOT NULL,
	`created_at` DATETIME,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_resources
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_resources`;


CREATE TABLE `op_resources`
(
	`content_id` INTEGER  NOT NULL,
	`politician_id` INTEGER  NOT NULL,
	`resources_type_id` INTEGER  NOT NULL,
	`valore` VARCHAR(255),
	`descrizione` TEXT,
	PRIMARY KEY (`content_id`),
	KEY `op_resources_politician_id_index`(`politician_id`),
	KEY `op_resources_resources_type_id_index`(`resources_type_id`),
	CONSTRAINT `op_resources_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_open_content` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_resources_FK_2`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_resources_FK_3`
		FOREIGN KEY (`resources_type_id`)
		REFERENCES `op_resources_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_resources_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_resources_type`;


CREATE TABLE `op_resources_type`
(
	`resource_type` VARCHAR(80),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_session
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_session`;


CREATE TABLE `op_session`
(
	`sess_id` VARCHAR(32)  NOT NULL,
	`sess_data` TEXT  NOT NULL,
	`sess_time` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`sess_id`),
	KEY `op_session_sess_time_index`(`sess_time`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_status_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_status_type`;


CREATE TABLE `op_status_type`
(
	`name` VARCHAR(32)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_tag
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_tag`;


CREATE TABLE `op_tag`
(
	`tag` VARCHAR(80)  NOT NULL,
	`normalized_tag` VARCHAR(80),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `op_tag_normalized_tag_unique` (`normalized_tag`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_tag_has_op_opinable_content
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_tag_has_op_opinable_content`;


CREATE TABLE `op_tag_has_op_opinable_content`
(
	`tag_id` INTEGER  NOT NULL,
	`opinable_content_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`is_obscured` INTEGER default 0,
	PRIMARY KEY (`tag_id`,`opinable_content_id`),
	KEY `op_tag_has_op_opinable_content_user_id_index`(`user_id`),
	CONSTRAINT `op_tag_has_op_opinable_content_FK_1`
		FOREIGN KEY (`tag_id`)
		REFERENCES `op_tag` (`id`)
		ON DELETE CASCADE,
	INDEX `op_tag_has_op_opinable_content_FI_2` (`opinable_content_id`),
	CONSTRAINT `op_tag_has_op_opinable_content_FK_2`
		FOREIGN KEY (`opinable_content_id`)
		REFERENCES `op_opinable_content` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_tag_has_op_opinable_content_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_theme
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_theme`;


CREATE TABLE `op_theme`
(
	`content_id` INTEGER  NOT NULL,
	`title` VARCHAR(255)  NOT NULL,
	`description` TEXT  NOT NULL,
	`relevancy_score` INTEGER default 0,
	`vsq08` TINYINT,
	PRIMARY KEY (`content_id`),
	UNIQUE KEY `op_theme_title_unique` (`title`),
	CONSTRAINT `op_theme_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_opinable_content` (`content_id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_theme_has_declaration
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_theme_has_declaration`;


CREATE TABLE `op_theme_has_declaration`
(
	`declaration_id` INTEGER  NOT NULL,
	`theme_id` INTEGER  NOT NULL,
	`party_id` INTEGER,
	`position` TINYINT default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`declaration_id`,`theme_id`),
	KEY `op_theme_has_declaration_party_id_index`(`party_id`),
	CONSTRAINT `op_theme_has_declaration_FK_1`
		FOREIGN KEY (`declaration_id`)
		REFERENCES `op_declaration` (`content_id`)
		ON DELETE CASCADE,
	INDEX `op_theme_has_declaration_FI_2` (`theme_id`),
	CONSTRAINT `op_theme_has_declaration_FK_2`
		FOREIGN KEY (`theme_id`)
		REFERENCES `op_theme` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_theme_has_declaration_FK_3`
		FOREIGN KEY (`party_id`)
		REFERENCES `op_party` (`id`)
		ON DELETE SET NULL
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_theme_has_location
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_theme_has_location`;


CREATE TABLE `op_theme_has_location`
(
	`theme_id` INTEGER  NOT NULL,
	`location_id` INTEGER  NOT NULL,
	PRIMARY KEY (`theme_id`,`location_id`),
	CONSTRAINT `op_theme_has_location_FK_1`
		FOREIGN KEY (`theme_id`)
		REFERENCES `op_theme` (`content_id`)
		ON DELETE CASCADE,
	INDEX `op_theme_has_location_FI_2` (`location_id`),
	CONSTRAINT `op_theme_has_location_FK_2`
		FOREIGN KEY (`location_id`)
		REFERENCES `op_location` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_user`;


CREATE TABLE `op_user`
(
	`id` INTEGER  NOT NULL,
	`location_id` INTEGER,
	`first_name` VARCHAR(100),
	`last_name` VARCHAR(100),
	`nickname` VARCHAR(16),
	`is_active` TINYINT default 0 NOT NULL,
	`email` VARCHAR(100) default '' NOT NULL,
	`sha1_password` VARCHAR(40),
	`salt` VARCHAR(32),
	`want_to_be_moderator` INTEGER default 0,
	`is_moderator` INTEGER default 0,
	`is_administrator` INTEGER default 0,
	`is_aggiungitor` INTEGER default 0,
	`is_premium` INTEGER,
	`is_adhoc` INTEGER,
	`deletions` INTEGER,
	`created_at` DATETIME,
	`picture` MEDIUMBLOB,
	`url_personal_website` VARCHAR(255),
	`notes` TEXT,
	`has_paypal` INTEGER default 0,
	`remember_key` VARCHAR(64),
	`wants_newsletter` TINYINT default 0 NOT NULL,
	`public_name` TINYINT default 1 NOT NULL,
	`charges` INTEGER default 0,
	`resources` INTEGER default 0,
	`declarations` INTEGER default 0,
	`pol_insertions` INTEGER default 0,
	`themes` INTEGER default 0,
	`comments` INTEGER default 0,
	`last_contribution` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `op_user_sha1_password_unique` (`sha1_password`),
	KEY `op_user_location_id_index`(`location_id`),
	CONSTRAINT `op_user_FK_1`
		FOREIGN KEY (`location_id`)
		REFERENCES `op_location` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_tax_declaration
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_tax_declaration`;


CREATE TABLE `op_tax_declaration`
(
	`content_id` INTEGER  NOT NULL,
	`politician_id` INTEGER  NOT NULL,
	`year` INTEGER  NOT NULL,
	`url` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`content_id`),
	KEY `op_tax_declaration_politician_id_index`(`politician_id`),
	CONSTRAINT `op_tax_declaration_FK_1`
		FOREIGN KEY (`content_id`)
		REFERENCES `op_content` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_tax_declaration_FK_2`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_similar_politician
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_similar_politician`;


CREATE TABLE `op_similar_politician`
(
	`original_id` INTEGER  NOT NULL,
	`similar_id` INTEGER  NOT NULL,
	`is_resolved` TINYINT default 0 NOT NULL,
	`compares_birth_locations` TINYINT default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`user_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_similar_politician_original_id_index`(`original_id`),
	KEY `op_similar_politician_similar_id_index`(`similar_id`),
	KEY `op_similar_politician_user_id_index`(`user_id`),
	CONSTRAINT `op_similar_politician_FK_1`
		FOREIGN KEY (`original_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_similar_politician_FK_2`
		FOREIGN KEY (`similar_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_similar_politician_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `op_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_import_similar
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_import_similar`;


CREATE TABLE `op_import_similar`
(
	`new_csv_rec` VARCHAR(255)  NOT NULL,
	`old_csv_rec` VARCHAR(255)  NOT NULL,
	`context` VARCHAR(10)  NOT NULL,
	`location_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`deleted_at` DATETIME,
	`deleting_user_id` INTEGER,
	`n_diffs` INTEGER,
	`charges_differ` TINYINT,
	`names_differ` TINYINT,
	`birth_dates_differ` TINYINT,
	`birth_places_differ` TINYINT,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `import_similar_idx` (`new_csv_rec`, `old_csv_rec`),
	KEY `op_import_similar_new_csv_rec_index`(`new_csv_rec`),
	KEY `op_import_similar_old_csv_rec_index`(`old_csv_rec`),
	KEY `op_import_similar_context_index`(`context`),
	KEY `op_import_similar_location_id_index`(`location_id`),
	KEY `op_import_similar_deleting_user_id_index`(`deleting_user_id`),
	CONSTRAINT `op_import_similar_FK_1`
		FOREIGN KEY (`location_id`)
		REFERENCES `op_location` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `op_import_similar_FK_2`
		FOREIGN KEY (`deleting_user_id`)
		REFERENCES `op_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_import_modifications
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_import_modifications`;


CREATE TABLE `op_import_modifications`
(
	`rec_type` VARCHAR(3)  NOT NULL,
	`context` VARCHAR(10)  NOT NULL,
	`csv_rec` VARCHAR(255)  NOT NULL,
	`action_type` VARCHAR(16),
	`blocked_at` DATETIME,
	`concretised_at` DATETIME,
	`import_id` INTEGER,
	`location_id` INTEGER  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
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
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_import_block
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_import_block`;


CREATE TABLE `op_import_block`
(
	`rec_type` VARCHAR(3)  NOT NULL,
	`csv_rec` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`creating_user_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `import_block_idx` (`rec_type`, `csv_rec`),
	KEY `op_import_block_creating_user_id_index`(`creating_user_id`),
	CONSTRAINT `op_import_block_FK_1`
		FOREIGN KEY (`creating_user_id`)
		REFERENCES `op_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- op_minint_aka
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `op_minint_aka`;


CREATE TABLE `op_minint_aka`
(
	`politician_id` INTEGER  NOT NULL,
	`minint_aka` VARCHAR(255),
	`created_at` DATETIME,
	`verified_at` DATETIME,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `op_minint_aka_politician_id_index`(`politician_id`),
	KEY `op_minint_aka_minint_aka_index`(`minint_aka`),
	CONSTRAINT `op_minint_aka_FK_1`
		FOREIGN KEY (`politician_id`)
		REFERENCES `op_politician` (`content_id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
