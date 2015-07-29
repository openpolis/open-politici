-- MySQL dump 10.13  Distrib 5.1.53, for apple-darwin10.5.0 (i386)
--
-- Host: localhost    Database: op_openpolis
-- ------------------------------------------------------
-- Server version	5.1.53

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_group`
--

DROP TABLE IF EXISTS `auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `auth_group_permissions`
--

DROP TABLE IF EXISTS `auth_group_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`permission_id`),
  KEY `auth_group_permissions_bda51c3c` (`group_id`),
  KEY `auth_group_permissions_1e014c8f` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `auth_message`
--

DROP TABLE IF EXISTS `auth_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_message_fbfc09f1` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `auth_permission`
--

DROP TABLE IF EXISTS `auth_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content_type_id` int(11) NOT NULL,
  `codename` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_type_id` (`content_type_id`,`codename`),
  KEY `auth_permission_e4470c6e` (`content_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `auth_user`
--

DROP TABLE IF EXISTS `auth_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `date_joined` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `auth_user_groups`
--

DROP TABLE IF EXISTS `auth_user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`group_id`),
  KEY `auth_user_groups_fbfc09f1` (`user_id`),
  KEY `auth_user_groups_bda51c3c` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `auth_user_user_permissions`
--

DROP TABLE IF EXISTS `auth_user_user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_user_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`permission_id`),
  KEY `auth_user_user_permissions_fbfc09f1` (`user_id`),
  KEY `auth_user_user_permissions_1e014c8f` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `depp_api_keys`
--

DROP TABLE IF EXISTS `depp_api_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `depp_api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `req_name` varchar(128) NOT NULL DEFAULT '',
  `req_contact` varchar(255) NOT NULL DEFAULT '',
  `req_description` text,
  `value` varchar(64) NOT NULL,
  `requested_at` datetime DEFAULT NULL,
  `granted_at` datetime DEFAULT NULL,
  `revoked_at` datetime DEFAULT NULL,
  `refused_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `django_admin_log`
--

DROP TABLE IF EXISTS `django_admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `django_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_type_id` int(11) DEFAULT NULL,
  `object_id` longtext,
  `object_repr` varchar(200) NOT NULL,
  `action_flag` smallint(5) unsigned NOT NULL,
  `change_message` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `django_admin_log_fbfc09f1` (`user_id`),
  KEY `django_admin_log_e4470c6e` (`content_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `django_content_type`
--

DROP TABLE IF EXISTS `django_content_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `django_content_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `app_label` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_label` (`app_label`,`model`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `django_session`
--

DROP TABLE IF EXISTS `django_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `django_session` (
  `session_key` varchar(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `expire_date` datetime NOT NULL,
  PRIMARY KEY (`session_key`),
  KEY `django_session_c25c2c28` (`expire_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `django_site`
--

DROP TABLE IF EXISTS `django_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `django_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_charge_type`
--

DROP TABLE IF EXISTS `op_charge_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_charge_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `short_name` varchar(45) DEFAULT NULL,
  `priority` int(11) DEFAULT '0',
  `category` char(1) NOT NULL DEFAULT 'I',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_coalition`
--

DROP TABLE IF EXISTS `op_coalition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_coalition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `acronym` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `op_coalition_name_idx` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_comment`
--

DROP TABLE IF EXISTS `op_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `body` text,
  `html_body` text,
  `relevancy_score_up` int(11) NOT NULL DEFAULT '0',
  `relevancy_score_down` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `reports` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `op_comment_FKIndex1` (`user_id`),
  KEY `op_comment_FKIndex2` (`content_id`),
  CONSTRAINT `op_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_comment_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `op_opinable_content` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1605 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_comment_report`
--

DROP TABLE IF EXISTS `op_comment_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_comment_report` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `comment_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `notes` text,
  `report_type` char(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`comment_id`),
  KEY `op_comment_report_FKIndex1` (`user_id`),
  KEY `op_comment_report_FKIndex2` (`comment_id`),
  CONSTRAINT `op_comment_report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_comment_report_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `op_comment` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_constituency`
--

DROP TABLE IF EXISTS `op_constituency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_constituency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `election_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `op_constituency_FKIndex1` (`election_type_id`),
  CONSTRAINT `op_constituency_ibfk_1` FOREIGN KEY (`election_type_id`) REFERENCES `op_election_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_constituency_location`
--

DROP TABLE IF EXISTS `op_constituency_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_constituency_location` (
  `constituency_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`constituency_id`,`location_id`),
  KEY `op_location_has_op_constituency_FKIndex1` (`location_id`),
  KEY `op_location_has_op_constituency_FKIndex2` (`constituency_id`),
  CONSTRAINT `op_constituency_location_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `op_location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_constituency_location_ibfk_2` FOREIGN KEY (`constituency_id`) REFERENCES `op_constituency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_content`
--

DROP TABLE IF EXISTS `op_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reports` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `op_table` varchar(128) DEFAULT NULL,
  `op_class` varchar(128) DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `op_content_created_at_index` (`created_at`),
  KEY `op_content_updated_at_index` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=390619 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_declaration`
--

DROP TABLE IF EXISTS `op_declaration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_declaration` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `politician_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `relevancy_score` int(10) unsigned DEFAULT '0',
  `source_name` varchar(255) NOT NULL DEFAULT '',
  `source_url` varchar(255) DEFAULT NULL,
  `source_file` mediumblob,
  `source_mime` varchar(40) DEFAULT NULL,
  `source_size` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `op_dichiarazione_FKIndex1` (`content_id`),
  KEY `op_declaration_FKIndex2` (`politician_id`),
  CONSTRAINT `op_declaration_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `op_opinable_content` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_declaration_ibfk_2` FOREIGN KEY (`politician_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_education_level`
--

DROP TABLE IF EXISTS `op_education_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_education_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `oid` int(10) DEFAULT NULL,
  `odescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `op_education_description_idx` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_election_type`
--

DROP TABLE IF EXISTS `op_election_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_election_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_faq`
--

DROP TABLE IF EXISTS `op_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_faq` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `answer` text,
  `question` text,
  `faq_group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `op_faq_group_idx` (`faq_group_id`),
  CONSTRAINT `op_faq_ibfk_1` FOREIGN KEY (`faq_group_id`) REFERENCES `op_faq_group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_faq_group`
--

DROP TABLE IF EXISTS `op_faq_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_faq_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_friend`
--

DROP TABLE IF EXISTS `op_friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_friend` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `friend_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`friend_id`),
  KEY `edem_friend_FKIndex1` (`user_id`),
  KEY `edem_friend_FKIndex2` (`friend_id`),
  CONSTRAINT `op_friend_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_friend_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_group`
--

DROP TABLE IF EXISTS `op_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `acronym` varchar(80) DEFAULT NULL,
  `oid` int(10) unsigned DEFAULT NULL,
  `oname` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `op_group_name_idx` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_group_location`
--

DROP TABLE IF EXISTS `op_group_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_group_location` (
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`,`location_id`),
  KEY `op_group_has_op_location_FKIndex1` (`group_id`),
  KEY `op_group_has_op_location_FKIndex2` (`location_id`),
  CONSTRAINT `op_group_location_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `op_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_group_location_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `op_location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_holder_has_position_on_theme`
--

DROP TABLE IF EXISTS `op_holder_has_position_on_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_holder_has_position_on_theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` int(10) unsigned NOT NULL DEFAULT '0',
  `party_id` int(10) unsigned DEFAULT NULL,
  `politician_id` int(10) unsigned DEFAULT NULL,
  `holder_type` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `op_holder_has_position_on_theme_FKIndex1` (`theme_id`),
  KEY `op_holder_has_position_on_theme_FKIndex2` (`party_id`),
  KEY `op_holder_has_position_on_theme_FKIndex3` (`politician_id`),
  CONSTRAINT `op_holder_has_position_on_theme_FK_1` FOREIGN KEY (`theme_id`) REFERENCES `op_theme` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_holder_has_position_on_theme_FK_2` FOREIGN KEY (`party_id`) REFERENCES `op_party` (`id`) ON DELETE CASCADE,
  CONSTRAINT `op_holder_has_position_on_theme_FK_3` FOREIGN KEY (`politician_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_import`
--

DROP TABLE IF EXISTS `op_import`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_import` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `import_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `import_minint_id` int(10) unsigned NOT NULL DEFAULT '0',
  `import_file` varchar(255) DEFAULT NULL,
  `import_location` varchar(255) DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `run_type` varchar(3) DEFAULT NULL,
  `total` int(8) DEFAULT NULL,
  `errors` int(8) DEFAULT NULL,
  `warnings` int(8) DEFAULT NULL,
  `inserted` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `op_import_minint_FKIndex1` (`import_minint_id`),
  KEY `op_import_type_FKIndex2` (`import_type_id`),
  CONSTRAINT `op_import_minint_ibfk_2` FOREIGN KEY (`import_minint_id`) REFERENCES `op_import_minint` (`id`),
  CONSTRAINT `op_import_type_ibfk_1` FOREIGN KEY (`import_type_id`) REFERENCES `op_import_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1770 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_import_block`
--

DROP TABLE IF EXISTS `op_import_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_import_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rec_type` varchar(3) NOT NULL,
  `csv_rec` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `creating_user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `import_block_idx` (`rec_type`,`csv_rec`),
  KEY `op_import_block_creating_user_id_index` (`creating_user_id`),
  CONSTRAINT `op_import_block_FK_1` FOREIGN KEY (`creating_user_id`) REFERENCES `op_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5855 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_import_log`
--

DROP TABLE IF EXISTS `op_import_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_import_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `import_id` int(10) unsigned NOT NULL DEFAULT '0',
  `counter` int(10) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `importing_data` text,
  `status` varchar(5) NOT NULL DEFAULT '',
  `message` text,
  PRIMARY KEY (`id`),
  KEY `op_import_log_status_idx` (`status`),
  KEY `op_import_log_type_idx` (`type`),
  KEY `op_import_log_counter_idx` (`counter`),
  KEY `op_import_FKIndex1` (`import_id`),
  CONSTRAINT `op_import_ibfk_1` FOREIGN KEY (`import_id`) REFERENCES `op_import` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2532485 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_import_minint`
--

DROP TABLE IF EXISTS `op_import_minint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_import_minint` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agg_date` varchar(8) NOT NULL DEFAULT '00000000',
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `op_import_minint_date_idx` (`agg_date`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_import_modifications`
--

DROP TABLE IF EXISTS `op_import_modifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_import_modifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rec_type` varchar(3) NOT NULL,
  `context` varchar(10) NOT NULL,
  `csv_rec` varchar(255) NOT NULL,
  `blocked_at` datetime DEFAULT NULL,
  `concretised_at` datetime DEFAULT NULL,
  `import_id` int(10) unsigned DEFAULT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `action_type` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `import_modifications_idx` (`rec_type`,`csv_rec`,`import_id`),
  KEY `op_import_modifications_context_index` (`context`),
  KEY `op_import_modifications_import_id_index` (`import_id`),
  KEY `op_import_modifications_location_id_index` (`location_id`),
  CONSTRAINT `op_import_modifications_FK_1` FOREIGN KEY (`import_id`) REFERENCES `op_import_minint` (`id`) ON DELETE CASCADE,
  CONSTRAINT `op_import_modifications_FK_2` FOREIGN KEY (`location_id`) REFERENCES `op_location` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42743 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_import_similar`
--

DROP TABLE IF EXISTS `op_import_similar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_import_similar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `new_csv_rec` varchar(255) NOT NULL,
  `old_csv_rec` varchar(255) NOT NULL,
  `context` varchar(10) NOT NULL,
  `location_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleting_user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `import_similar_idx` (`new_csv_rec`,`old_csv_rec`),
  KEY `op_import_similar_new_csv_rec_index` (`new_csv_rec`),
  KEY `op_import_similar_old_csv_rec_index` (`old_csv_rec`),
  KEY `op_import_similar_location_id_index` (`location_id`),
  KEY `op_import_similar_deleting_user_id_index` (`deleting_user_id`),
  KEY `op_import_similar_context_index` (`context`),
  CONSTRAINT `op_import_similar_FK_1` FOREIGN KEY (`location_id`) REFERENCES `op_location` (`id`) ON DELETE CASCADE,
  CONSTRAINT `op_import_similar_FK_2` FOREIGN KEY (`deleting_user_id`) REFERENCES `op_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6531 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_import_type`
--

DROP TABLE IF EXISTS `op_import_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_import_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `op_import_type_name_idx` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_import_user_check`
--

DROP TABLE IF EXISTS `op_import_user_check`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_import_user_check` (
  `import_file` varchar(255) NOT NULL DEFAULT '',
  `import_log_counter` int(10) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`import_file`,`import_log_counter`),
  KEY `op_import_user_check_FK1` (`import_file`),
  KEY `op_import_user_check_FK2` (`import_log_counter`),
  KEY `op_import_user_check_FK3` (`user_id`),
  CONSTRAINT `op_import_user_check_FK_3` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_institution`
--

DROP TABLE IF EXISTS `op_institution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_institution` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `short_name` varchar(45) DEFAULT NULL,
  `priority` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_institution_charge`
--

DROP TABLE IF EXISTS `op_institution_charge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_institution_charge` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `politician_id` int(10) unsigned NOT NULL DEFAULT '0',
  `institution_id` int(10) unsigned NOT NULL DEFAULT '0',
  `charge_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned DEFAULT NULL,
  `constituency_id` int(10) unsigned DEFAULT NULL,
  `party_id` int(10) unsigned DEFAULT '1',
  `group_id` int(10) unsigned DEFAULT '1',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `minint_verified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `op_institution_charge_FKIndex1` (`content_id`),
  KEY `op_institution_charge_FKIndex2` (`institution_id`),
  KEY `op_institution_charge_FKIndex3` (`charge_type_id`),
  KEY `op_institution_charge_FKIndex4` (`group_id`),
  KEY `op_institution_charge_FKIndex5` (`party_id`),
  KEY `op_institution_charge_FKIndex7` (`constituency_id`),
  KEY `op_institution_charge_FKIndex8` (`politician_id`),
  KEY `op_institution_charge_FKIndex9` (`location_id`),
  CONSTRAINT `op_institution_charge_ibfk_10` FOREIGN KEY (`politician_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_institution_charge_ibfk_2` FOREIGN KEY (`institution_id`) REFERENCES `op_institution` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_institution_charge_ibfk_3` FOREIGN KEY (`charge_type_id`) REFERENCES `op_charge_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_institution_charge_ibfk_4` FOREIGN KEY (`group_id`) REFERENCES `op_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_institution_charge_ibfk_5` FOREIGN KEY (`party_id`) REFERENCES `op_party` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_institution_charge_ibfk_6` FOREIGN KEY (`constituency_id`) REFERENCES `op_constituency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_institution_charge_ibfk_8` FOREIGN KEY (`location_id`) REFERENCES `op_location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_institution_charge_ibfk_9` FOREIGN KEY (`content_id`) REFERENCES `op_open_content` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_institution_has_charge_type`
--

DROP TABLE IF EXISTS `op_institution_has_charge_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_institution_has_charge_type` (
  `institution_id` int(10) unsigned NOT NULL DEFAULT '0',
  `charge_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`institution_id`,`charge_type_id`),
  KEY `op_institution_has_op_charge_type_FKIndex1` (`institution_id`),
  KEY `op_institution_has_op_charge_type_FKIndex2` (`charge_type_id`),
  CONSTRAINT `op_institution_has_charge_type_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `op_institution` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_institution_has_charge_type_ibfk_2` FOREIGN KEY (`charge_type_id`) REFERENCES `op_charge_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_loc_adoption`
--

DROP TABLE IF EXISTS `op_loc_adoption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_loc_adoption` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned NOT NULL DEFAULT '0',
  `requested_at` datetime DEFAULT NULL,
  `granted_at` datetime DEFAULT NULL,
  `revoked_at` datetime DEFAULT NULL,
  `refused_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`location_id`),
  KEY `op_loc_adopt_FKIndex1` (`user_id`),
  KEY `op_loc_adopt_FKIndex2` (`location_id`),
  CONSTRAINT `op_loc_adopt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `op_loc_adopt_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `op_location` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_location`
--

DROP TABLE IF EXISTS `op_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `macroregional_id` int(10) unsigned DEFAULT NULL,
  `regional_id` int(10) unsigned DEFAULT NULL,
  `provincial_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `prov` varchar(2) DEFAULT NULL,
  `inhabitants` int(10) unsigned DEFAULT NULL,
  `last_charge_update` datetime DEFAULT NULL,
  `alternative_name` varchar(255) DEFAULT NULL,
  `minint_regional_code` int(10) unsigned DEFAULT NULL,
  `minint_provincial_code` int(10) unsigned DEFAULT NULL,
  `minint_city_code` int(10) unsigned DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `new_location_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `op_location_FKIndex1` (`location_type_id`),
  KEY `op_location_regional_id` (`regional_id`),
  KEY `op_location_provincial_id` (`provincial_id`),
  KEY `op_location_name` (`name`),
  KEY `op_location_prov` (`prov`),
  KEY `op_location_city_id_idx` (`city_id`),
  KEY `op_location_minint_regional_idx` (`minint_regional_code`),
  KEY `op_location_minint_provincial_idx` (`minint_provincial_code`),
  KEY `op_location_minint_city_idx` (`minint_city_code`),
  CONSTRAINT `op_location_ibfk_1` FOREIGN KEY (`location_type_id`) REFERENCES `op_location_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8242 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_location_type`
--

DROP TABLE IF EXISTS `op_location_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_location_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_message`
--

DROP TABLE IF EXISTS `op_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `body_html` text,
  `archive_status` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_status` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `op_message_FKIndex1` (`user_id`),
  CONSTRAINT `op_message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_obscured_content`
--

DROP TABLE IF EXISTS `op_obscured_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_obscured_content` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `reason` text,
  PRIMARY KEY (`user_id`,`content_id`),
  KEY `op_obscured_content_FKIndex1` (`content_id`),
  KEY `op_obscured_content_FKIndex2` (`user_id`),
  CONSTRAINT `op_obscured_content_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_obscured_content_ibfk_3` FOREIGN KEY (`content_id`) REFERENCES `op_open_content` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_open_content`
--

DROP TABLE IF EXISTS `op_open_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_open_content` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `open_content_FKIndex1` (`content_id`),
  KEY `op_open_content_FKIndex2` (`user_id`),
  KEY `op_open_content_user_index` (`user_id`),
  CONSTRAINT `op_open_content_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_open_content_ibfk_3` FOREIGN KEY (`content_id`) REFERENCES `op_content` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_opinable_content`
--

DROP TABLE IF EXISTS `op_opinable_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_opinable_content` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`),
  KEY `op_opinable_content_FKIndex1` (`content_id`),
  CONSTRAINT `op_opinable_content_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `op_open_content` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_organization`
--

DROP TABLE IF EXISTS `op_organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_organization` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=487 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_organization_charge`
--

DROP TABLE IF EXISTS `op_organization_charge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_organization_charge` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `politician_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `charge_name` varchar(255) DEFAULT NULL,
  `organization_id` int(10) unsigned DEFAULT NULL,
  `current` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `organization_charge_FKIndex1` (`content_id`),
  KEY `organization_charge_FKIndex2` (`politician_id`),
  KEY `op_organization_charge_FKIndex3` (`organization_id`),
  CONSTRAINT `op_organization_charge_ibfk_3` FOREIGN KEY (`organization_id`) REFERENCES `op_organization` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_organization_charge_ibfk_4` FOREIGN KEY (`content_id`) REFERENCES `op_open_content` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_organization_charge_ibfk_5` FOREIGN KEY (`politician_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_organization_has_op_organization_tag`
--

DROP TABLE IF EXISTS `op_organization_has_op_organization_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_organization_has_op_organization_tag` (
  `organization_tag_id` int(10) unsigned NOT NULL DEFAULT '0',
  `organization_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`organization_id`,`organization_tag_id`),
  KEY `op_organization_has_op_organization_tag_FKIndex1` (`organization_id`),
  KEY `op_organization_has_op_organization_tag_FKIndex2` (`organization_tag_id`),
  CONSTRAINT `op_organization_has_op_organization_tag_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `op_organization` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_organization_has_op_organization_tag_ibfk_2` FOREIGN KEY (`organization_tag_id`) REFERENCES `op_organization_tag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_organization_tag`
--

DROP TABLE IF EXISTS `op_organization_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_organization_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=466 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_party`
--

DROP TABLE IF EXISTS `op_party`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_party` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `istat_code` varchar(15) DEFAULT NULL,
  `name` varchar(80) NOT NULL DEFAULT '',
  `acronym` varchar(20) DEFAULT NULL,
  `party` tinyint(1) unsigned DEFAULT '0',
  `main` tinyint(1) unsigned DEFAULT '0',
  `electoral` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `oid` int(10) unsigned DEFAULT NULL,
  `oname` varchar(80) DEFAULT NULL,
  `logo` mediumblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `op_party_name_idx` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=759 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_party_location`
--

DROP TABLE IF EXISTS `op_party_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_party_location` (
  `party_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`party_id`,`location_id`),
  KEY `op_party_has_op_location_FKIndex1` (`party_id`),
  KEY `op_party_has_op_location_FKIndex2` (`location_id`),
  CONSTRAINT `op_party_location_ibfk_1` FOREIGN KEY (`party_id`) REFERENCES `op_party` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_party_location_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `op_location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_phase_type`
--

DROP TABLE IF EXISTS `op_phase_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_phase_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_pol_adoption`
--

DROP TABLE IF EXISTS `op_pol_adoption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_pol_adoption` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `politician_id` int(10) unsigned NOT NULL DEFAULT '0',
  `requested_at` datetime DEFAULT NULL,
  `granted_at` datetime DEFAULT NULL,
  `revoked_at` datetime DEFAULT NULL,
  `refused_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`politician_id`),
  KEY `op_pol_adopt_FKIndex1` (`user_id`),
  KEY `op_pol_adopt_FKIndex2` (`politician_id`),
  CONSTRAINT `op_pol_adopt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `op_pol_adopt_ibfk_2` FOREIGN KEY (`politician_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_political_charge`
--

DROP TABLE IF EXISTS `op_political_charge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_political_charge` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `charge_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `politician_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned NOT NULL DEFAULT '0',
  `party_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `current` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `op_political_charge_FKIndex1` (`content_id`),
  KEY `op_political_charge_FKIndex2` (`party_id`),
  KEY `op_political_charge_FKIndex3` (`location_id`),
  KEY `op_political_charge_FKIndex4` (`politician_id`),
  KEY `op_political_charge_FKIndex5` (`charge_type_id`),
  CONSTRAINT `op_political_charge_ibfk_2` FOREIGN KEY (`party_id`) REFERENCES `op_party` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_political_charge_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `op_location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_political_charge_ibfk_5` FOREIGN KEY (`charge_type_id`) REFERENCES `op_charge_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_political_charge_ibfk_6` FOREIGN KEY (`content_id`) REFERENCES `op_open_content` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_political_charge_ibfk_7` FOREIGN KEY (`politician_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_politician`
--

DROP TABLE IF EXISTS `op_politician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_politician` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `profession_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `picture` longblob,
  `birth_date` datetime DEFAULT NULL,
  `birth_location` varchar(128) DEFAULT NULL,
  `death_date` datetime DEFAULT NULL,
  `last_charge_update` datetime DEFAULT NULL,
  `is_indexed` tinyint(4) NOT NULL DEFAULT '0',
  `minint_aka` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  UNIQUE KEY `op_politician_minint_aka_idx` (`minint_aka`),
  KEY `op_politician_FKIndex1` (`content_id`),
  KEY `op_politician_FKIndex2` (`user_id`),
  KEY `op_politician_FKIndex3` (`profession_id`),
  KEY `op_politician_first_name` (`first_name`),
  KEY `op_politician_last_name` (`last_name`),
  KEY `op_politician_indexed_idx` (`is_indexed`),
  CONSTRAINT `op_politician_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_politician_ibfk_3` FOREIGN KEY (`profession_id`) REFERENCES `op_profession` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_politician_ibfk_4` FOREIGN KEY (`content_id`) REFERENCES `op_content` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_politician_has_op_education_level`
--

DROP TABLE IF EXISTS `op_politician_has_op_education_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_politician_has_op_education_level` (
  `politician_id` int(10) unsigned NOT NULL DEFAULT '0',
  `education_level_id` int(10) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`politician_id`,`education_level_id`),
  KEY `op_politician_has_op_education_level_FKIndex1` (`politician_id`),
  KEY `op_politician_has_op_education_level_FKIndex2` (`education_level_id`),
  CONSTRAINT `op_politician_has_op_education_level_ibfk_1` FOREIGN KEY (`politician_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_politician_has_op_education_level_ibfk_2` FOREIGN KEY (`education_level_id`) REFERENCES `op_education_level` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_proc_phase`
--

DROP TABLE IF EXISTS `op_proc_phase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_proc_phase` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `phase_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `procedimento_id` int(10) unsigned NOT NULL DEFAULT '0',
  `punishment` text,
  `motivation` text,
  `source_name` varchar(255) DEFAULT NULL,
  `source_url` varchar(255) DEFAULT NULL,
  `source_attach` blob,
  `phase_year` int(10) unsigned DEFAULT NULL,
  `tribunal_location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `op_proc_phase_FKIndex1` (`procedimento_id`),
  KEY `op_proc_phase_FKIndex2` (`phase_type_id`),
  KEY `op_proc_phase_FKIndex3` (`status_type_id`),
  CONSTRAINT `op_proc_phase_ibfk_1` FOREIGN KEY (`procedimento_id`) REFERENCES `op_procedimento` (`content_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `op_proc_phase_ibfk_2` FOREIGN KEY (`phase_type_id`) REFERENCES `op_phase_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_proc_phase_ibfk_3` FOREIGN KEY (`status_type_id`) REFERENCES `op_status_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_procedimento`
--

DROP TABLE IF EXISTS `op_procedimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_procedimento` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `politician_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `description` text,
  `alleged_crimes` text,
  PRIMARY KEY (`content_id`),
  KEY `op_procedimento_FKIndex1` (`content_id`),
  KEY `op_procedimento_FKIndex2` (`politician_id`),
  CONSTRAINT `op_procedimento_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `op_opinable_content` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_procedimento_ibfk_2` FOREIGN KEY (`politician_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_profession`
--

DROP TABLE IF EXISTS `op_profession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_profession` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `oid` int(10) unsigned DEFAULT NULL,
  `odescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `op_profession_description_idx` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=382 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_relevancy`
--

DROP TABLE IF EXISTS `op_relevancy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_relevancy` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`content_id`,`user_id`),
  KEY `relevancy_FKIndex1` (`user_id`),
  KEY `relevancy_FKIndex2` (`content_id`),
  CONSTRAINT `op_relevancy_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_relevancy_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `op_opinable_content` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_relevancy_comment`
--

DROP TABLE IF EXISTS `op_relevancy_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_relevancy_comment` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `comment_id` int(10) unsigned NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`comment_id`),
  KEY `op_relevancy_comment_FKIndex1` (`user_id`),
  KEY `op_relevancy_comment_FKIndex2` (`comment_id`),
  CONSTRAINT `op_relevancy_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_relevancy_comment_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `op_comment` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_report`
--

DROP TABLE IF EXISTS `op_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_report` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `notes` text,
  `report_type` char(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`content_id`),
  KEY `op_report_FKIndex1` (`user_id`),
  KEY `op_report_FKIndex2` (`content_id`),
  CONSTRAINT `op_report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_report_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `op_content` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_required_funds`
--

DROP TABLE IF EXISTS `op_required_funds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_required_funds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `donors` int(10) DEFAULT NULL,
  `needed` int(10) NOT NULL DEFAULT '0',
  `raised` int(10) DEFAULT '0',
  `spent` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_requiring_user`
--

DROP TABLE IF EXISTS `op_requiring_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_requiring_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) DEFAULT NULL,
  `beta` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_resources`
--

DROP TABLE IF EXISTS `op_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_resources` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `politician_id` int(10) unsigned NOT NULL DEFAULT '0',
  `resources_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `valore` varchar(255) DEFAULT NULL,
  `descrizione` text,
  PRIMARY KEY (`content_id`),
  KEY `op_resources_FKIndex1` (`content_id`),
  KEY `op_resources_FKIndex2` (`resources_type_id`),
  KEY `op_resources_FKIndex3` (`politician_id`),
  CONSTRAINT `op_resources_ibfk_4` FOREIGN KEY (`content_id`) REFERENCES `op_open_content` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_resources_ibfk_5` FOREIGN KEY (`politician_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_resources_ibfk_6` FOREIGN KEY (`resources_type_id`) REFERENCES `op_resources_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_resources_type`
--

DROP TABLE IF EXISTS `op_resources_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_resources_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_type` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_schema_migrations`
--

DROP TABLE IF EXISTS `op_schema_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_schema_migrations` (
  `version` varchar(255) NOT NULL,
  UNIQUE KEY `op_unique_schema_migrations` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_session`
--

DROP TABLE IF EXISTS `op_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_session` (
  `sess_id` varchar(32) NOT NULL DEFAULT '',
  `sess_data` text NOT NULL,
  `sess_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sess_id`),
  KEY `sess_time_idx` (`sess_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_similar_politician`
--

DROP TABLE IF EXISTS `op_similar_politician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_similar_politician` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_id` int(10) unsigned NOT NULL,
  `similar_id` int(10) unsigned NOT NULL,
  `is_resolved` tinyint(4) NOT NULL DEFAULT '0',
  `compares_birth_locations` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `op_similar_politician_original_id_index` (`original_id`),
  KEY `op_similar_politician_similar_id_index` (`similar_id`),
  KEY `op_similar_politician_user_id_index` (`user_id`),
  CONSTRAINT `op_similar_politician_FK_1` FOREIGN KEY (`original_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_similar_politician_FK_2` FOREIGN KEY (`similar_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_similar_politician_FK_3` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=786 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_status_type`
--

DROP TABLE IF EXISTS `op_status_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_status_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_tag`
--

DROP TABLE IF EXISTS `op_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(80) NOT NULL DEFAULT '',
  `normalized_tag` varchar(80) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `op_normalized_tag_idx` (`normalized_tag`)
) ENGINE=InnoDB AUTO_INCREMENT=4203 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_tag_has_op_opinable_content`
--

DROP TABLE IF EXISTS `op_tag_has_op_opinable_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_tag_has_op_opinable_content` (
  `tag_id` int(10) unsigned NOT NULL DEFAULT '0',
  `opinable_content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `is_obscured` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`tag_id`,`opinable_content_id`),
  KEY `op_tag_has_op_opinable_content_FKIndex1` (`tag_id`),
  KEY `op_tag_has_op_opinable_content_FKIndex2` (`opinable_content_id`),
  KEY `op_tag_has_op_opinable_content_FKIndex3` (`user_id`),
  CONSTRAINT `op_tag_has_op_opinable_content_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `op_tag_has_op_opinable_content_ibfk_4` FOREIGN KEY (`opinable_content_id`) REFERENCES `op_opinable_content` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_tag_has_op_opinable_content_ibfk_5` FOREIGN KEY (`tag_id`) REFERENCES `op_tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_tax_declaration`
--

DROP TABLE IF EXISTS `op_tax_declaration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_tax_declaration` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `politician_id` int(10) unsigned NOT NULL DEFAULT '0',
  `year` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`content_id`),
  KEY `op_tax_declaration_FI_2` (`politician_id`),
  CONSTRAINT `op_tax_declaration_FK_1` FOREIGN KEY (`content_id`) REFERENCES `op_content` (`id`) ON DELETE CASCADE,
  CONSTRAINT `op_tax_declaration_FK_2` FOREIGN KEY (`politician_id`) REFERENCES `op_politician` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_theme`
--

DROP TABLE IF EXISTS `op_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_theme` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `relevancy_score` int(10) DEFAULT '0',
  `vsq08` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  UNIQUE KEY `op_theme_idx` (`title`),
  KEY `op_theme_FKIndex1` (`content_id`),
  CONSTRAINT `op_theme_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `op_opinable_content` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_theme_has_declaration`
--

DROP TABLE IF EXISTS `op_theme_has_declaration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_theme_has_declaration` (
  `declaration_id` int(10) unsigned NOT NULL DEFAULT '0',
  `theme_id` int(10) unsigned NOT NULL DEFAULT '0',
  `party_id` int(10) unsigned DEFAULT NULL,
  `position` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`declaration_id`,`theme_id`),
  KEY `op_theme_has_declaration_FKIndex1` (`declaration_id`),
  KEY `op_theme_has_declaration_FKIndex2` (`theme_id`),
  KEY `op_theme_has_declaration_FKIndex3` (`party_id`),
  CONSTRAINT `op_theme_has_declaration_FK_1` FOREIGN KEY (`declaration_id`) REFERENCES `op_declaration` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_theme_has_declaration_FK_2` FOREIGN KEY (`theme_id`) REFERENCES `op_theme` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_theme_has_declaration_FK_3` FOREIGN KEY (`party_id`) REFERENCES `op_party` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_theme_has_location`
--

DROP TABLE IF EXISTS `op_theme_has_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_theme_has_location` (
  `theme_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`theme_id`,`location_id`),
  KEY `op_theme_has_location_FKIndex1` (`theme_id`),
  KEY `op_theme_has_location_FKIndex2` (`location_id`),
  CONSTRAINT `op_theme_has_location_FK_1` FOREIGN KEY (`theme_id`) REFERENCES `op_theme` (`content_id`) ON DELETE CASCADE,
  CONSTRAINT `op_theme_has_location_FK_2` FOREIGN KEY (`location_id`) REFERENCES `op_location` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_user`
--

DROP TABLE IF EXISTS `op_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_user` (
  `id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `nickname` varchar(16) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `sha1_password` varchar(40) DEFAULT NULL,
  `salt` varchar(32) DEFAULT NULL,
  `want_to_be_moderator` int(10) unsigned DEFAULT '0',
  `is_moderator` int(10) unsigned DEFAULT '0',
  `is_administrator` int(10) unsigned DEFAULT '0',
  `deletions` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `picture` longblob,
  `url_personal_website` varchar(255) DEFAULT NULL,
  `notes` text,
  `has_paypal` int(10) unsigned DEFAULT '0',
  `remember_key` varchar(64) DEFAULT NULL,
  `wants_newsletter` tinyint(4) NOT NULL DEFAULT '0',
  `public_name` tinyint(1) NOT NULL DEFAULT '1',
  `charges` int(10) DEFAULT '0',
  `resources` int(10) DEFAULT '0',
  `declarations` int(10) DEFAULT '0',
  `themes` int(10) DEFAULT '0',
  `comments` int(10) DEFAULT '0',
  `last_contribution` datetime DEFAULT NULL,
  `is_premium` int(11) DEFAULT NULL,
  `is_adhoc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `op_user_sha1_idx` (`sha1_password`),
  KEY `op_user_FKIndex1` (`location_id`),
  CONSTRAINT `op_user_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `op_location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `op_verified_content`
--

DROP TABLE IF EXISTS `op_verified_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_verified_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `content_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `operation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `op_verified_content_user_id_index` (`user_id`),
  KEY `op_verified_content_content_id_index` (`content_id`),
  CONSTRAINT `op_verified_content_FK_1` FOREIGN KEY (`user_id`) REFERENCES `op_user` (`id`),
  CONSTRAINT `op_verified_content_FK_2` FOREIGN KEY (`content_id`) REFERENCES `op_open_content` (`content_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `piston_consumer`
--

DROP TABLE IF EXISTS `piston_consumer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `piston_consumer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `key` varchar(18) NOT NULL,
  `secret` varchar(32) NOT NULL,
  `status` varchar(16) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `piston_consumer_fbfc09f1` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `piston_nonce`
--

DROP TABLE IF EXISTS `piston_nonce`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `piston_nonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token_key` varchar(18) NOT NULL,
  `consumer_key` varchar(18) NOT NULL,
  `key` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `piston_resource`
--

DROP TABLE IF EXISTS `piston_resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `piston_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` longtext NOT NULL,
  `is_readonly` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `piston_token`
--

DROP TABLE IF EXISTS `piston_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `piston_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(18) NOT NULL,
  `secret` varchar(32) NOT NULL,
  `token_type` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `consumer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `piston_token_fbfc09f1` (`user_id`),
  KEY `piston_token_6565fc20` (`consumer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-05-12 12:39:37
