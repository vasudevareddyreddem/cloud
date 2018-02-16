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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `floder_list` */

insert  into `floder_list`(`f_id`,`u_id`,`page_id`,`floder_id`,`f_name`,`f_status`,`f_create_at`,`f_updated_at`,`f_undo`) values (16,5492202,0,0,'test','1','2018-02-15 18:13:47','2018-02-15 18:13:47',0),(17,5492202,0,0,'test1','1','2018-02-15 18:14:00','2018-02-15 18:14:00',0),(18,5492202,1,17,'test-1','1','2018-02-15 18:14:19','2018-02-15 18:14:19',0),(19,5492202,1,17,'test-2','1','2018-02-15 18:14:33','2018-02-15 18:14:33',0),(20,5492202,1,19,'test-2 test','1','2018-02-15 18:16:27','2018-02-15 18:16:27',0),(21,5492202,1,20,'testinglike','1','2018-02-15 18:16:42','2018-02-15 18:16:42',0),(22,5492202,1,16,'bayapu','1','2018-02-15 18:23:55','2018-02-15 18:23:55',0),(23,5492202,1,22,'like','1','2018-02-15 18:25:35','2018-02-15 18:25:35',0);

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
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `images` */

insert  into `images`(`img_id`,`u_id`,`page_id`,`floder_id`,`img_name`,`imag_org_name`,`img_create_at`,`img_status`,`img_undo`) values (21,5492202,0,0,'0.616269001518698904banner-header.jpg','banner-header.jpg','2018-02-15 18:18:24',1,0),(22,5492202,0,0,'0.447950001518698908banner-header.jpg','banner-header.jpg','2018-02-15 18:18:28',1,0),(23,5492202,1,17,'0.585089001518698914banner-header.jpg','banner-header.jpg','2018-02-15 18:18:34',1,0),(24,5492202,1,17,'0.456662001518699064docsthumb.jpg','docsthumb.jpg','2018-02-15 18:21:04',1,0),(25,5492202,1,16,'0.167663001518699258myewellness-laptop.png','myewellness-laptop.png','2018-02-15 18:24:18',1,0),(26,5492202,1,22,'0.255270001518699317startup.jpg','startup.jpg','2018-02-15 18:25:17',1,0),(27,5492202,0,0,'0.942442001518699920prod-myewellness.png','prod-myewellness.png','2018-02-15 18:35:20',1,0),(28,5492202,0,0,'0.955206001518699926quote.jpg','quote.jpg','2018-02-15 18:35:26',1,0),(29,5492202,0,0,'0.699914001518699930startup.jpg','startup.jpg','2018-02-15 18:35:30',1,0),(30,5492202,0,0,'0.004779001518699937logo-blue@2x.png','logo-blue@2x.png','2018-02-15 18:35:36',1,0),(31,5492202,0,0,'0.216253001518699941icon-enroll-big.png','icon-enroll-big.png','2018-02-15 18:35:41',1,0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `recently_floder_open` */

insert  into `recently_floder_open`(`r_f_id`,`u_id`,`f_id`,`r_f_status`,`r_f_create_at`,`r_f_updated_at`) values (15,5492202,17,1,'2018-02-15 18:52:58','2018-02-15 18:52:58'),(16,5492202,19,1,'2018-02-15 18:53:02','2018-02-15 18:53:02'),(17,5492202,20,1,'2018-02-15 18:53:06','2018-02-15 18:53:06'),(18,5492202,21,1,'2018-02-15 18:53:10','2018-02-15 18:53:10'),(19,5492202,21,1,'2018-02-15 18:59:56','2018-02-15 18:59:56'),(20,5492202,19,1,'2018-02-15 19:00:03','2018-02-15 19:00:03'),(21,5492202,21,1,'2018-02-15 19:17:09','2018-02-15 19:17:09'),(22,5492202,17,1,'2018-02-15 19:17:39','2018-02-15 19:17:39'),(23,5492202,17,1,'2018-02-15 19:17:39','2018-02-15 19:17:39'),(24,5492202,19,1,'2018-02-15 19:17:40','2018-02-15 19:17:40'),(25,5492202,20,1,'2018-02-15 19:17:41','2018-02-15 19:17:41'),(26,5492202,21,1,'2018-02-15 19:17:42','2018-02-15 19:17:42'),(27,5492202,21,1,'2018-02-15 19:17:43','2018-02-15 19:17:43'),(28,5492202,20,1,'2018-02-15 19:17:45','2018-02-15 19:17:45'),(29,5492202,19,1,'2018-02-15 19:17:46','2018-02-15 19:17:46'),(30,5492202,17,1,'2018-02-15 19:17:47','2018-02-15 19:17:47'),(31,5492202,21,1,'2018-02-15 19:17:48','2018-02-15 19:17:48');

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
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5492207 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`u_id`,`role`,`u_name`,`u_email`,`u_password`,`u_orginalpassword`,`u_mobile`,`u_dob`,`u_gender`,`u_status`,`verification_code`,`verification_status`,`u_barcode`,`u_barcode_image`,`u_profilepic`,`u_create_at`,`u_update_time`) values (5492202,1,'chinna','vasu@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456','8500226788','Thursday 15 February 2018  ','Male',0,NULL,NULL,'5492202','15186005145492202','docsthumb.jpg','2018-02-14 14:58:34','2018-02-15 17:31:24'),(5492203,1,'vasudevareddy','vasudevareddy1@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,0,NULL,NULL,'5492203','15186007065492203.png',NULL,'2018-02-14 15:01:46',NULL),(5492204,1,'ytry','tyertyty@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,0,NULL,NULL,'5492204','15186027815492204.png',NULL,'2018-02-14 15:36:21',NULL),(5492205,1,'bayapu','bayapu@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,0,NULL,NULL,'5492205','15186115705492205.png',NULL,'2018-02-14 18:02:50',NULL),(5492206,1,'bayapu','dhdfkjgnfdhk@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456','8500050944',NULL,NULL,0,NULL,NULL,'5492206','15186119325492206.png',NULL,'2018-02-14 18:08:52',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
