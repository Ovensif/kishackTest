/*
SQLyog Ultimate
MySQL - 10.4.11-MariaDB : Database - db_padepokan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_padepokan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_padepokan`;

/*Table structure for table `tb_nasabah` */

DROP TABLE IF EXISTS `tb_nasabah`;

CREATE TABLE `tb_nasabah` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_nasabah` */

insert  into `tb_nasabah`(`id`,`name`,`point`) values 
(1,'imam',15);

/*Table structure for table `tb_transaction` */

DROP TABLE IF EXISTS `tb_transaction`;

CREATE TABLE `tb_transaction` (
  `id_transaction` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_ticket` varchar(25) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `type` enum('D','C') DEFAULT NULL COMMENT 'D = Debit, C = Credit',
  `point` int(11) NOT NULL DEFAULT 0,
  `transaction_date` date NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_transaction`),
  KEY `idKey` (`id_nasabah`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_transaction` */

insert  into `tb_transaction`(`id_transaction`,`transaction_ticket`,`id_nasabah`,`amount`,`description`,`type`,`point`,`transaction_date`,`created_date`) values 
(1,'D202202201652551',1,12200,'beli_pulsa','D',2,'2022-02-20','2022-02-20 22:52:55'),
(2,'C202202201653191',1,30000,'bayar_listrik','C',0,'2022-02-20','2022-02-20 22:53:19'),
(3,'D202202201653361',1,75000,'bayar_listrik','D',13,'2022-02-20','2022-02-20 22:53:36');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
