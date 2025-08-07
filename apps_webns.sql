-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 12:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apps_webns`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `alt` text NOT NULL,
  `description` longtext DEFAULT NULL,
  `app_slug` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `user_id`, `company_id`, `name`, `image`, `alt`, `description`, `app_slug`, `status`, `created_at`, `updated_at`) VALUES
(6, NULL, 8, 'Vat Bangla', 'admin/images/app/15222hrms.jpg', 'Vat Bangla', '<p>Vat Bangla s</p>', 'vat-bangla', 'Publish', '2024-07-11 00:57:03', '2024-07-14 04:16:09'),
(8, NULL, 8, 'app2', 'admin/images/app/16252hrms.jpg', 'sadsadad', NULL, 'app2', 'Publish', '2024-07-11 04:52:54', '2024-07-13 23:27:19'),
(9, NULL, 9, 'dsasadsad', 'admin/images/app/13626hrms.jpg', 'dasda', NULL, 'dsasadsad', 'Draft', '2024-07-11 05:33:27', '2024-07-13 23:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `app_uploads`
--

CREATE TABLE `app_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `app_id` bigint(20) UNSIGNED DEFAULT NULL,
  `apk_version` varchar(255) DEFAULT NULL,
  `ios_version` varchar(255) DEFAULT NULL,
  `download` int(11) DEFAULT NULL,
  `apk` text DEFAULT NULL,
  `ios` text DEFAULT NULL,
  `apk_status` varchar(255) NOT NULL DEFAULT 'Draft',
  `ios_status` varchar(255) NOT NULL DEFAULT 'Draft',
  `status` varchar(255) NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_uploads`
--

INSERT INTO `app_uploads` (`id`, `user_id`, `company_id`, `app_id`, `apk_version`, `ios_version`, `download`, `apk`, `ios`, `apk_status`, `ios_status`, `status`, `created_at`, `updated_at`) VALUES
(23, 1, 8, 6, '0.1', NULL, NULL, 'admin/app/apk/7RN5g3ydW81JRxA/vat-bangla/RPL.apk', NULL, 'Publish', 'Draft', 'Publish', '2024-07-12 22:10:18', '2024-07-12 23:28:33'),
(24, 1, 8, 6, '0.2', '0.1', NULL, 'admin/app/apk/7RN5g3ydW81JRxA/vat-bangla/SRS SOFTWARE USER MANUAL new.pdf', 'admin/app/ios/7RN5g3ydW81JRxA/vat-bangla/RPL.apk', 'Publish', 'Publish', 'Publish', '2024-07-12 23:01:52', '2024-07-12 23:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('user@webnstech.com|127.0.0.1', 'i:2;', 1720686872),
('user@webnstech.com|127.0.0.1:timer', 'i:1720686872;', 1720686872);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `industry_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` text NOT NULL,
  `image` text DEFAULT NULL,
  `alt` text DEFAULT NULL,
  `company_slug` text NOT NULL,
  `company_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `industry_id`, `name`, `image`, `alt`, `company_slug`, `company_code`, `status`, `created_at`, `updated_at`) VALUES
(8, 1, 3, 'WEBNS Technology Ltd.', 'admin/images/company/18514hrms.jpg', 'WEBNS Technology Ltd', 'webns-technology-ltd', '7RN5g3ydW81JRxA', 'Publish', '2024-07-11 00:52:26', '2024-07-14 04:28:31'),
(9, 1, 3, 'dsfdsfsd', 'admin/images/company/11227hrms.jpg', 'dfdsfdsf', 'dsfdsfsd', 'ZYypIW7N9JkBBDg', 'Publish', '2024-07-11 01:06:39', '2024-07-14 04:28:40'),
(10, 1, 3, 'adasdsad', 'admin/images/company/10568WhatsApp Image 2024-06-10 at 11.42.38_9a7e8e43.jpg', 'dsadad', 'adasdsad', 'GVJKAjAYRW94CC8', 'Publish', '2024-07-11 05:05:26', '2024-07-11 05:05:26'),
(11, 1, 3, 'asdada dadsad', 'admin/images/company/19803test-2.jpg', 'sadasdsa', 'asdada-dadsad', 'FsbEiTEjZBn6Hil', 'Publish', '2024-07-11 05:06:01', '2024-07-11 05:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

CREATE TABLE `industries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `industry_slug` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `industries`
--

INSERT INTO `industries` (`id`, `user_id`, `name`, `industry_slug`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'Pharmecy', 'pharmecy', 'Publish', '2024-07-09 02:20:50', '2024-07-09 02:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_08_110154_create_industries_table', 2),
(5, '2024_07_09_044354_create_companies_table', 3),
(6, '2024_07_09_055115_create_industries_companies_table', 3),
(7, '2024_07_09_091650_create_apps_table', 4),
(8, '2024_07_09_091718_create_companies_apps_table', 4),
(9, '2024_07_11_052922_create_app_uploads_table', 5),
(10, '2024_07_11_060625_create_apps_app_uploads_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lkWuMM16S7qeRQ6rVZ3Ig5Ket0we8kBFVXzo39bs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ3V6eExhblNYM1k2Wms3OFNZenJUMkpCVnhqSU1ybWdhOVNIVzVrSSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIzMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FwcC11cGxvYWQvZXlKcGRpSTZJa0Y0VXpWWmJHbGFlRXhHTDFGM1lpdE1OVVZ6UTJjOVBTSXNJblpoYkhWbElqb2lNMUJHTTFneFJuSmpkV3A1ZW5KbVNYTm1aekZ0VVQwOUlpd2liV0ZqSWpvaU9USmxNREZtTUdNM1pqa3labVJrTnpNNE1tSTVOalpqTVRJM056RTBNelV4TURsaFlqbGlaRGc0TUdNell6Z3dOekV6TXpnNU5ETTJORFF4TUdFNU1TSXNJblJoWnlJNklpSjkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1720953054);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `number` bigint(20) DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `photo` longtext DEFAULT NULL,
  `permission` longtext DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `employee_id`, `department`, `designation`, `photo`, `permission`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@webnstech.net', 1614647325, 'WT0001', 'Business Development', 'Junior Executive', 'admin/save_images/profile_photo/Schedule-demo-icon.png', '{\"users_all\":{\"employ_all\":{\"employ_manage\":\"employ_manage\",\"employ_detail\":\"employ_detail\",\"employ_create\":\"employ_create\",\"employ_edit\":\"employ_edit\",\"employ_permission\":\"employ_permission\",\"employ_password\":\"employ_password\",\"employ_delete\":\"employ_delete\"}},\"user_profile\":{\"profile_setting\":\"profile_setting\",\"profile_edit\":\"profile_edit\",\"profile_email\":\"profile_email\",\"profile_phone\":\"profile_phone\",\"employee_id\":\"employee_id\",\"profile_department\":\"profile_department\",\"profile_designation\":\"profile_designation\"},\"industry\":{\"industry_manage\":\"industry_manage\",\"industry_detail\":\"industry_detail\",\"industry_create\":\"industry_create\",\"industry_edit\":\"industry_edit\",\"industry_status\":\"industry_status\",\"industry_delete\":\"industry_delete\"},\"company\":{\"company_manage\":\"company_manage\",\"company_detail\":\"company_detail\",\"company_create\":\"company_create\",\"company_edit\":\"company_edit\",\"company_status\":\"company_status\",\"company_delete\":\"company_delete\"},\"app\":{\"app_manage\":\"app_manage\",\"app_detail\":\"app_detail\",\"app_create\":\"app_create\",\"app_edit\":\"app_edit\",\"app_status\":\"app_status\",\"app_delete\":\"app_delete\"},\"app_upload\":{\"app_upload_manage\":\"app_upload_manage\",\"app_upload_detail\":\"app_upload_detail\",\"app_upload_create\":\"app_upload_create\",\"app_upload_edit\":\"app_upload_edit\",\"apk_app_download\":\"apk_app_download\",\"ios_app_download\":\"ios_app_download\",\"apk_app_status\":\"apk_app_status\",\"ios_app_status\":\"ios_app_status\",\"app_upload_status\":\"app_upload_status\",\"app_upload_delete\":\"app_upload_delete\"}}', NULL, '$2y$12$./L61UgDJ2SDPFIwYha7Ruz2/.oIUHEpZkRBBAsawls9JA4z5bXYy', NULL, '2024-07-07 23:01:38', '2024-07-14 04:29:37'),
(3, 'user', 'user@webnstech.net', 243324234, 'sdsadsad', 'sdsd', 'asdasdad', NULL, '{\"users_all\":{\"employ_all\":{\"employ_manage\":\"employ_manage\",\"employ_detail\":\"employ_detail\",\"employ_create\":\"employ_create\",\"employ_edit\":\"employ_edit\",\"employ_permission\":\"employ_permission\",\"employ_password\":\"employ_password\",\"employ_delete\":\"employ_delete\"}},\"user_profile\":{\"profile_setting\":\"profile_setting\",\"profile_edit\":\"profile_edit\",\"profile_email\":\"profile_email\",\"profile_phone\":\"profile_phone\",\"employee_id\":\"employee_id\",\"profile_department\":\"profile_department\",\"profile_designation\":\"profile_designation\"},\"industry\":{\"industry_manage\":\"industry_manage\",\"industry_detail\":\"industry_detail\",\"industry_create\":\"industry_create\",\"industry_edit\":\"industry_edit\",\"industry_status\":\"industry_status\",\"industry_delete\":\"industry_delete\"},\"company\":{\"company_manage\":\"company_manage\",\"company_detail\":\"company_detail\",\"company_create\":\"company_create\",\"company_edit\":\"company_edit\",\"company_status\":\"company_status\",\"company_delete\":\"company_delete\"},\"app\":{\"app_manage\":\"app_manage\",\"app_detail\":\"app_detail\",\"app_create\":\"app_create\",\"app_edit\":\"app_edit\",\"app_status\":\"app_status\",\"app_delete\":\"app_delete\"},\"app_upload\":{\"app_upload_manage\":\"app_upload_manage\",\"app_upload_detail\":\"app_upload_detail\",\"app_upload_create\":\"app_upload_create\",\"app_upload_edit\":\"app_upload_edit\",\"apk_app_download\":\"apk_app_download\",\"ios_app_download\":\"ios_app_download\",\"apk_app_status\":\"apk_app_status\",\"ios_app_status\":\"ios_app_status\",\"app_upload_status\":\"app_upload_status\",\"app_upload_delete\":\"app_upload_delete\"}}', NULL, '$2y$12$gDVQO1e/ZxqHVou6tYFDb.dcuQU3eQYEWKbsbuSNu8.rhZR472cqC', NULL, '2024-07-08 02:38:32', '2024-07-11 02:39:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apps_name_unique` (`name`);

--
-- Indexes for table `app_uploads`
--
ALTER TABLE `app_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_name_unique` (`name`) USING HASH,
  ADD UNIQUE KEY `companies_company_slug_unique` (`company_slug`) USING HASH;

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `industries`
--
ALTER TABLE `industries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `industries_name_unique` (`name`),
  ADD UNIQUE KEY `industries_industry_slug_unique` (`industry_slug`) USING HASH;

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `app_uploads`
--
ALTER TABLE `app_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industries`
--
ALTER TABLE `industries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
