-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: callofduty
-- ------------------------------------------------------
-- Server version	8.0.43

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `views_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_user_id_foreign` (`user_id`),
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Тестовая по МВ 2007','testovaia-po-mv-2007','COD 4: Modern Warfare','Новости','Описание','<p><strong><em>Call of Duty 4: Modern Warfare</em></strong> (также известная как <strong><em>Call of Duty 4</em></strong> или <strong><em>Call of Duty: Modern Warfare</em></strong>; с&nbsp;<a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/%D0%90%D0%BD%D0%B3%D0%BB%D0%B8%D0%B9%D1%81%D0%BA%D0%B8%D0%B9_%D1%8F%D0%B7%D1%8B%D0%BA\">англ.</a> — «Зов долга 4: Современная война»)&nbsp;— <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/%D0%9A%D0%BE%D0%BC%D0%BF%D1%8C%D1%8E%D1%82%D0%B5%D1%80%D0%BD%D0%B0%D1%8F_%D0%B8%D0%B3%D1%80%D0%B0\">компьютерная игра</a> в жанре <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/%D0%A8%D1%83%D1%82%D0%B5%D1%80_%D0%BE%D1%82_%D0%BF%D0%B5%D1%80%D0%B2%D0%BE%D0%B3%D0%BE_%D0%BB%D0%B8%D1%86%D0%B0\">шутера от первого лица</a>, разработанная <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/%D0%A1%D0%BE%D0%B5%D0%B4%D0%B8%D0%BD%D1%91%D0%BD%D0%BD%D1%8B%D0%B5_%D0%A8%D1%82%D0%B0%D1%82%D1%8B_%D0%90%D0%BC%D0%B5%D1%80%D0%B8%D0%BA%D0%B8\">американской</a> компанией <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Infinity_Ward\">Infinity Ward</a> и изданная <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Activision\">Activision</a>. Является четвёртой в серии <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Call_of_Duty\"><em>Call of Duty</em></a> и первой в подсерии <em>Modern Warfare</em>; официально проект был анонсирован 26 мая <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/2007_%D0%B3%D0%BE%D0%B4_%D0%B2_%D0%BA%D0%BE%D0%BC%D0%BF%D1%8C%D1%8E%D1%82%D0%B5%D1%80%D0%BD%D1%8B%D1%85_%D0%B8%D0%B3%D1%80%D0%B0%D1%85\">2007&nbsp;года</a>.</p><p><em>Call of Duty 4: Modern Warfare</em> была выпущена 5 ноября <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/2007_%D0%B3%D0%BE%D0%B4_%D0%B2_%D0%BA%D0%BE%D0%BC%D0%BF%D1%8C%D1%8E%D1%82%D0%B5%D1%80%D0%BD%D1%8B%D1%85_%D0%B8%D0%B3%D1%80%D0%B0%D1%85\">2007&nbsp;года</a> на трёх целевых платформах: <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Windows\">PC</a>, <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Xbox_360\">Xbox 360</a> и <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/PlayStation_3\">PlayStation 3</a>, а позже&nbsp;— на платформах <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Macintosh\">Mac</a>, <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Nintendo_DS\">Nintendo DS</a> и <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Wii\">Nintendo Wii</a>. С 12 ноября <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/2007_%D0%B3%D0%BE%D0%B4_%D0%B2_%D0%BA%D0%BE%D0%BC%D0%BF%D1%8C%D1%8E%D1%82%D0%B5%D1%80%D0%BD%D1%8B%D1%85_%D0%B8%D0%B3%D1%80%D0%B0%D1%85\">2007&nbsp;года</a> игра стала доступна для покупки через интернет-сервис <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Steam\">Steam</a>.</p><p>Сюжет игры связан с военными действиями начала XXI&nbsp;века. Одиночная кампания даёт игроку возможность поиграть за бойцов <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/%D0%9A%D0%BE%D1%80%D0%BF%D1%83%D1%81_%D0%BC%D0%BE%D1%80%D1%81%D0%BA%D0%BE%D0%B9_%D0%BF%D0%B5%D1%85%D0%BE%D1%82%D1%8B_%D0%A1%D0%A8%D0%90\">Корпуса морской пехоты США</a>, <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/%D0%9E%D1%81%D0%BE%D0%B1%D0%B0%D1%8F_%D0%B2%D0%BE%D0%B7%D0%B4%D1%83%D1%88%D0%BD%D0%B0%D1%8F_%D1%81%D0%BB%D1%83%D0%B6%D0%B1%D0%B0\">Особой воздушной службы Великобритании</a> и регулярных частей. Действие игры происходит в <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F\">России</a>, <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/%D0%90%D0%B7%D0%B5%D1%80%D0%B1%D0%B0%D0%B9%D0%B4%D0%B6%D0%B0%D0%BD\">Азербайджане</a>, <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/%D0%A3%D0%BA%D1%80%D0%B0%D0%B8%D0%BD%D0%B0\">Украине</a> и на <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/%D0%91%D0%BB%D0%B8%D0%B6%D0%BD%D0%B8%D0%B9_%D0%92%D0%BE%D1%81%D1%82%D0%BE%D0%BA\">Ближнем Востоке</a>.</p><p>За первые 24 часа продаж было продано около 600&nbsp;000 копий <em>Call of Duty 4: Modern Warfare</em>. Всего по миру было реализовано свыше 10 миллионов копий игры.</p><p>Также 25 мая <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/2010_%D0%B3%D0%BE%D0%B4_%D0%B2_%D0%BA%D0%BE%D0%BC%D0%BF%D1%8C%D1%8E%D1%82%D0%B5%D1%80%D0%BD%D1%8B%D1%85_%D0%B8%D0%B3%D1%80%D0%B0%D1%85\">2010&nbsp;года</a> <em>Call of Duty 4: Modern Warfare</em> стала доступна для покупки в системе <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer mw-redirect\" href=\"https://ru.wikipedia.org/wiki/Xbox_Live\">Xbox Live</a>, что позволило заинтересованным в приобретении данной игры не покупать её на диске, а, оплатив, скачать на свою приставку<a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Call_of_Duty_4:_Modern_Warfare#cite_note-5\">[5]</a>.</p><p>2 мая <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/2016_%D0%B3%D0%BE%D0%B4_%D0%B2_%D0%BA%D0%BE%D0%BC%D0%BF%D1%8C%D1%8E%D1%82%D0%B5%D1%80%D0%BD%D1%8B%D1%85_%D0%B8%D0%B3%D1%80%D0%B0%D1%85\">2016&nbsp;года</a> было анонсировано <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Call_of_Duty:_Modern_Warfare_Remastered\">переиздание</a> игры для <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer mw-redirect\" href=\"https://ru.wikipedia.org/wiki/IBM_PC-%D1%81%D0%BE%D0%B2%D0%BC%D0%B5%D1%81%D1%82%D0%B8%D0%BC%D1%8B%D0%B9_%D0%BA%D0%BE%D0%BC%D0%BF%D1%8C%D1%8E%D1%82%D0%B5%D1%80\">PC</a>, <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/PlayStation_4\">PlayStation 4</a> и <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Xbox_One\">Xbox One</a>; переиздание вышло 4 ноября <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/2016_%D0%B3%D0%BE%D0%B4_%D0%B2_%D0%BA%D0%BE%D0%BC%D0%BF%D1%8C%D1%8E%D1%82%D0%B5%D1%80%D0%BD%D1%8B%D1%85_%D0%B8%D0%B3%D1%80%D0%B0%D1%85\">2016&nbsp;года</a> вместе с <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" class=\"text-orange-500 underline hover:text-orange-400 cursor-pointer\" href=\"https://ru.wikipedia.org/wiki/Call_of_Duty:_Infinite_Warfare\"><em>Call of Duty: Infinite Warfare</em></a>.</p>','articles/OCkV8wCAqeAUIooBWrbvFlodOfVUQyP0ifFNiQ6B.jpg',1,1,'2025-10-09 00:11:53',16,'2025-10-09 00:11:53','2025-10-11 01:07:46');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `cache` VALUES ('laravel-cache-user-online-1','a:4:{s:2:\"id\";i:1;s:4:\"name\";s:7:\"zobnyyn\";s:6:\"avatar\";s:52:\"avatars/cYixmrASDeXVEkPmqxS3U5Uh1oIIHcZiRjBRiVMC.jpg\";s:13:\"last_activity\";s:19:\"2025-10-11 02:03:19\";}',1760148499);
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
-- Table structure for table `friendships`
--

DROP TABLE IF EXISTS `friendships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `friendships` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `friend_id` bigint unsigned NOT NULL,
  `status` enum('pending','accepted','declined','blocked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `friendships_user_id_friend_id_unique` (`user_id`,`friend_id`),
  KEY `friendships_user_id_friend_id_index` (`user_id`,`friend_id`),
  KEY `friendships_friend_id_user_id_index` (`friend_id`,`user_id`),
  KEY `friendships_status_index` (`status`),
  CONSTRAINT `friendships_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `friendships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friendships`
--

LOCK TABLES `friendships` WRITE;
/*!40000 ALTER TABLE `friendships` DISABLE KEYS */;
INSERT INTO `friendships` VALUES (1,1,2,'pending','2025-10-09 00:01:23','2025-10-09 00:01:23'),(2,1,3,'accepted','2025-10-09 14:53:36','2025-10-09 14:55:11');
/*!40000 ALTER TABLE `friendships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_item_zombie_guide`
--

DROP TABLE IF EXISTS `game_item_zombie_guide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_item_zombie_guide` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `zombie_guide_id` bigint unsigned NOT NULL,
  `game_item_id` bigint unsigned NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `game_item_zombie_guide_zombie_guide_id_category_index` (`zombie_guide_id`,`category`),
  KEY `game_item_zombie_guide_game_item_id_index` (`game_item_id`),
  CONSTRAINT `game_item_zombie_guide_game_item_id_foreign` FOREIGN KEY (`game_item_id`) REFERENCES `game_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `game_item_zombie_guide_zombie_guide_id_foreign` FOREIGN KEY (`zombie_guide_id`) REFERENCES `zombie_guides` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_item_zombie_guide`
--

LOCK TABLES `game_item_zombie_guide` WRITE;
/*!40000 ALTER TABLE `game_item_zombie_guide` DISABLE KEYS */;
INSERT INTO `game_item_zombie_guide` VALUES (4,2,2,'gum',1,'2025-10-09 00:47:34','2025-10-09 00:47:34'),(26,4,18,'weapon',0,'2025-10-09 16:00:48','2025-10-09 16:00:48'),(27,4,6,'perk',1,'2025-10-09 16:00:48','2025-10-09 16:00:48'),(28,4,11,'perk',2,'2025-10-09 16:00:48','2025-10-09 16:00:48'),(29,4,2,'gum',3,'2025-10-09 16:00:48','2025-10-09 16:00:48'),(40,1,13,'weapon',0,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(41,1,55,'weapon',1,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(42,1,54,'weapon',2,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(43,1,18,'weapon',3,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(44,1,4,'perk',4,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(45,1,7,'perk',5,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(46,1,5,'perk',6,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(47,1,6,'perk',7,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(48,1,10,'perk',8,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(49,1,9,'perk',9,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(50,1,11,'perk',10,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(51,1,28,'perk',11,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(52,1,29,'perk',12,'2025-10-11 01:07:28','2025-10-11 01:07:28'),(53,1,2,'gum',13,'2025-10-11 01:07:28','2025-10-11 01:07:28');
/*!40000 ALTER TABLE `game_item_zombie_guide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_items`
--

DROP TABLE IF EXISTS `game_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Тип предмета: weapon, wonder_weapon, special_weapon, perk, gum, elixir, field_upgrade, talisman',
  `game` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rarity` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Редкость предмета: common, rare, epic, legendary, ultra, whimsical',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `games` json DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `game_items_type_index` (`type`),
  KEY `game_items_game_index` (`game`),
  KEY `game_items_is_active_index` (`is_active`),
  KEY `game_items_sort_order_index` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_items`
--

LOCK TABLES `game_items` WRITE;
/*!40000 ALTER TABLE `game_items` DISABLE KEYS */;
INSERT INTO `game_items` VALUES (2,'Перкоголик','perkogolik','gum','Black Ops 3','legendary','Позволяет игроку получить все доступные на карте Перки.','game-items/images/1hcvwfZyiA0alCmwZYMyfUfVG3ffi9hSiiCXF5s9.webp',NULL,'[\"Black Ops 3\"]','[]',0,1,'2025-10-09 00:47:10','2025-10-09 15:05:17'),(4,'Джаггер-Фанта (Juggernog)','dzagger-fanta-juggernog','perk','Black Ops 3',NULL,'После получения он увеличивает здоровье игроков, позволяя им получать больше урона от врагов.','game-items/images/K1wF28XbTpxRFikjLGHP3c5Rc6qFEofFN3UQdDY0.webp',NULL,'[\"Black Ops 3\"]','[]',0,1,'2025-10-09 15:08:58','2025-10-09 15:14:05'),(5,'Реаниматор (Quick Revive Soda)','reanimator-quick-revive-soda','perk','Black Ops 3',NULL,'Позволяет игрокам поднимать/воскрешать своих товарищей по команде в два раза быстрее обычного.','game-items/images/TWikeeDoLxA98u2VITKz0mOZdkSbBk2v3ko90jL4.webp',NULL,'[\"Black Ops 3\"]','[]',0,1,'2025-10-09 15:10:23','2025-10-09 15:14:32'),(6,'Двойной выстрел (Double Tap II)','dvoinoi-vystrel-double-tap-ii','perk','Black Ops 3',NULL,'К увеличенной скорострельности добавилась возможность выстреливать две пули за выстрел, тратя всего одну. По сути, урон от вашего оружия, стреляющего пулями, увеличивается в два раза.','game-items/images/SGm8V2SNPZUfelAsKU3LWrrnjlG416tjuTFgEjQJ.webp',NULL,'[\"Black Ops 3\", \"Black Ops 2\"]','[]',0,1,'2025-10-09 15:12:04','2025-10-09 22:36:44'),(7,'Быстрокола (Speed-cola)','bystrokola-speed-cola','perk','Black Ops 3',NULL,'\"Быстрокола\" очень похожа на перк из мультиплеера Ловкость рук — оба они увеличивают скорость перезарядки в два раза. Однако Быстрокола также увеличивает скорость восстановления барьеров на 60%, не ускоряя при этом прицеливания.','game-items/images/BE01IKahiyVknZA8aB41xnN3iqZivjh1obVHM6Z4.webp',NULL,'[\"Black Ops 3\"]','[]',0,1,'2025-10-09 15:12:35','2025-10-09 15:14:15'),(8,'Доктор Бумс (PhD Flopper)','doktor-bums-phd-flopper','perk','Black Ops',NULL,'Действие перка следующее: теперь во время \"ныряния\" на дальнюю дистанцию, например, с лестницы, (во время бега нажать \"Ctrl\") происходит взрыв, наносящий урон зомби и Космическим обезьянам в радиусе поражения. Чем ближе зомби находились от эпицентра взрыва, тем больше урона наносит взрыв. К тому же игрок не получает урон от ныряния и от взрывов.','game-items/images/98EWXwbv4X37QBTiQUGK6RsdVUm1bsLP8Zme7A4T.webp',NULL,'[\"Black Ops\"]','[]',0,1,'2025-10-09 15:13:45','2025-10-09 15:13:45'),(9,'Коктейль выносливости (Stamin-Up)','kokteil-vynoslivosti-stamin-up','perk','Black Ops 3',NULL,'У него есть два эффекта, один из которых является стандартной версией перка \"Марафон\" из мультиплеера, который дает игроку удвоенную выносливость в спринте. Другой эффект идентичен перку \"Легкий\" из мультиплеера, который увеличивает скорость на 7%.','game-items/images/5HqtRV7IRzFNeN879LIx2q8Rwi1VUBfxxgWJVeJN.webp',NULL,'[\"Black Ops 3\"]','[]',0,1,'2025-10-09 15:16:24','2025-10-09 15:16:24'),(10,'Снайпер-лайм (Deadshot Daiquiry)','snaiper-laim-deadshot-daiquiry','perk','Black Ops 3',NULL,'Уникальность данного перка состоит в том, что для консолей и для РС функциональность перка различна. На РС данный перк увеличивает точность огня от бедра (аналог Твёрдой руки), уменьшает размер прицельных перекрестий и убирает качание прицела у снайперских винтовок и G11, а также, что довольно важно, увеличивает параметр \"centerspeed\" — скорость возвращения оружия в исходное состояние после выстрела. На консолях, помимо этого, перк ещё и автоматически наводит прицел на голову зомби (если игрок прицелился в торс), что весьма полезно.','game-items/images/x5tX6GuJnWklArlbsZ2giBu58V5QLQOAQPBN6Uea.webp',NULL,'[\"Black Ops 3\"]','[]',0,1,'2025-10-09 15:17:33','2025-10-09 15:17:33'),(11,'Пинок мула (Mule Kick)','pinok-mula-mule-kick','perk','Black Ops 3',NULL,'После покупки игрок не увидит никакого эффекта, кроме символа, появляющегося на его дисплее. Когда игрок отправится покупать свое следующее оружие, в подсказке по-прежнему будет указано, что оно заменит выбранное в данный момент оружие, но на самом деле оно займет свое место в третьем слоте.','game-items/images/VgNuWe10u0lot6SkolM5rSndxwu2LUPkfteXfqpr.webp',NULL,'[\"Black Ops 3\"]','[]',0,1,'2025-10-09 15:18:44','2025-10-09 15:18:44'),(12,'Кладбищенский Лимонад (Tombstone Soda)','kladbishhenskii-limonad-tombstone-soda','perk','Cold War',NULL,'Основная функция перка в том, что на месте смерти игрока, использовавшего этот перк, появляется могильный камень, который можно подобрать при следующем возрождении (подобрать может только тот игрок, чей это был камень); он возвращает все перки и оружие игроку. Если вы играете в одиночку или в режим Беда то автомата не будет. При игре в кооперативе автомат можно использовать.\r\n\r\nТак же если игрока сбили с ног, но он не использует перк, а ждёт воскрешения, то при воскрешении можно опять-же его подобрать. С помощью этого можно не терять перки при смерти.','game-items/images/wqYSpwmR7OGAgP4Zyq5yGjRHqzFSimNG9NafAlMc.webp',NULL,'[\"Cold War\"]','[]',0,1,'2025-10-09 15:19:56','2025-10-09 15:19:56'),(13,'Apothicon Servant','apothicon-servant','weapon','Black Ops 3',NULL,'При выстреле из него образуется черная дыра фиолетового цвета, которая засасывает зомби, оказавшихся слишком близко, убивая их мгновенно, независимо от того, в каком раунде находится игрок, аналогично устройству Герша. Через установленное время черная дыра взорвется, убив всех зомби поблизости. При перезарядке игрок кормит Слугу светящейся едой.','game-items/images/cLJtMwrC8Kjlty6waWnQnWKnwJhCLmlUmJ5UsCo4.webp',NULL,'[\"Black Ops 3\"]','[]',0,1,'2025-10-09 15:21:59','2025-10-09 15:21:59'),(18,'Wunderwaffe DG-2','wunderwaffe-dg-2','weapon',NULL,NULL,'\"Вундерваффе DG-2\" стало прорывом доктора Эдварда Рихтгофена в разработке оружия на заключительном этапе Второй мировой войны. Он был изготовлен на заводе в \"Der Riese\" вместе с телепортерами и предназначался для массового производства и поставок войскам на передовой, чтобы выиграть войну. Создан на основе элемента 115.','game-items/images/EIMPYPK4viyR3yT1vAFQcKomzoDa3tg3YfiKn8be.webp',NULL,'[\"World at War\", \"Black Ops\", \"Black Ops 6\", \"Black Ops 3\"]','[]',0,1,'2025-10-09 15:44:03','2025-10-09 15:49:16'),(19,'Быстрокола (Speed-cola)','bystrokola-speed-cola-1','perk',NULL,NULL,'\"Быстрокола\" очень похожа на перк из мультиплеера Ловкость рук — оба они увеличивают скорость перезарядки в два раза. Однако Быстрокола также увеличивает скорость восстановления барьеров на 60%, не ускоряя при этом прицеливания.','game-items/images/lhGGEXHZi6UOTGbUbOiZsTMoaBYqbfhqG0ApE92G.webp',NULL,'[\"Black Ops 6\", \"Cold War\"]','[]',0,1,'2025-10-09 15:49:45','2025-10-09 15:49:45'),(20,'Джаггер-Фанта (Juggernog)','dzagger-fanta-juggernog-1','perk',NULL,NULL,'После получения он увеличивает здоровье игроков, позволяя им получать больше урона от врагов.','game-items/images/wFzHDYE4OdI6Q3cFnrZC0zmqUMpGDkoDsnPSLLpg.webp',NULL,'[\"Cold War\", \"Black Ops 6\"]','[]',0,1,'2025-10-09 15:50:21','2025-10-09 15:50:21'),(21,'Коктейль выносливости (Stamin-Up)','kokteil-vynoslivosti-stamin-up-1','perk',NULL,NULL,'У него есть два эффекта, один из которых является стандартной версией перка \"Марафон\" из мультиплеера, который дает игроку удвоенную выносливость в спринте. Другой эффект идентичен перку \"Легкий\" из мультиплеера, который увеличивает скорость на 7%.','game-items/images/tQxdnti2awmYGYuBZa7HX28fgfQEoB4FwJVsmWrW.webp',NULL,'[\"Black Ops 6\", \"Cold War\"]','[]',0,1,'2025-10-09 15:50:52','2025-10-09 15:50:52'),(22,'Пинок мула (Mule Kick)','pinok-mula-mule-kick-1','perk',NULL,NULL,'После покупки игрок не увидит никакого эффекта, кроме символа, появляющегося на его дисплее. Когда игрок отправится покупать свое следующее оружие, в подсказке по-прежнему будет указано, что оно заменит выбранное в данный момент оружие, но на самом деле оно займет свое место в третьем слоте.','game-items/images/w3bS5o86olWMRGfXl0sW7D75keMzaWwWyNvh8ck9.webp',NULL,'[\"Cold War\", \"Black Ops 6\"]','[]',0,1,'2025-10-09 15:51:14','2025-10-09 15:51:14'),(23,'Реаниматор (Quick Revive Soda)','reanimator-quick-revive-soda-1','perk',NULL,NULL,'Позволяет игрокам поднимать/воскрешать своих товарищей по команде в два раза быстрее обычного.','game-items/images/rvuuGbOYG8y8s7AoCaEt6QqPDPI9rmznSfUo5PN2.webp',NULL,'[\"Black Ops 6\", \"Cold War\"]','[]',0,1,'2025-10-09 15:51:32','2025-10-09 15:51:32'),(24,'Снайпер-лайм (Deadshot Daiquiry)','snaiper-laim-deadshot-daiquiry-1','perk',NULL,NULL,NULL,'game-items/images/28QQ9Xw3rOZoOTMotb7S98YQa7ysnh9QrOJDoTgs.webp',NULL,'[\"Cold War\", \"Black Ops 6\"]','[]',0,1,'2025-10-09 15:51:45','2025-10-09 15:51:45'),(25,'Elemental Pop','elemental-pop','perk',NULL,NULL,'При приобретении игроком Elemental Pop дает небольшой шанс применить эффект модификации случайных боеприпасов к следующей атаке игрока. Этот эффект применяется только к огнестрельному оружию игрока и оружию ближнего боя и не может быть активирован на экипировке или полосе, используемой игроком.','game-items/images/HEPGY4tLXSOJJNLU2aNI9gU0MCBxCPK3RLGjSn6p.webp',NULL,'[\"Cold War\", \"Black Ops 6\"]','[]',0,1,'2025-10-09 15:53:08','2025-10-09 15:53:08'),(26,'Melee Macchiato','melee-macchiato','perk',NULL,NULL,'При приобретении заменяет приклад оружия игрока на смертельный удар, который отправляет врагов в полет, напоминающий удар в один дюйм, хотя и немного слабее. С помощью Melee Macchiato игрок может убивать одним ударом в обычном рукопашном бою в 20-м раунде, а в 25-м раунде - с усилением для тренировки силы. В некотором смысле, он занимает то же игровое пространство, что и нож Боуи или Galvaknuckles в предыдущих играх.','game-items/images/wZNGoL72lgq1ot8BCDErsuLChuafWrHx6WK6VWow.webp',NULL,'[\"Black Ops 6\"]','[]',0,1,'2025-10-09 15:54:57','2025-10-09 15:54:57'),(27,'Death Perception','death-perception','perk',NULL,NULL,'При покупке дает игроку оранжевый контур ближайших врагов сквозь стены, похожий на тепловизионный оптический прицел. Все ближайшие враги за пределами экрана будут выделены маленькими белыми стрелочками на дисплее, обозначающими их местоположение относительно игрока.','game-items/images/egZWZ7TUNsAZgTW9HPdVslBj64WEoRiqLTD6jrMF.webp',NULL,'[\"Cold War\", \"Black Ops 6\"]','[]',0,1,'2025-10-09 16:02:23','2025-10-09 16:02:23'),(28,'Вино вдовы (Widow\'s Wine)','vino-vdovy-widows-wine','perk',NULL,NULL,'Перк заменяет гранаты игрока на гранаты вина вдовы, которые выглядят, как семтекс и так же липнут к поверхностям и противникам. При взрыве все ближайшие зомби, попавшие в радиус взрыва, если не умирают, то очень сильно замедляются на несколько секунд.','game-items/images/PjiFhWvynVZ7qYJMgUY72RXAI9fqTq6vaEmbIcBs.webp',NULL,'[\"Black Ops 3\"]','[]',0,1,'2025-10-09 22:28:53','2025-10-09 22:28:53'),(29,'Электровишенка (Electric Cherry)','elektrovisenka-electric-cherry','perk',NULL,NULL,'Перк позволяет бить ближайших зомби электрическими разрядами при перезарядке. На более высоких раундов перк начинает лишь оглушать зомби, из-за нехватки урона для убийства.','game-items/images/gCAzO5UvWK3rB0gg8Hs3j5jDuC5z2Rfmddb38efd.webp',NULL,'[\"Black Ops 3\", \"Black Ops 2\"]','[]',0,1,'2025-10-09 22:30:17','2025-10-09 22:30:17'),(30,'Пиф-Паф Пиво (Double Tap Root Beer)','pif-paf-pivo-double-tap-root-beer-1','perk',NULL,NULL,'Он увеличивает скорострельность всего оружия на 33% и позволяет игроку быстрее складывать снаряжение, такое как клейморы, управлять винтовками с затвором, помповыми ружьями и чудо-оружием, а также поднимать затвор для полуавтоматического оружия.','game-items/images/hluRFC923tBjR3DHJFDQ1Sn3l5FLAWFzJmM9UM8w.webp',NULL,'[\"Black Ops\", \"World at War\"]','[]',0,1,'2025-10-09 22:36:20','2025-10-09 22:36:20'),(31,'Кладбищенский Лимонад (Tombstone Soda)','kladbishhenskii-limonad-tombstone-soda-1','perk',NULL,NULL,'Основная функция перка в том, что на месте смерти игрока, использовавшего этот перк, появляется могильный камень, который можно подобрать при следующем возрождении (подобрать может только тот игрок, чей это был камень); он возвращает все перки и оружие игроку. Если вы играете в одиночку или в режим Беда то автомата не будет. При игре в кооперативе автомат можно использовать.\r\n\r\nТак же если игрока сбили с ног, но он не использует перк, а ждёт воскрешения, то при воскрешении можно опять-же его подобрать. С помощью этого можно не терять перки при смерти.','game-items/images/q7u3IfCJkwbV6UIJkliK2GgmCXPziCBAm7Sz6wbI.webp',NULL,'[\"Black Ops 2\"]','[]',0,1,'2025-10-09 22:37:58','2025-10-09 22:37:58'),(32,'Эликсир Гриф (Vulture Aid)','eliksir-grif-vulture-aid','perk',NULL,NULL,'Позволяет собирать с убитых зомби патроны и деньги. Указывает сквозь стены на местоположение волшебной коробки, перков и других вещей: Ящик отображается двумя вопросами; оружие,покупаемое со стены отображается черепком ; перки отображаются принадлежащими им значками. Создает \"эффект газа\". Убивая много зомби, один из них начинает распылять зеленый газ, который заставляет бежать мертвецов от него куда подальше. Так образом, вы можете немного отдохнуть, перезарядиться и т.д. Действует этот эффект около 10 секунд.','game-items/images/to9EaWZdKkcuK7rXAzQKHj7CEphtwD3OCsnB4M29.webp',NULL,'[\"Black Ops 2\"]','[]',0,1,'2025-10-09 22:39:32','2025-10-09 22:39:32'),(33,'Эликсир Гриф (Vulture Aid)','eliksir-grif-vulture-aid-1','perk',NULL,NULL,'В Call of Duty: Black Ops 6 функциональность Vulture Aid изменилась. По умолчанию она позволяет зомби сбрасывать флаконы с эссенцией и боеприпасы, которые доступны и видны игроку при активированном Vulture Aid. Как и все Перк-а-колы, Vulture Aid может быть дополнен двумя из шести возможных дополнений. Игроки могут использовать одно основное и одно второстепенное дополнение одновременно.','game-items/images/qoSKEKAjwCoKTDJ0rIsZRY20OwNuOxOdi7UDiZ1r.webp',NULL,'[\"Black Ops 6\"]','[]',0,1,'2025-10-09 22:40:11','2025-10-09 22:40:11'),(34,'PhD Slider','phd-slider','perk',NULL,NULL,'PhD Slider позволяет игроку генерировать взрывную волну энергии эфириума при попадании в зомби. В отличие от своей версии в Black Ops 4, он не требует от игроков подзарядки. Вместо этого размер и урон от взрыва зависят от расстояния, которое игрок преодолел, прежде чем поразить цель.','game-items/images/I8BQ76yM4IZyvKWhHuKuhliH4EKKcF9lbmgDTSUD.webp',NULL,'[\"Cold War\", \"Black Ops 6\"]','[]',0,1,'2025-10-09 22:41:54','2025-10-09 22:42:11'),(35,'Пиф-паф пиво (Double Tap Root Beer)','pif-paf-pivo-double-tap-root-beer','perk',NULL,NULL,'В Call of Duty: Black Ops 6 базовый перк с двойным нажатием возвращается к исходной версии, увеличивая скорострельность всего оружия. Игроки должны еще раз обратить внимание на экономию боеприпасов, так как увеличение скорострельности, особенно с увеличением \"Двойного времени\", очень быстро истощит запасы игроков.','game-items/images/houbLm43HcNcea9HjEHaE6GmbiN9ZcHu6vMox7wy.webp',NULL,'[\"Black Ops 6\"]','[]',0,1,'2025-10-09 22:43:53','2025-10-09 22:43:53'),(36,'Timeslip','timeslip','perk',NULL,NULL,'Время перезарядки снаряжения увеличено. Оружие \"Таинственный ящик\" и \"Ударный набор\" появляется быстрее. Значительно сокращено время перезарядки ловушек и быстрого перемещения.\r\n\r\nМодификатор: Скорость перезарядки специального оружия и эликсира немного увеличена.','game-items/images/x0i4HlTteDDA0jAHyw0Y8vAxQBrdp1N8OdhDkO5R.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:45:35','2025-10-09 22:45:35'),(37,'Реаниматор (Quick Revive Soda)','reanimator-quick-revive-soda-2','perk',NULL,NULL,'Более короткая задержка перед восстановлением здоровья и повышенная скорость регенерации. Игроки восстанавливаются быстрее.\r\n\r\nМодификатор: Увеличивает скорость передвижения после начала восстановления здоровья. Восстановление дает обоим игрокам полное здоровье и увеличивает скорость передвижения.','game-items/images/gpYUoQiSNiSNzht1gjt2hwVIBBXRW4SIyjTli1bF.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:46:16','2025-10-09 22:46:16'),(38,'Death Perception','death-perception-1','perk',NULL,NULL,'Видеть ближайших врагов сквозь стены. Получать экранные индикаторы, когда враги приближаются к игроку из-за пределов экрана.\r\n\r\nМодификатор: Наносит повышенный урон по особым слабым местам противника.','game-items/images/IhLJQXn1nRbrTNFVwyTn1pAdf5E3ptk3fS2pPIBe.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:46:48','2025-10-09 22:46:48'),(39,'Коктейль выносливости (Stamin-Up)','kokteil-vynoslivosti-stamin-up-2','perk',NULL,NULL,'Увеличена скорость передвижения и спринта. Выносливость восстанавливается быстрее.\r\n\r\nМодификатор: Неограниченный спринт. Игрок может стрелять из оружия во время спринта.','game-items/images/ld3yS6pFxYwa5SMNkgmf06Ng6d8pvWIcR5fj4CeN.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:47:18','2025-10-09 22:47:18'),(40,'Etheral Razor','etheral-razor','perk',NULL,NULL,'Внезапные атаки ближнего боя поражают сразу нескольких противников, охватывая широкую дугу. При использовании внезапного удара и выпада наносится дополнительный урон, а также восстанавливается небольшое количество здоровья.\r\n\r\nМодификатор: Внезапный выпад мгновенно уничтожает обычных зомби, нанося увеличенный дополнительный урон другим врагам.','game-items/images/zSJd0YmDP1IRkxUsDuxtBTNaX7BsamZOuOkxXYiJ.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:48:07','2025-10-09 22:48:07'),(41,'Electric Burst','electric-burst','perk',NULL,NULL,'Перезарядка вызывает электрический разряд, который наносит урон ближайшим врагам и оглушает их. Чем меньше патрон в магазине, тем сильнее урон.\r\n\r\nМодификатор: При перезарядке на оружие ближнего боя игрока накапливается электрический заряд. При следующей атаке в ближнем бою оружие способно поражать врагов на ограниченное время. Чем меньше в магазине патрон, тем больше время их действия.','game-items/images/ik4F0sBHNLwW77lkohgXv5lG3q4lz1pWgNspQ3Bw.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:48:51','2025-10-09 22:48:51'),(42,'Dying Wish','dying-wish','perk',NULL,NULL,'Вместо того, чтобы перейти в подавленное состояние, игрок впадает в неистовство на девять секунд. В состоянии неистовства он неуязвим, а урон в ближнем бою значительно увеличивается. После этого у игрока остается один запас здоровья. Время восстановления увеличивается с каждым использованием.\r\n\r\nМодификатор: Игрок получит полный запас здоровья, когда перестанет быть одержимым.','game-items/images/6CFodYG1yAiaw7613Vzfjbrw5cHi4dnifdh4dOdo.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:49:27','2025-10-09 22:49:27'),(43,'Strong Cold Stronghold','strong-cold-stronghold','perk',NULL,NULL,'Оставаясь на месте, вы создаете защитный круг, который со временем увеличивает урон и броню, находясь внутри него.\r\n\r\nМодификатор: Враги, убитые внутри защитного круга, также увеличивают урон и броню.','game-items/images/8qSl7pzJC3fbro8CazrEJg6vssgVKA59OdwOQzxF.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:49:50','2025-10-09 22:49:50'),(44,'Victorious Tortoise','victorious-tortoise','perk',NULL,NULL,'Удерживаемые щиты блокируют урон со всех сторон. Когда щит ломается, вызывает защитный взрыв.\r\n\r\nМодификатор: Удары щитом могут сбивать с ног тяжелых врагов и мини-боссов.','game-items/images/qdhpHoz3XPje1OmFo0wHCZN70IvTh3QLd5fj1j68.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:50:16','2025-10-09 22:50:16'),(45,'Deadshot Dealer','deadshot-dealer','perk',NULL,NULL,'При наведении прицела вниз прицел фиксируется на голове противника. Уменьшен разброс от бедра и отдача при стрельбе. Убрано отклонение прицела.\r\n\r\nМодификатор: Увеличивает урон при серии выстрелов в голову.','game-items/images/1SDUEzyxF0D7QVVKfiWWPFd6eDDrE6VBbYbRzhYW.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:51:02','2025-10-09 22:51:02'),(46,'Bandolier Bandit','bandolier-bandit','perk',NULL,NULL,'Можете носить более увеличенный запас боеприпасов.\r\n\r\nМодификатор: Со временем пополняйте запасы снаряженного оружия из запаса боеприпасов.','game-items/images/h78EkrXfqSAJgfqo537Vt9iztHNL4EIYpzGeZXAL.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:51:43','2025-10-09 22:51:43'),(47,'Winter\'s Wail','winters-wail','perk',NULL,NULL,'При попадании в цель в ближнем бою происходит ледяной взрыв, который замораживает или замедляет врагов поблизости. Игрок может хранить два заряда.\r\n\r\nМодификатор: Ледяной взрыв создает замедляющее поле вокруг игрока на ограниченное время. Запасите дополнительный заряд.','game-items/images/x9cMaH1P9JFrRoRLKzZVwarGbNxS1oIX1ZveudpO.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:52:07','2025-10-09 22:52:07'),(48,'Пинок мула (Mule Kick)','pinok-mula-mule-kick-2','perk',NULL,NULL,'Можете носить 3-е дополнительное оружие.\r\n\r\nМодификатор: Переключайте оружие быстрее. Дополнительное оружие будет сохранено и восстановлено при следующей покупке перка \"Удар мула\".','game-items/images/McIklFsSKoP1j8yn52OFwsskeygYIHki5qJsCG1U.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:52:36','2025-10-09 22:52:36'),(49,'PhD Slider','phd-slider-1','perk',NULL,NULL,'Скользите, чтобы накопить заряд. После полной зарядки скользите по врагу, чтобы вызвать взрыв. Получите иммунитет к урону от взрыва.\r\n\r\nМодификатор: Увеличенная дальность скольжения. Устойчивость к ловушкам во время скольжения. Увеличенный урон от взрыва при заходе на горку с большой высоты.','game-items/images/SOT84KYlnG0ODEu2C5CJhYq2OC9iOj2eRpOsEfsA.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:52:54','2025-10-09 22:52:54'),(50,'Zombshell','zombshell','perk',NULL,NULL,'Создает поле заражения, которое действует 5-10 секунд, замедляя зомби и увеличивая наносимый им урон.\r\n\r\nМодификатор: Когда игрок стоит на поле, зомби его игнорируют.','game-items/images/S7S27QiqUFUFcysK1VcOnJ8MEcH0Ou1qugFeu1MP.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:53:14','2025-10-09 22:53:14'),(51,'Blood Wolf Bite','blood-wolf-bite','perk',NULL,NULL,'Призовите на помощь Волка, который будет наносить игроку приличный урон в течение 45 секунд.\r\n\r\nМодификатор: у зомби появляется шанс потерять небольшое количество боеприпасов и очков, а также специальный заряд оружия при убийстве Волком.','game-items/images/DJudmzGVw48Jcym3ybARo1p2oMxJZy3nuOEEWVoZ.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 22:53:32','2025-10-09 22:53:32'),(52,'Blaze Phase','blaze-phase','perk',NULL,NULL,'Когда игрок приседает, у него накапливается заряд. Если во время этого не приседать, игрок будет двигаться вперед на предельной скорости, убивая или сбивая с ног зомби на своем пути.\r\n\r\nМодификатор: позволяет игроку заряжать оружие до дополнительного состояния, которое бесконечно, пока оно не коснется поверхности.','game-items/images/SqTV41IZj8q0tGFzL5BX0LKb40InIpdnPE63jUI1.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 23:04:57','2025-10-09 23:04:57'),(53,'Secret Sauce','secret-sauce','perk',NULL,NULL,'Получайте случайный перк, не назначенную в слоты.\r\n\r\nМодификатор: Модификатор полученной случайной привилегии.','game-items/images/i23u0buK0iEmpJW9Sc5w39oQqES6sBPqbdNXJnUY.webp',NULL,'[\"Black Ops 4\"]','[]',0,1,'2025-10-09 23:05:44','2025-10-09 23:05:44'),(54,'Ray Gun','ray-gun','weapon',NULL,NULL,'Ray Gun - это полностью автоматическое оружие, похожее на пистолет созданное группой 935 и появляющееся на каждой карте Зомби.','game-items/images/BZgA4L1qHC7cLWs9nDtUlIHL4LYvvkIrB2gV3RlK.webp',NULL,'[\"World at War\", \"Black Ops\", \"Black Ops 2\", \"Black Ops 3\", \"Black Ops 4\", \"Cold War\", \"Black Ops 6\", \"Black Ops 7\"]','[]',0,1,'2025-10-09 23:08:49','2025-10-09 23:08:49'),(55,'Thundergun','thundergun','weapon',NULL,NULL,'Thundergun - это большое оружие в форме пушки, стреляющее струями сжатого воздуха невероятной мощности. У него нет прицельной мушки, что означает, что стрелять из него нужно от бедра (хотя, если смотреть от третьего лица, его держат на плече). Он способен убить большое количество зомби одним выстрелом, отправляя их в полет назад или вверх.','game-items/images/O9GwHAkrATnzk1z8ITckdy1EHMzSBVKCDvqdkNyf.webp',NULL,'[\"Black Ops\", \"Black Ops 3\", \"Black Ops 4\"]','[]',0,1,'2025-10-09 23:10:24','2025-10-09 23:10:24');
/*!40000 ALTER TABLE `game_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guide_achievements`
--

DROP TABLE IF EXISTS `guide_achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guide_achievements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `zombie_guide_id` bigint unsigned NOT NULL,
  `completed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `display_order` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guide_achievements_user_id_zombie_guide_id_unique` (`user_id`,`zombie_guide_id`),
  KEY `guide_achievements_zombie_guide_id_foreign` (`zombie_guide_id`),
  KEY `guide_achievements_display_order_index` (`display_order`),
  CONSTRAINT `guide_achievements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guide_achievements_zombie_guide_id_foreign` FOREIGN KEY (`zombie_guide_id`) REFERENCES `zombie_guides` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guide_achievements`
--

LOCK TABLES `guide_achievements` WRITE;
/*!40000 ALTER TABLE `guide_achievements` DISABLE KEYS */;
INSERT INTO `guide_achievements` VALUES (1,1,1,'2025-10-08 23:57:06',NULL,'2025-10-08 23:57:06','2025-10-09 16:03:36'),(2,1,2,'2025-10-08 23:59:53',NULL,'2025-10-08 23:59:53','2025-10-09 16:03:36'),(3,3,2,'2025-10-09 14:55:38',NULL,'2025-10-09 14:55:38','2025-10-09 14:55:38'),(4,3,1,'2025-10-09 15:01:32',NULL,'2025-10-09 15:01:32','2025-10-09 15:01:32'),(5,1,4,'2025-10-09 16:01:03',1,'2025-10-09 16:01:03','2025-10-09 16:03:36');
/*!40000 ALTER TABLE `guide_achievements` ENABLE KEYS */;
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
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_receiver_id_index` (`sender_id`,`receiver_id`),
  KEY `messages_receiver_id_is_read_index` (`receiver_id`,`is_read`),
  CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,3,'привет',1,'2025-10-09 15:11:22','2025-10-09 15:28:29'),(2,1,3,'лох',1,'2025-10-09 15:59:10','2025-10-09 15:59:16'),(3,3,1,'иди нахуй',1,'2025-10-09 15:59:19','2025-10-09 15:59:28'),(4,3,1,'ха ха ха',1,'2025-10-10 01:33:21','2025-10-10 01:35:49'),(5,3,1,'сайт рухнул',1,'2025-10-10 01:33:24','2025-10-10 01:35:49'),(6,3,1,'какашки',1,'2025-10-10 01:33:25','2025-10-10 01:35:49'),(7,3,1,'бебеебеб',1,'2025-10-10 01:33:28','2025-10-10 01:35:49'),(8,3,1,'гвоно',1,'2025-10-10 01:33:29','2025-10-10 01:35:49'),(9,3,1,'каки',1,'2025-10-10 01:33:30','2025-10-10 01:35:49'),(10,1,3,'кто нахуй',1,'2025-10-10 01:35:57','2025-10-10 01:52:40'),(11,1,3,'куда рухнул',1,'2025-10-10 01:35:59','2025-10-10 01:52:40'),(12,1,3,'блять сука',1,'2025-10-10 01:36:01','2025-10-10 01:52:40'),(13,1,3,'даун',1,'2025-10-10 01:36:02','2025-10-10 01:52:40'),(14,1,3,'управы на тебя нет',1,'2025-10-10 01:36:08','2025-10-10 01:52:40'),(15,1,3,'ало',1,'2025-10-10 22:20:50','2025-10-10 22:21:18'),(16,1,3,'почему не отвечаешь',1,'2025-10-10 22:21:13','2025-10-10 22:21:18'),(17,1,3,'пошли играть в блак опс 4',1,'2025-10-10 22:21:18','2025-10-10 22:21:21'),(18,1,3,'ыыыыыыыы',1,'2025-10-10 22:21:20','2025-10-10 22:21:21'),(19,3,1,'ne pishi mne',1,'2025-10-10 22:21:27','2025-10-10 22:21:29'),(20,3,1,'падла ебанная',1,'2025-10-10 23:43:56','2025-10-10 23:45:14');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (9,'2025_10_07_000314_create_zombie_guides_table',6),(19,'2025_10_07_050000_add_display_order_to_guide_achievements_table',12),(33,'0001_01_01_000000_create_users_table',13),(34,'0001_01_01_000001_create_cache_table',13),(35,'0001_01_01_000002_create_jobs_table',13),(36,'2025_01_07_120000_create_friendships_table',13),(37,'2025_01_07_130000_create_notifications_table',13),(38,'2025_01_07_140000_create_messages_table',13),(39,'2025_10_06_214923_create_articles_table',13),(40,'2025_10_06_223034_create_personal_access_tokens_table',13),(41,'2025_10_06_224907_add_avatar_to_users_table',13),(42,'2025_10_06_232043_add_social_fields_to_users_table',13),(43,'2025_10_07_000336_create_zombie_guides_table',13),(44,'2025_10_07_010058_add_is_admin_to_users_table',13),(45,'2025_10_07_013204_remove_map_name_from_zombie_guides_table',13),(46,'2025_10_07_040500_create_guide_achievements_table',13),(47,'2025_10_07_041020_add_display_order_to_guide_achievements_table',13),(48,'2025_10_07_053946_add_display_order_to_guide_achievements_table',13),(50,'2025_10_09_000000_create_game_items_table',14),(51,'2025_10_09_000001_create_game_item_zombie_guide_table',15),(52,'2025_10_09_000002_add_social_fields_to_users_table',16),(53,'2025_10_09_000003_add_display_order_to_guide_achievements_table',17),(54,'2025_10_09_003000_add_category_to_articles_table',18),(55,'2025_10_09_000000_add_gives_achievement_to_zombie_guides_table',19),(56,'2025_10_09_000001_set_default_gives_achievement_for_existing_guides',20),(57,'2025_10_09_130000_migrate_game_to_games_array',21),(58,'2025_10_09_160000_remove_unique_constraint_from_slug',22),(59,'2025_10_10_020000_create_wiki_pages_table',23),(60,'2025_10_10_020001_create_wiki_weapons_table',24),(61,'2025_10_10_020002_create_wiki_maps_table',25),(62,'2025_10_10_020003_create_wiki_zombie_maps_table',26),(63,'2025_10_11_000000_update_game_items_type_column',27),(64,'2025_10_11_000001_update_game_items_rarity_column',28),(65,'2025_10_11_100000_create_warzone_weapons_table',29),(66,'2025_10_11_100100_create_warzone_weapon_builds_table',30),(67,'2025_10_11_100200_create_warzone_weapon_build_attachments_table',31);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `from_user_id` bigint unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` json DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_from_user_id_foreign` (`from_user_id`),
  KEY `notifications_user_id_read_index` (`user_id`,`read`),
  KEY `notifications_type_index` (`type`),
  KEY `notifications_created_at_index` (`created_at`),
  CONSTRAINT `notifications_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,2,1,'friend_request','zobnyyn отправил вам запрос в друзья','{\"friendship_id\": 1}',0,'2025-10-09 00:01:23','2025-10-09 00:01:23'),(2,3,1,'friend_request','zobnyyn отправил вам запрос в друзья','{\"friendship_id\": 2}',1,'2025-10-09 14:53:36','2025-10-09 14:55:11'),(20,3,NULL,'message','zobnyyn: пошли играть в блак опс 4','\"{\\\"sender_id\\\":1,\\\"sender_name\\\":\\\"zobnyyn\\\",\\\"message_id\\\":17}\"',1,'2025-10-10 22:21:18','2025-10-10 22:21:32'),(21,3,NULL,'message','zobnyyn: ыыыыыыыы','\"{\\\"sender_id\\\":1,\\\"sender_name\\\":\\\"zobnyyn\\\",\\\"message_id\\\":18}\"',1,'2025-10-10 22:21:20','2025-10-10 22:21:32');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
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
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('avs8yaeMhFiWxo0jJUBt82uIW5C3ILOY3apcFClb',1,'172.18.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:143.0) Gecko/20100101 Firefox/143.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiakdWelRjZmM5Q2tadjNyTTZTZjBFRlo4bUtTUXlZd0RJdGlaU0F5RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3QvYXBpL21lc3NhZ2VzL3VucmVhZC1jb3VudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1760148199),('eHYiNZhmWU3cENBjOff2tFcTIngQc9hmfTB7dkCs',NULL,'172.18.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:143.0) Gecko/20100101 Firefox/143.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3dqZFpld2JnZ043S014SEZjdW51bkh2MGFVV2R4dmtteHA5aUsyVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Qvd2Fyem9uZS9tZXRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1760141322),('q1hgn08MU4GgevdEH5su72HKaXMmRagjJi6XPMnQ',3,'25.52.146.224','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 YaBrowser/25.8.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMzdIU3JpVGI1azRrenZqdVhjSDZ6RGNLUWtsdnJUUzZGZW1DZFlzTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8yNS41Mi4xNDYuMjA5L2FwaS9tZXNzYWdlcy91bnJlYWQtYnktdXNlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==',1760145271);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
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
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discord` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `xbox` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `steam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'zobnyyn','therealzobnyyn@vk.com',1,'avatars/cYixmrASDeXVEkPmqxS3U5Uh1oIIHcZiRjBRiVMC.jpg',NULL,'$2y$12$CCMpsZFv2HoqY6a.yJ.T2e0XO/pnp24g93UuF3NGoNf.WwRbuVTwS',NULL,'2025-10-08 23:46:25','2025-10-08 23:59:01','@zobnyyn','missortega',NULL,NULL,NULL),(2,'Test User','test@example.com',0,NULL,'2025-10-08 23:51:28','$2y$12$IG7jCyJ2PfMl87RvySLoIeLmenYmgBd28UE8Fn8a5SQdbhZEgFr0C','E0q38fCzu7','2025-10-08 23:51:28','2025-10-08 23:51:28',NULL,NULL,NULL,NULL,NULL),(3,'fexbeatz','yarovikov-nik@mail.ru',1,'avatars/1DjAflVxief5Y1qC1PFTJt719MshZu6VjJD9TzEN.jpg',NULL,'$2y$12$ZrlfeMyl.C.rFg/Ei2Asree1uD5Xb9zcfF9wgP/MZADQYdsMmOHc6',NULL,'2025-10-09 14:51:26','2025-10-09 14:51:42',NULL,'fexbeatz',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warzone_weapon_build_attachments`
--

DROP TABLE IF EXISTS `warzone_weapon_build_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `warzone_weapon_build_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warzone_weapon_build_id` bigint unsigned NOT NULL,
  `slot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stat_mods` json DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warzone_weapon_build_attachments_warzone_weapon_build_id_index` (`warzone_weapon_build_id`),
  CONSTRAINT `warzone_weapon_build_attachments_warzone_weapon_build_id_foreign` FOREIGN KEY (`warzone_weapon_build_id`) REFERENCES `warzone_weapon_builds` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warzone_weapon_build_attachments`
--

LOCK TABLES `warzone_weapon_build_attachments` WRITE;
/*!40000 ALTER TABLE `warzone_weapon_build_attachments` DISABLE KEYS */;
INSERT INTO `warzone_weapon_build_attachments` VALUES (1,1,'barrel','СТВОЛ СУКА',NULL,0,'2025-10-11 00:15:47','2025-10-11 00:15:47'),(5,2,'stock','да',NULL,0,'2025-10-11 00:44:05','2025-10-11 00:44:05'),(6,2,'trigger','лол',NULL,1,'2025-10-11 00:44:05','2025-10-11 00:44:05'),(7,2,'underbarrel','лол',NULL,2,'2025-10-11 00:44:05','2025-10-11 00:44:05'),(8,2,'barrel','д',NULL,3,'2025-10-11 00:44:05','2025-10-11 00:44:05'),(9,2,'optic','а',NULL,4,'2025-10-11 00:44:05','2025-10-11 00:44:05'),(10,2,'laser','н',NULL,5,'2025-10-11 00:44:05','2025-10-11 00:44:05'),(11,2,'bolt','г',NULL,6,'2025-10-11 00:44:05','2025-10-11 00:44:05'),(12,2,'guard','щ',NULL,7,'2025-10-11 00:44:05','2025-10-11 00:44:05');
/*!40000 ALTER TABLE `warzone_weapon_build_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warzone_weapon_builds`
--

DROP TABLE IF EXISTS `warzone_weapon_builds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `warzone_weapon_builds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warzone_weapon_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `tier_override` enum('imba_patch','meta','normal','avoid') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warzone_weapon_builds_warzone_weapon_id_is_active_index` (`warzone_weapon_id`,`is_active`),
  CONSTRAINT `warzone_weapon_builds_warzone_weapon_id_foreign` FOREIGN KEY (`warzone_weapon_id`) REFERENCES `warzone_weapons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warzone_weapon_builds`
--

LOCK TABLES `warzone_weapon_builds` WRITE;
/*!40000 ALTER TABLE `warzone_weapon_builds` DISABLE KEYS */;
INSERT INTO `warzone_weapon_builds` VALUES (1,1,'ЛОЛ',NULL,'БЛЯТЬ','imba_patch',1,'2025-10-11 00:15:47','2025-10-11 00:15:47'),(2,2,'для говна','Mid Range','Да',NULL,1,'2025-10-11 00:41:01','2025-10-11 00:41:01');
/*!40000 ALTER TABLE `warzone_weapon_builds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warzone_weapons`
--

DROP TABLE IF EXISTS `warzone_weapons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `warzone_weapons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tier` enum('imba_patch','meta','normal','avoid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin_game` enum('mw2022','mw2023','bo6') COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('ar','smg','lmg','marksman','sniper','shotgun','pistol','launcher','melee','tactical','battlerifle') COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `popularity` int NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `warzone_weapons_slug_unique` (`slug`),
  KEY `warzone_weapons_tier_origin_game_category_is_active_index` (`tier`,`origin_game`,`category`,`is_active`),
  KEY `warzone_weapons_sort_order_index` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warzone_weapons`
--

LOCK TABLES `warzone_weapons` WRITE;
/*!40000 ALTER TABLE `warzone_weapons` DISABLE KEYS */;
INSERT INTO `warzone_weapons` VALUES (1,'MCW😀🤩😍','mcw','meta','mw2023','tactical',NULL,'warzone/weapons/tzEkS5YxCqA2zReiJ8eY7w4PKNFbLW9eaAb3Hw27.jpg','LOOOOL',1,0,0,NULL,'2025-10-10 23:42:31','2025-10-10 23:49:07'),(2,'КАЛАШ','kalas','imba_patch','mw2022','ar',NULL,NULL,'да',1,0,0,NULL,'2025-10-11 00:04:17','2025-10-11 00:04:17');
/*!40000 ALTER TABLE `warzone_weapons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_maps`
--

DROP TABLE IF EXISTS `wiki_maps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wiki_maps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `game` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'multiplayer',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_modes` json DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tips` text COLLATE utf8mb4_unicode_ci,
  `meta_data` json DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wiki_maps_game_type_index` (`game`,`type`),
  KEY `wiki_maps_is_active_index` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiki_maps`
--

LOCK TABLES `wiki_maps` WRITE;
/*!40000 ALTER TABLE `wiki_maps` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiki_maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_pages`
--

DROP TABLE IF EXISTS `wiki_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wiki_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `game` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_data` json DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wiki_pages_slug_unique` (`slug`),
  KEY `wiki_pages_game_index` (`game`),
  KEY `wiki_pages_is_published_index` (`is_published`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiki_pages`
--

LOCK TABLES `wiki_pages` WRITE;
/*!40000 ALTER TABLE `wiki_pages` DISABLE KEYS */;
INSERT INTO `wiki_pages` VALUES (1,'world-at-war','world-at-war-wiki','Call of Duty: World at War','Шутер от первого лица во время Второй мировой войны. Первая игра с режимом Nazi Zombies.','\"{\\\"weapons\\\":[],\\\"maps\\\":[],\\\"zombie_maps\\\":[]}\"',NULL,NULL,NULL,1,1,'2025-10-10 00:13:34','2025-10-10 00:13:34'),(2,'black-ops','black-ops-wiki','Call of Duty: Black Ops','Действие происходит во время Холодной войны. Культовый зомби-режим с легендарными картами.','\"{\\\"weapons\\\":[],\\\"maps\\\":[],\\\"zombie_maps\\\":[]}\"',NULL,NULL,NULL,2,1,'2025-10-10 00:13:34','2025-10-10 00:13:34'),(3,'black-ops-2','black-ops-2-wiki','Call of Duty: Black Ops II','Футуристический шутер с нелинейным сюжетом. Действие в 1980-х и 2025 году.','\"{\\\"weapons\\\":[],\\\"maps\\\":[],\\\"zombie_maps\\\":[]}\"',NULL,NULL,NULL,3,1,'2025-10-10 00:13:34','2025-10-10 00:13:34'),(4,'black-ops-3','black-ops-3-wiki','Call of Duty: Black Ops III','Футуристический шутер с киберпанк-элементами. Действие в 2065 году.','\"{\\\"weapons\\\":[],\\\"maps\\\":[],\\\"zombie_maps\\\":[]}\"',NULL,NULL,NULL,4,1,'2025-10-10 00:13:34','2025-10-10 00:13:34'),(5,'black-ops-4','black-ops-4-wiki','Call of Duty: Black Ops 4','Мультиплеерный шутер с расширенным зомби-режимом и режимом Battle Royale.','\"{\\\"weapons\\\":[],\\\"maps\\\":[],\\\"zombie_maps\\\":[]}\"',NULL,NULL,NULL,5,1,'2025-10-10 00:13:34','2025-10-10 00:13:34'),(6,'cold-war','cold-war-wiki','Call of Duty: Black Ops Cold War','Возвращение к истокам Холодной войны с обновленным зомби-режимом Dark Aether.','\"{\\\"weapons\\\":[],\\\"maps\\\":[],\\\"zombie_maps\\\":[]}\"',NULL,NULL,NULL,6,1,'2025-10-10 00:13:34','2025-10-10 00:13:34'),(7,'black-ops-6','black-ops-6-wiki','Call of Duty: Black Ops 6','Новейшая игра серии Black Ops с современными технологиями и зомби-режимом.','\"{\\\"weapons\\\":[],\\\"maps\\\":[],\\\"zombie_maps\\\":[]}\"',NULL,NULL,NULL,7,1,'2025-10-10 00:13:34','2025-10-10 00:13:34');
/*!40000 ALTER TABLE `wiki_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_weapons`
--

DROP TABLE IF EXISTS `wiki_weapons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wiki_weapons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `game` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stats` json DEFAULT NULL,
  `attachments` json DEFAULT NULL,
  `availability` json DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wiki_weapons_game_category_index` (`game`,`category`),
  KEY `wiki_weapons_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiki_weapons`
--

LOCK TABLES `wiki_weapons` WRITE;
/*!40000 ALTER TABLE `wiki_weapons` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiki_weapons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki_zombie_maps`
--

DROP TABLE IF EXISTS `wiki_zombie_maps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wiki_zombie_maps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `game` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `story` longtext COLLATE utf8mb4_unicode_ci,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` json DEFAULT NULL,
  `release_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dlc_pack` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features` json DEFAULT NULL,
  `easter_eggs` json DEFAULT NULL,
  `perks` json DEFAULT NULL,
  `weapons` json DEFAULT NULL,
  `characters` json DEFAULT NULL,
  `tips` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wiki_zombie_maps_game_is_published_index` (`game`,`is_published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiki_zombie_maps`
--

LOCK TABLES `wiki_zombie_maps` WRITE;
/*!40000 ALTER TABLE `wiki_zombie_maps` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiki_zombie_maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zombie_guides`
--

DROP TABLE IF EXISTS `zombie_guides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zombie_guides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `game` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `map_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `gives_achievement` tinyint(1) NOT NULL DEFAULT '1',
  `views` int NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zombie_guides_user_id_foreign` (`user_id`),
  CONSTRAINT `zombie_guides_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zombie_guides`
--

LOCK TABLES `zombie_guides` WRITE;
/*!40000 ALTER TABLE `zombie_guides` DISABLE KEYS */;
INSERT INTO `zombie_guides` VALUES (1,'Black Ops 3','shadows-of-evil','shadows of evil','123','<p>12345567</p>','guides/QBo3JHH1982InXWEsZiA3kd3boE0DmISDDZS15F8.jpg',1,1,20,1,'2025-10-08 23:56:03','2025-10-11 01:46:59'),(2,'Black Ops 3','the-giant','54545','54545454','<p>54545454</p>','guides/WggdtwKx0IChW2Cl97u609ixd37vpBd2UBFqCVm5.jpg',1,1,6,1,'2025-10-08 23:59:45','2025-10-09 15:56:41'),(3,'Black Ops 3','der-eisendrache','123','3423','<p>23232</p>','guides/dOxpdoxzljELdqCVeQ4HvWSBwIbKPDt2yQQWPbRz.webp',1,0,3,1,'2025-10-09 15:08:53','2025-10-10 21:40:30'),(4,'Black Ops 3','bo3-verruckt','65656','65656565','<h3 id=\"65656\">65656</h3><p>рпрпр</p><p></p><h2 id=\"6565\">6565</h2><p></p><p></p><h3 id=\"6565\">6565</h3><p></p>','guides/LnZBa7ghmoA2TxYk50w7D4fQ40YYOX2ZQ5EddJ6K.webp',1,1,2,1,'2025-10-09 16:00:48','2025-10-09 16:07:17');
/*!40000 ALTER TABLE `zombie_guides` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-11  2:03:20
