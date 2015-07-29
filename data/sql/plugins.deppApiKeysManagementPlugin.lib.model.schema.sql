
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- depp_api_keys
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `depp_api_keys`;


CREATE TABLE `depp_api_keys`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`req_name` VARCHAR(128) default '' NOT NULL,
	`req_contact` VARCHAR(255) default '' NOT NULL,
	`req_description` TEXT,
	`value` VARCHAR(64)  NOT NULL,
	`requested_at` DATETIME,
	`granted_at` DATETIME,
	`revoked_at` DATETIME,
	`refused_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
