-- MySQL dump 10.13  Distrib 5.6.10, for Win32 (x86)
--
-- Host: localhost    Database: vincent
-- ------------------------------------------------------
-- Server version 5.6.10

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
-- Table structure for table `object_post`
--

DROP TABLE IF EXISTS `object_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `sub_title` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_post`
--

LOCK TABLES `object_post` WRITE;
/*!40000 ALTER TABLE `object_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_prod_category`
--

DROP TABLE IF EXISTS `object_prod_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_prod_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_prod_category`
--

LOCK TABLES `object_prod_category` WRITE;
/*!40000 ALTER TABLE `object_prod_category` DISABLE KEYS */;
INSERT INTO `object_prod_category` VALUES (1,'drink',0),(2,'food',0),(22,'brandy',1),(23,'whisky',1),(24,'vodka',1),(25,'rum',1),(26,'gin',1),(27,'chocolate',2),(28,'macaron',2),(29,'foie_gras',2),(30,'milk',2),(31,'jam',2);
/*!40000 ALTER TABLE `object_prod_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_prod_category_en`
--

DROP TABLE IF EXISTS `object_prod_category_en`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_prod_category_en` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_prod_category_en`
--

LOCK TABLES `object_prod_category_en` WRITE;
/*!40000 ALTER TABLE `object_prod_category_en` DISABLE KEYS */;
INSERT INTO `object_prod_category_en` VALUES (1,'drink',0),(2,'food',0),(13,'brandy',1),(14,'whisky',1),(15,'vodka',1),(16,'rum',1),(17,'gin',1),(18,'chocolate',2),(19,'macaron',2),(20,'foie_gras',2),(21,'milk',2),(22,'jam',2);
/*!40000 ALTER TABLE `object_prod_category_en` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_product`
--

DROP TABLE IF EXISTS `object_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `category` varchar(255) NOT NULL DEFAULT '',
  `price` double NOT NULL DEFAULT '0',
  `prod_place` varchar(45) NOT NULL DEFAULT '',
  `description` text,
  `last_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `prod_count` int(10) unsigned NOT NULL DEFAULT '0',
  `image_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_product`
--

LOCK TABLES `object_product` WRITE;
/*!40000 ALTER TABLE `object_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_product_en`
--

DROP TABLE IF EXISTS `object_product_en`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_product_en` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `category` varchar(255) NOT NULL DEFAULT '',
  `price` double NOT NULL DEFAULT '0',
  `prod_place` varchar(45) NOT NULL DEFAULT '',
  `description` text,
  `last_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `prod_count` int(10) unsigned NOT NULL DEFAULT '0',
  `image_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_product_en`
--

LOCK TABLES `object_product_en` WRITE;
/*!40000 ALTER TABLE `object_product_en` DISABLE KEYS */;
/*!40000 ALTER TABLE `object_product_en` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object_user`
--

DROP TABLE IF EXISTS `object_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL DEFAULT '',
  `password` varchar(45) NOT NULL DEFAULT '',
  `register_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role` enum('admin','general','root') NOT NULL DEFAULT 'general',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object_user`
--

LOCK TABLES `object_user` WRITE;
/*!40000 ALTER TABLE `object_user` DISABLE KEYS */;
INSERT INTO `object_user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','2014-06-21 12:48:53','admin');
/*!40000 ALTER TABLE `object_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_config`
--

DROP TABLE IF EXISTS `system_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_config` (
  `key` varchar(45) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_config`
--

LOCK TABLES `system_config` WRITE;
/*!40000 ALTER TABLE `system_config` DISABLE KEYS */;
INSERT INTO `system_config` VALUES ('company_profile','<p style=\"text-align: center;\"><span style=\"font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 36px;\"><br/></span></p><p style=\"text-align: center;\"><span style=\"font-family: 微软雅黑, &#39;Microsoft YaHei&#39;; font-size: 36px;\">公司简介</span></p>'),('contact_us','<p style=\"text-align: center;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: 24px;\">Hello World!</span><br/></p>'),('home_sliders_data','{\"1\":\"web/images/slider_1.jpg\",\"2\":\"web/images/slider_2.jpg\",\"3\":\"web/images/slider_3.jpg\",\"4\":\"web/images/slider_4.jpg\",\"5\":\"web/images/slider_5.jpg\"}'),('website_telephone','400-888-8889');
/*!40000 ALTER TABLE `system_config` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-28 12:07:22
