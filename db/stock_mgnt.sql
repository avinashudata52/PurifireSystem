/*
SQLyog Community v12.2.5 (32 bit)
MySQL - 5.6.34 : Database - stock_mgnt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`stock_mgnt` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `stock_mgnt`;

/*Table structure for table `item_master` */

DROP TABLE IF EXISTS `item_master`;

CREATE TABLE `item_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` varchar(50) DEFAULT '0',
  `itemnm` varchar(200) DEFAULT '0',
  `hsn` varchar(50) DEFAULT '0',
  `image` varchar(100) DEFAULT '0',
  `sts` int(4) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `item_master` */

insert  into `item_master`(`id`,`dt`,`itemnm`,`hsn`,`image`,`sts`,`edt`) values 
(1,'2020-11-03','MONITOR ZEBION SPLAY 16(15.6)AV1','8528','0',0,'2020-11-03 09:53:23'),
(2,'2020-11-03','WALL MOUNT RACK 2U/400MM(WIDTH)','84733099','0',0,'2020-11-03 09:53:36');

/*Table structure for table `login_tbl` */

DROP TABLE IF EXISTS `login_tbl`;

CREATE TABLE `login_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) DEFAULT '0',
  `mobile` varchar(50) DEFAULT '0',
  `emailId` varchar(50) DEFAULT '0',
  `pwd` varchar(50) DEFAULT '0',
  `sts` int(4) DEFAULT '0',
  `edt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `login_tbl` */

insert  into `login_tbl`(`id`,`uname`,`mobile`,`emailId`,`pwd`,`sts`,`edt`) values 
(1,'admin','0','admin@gmail.com','0101',0,'2020-11-03 10:24:14');

/*Table structure for table `party_details` */

DROP TABLE IF EXISTS `party_details`;

CREATE TABLE `party_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_nm` varchar(100) DEFAULT '0',
  `mobile` varchar(50) DEFAULT '0',
  `adrs` varchar(500) DEFAULT '0',
  `email` varchar(50) DEFAULT '0',
  `gst_no` varchar(30) DEFAULT '0',
  `state` varchar(50) DEFAULT '0',
  `city_pin` varchar(10) DEFAULT '0',
  `sts` int(4) DEFAULT '0',
  `edt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `party_details` */

insert  into `party_details`(`id`,`company_nm`,`mobile`,`adrs`,`email`,`gst_no`,`state`,`city_pin`,`sts`,`edt`) values 
(1,'UNIQUE SOLUTIONS','9890117602','SOLAPUR','ravikirankota92@gmail.com','123456','1','413005',0,'2020-11-24 22:19:47'),
(2,'VENKANT INFOTECH','8668749439','SOLAPUR','kotakiran028@gmail.com','6548465','2','413006',0,'2020-11-24 22:20:57');

/*Table structure for table `puchase_entry_info` */

DROP TABLE IF EXISTS `puchase_entry_info`;

CREATE TABLE `puchase_entry_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastId` varchar(50) DEFAULT '0',
  `hsc_code` varchar(50) DEFAULT '0',
  `item_nm` varchar(500) DEFAULT '0',
  `rate` varchar(20) DEFAULT '0',
  `qty` varchar(20) DEFAULT '0',
  `total` varchar(20) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `puchase_entry_info` */

insert  into `puchase_entry_info`(`id`,`lastId`,`hsc_code`,`item_nm`,`rate`,`qty`,`total`,`edt`) values 
(1,'1','8528','1','2500','5','12500','2020-11-24 22:37:44'),
(2,'1','84733099','2','1250','2','2500','2020-11-24 22:37:44'),
(3,'2','8528','1','2500','5','12500','2020-11-24 22:40:35'),
(4,'2','84733099','2','1250','2','2500','2020-11-24 22:40:35');

/*Table structure for table `purchase_entry` */

DROP TABLE IF EXISTS `purchase_entry`;

CREATE TABLE `purchase_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `party_id` varchar(100) DEFAULT '0',
  `bill_no` varchar(50) DEFAULT '0',
  `date` varchar(50) DEFAULT '0',
  `purchase_type` int(4) DEFAULT '0',
  `gst_type` int(4) DEFAULT '0',
  `total` varchar(100) DEFAULT '0',
  `discount_type` int(4) DEFAULT '0',
  `discnt_amt_per` varchar(100) DEFAULT '0',
  `dis_total` varchar(50) DEFAULT '0',
  `sgst` varchar(20) DEFAULT '0',
  `cgst` varchar(20) DEFAULT '0',
  `igst` varchar(20) DEFAULT '0',
  `grand_tot` varchar(20) DEFAULT '0',
  `pay_bill_amt` int(4) DEFAULT '0',
  `payamt` varchar(30) DEFAULT '0',
  `balamt` varchar(30) DEFAULT '0',
  `stock_sts` int(4) DEFAULT '0',
  `sts` int(4) DEFAULT '0',
  `edt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `purchase_entry` */

insert  into `purchase_entry`(`id`,`party_id`,`bill_no`,`date`,`purchase_type`,`gst_type`,`total`,`discount_type`,`discnt_amt_per`,`dis_total`,`sgst`,`cgst`,`igst`,`grand_tot`,`pay_bill_amt`,`payamt`,`balamt`,`stock_sts`,`sts`,`edt`) values 
(1,'1','112233','2020-11-24',1,2,'15000',1,'15.2542','2288.13','762.71','762.71','0','14237',1,'12000.15','2237',1,0,'2020-11-24 22:37:44'),
(2,'2','2233156','2020-11-24',1,1,'15000',1,'15.2542','2288.13','0','0','2288.14','15000',1,'3000','12000',1,0,'2020-11-24 22:40:34');

/*Table structure for table `purchase_outstanding` */

DROP TABLE IF EXISTS `purchase_outstanding`;

CREATE TABLE `purchase_outstanding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(50) DEFAULT '0',
  `receipt_no` varchar(50) DEFAULT '0',
  `bill_no` varchar(50) DEFAULT '0',
  `date` varchar(50) DEFAULT '0',
  `grand_tot` varchar(50) DEFAULT '0',
  `paid_amt` varchar(50) DEFAULT '0',
  `bal_amt` varchar(50) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `purchase_outstanding` */

insert  into `purchase_outstanding`(`id`,`purchase_id`,`receipt_no`,`bill_no`,`date`,`grand_tot`,`paid_amt`,`bal_amt`,`edt`) values 
(1,1,'1','112233','2020-11-24','14237','12000.15','2237','2020-11-24 22:37:44'),
(2,1,'2','112233','2020-11-24','14237','2236','0.849999999999909','2020-11-24 22:38:26'),
(3,2,'3','2233156','2020-11-24','15000','3000','12000','2020-11-24 22:40:35'),
(4,2,'4','2233156','2020-11-24','15000','1000','11000','2020-11-24 23:59:36'),
(5,1,'5','112233','2020-11-24','14237','0.85','3.6004532688593827e-13','2020-11-24 23:59:52');

/*Table structure for table `purchase_party_details` */

DROP TABLE IF EXISTS `purchase_party_details`;

CREATE TABLE `purchase_party_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_nm` varchar(100) DEFAULT '0',
  `mobile` varchar(50) DEFAULT '0',
  `adrs` varchar(500) DEFAULT '0',
  `email` varchar(50) DEFAULT '0',
  `gst_no` varchar(30) DEFAULT '0',
  `state` int(4) DEFAULT '0',
  `city_pin` varchar(10) DEFAULT '0',
  `sts` int(4) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `purchase_party_details` */

insert  into `purchase_party_details`(`id`,`company_nm`,`mobile`,`adrs`,`email`,`gst_no`,`state`,`city_pin`,`sts`,`edt`) values 
(1,'SHRIAPP','9561294216','SOLAPUR','ravikirankota29@gmail.com','651782154',1,'413009',0,'2020-11-24 22:22:11'),
(2,'DREAM TECHNOLOGY','9890117602','SOLAPUR','uniquesolutions@gmail.com','65489687',2,'413007',0,'2020-11-24 22:23:04');

/*Table structure for table `sale_billno` */

DROP TABLE IF EXISTS `sale_billno`;

CREATE TABLE `sale_billno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(30) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `sale_billno` */

insert  into `sale_billno`(`id`,`bill_no`,`edt`) values 
(1,'US00001','2020-11-24 23:00:43'),
(2,'US00002','2020-11-24 23:27:49'),
(3,'US00003','2020-11-24 23:52:23'),
(4,'US00004','2020-11-24 23:56:16');

/*Table structure for table `sale_entry` */

DROP TABLE IF EXISTS `sale_entry`;

CREATE TABLE `sale_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `party_id` varchar(100) DEFAULT '0',
  `bill_no` varchar(50) DEFAULT '0',
  `date` varchar(50) DEFAULT '0',
  `sale_type` int(4) DEFAULT '0',
  `gst_type` int(4) DEFAULT '0',
  `total` varchar(100) DEFAULT '0',
  `discount_type` int(4) DEFAULT '0',
  `discnt_amt_per` varchar(100) DEFAULT '0',
  `dis_total` varchar(50) DEFAULT '0',
  `sgst` varchar(20) DEFAULT '0',
  `cgst` varchar(20) DEFAULT '0',
  `igst` varchar(20) DEFAULT '0',
  `grand_tot` varchar(20) DEFAULT '0',
  `pay_bill_amt` int(4) DEFAULT '0',
  `payamt` varchar(30) DEFAULT '0',
  `balamt` varchar(30) DEFAULT '0',
  `sts` int(4) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `sale_entry` */

insert  into `sale_entry`(`id`,`party_id`,`bill_no`,`date`,`sale_type`,`gst_type`,`total`,`discount_type`,`discnt_amt_per`,`dis_total`,`sgst`,`cgst`,`igst`,`grand_tot`,`pay_bill_amt`,`payamt`,`balamt`,`sts`,`edt`) values 
(1,'1','US00001','2020-11-24',1,2,'11250',1,'15.2542','1716.0975','572.03','572.03','0','9534',2,'1200','9534',0,'2020-11-24 23:00:43'),
(2,'2','US00002','2020-11-24',1,1,'11250',1,'13.75','1546.875','0','0','1746.56','11450',1,'4500','6950',0,'2020-11-24 23:27:50'),
(3,'1','US00003','2020-11-24',2,4,'5000',1,'15.53','776.5','0','0','0','4224',2,'0','4224',0,'2020-11-24 23:52:23'),
(4,'1','US00004','2020-11-24',1,3,'2500',0,'100','100','60.00','60.00','0','2520',1,'520','2000',0,'2020-11-24 23:56:17');

/*Table structure for table `sale_entry_info` */

DROP TABLE IF EXISTS `sale_entry_info`;

CREATE TABLE `sale_entry_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastId` varchar(50) DEFAULT '0',
  `hsc_code` varchar(50) DEFAULT '0',
  `item_nm` varchar(500) DEFAULT '0',
  `stock_qty` varchar(20) DEFAULT '0',
  `qty` varchar(20) DEFAULT '0',
  `rate` varchar(20) DEFAULT '0',
  `total` varchar(50) NOT NULL DEFAULT '0',
  `edt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `sale_entry_info` */

insert  into `sale_entry_info`(`id`,`lastId`,`hsc_code`,`item_nm`,`stock_qty`,`qty`,`rate`,`total`,`edt`) values 
(1,'1','8528','1','10','3','2500','7500','2020-11-24 23:00:43'),
(2,'1','84733099','2','4','3','1250','3750','2020-11-24 23:00:43'),
(3,'2','8528','1','7','4','2500','10000','2020-11-24 23:27:50'),
(4,'2','84733099','2','1','1','1250','1250','2020-11-24 23:27:50'),
(5,'3','8528','1','3','2','2500','5000','2020-11-24 23:52:23'),
(6,'4','8528','1','1','1','2500','2500','2020-11-24 23:56:17');

/*Table structure for table `sale_outstanding` */

DROP TABLE IF EXISTS `sale_outstanding`;

CREATE TABLE `sale_outstanding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(50) DEFAULT '0',
  `receipt_no` varchar(50) DEFAULT '0',
  `bill_no` varchar(50) DEFAULT '0',
  `date` varchar(50) DEFAULT '0',
  `grand_tot` varchar(50) DEFAULT '0',
  `paid_amt` varchar(50) DEFAULT '0',
  `bal_amt` varchar(50) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `sale_outstanding` */

insert  into `sale_outstanding`(`id`,`sale_id`,`receipt_no`,`bill_no`,`date`,`grand_tot`,`paid_amt`,`bal_amt`,`edt`) values 
(1,1,'1','US00001','2020-11-24','9534','1200','9534','2020-11-24 23:00:43'),
(2,2,'2','US00002','2020-11-24','11450','4500','6950','2020-11-24 23:27:50'),
(3,3,'3','US00003','2020-11-24','4224','0','4224','2020-11-24 23:52:23'),
(4,3,'4','US00003','2020-11-24','4224','224','4000','2020-11-24 23:54:02'),
(5,3,'4','US00003','2020-11-24','4224','2500','1500','2020-11-24 23:54:37'),
(6,1,'4','US00001','2020-11-24','9534','5689','2645','2020-11-24 23:54:55'),
(7,1,'4','US00001','2020-11-24','9534','2645','0','2020-11-24 23:55:07'),
(8,4,'8','US00004','2020-11-24','2520','520','2000','2020-11-24 23:56:17'),
(9,4,'4','US00004','2020-11-24','2520','1000','1000','2020-11-24 23:56:55');

/*Table structure for table `stock_info` */

DROP TABLE IF EXISTS `stock_info`;

CREATE TABLE `stock_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastId` varchar(20) DEFAULT '0',
  `item` varchar(50) DEFAULT '0',
  `qty` varchar(50) DEFAULT '0',
  `p_rate` varchar(50) DEFAULT '0',
  `p_total` varchar(50) NOT NULL DEFAULT '0',
  `s_rate` varchar(50) DEFAULT '0',
  `s_total` varchar(50) DEFAULT '0',
  `edt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `stock_info` */

insert  into `stock_info`(`id`,`lastId`,`item`,`qty`,`p_rate`,`p_total`,`s_rate`,`s_total`,`edt`) values 
(1,'1','1','5','2500','12500','0','0','2020-11-24 22:56:28'),
(2,'1','2','2','1250','2500','0','0','2020-11-24 22:56:29'),
(3,'2','1','5','2500','12500','0','0','2020-11-24 22:56:35'),
(4,'2','2','2','1250','2500','0','0','2020-11-24 22:56:35');

/*Table structure for table `stock_maintain` */

DROP TABLE IF EXISTS `stock_maintain`;

CREATE TABLE `stock_maintain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` varchar(50) DEFAULT '0',
  `itemId` varchar(100) DEFAULT '0',
  `prev_rate` varchar(50) DEFAULT '0',
  `rate` varchar(50) DEFAULT '0',
  `qty` varchar(50) DEFAULT '0',
  `bal` varchar(50) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `stock_maintain` */

insert  into `stock_maintain`(`id`,`dt`,`itemId`,`prev_rate`,`rate`,`qty`,`bal`,`edt`) values 
(1,'2020-11-24','1','0','2500','0','10','2020-11-24 22:56:29'),
(2,'2020-11-24','2','0','1250','0','4','2020-11-24 22:56:29');

/*Table structure for table `stock_master` */

DROP TABLE IF EXISTS `stock_master`;

CREATE TABLE `stock_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` varchar(50) DEFAULT '0',
  `purchase_invoice` varchar(100) DEFAULT '0',
  `edt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `stock_master` */

insert  into `stock_master`(`id`,`dt`,`purchase_invoice`,`edt`) values 
(1,'2020-11-24','1','2020-11-24 22:56:28'),
(2,'2020-11-24','2','2020-11-24 22:56:35');

/* Procedure structure for procedure `ab` */

/*!50003 DROP PROCEDURE IF EXISTS  `ab` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ab`()
BEGIN
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
