-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2025 at 08:28 AM
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
(1, 'products', 34, 'store', 4, 'Menambahkan produk baru: tes lagi', '2025-10-12 06:08:25'),
(2, 'products', 33, 'destroy', 4, 'Menghapus produk: tes lagi', '2025-10-12 06:08:31'),
(3, 'product_ingredients', 127, 'create', 4, 'Menambahkan bahan \"Cabai Merah\" (200.0 g) ke produk \"tes lagi\"', '2025-10-12 06:39:06'),
(4, 'product_ingredients', 127, 'delete', 4, 'Menghapus bahan \"Cabai Merah\" (200.0 g) dari produk \"tes lagi\"', '2025-10-12 06:41:17'),
(5, 'product_ingredients', 128, 'create', 4, 'Menambahkan bahan \"Singkong\" (100.0 g) ke produk \"tes lagi\"', '2025-10-12 06:43:11'),
(6, 'validation_requests', 9, 'submit', 4, 'Produk \"tes lagi\" diajukan untuk validasi oleh pengguna \"Pempek Dos Mama Rafa\"', '2025-10-12 06:53:17'),
(7, 'validation_requests', 9, 'reject', 1, 'Admin \"Admin FOPNL\" menolak produk \"tes lagi\" (status sebelumnya: submitted). Catatan: OK Mantap', '2025-10-12 06:54:22'),
(8, 'validation_requests', 9, 'reject', 1, 'Admin \"Admin FOPNL\" menolak produk \"tes lagi\" (status sebelumnya: rejected). Catatan: No Good', '2025-10-12 06:54:33'),
(9, 'validation_requests', 10, 'submit', 4, 'Produk \"Roti Gandum Isi Cokelat\" diajukan untuk validasi oleh pengguna \"Pempek Dos Mama Rafa\"', '2025-10-12 07:47:25'),
(10, 'validation_requests', 10, 'approve', 5, 'Admin \"John The Regulator\" menyetujui produk \"Roti Gandum Isi Cokelat\" (status sebelumnya: submitted). Catatan: Ok', '2025-10-12 07:50:21'),
(11, 'products', 35, 'store', 2, 'Menambahkan produk baru: Nuget', '2025-10-14 21:41:55'),
(12, 'products', 35, 'update', 2, 'Mengedit produk: Nuget', '2025-10-14 21:42:10'),
(13, 'product_ingredients', 129, 'create', 2, 'Menambahkan bahan \"Daging Ayam Suwir\" (100.0 g) ke produk \"Nuget\"', '2025-10-14 21:43:02'),
(14, 'product_ingredients', 130, 'create', 2, 'Menambahkan bahan \"Daun Bayam\" (20.0 g) ke produk \"Nuget\"', '2025-10-14 21:43:11'),
(15, 'validation_requests', 11, 'submit', 2, 'Produk \"Nuget\" diajukan untuk validasi oleh pengguna \"Maju Jaya Kuliner\"', '2025-10-14 21:44:05'),
(16, 'validation_requests', 11, 'approve', 5, 'Admin \"John The Regulator\" menyetujui produk \"Nuget\" (status sebelumnya: submitted). Catatan: ok', '2025-10-14 22:03:11');

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
('fopnl-umkm-cache-testumkm@gmail.com|127.0.0.1', 'i:1;', 1760506817),
('fopnl-umkm-cache-testumkm@gmail.com|127.0.0.1:timer', 'i:1760506817;', 1760506817);

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
(1, 'Tepung Terigu', 'g', NULL, '2025-10-10 21:46:01', '2025-10-10 21:46:01'),
(2, 'Pisang Ambon', 'g', NULL, '2025-10-10 21:46:01', '2025-10-10 21:46:01'),
(3, 'Gula Pasir', 'g', NULL, '2025-10-10 21:46:01', '2025-10-10 21:46:01'),
(4, 'Telur Ayam', 'g', NULL, '2025-10-10 21:46:01', '2025-10-10 21:46:01'),
(5, 'Mentega', 'g', NULL, '2025-10-10 21:46:01', '2025-10-10 21:46:01'),
(6, 'Baking Powder', 'g', NULL, '2025-10-10 21:46:01', '2025-10-10 21:46:01'),
(7, 'Garam', 'g', NULL, '2025-10-10 21:46:01', '2025-10-10 21:46:01'),
(8, 'Tepung Terigu', 'g', NULL, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(9, 'Pisang Ambon', 'g', NULL, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(10, 'Gula Pasir', 'g', NULL, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(11, 'Telur Ayam', 'g', NULL, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(12, 'Mentega', 'g', NULL, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(13, 'Baking Powder', 'g', NULL, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(14, 'Garam', 'g', NULL, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(15, 'Cokelat Bubuk', 'g', NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(16, 'Tepung Panir', 'g', NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(17, 'Keju Parut', 'g', NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(18, 'Minyak Goreng', 'g', NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(19, 'Kentang Rebus', 'g', NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(20, 'Ragi Instan', 'g', NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(21, 'Ikan Roa Asap', 'g', NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(22, 'Cabai Merah', 'g', NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(23, 'Bawang Merah', 'g', NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(24, 'Singkong', 'g', NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(25, 'Tepung Terigu', 'g', NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(26, 'Pisang Ambon', 'g', NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(27, 'Gula Pasir', 'g', NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(28, 'Telur Ayam', 'g', NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(29, 'Mentega', 'g', NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(30, 'Baking Powder', 'g', NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(31, 'Garam', 'g', NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(32, 'Pisang', NULL, NULL, '2025-10-11 14:53:26', '2025-10-11 14:53:26'),
(33, 'Gula', NULL, NULL, '2025-10-11 14:55:34', '2025-10-11 14:55:34'),
(34, 'Telur', NULL, NULL, '2025-10-11 14:55:34', '2025-10-11 14:55:34'),
(35, 'Bumbu Balado', NULL, NULL, '2025-10-11 14:55:34', '2025-10-11 14:55:34'),
(36, 'Daun Bayam', 'g', NULL, '2025-10-11 16:59:15', '2025-10-11 16:59:15'),
(37, 'Tepung Beras', 'g', NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(38, 'Bawang Putih', 'g', NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(39, 'Tahu Putih', 'g', NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(40, 'Daging Ayam Suwir', 'g', NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(41, 'Kopi Bubuk Robusta', 'g', NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(42, 'Susu Cair', 'g', NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(43, 'Gula Aren', 'g', NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(44, 'Air', 'g', NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(45, 'Tempe', 'g', NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(46, 'Kecap Manis', 'g', NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(47, 'Gula Merah', 'g', NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(48, 'Jagung Pipil', 'g', NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(49, 'Cabai Bubuk', 'g', NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(50, 'Tepung Gandum', 'g', NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(51, 'Cokelat Pasta', 'g', NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(52, 'Kulit Sapi', 'g', NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(53, 'Daging Sapi', 'g', NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(54, 'Ekstrak Bayam', 'g', NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(55, 'Ekstrak Wortel', 'g', NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(57, 'Tepung Maizena', 'g', NULL, '2025-10-14 21:52:38', '2025-10-14 21:52:38');

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
  `per_100g_carbs_g` decimal(10,2) DEFAULT NULL,
  `per_100g_sugar_g` decimal(10,2) DEFAULT NULL,
  `sodium_mg` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredient_nutritions`
--

INSERT INTO `ingredient_nutritions` (`id`, `ingredient_id`, `per_100g_energy_kcal`, `per_100g_protein_g`, `per_100g_fat_g`, `per_100g_carbs_g`, `per_100g_sugar_g`, `sodium_mg`, `created_at`, `updated_at`) VALUES
(1, 1, 364.00, 10.00, 1.00, 76.00, 0.30, 2.00, '2025-10-10 21:46:01', '2025-10-11 01:29:28'),
(2, 2, 89.00, 1.10, 0.30, 23.00, 12.00, 1.00, '2025-10-10 21:46:01', '2025-10-11 01:29:28'),
(3, 3, 387.00, 0.00, 0.00, 100.00, 100.00, 1.00, '2025-10-10 21:46:01', '2025-10-11 01:29:28'),
(4, 4, 155.00, 13.00, 11.00, 1.10, 1.10, 124.00, '2025-10-10 21:46:01', '2025-10-11 01:29:28'),
(5, 5, 717.00, 0.90, 81.00, 0.10, 0.10, 11.00, '2025-10-10 21:46:01', '2025-10-11 01:29:28'),
(6, 6, 53.00, 0.00, 0.00, 28.00, 0.00, 11300.00, '2025-10-10 21:46:01', '2025-10-10 21:46:01'),
(7, 7, 0.00, 0.00, 0.00, 0.00, 0.00, 38758.00, '2025-10-10 21:46:01', '2025-10-11 01:29:28'),
(8, 8, 364.00, 10.00, 1.00, 76.00, 0.30, 2.00, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(9, 9, 90.00, 1.00, 0.30, 23.00, 12.00, 1.00, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(10, 10, 400.00, 0.00, 0.00, 100.00, 100.00, 0.00, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(11, 11, 155.00, 13.00, 11.00, 1.00, 0.50, 124.00, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(12, 12, 717.00, 0.90, 81.00, 0.10, 0.10, 11.00, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(13, 13, 53.00, 0.00, 0.00, 28.00, 0.00, 11300.00, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(14, 14, 0.00, 0.00, 0.00, 0.00, 0.00, 38758.00, '2025-10-10 21:46:28', '2025-10-10 21:46:28'),
(15, 15, 228.00, 20.00, 13.00, 58.00, 1.80, 21.00, '2025-10-10 21:51:33', '2025-10-11 01:29:28'),
(16, 16, 395.00, 13.00, 5.00, 70.00, 5.00, 800.00, '2025-10-10 21:51:33', '2025-10-11 01:29:28'),
(17, 17, 402.00, 25.00, 33.00, 1.30, 0.50, 620.00, '2025-10-10 21:51:33', '2025-10-11 01:29:28'),
(18, 18, 884.00, 0.00, 100.00, 0.00, 0.00, 0.00, '2025-10-10 21:51:33', '2025-10-11 01:29:28'),
(19, 19, 87.00, 1.90, 0.10, 20.00, 0.80, 6.00, '2025-10-10 21:51:33', '2025-10-11 01:29:28'),
(20, 20, 325.00, 40.00, 7.00, 41.00, 0.00, 51.00, '2025-10-10 21:51:33', '2025-10-11 01:29:28'),
(21, 21, 290.00, 58.00, 4.00, 0.00, 0.00, 210.00, '2025-10-10 21:51:33', '2025-10-11 01:29:28'),
(22, 22, 40.00, 2.00, 0.40, 9.00, 5.00, 7.00, '2025-10-10 21:51:33', '2025-10-11 01:29:28'),
(23, 23, 40.00, 1.10, 0.10, 9.00, 4.20, 4.00, '2025-10-10 21:51:33', '2025-10-11 01:29:28'),
(24, 24, 160.00, 1.40, 0.30, 38.00, 1.70, 14.00, '2025-10-10 21:51:33', '2025-10-11 01:29:28'),
(25, 25, 364.00, 10.00, 1.00, 76.00, 0.30, 2.00, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(26, 26, 90.00, 1.00, 0.30, 23.00, 12.00, 1.00, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(27, 27, 400.00, 0.00, 0.00, 100.00, 100.00, 0.00, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(28, 28, 155.00, 13.00, 11.00, 1.00, 0.50, 124.00, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(29, 29, 717.00, 0.90, 81.00, 0.10, 0.10, 11.00, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(30, 30, 53.00, 0.00, 0.00, 28.00, 0.00, 11300.00, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(31, 31, 0.00, 0.00, 0.00, 0.00, 0.00, 38758.00, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(32, 36, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(33, 37, 360.00, 6.50, 0.80, 80.00, 0.20, 1.00, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(34, 38, 149.00, 6.40, 0.50, 33.00, 1.00, 17.00, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(35, 39, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(36, 40, 239.00, 27.00, 14.00, 0.00, 0.00, 80.00, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(37, 41, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(38, 42, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(39, 43, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(40, 44, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(41, 45, 193.00, 20.30, 10.80, 8.80, 1.30, 9.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(42, 46, 120.00, 4.00, 0.00, 24.00, 16.00, 3000.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(43, 47, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(44, 48, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(45, 49, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(46, 50, 340.00, 12.00, 1.20, 72.00, 1.00, 3.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(47, 51, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(48, 52, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(49, 53, 250.00, 26.00, 15.00, 0.00, 0.00, 72.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(50, 54, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(51, 55, 100.00, 2.00, 2.00, 15.00, 3.00, 10.00, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(53, 57, 100.00, 1.70, 2.00, 6.10, 2.40, 1.60, '2025-10-14 21:52:38', '2025-10-14 21:53:03');

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
(13, '2025_10_10_025252_alter_products_status_enum', 1);

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

INSERT INTO `nutrition_summaries` (`id`, `product_id`, `per_serving_energy_kcal`, `per_serving_protein_g`, `per_serving_fat_g`, `per_serving_carbs_g`, `per_serving_sugar_g`, `per_serving_sodium_mg`, `calculated_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1366.10, 24.23, 70.70, 162.19, 101.63, 159.10, '2025-10-10 21:50:43', '2025-10-10 21:50:43', '2025-10-10 21:50:43'),
(8, 17, 182.00, 5.00, 0.50, 38.00, 0.15, 1.00, '2025-10-11 19:37:48', '2025-10-11 14:59:10', '2025-10-11 19:37:48'),
(9, 18, 505.20, 2.10, 30.45, 57.00, 2.55, 21.00, '2025-10-11 22:07:13', '2025-10-11 14:59:10', '2025-10-11 22:07:13'),
(10, 19, 551.90, 12.27, 27.70, 72.43, 0.63, 9.10, '2025-10-11 19:52:15', '2025-10-11 14:59:10', '2025-10-11 19:52:15'),
(11, 26, 239.90, 3.00, 6.86, 38.75, 12.59, 8.80, '2025-10-11 22:52:04', '2025-10-11 17:14:13', '2025-10-11 22:52:04'),
(12, 24, 245.00, 4.90, 4.90, 36.75, 7.35, 24.50, '2025-10-11 19:00:34', '2025-10-11 19:00:34', '2025-10-11 19:00:34'),
(13, 7, 602.50, 15.00, 23.90, 82.26, 13.75, 366.00, '2025-10-11 22:49:42', '2025-10-11 22:49:23', '2025-10-11 22:49:42'),
(14, 28, 503.60, 3.00, 43.00, 22.50, 4.50, 3890.80, '2025-10-11 22:54:03', '2025-10-11 22:52:12', '2025-10-11 22:54:03'),
(15, 29, 303.90, 27.74, 15.35, 10.35, 3.75, 2613.10, '2025-10-11 22:54:22', '2025-10-11 22:54:20', '2025-10-11 22:54:22'),
(16, 32, 250.00, 26.00, 15.00, 0.00, 0.00, 72.00, '2025-10-12 06:07:36', '2025-10-11 22:54:58', '2025-10-12 06:07:36'),
(18, 34, 160.00, 1.40, 0.30, 38.00, 1.70, 14.00, '2025-10-12 06:53:17', '2025-10-12 06:43:11', '2025-10-12 06:53:17'),
(19, 27, 535.35, 14.69, 10.25, 98.56, 21.91, 9.85, '2025-10-12 07:47:26', '2025-10-12 07:47:23', '2025-10-12 07:47:26'),
(20, 35, 259.00, 27.40, 14.40, 3.00, 0.60, 82.00, '2025-10-14 22:13:41', '2025-10-14 21:43:02', '2025-10-14 22:13:41');

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
(1, 2, 'Brownies Cokelat Panggang', 'Brownies lembut dengan aroma cokelat khas, tanpa bahan pengawet.', 250.00, '50 gram (±1 potong kecil)', 'draft', '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(7, 2, 'Nugget Pisang Keju', 'Camilan pisang goreng renyah berlapis keju, cocok disajikan hangat.', 200.00, '40 gram (2 potong)', 'submitted', '2025-10-11 01:29:28', '2025-10-11 22:49:41'),
(8, 2, 'Donat Kentang', 'Donat empuk berbahan dasar kentang tumbuk dan tepung terigu.', 300.00, '1 donat (60 gram)', 'draft', '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(9, 2, 'Sambal Ikan Roa', 'Sambal khas Manado dengan campuran ikan roa asap.', 150.00, '1 sendok makan (15 gram)', 'draft', '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(17, 2, 'Bolu Pisang Panggang', 'Kue lembut berbahan dasar pisang dan tepung terigu, dipanggang tanpa bahan pengawet.', 200.00, '50 gram (±¼ kue)', 'approved', '2025-10-11 14:59:10', '2025-10-11 23:03:24'),
(18, 2, 'Keripik Singkong Balado', 'Keripik singkong renyah dengan bumbu balado pedas manis.', 200.00, '25 gram (±1 genggam kecil)', 'submitted', '2025-10-11 14:59:10', '2025-10-11 19:39:41'),
(19, 2, 'Brownies Cokelat Lembut', 'Brownies panggang lembut dengan rasa cokelat pekat dan aroma mentega.', 250.00, '60 gram (1 potong kecil)', 'submitted', '2025-10-11 14:59:10', '2025-10-11 19:52:15'),
(22, 4, 'Keripik Bayam Crispy', 'Cemilan renyah dari daun bayam pilihan dengan balutan tepung gurih.', 100.00, '20 gram (±5 lembar)', 'draft', '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(23, 4, 'Tahu Walik Pedas', 'Tahu goreng terbalik khas Banyuwangi dengan isian ayam dan cabai.', 150.00, '30 gram (2 potong)', 'draft', '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(24, 4, 'Es Kopi Gula Aren Botol', 'Minuman kopi susu dingin dengan campuran gula aren asli.', 250.00, '250 ml (1 botol)', 'draft', '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(25, 4, 'Tempe Orek Kering', 'Tempe goreng kering manis gurih dengan bumbu kecap dan cabai.', 180.00, '30 gram (3 sendok makan)', 'draft', '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(26, 4, 'Keripik Jagung Pedas Manis', 'Cemilan jagung goreng gurih dengan bumbu balado manis pedas.', 120.00, '25 gram (1 genggam kecil)', 'approved', '2025-10-11 17:04:36', '2025-10-11 23:03:16'),
(27, 4, 'Roti Gandum Isi Cokelat', 'Roti lembut dari tepung gandum dengan isian cokelat pekat.', 250.00, '1 potong (50 gram)', 'approved', '2025-10-11 17:04:36', '2025-10-12 07:50:21'),
(28, 4, 'Kerupuk Kulit Sapi', 'Kerupuk gurih dan renyah dari kulit sapi pilihan.', 200.00, '20 gram (5 potong kecil)', 'approved', '2025-10-11 17:04:36', '2025-10-11 23:03:07'),
(29, 4, 'Dendeng Sapi Manis', 'Daging sapi iris tipis dimasak dengan bumbu kecap dan gula merah.', 150.00, '25 gram (3 potong)', 'approved', '2025-10-11 17:04:36', '2025-10-11 23:03:00'),
(30, 4, 'Abon Ayam Pedas', 'Abon ayam pedas gurih dengan tekstur halus dan kering.', 100.00, '15 gram (1 sendok makan)', 'draft', '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(31, 4, 'Mie Kering Sayur', 'Mie kering buatan tangan dari tepung terigu dan ekstrak sayur.', 300.00, '75 gram (1 porsi)', 'draft', '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(32, 4, 'tes', 'tes', 100.00, '20', 'rejected', '2025-10-11 22:54:39', '2025-10-11 23:02:51'),
(34, 4, 'tes lagi', 'tes lagi', 100.00, '20', 'rejected', '2025-10-12 06:08:25', '2025-10-12 06:54:22'),
(35, 2, 'Nuget', 'Tes Nuget', 200.00, '20 gram per sajian / porsi', 'approved', '2025-10-14 21:41:55', '2025-10-14 22:03:11');

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
(1, 1, 1, 80.00, 0, NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(2, 1, 3, 100.00, 0, NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(3, 1, 15, 30.00, 0, NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(4, 1, 4, 120.00, 0, NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(5, 1, 5, 70.00, 0, NULL, '2025-10-10 21:47:47', '2025-10-10 21:47:47'),
(32, 7, 2, 100.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(33, 7, 1, 50.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(34, 7, 16, 30.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(35, 7, 17, 20.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(36, 7, 18, 15.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(37, 8, 19, 150.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(38, 8, 1, 100.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(39, 8, 3, 30.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(40, 8, 20, 5.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(41, 8, 5, 15.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(42, 8, 4, 60.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(43, 9, 21, 50.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(44, 9, 22, 40.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(45, 9, 23, 30.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(46, 9, 18, 20.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(47, 9, 7, 5.00, 0, NULL, '2025-10-11 01:29:28', '2025-10-11 01:29:28'),
(65, 17, 32, 100.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(66, 17, 1, 50.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(67, 17, 33, 30.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(68, 17, 34, 20.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(69, 18, 24, 150.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(70, 18, 18, 30.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(71, 18, 35, 20.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(72, 19, 1, 80.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(73, 19, 15, 20.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(74, 19, 33, 40.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(75, 19, 5, 30.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(76, 19, 34, 20.00, 0, NULL, '2025-10-11 14:59:10', '2025-10-11 14:59:10'),
(78, 22, 36, 50.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(79, 22, 1, 30.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(80, 22, 37, 10.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(81, 22, 38, 5.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(82, 22, 18, 5.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(83, 23, 39, 100.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(84, 23, 40, 30.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(85, 23, 22, 10.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(86, 23, 38, 5.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(87, 23, 18, 5.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(88, 24, 41, 15.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(89, 24, 42, 200.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(90, 24, 43, 30.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(91, 24, 44, 5.00, 0, NULL, '2025-10-11 17:04:35', '2025-10-11 17:04:35'),
(92, 25, 45, 100.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(93, 25, 46, 20.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(94, 25, 22, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(95, 25, 23, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(96, 25, 47, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(97, 25, 18, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(98, 26, 48, 80.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(99, 26, 37, 20.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(100, 26, 3, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(101, 26, 49, 5.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(102, 26, 18, 5.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(103, 27, 50, 100.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(104, 27, 51, 30.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(105, 27, 3, 20.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(106, 27, 20, 5.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(107, 27, 5, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(108, 28, 52, 150.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(109, 28, 7, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(110, 28, 18, 40.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(111, 29, 53, 100.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(112, 29, 46, 20.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(113, 29, 47, 15.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(114, 29, 38, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(115, 29, 7, 5.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(116, 30, 40, 70.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(117, 30, 22, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(118, 30, 23, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(119, 30, 18, 10.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(120, 31, 1, 200.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(121, 31, 54, 50.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(122, 31, 55, 30.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(123, 31, 4, 20.00, 0, NULL, '2025-10-11 17:04:36', '2025-10-11 17:04:36'),
(124, 32, 44, 23.00, 0, NULL, '2025-10-11 22:54:58', '2025-10-11 22:54:58'),
(125, 32, 35, 231.00, 0, NULL, '2025-10-11 22:55:05', '2025-10-11 22:55:05'),
(126, 32, 53, 100.00, 0, NULL, '2025-10-11 22:59:55', '2025-10-11 22:59:55'),
(128, 34, 24, 100.00, 0, NULL, '2025-10-12 06:43:11', '2025-10-12 06:43:11'),
(129, 35, 40, 100.00, 0, NULL, '2025-10-14 21:43:02', '2025-10-14 21:43:02'),
(130, 35, 36, 20.00, 0, NULL, '2025-10-14 21:43:11', '2025-10-14 21:43:11');

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
('dGFMwZVuie1eqlj2K6igX7CMdVdjT5GkohdvQHno', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWEZJTGg2M0lKSEVneWpIWklQWldlNXRNR3h0YzZqS2hKSXZ4ZHl5OSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi92YWxpZGF0aW9uLXJlcXVlc3RzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1760331925),
('wjLr425rxxjUs9aya82T2XxoNKYTMpllfvRFNJVo', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiejU1QjdhdllxTE5GZTU2MjgxTTVYWG1uNHdGdUUwYlRlREJSRlRFaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pbmdyZWRpZW50cyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1760509705);

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
(1, 17, 2, 1, 'approved', 'Enak skali', '2025-10-11 19:37:47', '2025-10-11 23:03:24', '2025-10-11 19:37:47', '2025-10-11 23:03:24'),
(2, 18, 2, NULL, 'submitted', NULL, '2025-10-11 19:39:41', NULL, '2025-10-11 19:39:41', '2025-10-11 19:39:41'),
(3, 19, 2, NULL, 'submitted', NULL, '2025-10-11 19:52:15', NULL, '2025-10-11 19:52:15', '2025-10-11 19:52:15'),
(4, 7, 2, NULL, 'submitted', NULL, '2025-10-11 22:49:41', NULL, '2025-10-11 22:49:41', '2025-10-11 22:49:41'),
(5, 26, 4, 1, 'approved', 'Gas kan', '2025-10-11 22:52:04', '2025-10-11 23:03:15', '2025-10-11 22:52:04', '2025-10-11 23:03:15'),
(6, 28, 4, 1, 'approved', 'Mantap', '2025-10-11 22:54:03', '2025-10-11 23:03:07', '2025-10-11 22:54:03', '2025-10-11 23:03:07'),
(7, 29, 4, 1, 'approved', 'OK', '2025-10-11 22:54:22', '2025-10-11 23:03:00', '2025-10-11 22:54:22', '2025-10-11 23:03:00'),
(8, 32, 4, 1, 'rejected', 'Tes saja', '2025-10-11 23:00:12', '2025-10-11 23:02:51', '2025-10-11 23:00:12', '2025-10-11 23:02:51'),
(9, 34, 4, 1, 'rejected', 'No Good', '2025-10-12 06:53:17', '2025-10-12 06:54:33', '2025-10-12 06:53:17', '2025-10-12 06:54:33'),
(10, 27, 4, 5, 'approved', 'Ok', '2025-10-12 07:47:25', '2025-10-12 07:50:21', '2025-10-12 07:47:25', '2025-10-12 07:50:21'),
(11, 35, 2, 5, 'approved', 'ok', '2025-10-14 21:44:05', '2025-10-14 22:03:11', '2025-10-14 21:44:05', '2025-10-14 22:03:11');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `ingredient_nutritions`
--
ALTER TABLE `ingredient_nutritions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nutrition_summaries`
--
ALTER TABLE `nutrition_summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `validation_requests`
--
ALTER TABLE `validation_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
