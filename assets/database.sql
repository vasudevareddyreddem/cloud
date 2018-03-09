/*
SQLyog Community v11.52 (64 bit)
MySQL - 10.1.21-MariaDB : Database - cloud
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cloud` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cloud`;

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`id`,`ip_address`,`timestamp`,`data`) values ('53aglc9h0ag8r9v6cdike7gt1bnmd2bu','::1',1520591103,'__ci_last_regenerate|i:1520591006;userdetails|a:26:{s:4:\"u_id\";s:7:\"5492222\";s:4:\"role\";s:1:\"1\";s:6:\"u_name\";s:13:\"vasudevareddy\";s:7:\"u_email\";s:14:\"vasu@gmail.com\";s:10:\"u_password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:17:\"u_orginalpassword\";s:6:\"123456\";s:8:\"u_mobile\";s:10:\"8500050944\";s:5:\"u_dob\";N;s:8:\"u_gender\";N;s:8:\"u_status\";s:1:\"1\";s:17:\"verification_code\";N;s:19:\"verification_status\";N;s:9:\"u_barcode\";s:7:\"5492222\";s:15:\"u_barcode_image\";s:21:\"15205902645492222.png\";s:12:\"u_profilepic\";N;s:11:\"u_create_at\";s:19:\"2018-03-09 15:41:03\";s:13:\"u_update_time\";N;s:15:\"last_login_time\";s:19:\"2018-03-09 15:41:03\";s:19:\"password_lastupdate\";s:19:\"2018-03-09 15:41:03\";s:10:\"ip_address\";s:3:\"::1\";s:10:\"question_1\";s:1:\"1\";s:8:\"answer_1\";s:3:\"ntg\";s:10:\"question_2\";s:1:\"7\";s:8:\"answer_2\";s:4:\"ntg1\";s:10:\"question_3\";s:1:\"8\";s:8:\"answer_3\";s:4:\"home\";}'),('b9blib80mtftub7jdf9qb3r03f2ljne2','::1',1520591937,'__ci_last_regenerate|i:1520591704;userdetails|a:26:{s:4:\"u_id\";s:7:\"5492222\";s:4:\"role\";s:1:\"1\";s:6:\"u_name\";s:13:\"vasudevareddy\";s:7:\"u_email\";s:14:\"vasu@gmail.com\";s:10:\"u_password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:17:\"u_orginalpassword\";s:6:\"123456\";s:8:\"u_mobile\";s:10:\"8500050944\";s:5:\"u_dob\";N;s:8:\"u_gender\";N;s:8:\"u_status\";s:1:\"1\";s:17:\"verification_code\";N;s:19:\"verification_status\";N;s:9:\"u_barcode\";s:7:\"5492222\";s:15:\"u_barcode_image\";s:21:\"15205902645492222.png\";s:12:\"u_profilepic\";N;s:11:\"u_create_at\";s:19:\"2018-03-09 15:41:03\";s:13:\"u_update_time\";N;s:15:\"last_login_time\";s:19:\"2018-03-09 15:41:03\";s:19:\"password_lastupdate\";s:19:\"2018-03-09 15:41:03\";s:10:\"ip_address\";s:3:\"::1\";s:10:\"question_1\";s:1:\"1\";s:8:\"answer_1\";s:3:\"ntg\";s:10:\"question_2\";s:1:\"7\";s:8:\"answer_2\";s:4:\"ntg1\";s:10:\"question_3\";s:1:\"8\";s:8:\"answer_3\";s:4:\"home\";}'),('dkke9p2l5726sg3r4b99r1ts9nas3gu5','::1',1520590715,'__ci_last_regenerate|i:1520590442;userdetails|a:26:{s:4:\"u_id\";s:7:\"5492222\";s:4:\"role\";s:1:\"1\";s:6:\"u_name\";s:13:\"vasudevareddy\";s:7:\"u_email\";s:14:\"vasu@gmail.com\";s:10:\"u_password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:17:\"u_orginalpassword\";s:6:\"123456\";s:8:\"u_mobile\";s:10:\"8500050944\";s:5:\"u_dob\";N;s:8:\"u_gender\";N;s:8:\"u_status\";s:1:\"1\";s:17:\"verification_code\";N;s:19:\"verification_status\";N;s:9:\"u_barcode\";s:7:\"5492222\";s:15:\"u_barcode_image\";s:21:\"15205902645492222.png\";s:12:\"u_profilepic\";N;s:11:\"u_create_at\";s:19:\"2018-03-09 15:41:03\";s:13:\"u_update_time\";N;s:15:\"last_login_time\";s:19:\"2018-03-09 15:41:03\";s:19:\"password_lastupdate\";s:19:\"2018-03-09 15:41:03\";s:10:\"ip_address\";s:3:\"::1\";s:10:\"question_1\";s:1:\"1\";s:8:\"answer_1\";s:3:\"ntg\";s:10:\"question_2\";s:1:\"7\";s:8:\"answer_2\";s:4:\"ntg1\";s:10:\"question_3\";s:1:\"8\";s:8:\"answer_3\";s:4:\"home\";}'),('q3h6en8fqo19aoiherjfgovdmlf4q503','::1',1520591622,'__ci_last_regenerate|i:1520591327;userdetails|a:26:{s:4:\"u_id\";s:7:\"5492222\";s:4:\"role\";s:1:\"1\";s:6:\"u_name\";s:13:\"vasudevareddy\";s:7:\"u_email\";s:14:\"vasu@gmail.com\";s:10:\"u_password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";s:17:\"u_orginalpassword\";s:6:\"123456\";s:8:\"u_mobile\";s:10:\"8500050944\";s:5:\"u_dob\";N;s:8:\"u_gender\";N;s:8:\"u_status\";s:1:\"1\";s:17:\"verification_code\";N;s:19:\"verification_status\";N;s:9:\"u_barcode\";s:7:\"5492222\";s:15:\"u_barcode_image\";s:21:\"15205902645492222.png\";s:12:\"u_profilepic\";N;s:11:\"u_create_at\";s:19:\"2018-03-09 15:41:03\";s:13:\"u_update_time\";N;s:15:\"last_login_time\";s:19:\"2018-03-09 15:41:03\";s:19:\"password_lastupdate\";s:19:\"2018-03-09 15:41:03\";s:10:\"ip_address\";s:3:\"::1\";s:10:\"question_1\";s:1:\"1\";s:8:\"answer_1\";s:3:\"ntg\";s:10:\"question_2\";s:1:\"7\";s:8:\"answer_2\";s:4:\"ntg1\";s:10:\"question_3\";s:1:\"8\";s:8:\"answer_3\";s:4:\"home\";}');

/*Table structure for table `favourite` */

DROP TABLE IF EXISTS `favourite`;

CREATE TABLE `favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `yes` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `favourite` */

/*Table structure for table `filecaal_notification_list` */

DROP TABLE IF EXISTS `filecaal_notification_list`;

CREATE TABLE `filecaal_notification_list` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `sent_u_id` int(11) DEFAULT NULL,
  `filecall_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `filecall_status` int(11) DEFAULT '0',
  `filecall_created_at` datetime DEFAULT NULL,
  `filecall_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `filecaal_notification_list` */

/*Table structure for table `filecall_list` */

DROP TABLE IF EXISTS `filecall_list`;

CREATE TABLE `filecall_list` (
  `f_c_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `f_c_calling` varchar(250) DEFAULT NULL,
  `f_c_u_id` int(11) DEFAULT NULL,
  `f_c_email_id` varchar(250) DEFAULT NULL,
  `f_c_status` int(11) DEFAULT NULL,
  `f_c_created_at` datetime DEFAULT NULL,
  `f_c_updated_at` datetime DEFAULT NULL,
  `f_c_request` int(11) DEFAULT NULL,
  PRIMARY KEY (`f_c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `filecall_list` */

/*Table structure for table `floder_favourite` */

DROP TABLE IF EXISTS `floder_favourite`;

CREATE TABLE `floder_favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `f_id` int(11) DEFAULT NULL,
  `yes` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `floder_favourite` */

/*Table structure for table `floder_list` */

DROP TABLE IF EXISTS `floder_list`;

CREATE TABLE `floder_list` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `floder_id` int(11) DEFAULT NULL,
  `f_name` varchar(250) DEFAULT NULL,
  `f_status` varchar(250) DEFAULT NULL,
  `f_create_at` datetime DEFAULT NULL,
  `f_updated_at` datetime DEFAULT NULL,
  `f_undo` int(11) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

/*Data for the table `floder_list` */

insert  into `floder_list`(`f_id`,`u_id`,`page_id`,`floder_id`,`f_name`,`f_status`,`f_create_at`,`f_updated_at`,`f_undo`) values (71,5492222,1,0,'like','1','2018-03-09 15:42:06','2018-03-09 15:42:06',0);

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `floder_id` int(11) DEFAULT NULL,
  `img_name` varchar(250) DEFAULT NULL,
  `imag_org_name` varchar(250) DEFAULT NULL,
  `img_create_at` varchar(250) DEFAULT NULL,
  `img_status` int(11) DEFAULT NULL,
  `img_undo` int(11) DEFAULT NULL,
  `f_update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;

/*Data for the table `images` */

insert  into `images`(`img_id`,`u_id`,`page_id`,`floder_id`,`img_name`,`imag_org_name`,`img_create_at`,`img_status`,`img_undo`,`f_update_at`) values (142,5492222,0,0,'0.009835001520590332vasuimage.jpg','vasuimage.jpg','2018-03-09 15:42:12',1,0,NULL);

/*Table structure for table `link_favourite` */

DROP TABLE IF EXISTS `link_favourite`;

CREATE TABLE `link_favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `yes` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `link_favourite` */

/*Table structure for table `links` */

DROP TABLE IF EXISTS `links`;

CREATE TABLE `links` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `l_name` text,
  `l_status` int(11) DEFAULT '1',
  `l_created_at` datetime DEFAULT NULL,
  `l_updated_at` datetime DEFAULT NULL,
  `l_undo` int(11) DEFAULT '0',
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `links` */

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL,
  `folder` varchar(250) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `action` enum('Share','Download','Favourite','Rename','Move','Delete','FileCall','Change Password','Reset Password','Login','Payment','Register','Update Profile','Restore','Create','Request','Clear Logs','Forgot Password') DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

/*Data for the table `logs` */

insert  into `logs`(`id`,`u_id`,`file`,`folder`,`link`,`action`,`status`,`create_at`) values (80,5492222,'','','','Register',1,'2018-03-09 15:41:03'),(81,5492222,'','71','','Create',1,'2018-03-09 15:42:06'),(82,5492222,'142','','','Create',1,'2018-03-09 15:42:12'),(83,5492223,'','','','Register',1,'2018-03-09 15:43:58'),(84,5492222,'','','','Login',1,'2018-03-09 15:44:14'),(85,5492222,'142','','','Share',1,'2018-03-09 15:45:31'),(86,5492222,'142','','','Share',1,'2018-03-09 15:46:13'),(87,5492222,'142','','','Share',1,'2018-03-09 15:47:21'),(88,5492222,'142','','','Share',1,'2018-03-09 15:48:34'),(89,5492222,'142','','','Share',1,'2018-03-09 15:53:27'),(90,5492222,'142','','','Share',1,'2018-03-09 15:55:02'),(91,5492222,'142','','','Share',1,'2018-03-09 15:58:48'),(92,5492222,'142','','','Share',1,'2018-03-09 15:59:00');

/*Table structure for table `questions` */

DROP TABLE IF EXISTS `questions`;

CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `questions` */

insert  into `questions`(`id`,`name`,`status`,`create_at`) values (1,'What was your childhood nickname?',1,'2018-03-09 13:19:22'),(2,'What is the name of your favorite childhood friend?',1,'2018-03-09 13:19:24'),(3,'In what city or town did your mother and father meet?',1,'2018-03-09 13:19:26'),(4,'What is your favorite cricket/football team?',1,'2018-03-09 13:19:28'),(5,'What is your favorite movie?',1,'2018-03-09 13:19:30'),(6,'What was your favorite sport in high school?',1,'2018-03-09 13:19:22'),(7,'What was your favorite food?',1,'2018-03-09 13:19:22'),(8,'What was the name of the hospital where you were born?',1,'2018-03-09 13:19:22');

/*Table structure for table `recently_file_open` */

DROP TABLE IF EXISTS `recently_file_open`;

CREATE TABLE `recently_file_open` (
  `r_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `r_file_status` int(11) DEFAULT NULL,
  `r_file_create_at` datetime DEFAULT NULL,
  `r_file_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`r_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

/*Data for the table `recently_file_open` */

/*Table structure for table `recently_floder_open` */

DROP TABLE IF EXISTS `recently_floder_open`;

CREATE TABLE `recently_floder_open` (
  `r_f_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `f_id` int(11) DEFAULT NULL,
  `r_f_status` int(11) DEFAULT NULL,
  `r_f_create_at` datetime DEFAULT NULL,
  `r_f_updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`r_f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1792 DEFAULT CHARSET=latin1;

/*Data for the table `recently_floder_open` */

/*Table structure for table `shared_files` */

DROP TABLE IF EXISTS `shared_files`;

CREATE TABLE `shared_files` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `u_email` varchar(250) DEFAULT NULL,
  `img_id` int(11) DEFAULT NULL,
  `s_permission` enum('Read','Write') DEFAULT NULL,
  `s_status` int(11) DEFAULT NULL,
  `s_created` datetime DEFAULT NULL,
  `file_created_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `shared_files` */

insert  into `shared_files`(`s_id`,`u_id`,`u_email`,`img_id`,`s_permission`,`s_status`,`s_created`,`file_created_id`) values (16,5492223,NULL,142,'Read',1,'2018-03-09 15:45:31',5492222),(17,5492223,NULL,142,'Read',1,'2018-03-09 15:46:13',5492222),(18,5492223,NULL,142,'Read',1,'2018-03-09 15:47:21',5492222),(19,5492223,NULL,142,'Read',1,'2018-03-09 15:48:34',5492222),(20,5492223,NULL,142,'Read',1,'2018-03-09 15:53:26',5492222),(21,5492223,NULL,142,'Read',1,'2018-03-09 15:55:02',5492222),(22,5492223,NULL,142,'Read',1,'2018-03-09 15:58:47',5492222),(23,5492223,NULL,142,'Read',1,'2018-03-09 15:58:59',5492222),(24,5492223,NULL,142,'Read',1,'2018-03-09 15:59:24',5492222),(25,5492223,NULL,142,'Read',1,'2018-03-09 16:00:01',5492222),(26,5492223,NULL,142,'Read',1,'2018-03-09 16:00:38',5492222),(27,5492223,NULL,142,'Read',1,'2018-03-09 16:01:17',5492222),(28,5492223,NULL,142,'Read',1,'2018-03-09 16:02:03',5492222),(29,5492223,NULL,142,'Read',1,'2018-03-09 16:03:42',5492222),(30,5492223,NULL,142,'Read',1,'2018-03-09 16:05:04',5492222),(31,5492223,NULL,142,'Read',1,'2018-03-09 16:08:57',5492222);

/*Table structure for table `shared_folder` */

DROP TABLE IF EXISTS `shared_folder`;

CREATE TABLE `shared_folder` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `u_email` varchar(250) DEFAULT NULL,
  `f_id` int(11) DEFAULT NULL,
  `s_permission` enum('Read','Write') DEFAULT NULL,
  `s_status` int(11) DEFAULT NULL,
  `s_created` datetime DEFAULT NULL,
  `file_created_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `shared_folder` */

/*Table structure for table `shared_links` */

DROP TABLE IF EXISTS `shared_links`;

CREATE TABLE `shared_links` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `u_email` varchar(250) DEFAULT NULL,
  `link_id` int(11) DEFAULT NULL,
  `s_permission` enum('Read','Write') DEFAULT NULL,
  `s_status` int(11) DEFAULT NULL,
  `s_created` datetime DEFAULT NULL,
  `file_created_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `shared_links` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) DEFAULT NULL,
  `u_name` varchar(250) DEFAULT NULL,
  `u_email` varchar(250) DEFAULT NULL,
  `u_password` varchar(250) DEFAULT NULL,
  `u_orginalpassword` varchar(250) DEFAULT NULL,
  `u_mobile` varchar(250) DEFAULT NULL,
  `u_dob` varchar(250) DEFAULT NULL,
  `u_gender` varchar(250) DEFAULT NULL,
  `u_status` int(11) DEFAULT '0',
  `verification_code` varchar(250) DEFAULT NULL,
  `verification_status` varchar(250) DEFAULT NULL,
  `u_barcode` varchar(250) DEFAULT NULL,
  `u_barcode_image` varchar(250) DEFAULT NULL,
  `u_profilepic` varchar(250) DEFAULT NULL,
  `u_create_at` datetime DEFAULT NULL,
  `u_update_time` datetime DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `password_lastupdate` datetime DEFAULT NULL,
  `ip_address` varchar(250) DEFAULT NULL,
  `question_1` varchar(250) DEFAULT NULL,
  `answer_1` varchar(250) DEFAULT NULL,
  `question_2` varchar(250) DEFAULT NULL,
  `answer_2` varchar(250) DEFAULT NULL,
  `question_3` varchar(250) DEFAULT NULL,
  `answer_3` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5492224 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`u_id`,`role`,`u_name`,`u_email`,`u_password`,`u_orginalpassword`,`u_mobile`,`u_dob`,`u_gender`,`u_status`,`verification_code`,`verification_status`,`u_barcode`,`u_barcode_image`,`u_profilepic`,`u_create_at`,`u_update_time`,`last_login_time`,`password_lastupdate`,`ip_address`,`question_1`,`answer_1`,`question_2`,`answer_2`,`question_3`,`answer_3`) values (5492222,1,'vasudevareddy','vasu@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456','8500050944',NULL,NULL,1,NULL,NULL,'5492222','15205902645492222.png',NULL,'2018-03-09 15:41:03',NULL,'2018-03-09 15:44:14','2018-03-09 15:41:03','::1','1','ntg','7','ntg1','8','home'),(5492223,1,'bayapu','bayapu@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456','8500226782',NULL,NULL,1,NULL,NULL,'5492223','15205904385492223.png',NULL,'2018-03-09 15:43:58',NULL,'2018-03-09 15:43:58','2018-03-09 15:43:58','::1','1','123','2','456','3','789');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
