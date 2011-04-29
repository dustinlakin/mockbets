-- MySQL dump 10.11
--
-- Host: localhost    Database: mockbets
-- ------------------------------------------------------
-- Server version	5.0.51

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
-- Table structure for table `bet`
--

DROP TABLE IF EXISTS `bet`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bet` (
  `id` int(11) NOT NULL auto_increment,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `ml` int(11) NOT NULL,
  `ps` int(11) NOT NULL,
  `ou` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `ml` (`ml`),
  KEY `ps` (`ps`),
  KEY `ou` (`ou`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  KEY `status` (`status`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `bet`
--

LOCK TABLES `bet` WRITE;
/*!40000 ALTER TABLE `bet` DISABLE KEYS */;
INSERT INTO `bet` VALUES (1,1,4,5,500,1,0,0,0);
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `events` (
  `id` int(11) NOT NULL auto_increment,
  `sport_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `event_date` datetime NOT NULL,
  `bet_by` datetime NOT NULL,
  `ml` tinyint(1) NOT NULL,
  `ps` tinyint(1) NOT NULL,
  `ou` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `sport_id` (`sport_id`),
  KEY `event_date` (`event_date`),
  KEY `ml` (`ml`),
  KEY `ps` (`ps`),
  KEY `ou` (`ou`),
  KEY `bet_by` (`bet_by`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,1,'UFC 129','','2011-04-30 18:00:00','2011-04-30 17:00:00',1,0,0),(2,2,'NBA Playoffs','','2011-04-20 18:42:04','2011-04-20 18:42:13',1,1,1),(3,2,'NBA Playoffs','test','2011-04-20 18:42:04','2011-04-20 18:42:04',1,1,1);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_admins`
--

DROP TABLE IF EXISTS `group_admins`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `group_admins` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `join_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `group_admins`
--

LOCK TABLES `group_admins` WRITE;
/*!40000 ALTER TABLE `group_admins` DISABLE KEYS */;
INSERT INTO `group_admins` VALUES (3,5,'2011-04-12 23:49:06');
/*!40000 ALTER TABLE `group_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(150) NOT NULL,
  `min_bet` int(11) NOT NULL,
  `max_bet` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `starting_funds` int(11) NOT NULL,
  `base_price` smallint(6) NOT NULL,
  `password` varchar(75) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'dustin\'s ufc pool',100,1000,'2011-04-12','2012-05-20',10000,5,'test'),(5,'dustin\'s ufc1 pool',100,1000,'2011-04-12','2012-05-20',10000,5,'test');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `money_line`
--

DROP TABLE IF EXISTS `money_line`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `money_line` (
  `event_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `odd` int(11) NOT NULL,
  `status` tinyint(6) NOT NULL,
  KEY `event_id` (`event_id`),
  KEY `team_id` (`team_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `money_line`
--

LOCK TABLES `money_line` WRITE;
/*!40000 ALTER TABLE `money_line` DISABLE KEYS */;
INSERT INTO `money_line` VALUES (1,1,-500,0),(1,3,300,0),(2,4,-500,0),(2,5,400,0),(3,6,175,0),(3,7,-210,0);
/*!40000 ALTER TABLE `money_line` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `over_under`
--

DROP TABLE IF EXISTS `over_under`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `over_under` (
  `event_id` int(11) NOT NULL,
  `odd` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `status` tinyint(6) NOT NULL,
  KEY `event_id` (`event_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `over_under`
--

LOCK TABLES `over_under` WRITE;
/*!40000 ALTER TABLE `over_under` DISABLE KEYS */;
INSERT INTO `over_under` VALUES (2,-115,-188,0),(2,-105,188,0),(3,-110,207,0),(3,-110,-207,0);
/*!40000 ALTER TABLE `over_under` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_spread`
--

DROP TABLE IF EXISTS `point_spread`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `point_spread` (
  `event_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `odd` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  KEY `event_id` (`event_id`),
  KEY `team_id` (`team_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `point_spread`
--

LOCK TABLES `point_spread` WRITE;
/*!40000 ALTER TABLE `point_spread` DISABLE KEYS */;
INSERT INTO `point_spread` VALUES (2,4,-11.5,0),(2,5,11.5,0),(3,6,4.5,0),(3,7,-4.5,0);
/*!40000 ALTER TABLE `point_spread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `sports` (
  `id` int(11) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `sports`
--

LOCK TABLES `sports` WRITE;
/*!40000 ALTER TABLE `sports` DISABLE KEYS */;
INSERT INTO `sports` VALUES (1,2,'MMA'),(2,1,'NBA');
/*!40000 ALTER TABLE `sports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports_categories`
--

DROP TABLE IF EXISTS `sports_categories`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `sports_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `sports_categories`
--

LOCK TABLES `sports_categories` WRITE;
/*!40000 ALTER TABLE `sports_categories` DISABLE KEYS */;
INSERT INTO `sports_categories` VALUES (1,'Basketball'),(2,'Fights');
/*!40000 ALTER TABLE `sports_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports_for_groups`
--

DROP TABLE IF EXISTS `sports_for_groups`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `sports_for_groups` (
  `group_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  KEY `group_id` (`group_id`),
  KEY `sport_id` (`sport_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `sports_for_groups`
--

LOCK TABLES `sports_for_groups` WRITE;
/*!40000 ALTER TABLE `sports_for_groups` DISABLE KEYS */;
INSERT INTO `sports_for_groups` VALUES (5,2),(5,1);
/*!40000 ALTER TABLE `sports_for_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `sport_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `sport_id` (`sport_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Georges St. Pierre','',1),(4,'Lakers','Los Angeles',2),(3,'Jake Shields','',1),(5,'Hornets','New Orleans',2),(6,'Nuggets','Denver',2),(7,'Thunder','Oklahoma City',2);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(75) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `email` (`email`),
  KEY `password` (`password`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'jacob','jacob@aol.com','cd8768d0901e27c0ea8cfbaa852d5803'),(4,'dustin','dustin.lakin@gmail.com','91df67ae38fb48fd8b7475570bfe3952');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_in_groups`
--

DROP TABLE IF EXISTS `users_in_groups`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users_in_groups` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `bets_money` int(11) NOT NULL,
  `join_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  KEY `money` (`money`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users_in_groups`
--

LOCK TABLES `users_in_groups` WRITE;
/*!40000 ALTER TABLE `users_in_groups` DISABLE KEYS */;
INSERT INTO `users_in_groups` VALUES (3,5,10000,0,'2011-04-12 23:49:06'),(4,5,12000,0,'2011-04-14 01:43:16');
/*!40000 ALTER TABLE `users_in_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-04-27  6:40:29
