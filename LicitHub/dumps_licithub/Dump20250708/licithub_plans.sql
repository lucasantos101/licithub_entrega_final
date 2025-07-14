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
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,2) NOT NULL,
  `trial_days` int NOT NULL DEFAULT '0',
  `interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'monthly, yearly',
  `stripe_price_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin COMMENT 'Recursos do plano em JSON',
  `features_off` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plans_slug_unique` (`slug`),
  KEY `plans_stripe_price_id_index` (`stripe_price_id`),
  CONSTRAINT `plans_chk_1` CHECK (json_valid(`features`)),
  CONSTRAINT `plans_chk_2` CHECK (json_valid(`features_off`))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'Plano Explorador','plano-explorador','Pequenos empresários ou autônomos que estão começando a buscar oportunidades em licitações.',39.90,0,'month','price_1RRROTQZYlGh3UzqVpcHQJzq',1,'\"[\\\"Acesso a licita\\\\u00e7\\\\u00f5es por regi\\\\u00e3o e por tipo de servi\\\\u00e7o\\\",\\\"At\\\\u00e9 3 filtros por busca (como estado, \\\\u00f3rg\\\\u00e3o ou categoria).\\\",\\\"Atualiza\\\\u00e7\\\\u00f5es de novas licita\\\\u00e7\\\\u00f5es duas vezes por semana.\\\",\\\"Hist\\\\u00f3rico das \\\\u00faltimas 10 licita\\\\u00e7\\\\u00f5es visualizadas.\\\"]\"','[\"Acesso a todos os estados ao mesmo tempo.\",\"Alertas autom\\u00e1ticos e personalizados.\",\"Relat\\u00f3rios em PDF.\",\"An\\u00e1lise de concorr\\u00eancia.\"]','2025-05-27 06:36:45','2025-07-08 21:50:02'),(2,'Plano Estratégico','plano-estrategico','Empresas que já participam ou desejam participar com frequência de licitações e precisam de eficiência nas buscas.',89.90,0,'month','price_1RTEFZQZYlGh3UzqyX7ZoWOx',1,'\"[\\\"Todos os Recursos Do Plano Explorador\\\",\\\"Acesso a todos os estados ao mesmo tempo.\\\",\\\"Alertas autom\\\\u00e1ticos e personalizados.\\\",\\\"Relat\\\\u00f3rios em PDF.\\\",\\\"An\\\\u00e1lise de concorr\\\\u00eancia.\\\"]\"','[\"Sugest\\u00f5es inteligentes com base em hist\\u00f3rico de vit\\u00f3rias.\",\"Acesso multiusu\\u00e1rio (para equipes).\"]','2025-05-27 06:36:45','2025-07-08 21:52:07'),(4,'Plano Inteligente','plano-inteligente','Empresas que querem otimizar seus resultados em licitações com ajuda de dados, automações e inteligência competitiva.',199.90,0,'month',NULL,1,'\"[\\\"Todos os Recursos do Plano Estrat\\\\u00e9gico\\\",\\\"Sugest\\\\u00f5es inteligentes com base em hist\\\\u00f3rico de vit\\\\u00f3rias.\\\",\\\"Acesso multiusu\\\\u00e1rio (at\\\\u00e9 5 membros da equipe).\\\",\\\"Dashboard com estat\\\\u00edsticas e metas.\\\",\\\"Sugest\\\\u00f5es autom\\\\u00e1ticas de licita\\\\u00e7\\\\u00f5es com maior chance de sucesso.\\\",\\\"An\\\\u00e1lise de concorrentes: veja quem venceu, com qual proposta e frequ\\\\u00eancia.\\\"]\"','[]','2025-06-28 05:03:13','2025-07-08 21:53:41');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
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
