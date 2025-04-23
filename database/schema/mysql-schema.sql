/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` json DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogs_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `commodities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commodities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `home_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `home_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` text COLLATE utf8mb4_unicode_ci COMMENT 'JSON untuk menyimpan data tambahan seperti statistik atau informasi khusus lainnya',
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `use_rich_editor` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Menandakan apakah bagian ini menggunakan TinyMCE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `home_contents_section_key_unique` (`section_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fas fa-bell',
  `icon_background` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bg-blue-100',
  `icon_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text-blue-500',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `page_seo_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_seo_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_identifier` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_robots` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_schema` text COLLATE utf8mb4_unicode_ci,
  `uses_global_settings` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_seo_settings_page_identifier_unique` (`page_identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `industry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `profile_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'about, vision, mission, service, etc',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_slogan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_description` text COLLATE utf8mb4_unicode_ci,
  `org_structure_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` text COLLATE utf8mb4_unicode_ci,
  `contact_maps_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pulau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_kab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan_kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `minimal_kg` int NOT NULL,
  `estimasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `logo_1_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_1_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_1_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_1_updated_at` timestamp NULL DEFAULT NULL,
  `logo_2_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_2_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_2_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_2_updated_at` timestamp NULL DEFAULT NULL,
  `logo_3_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_3_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_3_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_3_updated_at` timestamp NULL DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title_logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `structure_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `structure_image_updated_at` timestamp NULL DEFAULT NULL,
  `title_logo_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_logo_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tracking_dummy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tracking_dummy` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `awb_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reff_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipper_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin_district_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_district_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tlc_origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tlc_destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_instruction` text COLLATE utf8mb4_unicode_ci,
  `total_colly` int NOT NULL DEFAULT '1',
  `total_weight_charge` decimal(8,2) NOT NULL DEFAULT '0.00',
  `volumetric` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rowstate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rowstate_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_type_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeline` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tracking_dummy_awb_no_unique` (`awb_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_activities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_activities_user_id_foreign` (`user_id`),
  CONSTRAINT `user_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (65,'0001_01_01_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (66,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (67,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (68,'2024_01_02_000001_create_page_seo_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (69,'2024_01_09_add_role_to_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (70,'2024_01_09_create_rates_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (71,'2024_05_01_000000_add_active_column_to_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (72,'2024_05_22_000000_add_profile_fields_to_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (73,'2024_05_22_000001_create_user_activities_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (74,'2024_06_18_000000_create_commodities_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (75,'2024_07_05_create_profile_contents_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (76,'2024_07_14_create_home_contents_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (77,'2025_04_16_095642_add_uses_global_settings_to_page_seos_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (78,'2025_04_16_213140_create_notifications_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (79,'2025_04_17_020446_add_views_to_rates_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (80,'2025_04_17_050253_create_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (81,'2025_04_17_053451_update_services_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (82,'2025_04_18_071540_create_services_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (83,'2025_04_18_082105_create_partners_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (84,'2025_04_18_152024_remove_role_from_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (85,'2025_04_18_161053_drop_home_contents_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (86,'2025_04_18_161141_create_new_home_contents_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (87,'2025_04_18_190759_add_org_structure_to_profile_contents',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (88,'2025_04_18_191244_add_company_fields_to_profile_contents',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (89,'2025_04_18_191559_add_contact_fields_to_profile_contents',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (90,'2025_04_21_163456_create_blogs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (91,'2025_04_21_230404_add_secondary_phones_to_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (92,'2025_04_22_010610_add_title_logo_to_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (93,'2025_04_22_015232_add_additional_addresses_to_company_info',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (94,'2025_04_22_025347_add_icon_featured_sort_order_to_services_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (95,'2025_04_22_054413_alter_page_seo_settings_description_column',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (96,'2025_04_22_061111_add_active_and_last_login_to_users',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (97,'2025_04_22_081746_create_tracking_dummy_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (98,'2025_04_22_144647_add_structure_image_to_settings',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (99,'2025_04_23_000000_modify_partners_type_column',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (100,'2025_04_22_171031_add_missing_logo_fields_to_settings_table',2);
