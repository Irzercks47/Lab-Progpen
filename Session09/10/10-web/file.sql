-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: miracle
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

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
-- Table structure for table `destination`
--

DROP TABLE IF EXISTS `destination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destination` (
  `Destination_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Destination_Name` varchar(255) NOT NULL,
  `Destination_Image` varchar(255) NOT NULL,
  PRIMARY KEY (`Destination_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destination`
--

LOCK TABLES `destination` WRITE;
/*!40000 ALTER TABLE `destination` DISABLE KEYS */;
INSERT INTO `destination` VALUES (1,'Jakarta Branch','1.jpg'),(2,'Singapore Branch','2.jpg'),(3,'Indian Branch','3.Jpg');
/*!40000 ALTER TABLE `destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_donation`
--

DROP TABLE IF EXISTS `detail_donation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_donation` (
  `header_id` int(11) DEFAULT NULL,
  `donation_value` int(11) NOT NULL,
  `donation_title` varchar(255) DEFAULT NULL,
  `donation_description` varchar(255) DEFAULT NULL,
  `Destination_ID` int(11) DEFAULT NULL,
  KEY `header_id` (`header_id`),
  KEY `destination_id_fk_1` (`Destination_ID`),
  CONSTRAINT `destination_id_fk_1` FOREIGN KEY (`Destination_ID`) REFERENCES `destination` (`Destination_ID`),
  CONSTRAINT `detail_donation_ibfk_1` FOREIGN KEY (`header_id`) REFERENCES `header_donation` (`header_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_donation`
--

LOCK TABLES `detail_donation` WRITE;
/*!40000 ALTER TABLE `detail_donation` DISABLE KEYS */;
INSERT INTO `detail_donation` VALUES (1,25,'You\'re welcome','Hope you guys can help more children yeah? I support you to the fullest',1),(2,200,'I\'m glad','I\'m glad that there are people like you guys that help our children.',2),(3,500,'Thankyou','Thank you for being there for the children. Love you guys',3),(4,5,'Hello guys','I can\'t help much but there you go. Thank you',1),(5,100,'Love you guys','Hey there, here are my contribution. It ain\'t much but it is sincere from my heart !',2),(6,200,'MY DONATION','Here is my first donation, continue help children of our future !',2),(7,300,'My gratitude','Hello there, i can\'t help much but here you go!',3);
/*!40000 ALTER TABLE `detail_donation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `header_donation`
--

DROP TABLE IF EXISTS `header_donation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `header_donation` (
  `header_id` int(11) NOT NULL AUTO_INCREMENT,
  `donation_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`header_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `header_donation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `header_donation`
--

LOCK TABLES `header_donation` WRITE;
/*!40000 ALTER TABLE `header_donation` DISABLE KEYS */;
INSERT INTO `header_donation` VALUES (1,'2020-08-01 06:27:47',1),(2,'2020-08-01 16:27:47',2),(3,'2020-08-01 19:57:37',3),(4,'2020-07-24 15:10:19',3),(5,'2020-06-18 22:14:31',4),(6,'2020-06-10 03:38:26',1),(7,'2020-07-20 08:42:30',2),(8,'2020-06-17 13:16:23',3);
/*!40000 ALTER TABLE `header_donation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secret`
--

DROP TABLE IF EXISTS `secret`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secret` (
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secret`
--

LOCK TABLES `secret` WRITE;
/*!40000 ALTER TABLE `secret` DISABLE KEYS */;
INSERT INTO `secret` VALUES ('miracle','helloiamtheadminnow'),('miracle','whyhellotheremark'),('miracle','whythehelliammakingthisanyway'),('miracle','iwilltakeyourorgan');
/*!40000 ALTER TABLE `secret` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'testing@gmail.com','youwanttodie?'),(2,'admin@gmail.com','qwerty123'),(3,'guest@gmail.com','password'),(4,'test@gmail.com','testtest');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-03  7:57:38
