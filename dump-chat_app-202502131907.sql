-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: chat_app
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_rooms`
--

DROP TABLE IF EXISTS `chat_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_rooms_uuid_index` (`uuid`),
  KEY `chat_rooms_created_by_index` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_rooms`
--

LOCK TABLES `chat_rooms` WRITE;
/*!40000 ALTER TABLE `chat_rooms` DISABLE KEYS */;
INSERT INTO `chat_rooms` VALUES (1,'f452bd9a-5d41-434f-b1ee-5eee1d883e09','Obrolan Malam Programmer','Obrolan Malam Programmer','2025-02-13 04:54:45','2025-02-13 04:54:45',10),(2,'e3c383e8-8734-4647-a27d-49fe2f36d429','Belajar bareng Yuk','Belajar bareng Yuk','2025-02-13 05:00:03','2025-02-13 05:00:03',9),(3,'6e6ff4fb-a396-4b94-9bea-3d8ff325291f','Belajar bareng PHP Yuk','Belajar bareng PHP Yuk','2025-02-13 05:05:16','2025-02-13 05:05:16',9),(4,'02baeb70-0289-41bf-acd6-ed1a6ad8c093','Nongkrong bareng','Nongkrong bareng','2025-02-13 05:06:11','2025-02-13 05:06:11',9);
/*!40000 ALTER TABLE `chat_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_rooms_history`
--

DROP TABLE IF EXISTS `chat_rooms_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_rooms_history` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `chat_room_id` bigint unsigned DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_rooms_history_uuid_index` (`uuid`),
  KEY `chat_rooms_history_user_id_index` (`user_id`),
  KEY `chat_rooms_history_chat_room_id_index` (`chat_room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_rooms_history`
--

LOCK TABLES `chat_rooms_history` WRITE;
/*!40000 ALTER TABLE `chat_rooms_history` DISABLE KEYS */;
INSERT INTO `chat_rooms_history` VALUES (1,'00d1e054-3ae6-4338-951b-b3450b995995',10,1,'Halo Pak Admin','2025-02-13 04:55:34','2025-02-13 04:55:34'),(2,'6f559938-ebb7-493a-855d-44da3175d720',9,1,'Kenape','2025-02-13 04:55:56','2025-02-13 04:55:56'),(3,'d4ab479f-d277-4673-945a-4ab0ddc23498',10,1,'Gabut Aja..','2025-02-13 04:56:17','2025-02-13 04:56:17'),(4,'ac2c4061-ac44-43c6-b5df-fc3fd764d0b8',10,1,'Eh ada yes yas.. apa kabar bro?','2025-02-13 04:57:01','2025-02-13 04:57:01'),(5,'0c5b8a62-3438-4493-a480-93879f925721',9,1,'Baru nobgol nih anak, ayo kita meet up lagi','2025-02-13 04:57:38','2025-02-13 04:57:38'),(6,'29a399cf-3f72-4689-a066-53827e27acb0',6,1,'Biasa Kebanyakan project..','2025-02-13 04:58:08','2025-02-13 04:58:08'),(7,'9e742455-6081-426d-a409-50dfdb8e44cf',9,1,'cabuta ahh..','2025-02-13 04:58:39','2025-02-13 04:58:39');
/*!40000 ALTER TABLE `chat_rooms_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_rooms_invitations`
--

DROP TABLE IF EXISTS `chat_rooms_invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_rooms_invitations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` bigint unsigned DEFAULT NULL,
  `target_id` bigint unsigned DEFAULT NULL,
  `chat_room_id` bigint unsigned DEFAULT NULL,
  `is_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_rooms_invitations_uuid_index` (`uuid`),
  KEY `chat_rooms_invitations_sender_id_index` (`sender_id`),
  KEY `chat_rooms_invitations_target_id_index` (`target_id`),
  KEY `chat_rooms_invitations_chat_room_id_index` (`chat_room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_rooms_invitations`
--

LOCK TABLES `chat_rooms_invitations` WRITE;
/*!40000 ALTER TABLE `chat_rooms_invitations` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_rooms_invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_02_11_070817_create_personal_access_tokens_table',1),(5,'2025_02_11_071752_create_chat_rooms_table',1),(6,'2025_02_11_071859_create_roles_table',1),(7,'2025_02_11_071859_create_user_chat_rooms_table',1),(8,'2025_02_11_071900_create_chat_rooms_history_table',1),(9,'2025_02_11_101959_add_fcm_token_to_users_and_topic_to_chat_rooms',2),(10,'2025_02_11_135538_add_created_by_to_chat_rooms',3),(11,'2025_02_11_141227_create_chat_rooms_invitations_table',4),(12,'2025_02_12_225038_add_avatar_to_users',5),(13,'2025_02_13_082024_add_is_rejected_to_user_chat_rooms',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\Auth\\User',1,'API Token','e8398c1ce9bf1afb255d3c61d5ba6d5d6a6ec201a68600211e56a31630607d72','[\"*\"]',NULL,NULL,'2025-02-11 23:42:47','2025-02-11 23:42:47'),(4,'App\\Models\\Auth\\User',4,'API Token','62da4c46052f93db75d4d05048e8c40454c2fba90d3c36a60fb776b4bba473c2','[\"*\"]','2025-02-12 00:01:40',NULL,'2025-02-12 00:01:40','2025-02-12 00:01:40'),(19,'App\\Models\\Auth\\User',1,'API Token','2f7cc1cecc319e1a7c080a5a2e300064dac30ddabf2fcb37b027d490b57a7207','[\"*\"]','2025-02-12 15:55:38',NULL,'2025-02-12 15:55:37','2025-02-12 15:55:38'),(20,'App\\Models\\Auth\\User',2,'API Token','890189ed2405f7b996338803b6e3982844e9954104892850e4cfbb8ce046e906','[\"*\"]','2025-02-12 15:57:29',NULL,'2025-02-12 15:57:28','2025-02-12 15:57:29'),(22,'App\\Models\\Auth\\User',4,'API Token','907951612e9c33d9235055bcb1af07a49358d99a1b8a6e0831d0c2562d706328','[\"*\"]','2025-02-12 18:56:47',NULL,'2025-02-12 15:58:50','2025-02-12 18:56:47'),(31,'App\\Models\\Auth\\User',5,'API Token','7aceab1a810443c342ac3ef411757eded30e609233685a4d45cb4d1135863fb8','[\"*\"]','2025-02-12 21:37:59',NULL,'2025-02-12 20:06:57','2025-02-12 21:37:59'),(32,'App\\Models\\Auth\\User',3,'API Token','d653ab977108fe3597af891e59da201cd75fa5ab068a95b2e92510a9427047aa','[\"*\"]','2025-02-12 21:34:52',NULL,'2025-02-12 20:07:00','2025-02-12 21:34:52'),(41,'App\\Models\\Auth\\User',8,'API Token','39ee68c1b23c03dfc924c56c1d637261913fca122817cea3c940625f4040b870','[\"*\"]',NULL,NULL,'2025-02-12 22:19:33','2025-02-12 22:19:33'),(42,'App\\Models\\Auth\\User',8,'API Token','bb4b072c8e451a3054ff23ac5f1d807c12af1ac61460728956e68ab981a4b9bb','[\"*\"]','2025-02-13 04:45:39',NULL,'2025-02-12 22:20:06','2025-02-13 04:45:39'),(44,'App\\Models\\Auth\\User',6,'API Token','8eab80f71871353a790a49d7436322b8ca34dd4cbe4ea44194b98381384658d2','[\"*\"]','2025-02-13 05:02:52',NULL,'2025-02-13 03:57:48','2025-02-13 05:02:52'),(46,'App\\Models\\Auth\\User',9,'auth_token','9bdbe963604ee0909a7842f7513783f21545f8c6e8eba6ac5b28a802f50fa564','[\"*\"]','2025-02-13 05:06:13',NULL,'2025-02-13 04:17:11','2025-02-13 05:06:13'),(47,'App\\Models\\Auth\\User',10,'API Token','bd532fc17a177323e12f86c43e3e2ad1e179bf2613ac8989311095b8bb64f46f','[\"*\"]','2025-02-13 05:06:14',NULL,'2025-02-13 04:54:13','2025-02-13 05:06:14');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_uuid_index` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'qweasd23123124','admin',NULL,NULL),(2,'adasdadhfgjkhl6456','user',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_chat_rooms`
--

DROP TABLE IF EXISTS `user_chat_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_chat_rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `chat_room_id` bigint unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_rejected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_chat_rooms_uuid_index` (`uuid`),
  KEY `user_chat_rooms_user_id_index` (`user_id`),
  KEY `user_chat_rooms_chat_room_id_index` (`chat_room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_chat_rooms`
--

LOCK TABLES `user_chat_rooms` WRITE;
/*!40000 ALTER TABLE `user_chat_rooms` DISABLE KEYS */;
INSERT INTO `user_chat_rooms` VALUES (1,NULL,9,1,1,NULL,'2025-02-13 04:59:05',0),(2,NULL,7,1,0,NULL,NULL,0),(3,NULL,6,1,1,NULL,'2025-02-13 04:56:35',0),(4,NULL,10,1,1,NULL,NULL,0),(5,NULL,10,2,0,NULL,NULL,0),(6,NULL,7,2,0,NULL,NULL,0),(7,NULL,6,2,1,NULL,'2025-02-13 05:00:10',0),(8,NULL,9,2,1,NULL,'2025-02-13 05:02:51',0),(9,NULL,6,3,0,NULL,NULL,0),(10,NULL,10,3,0,NULL,NULL,0),(11,NULL,9,3,1,NULL,NULL,0),(12,NULL,10,4,0,NULL,'2025-02-13 05:06:15',1),(13,NULL,9,4,1,NULL,NULL,0);
/*!40000 ALTER TABLE `user_chat_rooms` ENABLE KEYS */;
UNLOCK TABLES;

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
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_index` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'ya yes','yesyasrps@gmail.com',NULL,'$2y$12$aKBlud2drtq5gNF.ocsXEu8ISry89IEMDs6Xmxhru51W700p/Ymj2','Yesyas',2,NULL,'euQZaXZ39yp-xAwHMOXGR3:APA91bEeMC5hayEafMumMcI8QCPti-KngmTwrGVhIoZCpTA8mT2Y-eWFxP5O57lV3QG7JKEv7My02UlYjazVSkIfhhRkoden0oP7SxR9Uowe_CqHAgL-SVs','2025-02-12 19:23:28','2025-02-13 03:57:49','https://lh3.googleusercontent.com/a/ACg8ocIvxjs9zM5ttlePUtKCBPC-NdSeBuJTar8TzQqvMi9gdZvFBg=s96-c'),(7,'Ihpaz Ramadhan','ihfazm@gmail.com',NULL,'$2y$12$cI1pp0.gmHVZrIVuMFFyyepGvGBcyZc0Po/uBj31nHooTVhLom9Su','Ihfazm',2,NULL,'ft_KxrvaN_YVUeDldbgzV1:APA91bETC64t7MlHMr2jxPzHpnpGa5IBFFw4Eb3HwjE5VVEKATt_aBb-YX-TncmOzzR_j0chqU2fOEkCLYwspUrkJe9HA5Hzbf-3Jvg6tsTV5RqgYwExdZQ','2025-02-12 21:40:48','2025-02-12 23:03:44','https://lh3.googleusercontent.com/a/ACg8ocIFS3AlhT6BTyLn3jOwUE-taZ0V_cv57W2FWefpnOg7ltWPsyH0=s96-c'),(9,'admin','ihfazm2@gmail.com','2025-02-13 04:09:34','$2y$12$pyoBwF.66w.qbKlaaXpDe.0Hrb0N4PuUobefMXyBa/r2rw7z742ze','admin',1,'6CT9GYgwGN','ft_KxrvaN_YVUeDldbgzV1:APA91bETC64t7MlHMr2jxPzHpnpGa5IBFFw4Eb3HwjE5VVEKATt_aBb-YX-TncmOzzR_j0chqU2fOEkCLYwspUrkJe9HA5Hzbf-3Jvg6tsTV5RqgYwExdZQ','2025-02-13 04:09:34','2025-02-13 04:17:12',NULL),(10,'LMS PENTES KEMHAN','notiflmspenteskemhan@gmail.com',NULL,'$2y$12$83DW5of55H5EtvCqY6mrcutBflBvtbjklHsbYP5yzLaeaeJPYzjBq','Jingga',2,NULL,'f_YP0bT_jvLr9pjz4tIGvT:APA91bETbNmW7gqbWQqht080wqVjKmMlz2HxXP0Ry2XsOG_WvIL9mU2Hs4pEgz6iswxwrGLHf4g9_s8q4orI3bEI_0iYNGgvLq5YAAudXAtWF1vUC7LtgX0','2025-02-13 04:54:13','2025-02-13 04:54:13','https://lh3.googleusercontent.com/a/ACg8ocJ95AAkRYIGqbg19qtaAGQzu9ZqPUSLrRUotnh-F3ZMYZvkgQ=s96-c');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'chat_app'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-13 19:07:00
