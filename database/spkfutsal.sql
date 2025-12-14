-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2025 at 03:17 AM
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
-- Database: `spkfutsal`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot_penilaian`
--

CREATE TABLE `bobot_penilaian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `latihan_id` bigint(20) UNSIGNED NOT NULL,
  `pemain_id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `bobot` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bobot_wj` decimal(8,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bobot_penilaian`
--

INSERT INTO `bobot_penilaian` (`id`, `latihan_id`, `pemain_id`, `kriteria_id`, `bobot`, `created_at`, `updated_at`, `bobot_wj`) VALUES
(1431, 19, 13, 3, 9, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1432, 19, 13, 4, 8, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1433, 19, 13, 5, 8, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1434, 19, 13, 6, 8, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1435, 19, 13, 7, 7, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1436, 19, 13, 8, 7, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1437, 19, 13, 9, 7, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1438, 19, 13, 10, 5, '2025-12-13 12:59:49', '2025-12-13 12:59:49', NULL),
(1439, 19, 13, 11, 5, '2025-12-13 12:59:49', '2025-12-13 12:59:49', NULL),
(1440, 19, 13, 12, 6, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1441, 19, 13, 13, 6, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1442, 19, 13, 14, 5, '2025-12-13 12:59:49', '2025-12-13 12:59:49', NULL),
(1443, 19, 13, 15, 5, '2025-12-13 12:59:49', '2025-12-13 12:59:49', NULL),
(1444, 19, 13, 16, 5, '2025-12-13 12:59:49', '2025-12-13 12:59:49', NULL),
(1445, 19, 13, 17, 6, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1446, 19, 13, 18, 6, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1447, 19, 13, 19, 5, '2025-12-13 12:59:49', '2025-12-13 12:59:49', NULL),
(1448, 19, 13, 20, 5, '2025-12-13 12:59:49', '2025-12-13 12:59:49', NULL),
(1449, 19, 13, 21, 5, '2025-12-13 12:59:49', '2025-12-13 12:59:49', NULL),
(1450, 19, 13, 22, 6, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1451, 19, 13, 23, 7, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1452, 19, 13, 24, 6, '2025-12-13 12:59:49', '2025-12-13 13:16:18', NULL),
(1453, 19, 14, 3, 7, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1454, 19, 14, 4, 7, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1455, 19, 14, 5, 7, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1456, 19, 14, 6, 6, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1457, 19, 14, 7, 6, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1458, 19, 14, 8, 7, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1459, 19, 14, 9, 8, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1460, 19, 14, 10, 7, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1461, 19, 14, 11, 6, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1462, 19, 14, 12, 5, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1463, 19, 14, 13, 5, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1464, 19, 14, 14, 7, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1465, 19, 14, 15, 6, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1466, 19, 14, 16, 6, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1467, 19, 14, 17, 5, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1468, 19, 14, 18, 5, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1469, 19, 14, 19, 5, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1470, 19, 14, 20, 7, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1471, 19, 14, 21, 7, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1472, 19, 14, 22, 6, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1473, 19, 14, 23, 8, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL),
(1474, 19, 14, 24, 5, '2025-12-13 13:19:28', '2025-12-13 13:19:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bobot_posisi`
--

CREATE TABLE `bobot_posisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `posisi_id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `bobot` int(11) NOT NULL,
  `bobot_wj` decimal(8,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bobot_posisi`
--

INSERT INTO `bobot_posisi` (`id`, `posisi_id`, `kriteria_id`, `bobot`, `bobot_wj`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 5, 0.0714, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(2, 1, 4, 5, 0.0714, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(3, 1, 5, 5, 0.0714, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(4, 1, 6, 5, 0.0714, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(5, 1, 7, 4, 0.0571, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(6, 1, 8, 4, 0.0571, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(7, 1, 9, 4, 0.0571, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(8, 1, 10, 3, 0.0429, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(9, 1, 11, 3, 0.0429, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(10, 1, 12, 3, 0.0429, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(11, 1, 13, 3, 0.0429, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(12, 1, 14, 1, 0.0143, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(13, 1, 15, 1, 0.0143, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(14, 1, 16, 1, 0.0143, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(15, 1, 17, 3, 0.0429, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(16, 1, 18, 3, 0.0429, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(17, 1, 19, 5, 0.0714, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(18, 1, 20, 2, 0.0286, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(19, 1, 21, 4, 0.0571, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(20, 1, 22, 1, 0.0143, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(21, 1, 23, 4, 0.0571, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(22, 1, 24, 1, 0.0143, '2025-11-25 08:49:28', '2025-12-07 07:03:58'),
(67, 4, 3, 2, 0.0253, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(68, 4, 4, 5, 0.0633, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(69, 4, 5, 4, 0.0506, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(70, 4, 6, 3, 0.0380, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(71, 4, 7, 3, 0.0380, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(72, 4, 8, 4, 0.0506, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(73, 4, 9, 5, 0.0633, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(74, 4, 10, 5, 0.0633, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(75, 4, 11, 4, 0.0506, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(76, 4, 12, 5, 0.0633, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(77, 4, 13, 5, 0.0633, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(78, 4, 14, 3, 0.0380, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(79, 4, 15, 2, 0.0253, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(80, 4, 16, 1, 0.0127, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(81, 4, 17, 3, 0.0380, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(82, 4, 18, 4, 0.0506, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(83, 4, 19, 4, 0.0506, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(84, 4, 20, 4, 0.0506, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(85, 4, 21, 5, 0.0633, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(86, 4, 22, 2, 0.0253, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(87, 4, 23, 4, 0.0506, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(88, 4, 24, 2, 0.0253, '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(89, 5, 3, 1, 0.0109, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(90, 5, 4, 4, 0.0435, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(91, 5, 5, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(92, 5, 6, 4, 0.0435, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(93, 5, 7, 3, 0.0326, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(94, 5, 8, 3, 0.0326, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(95, 5, 9, 3, 0.0326, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(96, 5, 10, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(97, 5, 11, 4, 0.0435, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(98, 5, 12, 4, 0.0435, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(99, 5, 13, 3, 0.0326, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(100, 5, 14, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(101, 5, 15, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(102, 5, 16, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(103, 5, 17, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(104, 5, 18, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(105, 5, 19, 4, 0.0435, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(106, 5, 20, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(107, 5, 21, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(108, 5, 22, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(109, 5, 23, 4, 0.0435, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(110, 5, 24, 5, 0.0543, '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(111, 6, 3, 1, 0.0112, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(112, 6, 4, 4, 0.0449, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(113, 6, 5, 4, 0.0449, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(114, 6, 6, 5, 0.0562, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(115, 6, 7, 4, 0.0449, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(116, 6, 8, 5, 0.0562, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(117, 6, 9, 3, 0.0337, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(118, 6, 10, 5, 0.0562, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(119, 6, 11, 5, 0.0562, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(120, 6, 12, 4, 0.0449, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(121, 6, 13, 3, 0.0337, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(122, 6, 14, 5, 0.0562, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(123, 6, 15, 5, 0.0562, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(124, 6, 16, 3, 0.0337, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(125, 6, 17, 5, 0.0562, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(126, 6, 18, 5, 0.0562, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(127, 6, 19, 4, 0.0449, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(128, 6, 20, 4, 0.0449, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(129, 6, 21, 5, 0.0562, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(130, 6, 22, 3, 0.0337, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(131, 6, 23, 4, 0.0449, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(132, 6, 24, 3, 0.0337, '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(133, 7, 3, 1, 0.0118, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(134, 7, 4, 5, 0.0588, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(135, 7, 5, 5, 0.0588, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(136, 7, 6, 5, 0.0588, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(137, 7, 7, 3, 0.0353, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(138, 7, 8, 3, 0.0353, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(139, 7, 9, 5, 0.0588, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(140, 7, 10, 4, 0.0471, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(141, 7, 11, 3, 0.0353, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(142, 7, 12, 4, 0.0471, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(143, 7, 13, 3, 0.0353, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(144, 7, 14, 3, 0.0353, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(145, 7, 15, 4, 0.0471, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(146, 7, 16, 2, 0.0235, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(147, 7, 17, 4, 0.0471, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(148, 7, 18, 4, 0.0471, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(149, 7, 19, 5, 0.0588, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(150, 7, 20, 3, 0.0353, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(151, 7, 21, 4, 0.0471, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(152, 7, 22, 5, 0.0588, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(153, 7, 23, 5, 0.0588, '2025-11-26 06:52:42', '2025-11-26 06:52:42'),
(154, 7, 24, 5, 0.0588, '2025-11-26 06:52:42', '2025-11-26 06:52:42');

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
-- Table structure for table `detail_latihan`
--

CREATE TABLE `detail_latihan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `latihan_id` bigint(20) UNSIGNED NOT NULL,
  `pemain_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_latihan`
--

INSERT INTO `detail_latihan` (`id`, `latihan_id`, `pemain_id`, `created_at`, `updated_at`) VALUES
(20, 19, 13, '2025-12-13 12:42:17', '2025-12-13 12:42:17'),
(21, 19, 14, '2025-12-13 12:42:17', '2025-12-13 12:42:17'),
(22, 19, 15, '2025-12-13 12:42:17', '2025-12-13 12:42:17'),
(23, 19, 16, '2025-12-13 12:42:17', '2025-12-13 12:42:17'),
(24, 19, 17, '2025-12-13 12:42:17', '2025-12-13 12:42:17'),
(25, 19, 18, '2025-12-13 12:42:17', '2025-12-13 12:42:17'),
(26, 19, 19, '2025-12-13 12:42:17', '2025-12-13 12:42:17'),
(27, 19, 20, '2025-12-13 12:42:17', '2025-12-13 12:42:17'),
(28, 19, 21, '2025-12-13 12:42:17', '2025-12-13 12:42:17'),
(29, 19, 22, '2025-12-13 12:42:17', '2025-12-13 12:42:17'),
(40, 21, 13, '2025-12-14 02:14:08', '2025-12-14 02:14:08'),
(41, 21, 14, '2025-12-14 02:14:08', '2025-12-14 02:14:08'),
(42, 21, 15, '2025-12-14 02:14:08', '2025-12-14 02:14:08'),
(43, 21, 16, '2025-12-14 02:14:08', '2025-12-14 02:14:08'),
(44, 21, 17, '2025-12-14 02:14:08', '2025-12-14 02:14:08'),
(45, 21, 18, '2025-12-14 02:14:08', '2025-12-14 02:14:08'),
(46, 21, 19, '2025-12-14 02:14:08', '2025-12-14 02:14:08'),
(47, 21, 20, '2025-12-14 02:14:08', '2025-12-14 02:14:08'),
(48, 21, 21, '2025-12-14 02:14:08', '2025-12-14 02:14:08'),
(49, 21, 22, '2025-12-14 02:14:08', '2025-12-14 02:14:08');

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
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bobot` int(11) NOT NULL,
  `atribut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode`, `name`, `bobot`, `atribut`, `created_at`, `updated_at`) VALUES
(3, 'K1', 'Refleks', 5, 1, NULL, NULL),
(4, 'K2', 'Positioning', 5, 1, NULL, NULL),
(5, 'K3', '1-on-1 Situations', 5, 1, NULL, NULL),
(6, 'K4', 'Ball Handling', 5, 1, NULL, NULL),
(7, 'K5', 'Footwork', 4, 1, NULL, NULL),
(8, 'K6', 'Distribution', 4, 1, NULL, NULL),
(9, 'K7', 'Strength', 4, 1, NULL, NULL),
(10, 'K8', 'Passing', 3, 1, NULL, NULL),
(11, 'K9', 'Vision', 3, 1, NULL, NULL),
(12, 'K10', 'Game Awareness', 3, 1, NULL, NULL),
(13, 'K11', 'Tactical Discipline', 3, 1, NULL, NULL),
(14, 'K12', 'Acceleration', 1, 1, NULL, NULL),
(15, 'K13', 'Dribbling', 1, 1, NULL, NULL),
(16, 'K14', 'Crossing', 1, 1, NULL, NULL),
(17, 'K15', 'Stamina', 3, 1, NULL, NULL),
(18, 'K16', 'Agility', 3, 1, NULL, NULL),
(19, 'K17', 'Balance', 5, 1, NULL, NULL),
(20, 'K18', 'Speed', 2, 1, NULL, NULL),
(21, 'K19', 'Teamwork', 4, 1, NULL, NULL),
(22, 'K20', 'Finishing', 1, 1, NULL, NULL),
(23, 'K21', 'Composure', 4, 1, NULL, NULL),
(24, 'K22', 'Shooting', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `latihan`
--

CREATE TABLE `latihan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `latihan`
--

INSERT INTO `latihan` (`id`, `name`, `tanggal`, `created_at`, `updated_at`) VALUES
(19, 'Latihan 1', '2025-12-03', '2025-12-13 12:42:17', '2025-12-13 12:58:09'),
(21, 'Latihan 2', '2025-12-14', '2025-12-14 02:14:08', '2025-12-14 02:14:08');

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
(10, '0001_01_01_000000_create_users_table', 1),
(11, '0001_01_01_000001_create_cache_table', 1),
(12, '0001_01_01_000002_create_jobs_table', 1),
(14, '2025_11_15_103123_create_pemain_table', 2),
(15, '2025_11_16_170033_add_image_column_to_users_table', 3),
(17, '2025_11_19_125951_create_kriteria_table', 4),
(18, '2025_11_23_073248_change_column_posisi_to_id_posisi', 5),
(21, '2025_11_23_073612_create_posisi_table', 6),
(22, '2025_11_25_131555_create_bobot_posisi_table', 6),
(23, '2025_11_26_132540_change_type_bobot_wj_column', 7),
(28, '2025_12_07_132133_create_latihan_table', 8),
(30, '2025_12_07_132421_create_bobot_penilaian_table', 9),
(31, '2025_12_08_212533_drop_id_pemain_column_in_latihan_table', 10),
(37, '2025_12_12_222010_create_detail_latihan_table', 11),
(38, '2025_12_13_190827_drop_bobot_wj_column_in_bobot_penilaian_table', 12),
(39, '2025_12_13_191349_drop_tanggal_column_in_bobot_penilaian_table', 13),
(40, '2025_12_13_195351_drop_tanggal_column_in_detail_latihan_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `username` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemain`
--

CREATE TABLE `pemain` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_pemain` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `jk` tinyint(4) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `umur` int(11) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemain`
--

INSERT INTO `pemain` (`id`, `kode_pemain`, `name`, `jk`, `kelas`, `umur`, `id_posisi`, `image`, `created_at`, `updated_at`) VALUES
(13, 'P01', 'Rizky Ramadhan', 1, 'XI IPS 5', 19, 1, 'foto_pemain/1764165998_pamflet IG.png', '2025-11-26 07:06:38', '2025-12-13 12:36:12'),
(14, 'P02', 'Faqih Sholeh Huddin', 1, 'XI IPS 5', 18, 1, 'foto_pemain/1765200445_Amplop BPR (1).png', '2025-12-08 13:27:27', '2025-12-13 12:37:12'),
(15, 'P03', 'Haryono', 1, 'XI IPS 5', 18, 4, 'foto_pemain/1765200497_WhatsApp Image 2025-12-02 at 16.19.46_fe99a059.jpg', '2025-12-08 13:28:17', '2025-12-13 12:37:21'),
(16, 'P04', 'Gema Tri Sunanto', 1, 'XI IPA 2', 19, 4, 'foto_pemain/1765201485_whatsapp-logo-4456 (1).png', '2025-12-08 13:44:45', '2025-12-13 12:37:35'),
(17, 'P05', 'Firmansyah', 1, 'XI IPA 3', 17, 5, 'foto_pemain/1765201596_WhatsApp Image 2025-12-02 at 16.27.13_ab43cd50.jpg', '2025-12-08 13:46:36', '2025-12-13 12:37:55'),
(18, 'P06', 'Muhamad Tio Pratama', 1, 'XI IPA 1', 18, 5, 'foto_pemain/1765204515_Amplop BPR.png', '2025-12-08 14:35:16', '2025-12-13 12:38:10'),
(19, 'P07', 'Roki Herliyanto', 1, 'XI IPA 3', 19, 6, 'foto_pemain/1765629639_6625044904-atep_2.jpg', '2025-12-13 12:40:40', '2025-12-13 12:40:40'),
(20, 'P08', 'Muhammad Reza Maulana', 1, 'XI IPA 2', 18, 6, 'foto_pemain/1765629669_6625044904-atep_2.jpg', '2025-12-13 12:41:09', '2025-12-13 12:41:09'),
(21, 'P09', 'Dzikri Firmansyah', 1, 'XI IPA 3', 18, 7, 'foto_pemain/1765629694_6625044904-atep_2.jpg', '2025-12-13 12:41:34', '2025-12-13 12:41:34'),
(22, 'P10', 'Irfansyah', 1, 'XI IPA 1', 19, 7, 'foto_pemain/1765629720_6625044904-atep_2.jpg', '2025-12-13 12:42:00', '2025-12-13 12:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `posisi`
--

CREATE TABLE `posisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posisi`
--

INSERT INTO `posisi` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'GK', '2025-11-25 08:49:28', '2025-11-25 08:49:28'),
(4, 'Anchor', '2025-11-26 06:47:22', '2025-11-26 06:47:22'),
(5, 'Flank Kanan', '2025-11-26 06:49:10', '2025-11-26 06:49:10'),
(6, 'Flank Kiri', '2025-11-26 06:50:54', '2025-11-26 06:50:54'),
(7, 'Pivot', '2025-11-26 06:52:42', '2025-11-26 06:52:42');

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
('MLybalYYoBIfUbbtnKZeMi9W7s6dH4a2Ebhqg09D', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiblFMRUthdmJVdUllTmZWU2tMVGR4YlBUY2oxcHFvNTJWMkduTFNDNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW5pbGFpYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1765678567);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Azrul', 'azrul', '$2y$12$pU5rC/TDVuaq0440IZKt9.t1doOomD/NtK6R2uMQGsNuIDP/.WmtO', '1', NULL, NULL, NULL, '2025-11-19 05:49:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot_penilaian`
--
ALTER TABLE `bobot_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bobot_penilaian_latihan_id_foreign` (`latihan_id`),
  ADD KEY `bobot_penilaian_pemain_id_foreign` (`pemain_id`),
  ADD KEY `bobot_penilaian_kriteria_id_foreign` (`kriteria_id`);

--
-- Indexes for table `bobot_posisi`
--
ALTER TABLE `bobot_posisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bobot_posisi_posisi_id_foreign` (`posisi_id`),
  ADD KEY `bobot_posisi_kriteria_id_foreign` (`kriteria_id`);

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
-- Indexes for table `detail_latihan`
--
ALTER TABLE `detail_latihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_latihan_latihan_id_foreign` (`latihan_id`),
  ADD KEY `detail_latihan_pemain_id_foreign` (`pemain_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latihan`
--
ALTER TABLE `latihan`
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
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pemain`
--
ALTER TABLE `pemain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posisi`
--
ALTER TABLE `posisi`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot_penilaian`
--
ALTER TABLE `bobot_penilaian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1475;

--
-- AUTO_INCREMENT for table `bobot_posisi`
--
ALTER TABLE `bobot_posisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `detail_latihan`
--
ALTER TABLE `detail_latihan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `latihan`
--
ALTER TABLE `latihan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pemain`
--
ALTER TABLE `pemain`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `posisi`
--
ALTER TABLE `posisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_penilaian`
--
ALTER TABLE `bobot_penilaian`
  ADD CONSTRAINT `bobot_penilaian_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bobot_penilaian_latihan_id_foreign` FOREIGN KEY (`latihan_id`) REFERENCES `latihan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bobot_penilaian_pemain_id_foreign` FOREIGN KEY (`pemain_id`) REFERENCES `pemain` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bobot_posisi`
--
ALTER TABLE `bobot_posisi`
  ADD CONSTRAINT `bobot_posisi_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bobot_posisi_posisi_id_foreign` FOREIGN KEY (`posisi_id`) REFERENCES `posisi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_latihan`
--
ALTER TABLE `detail_latihan`
  ADD CONSTRAINT `detail_latihan_latihan_id_foreign` FOREIGN KEY (`latihan_id`) REFERENCES `latihan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_latihan_pemain_id_foreign` FOREIGN KEY (`pemain_id`) REFERENCES `pemain` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
