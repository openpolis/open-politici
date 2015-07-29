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
