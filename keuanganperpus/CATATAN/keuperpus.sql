/*
SQLyog - Free MySQL GUI v5.02
Host - 5.1.41-community : Database - keuperpususd
*********************************************************************
Server version : 5.1.41-community
*/


create database if not exists `keuperpususd`;

USE `keuperpususd`;

/*Table structure for table `anggotabaca` */

DROP TABLE IF EXISTS `anggotabaca`;

CREATE TABLE `anggotabaca` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `NoIdentitas` varchar(40) DEFAULT NULL COMMENT 'No KTP, SIM, KTM',
  `Nama` varchar(100) DEFAULT NULL,
  `idJenisAnggota` int(10) DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `Kota` varchar(40) DEFAULT NULL,
  `kodepos` varchar(40) DEFAULT NULL,
  `Notelp` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `tanggalgabung` date DEFAULT NULL,
  `biaya` int(15) DEFAULT NULL,
  `idjnsbiaya` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `anggotabaca` */

insert into `anggotabaca` values 
(1,'KTP.0998777','coba trx',1,'alamat','jogja','555432','02747474898','testemail',NULL,NULL,2),
(3,'coba','testss',2,'sad','sadsd','','','',NULL,NULL,2);

/*Table structure for table `bahasa` */

DROP TABLE IF EXISTS `bahasa`;

CREATE TABLE `bahasa` (
  `idbahasa` int(10) NOT NULL AUTO_INCREMENT,
  `bahasa` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idbahasa`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `bahasa` */

insert into `bahasa` values 
(1,'Bahasa Indonesia'),
(2,'English'),
(3,'Java'),
(5,'jepang'),
(8,'mandarin');

/*Table structure for table `contactus` */

DROP TABLE IF EXISTS `contactus`;

CREATE TABLE `contactus` (
  `idx` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `NoTelpon` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `pesan` text,
  `kettambahan` text,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `contactus` */

insert into `contactus` values 
(1,'Dolphin','cobaa','0274','','','Anda Bisa Menghubungi Kami :<br/>\nDatang diAlamat :<br/>\n----Tuliskan Alamat disini --- <br/>\nTelephon : ----Tuliskan disini --- <br />\nNo HP : ----Tuliskan  disini --- <br />\nEmail : ----Tuliskan  disini --- <br />\nAtau Pesan dengan melengkapi data berikut :<br />');

/*Table structure for table `field` */

DROP TABLE IF EXISTS `field`;

CREATE TABLE `field` (
  `idfield` int(10) NOT NULL AUTO_INCREMENT,
  `nmfield` varchar(20) DEFAULT NULL COMMENT 'Judul, isi, nama',
  `idmenu` int(10) DEFAULT NULL,
  PRIMARY KEY (`idfield`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `field` */

insert into `field` values 
(2,'',0);

/*Table structure for table `hargajenistransaksi` */

DROP TABLE IF EXISTS `hargajenistransaksi`;

CREATE TABLE `hargajenistransaksi` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `idJenisTransaksi` int(10) DEFAULT NULL,
  `biaya` int(15) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `hargajenistransaksi` */

insert into `hargajenistransaksi` values 
(1,2,50000);

/*Table structure for table `image` */

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image` (
  `idimage` int(10) NOT NULL AUTO_INCREMENT,
  `imgurl` varchar(50) DEFAULT NULL,
  `idmenu` int(10) DEFAULT NULL,
  `idField` int(10) DEFAULT NULL,
  `idkomponen` int(10) DEFAULT NULL,
  PRIMARY KEY (`idimage`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `image` */

insert into `image` values 
(1,'FTPupload.jpg',NULL,NULL,NULL),
(2,'informasi.jpg',NULL,NULL,NULL),
(3,'g1201008000069.jpg',NULL,NULL,NULL),
(4,'g1201008000021.jpg',NULL,NULL,NULL),
(5,'g1201405000009.jpg',NULL,NULL,NULL),
(6,'g2201008000011.jpg',NULL,NULL,NULL),
(7,'g6201405000025.jpg',NULL,NULL,NULL),
(15,'webaplication.png',32,0,36),
(18,'globe_128.png',31,0,35),
(17,'webinformation.png',33,0,37),
(22,'128.png',34,0,38),
(25,'',37,0,4),
(27,'contactus.png',35,0,39),
(30,'desktop.png',36,0,40),
(39,'',49,0,44);

/*Table structure for table `isgroup` */

DROP TABLE IF EXISTS `isgroup`;

CREATE TABLE `isgroup` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `isgroup` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `isgroup` */

insert into `isgroup` values 
(1,'Group'),
(2,'Child / Anak');

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `NmJabatan` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `jabatan` */

insert into `jabatan` values 
(1,'Kepala Perpustakaan'),
(2,'Wakil Kepala Perpustakaan');

/*Table structure for table `jenipengguna` */

DROP TABLE IF EXISTS `jenipengguna`;

CREATE TABLE `jenipengguna` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `JenisPengguna` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `jenipengguna` */

insert into `jenipengguna` values 
(1,'Mahasiswa'),
(2,'Dinas'),
(3,'Potong Gaji'),
(4,'Anggota Baca');

/*Table structure for table `jenisanggotabaca` */

DROP TABLE IF EXISTS `jenisanggotabaca`;

CREATE TABLE `jenisanggotabaca` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `jenisanggotabaca` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `jenisanggotabaca` */

insert into `jenisanggotabaca` values 
(1,'Mahasiswa'),
(2,'Dosen');

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
(3,'Fotocopy','N'),
(4,'Lainnya','Y');

/*Table structure for table `jnsbiayaagtbaca` */

DROP TABLE IF EXISTS `jnsbiayaagtbaca`;

CREATE TABLE `jnsbiayaagtbaca` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `nmbiaya` varchar(30) DEFAULT NULL,
  `biaya` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `jnsbiayaagtbaca` */

insert into `jnsbiayaagtbaca` values 
(1,'Umum',50000),
(2,'Jogja LIB 1 bln',30000);

/*Table structure for table `komponen` */

DROP TABLE IF EXISTS `komponen`;

CREATE TABLE `komponen` (
  `idkomponen` int(10) NOT NULL AUTO_INCREMENT COMMENT 'header,menu,iklan,isi,keterangan filed form',
  `NmKomponen` varchar(40) DEFAULT NULL,
  `isshow` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idkomponen`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `komponen` */

insert into `komponen` values 
(1,'Header','T'),
(2,'menuatas','T'),
(3,'Menu Kiri','T'),
(4,'Menu kanan','T'),
(35,'Menu Atas 1','Y'),
(36,'Menu Atas 2','Y'),
(37,'Menu Atas 3','Y'),
(38,'Menu Bawah 1','Y'),
(39,'Menu Bawah 2','Y'),
(40,'Menu Bawah 3','Y'),
(41,'Isi Tengah','Y'),
(42,'Organisation','Y'),
(43,'Fasilitas','Y'),
(44,'Berita','Y'),
(45,'Prestasi','Y');

/*Table structure for table `listmenu` */

DROP TABLE IF EXISTS `listmenu`;

CREATE TABLE `listmenu` (
  `idlistmenu` int(10) NOT NULL AUTO_INCREMENT,
  `idmenu` int(10) DEFAULT NULL,
  `tglisi` date DEFAULT NULL,
  `tglupdate` date DEFAULT NULL,
  `isaktif` char(1) DEFAULT NULL,
  PRIMARY KEY (`idlistmenu`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `listmenu` */

/*Table structure for table `lokasi` */

DROP TABLE IF EXISTS `lokasi`;

CREATE TABLE `lokasi` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `NmLokasi` varchar(40) DEFAULT NULL,
  `ipsegment` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `lokasi` */

insert into `lokasi` values 
(1,'Mrican','192.168.0.0'),
(2,'Paingan','192.168.0.0');

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
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert into `menu` values 
(3,'Add Komponen',1,4,0,0,'ctrkomponen/index'),
(2,'Add Menu',1,4,0,0,'ctrmenu/index'),
(1,'Fotokopi',1,2,0,0,''),
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
(91,'Jenis Biaya Anggota Baca',1,2,0,13,'ctrjnsbiayaagtbaca');

/*Table structure for table `menuatasbawah` */

DROP TABLE IF EXISTS `menuatasbawah`;

CREATE TABLE `menuatasbawah` (
  `idmenu` int(10) DEFAULT NULL,
  `idgroup` int(10) DEFAULT NULL,
  `awal` text,
  `isi` text,
  `icon` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `menuatasbawah` */

/*Table structure for table `pegawai` */

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `npp` varchar(20) DEFAULT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `idUnitKerja` int(10) DEFAULT NULL,
  `NoTelpon` varchar(50) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `idLokasi` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pegawai` */

insert into `pegawai` values 
(1,'P.2188','Coba Diar',1,'0274747474','demo','demo',2),
(2,'P.001','Test',2,'04532','test','test',2);

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `iduser` int(10) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `pengguna` */

/*Table structure for table `perjabatperpus` */

DROP TABLE IF EXISTS `perjabatperpus`;

CREATE TABLE `perjabatperpus` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `idPegawai` int(10) DEFAULT NULL,
  `idjabatan` int(10) DEFAULT NULL,
  `tglawaljawabatan` date DEFAULT NULL,
  `tglakhirjabatan` date DEFAULT NULL,
  `idunitkerja` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `perjabatperpus` */

insert into `perjabatperpus` values 
(1,1,0,'2011-03-27','2011-02-25',1);

/*Table structure for table `postingrab` */

DROP TABLE IF EXISTS `postingrab`;

CREATE TABLE `postingrab` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `idrab` int(10) DEFAULT NULL,
  `idtahunanggaran` int(10) DEFAULT NULL,
  `nominalposting` int(20) DEFAULT NULL,
  `tglisi` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `iduser` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `postingrab` */

insert into `postingrab` values 
(5,5,12,50000,'2011-04-28','00:00:00',1),
(4,4,12,30000,'2011-04-06','00:00:00',1),
(3,3,12,3000,'2011-04-05','00:00:00',1);

/*Table structure for table `produkplu` */

DROP TABLE IF EXISTS `produkplu`;

CREATE TABLE `produkplu` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `KodePLU` varchar(20) DEFAULT NULL,
  `idJnsPengguna` int(10) DEFAULT NULL COMMENT 'MHS,unitkerja,potogaji,anggotabaca',
  `NamaProduk` varchar(50) DEFAULT NULL,
  `Singkatan` varchar(30) DEFAULT NULL,
  `idstatusPLU` int(10) DEFAULT NULL,
  `idrekanan` int(10) DEFAULT NULL COMMENT 'idvendor',
  `harga` int(15) DEFAULT NULL,
  `idjenistransaksi` int(10) DEFAULT NULL COMMENT 'untuk otomatisasi transaksi',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `produkplu` */

insert into `produkplu` values 
(1,'001',1,'Copy A3','A3',1,1,100,5),
(2,'023',2,'Coba Dinas','A3',1,1,120,4),
(3,'024',3,'coba Potong Gaji','A4',1,1,130,3),
(4,'002',1,'Fotokopi Folio 70 ','FC 70 gram',1,1,125,5),
(5,'017',1,'Print Laser A4 iR500','',3,1,300,3),
(6,'018',1,'Print Collour A4 Full Colour','',4,1,1500,3),
(7,'041',3,'Fotokopi KUARTO 70','KUARTO',1,1,120,3),
(8,'037',2,'Print Laser A4 irR500','Print',3,1,150,3);

/*Table structure for table `rab` */

DROP TABLE IF EXISTS `rab`;

CREATE TABLE `rab` (
  `idx` int(20) NOT NULL AUTO_INCREMENT,
  `JudulRAB` varchar(100) DEFAULT NULL,
  `idparent` int(20) DEFAULT NULL,
  `kodeRAB` varchar(50) DEFAULT NULL,
  `kodeRABUSD` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `rab` */

insert into `rab` values 
(1,'Eksploitasi',0,'001',''),
(2,'Investasi',0,'002',''),
(3,'Gaji',1,'001.001',''),
(4,'Administrasi',1,'001.002',''),
(5,'Rapat Kerja',1,'001.003','-'),
(6,'Kegiatan Pengambangan',1,'001.004','-'),
(7,'Biaya Perawatan',1,'001.005','-'),
(8,'Lain-lain',1,'001.006','-'),
(9,'Sarana Pendukung Kegiatan Rutin',2,'002.001','-'),
(10,'Investasi Buku',8,'001.006.001','-');

/*Table structure for table `realisasirab` */

DROP TABLE IF EXISTS `realisasirab`;

CREATE TABLE `realisasirab` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `idrab` int(10) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `nominal` int(20) DEFAULT NULL,
  `iduser` int(10) DEFAULT NULL,
  `idthnanggaran` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `realisasirab` */

insert into `realisasirab` values 
(1,'2011-04-07','15:25:06',4,'Pembelian Meja',20000,1,12),
(2,'2011-04-26','22:03:23',4,'Pembelian Pensil',12000,1,12),
(3,'2011-04-28','12:46:41',5,'Pembelian Snack Untuk Demo Program',10000,1,12);

/*Table structure for table `rekanan` */

DROP TABLE IF EXISTS `rekanan`;

CREATE TABLE `rekanan` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `NamaRekanan` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `NoTelephon` varchar(30) DEFAULT NULL,
  `NamaPenanggungJawab` varchar(50) DEFAULT NULL,
  `NoTelpPenanggungJawab` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `rekanan` */

insert into `rekanan` values 
(1,'Istana Fotokopi','','','Th.Anda Halim','');

/*Table structure for table `reportingbug` */

DROP TABLE IF EXISTS `reportingbug`;

CREATE TABLE `reportingbug` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `tanggapan` text,
  `iduser` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `tanggaltanggapan` date DEFAULT NULL,
  `jamtanggapan` time DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `reportingbug` */

insert into `reportingbug` values 
(1,'http://localhost/keuanganperpus/index.php/ctrrealisasirab','keterangan tidak masuk ke database',NULL,1,'2011-04-28','10:46:18',NULL,NULL),
(2,'http://localhost/keuanganperpus/index.php/ctranggotabaca','',NULL,1,'2011-05-02','12:12:57',NULL,NULL),
(3,'http://localhost/keuanganperpus/index.php/ctranggotabaca','',NULL,1,'2011-05-02','12:14:58',NULL,NULL),
(4,'http://localhost/keuanganperpus/index.php/ctranggotabaca','assdsd',NULL,1,'2011-05-02','12:17:19',NULL,NULL);

/*Table structure for table `setoran` */

DROP TABLE IF EXISTS `setoran`;

CREATE TABLE `setoran` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `NoBuktiSetoran` varchar(40) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `idrekanan` int(10) DEFAULT NULL,
  `nominal` int(15) DEFAULT NULL,
  `idstatusplu` int(10) DEFAULT NULL,
  `iduser` int(10) DEFAULT NULL,
  `idlokasi` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `setoran` */

insert into `setoran` values 
(1,'1234','2011-04-26',1,10000,1,1,2);

/*Table structure for table `statusplu` */

DROP TABLE IF EXISTS `statusplu`;

CREATE TABLE `statusplu` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `Status` varchar(20) DEFAULT NULL,
  `prosenreguler` int(10) DEFAULT NULL,
  `prosenperpus` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `statusplu` */

insert into `statusplu` values 
(1,'Fotocopy',15,20),
(2,'Jilid',15,20),
(3,'Print Biasa',20,20),
(4,'Print Warna',20,20);

/*Table structure for table `tahunanggaran` */

DROP TABLE IF EXISTS `tahunanggaran`;

CREATE TABLE `tahunanggaran` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `TahunAnggaran` varchar(20) DEFAULT NULL,
  `statusaaktif` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tahunanggaran` */

insert into `tahunanggaran` values 
(10,'2009','N'),
(12,'2011','Y'),
(11,'2010','N');

/*Table structure for table `tipemenu` */

DROP TABLE IF EXISTS `tipemenu`;

CREATE TABLE `tipemenu` (
  `idTipeMenu` varchar(1) DEFAULT NULL,
  `NmTipeMenu` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tipemenu` */

insert into `tipemenu` values 
('1','Singgle'),
('2','Berbentuk Daftar');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `idplu` varchar(20) DEFAULT NULL,
  `idjenistransaksi` int(10) DEFAULT NULL,
  `idstatusplu` int(10) DEFAULT NULL,
  `idgrouppengguna` int(10) DEFAULT NULL,
  `idpegawai` int(10) DEFAULT NULL,
  `idunitkerja` int(10) DEFAULT NULL,
  `idstatusdinas` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL COMMENT '1,2',
  `jumlahsatuan` int(10) DEFAULT NULL COMMENT '100,100',
  `nominalpersatuan` int(10) DEFAULT NULL COMMENT '100,200',
  `total` int(10) DEFAULT NULL,
  `iduser` int(10) DEFAULT NULL,
  `nominaldenda` int(10) DEFAULT NULL,
  `iddendasparta` varchar(30) DEFAULT NULL,
  `NIM` varchar(20) DEFAULT NULL,
  `idlokasi` int(10) DEFAULT NULL,
  `isbukuperpus` enum('Y','N') DEFAULT 'N',
  `prosenpotong` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert into `transaksi` values 
(32,'001',3,1,1,0,0,1,'2011-04-19','10:44:46',10,100,1000,1,0,'undefined',NULL,2,'N',NULL),
(14,'023',3,NULL,NULL,0,0,0,'2011-04-05','09:38:51',1,120,120,1,0,'undefined',NULL,2,'N',NULL),
(15,'023',3,NULL,NULL,0,0,0,'2011-04-06','05:26:36',10,120,1200,1,0,'undefined',NULL,2,'N',NULL),
(16,'023',3,NULL,NULL,0,0,0,'2011-04-06','05:52:44',10,120,1200,1,0,'undefined',NULL,2,'N',NULL),
(17,'0',1,NULL,NULL,81234,0,0,'2011-04-14','10:59:47',1,0,0,1,0,'',NULL,2,'N',NULL),
(18,'0',1,NULL,NULL,0,0,0,'2011-04-14','23:05:41',1,0,0,1,0,'','0927272',2,'N',NULL),
(19,'0',1,NULL,NULL,0,0,0,'2011-04-14','23:23:37',1,12,12323,1,23213,'','21323',2,'N',NULL),
(20,'02747474',1,NULL,NULL,0,0,0,'2011-04-15','00:08:11',1,2,2323,1,2323,'',NULL,2,'N',NULL),
(21,'02382382',1,NULL,NULL,0,0,0,'2011-04-15','00:09:29',1,12,12323,1,213213,'',NULL,2,'N',NULL),
(22,'0865544',1,NULL,NULL,0,0,0,'2011-04-15','00:12:06',1,1212,1212,1,1212,'',NULL,2,'N',NULL),
(31,'023',3,1,2,1,1,2,'2011-04-19','05:44:26',2,120,240,1,0,'undefined',NULL,2,'N',NULL),
(24,'002',3,1,2,0,0,0,'2011-04-15','02:58:47',10,125,1250,1,0,'undefined',NULL,2,'N',NULL),
(25,'002',3,1,1,0,0,0,'2011-04-15','03:04:00',10,125,1250,1,0,'undefined',NULL,2,'N',NULL),
(26,'023',3,1,2,0,0,0,'2011-04-15','03:05:32',10,120,1200,1,0,'undefined',NULL,2,'N',NULL),
(27,'023',3,1,2,0,0,0,'2011-04-15','23:57:24',10,120,1200,1,0,'undefined',NULL,2,'N',NULL),
(28,'023',3,1,2,0,1,2,'2011-04-16','00:05:23',10,120,1200,1,0,'undefined',NULL,2,'N',NULL),
(29,'023',3,1,2,1,1,2,'2011-04-16','00:07:07',10,120,1200,1,0,'undefined',NULL,2,'N',NULL),
(33,'017',3,3,1,0,0,1,'2011-04-22','13:54:14',10,150,1500,1,0,'undefined',NULL,2,'N',NULL),
(34,'018',3,4,1,0,0,1,'2011-04-22','14:18:09',10,1500,15000,1,0,'undefined',NULL,2,'N',NULL),
(35,'0',2,NULL,NULL,1,0,0,'2011-04-26','01:01:01',1,60000,60000,1,0,'',NULL,2,'N',NULL),
(36,'002',3,1,1,0,0,1,'2011-04-26','22:31:37',10,125,1250,1,0,'undefined',NULL,2,'N',NULL),
(37,'001',3,1,1,0,0,1,'2011-04-26','22:34:08',5,100,500,1,0,'undefined',NULL,2,'N',NULL),
(38,'002',3,1,1,0,0,1,'2011-04-26','22:36:17',9,125,1125,1,0,'undefined',NULL,2,'N',NULL),
(43,'018',3,4,1,0,0,1,'2011-04-28','00:36:03',10,1500,15000,1,0,'undefined',NULL,1,'N',NULL),
(41,NULL,1,NULL,NULL,0,0,0,'2011-04-26','23:05:21',1,1500,1500,1,2000,'','065314093',2,'N',NULL),
(42,'041',3,1,3,1,1,3,'2011-04-27','12:32:38',10,120,1200,1,0,'undefined',NULL,2,'N',NULL),
(44,'037',3,3,2,1,1,2,'2011-04-28','11:27:16',15,150,2250,1,0,'undefined',NULL,1,'N',NULL),
(45,'0',2,NULL,NULL,2,0,0,'2011-04-30','01:01:01',1,50000,50000,1,0,'',NULL,1,'N',NULL),
(46,'023',3,1,2,1,1,2,'2011-05-02','05:24:29',10,120,1200,1,0,'undefined',NULL,1,'N',15),
(47,'023',3,1,2,1,1,2,'2011-05-02','05:36:10',10,120,1200,1,0,'undefined',NULL,1,'N',15),
(48,'023',3,1,2,0,0,2,'2011-05-02','05:37:00',10,120,1200,1,0,'undefined',NULL,1,'Y',20),
(49,'001',3,1,1,0,0,1,'2011-05-02','11:27:55',10,100,1000,1,0,'undefined',NULL,1,'Y',20),
(50,'0',2,NULL,NULL,3,0,0,'2011-05-02','00:00:00',1,30000,30000,1,0,'',NULL,1,'N',NULL);

/*Table structure for table `translete` */

DROP TABLE IF EXISTS `translete`;

CREATE TABLE `translete` (
  `idtranslete` int(20) NOT NULL AUTO_INCREMENT,
  `isi` text,
  `idbahasa` int(10) DEFAULT NULL,
  `idfield` int(10) DEFAULT NULL,
  `idmenu` int(10) DEFAULT NULL,
  `idkomponen` int(10) DEFAULT NULL,
  PRIMARY KEY (`idtranslete`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `translete` */

insert into `translete` values 
(5,'<p>listikkre hiduppp</p>',1,1,16,0),
(1,'<table border=\"0\" width=\"701\" height=\"225\">\n<tbody>\n<tr>\n<td><img src=\"../../../resource/uploaded/profilgbr1.png\" alt=\"\" width=\"166\" height=\"178\" /></td>\n<td valign=\"top\"><img src=\"../../../resource/uploaded/profilbanner.png\" alt=\"\" width=\"497\" height=\"81\" /><br /><img src=\"../../../resource/uploaded/logodolphin.png\" alt=\"\" width=\"359\" height=\"134\" /><img src=\"../../../resource/uploaded/tulisangroup.png\" alt=\"\" width=\"127\" height=\"29\" /><br /></td>\n</tr>\n</tbody>\n</table>\n<table border=\"0\" width=\"680\" height=\"230\">\n<tbody>\n<tr>\n<td valign=\"top\"><img src=\"../../../resource/uploaded/profilgbr2.png\" alt=\"\" width=\"168\" height=\"134\" /></td>\n<td valign=\"top\"><span style=\"font-family: trebuchet ms,geneva; font-size: x-large; color: #ff0000;\">Latar Belakang Perusahaan</span><img src=\"../../../resource/uploaded/profilgbr5.png\" alt=\"\" width=\"388\" height=\"15\" /><br /><span style=\"font-size: small;\">Dolphin Group Merupakan Perushaaan Yang Ber Awal Di bidang Perdgangann.. dan Selama Kurun Waktu</span>,<span style=\"font-size: small;\">Merupakan Perushaaan Yang Ber Awal Di bidang Perdgangann.. dan Selama Kurun Waktu,</span><span style=\"font-size: small;\">Merupakan Perushaaan Yang Ber Awal Di bidang Perdgangann.. dan Selama Kurun Waktu,</span><span style=\"font-size: small;\">Merupakan Perushaaan Yang Ber Awal Di bidang Perdgangann.. dan Selama Kurun Waktu<br /><br /></span><span style=\"font-size: small;\">Merupakan Perushaaan Yang Ber Awal Di bidang Perdgangann.. dan Selama Kurun Waktu</span>, <span style=\"font-size: small;\">Merupakan Perushaaan Yang Ber Awal Di bidang Perdgangann.. dan Selama Kurun Waktu,</span><span style=\"font-size: small;\">Merupakan Perushaaan Yang Ber Awal Di bidang Perdgangann.. dan Selama Kurun Waktu</span></td>\n</tr>\n</tbody>\n</table>\n<table border=\"0\" width=\"692\" height=\"158\">\n<tbody>\n<tr>\n<td valign=\"top\"><img src=\"../../../resource/uploaded/profilgbr3.png\" alt=\"\" width=\"168\" height=\"148\" /><br /></td>\n<td valign=\"top\"><br /><span style=\"font-size: x-large; color: #ff0000;\">Visi & Misi Perusahaan </span><br /><img src=\"../../../resource/uploaded/profilgbr5.png\" alt=\"\" width=\"359\" height=\"15\" /><br /><span style=\"font-size: small; font-family: book antiqua,palatino;\">Visi Ke depan Dari Perusahaan Ini adalah membangun Perusahaan Ini adalah membangun Perusahaan Ini adalah membangun Perusahaan Ini adalah membangun Perusahaan Ini adalah membangunPerusahaan Ini adalah membangun Perusahaan Ini adalah membangun Perusahaan Ini adalah membangunPerusahaan Ini adalah membangun</span><br /><span style=\"font-size: small; font-family: book antiqua,palatino;\">Misi Dari Perusahaan Meliputi :</span><br />\n<ul>\n<li><span style=\"font-size: small; font-family: book antiqua,palatino;\">Meningkatkan Kualitas produk Meningkatkan Kualitas produkMeningkatkan Kualitas produkMeningkatkan Kualitas produkMeningkatkan Kualitas produkMeningkatkan Kualitas produkMeningkatkan Kualitas produk</span></li>\n<li><span style=\"font-size: small; font-family: book antiqua,palatino;\">Meningkatkan Kualitas Layanan Meningkatkan Kualitas LayananMeningkatkan Kualitas LayananMeningkatkan Kualitas LayananMeningkatkan Kualitas LayananMeningkatkan Kualitas Layanan</span></li>\n</ul>\n</td>\n</tr>\n</tbody>\n</table>',1,1,1,2),
(32,'<table border=\"0\" width=\"616\" height=\"214\">\n<tbody>\n<tr>\n<td><img src=\"../../../resource/uploaded/refrensigbr1.png\" alt=\"\" width=\"149\" height=\"138\" /><br /><br /></td>\n<td colspan=\"2\" valign=\"top\"><span style=\"font-size: x-large;\"><strong><span style=\"color: #ff0000;\">Refrensi Proyek</span></strong><br /><img src=\"../../../resource/uploaded/profilgbr5.png\" alt=\"\" width=\"434\" height=\"13\" /><br /><span style=\"font-size: small;\">Beberapa proyek yang sudah menggunakan Produk Dolphin antara Lain</span><br /></span></td>\n</tr>\n<tr>\n<td> <img src=\"../../../resource/uploaded/refrensigbr4.png\" alt=\"\" width=\"58\" height=\"852\" /></td>\n<td colspan=\"2\" valign=\"top\"><span style=\"color: #ff0000; font-size: x-large;\"> Perumahan</span><br />\n<table border=\"0\" width=\"442\" height=\"205\">\n<tbody>\n<tr>\n<td valign=\"top\"><img src=\"../../../resource/uploaded/refrensigbr2.png\" alt=\"\" width=\"125\" height=\"177\" /></td>\n<td valign=\"top\">\n<ul>\n<li><span style=\"font-size: medium;\">Perumahan Puri AnjasMoro-Semarang</span></li>\n<li><span style=\"font-size: medium;\">Perumahan Puri Anjas Moro</span></li>\n<li><span style=\"font-size: medium;\">Perumahan Puri Anjas Moro</span></li>\n<li><span style=\"font-size: medium;\">Perumahan Puri Anjas Moro</span></li>\n<li><span style=\"font-size: medium;\">Perumahan Puri Anjas Moro</span></li>\n<li><span style=\"font-size: medium;\">Perumahan Puri Anjas Moro</span></li>\n<li><span style=\"font-size: medium;\">Perumahan Puri Anjas Moro</span></li>\n<li><span style=\"font-size: medium;\">Perumahan Puri Anjas Moro</span></li>\n<li><span style=\"font-size: medium;\">Perumahan Puri Anjas Moro</span></li>\n<li><span style=\"font-size: medium;\"><br /></span></li>\n</ul>\n</td>\n</tr>\n</tbody>\n</table>\n<span style=\"font-size: large; color: #ff0000;\">Bangunan UMUM</span><br />\n<table border=\"0\" width=\"437\" height=\"221\">\n<tbody>\n<tr>\n<td><img src=\"../../../resource/uploaded/refrensigbr3.png\" alt=\"\" width=\"153\" height=\"211\" /></td>\n<td valign=\"top\">\n<ul>\n<li><span style=\"font-size: medium;\">Kampus Polines- Semarang</span></li>\n<li><span style=\"font-size: medium;\">Kampus TriTunggal- Semarang</span></li>\n</ul>\n<ul>\n<li><span style=\"font-size: medium;\">Kampus Polines- Semarang</span></li>\n<li><span style=\"font-size: medium;\">Kampus TriTunggal- Semarang<br /> </span></li>\n</ul>\n<ul>\n<li><span style=\"font-size: medium;\">Kampus Polines- Semarang</span></li>\n<li><span style=\"font-size: medium;\">Kampus TriTunggal- Semarang<br /> </span></li>\n</ul>\n<ul>\n<li></li>\n</ul>\n</td>\n</tr>\n</tbody>\n</table>\n<br /></td>\n</tr>\n</tbody>\n</table>',1,1,12,2),
(8,'<table border=\"0\" width=\"728\" height=\"34\">\n<tbody>\n<tr>\n<td>Ini  percobaa lagi Ini percobaa lagiIni percobaa lagiIni percobaa  lagiIni   percobaa lagiIni percobaa lagiIni percobaa lagiIni percobaa  lagiIni   percobaa lagiIni percobaa lagiIni percobaa lagiIni percobaa  lagiIni   percobaa lagiIni percobaa lagiIni percobaa lagiIni percobaa  lagiIni   percobaa lagi</td>\n</tr>\n</tbody>\n</table>',1,1,15,0),
(12,'<p><a href=\"http://www.jogjaloka.com\">www.jogjaloka.com</a></p>\n<p><img src=\"../../../resource/uploaded/jogjloka.png\" alt=\"\" width=\"300\" height=\"135\" /></p>\n<table border=\"0\" width=\"569\" height=\"22\">\n<tbody>\n<tr>\n<td>Web Dinamis contoh yang sangat bagus...di desain oleh desiner interntaional -galpagoz</td>\n</tr>\n</tbody>\n</table>',1,1,26,0),
(10,'<table border=\"0\" width=\"728\" height=\"34\">\n<tbody>\n<tr>\n<td>Ini  percobaa lagi Ini percobaa lagiIni percobaa lagiIni percobaa lagiIni   percobaa lagiIni percobaa lagiIni percobaa lagiIni percobaa lagiIni   percobaa lagiIni percobaa lagiIni percobaa lagiIni percobaa lagiIni   percobaa lagiIni percobaa lagiIni percobaa lagiIni percobaa lagiIni   percobaa lagi</td>\n</tr>\n</tbody>\n</table>',1,1,16,0),
(11,'<table border=\"0\" width=\"728\" height=\"34\">\n<tbody>\n<tr>\n<td>Ini  percobaa lagi Ini percobaa lagiIni percobaa lagiIni percobaa lagiIni   percobaa lagiIni percobaa lagiIni percobaa lagiIni percobaa lagiIni   percobaa lagiIni percobaa lagiIni percobaa lagiIni percobaa lagiIni   percobaa lagiIni percobaa lagiIni percobaa lagiIni percobaa lagiIni   percobaa lagi</td>\n</tr>\n</tbody>\n</table>\n<p><img src=\"../../../resource/uploaded/t201007000037.jpg\" alt=\"\" width=\"339\" height=\"513\" /></p>',1,1,16,0),
(13,'<table border=\"0\" width=\"897\" height=\"206\">\n<tbody>\n<tr>\n<td><img src=\"../../../resource/uploaded/smatiarakasih.jpg\" alt=\"\" width=\"200\" height=\"200\" /></td>\n<td>\n<h2>SEKOLAH TIARA KASIH</h2>\n<p><span style=\"font-size: small;\">Karena Begitu Besar Kasih Allah Akan Dunia Ini , Sehingga Ia Telah  Mengaruniakan Anak-Nya Yang Tunggal,Supaya Setiap Orang Yang Percaya  KepadaNya Tidak Binasa Melainkan Beroleh Hidup Yang Kekal .(Yoh 3:16)</span></p>\n<p><span style=\"font-size: small;\">Salib : Tetap Teguh Berpegang Pada Firman Tuhan </span></p>\n<p><span style=\"font-size: small;\">Mahkota : Rela Berkorban Dan Memberikan Yang Terbaik Bagi Siswa .</span></p>\n<p><span style=\"font-size: small;\">Hati: Kasih DAn Pelayanan Guru Dan Staf Terhadap Siswa.</span></p>\n<p><span style=\"font-size: small;\">Tulisan \"Sekolah Tiara Kasih-Jakarta\": Slogan Kebersamaan Sekolah Tiara Kasih...</span></p>\n</td>\n</tr>\n</tbody>\n</table>',1,1,31,35),
(14,'<p>Siapppa</p>',1,1,32,36),
(15,'<p>Aplication</p>',1,1,33,37),
(16,'<h2>Customer Service</h2>',1,1,34,38),
(17,'<p>tesstt</p>',1,1,37,4),
(18,'<p>silahkan kontak kami di email<br />bla-bla@tebu-digital.com<br />Phone : 02747474636</p>',1,1,35,39),
(19,'<p>Desktop Produk</p>\n<p>Selain web kami, juga meproduksi aplikasi berbasis desktop, yang</p>\n<p><a href=\"../../../\">backtohome</a></p>\n<p>',1,1,36,40),
(24,'<h2>BERDAMAI DENGAN PRESTASI</h2>\n<p>Dalam segala hal hendaknya kita memperjuangkan sesuatu itu dengan sebaik-baiknya, andaikan pun saat ini kita tidak bisa membuatnya lebih baik, buatlah kemungkinan untuk di kemudian hari membuatnya lebih baik lagi.</p>',1,1,49,44),
(31,'<h2>LOMBA ROBOTIKA</h2>\n<p>Selamat atas kemenangan team robotika seoklah Tiara Kasih, dengan kemenangan ini hendaknya kita akan semik termotivasi,...</p>',1,1,49,44),
(33,'<table border=\"0\" width=\"605\" height=\"22\">\n<tbody>\n<tr>\n<td style=\"text-align: center;\"><span style=\"font-size: x-large; color: #ff0000;\"><strong>Daftar Harga Produk Dolphin</strong></span><br /><img src=\"../../../resource/uploaded/logodolphin.png\" alt=\"\" width=\"303\" height=\"114\" /><img src=\"../../../resource/uploaded/tulisangroup.png\" alt=\"\" width=\"103\" height=\"24\" /><br /><br /></td>\n</tr>\n</tbody>\n</table>\n<table style=\"width: 602px; height: 184px;\" border=\"1\">\n<tbody>\n<tr>\n<td style=\"background-color: #cac9cf;\"><strong><span style=\"font-size: medium;\">No</span></strong></td>\n<td style=\"background-color: #cac9cf;\"><strong><span style=\"font-size: medium;\">Jenis Barang</span></strong></td>\n<td style=\"background-color: #cac9cf; text-align: right;\"><strong><span style=\"font-size: medium;\">Net</span></strong></td>\n</tr>\n<tr>\n<td colspan=\"2\"><span style=\"font-size: medium;\">Produk Golongan 1(Net-Diskon)</span></td>\n<td style=\"text-align: right;\"> </td>\n</tr>\n<tr>\n<td><span style=\"font-size: small;\">1.</span></td>\n<td><span style=\"font-size: small;\">Window Outdoor</span></td>\n<td style=\"text-align: right;\">Rp.3.650.000,-/Unit</td>\n</tr>\n<tr>\n<td><span style=\"font-size: small;\">2.</span></td>\n<td><span style=\"font-size: small;\">Singgle Door(In Door)</span></td>\n<td style=\"text-align: right;\">Rp.3.700.000,-/Unit</td>\n</tr>\n<tr>\n<td> </td>\n<td> </td>\n<td style=\"text-align: right;\"> </td>\n</tr>\n<tr>\n<td> </td>\n<td> </td>\n<td style=\"text-align: right;\"> </td>\n</tr>\n<tr>\n<td> </td>\n<td> </td>\n<td style=\"text-align: right;\"> </td>\n</tr>\n<tr>\n<td colspan=\"2\"><span style=\"font-size: medium;\">Produk Golongan 2 (HPP)</span></td>\n<td style=\"text-align: right;\"> </td>\n</tr>\n<tr>\n<td><span style=\"font-size: small;\">1.</span></td>\n<td><span style=\"font-size: small;\">Pintu HDF Tipe 1</span></td>\n<td style=\"text-align: right;\">Rp 750.000</td>\n</tr>\n<tr>\n<td><span style=\"font-size: small;\">2.</span></td>\n<td><span style=\"font-size: small;\">Pintu HdF Tipe 2</span></td>\n<td style=\"text-align: right;\">Rp.850.000</td>\n</tr>\n</tbody>\n</table>\n<table border=\"0\" width=\"602\" height=\"40\">\n<tbody>\n<tr>\n<td><span style=\"font-size: medium;\"><strong>Keterangan</strong></span><br />\n<ul>\n<li>HargaBerlaku sejak tanggal 1 Februari</li>\n<li>harga Merupakan Produk Saja </li>\n<li>Keterangan Lain</li>\n<li>Keterangan Lain</li>\n<li>Keterangan Lain</li>\n</ul>\n</td>\n</tr>\n</tbody>\n</table>',1,1,11,2);

/*Table structure for table `unitkerja` */

DROP TABLE IF EXISTS `unitkerja`;

CREATE TABLE `unitkerja` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `KdUnitKerjaUSD` varchar(20) DEFAULT NULL,
  `NmUnitKerja` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `unitkerja` */

insert into `unitkerja` values 
(1,'-','Bagian Keuangan Perpustakaan Mrican'),
(2,'-','Perustakaan Pusat Mrican'),
(0,'-','-');

/*Table structure for table `usermenu` */

DROP TABLE IF EXISTS `usermenu`;

CREATE TABLE `usermenu` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `iduser` int(10) DEFAULT NULL,
  `idmenu` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

/*Data for the table `usermenu` */

insert into `usermenu` values 
(97,1,90),
(96,1,89),
(95,1,88),
(94,1,87),
(93,1,86),
(92,1,85),
(91,1,84),
(90,1,83),
(89,1,82),
(57,2,73),
(56,2,1),
(88,1,81),
(87,1,80),
(86,1,79),
(85,1,78),
(84,1,77),
(83,1,76),
(82,1,75),
(81,1,74),
(80,1,73),
(79,1,72),
(78,1,71),
(77,1,70),
(76,1,69),
(75,1,68),
(74,1,67),
(73,1,66),
(72,1,65),
(71,1,64),
(70,1,62),
(69,1,61),
(68,1,60),
(67,1,59),
(66,1,58),
(65,1,57),
(64,1,56),
(63,1,55),
(62,1,13),
(61,1,12),
(60,1,11),
(59,1,1),
(58,2,74),
(98,1,91);

/*Table structure for table `userrab` */

DROP TABLE IF EXISTS `userrab`;

CREATE TABLE `userrab` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `iduser` int(10) DEFAULT NULL,
  `idrab` int(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `userrab` */

insert into `userrab` values 
(11,1,4),
(5,2,1),
(6,2,3),
(10,1,1);
