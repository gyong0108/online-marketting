/*
SQLyog Community v12.4.3 (32 bit)
MySQL - 10.1.34-MariaDB : Database - core4
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`core4` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `core4`;

/*Table structure for table `campaigns` */

DROP TABLE IF EXISTS `campaigns`;

CREATE TABLE `campaigns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `daily_budget` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `undertitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortdescription` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `switch` enum('On','Off') COLLATE utf8mb4_unicode_ci DEFAULT 'On',
  `location_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lanugage` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'DE',
  `negatives` text COLLATE utf8mb4_unicode_ci,
  `final_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campaigns_deleted_at_index` (`deleted_at`),
  KEY `214972_5bb4c721d24a3` (`created_by_id`),
  CONSTRAINT `214972_5bb4c721d24a3` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `campaigns` */

insert  into `campaigns`(`id`,`daily_budget`,`title`,`undertitle`,`shortdescription`,`description`,`logo`,`image`,`email`,`active`,`created_at`,`updated_at`,`deleted_at`,`created_by_id`,`name`,`keywords`,`switch`,`location_address`,`location_latitude`,`location_longitude`,`lanugage`,`negatives`,`final_url`) values 
(1,10,'title1','12345678901234567890','123456789012345678901234567890123456789012345678901234567890','12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',NULL,NULL,NULL,0,'2018-10-08 18:17:24','2018-10-08 18:17:24',NULL,2,'Online Marketing','Online Marketing, Marketing Online, Online Marketing München','Off',NULL,NULL,NULL,'DE','123, 4566,sddd','this is final url'),
(2,20,'title2','title3','4564654654','465465','45','46','4654654',1,NULL,NULL,NULL,1,'888999','6446546\r\n','On',NULL,NULL,NULL,'DE',NULL,'this is final url');

/*Table structure for table `internal_notification_user` */

DROP TABLE IF EXISTS `internal_notification_user`;

CREATE TABLE `internal_notification_user` (
  `internal_notification_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `fk_p_214592_214590_user_i_5bb373742a166` (`internal_notification_id`),
  KEY `fk_p_214590_214592_intern_5bb373742a1ff` (`user_id`),
  CONSTRAINT `fk_p_214590_214592_intern_5bb373742a1ff` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_p_214592_214590_user_i_5bb373742a166` FOREIGN KEY (`internal_notification_id`) REFERENCES `internal_notifications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `internal_notification_user` */

/*Table structure for table `internal_notifications` */

DROP TABLE IF EXISTS `internal_notifications`;

CREATE TABLE `internal_notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `internal_notifications` */

/*Table structure for table `invoice_data` */

DROP TABLE IF EXISTS `invoice_data`;

CREATE TABLE `invoice_data` (
  `company` varchar(255) NOT NULL,
  `street_no` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `created_by_id` int(12) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `invoice_data` */

insert  into `invoice_data`(`company`,`street_no`,`city`,`state`,`country`,`zip`,`tax_id`,`created_by_id`,`created_at`,`updated_at`,`id`) values 
('FSOM','Radelkoferstr. 33','München','Bayern','Deutschland','80336','',2,'2018-08-06 17:59:14','2018-08-06 17:59:14',1),
('xycyx','xycyxc','yxc','yxc','yxc','yxc','yxc',4,'2018-08-15 23:54:10','2018-08-15 23:54:10',2);

/*Table structure for table `invoices` */

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `company` varchar(255) NOT NULL,
  `street_no` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `created_by_id` int(12) unsigned NOT NULL,
  `amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` int(12) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `invoices` */

insert  into `invoices`(`company`,`street_no`,`city`,`state`,`country`,`zip`,`tax_id`,`created_by_id`,`amount`,`created_at`,`updated_at`,`id`,`payment_id`) values 
('FSOM','Radelkoferstr. 33','München','Bayern','Deutschland','80336','',2,50,'2018-08-06 18:09:33','2018-08-06 18:09:33',1,1),
('FSOM','Radelkoferstr. 33','München','Bayern','Deutschland','80336','',2,50,'2018-08-11 06:29:32','2018-08-11 06:29:32',2,20);

/*Table structure for table `leads` */

DROP TABLE IF EXISTS `leads`;

CREATE TABLE `leads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `formdata` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `adgroup_id` int(10) unsigned DEFAULT NULL,
  `status_id` int(10) unsigned DEFAULT NULL,
  `created_by_id` int(10) unsigned DEFAULT NULL,
  `is_newsletter` int(1) DEFAULT '0',
  `contact_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_deleted_at_index` (`deleted_at`),
  KEY `177977_5b337cf57cbcc` (`adgroup_id`),
  KEY `177977_5b3b61538a096` (`status_id`),
  KEY `177977_5b337cf5af08c` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `leads` */

insert  into `leads`(`id`,`name`,`email`,`phone`,`notes`,`formdata`,`created_at`,`updated_at`,`deleted_at`,`adgroup_id`,`status_id`,`created_by_id`,`is_newsletter`,`contact_id`) values 
(1,NULL,NULL,NULL,'','{\"page_token\":\"MjAxOC0wOC0xMyAxMjoyODozOCYy\",\"tag\":\"Anfrage\",\"uuid\":\"a6bb62c2-dd40-4ca3-878d-e0f46c4920d7\",\"newsletter\":\"false\",\"first_name\":\"Denis\",\"surname\":\"Hausdhfiuh\",\"email\":\"sdgsdf@sdf.de\",\"phone\":\"556767\",\"message\":\"sfgsdf\"}','2018-08-13 03:33:19','2018-10-02 00:27:15',NULL,NULL,6,4,0,1),
(2,NULL,NULL,NULL,NULL,'{\"page_token\":\"MjAxOC0wOC0xMyAxMjoyODozOCYy\",\"tag\":\"Anfrage\",\"uuid\":\"a6bb62c2-dd40-4ca3-878d-e0f46c4920d7\",\"newsletter\":\"false\",\"first_name\":\"Denis\",\"surname\":\"Hausdhfiuh\",\"email\":\"sdgsdf@sdf.de\",\"phone\":\"556767\",\"message\":\"sfgsdf\"}','2018-08-13 03:33:27','2018-08-13 03:33:27',NULL,NULL,NULL,4,0,1),
(3,NULL,NULL,NULL,NULL,'{\"page_token\":\"MjAxOC0wOC0xMyAxMjoyODozOCYy\",\"tag\":\"Anfrage\",\"uuid\":\"a6bb62c2-dd40-4ca3-878d-e0f46c4920d7\",\"newsletter\":\"false\",\"first_name\":\"fgyxdf\",\"surname\":\"xc\",\"email\":\"fg@dsfd.de\",\"message\":\"cvxfg\"}','2018-08-13 03:33:44','2018-08-13 03:33:44',NULL,NULL,NULL,4,0,2);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2018_10_02_163045_create_1538487045_permissions_table',1),
(4,'2018_10_02_163047_create_1538487047_roles_table',1),
(5,'2018_10_02_163049_create_1538487049_users_table',1),
(6,'2018_10_02_163051_create_5bb3730892efd_permission_role_table',1),
(7,'2018_10_02_163053_create_5bb3730ad7eb6_role_user_table',1),
(8,'2018_10_02_163101_create_1538487060_user_actions_table',1),
(9,'2018_10_02_163102_add_5bb373170f78c_relationships_to_useraction_table',1),
(10,'2018_10_02_163157_update_1538487117_users_table',1),
(11,'2018_10_02_163158_custom_1538487118_approve_existing_users',1),
(12,'2018_10_02_163234_create_1538487154_internal_notifications_table',1),
(13,'2018_10_02_163238_create_5bb3737429fea_internal_notification_user_table',1),
(14,'2018_10_03_164153_create_1538574112_campaigns_table',1),
(15,'2018_10_03_164154_add_5bb4c722e4c85_relationships_to_campaign_table',1),
(16,'2018_10_03_164238_create_1538574157_keywords_table',1),
(17,'2018_10_03_164239_add_5bb4c74eeb969_relationships_to_keyword_table',1),
(18,'2018_10_03_164337_add_5bb4c7891067a_relationships_to_campaign_table',1),
(19,'2018_10_03_164339_create_5bb4c7882e1f5_campaign_keyword_table',1),
(20,'2018_10_03_165353_create_1538574832_requests_table',1),
(21,'2018_10_03_165354_add_5bb4c9f36416a_relationships_to_request_table',1),
(22,'2018_10_03_165623_create_1538574982_stripe_transactions_table',1),
(23,'2018_10_03_165624_add_5bb4ca88efa45_relationships_to_stripetransaction_table',1),
(24,'2018_10_03_165627_update_1538574987_users_table',1),
(25,'2018_10_03_165736_create_1538575055_payments_table',1),
(26,'2018_10_03_165737_add_5bb4cad1a2752_relationships_to_payment_table',1),
(27,'2018_10_03_165741_update_1538575061_roles_table',1),
(28,'2018_10_03_165744_update_1538575064_users_table',1),
(29,'2018_10_03_165806_add_5bb4caee795d2_relationships_to_keyword_table',1),
(30,'2018_10_03_165945_custom_1538575065_role_until',1),
(31,'2018_10_03_170543_add_5bb4ccb7977d7_relationships_to_campaign_table',1),
(32,'2018_10_03_170747_add_5bb4cd32f2091_relationships_to_request_table',1),
(33,'2018_10_03_170828_update_1538575708_campaigns_table',1),
(34,'2018_10_03_170830_add_5bb4cd5e1914f_relationships_to_campaign_table',1),
(35,'2018_10_03_171025_update_1538575825_campaigns_table',1),
(36,'2018_10_03_171026_drop_5bb4cdd26cc3a5bb4cdd26a464_campaign_keyword_table',1),
(37,'2018_10_03_171027_add_5bb4cdd374283_relationships_to_campaign_table',1),
(38,'2018_10_03_171036_drop_5bb4cddc0350d_keywords_table',1),
(39,'2018_10_03_171524_update_1538576124_requests_table',1),
(40,'2018_10_03_171525_add_5bb4cefd1bac1_relationships_to_request_table',1);

/*Table structure for table `negative_keywors` */

DROP TABLE IF EXISTS `negative_keywors`;

CREATE TABLE `negative_keywors` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `negative_keywors` */

insert  into `negative_keywors`(`id`,`keyword`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Job','2018-08-04 01:08:31','0000-00-00 00:00:00','0000-00-00 00:00:00'),
(2,'Manager','2018-08-04 01:08:31','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `partner` */

DROP TABLE IF EXISTS `partner`;

CREATE TABLE `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `asp` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `invoice_data` text,
  `css` text,
  `userid` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `partner` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `214978_5bb4cad0a93f2` (`user_id`),
  KEY `214978_5bb4cad0bade2` (`role_id`),
  CONSTRAINT `214978_5bb4cad0a93f2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `214978_5bb4cad0bade2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `payments` */

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  KEY `fk_p_214588_214589_role_p_5bb3730893004` (`permission_id`),
  KEY `fk_p_214589_214588_permis_5bb37308930c0` (`role_id`),
  CONSTRAINT `fk_p_214588_214589_role_p_5bb3730893004` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_p_214589_214588_permis_5bb37308930c0` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`permission_id`,`role_id`) values 
(1,1),
(7,1),
(8,1),
(9,1),
(10,1),
(11,1),
(12,1),
(13,1),
(14,1),
(15,1),
(16,1),
(17,1),
(18,1),
(19,1),
(20,1),
(21,1),
(22,1),
(23,1),
(24,1),
(25,1),
(26,1),
(28,1),
(29,1),
(30,1),
(31,1),
(32,1),
(38,1),
(39,1),
(40,1),
(41,1),
(42,1),
(43,1),
(44,1),
(45,1),
(46,1),
(47,1),
(48,1),
(49,1),
(50,1),
(51,1),
(52,1),
(53,1),
(54,1),
(55,1),
(56,1),
(57,1),
(58,1),
(59,1),
(60,1),
(61,1),
(62,1),
(2,1),
(3,1),
(4,1),
(5,1),
(6,1),
(17,2),
(18,2),
(19,2),
(20,2),
(22,2),
(23,2),
(24,2),
(25,2),
(28,2),
(39,2),
(43,2),
(44,2),
(45,2),
(46,2),
(48,2),
(49,2),
(50,2),
(51,2),
(53,2),
(54,2),
(55,2),
(56,2),
(58,2),
(59,2),
(60,2),
(61,2),
(2,2),
(3,2),
(4,2),
(5,2),
(28,3),
(29,3),
(30,3),
(31,3),
(32,3),
(39,3),
(28,4),
(29,4),
(30,4),
(31,4),
(32,4),
(39,4),
(28,5),
(29,5),
(30,5),
(31,5),
(32,5),
(39,5);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`title`,`created_at`,`updated_at`) values 
(1,'user_management_access','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(2,'permission_access','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(3,'permission_create','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(4,'permission_edit','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(5,'permission_view','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(6,'permission_delete','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(7,'role_access','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(8,'role_create','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(9,'role_edit','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(10,'role_view','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(11,'role_delete','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(12,'user_access','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(13,'user_create','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(14,'user_edit','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(15,'user_view','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(16,'user_delete','2018-10-08 18:17:22','2018-10-08 18:17:22'),
(17,'user_action_access','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(18,'user_action_create','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(19,'user_action_edit','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(20,'user_action_view','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(21,'user_action_delete','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(22,'internal_notification_access','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(23,'internal_notification_create','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(24,'internal_notification_edit','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(25,'internal_notification_view','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(26,'internal_notification_delete','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(28,'campaign_access','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(29,'campaign_create','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(30,'campaign_edit','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(31,'campaign_view','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(32,'campaign_delete','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(38,'request_access','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(39,'request_create','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(40,'request_edit','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(41,'request_view','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(42,'request_delete','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(43,'stripe_transaction_access','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(44,'stripe_transaction_create','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(45,'stripe_transaction_edit','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(46,'stripe_transaction_view','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(47,'stripe_transaction_delete','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(48,'stripe_upgrade_access','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(49,'stripe_upgrade_create','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(50,'stripe_upgrade_edit','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(51,'stripe_upgrade_view','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(52,'stripe_upgrade_delete','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(53,'subscription_access','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(54,'subscription_create','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(55,'subscription_edit','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(56,'subscription_view','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(57,'subscription_delete','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(58,'payment_access','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(59,'payment_create','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(60,'payment_edit','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(61,'payment_view','2018-10-08 18:17:23','2018-10-08 18:17:23'),
(62,'payment_delete','2018-10-08 18:17:24','2018-10-08 18:17:24');

/*Table structure for table `requests` */

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `landingpage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `not_clear` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_phonenumber` tinyint(4) DEFAULT '0',
  `no_email` tinyint(4) DEFAULT '0',
  `no_form` tinyint(4) DEFAULT '0',
  `no_content` tinyint(4) DEFAULT '0',
  `no_faq` tinyint(4) DEFAULT '0',
  `other_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aswered` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `adgroup_id` int(10) unsigned DEFAULT NULL,
  `created_by_id` int(10) unsigned DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requests_deleted_at_index` (`deleted_at`),
  KEY `214974_5bb4c9f230eb1` (`adgroup_id`),
  KEY `214974_5bb4c9f24852c` (`created_by_id`),
  CONSTRAINT `214974_5bb4c9f230eb1` FOREIGN KEY (`adgroup_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `214974_5bb4c9f24852c` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `requests` */

insert  into `requests`(`id`,`landingpage`,`target`,`not_clear`,`no_phonenumber`,`no_email`,`no_form`,`no_content`,`no_faq`,`other_keywords`,`aswered`,`created_at`,`updated_at`,`deleted_at`,`adgroup_id`,`created_by_id`,`city`) values 
(1,'789','45',NULL,0,0,0,0,0,NULL,NULL,'2018-10-08 18:23:43','2018-10-08 18:23:43',NULL,NULL,2,'12');

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `role_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `role_until` datetime DEFAULT NULL,
  KEY `fk_p_214589_214590_user_r_5bb3730ad7fe7` (`role_id`),
  KEY `fk_p_214590_214589_role_u_5bb3730ad807f` (`user_id`),
  CONSTRAINT `fk_p_214589_214590_user_r_5bb3730ad7fe7` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_p_214590_214589_role_u_5bb3730ad807f` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`role_id`,`user_id`,`role_until`) values 
(1,1,NULL),
(2,2,NULL);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `stripe_plan_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`title`,`created_at`,`updated_at`,`price`,`stripe_plan_id`) values 
(1,'Administrator (can create other users)','2018-10-08 18:17:24','2018-10-08 18:17:24',NULL,NULL),
(2,'Simple user','2018-10-08 18:17:24','2018-10-08 18:17:24',NULL,NULL),
(3,'free','2018-10-08 18:17:24','2018-10-08 18:17:24',0.00,'free'),
(4,'Premium','2018-10-08 18:17:24','2018-10-08 18:17:24',29.95,'premium'),
(5,'Professional','2018-10-08 18:17:24','2018-10-08 18:17:24',99.95,'professional');

/*Table structure for table `stripe_transactions` */

DROP TABLE IF EXISTS `stripe_transactions`;

CREATE TABLE `stripe_transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaction_user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `214975_5bb4ca881e1f9` (`transaction_user_id`),
  CONSTRAINT `214975_5bb4ca881e1f9` FOREIGN KEY (`transaction_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `stripe_transactions` */

/*Table structure for table `trackingcampaigns` */

DROP TABLE IF EXISTS `trackingcampaigns`;

CREATE TABLE `trackingcampaigns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medium` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `term` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid_id` int(10) unsigned DEFAULT NULL,
  `created_by_id` int(10) unsigned DEFAULT NULL,
  `updating_by` int(10) unsigned DEFAULT NULL,
  `domain_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `118004_5a812a49f3992` (`uuid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trackingcampaigns` */

/*Table structure for table `trackingevents` */

DROP TABLE IF EXISTS `trackingevents`;

CREATE TABLE `trackingevents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventCategory` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventAction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventLabel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventValue` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid_id` int(10) unsigned DEFAULT NULL,
  `page_id` int(10) unsigned DEFAULT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `updating_by` int(10) unsigned DEFAULT NULL,
  `domain_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `118003_5a81281257e93` (`uuid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trackingevents` */

/*Table structure for table `trackingmailings` */

DROP TABLE IF EXISTS `trackingmailings`;

CREATE TABLE `trackingmailings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventCategory` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventAction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventLabel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventValue` int(12) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nl_id` int(10) unsigned DEFAULT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `updating_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trackingmailings` */

/*Table structure for table `trackingpages` */

DROP TABLE IF EXISTS `trackingpages`;

CREATE TABLE `trackingpages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uri` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by_id` int(10) unsigned DEFAULT NULL,
  `updating_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trackingpages` */

insert  into `trackingpages`(`id`,`domain_key`,`uri`,`title`,`created_at`,`updated_at`,`deleted_at`,`created_by_id`,`updating_by`) values 
(1,'MjAxOC0wOC0xMiAyMDozNDowNiYx','https://next.fsom.com/subdomains/1/','Bodenbeläge vom Fachmann | Lieferung und Verlegung','2018-08-12 11:36:48','2018-08-12 11:36:48',NULL,2,NULL),
(2,'MjAxOC0wOC0xMyAxMjoyODozOCYy','http://next.fsom.com/subdomains/2/','Transparente Zahnschienen | Kosten und Informationen','2018-08-13 03:28:59','2018-08-13 03:28:59',NULL,4,NULL),
(3,'MjAxOC0wOC0xMyAxMjoyODozOCYy','https://next.fsom.com/subdomains/2/','Transparente Zahnschienen | Kosten und Informationen','2018-08-16 23:45:08','2018-08-16 23:45:08',NULL,4,NULL),
(4,'MjAxOC0wOC0xMyAxMjoyODozOCYy','file:///C:/Users/dhoin/Downloads/','Transparente Zahnschienen | Kosten und Informationen','2018-10-01 22:41:55','2018-10-01 22:41:55',NULL,4,NULL),
(5,'MjAxOC0xMC0wMiAxNDozMToyNSYz','https://next.fsom.com/subdomains/3/','Transparente Zahnschienen | Kosten und Informationen','2018-10-02 05:31:29','2018-10-02 05:31:29',NULL,12,NULL);

/*Table structure for table `trackinguris` */

DROP TABLE IF EXISTS `trackinguris`;

CREATE TABLE `trackinguris` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `whatIsDisplayed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timeonpage` int(10) unsigned DEFAULT NULL,
  `referer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `page_id` int(10) unsigned DEFAULT NULL,
  `created_by_id` int(10) unsigned DEFAULT NULL,
  `updating_by` int(10) unsigned DEFAULT NULL,
  `domain_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `118001_5a8126c88ba75` (`uuid_id`),
  KEY `118001_5a81279c7c603` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trackinguris` */

insert  into `trackinguris`(`id`,`whatIsDisplayed`,`timeonpage`,`referer`,`created_at`,`updated_at`,`uuid_id`,`deleted_at`,`page_id`,`created_by_id`,`updating_by`,`domain_key`) values 
(1,'no ab test',NULL,'https://next.fsom.com/admin/pages/1/edit-index','2018-08-12 11:36:48','2018-08-12 11:36:48',1,NULL,1,2,NULL,'MjAxOC0wOC0xMiAyMDozNDowNiYx'),
(2,'no ab test',NULL,'https://next.fsom.com/subdomains/1/','2018-08-12 11:40:12','2018-08-12 11:40:12',1,NULL,1,2,NULL,'MjAxOC0wOC0xMiAyMDozNDowNiYx'),
(3,'no ab test',NULL,'https://next.fsom.com/admin/pages','2018-08-12 11:53:08','2018-08-12 11:53:08',2,NULL,1,2,NULL,'MjAxOC0wOC0xMiAyMDozNDowNiYx'),
(4,'no ab test',NULL,'http://next.fsom.com/admin/pages/2/edit-index','2018-08-13 03:28:59','2018-08-13 03:28:59',3,NULL,2,4,NULL,'MjAxOC0wOC0xMyAxMjoyODozOCYy'),
(5,'no ab test',NULL,'https://next.fsom.com/admin/pages','2018-08-16 23:45:08','2018-08-16 23:45:08',2,NULL,3,4,NULL,'MjAxOC0wOC0xMyAxMjoyODozOCYy'),
(6,'no ab test',NULL,'https://next.fsom.com/admin/pages','2018-10-01 22:40:59','2018-10-01 22:40:59',1,NULL,3,4,NULL,'MjAxOC0wOC0xMyAxMjoyODozOCYy'),
(7,'no ab test',NULL,'https://next.fsom.com/subdomains/2/','2018-10-01 22:41:24','2018-10-01 22:41:24',1,NULL,3,4,NULL,'MjAxOC0wOC0xMyAxMjoyODozOCYy'),
(8,'no ab test',NULL,'','2018-10-01 22:41:55','2018-10-01 22:41:55',4,NULL,4,4,NULL,'MjAxOC0wOC0xMyAxMjoyODozOCYy'),
(9,'no ab test',NULL,'https://next.fsom.com/admin/pages/3/edit-index','2018-10-02 05:31:29','2018-10-02 05:31:29',1,NULL,5,12,NULL,'MjAxOC0xMC0wMiAxNDozMToyNSYz'),
(10,'no ab test',NULL,'https://next.fsom.com/admin/pages','2018-10-02 05:33:22','2018-10-02 05:33:22',1,NULL,5,12,NULL,'MjAxOC0xMC0wMiAxNDozMToyNSYz'),
(11,'no ab test',NULL,'https://next.fsom.com/admin/pages','2018-10-04 04:04:00','2018-10-04 04:04:00',1,NULL,3,4,NULL,'MjAxOC0wOC0xMyAxMjoyODozOCYy'),
(12,'no ab test',NULL,'','2018-10-04 04:04:18','2018-10-04 04:04:18',5,NULL,3,4,NULL,'MjAxOC0wOC0xMyAxMjoyODozOCYy');

/*Table structure for table `trackinguuids` */

DROP TABLE IF EXISTS `trackinguuids`;

CREATE TABLE `trackinguuids` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resolution` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `javascript` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` int(10) unsigned DEFAULT NULL,
  `updating_by` int(10) unsigned DEFAULT NULL,
  `domain_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` int(12) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trackinguuids` */

insert  into `trackinguuids`(`id`,`country`,`language`,`resolution`,`javascript`,`created_at`,`updated_at`,`uuid`,`created_by_id`,`updating_by`,`domain_key`,`contact_id`) values 
(1,'th','lang','1536x700',1,'2018-08-12 11:36:48','2018-08-12 11:36:48','b7acb3c6-f2b8-4791-9a74-d9b11d4c54ba',2,NULL,'MjAxOC0wOC0xMiAyMDozNDowNiYx',NULL),
(2,'th','lang','1536x728',1,'2018-08-12 11:53:07','2018-08-12 11:53:07','9dda3be1-7561-487c-a930-892fc2b601b6',2,NULL,'MjAxOC0wOC0xMiAyMDozNDowNiYx',NULL),
(3,'th','lang','1536x750',1,'2018-08-13 03:28:59','2018-08-13 03:33:44','a6bb62c2-dd40-4ca3-878d-e0f46c4920d7',4,NULL,'MjAxOC0wOC0xMyAxMjoyODozOCYy',2),
(4,'th','lang','1536x723',1,'2018-10-01 22:41:55','2018-10-01 22:41:55','635c0a05-b3d9-4603-a3e9-f4c1d90a80da',4,NULL,'MjAxOC0wOC0xMyAxMjoyODozOCYy',NULL),
(5,'th','lang','1770x969',1,'2018-10-04 04:04:18','2018-10-04 04:04:18','28ab47c1-8184-4743-81fb-f522c15f79f2',4,NULL,'MjAxOC0wOC0xMyAxMjoyODozOCYy',NULL);

/*Table structure for table `user_actions` */

DROP TABLE IF EXISTS `user_actions`;

CREATE TABLE `user_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `214591_5bb3731601777` (`user_id`),
  CONSTRAINT `214591_5bb3731601777` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_actions` */

insert  into `user_actions`(`id`,`action`,`action_model`,`action_id`,`created_at`,`updated_at`,`user_id`) values 
(1,'created','keywords',1,'2018-10-08 18:17:24','2018-10-08 18:17:24',1),
(2,'created','keywords',2,'2018-10-08 18:17:24','2018-10-08 18:17:24',1),
(3,'created','campaigns',1,'2018-10-08 18:17:24','2018-10-08 18:17:24',1),
(4,'updated','campaigns',1,'2018-10-08 18:17:24','2018-10-08 18:17:24',1),
(5,'updated','campaigns',1,'2018-10-08 18:17:24','2018-10-08 18:17:24',1),
(6,'created','requests',1,'2018-10-08 18:23:43','2018-10-08 18:23:43',2),
(7,'updated','users',2,'2018-10-08 18:57:42','2018-10-08 18:57:42',2);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved` tinyint(4) DEFAULT '0',
  `premium` tinyint(4) DEFAULT '0',
  `stripe_customer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `balance` double DEFAULT '0',
  `info_phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_adress` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_zip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`approved`,`premium`,`stripe_customer_id`,`phone`,`payment`,`partner_id`,`balance`,`info_phone`,`info_email`,`company_name`,`company_adress`,`company_city`,`company_zip`) values 
(1,'Admin','admin@admin.com',NULL,'$2y$10$OrXlpW4990hbqjRQcaOmRO0mE4kmGfVhBN9DE5oQga0E5aReYpGGG','','2018-10-08 18:17:24','2018-10-08 18:17:24',1,0,NULL,NULL,NULL,NULL,0,'info_phone','info_email','company name','company address','company city','company zip'),
(2,'kashirin','bengalTiger1106@gmail.com',NULL,'$2y$10$cuoIhPdm2HaV3D4n.fZx0.11LxKgnhuiQXdTKlfxDyCTbqDAJ2fZ.','dZcw6TkPZMfGST6xKZhTcSw7DoEeElhfwhIiwpQvvQaqJnR7jBN3W76TxDsz','2018-10-08 18:19:24','2018-10-08 18:19:24',1,0,NULL,'123456789','',1,0,'info_phone','info_email','company name','company address','company city',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
