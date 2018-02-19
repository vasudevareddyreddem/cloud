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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `favourite` */

insert  into `favourite`(`id`,`u_id`,`file_id`,`yes`,`status`,`create_at`) values (10,5492202,4,1,1,'2018-02-17 14:17:08'),(13,5492202,8,1,1,'2018-02-19 13:47:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `floder_list` */

insert  into `floder_list`(`f_id`,`u_id`,`page_id`,`floder_id`,`f_name`,`f_status`,`f_create_at`,`f_updated_at`,`f_undo`) values (1,5492202,0,0,'vasu','1','2018-02-17 11:13:56','2018-02-17 11:13:56',0),(2,5492202,1,1,'vasu1','1','2018-02-17 11:29:23','2018-02-17 11:29:23',0),(3,5492202,1,2,'vasu2','1','2018-02-17 11:29:30','2018-02-17 11:29:30',0),(4,5492202,1,3,'vasu3','1','2018-02-17 11:29:39','2018-02-17 11:29:39',0),(6,5492202,1,4,'vasu4','1','2018-02-17 11:30:05','2018-02-17 11:30:05',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `images` */

insert  into `images`(`img_id`,`u_id`,`page_id`,`floder_id`,`img_name`,`imag_org_name`,`img_create_at`,`img_status`,`img_undo`,`f_update_at`) values (1,5492202,0,0,'0.531842001518850894ANDROIDAPPLICATIONFLOW.docx','ANDROIDAPPLICATIONFLOW.docx','2018-02-17 12:31:34',1,0,NULL),(2,5492202,0,0,'0.164852001518850924benefit.jpg','benefit.jpg','2018-02-17 12:32:04',1,0,NULL),(3,5492202,1,3,'0.712646001518852339benefit.jpg','testing','2018-02-17 12:55:39',1,0,'2018-02-17 16:43:43'),(4,5492202,1,6,'0.523046001518852352docsthumb.jpg','vasuimg','2018-02-17 12:55:52',1,0,'2018-02-17 16:43:23'),(5,5492202,1,2,'0.915484001518859436startup.jpg','startup.jpg','2018-02-17 14:53:56',1,1,'2018-02-17 15:02:46'),(6,5492202,1,2,'0.053245001518859886prod-myewellness.png','myewellness.png','2018-02-17 15:01:26',1,0,'2018-02-19 14:04:28'),(7,5492202,1,1,'0.663183001518866066banner-header.jpg','banner-header.jpg','2018-02-17 16:44:26',1,0,NULL),(8,5492202,0,1,'0.225894001518866074prod-myewellness.png','prod-myewellness.png','2018-02-17 16:44:34',1,1,'2018-02-19 13:48:44');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `recently_file_open` */

insert  into `recently_file_open`(`r_file_id`,`u_id`,`file_id`,`r_file_status`,`r_file_create_at`,`r_file_updated_at`) values (3,5492202,13,1,'2018-02-19 13:47:38','2018-02-19 13:47:38'),(5,5492202,8,1,'2018-02-19 13:48:03','2018-02-19 13:48:03'),(6,5492202,8,1,'2018-02-19 13:48:31','2018-02-19 13:48:31'),(7,5492202,8,1,'2018-02-19 13:48:44','2018-02-19 13:48:44'),(8,5492202,6,1,'2018-02-19 14:04:28','2018-02-19 14:04:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=496 DEFAULT CHARSET=latin1;

/*Data for the table `recently_floder_open` */

insert  into `recently_floder_open`(`r_f_id`,`u_id`,`f_id`,`r_f_status`,`r_f_create_at`,`r_f_updated_at`) values (492,5492202,1,1,'2018-02-19 14:47:20','2018-02-19 14:47:20'),(493,5492202,2,1,'2018-02-19 14:47:23','2018-02-19 14:47:23'),(494,5492202,2,1,'2018-02-19 14:49:48','2018-02-19 14:49:48'),(495,5492202,2,1,'2018-02-19 14:50:25','2018-02-19 14:50:25');

/*Table structure for table `shared_files` */

DROP TABLE IF EXISTS `shared_files`;

CREATE TABLE `shared_files` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `img_id` int(11) DEFAULT NULL,
  `s_status` int(11) DEFAULT NULL,
  `s_created` datetime DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `shared_files` */

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

insert  into `users`(`u_id`,`role`,`u_name`,`u_email`,`u_password`,`u_orginalpassword`,`u_mobile`,`u_dob`,`u_gender`,`u_status`,`verification_code`,`verification_status`,`u_barcode`,`u_barcode_image`,`u_profilepic`,`u_create_at`,`u_update_time`) values (5492202,1,'chinna','vasu@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456','8500226788','Thursday 15 February 2018  ','Male',0,NULL,NULL,'5492203','15186007065492203.png','docsthumb.jpg','2018-02-14 14:58:34','2018-02-15 17:31:24'),(5492203,1,'vasudevareddy','vasudevareddy1@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,0,NULL,NULL,'5492203','15186007065492203.png',NULL,'2018-02-14 15:01:46',NULL),(5492204,1,'ytry','tyertyty@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,0,NULL,NULL,'5492204','15186027815492204.png',NULL,'2018-02-14 15:36:21',NULL),(5492205,1,'bayapu','bayapu@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,0,NULL,NULL,'5492205','15186115705492205.png',NULL,'2018-02-14 18:02:50',NULL),(5492206,1,'bayapu','dhdfkjgnfdhk@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456','8500050944',NULL,NULL,0,NULL,NULL,'5492206','15186119325492206.png',NULL,'2018-02-14 18:08:52',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
