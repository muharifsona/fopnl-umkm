-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2025 at 10:51 AM
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
-- Database: `fopnl_umkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity` varchar(255) NOT NULL,
  `entity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `performed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `entity`, `entity_id`, `action`, `performed_by`, `details`, `created_at`) VALUES
(1, 'validation_requests', 12, 'submit', 4, 'Produk \"Sambal Teri Pete\" diajukan untuk validasi oleh pengguna \"Pempek Dos Mama Rafa\"', '2025-11-20 19:41:26'),
(2, 'validation_requests', 12, 'approve', 5, 'Admin \"John The Regulator\" menyetujui produk \"Sambal Teri Pete\" (status sebelumnya: submitted). Catatan: Ok', '2025-11-20 19:48:46'),
(3, 'validation_requests', 13, 'submit', 4, 'Produk \"Pempek Palembang\" diajukan untuk validasi oleh pengguna \"Pempek Dos Mama Rafa\"', '2025-11-22 16:41:30'),
(4, 'validation_requests', 14, 'submit', 4, 'Produk \"Soto Betawi\" diajukan untuk validasi oleh pengguna \"Pempek Dos Mama Rafa\"', '2025-11-22 16:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `default_measure` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `default_measure`, `notes`, `created_at`, `updated_at`) VALUES
(110, 'Bawang Putih', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(111, 'Santan Kental', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(112, 'Daging Ayam', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(113, 'Tempe', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(114, 'Daging Sapi', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(115, 'Ikan Tongkol', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(116, 'Daun Jeruk', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(117, 'Lengkuas', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(118, 'Tahu', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(119, 'Cabai Merah', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(120, 'Gula Merah', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(121, 'Terasi', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(122, 'Kecap Manis', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(123, 'Beras Putih', 'g', NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_nutritions`
--

CREATE TABLE `ingredient_nutritions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED NOT NULL,
  `per_100g_energy_kcal` decimal(10,2) DEFAULT NULL,
  `per_100g_protein_g` decimal(10,2) DEFAULT NULL,
  `per_100g_fat_g` decimal(10,2) DEFAULT NULL,
  `per_100g_saturated_fat_g` decimal(8,2) DEFAULT NULL,
  `per_100g_carbs_g` decimal(10,2) DEFAULT NULL,
  `per_100g_sugar_g` decimal(10,2) DEFAULT NULL,
  `sodium_mg` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredient_nutritions`
--

INSERT INTO `ingredient_nutritions` (`id`, `ingredient_id`, `per_100g_energy_kcal`, `per_100g_protein_g`, `per_100g_fat_g`, `per_100g_saturated_fat_g`, `per_100g_carbs_g`, `per_100g_sugar_g`, `sodium_mg`, `created_at`, `updated_at`) VALUES
(1, 110, 149.00, 6.40, 0.50, 0.25, 33.00, 1.00, 17.00, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(2, 111, 230.00, 2.30, 24.00, 7.53, 6.00, 3.00, 13.00, '2025-11-20 17:50:19', '2025-11-20 17:50:20'),
(3, 112, 239.00, 27.00, 14.00, 8.51, 0.00, 0.00, 80.00, '2025-11-20 17:50:19', '2025-11-20 17:50:20'),
(4, 113, 193.00, 19.00, 11.00, 4.48, 9.00, 0.70, 9.00, '2025-11-20 17:50:19', '2025-11-20 17:50:20'),
(5, 114, 250.00, 26.00, 15.00, 5.06, 0.00, 0.00, 72.00, '2025-11-20 17:50:19', '2025-11-20 17:50:20'),
(6, 115, 150.00, 23.00, 5.00, 3.42, 0.00, 0.00, 70.00, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(7, 116, 37.00, 2.00, 0.60, 0.18, 7.30, 0.20, 5.00, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(8, 117, 71.00, 1.00, 0.80, 0.50, 15.00, 2.00, 10.00, '2025-11-20 17:50:19', '2025-11-20 17:50:20'),
(9, 118, 76.00, 8.00, 4.80, 2.22, 1.90, 0.50, 7.00, '2025-11-20 17:50:19', '2025-11-20 17:50:20'),
(10, 119, 40.00, 1.90, 0.40, 0.19, 8.80, 5.30, 7.00, '2025-11-20 17:50:19', '2025-11-20 17:50:20'),
(11, 120, 380.00, 0.40, 0.00, 0.00, 95.00, 95.00, 20.00, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(12, 121, 90.00, 17.00, 2.00, 1.34, 3.00, 0.00, 1500.00, '2025-11-20 17:50:19', '2025-11-20 17:50:20'),
(13, 122, 150.00, 2.00, 0.00, 0.00, 35.00, 32.00, 700.00, '2025-11-20 17:50:19', '2025-11-20 17:50:20'),
(14, 123, 365.00, 7.00, 0.50, 0.26, 80.00, 0.20, 5.00, '2025-11-20 17:50:19', '2025-11-20 17:50:20');

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
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `label_type` enum('TrafficLight','NutriScore','QR') DEFAULT NULL,
  `label_image_path` varchar(255) DEFAULT NULL,
  `qr_code_value` varchar(255) DEFAULT NULL,
  `generated_at` timestamp NULL DEFAULT NULL,
  `version` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_10_09_000001_create_users_table.', 1),
(4, '2025_10_09_000002_create_ingredients_table', 1),
(5, '2025_10_09_000003_create_products_table', 1),
(6, '2025_10_09_000004_create_ingredient_nutritions_table', 1),
(7, '2025_10_09_000005_create_product_ingredients_table', 1),
(8, '2025_10_09_000006_create_nutrition_summaries_table', 1),
(9, '2025_10_09_000007_create_labels_table', 1),
(10, '2025_10_09_000008_create_validation_requests_table', 1),
(11, '2025_10_09_000009_create_audit_logs_table', 1),
(12, '2025_10_09_091933_add_role_to_users_table', 1),
(13, '2025_10_10_025252_alter_products_status_enum', 1),
(14, '2025_11_20_210115_add_saturated_fat_to_nutrition_summaries_table', 2),
(15, '2025_11_20_210528_add_saturated_fat_to_ingredient_nutritions_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_summaries`
--

CREATE TABLE `nutrition_summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `per_serving_energy_kcal` decimal(10,2) DEFAULT NULL,
  `per_serving_protein_g` decimal(10,2) DEFAULT NULL,
  `per_serving_fat_g` decimal(10,2) DEFAULT NULL,
  `per_serving_saturated_fat_g` decimal(8,2) DEFAULT NULL,
  `per_serving_carbs_g` decimal(10,2) DEFAULT NULL,
  `per_serving_sugar_g` decimal(10,2) DEFAULT NULL,
  `per_serving_sodium_mg` decimal(10,2) DEFAULT NULL,
  `calculated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nutrition_summaries`
--

INSERT INTO `nutrition_summaries` (`id`, `product_id`, `per_serving_energy_kcal`, `per_serving_protein_g`, `per_serving_fat_g`, `per_serving_saturated_fat_g`, `per_serving_carbs_g`, `per_serving_sugar_g`, `per_serving_sodium_mg`, `calculated_at`, `created_at`, `updated_at`) VALUES
(21, 285, 644.29, 10.03, 23.81, 7.81, 98.94, 4.90, 26.57, '2025-11-22 17:27:32', '2025-11-20 18:50:29', '2025-11-22 17:27:32'),
(22, 257, 328.05, 23.22, 4.49, 3.05, 44.70, 21.17, 524.25, '2025-11-22 16:41:30', '2025-11-22 16:34:58', '2025-11-22 16:41:30'),
(23, 258, 864.44, 48.44, 27.40, 12.87, 108.92, 42.41, 637.65, '2025-11-22 16:49:45', '2025-11-22 16:47:52', '2025-11-22 16:49:45');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `net_weight` decimal(10,2) DEFAULT NULL,
  `serving_size` varchar(255) DEFAULT NULL,
  `status` enum('draft','submitted','approved','rejected') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `description`, `net_weight`, `serving_size`, `status`, `created_at`, `updated_at`) VALUES
(236, 2, 'Pecel Madiun', 'Occaecati perferendis dolor rerum incidunt similique.', 300.00, '40 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(237, 2, 'Kue Cubit', 'Magni sit voluptas vel cumque sunt incidunt.', 300.00, '34 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(238, 4, 'Rendang Padang', 'Aliquid repellendus maiores libero optio eaque nulla rerum labore vel saepe.', 300.00, '28 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(239, 4, 'Lemper Ayam', 'Quae itaque id consequatur perspiciatis illo quae minus doloribus veritatis.', 250.00, '49 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(240, 4, 'Kue Lapis', 'Quas provident fuga quod assumenda nihil asperiores et.', 300.00, '33 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(241, 4, 'Ikan Bakar Jimbaran', 'Qui rem illo alias harum quaerat.', 200.00, '40 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(242, 4, 'Tahu Gejrot', 'Deleniti at quam distinctio laudantium amet molestias ab consequatur ab eligendi et.', 150.00, '38 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(243, 4, 'Sambal Ikan Roa', 'Et asperiores quasi dolorum doloribus modi suscipit.', 300.00, '28 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(244, 4, 'Serabi Bandung', 'Ad architecto veritatis quia voluptates aspernatur aut quas quae aperiam blanditiis minus nesciunt.', 250.00, '47 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(245, 4, 'Nasi Campur Bali', 'Et nihil corporis quibusdam numquam rerum laborum officia.', 250.00, '37 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(246, 4, 'Bakso Malang', 'Eum inventore quae officiis nam numquam asperiores facilis reprehenderit.', 300.00, '27 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(247, 4, 'Martabak Manis', 'Eveniet provident laboriosam fugit aliquam quibusdam et ratione voluptatibus ipsum.', 300.00, '39 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(248, 4, 'Bubur Ayam Cianjur', 'Reprehenderit dolorem at deserunt earum iure veniam neque modi consequatur.', 250.00, '35 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(249, 4, 'Bebek Goreng Madura', 'Ducimus adipisci quam quasi porro quae aperiam esse eveniet.', 250.00, '46 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(250, 4, 'Mie Aceh', 'Esse eos sapiente velit beatae sequi.', 250.00, '41 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(251, 2, 'Asinan Bogor', 'Quibusdam consectetur suscipit labore beatae nobis.', 150.00, '27 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(252, 2, 'Nasi Liwet Sunda', 'Quibusdam enim eius cum amet reiciendis omnis nam.', 250.00, '29 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(253, 4, 'Klepon', 'Dolorem magnam possimus sapiente consequatur est unde iusto numquam enim tenetur.', 200.00, '41 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(254, 4, 'Kue Lumpur Surabaya', 'Excepturi eaque quod voluptatibus at vero animi rem exercitationem amet reprehenderit dolores tempore.', 300.00, '37 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(255, 4, 'Ayam Goreng Kalasan', 'Quos repellendus fugiat tempore officiis non sequi odit aliquid.', 150.00, '35 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(256, 2, 'Putu Ayu', 'Officiis sit commodi dignissimos vero atque ad.', 150.00, '33 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(257, 4, 'Pempek Palembang', 'Dicta modi consectetur ipsam officia eius quibusdam expedita doloremque vitae magnam eligendi dolore.', 250.00, '42 gram', 'submitted', '2025-11-20 17:50:19', '2025-11-22 16:41:30'),
(258, 4, 'Soto Betawi', 'Dolorum molestias necessitatibus fugit repellat vitae animi tempora necessitatibus sapiente unde.', 250.00, '31 gram', 'submitted', '2025-11-20 17:50:19', '2025-11-22 16:49:45'),
(259, 2, 'Soto Medan', 'Earum odio et porro est quaerat at.', 200.00, '29 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(260, 2, 'Pepes Ikan', 'Eligendi vel ipsa asperiores ipsa expedita vero.', 200.00, '46 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(261, 4, 'Tempe Mendoan', 'Nisi odit voluptate occaecati ducimus reiciendis dolor repellat esse voluptates.', 250.00, '45 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(262, 4, 'Ayam Betutu Bali', 'Aliquam quam voluptas dicta distinctio aliquam corrupti voluptas voluptas magni quis.', 200.00, '40 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(263, 4, 'Rawon Surabaya', 'Similique recusandae pariatur eligendi officiis ad vero quam quibusdam voluptas assumenda.', 150.00, '32 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(264, 4, 'Opor Ayam', 'Rerum accusamus unde excepturi ipsum culpa.', 150.00, '42 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(265, 4, 'Sayur Lodeh', 'Delectus voluptatibus adipisci eligendi eum quae voluptatem et nisi ea amet eaque.', 200.00, '41 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(266, 2, 'Rica-Rica Manado', 'Saepe quia quo eligendi nihil beatae commodi ea rem pariatur.', 150.00, '34 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(267, 4, 'Sate Lilit Bali', 'Assumenda aliquam reiciendis nisi dolor eligendi.', 150.00, '25 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(268, 4, 'Nasi Goreng Jawa', 'Tenetur quisquam fugit tempore ipsam officiis mollitia eum optio voluptatibus quis.', 250.00, '40 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(269, 4, 'Lumpia Semarang', 'Suscipit voluptates occaecati possimus pariatur delectus dicta ullam expedita.', 150.00, '48 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(270, 4, 'Nasi Uduk Betawi', 'Nihil cum esse inventore natus pariatur dolor reiciendis quibusdam quod.', 150.00, '45 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(271, 2, 'Rawon Setan', 'Ad magni numquam placeat quibusdam ratione distinctio laborum minima excepturi quaerat minus.', 150.00, '39 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(272, 4, 'Gudeg Jogja', 'Perspiciatis tempore alias fugit inventore temporibus dolor maiores.', 250.00, '41 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(273, 2, 'Lemper Ayam', 'Iure ducimus rerum omnis occaecati optio ab.', 150.00, '37 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(274, 2, 'Ayam Woku', 'Id quidem dolorum sapiente a quo nulla.', 150.00, '25 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(275, 2, 'Gado-Gado Jakarta', 'Aspernatur deserunt distinctio rem unde magni rerum voluptate.', 300.00, '25 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(276, 2, 'Ikan Asin Sambal Matah', 'Animi id accusamus officiis consectetur aliquid est odio id velit mollitia incidunt suscipit.', 150.00, '37 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(277, 4, 'Sate Ayam Madura', 'Vitae mollitia voluptas quaerat molestias illum nulla tempora modi possimus fuga.', 150.00, '28 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(278, 2, 'Keripik Pisang Lampung', 'Delectus illo voluptas accusantium laudantium veritatis amet nisi.', 300.00, '43 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(279, 2, 'Es Cendol', 'Labore earum odio ipsum laboriosam cupiditate ea aperiam magnam autem ad similique pariatur.', 300.00, '29 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(280, 4, 'Mendoan Banyumas', 'Repellendus est libero quas dolor quia placeat iste illum similique optio.', 300.00, '48 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(281, 4, 'Lontong Balap Surabaya', 'Ipsa tempora adipisci nemo quam omnis vero fugit repudiandae tenetur ad.', 250.00, '45 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(282, 4, 'Soto Kudus', 'Corrupti vitae excepturi amet sapiente culpa amet sit magnam fugit id modi dolores.', 300.00, '25 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(283, 2, 'Onde-Onde', 'Itaque iste delectus maiores aut odit rerum dicta modi eum.', 200.00, '25 gram', 'draft', '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(284, 2, 'Bakpia Pathok', 'Provident officia cumque repellendus assumenda ad distinctio.', 200.00, '26 gram', 'draft', '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(285, 4, 'Sambal Teri Pete', 'Perferendis voluptates officiis et consequuntur praesentium pariatur modi unde.', 200.00, '26 gram', 'approved', '2025-11-20 17:50:20', '2025-11-20 19:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_ingredients`
--

CREATE TABLE `product_ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED NOT NULL,
  `quantity_g` decimal(10,2) NOT NULL,
  `order_index` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ingredients`
--

INSERT INTO `product_ingredients` (`id`, `product_id`, `ingredient_id`, `quantity_g`, `order_index`, `notes`, `created_at`, `updated_at`) VALUES
(1, 236, 110, 63.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(2, 236, 111, 31.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(3, 236, 112, 84.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(4, 237, 113, 84.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(5, 237, 114, 25.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(6, 237, 112, 99.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(7, 237, 115, 23.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(8, 238, 111, 62.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(9, 238, 112, 71.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(10, 238, 113, 88.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(11, 238, 110, 76.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(12, 238, 116, 70.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(13, 238, 117, 16.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(14, 239, 118, 81.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(15, 239, 114, 10.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(16, 239, 110, 62.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(17, 239, 113, 21.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(18, 239, 119, 77.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(19, 239, 120, 54.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(20, 240, 110, 93.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(21, 240, 121, 55.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(22, 240, 111, 83.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(23, 240, 116, 37.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(24, 241, 117, 63.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(25, 241, 120, 71.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(26, 241, 121, 28.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(27, 242, 121, 41.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(28, 242, 111, 41.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(29, 242, 117, 73.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(30, 243, 114, 49.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(31, 243, 115, 68.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(32, 243, 118, 52.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(33, 243, 119, 54.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(34, 243, 112, 39.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(35, 244, 114, 51.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(36, 244, 116, 51.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(37, 244, 121, 87.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(38, 244, 111, 100.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(39, 244, 113, 50.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(40, 244, 122, 20.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(41, 245, 112, 85.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(42, 245, 114, 74.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(43, 245, 116, 85.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(44, 246, 122, 87.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(45, 246, 115, 44.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(46, 246, 119, 66.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(47, 246, 112, 62.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(48, 246, 113, 74.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(49, 246, 116, 87.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(50, 247, 111, 62.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(51, 247, 120, 79.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(52, 247, 116, 31.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(53, 248, 115, 95.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(54, 248, 116, 95.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(55, 248, 122, 86.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(56, 248, 120, 73.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(57, 248, 117, 38.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(58, 249, 114, 26.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(59, 249, 112, 58.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(60, 249, 118, 34.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(61, 249, 123, 27.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(62, 249, 115, 31.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(63, 249, 110, 98.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(64, 250, 115, 95.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(65, 250, 113, 90.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(66, 250, 123, 52.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(67, 250, 114, 25.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(68, 250, 118, 38.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(69, 251, 115, 95.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(70, 251, 116, 27.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(71, 251, 121, 70.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(72, 252, 123, 93.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(73, 252, 112, 53.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(74, 252, 117, 15.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(75, 252, 120, 13.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(76, 252, 114, 73.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(77, 253, 111, 50.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(78, 253, 118, 69.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(79, 253, 116, 82.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(80, 253, 122, 12.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(81, 253, 115, 83.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(82, 254, 118, 62.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(83, 254, 121, 28.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(84, 254, 112, 14.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(85, 254, 123, 13.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(86, 255, 120, 76.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(87, 255, 111, 39.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(88, 255, 118, 68.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(89, 255, 112, 51.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(90, 255, 116, 64.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(91, 255, 117, 27.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(92, 256, 114, 83.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(93, 256, 115, 33.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(94, 256, 122, 92.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(95, 257, 122, 66.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(96, 257, 115, 87.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(97, 257, 123, 27.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(98, 258, 113, 86.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(99, 258, 112, 74.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(100, 258, 123, 72.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(101, 258, 111, 27.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(102, 258, 121, 37.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(103, 258, 120, 43.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(104, 259, 115, 20.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(105, 259, 114, 95.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(106, 259, 111, 85.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(107, 259, 116, 17.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(108, 259, 119, 22.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(109, 259, 121, 94.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(110, 260, 113, 71.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(111, 260, 118, 38.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(112, 260, 110, 25.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(113, 261, 116, 33.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(114, 261, 112, 92.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(115, 261, 121, 20.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(116, 261, 122, 79.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(117, 261, 115, 27.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(118, 262, 112, 43.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(119, 262, 119, 42.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(120, 262, 118, 14.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(121, 262, 111, 81.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(122, 262, 117, 45.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(123, 262, 120, 49.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(124, 263, 116, 17.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(125, 263, 117, 42.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(126, 263, 121, 53.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(127, 263, 110, 74.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(128, 263, 113, 16.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(129, 263, 114, 36.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(130, 264, 110, 44.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(131, 264, 112, 20.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(132, 264, 121, 23.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(133, 264, 114, 95.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(134, 265, 118, 38.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(135, 265, 119, 71.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(136, 265, 112, 37.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(137, 266, 110, 51.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(138, 266, 117, 90.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(139, 266, 114, 91.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(140, 267, 121, 11.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(141, 267, 112, 87.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(142, 267, 119, 82.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(143, 267, 120, 28.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(144, 267, 115, 44.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(145, 268, 123, 19.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(146, 268, 116, 57.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(147, 268, 120, 68.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(148, 268, 117, 85.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(149, 269, 123, 92.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(150, 269, 119, 68.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(151, 269, 110, 97.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(152, 269, 121, 57.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(153, 269, 118, 33.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(154, 270, 110, 85.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(155, 270, 116, 26.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(156, 270, 117, 99.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(157, 270, 119, 61.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(158, 270, 113, 20.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(159, 270, 118, 58.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(160, 271, 112, 79.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(161, 271, 113, 56.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(162, 271, 116, 56.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(163, 271, 117, 86.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(164, 271, 111, 63.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(165, 272, 120, 49.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(166, 272, 123, 85.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(167, 272, 117, 28.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(168, 272, 114, 65.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(169, 272, 113, 68.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(170, 272, 115, 37.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(171, 273, 115, 39.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(172, 273, 120, 21.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(173, 273, 122, 67.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(174, 273, 114, 70.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(175, 273, 110, 66.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(176, 274, 113, 51.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(177, 274, 121, 17.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(178, 274, 111, 72.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(179, 274, 112, 47.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(180, 274, 123, 73.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(181, 275, 117, 26.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(182, 275, 121, 80.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(183, 275, 115, 89.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(184, 275, 123, 97.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(185, 276, 123, 17.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(186, 276, 122, 12.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(187, 276, 121, 88.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(188, 276, 118, 62.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(189, 277, 119, 65.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(190, 277, 115, 88.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(191, 277, 110, 43.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(192, 277, 113, 11.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(193, 277, 112, 31.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(194, 278, 116, 24.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(195, 278, 113, 29.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(196, 278, 122, 62.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(197, 278, 118, 41.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(198, 278, 123, 20.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(199, 278, 111, 100.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(200, 279, 116, 10.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(201, 279, 121, 15.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(202, 279, 117, 82.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(203, 279, 118, 60.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(204, 279, 112, 82.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(205, 280, 116, 59.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(206, 280, 118, 29.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(207, 280, 119, 15.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(208, 280, 123, 41.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(209, 280, 117, 37.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(210, 280, 110, 39.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(211, 281, 113, 43.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(212, 281, 112, 29.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(213, 281, 117, 26.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(214, 281, 120, 81.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(215, 281, 115, 90.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(216, 282, 116, 90.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(217, 282, 113, 60.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(218, 282, 121, 47.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(219, 282, 122, 83.00, 0, NULL, '2025-11-20 17:50:19', '2025-11-20 17:50:19'),
(220, 283, 121, 30.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(221, 283, 122, 68.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(222, 283, 113, 89.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(223, 283, 118, 20.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(224, 283, 114, 69.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(225, 283, 112, 38.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(226, 284, 119, 55.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(227, 284, 114, 50.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(228, 284, 118, 93.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(229, 285, 111, 94.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(230, 285, 123, 99.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20'),
(231, 285, 117, 94.00, 0, NULL, '2025-11-20 17:50:20', '2025-11-20 17:50:20');

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
('cuB37v3SLTZt8l2mbSnkL59BqDvT8Y9XvmckhsAN', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3luSG9jNmpnOW5Eb3lyZjJvaGVUalk0OEVPS2x4VG9oYWVsTDR3eiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91bWttL3Byb2R1Y3RzLzI4NS9udXRyaXRpb24iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1763861252),
('pBu0vJbZcWTwWLUTy0mUSX0MhL4lVX9bItI3Cphq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDE4ak15NHhxNWZUMjg2clVoTjh0eWtHWHJEZlJYNWt6Mnc1M3lJUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1763888780);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'UMKM',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@fopnl.test', NULL, '$2y$12$xh9pk3b8D0tak/ofcchAY.h.Pv4yNu9e43x8t6kmLdzHI6u1m3B9a', 'Admin', NULL, '2025-10-10 21:42:08', '2025-10-12 17:37:57'),
(2, 'Maju Jaya Kuliner', 'testumkm@mail.test', NULL, '$2y$12$ub0uiEstNbcmv7/1PF0c5u7VgpJjNj9ECEznQU5pgQCeTbXVC42Xq', 'UMKM', NULL, '2025-10-10 21:45:42', '2025-10-10 21:46:28'),
(4, 'Pempek Dos Mama Rafa', 'mamarafa@mail.test', NULL, '$2y$12$K6H8OS/.OSlEP1NYzvotAOura4fm6ACFoWW4uxM22ZGyqSvLPVv32', 'UMKM', NULL, '2025-10-11 14:38:55', '2025-10-11 14:38:55'),
(5, 'John The Regulator', 'johntheregulator@fopnl.test', NULL, '$2y$12$xh9pk3b8D0tak/ofcchAY.h.Pv4yNu9e43x8t6kmLdzHI6u1m3B9a', 'Regulator', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `validation_requests`
--

CREATE TABLE `validation_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `submitted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_admin` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('submitted','approved','rejected') NOT NULL DEFAULT 'submitted',
  `notes` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `validation_requests`
--

INSERT INTO `validation_requests` (`id`, `product_id`, `submitted_by`, `assigned_admin`, `status`, `notes`, `submitted_at`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(12, 285, 4, 5, 'approved', 'Ok', '2025-11-20 19:41:26', '2025-11-20 19:48:46', '2025-11-20 19:41:26', '2025-11-20 19:48:46'),
(13, 257, 4, NULL, 'submitted', NULL, '2025-11-22 16:41:30', NULL, '2025-11-22 16:41:30', '2025-11-22 16:41:30'),
(14, 258, 4, NULL, 'submitted', NULL, '2025-11-22 16:49:45', NULL, '2025-11-22 16:49:45', '2025-11-22 16:49:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_performed_by_foreign` (`performed_by`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient_nutritions`
--
ALTER TABLE `ingredient_nutritions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredient_nutritions_ingredient_id_foreign` (`ingredient_id`);

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
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labels_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_summaries`
--
ALTER TABLE `nutrition_summaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nutrition_summaries_product_id_unique` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ingredients_product_id_foreign` (`product_id`),
  ADD KEY `product_ingredients_ingredient_id_foreign` (`ingredient_id`);

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
-- Indexes for table `validation_requests`
--
ALTER TABLE `validation_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `validation_requests_product_id_foreign` (`product_id`),
  ADD KEY `validation_requests_submitted_by_foreign` (`submitted_by`),
  ADD KEY `validation_requests_assigned_admin_foreign` (`assigned_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `ingredient_nutritions`
--
ALTER TABLE `ingredient_nutritions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `nutrition_summaries`
--
ALTER TABLE `nutrition_summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `validation_requests`
--
ALTER TABLE `validation_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_performed_by_foreign` FOREIGN KEY (`performed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ingredient_nutritions`
--
ALTER TABLE `ingredient_nutritions`
  ADD CONSTRAINT `ingredient_nutritions_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `labels`
--
ALTER TABLE `labels`
  ADD CONSTRAINT `labels_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nutrition_summaries`
--
ALTER TABLE `nutrition_summaries`
  ADD CONSTRAINT `nutrition_summaries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD CONSTRAINT `product_ingredients_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `product_ingredients_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `validation_requests`
--
ALTER TABLE `validation_requests`
  ADD CONSTRAINT `validation_requests_assigned_admin_foreign` FOREIGN KEY (`assigned_admin`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `validation_requests_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `validation_requests_submitted_by_foreign` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
