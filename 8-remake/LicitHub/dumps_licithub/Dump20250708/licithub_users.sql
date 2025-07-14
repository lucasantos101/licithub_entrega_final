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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ID no Stripe',
  `pm_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tipo de pagamento',
  `pm_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Últimos 4 dígitos',
  `trial_ends_at` timestamp NULL DEFAULT NULL COMMENT 'Fim do período de trial',
  `user_type` enum('customer','employee','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_stripe_id_index` (`stripe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Lucas Vinicius','dossantoslucs@gmail.com',NULL,'$2y$12$PrhZJqleeK/7Jev.N0iIUeG0qMWLvJqGMgkf/ab5LLVKEreEee7C2',NULL,NULL,NULL,NULL,NULL,'admin','2025-05-25 02:08:47','2025-05-26 00:58:51'),(2,'Bruno Santos','brvisan@gmail.com',NULL,'$2y$12$Newk2TQL..B43WJFK7626eb7ecy4zW39j2Alwc8a5IN.iov4fYrdq',NULL,'cus_SVUkGcZIKe8XWK','card','4242',NULL,'admin','2025-05-25 04:39:23','2025-06-16 06:27:39'),(3,'kauana','kauan@kauan.com',NULL,'$2y$12$wgSMKWP6KMWzEpHwxiI6y.yevorNeGVXyxze/0/U5XjWEdvcPXj6G',NULL,'cus_SYU3RTNB0jgHUV','card','4242',NULL,'customer','2025-05-25 07:23:18','2025-06-08 10:01:42'),(5,'etelvino','etelvino@etelvino.com',NULL,'$2y$12$bUkVSUhFnd.NVtJMWKqQ7Ojq2GZ09HBQpLFQZdQhaQNE7IWkOu7FW',NULL,'cus_SYUPj4uVY7IdHJ','card','4242',NULL,'customer','2025-06-24 06:20:24','2025-06-24 06:20:24'),(6,'ronaldo','ronaldo@ronaldo',NULL,'$2y$12$sXZOes0iT9Q1ib2KgKbAc.4.8EyOZRmTC1JFZL2xPLmCij067lIo2',NULL,NULL,NULL,NULL,NULL,'customer','2025-06-24 06:34:44','2025-06-24 06:34:44'),(7,'lucas','ronaldo@ronaldo.com',NULL,'$2y$12$JFHW9hNgXzsSf1stramNFuvkMYOBvRf/8pumHWx3t4AzU5NiBdtjG',NULL,'cus_SZ5hwg62yNGBdD','card','4242',NULL,'customer','2025-06-25 20:53:59','2025-06-25 20:53:59'),(8,'Alfonsos','afonso@afonso.com',NULL,'$2y$12$JVym2vg3CeWMO8clYDfpieHZyMUNKKEsY.72lJGG9LDxcZsqxX/oW',NULL,NULL,NULL,NULL,NULL,'customer','2025-06-30 08:11:03','2025-06-30 08:13:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
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
