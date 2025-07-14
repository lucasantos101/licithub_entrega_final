-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: licithub
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from_user_id` bigint unsigned NOT NULL,
  `to_user_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_messages_from_user_id_foreign` (`from_user_id`),
  KEY `chat_messages_to_user_id_foreign` (`to_user_id`),
  CONSTRAINT `chat_messages_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chat_messages_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_messages`
--

LOCK TABLES `chat_messages` WRITE;
/*!40000 ALTER TABLE `chat_messages` DISABLE KEYS */;
INSERT INTO `chat_messages` VALUES (1,2,1,'oi',0,NULL,'2025-06-25 06:37:38','2025-06-25 06:37:38'),(2,2,2,'oi',1,'2025-06-25 06:37:57','2025-06-25 06:37:56','2025-06-25 06:37:57'),(3,2,3,'ola',1,'2025-07-08 20:24:43','2025-06-25 06:40:12','2025-07-08 20:24:43'),(4,2,5,'oi',1,'2025-06-25 06:40:41','2025-06-25 06:40:35','2025-06-25 06:40:41'),(5,5,2,'ola',1,'2025-06-25 06:41:03','2025-06-25 06:41:01','2025-06-25 06:41:03'),(6,5,2,'oi gente aloou',1,'2025-06-25 06:41:34','2025-06-25 06:41:31','2025-06-25 06:41:34'),(7,2,5,'oi calma por favor.',1,'2025-06-25 06:41:50','2025-06-25 06:41:50','2025-06-25 06:41:50'),(8,2,5,'oi etelvino',1,'2025-06-25 06:42:47','2025-06-25 06:42:45','2025-06-25 06:42:47'),(9,5,2,'ola bruno',1,'2025-06-25 06:42:53','2025-06-25 06:42:52','2025-06-25 06:42:53'),(10,5,2,'oi',1,'2025-06-25 06:53:01','2025-06-25 06:52:58','2025-06-25 06:53:01'),(11,2,5,'sim siim',1,'2025-06-25 06:53:04','2025-06-25 06:53:03','2025-06-25 06:53:04'),(12,5,2,'nao',1,'2025-06-25 06:53:34','2025-06-25 06:53:31','2025-06-25 06:53:34'),(13,2,5,'oi',1,'2025-06-25 07:05:10','2025-06-25 07:05:05','2025-06-25 07:05:10'),(14,5,1,'oi',1,'2025-06-25 07:06:47','2025-06-25 07:06:45','2025-06-25 07:06:47'),(15,1,5,'oi',1,'2025-06-25 07:06:50','2025-06-25 07:06:49','2025-06-25 07:06:50'),(16,2,7,'oi',0,NULL,'2025-06-25 20:55:49','2025-06-25 20:55:49'),(17,3,2,'a',1,'2025-07-08 22:15:21','2025-07-08 22:13:45','2025-07-08 22:15:21');
/*!40000 ALTER TABLE `chat_messages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-08 16:43:09
