-- MariaDB dump 10.19  Distrib 10.6.11-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: amasty
-- ------------------------------------------------------
-- Server version	10.6.11-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pizza_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `sauce_id` int(11) DEFAULT NULL,
  `total_price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pizza__id` (`pizza_id`),
  KEY `sauce__id` (`sauce_id`),
  KEY `size__id` (`size_id`),
  CONSTRAINT `pizza__id` FOREIGN KEY (`pizza_id`) REFERENCES `pizzas` (`id`),
  CONSTRAINT `sauce__id` FOREIGN KEY (`sauce_id`) REFERENCES `sauces` (`id`),
  CONSTRAINT `size__id` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `pizza_id`, `size_id`, `sauce_id`, `total_price`) VALUES (1,1,1,1,111),(2,2,3,4,111),(3,1,1,NULL,111),(4,2,1,1,2.8),(5,1,2,NULL,3.5),(6,1,1,1,3.69),(7,2,2,NULL,3.2),(8,2,2,4,3.33),(9,1,1,NULL,3),(10,1,1,NULL,3),(11,2,2,1,3.89),(12,1,1,1,3.69),(13,1,2,1,4.19),(14,2,3,NULL,3.45),(15,1,1,NULL,3),(16,1,1,NULL,3),(17,1,3,NULL,3.7),(18,1,3,2,4.39),(19,1,3,1,4.39),(20,1,2,1,4.19),(21,1,3,1,4.39),(22,1,4,1,4.69),(23,1,4,2,4.69),(24,1,4,3,5),(25,4,2,4,2.26),(26,4,2,NULL,2.13),(27,2,1,1,3.49),(28,1,1,1,3.69),(29,2,3,2,4.14),(30,1,2,1,4.19),(31,3,4,NULL,7.4),(32,3,3,1,7.35),(33,1,1,3,4),(34,1,1,NULL,3),(35,1,3,NULL,3.7),(36,2,1,NULL,2.8),(37,3,3,3,7.66),(38,2,1,2,3.49),(39,4,2,1,2.82),(40,1,2,2,4.19),(41,1,1,NULL,3),(42,1,2,NULL,3.5),(43,1,1,NULL,3),(44,1,1,1,3.69),(45,1,2,NULL,3.5),(46,1,2,NULL,3.5),(47,1,1,2,3.69),(48,3,4,4,7.53),(49,3,4,NULL,7.4),(50,1,2,2,4.19),(51,1,2,3,4.5),(52,2,2,NULL,3.2),(53,2,2,2,3.89),(54,2,2,2,3.89),(55,1,1,NULL,3),(56,1,1,1,3.69),(57,1,2,1,4.19);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizza_size_price`
--

DROP TABLE IF EXISTS `pizza_size_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pizza_size_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pizza_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pizza_id` (`pizza_id`),
  KEY `size_id` (`size_id`),
  CONSTRAINT `pizza_id` FOREIGN KEY (`pizza_id`) REFERENCES `pizzas` (`id`),
  CONSTRAINT `size_id` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizza_size_price`
--

LOCK TABLES `pizza_size_price` WRITE;
/*!40000 ALTER TABLE `pizza_size_price` DISABLE KEYS */;
INSERT INTO `pizza_size_price` (`id`, `pizza_id`, `size_id`, `price`) VALUES (1,1,1,3),(2,1,2,3.5),(3,1,3,3.7),(4,1,4,4),(5,2,1,2.8),(6,2,2,3.2),(7,2,3,3.45),(8,2,4,4.6),(9,3,1,5.01),(10,3,2,5.7),(11,3,3,6.66),(12,3,4,7.4),(13,4,1,1.13),(14,4,2,2.13),(15,4,3,3.13),(16,4,4,13.13);
/*!40000 ALTER TABLE `pizza_size_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizzas`
--

DROP TABLE IF EXISTS `pizzas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pizzas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizzas`
--

LOCK TABLES `pizzas` WRITE;
/*!40000 ALTER TABLE `pizzas` DISABLE KEYS */;
INSERT INTO `pizzas` (`id`, `name`) VALUES (1,'Пепперони'),(2,'Деревенская'),(3,'Гавайская'),(4,'Грибная');
/*!40000 ALTER TABLE `pizzas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sauces`
--

DROP TABLE IF EXISTS `sauces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sauces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sauces`
--

LOCK TABLES `sauces` WRITE;
/*!40000 ALTER TABLE `sauces` DISABLE KEYS */;
INSERT INTO `sauces` (`id`, `name`, `price`) VALUES (1,'сырный',0.69),(2,'кисло-сладкий',0.69),(3,'чесночный',1),(4,'барбекю',0.13);
/*!40000 ALTER TABLE `sauces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sizes`
--

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
INSERT INTO `sizes` (`id`, `size`) VALUES (1,21),(2,26),(3,31),(4,45);
/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-13 23:08:17
