/*
SQLyog - Free MySQL GUI v5.02
Host - 5.1.41-community : Database - keuperpususd
*********************************************************************
Server version : 5.1.41-community
*/


create database if not exists `keuperpususd`;

USE `keuperpususd`;

/*Table structure for table `jenistransaksi` */

DROP TABLE IF EXISTS `jenistransaksi`;

CREATE TABLE `jenistransaksi` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `jenistransaksi` varchar(50) DEFAULT NULL,
  `isedittable` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `jenistransaksi` */

insert into `jenistransaksi` values 
(1,'Denda Buku','N'),
(2,'Anggota Baca','N'),
(3,'Transkasi Bag.Fotokopi','N');
