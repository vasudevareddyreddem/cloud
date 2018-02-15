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
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5492207 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`u_id`,`role`,`u_name`,`u_email`,`u_password`,`u_orginalpassword`,`u_mobile`,`u_dob`,`u_gender`,`u_status`,`verification_code`,`verification_status`,`u_barcode`,`u_barcode_image`,`u_profilepic`,`u_create_at`) values (5492202,1,'chinna','vasu@gmail.com','014738d15bd942b2d25cdc6cf07c89b7','vasu@549','8500050944','','Male',0,NULL,NULL,'5492202','15186005145492202',NULL,'2018-02-14 14:58:34'),(5492203,1,'vasudevareddy','vasudevareddy1@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,0,NULL,NULL,'5492203','15186007065492203.png',NULL,'2018-02-14 15:01:46'),(5492204,1,'ytry','tyertyty@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,0,NULL,NULL,'5492204','15186027815492204.png',NULL,'2018-02-14 15:36:21'),(5492205,1,'bayapu','bayapu@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456',NULL,NULL,NULL,0,NULL,NULL,'5492205','15186115705492205.png',NULL,'2018-02-14 18:02:50'),(5492206,1,'bayapu','dhdfkjgnfdhk@gmail.com','e10adc3949ba59abbe56e057f20f883e','123456','8500050944',NULL,NULL,0,NULL,NULL,'5492206','15186119325492206.png',NULL,'2018-02-14 18:08:52');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
