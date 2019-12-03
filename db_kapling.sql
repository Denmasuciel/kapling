-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: db_kapling
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('1dd5aa0e356bf19a029dbf4ca1368d13','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36',1558567180,'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";s:14:\"aku_wis _mlebu\";s:8:\"username\";s:5:\"admin\";s:12:\"nama_lengkap\";s:13:\"Administrator\";s:5:\"level\";s:5:\"admin\";s:9:\"id_bidang\";s:1:\"7\";}'),('2cdcd98e1bd644d8e7890012e8751563','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36',1554701366,'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";s:14:\"aku_wis _mlebu\";s:8:\"username\";s:5:\"admin\";s:12:\"nama_lengkap\";s:13:\"Administrator\";s:5:\"level\";s:5:\"admin\";s:9:\"id_bidang\";s:1:\"7\";}'),('4331a69d211430728921fbf1a052c081','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36',1552460492,'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";s:14:\"aku_wis _mlebu\";s:8:\"username\";s:5:\"admin\";s:12:\"nama_lengkap\";s:13:\"Administrator\";s:5:\"level\";s:5:\"admin\";s:9:\"id_bidang\";s:1:\"7\";}'),('43dc499cda3ef641b0ffd76e02d94ce4','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36',1558554849,''),('8ca66fa6a5deb88158ea4043b76caa70','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36',1571280864,'a:2:{s:9:\"user_data\";s:0:\"\";s:22:\"flash:old:result_login\";s:202:\"<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><i class=\"ace-icon fa fa-times\"></i></button>\r\n												Username atau Password yang anda masukkan salah.</div>\";}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_bidang`
--

DROP TABLE IF EXISTS `tbl_bidang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_bidang` (
  `id_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(100) NOT NULL,
  PRIMARY KEY (`id_bidang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_bidang`
--

LOCK TABLES `tbl_bidang` WRITE;
/*!40000 ALTER TABLE `tbl_bidang` DISABLE KEYS */;
INSERT INTO `tbl_bidang` VALUES (2,'Sekretariat '),(3,'Ekonomi');
/*!40000 ALTER TABLE `tbl_bidang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kapling`
--

DROP TABLE IF EXISTS `tbl_kapling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kapling` (
  `id_kapling` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jam` varchar(50) NOT NULL,
  `acara` varchar(150) NOT NULL,
  `id_rr` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `waktu_kapling` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kapling`),
  KEY `id_bidang` (`id_bidang`),
  KEY `id_rr` (`id_rr`),
  CONSTRAINT `fk_bidang` FOREIGN KEY (`id_bidang`) REFERENCES `tbl_bidang` (`id_bidang`),
  CONSTRAINT `fk_rr` FOREIGN KEY (`id_rr`) REFERENCES `tbl_rr` (`id_rr`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kapling`
--

LOCK TABLES `tbl_kapling` WRITE;
/*!40000 ALTER TABLE `tbl_kapling` DISABLE KEYS */;
INSERT INTO `tbl_kapling` VALUES (1,'2019-05-23','23','sss',6,2,'2019-05-23 02:39:25');
/*!40000 ALTER TABLE `tbl_kapling` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pegawai`
--

DROP TABLE IF EXISTS `tbl_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `id_agama` varchar(10) NOT NULL DEFAULT 'Islam',
  `status_pegawai` enum('1','0') NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `id_golongan` varchar(10) NOT NULL,
  `id_jabatan` varchar(10) NOT NULL,
  `id_bidang` varchar(10) NOT NULL,
  `npwp` varchar(30) NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pegawai`
--

LOCK TABLES `tbl_pegawai` WRITE;
/*!40000 ALTER TABLE `tbl_pegawai` DISABLE KEYS */;
INSERT INTO `tbl_pegawai` VALUES (1,'195907281990031003','Ir. Syarief Armunanto, M.M.','Yogyakarta','1959-01-08','L','1','1','0','15','1','7','08.960.762.6-541.000'),(2,'197202111996031002','Sri Suhartanta, S.IP., M.Si.','Wonosari','1972-02-11','L','1','1','0','14','2','1','47.650.499.8.542.000'),(3,'197103251991011001','Saptoyo, S.Sos. M.Si. ','Bantul','1971-03-25','L','1','1','0','13','3','3','48,239.208.1.541.000'),(4,'197109121991011001','Johan Eko Sudarto, S. Sos, MH','Wonosari','1971-09-12','L','1','1','0','13','4','4','47.792.117.5-542.000'),(5,'196907061994031006','Jatmiko Sutopo, S.T., M.T.','Wonosari','1969-07-06','L','1','1','0','13','5','6','47.650.510.2.542.000'),(6,'196008181994031005','Agus Suprayitno, S.H.','Wonosari','1960-08-18','L','1','1','0','13','6','6','57.655.593.2-545.000'),(7,'196611061998031004','Ir. Sri Agus Wahyono, M.Si.','Sleman','1966-11-06','L','1','1','0','13','7','2','47.650.512.8.541.000'),(8,'197012121998031010','Joko Hardiyanto,SP,M.Eng.','Gunungkidul','1970-12-12','L','1','1','0','13','8','3','24.557.488.0-545.000'),(9,'196911241998032003','Sri Hardjanah, S.E., M.M.','Wonosari','1969-11-24','P','1','1','0','13','9','1','57.248.656.1.545.000'),(10,'196910141998032006','Aning Sri Mintarsih, SP, MT, MSHS','Bantul','1969-10-14','P','1','1','0','13','7','2','07.842.179.9-541.000'),(11,'197303221998031008','Purwono Sulistyo Hadi, SP, MP','Yogyakarta','1973-03-22','L','1','1','Sumberejo, Ngawu, Playen','11','11','4',''),(12,'196310101985021003','Sudadi, SKM.','Wonosari','1963-10-10','L','1','1','0','12','12','5','57.467.983.3-543.000'),(13,'196506281988031008','Priyanta Madya S., S.K.M, M.Kes.','Wonosari','1965-06-28','L','1','1','0','13','13','5','58.720.783.8.545.000'),(14,'197401041999032004','Ari Nur Aida, S.IP., M.E.','Bantul','1974-01-04','P','1','1','0','13','14','6','57.248.686.8.543.000'),(15,'197812191997111001','Ajie Saksono,S,STP, M,Si.','Wonosari','1978-12-19','L','1','1','0','12','15','5','57.274.496.9.545.000'),(16,'196204221989031004','Bambang Riyanto, S.E., M.T.','Wonosari','1962-04-22','L','1','1','0','11','18','3','58.710.940.6-545.000z'),(17,'196101121990021001','Wastoyo, S.T.','Wonosari','1961-01-12','L','1','1','0','12','17','2','57.248.675.1.545.000'),(18,'198003161998101002','Wahyu Ardi Nugroho, S. STP, M.A.','Bantul','1980-03-16','L','1','1','0','12','3','3','00.058.722.1.771.545.000'),(19,'197810272006041006','M. Fajar Nugroho, S.T.','Klaten','1978-10-27','L','1','1','0','11','18','2','57.248.673.6.525.000'),(21,'197310022000032003','Sity Hidayati, SKM','Bantul','1973-10-02','P','1','1','0','11','21','5','57.773.034.4-541.000'),(22,'197703202006042003','Dwi Susiati, S.E., M.Ec.Dev.','Yogyakarta','1977-03-20','P','1','1','0','11','21','1','57.248.694.2.545.000'),(23,'196205071986091001','Supartono','Gunungkidul','1962-05-07','L','1','1','0','10','21','1','57.248.690.0.545.000'),(24,'196201291988031007','Marcus Suroto ','Gunungkidul','1962-01-29','L','2','1','0','10','21','2','57.248.671.0.545.000'),(25,'196107181988031006','Nindhom','Gunungkidul','1961-07-18','L','1','1','0','10','21','5','57.248.665.2.545.000'),(26,'196406251990032006','Theresia Juminten','Gunungkidul','1964-06-25','P','3','1','0','10','21','1','57.248.658.7.545.000'),(27,'196401121990031008','Istu Partana, S.E.','Gunungkidul','1964-01-12','L','1','1','0','10','21','4','57.274.464.7.545.000'),(28,'196302051992032004','Rosani Ratnaningsih','Yogyakarta','1963-02-05','P','3','1','0','10','21','2','57.248.669.4.545.000'),(29,'196302101992032001','Sukistini','Bantul','1963-02-10','P','1','1','0','10','21','1','57.248.660.3.545.000'),(30,'196908041992032006','Sunarti, SIP.','Gunungkidul','1969-08-04','P','1','1','0','11','21','5','49.541.757.8.542.000'),(31,'197509011994031002','Agus Sugiarto, S.IP.','Kebumen','1975-09-01','L','1','1','0','10','21','3','57.274.476.1.545.000'),(32,'197511052010011006','Irfan Budi Kuncahyo, S.T.','Trenggalek','1975-11-05','L','1','1','0','10','21','6','25.350.616.9-629.000'),(33,'197802252010011007','Rifai Adi Hartanto, S,Si','Sleman','1978-02-25','L','1','1','0','10','21','3','0'),(34,'198406162010011028','Chandra Efnu Saputra, S.E.','Yogyakarta','1984-06-16','L','1','1','0','10','21','6','66.713.417.5-541.000'),(35,'198501162010012019','Eska Nugrahini Muniati, S.E.','Gunungkidul','1985-01-16','P','1','1','0','10','21','4','79.577.865.3-545.000'),(36,'198007112010012003','Yulita Savitri, S.E.','Bogor','1980-07-11','P','1','1','0','10','21','4','15.511.054.7-311.000'),(37,'197402141998031004','Jadi Markuat, A.Md.','Gunungkidul','1974-02-14','L','1','1','0','9','21','2','57.274.493.6.545.000'),(38,'198111232005012007','Khrisnawati Nuryantari, A.Md.','Gunungkidul','1981-11-23','P','3','1','0','9','21','2','57.274.489.4.545.000'),(39,'198410262009031002','Yadianto Anggoro, A.Md.   ','Gunungkidul','1984-10-26','L','1','1','0','8','21','3','58.711.431.5-545.000'),(40,'198506152010012034','Azizatul Jannah, A.Md.','Gunungkidul','1985-06-15','P','1','1','0','8','21','1','36.151.631.0-545.000'),(41,'197007092005011014','Agung Prasetyo, A.Md.','Wonosari','1970-07-09','L','1','1','0','8','21','1','-'),(42,'198205132002122002','Rohmawati','Gunungkidul','1982-05-13','P','1','1','0','8','21','6','47.108.416.0-542.000'),(43,'198105092007012005','Tri Istini','Wonosari','1981-05-09','P','1','1','0','7','21','3','87.582.770.1-545.000'),(44,'196511252007011005','Ignatius Nyoto Raharjo','Gunungkidul','1965-11-25','L','1','1','0','7','21','1','57.248.677.7.545.000'),(45,'197603172007011004','Gunardi Wibowo','Gunungkidul','1976-03-17','L','1','1','0','7','21','1','57.274.461.3.545.000'),(46,'196811302007011008','Baryono','Gunungkidul','1968-11-30','L','1','1','0','3','21','1','57.274.462.1.545.000'),(47,'196708102008011010','Tumpangsih','Lampung Tengah','1967-08-10','L','1','1','0','2','21','1','68.202.528.3.525.000'),(48,'197311081995031002','Saryana, SIP ,MSi','Wonosari','1973-08-11','L','1','1','0','9','21','1','0'),(49,'197805232010011009','Effani Azza Yurisa Rauf, ST','Gunungkidul','1978-02-25','L','1','1','0','10','21','2','78.383.169.6-941.000'),(50,'197606302009011003','Edi Prayitno','Gunungkidul','1976-06-30','L','1','1','0','6','21','5','79.577.017.1-545.000'),(53,'196510011987021002','Akirno, S.Sos, M.Si','Gunungkidul','1965-10-01','L','1','1','-','13','21','5','0'),(61,'196701121990031008','Rahmat Basuki, S.IP','Bantul','1967-01-12','L','1','1','Banaran III,Banaran,Playen','10','20','1','0'),(62,'198103142006041002','Setiyo Hartato,S.IP','Bantul','2017-03-08','L','1','1','Bantul','1','21','1','0');
/*!40000 ALTER TABLE `tbl_pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rr`
--

DROP TABLE IF EXISTS `tbl_rr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rr` (
  `id_rr` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rr` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rr`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rr`
--

LOCK TABLES `tbl_rr` WRITE;
/*!40000 ALTER TABLE `tbl_rr` DISABLE KEYS */;
INSERT INTO `tbl_rr` VALUES (6,'Aula Wijaya Kusuma'),(7,'Amarilis');
/*!40000 ALTER TABLE `tbl_rr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `id_bidang` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','949e2f7b13f3c5ffc55d4e8b254b23d8','Administrator','admin',7),(62,'eko','e5ea9b6d71086dfef3a15f726abcc5bf','Eko Prasetyo,S.Kom','user',2),(63,'agus','fdf169558242ee051cca1479770ebac3','agus','user',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vw_kapling`
--

DROP TABLE IF EXISTS `vw_kapling`;
/*!50001 DROP VIEW IF EXISTS `vw_kapling`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_kapling` AS SELECT 
 1 AS `id_kapling`,
 1 AS `tanggal`,
 1 AS `jam`,
 1 AS `acara`,
 1 AS `id_rr`,
 1 AS `nama_rr`,
 1 AS `id_bidang`,
 1 AS `bidang`,
 1 AS `waktu_kapling`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'db_kapling'
--

--
-- Final view structure for view `vw_kapling`
--

/*!50001 DROP VIEW IF EXISTS `vw_kapling`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_kapling` AS select `tbl_kapling`.`id_kapling` AS `id_kapling`,`tbl_kapling`.`tanggal` AS `tanggal`,`tbl_kapling`.`jam` AS `jam`,`tbl_kapling`.`acara` AS `acara`,`tbl_kapling`.`id_rr` AS `id_rr`,`tbl_rr`.`nama_rr` AS `nama_rr`,`tbl_kapling`.`id_bidang` AS `id_bidang`,`tbl_bidang`.`bidang` AS `bidang`,`tbl_kapling`.`waktu_kapling` AS `waktu_kapling` from ((`tbl_bidang` join `tbl_kapling` on((`tbl_kapling`.`id_bidang` = `tbl_bidang`.`id_bidang`))) join `tbl_rr` on((`tbl_kapling`.`id_rr` = `tbl_rr`.`id_rr`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-03  8:23:27
