CREATE DATABASE  IF NOT EXISTS `automatic_irrigationdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `automatic_irrigationdb`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: localhost    Database: automatic_irrigationdb
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'nana','$2y$11$jXn8VtQ1Os2qFhlG9nTakeATzSvleeRMdWaBqHnrIV4dswDENEc.6','x8z7kUahKCP836VLYJBuRgL0k75BFPBRzZEBj4eoZ95ACcZ8nCEP95QV2zIU'),(2,'nana1','$2y$11$Z6CuOpdgNcT8wQ0hX69deu0ch6/GCV7/ziXoyNe5JZoi/xkYWo9cu',NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer`
--

DROP TABLE IF EXISTS `farmer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `farmer_name` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer`
--

LOCK TABLES `farmer` WRITE;
/*!40000 ALTER TABLE `farmer` DISABLE KEYS */;
INSERT INTO `farmer` VALUES (2,'Rhoda Farrell','$Mc8oXA~eKjv_d|]PUr','fadel.zula@schultz.info','w91nqdhqzXUvpGt5v2d3tVaSZ6NjjlXXijuGVhaQOswK3vu2wruyHleXxUEB'),(3,'Gerson Carroll DDS','%`Ex=M*uks<\\>L|K','runte.waino@gmail.com',NULL),(4,'Freeman Balistreri','#.Oz8o=A29>}4Q','eichmann.marcelina@gmail.com',NULL),(5,'Lisandro Leffler',']4|Q`lD','caroline.kautzer@metz.com',NULL),(6,'Lonzo Goldner MD','\\4262wZmll?b','pagac.madisen@hane.com',NULL),(7,'Vince Graham','Y&uLN0yf|wJit:Eu','corkery.darren@vonrueden.net',NULL),(8,'Ross Rutherford','ANmf+j6','hane.dasia@yahoo.com',NULL),(9,'Sheila Gerhold Jr.','&o3_HTdy5])]r2','brycen19@gmail.com',NULL),(10,'Adriana Kuvalis','J[GqpUf?`~LB~','kbalistreri@gleason.com',NULL),(11,'Esteban Mueller','Ao%{V;nJb|v)>','gpowlowski@hand.com',NULL),(16,'mens','$2y$11$jGD83FIFfJEDbidKdG3TkO0ciOntX76UTUp9l1dnZBRQfbFt5xH12','nana@set.com','lfTjOFt9SObu9vrTGPdHpHfgRmW2irD0tn16qxF7tShPOfbp4FHolX61cZZA'),(18,'Nana','$2y$11$Se.1DKXN1C2x377Wy.Fp6O/iph60.4poH.iFeLxksXOFqW3DqpdmG','blue@com.com','IxLABsh5bwFmsIfVponK6ytZxsAbGNMuGt5gsySlmgCQFFu5pUhIhZo4ED4X'),(19,'kelo','$2y$11$mZKqEQg7GyRrY8..x63FjegSfPLtVxkrkMuv8f3zNpe1WHDKWTYx.','kelvinasare5.ka@gmail.com','McxU893VufUVEDc1la3NStpIn0YaLcI7PeIenU4nEW3O0gWY2Xu4l4ToaRTe'),(20,'Men Joe','$2y$11$KuXiBhYHulhZQgM2VcnhFOPAqyRnjZQqPt.XtfBK8HSDLGcMDQu6q','mjoe@xyz.com','KDzjonZVLp8skxnBUmi0GW8qnY7kuugERpSRdy6sI2m46bMYor9HdcR0qbIL');
/*!40000 ALTER TABLE `farmer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intrusion`
--

DROP TABLE IF EXISTS `intrusion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intrusion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Microcontroller_id` int(11) NOT NULL,
  `time_recorded` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Intrusion_Microcontroller1_idx` (`Microcontroller_id`),
  CONSTRAINT `fk_Intrusion_Microcontroller1` FOREIGN KEY (`Microcontroller_id`) REFERENCES `microcontroller` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intrusion`
--

LOCK TABLES `intrusion` WRITE;
/*!40000 ALTER TABLE `intrusion` DISABLE KEYS */;
INSERT INTO `intrusion` VALUES (2,3,'2017-03-29 00:22:31'),(3,3,'2017-03-29 00:22:31'),(4,3,'2017-03-29 00:22:31');
/*!40000 ALTER TABLE `intrusion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `microcontroller`
--

DROP TABLE IF EXISTS `microcontroller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `microcontroller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isActivated` tinyint(1) NOT NULL DEFAULT '0',
  `Farmer_id` int(11) NOT NULL,
  `Soil_id` int(11) DEFAULT NULL,
  `plant_name` varchar(45) DEFAULT NULL,
  `device_location` varchar(45) DEFAULT NULL,
  `pump_status` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(32) DEFAULT NULL,
  `token_time_issued` timestamp NULL DEFAULT NULL,
  `num_of_sensors` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token_UNIQUE` (`token`),
  KEY `fk_Microcontroller_Farmer1_idx` (`Farmer_id`),
  KEY `fk_Microcontroller_Soil1_idx` (`Soil_id`),
  CONSTRAINT `fk_Microcontroller_Farmer1` FOREIGN KEY (`Farmer_id`) REFERENCES `farmer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Microcontroller_Soil1` FOREIGN KEY (`Soil_id`) REFERENCES `soil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `microcontroller`
--

LOCK TABLES `microcontroller` WRITE;
/*!40000 ALTER TABLE `microcontroller` DISABLE KEYS */;
INSERT INTO `microcontroller` VALUES (3,1,18,10,'Rice','Jomoro',1,'KV23LVPju8KcnAjsvh4GcbOrAPnZyTpg','2017-05-02 12:26:25',3),(4,1,18,1,'Plantain','Maase',0,NULL,NULL,1),(5,0,18,NULL,NULL,NULL,0,NULL,NULL,1),(7,0,18,NULL,NULL,NULL,0,NULL,NULL,1),(8,0,16,NULL,NULL,NULL,0,NULL,NULL,1),(9,0,16,NULL,NULL,NULL,0,NULL,NULL,1),(10,0,2,NULL,NULL,NULL,0,NULL,NULL,1),(11,0,19,NULL,NULL,NULL,0,NULL,NULL,1),(12,0,19,NULL,NULL,NULL,0,NULL,NULL,1),(13,0,19,NULL,NULL,NULL,0,NULL,NULL,1),(14,0,20,NULL,NULL,NULL,0,NULL,NULL,1);
/*!40000 ALTER TABLE `microcontroller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moisture_readings`
--

DROP TABLE IF EXISTS `moisture_readings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moisture_readings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moisture_value` float NOT NULL,
  `time_recorded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pump_status` tinyint(1) NOT NULL,
  `Microcontroller_id` int(11) NOT NULL,
  `temp_reading` int(3) DEFAULT NULL,
  `weather_cond` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Moisture_Readings_Microcontroller1_idx` (`Microcontroller_id`),
  CONSTRAINT `fk_Moisture_Readings_Microcontroller1` FOREIGN KEY (`Microcontroller_id`) REFERENCES `microcontroller` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moisture_readings`
--

LOCK TABLES `moisture_readings` WRITE;
/*!40000 ALTER TABLE `moisture_readings` DISABLE KEYS */;
INSERT INTO `moisture_readings` VALUES (1,23.2,'2017-03-29 00:22:31',1,3,33,'Sunny'),(2,34.4,'2017-03-29 00:23:08',1,3,35,'Sunny'),(3,19.65,'2017-03-29 00:23:29',0,3,39,'Sunny'),(4,34.66,'2017-03-29 00:23:51',0,4,30,'Sunny'),(5,66.66,'2017-03-29 00:24:22',1,4,25,'Cloudy'),(6,90.78,'2017-03-29 00:24:46',0,4,23,'Rainy'),(8,44.99,'2017-03-30 08:37:45',1,4,28,'Clody'),(9,10.7,'2017-03-30 10:31:41',0,4,38,'Sunny'),(10,70.66,'2017-03-30 10:32:01',1,4,25,'Sunny'),(11,100.89,'2017-03-30 10:32:21',1,4,23,'Sunny'),(12,110,'2017-03-30 10:35:37',1,4,23,'Sunny'),(13,70,'2017-03-30 10:36:01',0,4,28,'Cloudy'),(14,65.7,'2017-03-30 10:36:22',0,4,30,'Cloudy'),(15,34.5,'2017-04-07 00:22:31',1,3,33,NULL);
/*!40000 ALTER TABLE `moisture_readings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soil`
--

DROP TABLE IF EXISTS `soil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `soil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soil_name` varchar(45) DEFAULT NULL,
  `threshold_value` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soil`
--

LOCK TABLES `soil` WRITE;
/*!40000 ALTER TABLE `soil` DISABLE KEYS */;
INSERT INTO `soil` VALUES (1,'sandy',67),(2,'clay',56),(3,'loam',59),(4,'Coal',23),(5,'Coal1',34),(6,'Nimde',20),(7,'Yole',13),(8,'New soil',87),(9,'Test',78),(10,'Game',123),(11,'sandy',67),(12,'sandy56',59),(13,'Kelo Soil',190),(14,'Gabby',56);
/*!40000 ALTER TABLE `soil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'automatic_irrigationdb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-02 18:01:08
