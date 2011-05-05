/*
SQLyog - Free MySQL GUI v5.02
Host - 5.1.41-community : Database - keuperpususd
*********************************************************************
Server version : 5.1.41-community
*/


create database if not exists `keuperpususd`;

USE `keuperpususd`;

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `idmenu` int(10) NOT NULL AUTO_INCREMENT,
  `nmmenu` varchar(100) DEFAULT NULL,
  `tipemenu` int(1) DEFAULT NULL COMMENT '1 : page singgle 2: Page list',
  `idkomponen` int(10) DEFAULT NULL,
  `iduser` int(10) DEFAULT '0',
  `parentmenu` int(10) DEFAULT NULL,
  `urlci` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert into `menu` values 
(3,'Add Komponen',1,4,0,0,'ctrkomponen/index'),
(2,'Add Menu',1,4,0,0,'ctrmenu/index'),
(1,'Transaksi',1,2,0,0,''),
(11,'R A B',1,2,0,0,''),
(12,'Anggota Baca',1,2,0,0,''),
(10,'Produk',1,45,0,0,'ctrproduk'),
(13,'Setting Kamus',2,2,0,0,''),
(55,'Isi / Edit Produk (PLU)',1,2,0,1,'ctrprodukplu'),
(80,'Menu Priviledges',1,2,0,68,'ctrusermenu'),
(56,'Lokasi Kampus',1,2,0,13,'ctrlokasi'),
(57,'Isi Edit/ Unit Kerja',1,2,0,13,'ctrunitkerja'),
(58,'Isi / Edit Pegawai',1,2,0,59,'ctrpegawai'),
(59,'Setting Personalia',1,2,0,0,''),
(60,'Isi/Edit Jabatan',1,2,0,13,'ctrjabatan'),
(61,'Isi / Edit Pejabat',1,2,0,59,'ctrperjabatperpus'),
(62,'Jenis Transaksi',1,2,0,13,'ctrjenistransaksi'),
(65,'Group Pengguna di PLU',1,2,0,13,'ctrjenipengguna'),
(64,'Status PLU',1,2,0,13,'ctrstatusplu'),
(66,'Rekanan',1,2,0,59,'ctrrekanan'),
(67,'Denda Buku',1,2,0,0,''),
(68,'User Priviledges',1,2,0,0,''),
(69,'Jenis Anggota Baca',1,2,0,13,'ctrjenisanggotabaca'),
(70,'Isi Data Anggota Baca',1,2,0,12,'ctranggotabaca'),
(71,'Laporan',1,2,0,0,''),
(72,'Setting Biaya Anggota Baca',1,2,0,12,'ctrbiayaanggotabaca'),
(73,'logout',1,2,0,0,'perpus/logout'),
(74,'Transaksi Foto Kopi',1,2,0,1,'ctrtransaksifotokopi'),
(75,'Pengisian Nama RAB',1,2,0,11,'ctrrab'),
(76,'Tahun Anggran',1,2,0,11,'ctrtahunanggaran'),
(77,'Posting Anggaran ',1,2,0,11,'ctrpostingrab'),
(78,'Realisasi RAB',1,2,0,11,'ctrrealisasirab'),
(79,'Denda',1,2,0,67,'ctrdenda'),
(81,'RAB Priviledges',1,2,0,68,'ctruserrab'),
(82,'Pembayaran ke Rekanan',1,2,0,1,'ctrsetoran'),
(83,'Detail Fotokopi Perbulan',1,2,0,71,'ctrlapfotokopibulan'),
(84,'Rekapitulasi Fotokopi,Anggota baca dan Denda Buku',1,2,0,71,'ctrlaprekapfcdendaab'),
(85,'Detail Fotokopi,Anggota baca dan Denda Buku',1,2,0,71,'ctrlaprekapfcdendaabdetail'),
(86,'Fotokopi,Print,Jilid Keperluan Dinas',1,2,0,71,'ctrlaprekapfcdinas'),
(87,'Fotokopi,Print,Jilid Keperluan  Pribadi',1,2,0,71,'ctrlaprekapfcpribadi'),
(88,'Laporan Realisasi RAB',1,2,0,71,'ctrlaprealisasirab'),
(89,'Laporan Realisasi RAB Detail',1,2,0,71,'ctrlaprealisasirabdetail'),
(90,'Laporan Setoran Kerekanan Perbulan',1,2,0,71,'ctrlapsetoran'),
(91,'Jenis Biaya Anggota Baca',1,2,0,13,'ctrjnsbiayaagtbaca'),
(93,'Laporan Denda Harian',1,2,0,71,'ctrlapdendaharian'),
(94,'Laporan Harian Peruser',1,2,0,71,'ctrlaprekapfcdendaabperuser');
