-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: 192.168.254.4    Database: channels
-- ------------------------------------------------------
-- Server version	5.5.60-0+deb8u1-log

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
-- Table structure for table `ackeys`
--

DROP TABLE IF EXISTS `ackeys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ackeys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `value` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `visible` tinyint(1) DEFAULT '1',
  `pos` int(11) DEFAULT '500',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `visible` (`visible`),
  KEY `pos` (`pos`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='AC Keys table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bands`
--

DROP TABLE IF EXISTS `bands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(8) COLLATE utf8_hungarian_ci NOT NULL,
  `band` varchar(6) COLLATE utf8_hungarian_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '''0''',
  `broadcast` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `frequency` decimal(10,2) NOT NULL,
  `bandwidth` int(10) unsigned NOT NULL,
  `audio_frequency` decimal(10,2) NOT NULL,
  `visible` tinyint(1) unsigned DEFAULT '1',
  `pos` int(11) DEFAULT '500',
  `packages_programs_analog_count` int(10) unsigned DEFAULT '0',
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pos` (`pos`),
  KEY `broadcast` (`broadcast`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cake_d_c_users_phinxlog`
--

DROP TABLE IF EXISTS `cake_d_c_users_phinxlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cake_d_c_users_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `headstation_id` int(10) unsigned NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `comment` text COLLATE utf8_hungarian_ci,
  `visible` tinyint(1) unsigned DEFAULT '1',
  `pos` int(11) DEFAULT '500',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `headstation_id` (`headstation_id`),
  KEY `visible` (`visible`),
  KEY `pos` (`pos`)
) ENGINE=InnoDB AUTO_INCREMENT=39001 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Települések';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` int(10) unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `program_count` int(10) unsigned DEFAULT '0',
  `visible` tinyint(1) unsigned DEFAULT '1',
  `pos` int(11) DEFAULT '500',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key_name` (`name`),
  KEY `visible` (`visible`),
  KEY `pos` (`pos`),
  KEY `version_id` (`version_id`)
) ENGINE=InnoDB AUTO_INCREMENT=282 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Műsor jellegek (gyerek műsor, kereskedelmi, stc...)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `headstations`
--

DROP TABLE IF EXISTS `headstations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `headstations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `place` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `last_sentence` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `last_digital_sentence` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `comment` text COLLATE utf8_hungarian_ci,
  `package_count` int(10) unsigned DEFAULT '0',
  `city_count` int(10) unsigned DEFAULT '0',
  `visible` tinyint(1) unsigned DEFAULT '1',
  `pos` int(11) DEFAULT '500',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `visible` (`visible`),
  KEY `pos` (`pos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Fejállomások';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `visible` tinyint(1) unsigned DEFAULT '1',
  `pos` int(11) DEFAULT '500',
  `program_count` int(10) unsigned DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `visible2` (`visible`),
  KEY `pos2` (`pos`),
  KEY `version_id` (`version_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Languages table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned DEFAULT NULL,
  `model_name` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `name` varchar(300) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `comment` text COLLATE utf8_hungarian_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `multicast_sources`
--

DROP TABLE IF EXISTS `multicast_sources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multicast_sources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` int(10) unsigned NOT NULL,
  `name` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `comment` text COLLATE utf8_hungarian_ci,
  `src_ip` varchar(15) COLLATE utf8_hungarian_ci NOT NULL,
  `dest_ip` varchar(15) COLLATE utf8_hungarian_ci NOT NULL,
  `port` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `interface` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `provider` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `visible` tinyint(1) unsigned DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `programs_count` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `multicast_address` (`dest_ip`),
  KEY `source_address` (`src_ip`),
  KEY `port` (`port`),
  KEY `interface` (`interface`),
  KEY `pos` (`visible`),
  KEY `visible` (`pos`),
  KEY `version_id` (`version_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Multicast sources table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `packagegroups`
--

DROP TABLE IF EXISTS `packagegroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packagegroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `visible` tinyint(1) unsigned NOT NULL,
  `pos` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Csomag csoportok';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` int(10) unsigned DEFAULT NULL,
  `headstation_id` int(10) unsigned DEFAULT NULL,
  `packagegroup_id` int(10) unsigned NOT NULL,
  `encoded` varchar(20) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `broadcast` varchar(10) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `shortname` varchar(200) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `popular_name` varchar(200) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `external_name` varchar(200) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `comment` text COLLATE utf8_hungarian_ci,
  `popular_comment_analog` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `popular_comment_digital` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `price` int(10) unsigned DEFAULT NULL,
  `visible` tinyint(1) unsigned DEFAULT '1',
  `pos` int(10) DEFAULT '500',
  `packages_programs_analog_count` int(10) unsigned NOT NULL DEFAULT '0',
  `packages_programs_digital_count` int(10) unsigned NOT NULL DEFAULT '0',
  `program_count` int(10) unsigned DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `headstation_id` (`headstation_id`),
  KEY `visible` (`visible`),
  KEY `version_id` (`version_id`),
  KEY `packages_count` (`program_count`),
  KEY `packagegroup_id` (`packagegroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Csomagok';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `packages_programs_analogs`
--

DROP TABLE IF EXISTS `packages_programs_analogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages_programs_analogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` int(10) unsigned DEFAULT NULL,
  `package_id` int(10) unsigned DEFAULT NULL,
  `program_id` int(10) unsigned DEFAULT NULL,
  `band_id` int(11) DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `lcn` int(10) unsigned DEFAULT NULL,
  `comment` text COLLATE utf8_hungarian_ci,
  `public_comment` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `changed` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `to_delete` tinyint(1) unsigned DEFAULT '0',
  `visible` tinyint(1) unsigned DEFAULT '1',
  `pos` int(11) DEFAULT '500',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `program_id` (`program_id`),
  KEY `package_id` (`package_id`),
  KEY `version_id` (`version_id`),
  KEY `pos` (`pos`),
  KEY `visible` (`visible`),
  KEY `band_id_2` (`band_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1936 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Csatornák (Melyik műsor, melyik csomagban van))';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `packages_programs_digitals`
--

DROP TABLE IF EXISTS `packages_programs_digitals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages_programs_digitals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` int(10) unsigned DEFAULT NULL,
  `package_id` int(10) unsigned DEFAULT NULL,
  `program_id` int(10) unsigned DEFAULT NULL,
  `ackey_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `short_name` varchar(10) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `lcn` int(10) unsigned DEFAULT NULL,
  `channel` varchar(20) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `frequency` decimal(10,2) DEFAULT NULL,
  `qam` varchar(10) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `sid` int(10) unsigned DEFAULT NULL,
  `comment` text COLLATE utf8_hungarian_ci,
  `public_comment` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `changed` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `to_delete` tinyint(1) unsigned DEFAULT '0',
  `visible` tinyint(1) unsigned DEFAULT '1',
  `pos` int(11) DEFAULT '500',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `program_id` (`program_id`),
  KEY `package_id` (`package_id`),
  KEY `version_id` (`version_id`),
  KEY `pos` (`pos`),
  KEY `visible` (`visible`),
  KEY `ackey_id` (`ackey_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2172 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Csatornák (Melyik műsor, melyik csomagban van))';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` int(10) unsigned NOT NULL,
  `feature_id` int(10) unsigned DEFAULT NULL,
  `language_id` int(10) unsigned DEFAULT NULL,
  `multicast_source_id` int(10) unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `short_name` varchar(10) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `logo_file` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `logo_url` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `programs_url` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `address` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `comment` text COLLATE utf8_hungarian_ci,
  `new` tinyint(1) unsigned DEFAULT '1',
  `visible` tinyint(1) unsigned DEFAULT '1',
  `pos` int(11) DEFAULT '500',
  `packages_programs_analog_count` int(10) unsigned NOT NULL DEFAULT '0',
  `packages_programs_digital_count` int(10) unsigned NOT NULL DEFAULT '0',
  `package_count` int(10) unsigned DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `feature_id_2` (`feature_id`),
  KEY `language_id` (`language_id`),
  KEY `version_id` (`version_id`),
  KEY `visible` (`visible`),
  KEY `pos` (`pos`),
  KEY `multicast_source_id` (`multicast_source_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1718 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Programok, műsorok';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `social_accounts`
--

DROP TABLE IF EXISTS `social_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_accounts` (
  `id` char(36) COLLATE utf8_hungarian_ci NOT NULL,
  `user_id` char(36) COLLATE utf8_hungarian_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `description` text COLLATE utf8_hungarian_ci,
  `link` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `token` varchar(500) COLLATE utf8_hungarian_ci NOT NULL,
  `token_secret` varchar(500) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `data` text COLLATE utf8_hungarian_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `social_accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trackings`
--

DROP TABLE IF EXISTS `trackings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trackings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `old_id` int(10) unsigned NOT NULL,
  `new_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `created` (`created`),
  KEY `version_id` (`version_id`,`old_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1371 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Verziókövetés az ID-k miatt';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8_hungarian_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `activation_date` datetime DEFAULT NULL,
  `secret` varchar(32) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `secret_verified` tinyint(1) DEFAULT NULL,
  `tos_date` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_superuser` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(255) COLLATE utf8_hungarian_ci DEFAULT 'user',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `additional_data` text COLLATE utf8_hungarian_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `versions`
--

DROP TABLE IF EXISTS `versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `versions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `headstation_id` int(10) unsigned NOT NULL,
  `broadcast` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `comment` text COLLATE utf8_hungarian_ci,
  `current` tinyint(1) unsigned DEFAULT '0',
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `visible` tinyint(1) unsigned DEFAULT '1',
  `pos` int(11) DEFAULT '500',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `created` (`created`),
  KEY `modified` (`modified`),
  KEY `current` (`current`),
  KEY `date_from` (`date_from`),
  KEY `date_to` (`date_to`),
  KEY `visible` (`visible`),
  KEY `pos` (`pos`),
  KEY `headstation_id` (`headstation_id`),
  KEY `broadcast` (`broadcast`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Channels versions table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'channels'
--

--
-- Dumping routines for database 'channels'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-24 13:45:38
