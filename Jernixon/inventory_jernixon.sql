-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2018 at 06:53 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_jernixon`
--
CREATE DATABASE IF NOT EXISTS `inventory_jernixon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `inventory_jernixon`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ADMIN',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'admin@gmail.com', '$2y$10$HpGuCVm2xV4cuj62m0dVaekc4xbDxazwNdHwUCq3XE2R2mBbfFvOW', 'aSpY7nzzmlyDhScCG76W9FRptO8Dj5smmcCvjG9PI3ZW0BXwZQnKCq09ma3i', '2018-02-24 21:39:36', '2018-02-24 21:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `damaged_items`
--

CREATE TABLE `damaged_items` (
  `stock_adjustments_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damaged_items`
--

INSERT INTO `damaged_items` (`stock_adjustments_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 108, 10, '2018-04-13 16:00:00', NULL),
(3, 111, 1, '2018-05-21 16:00:00', NULL),
(4, 111, 1, '2018-05-21 16:00:00', NULL),
(5, 133, 1, '2018-05-21 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `damaged_salable_items`
--

CREATE TABLE `damaged_salable_items` (
  `product_id` int(11) NOT NULL,
  `wholesale_price` decimal(7,2) NOT NULL,
  `retail_price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lost_items`
--

CREATE TABLE `lost_items` (
  `stock_adjustments_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lost_items`
--

INSERT INTO `lost_items` (`stock_adjustments_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 108, 10, '2018-04-13 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_25_134750_create_accounts_table', 1),
(4, '2018_01_25_134949_create_suppliers_table', 1),
(5, '2018_01_25_135011_create_customers_table', 1),
(6, '2018_01_25_135029_create_products_table', 1),
(7, '2018_01_25_135046_create_purchases_table', 1),
(8, '2018_01_25_135104_create_returns_table', 1),
(9, '2018_01_25_135123_create_sales_table', 1),
(10, '2018_02_24_081458_create_admins_table', 2),
(11, '2018_05_19_155942_create_notifications_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_id`, `notifiable_type`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0bfc9259-9e20-4780-a8a4-6a2b2ed50049', 'App\\Notifications\\ReorderNotification', 2, 'App\\User', '{"quantity":3,"description":"Brake Master Repair Kit Wave125"}', NULL, '2018-05-21 21:30:30', '2018-05-21 21:30:30'),
('4de402b2-6d1c-4838-b74c-dd77774a2d78', 'App\\Notifications\\ReorderNotification', 3, 'App\\User', '{"quantity":4,"description":"Brake Master Repair Kit Wave125"}', NULL, '2018-05-21 21:29:30', '2018-05-21 21:29:30'),
('554db5bb-0b28-475c-b752-c68a9f406e73', 'App\\Notifications\\ReorderNotification', 1, 'App\\User', '{"quantity":3,"description":"Brake Master Repair Kit Wave125"}', '2018-05-21 21:37:14', '2018-05-21 21:30:30', '2018-05-21 21:37:14'),
('7cf9ad69-7063-468b-862e-514d37a32ef2', 'App\\Notifications\\ReorderNotification', 1, 'App\\Admin', '{"quantity":4,"description":"Brake Master Repair Kit Wave125"}', '2018-05-21 21:29:59', '2018-05-21 21:29:30', '2018-05-21 21:29:59'),
('90894cc0-6ae6-4acc-a8d7-bdea394a698a', 'App\\Notifications\\ReorderNotification', 3, 'App\\User', '{"quantity":2,"description":"Brake Master Repair Kit Wave125"}', NULL, '2018-05-21 22:03:36', '2018-05-21 22:03:36'),
('96ecd8e0-1f3b-4169-a8b4-4faf536f81b7', 'App\\Notifications\\ReorderNotification', 3, 'App\\User', '{"quantity":3,"description":"Brake Master Repair Kit Wave125"}', NULL, '2018-05-21 21:30:30', '2018-05-21 21:30:30'),
('b26fd7db-5667-4212-8452-26972a0411b6', 'App\\Notifications\\ReorderNotification', 2, 'App\\User', '{"quantity":2,"description":"Brake Master Repair Kit Wave125"}', NULL, '2018-05-21 22:03:36', '2018-05-21 22:03:36'),
('cc6de34e-2db9-4de3-b808-c881b60cb91a', 'App\\Notifications\\ReorderNotification', 1, 'App\\User', '{"quantity":2,"description":"Brake Master Repair Kit Wave125"}', NULL, '2018-05-21 22:03:36', '2018-05-21 22:03:36'),
('d8c0987d-3b7b-46d5-a993-a41756c0a04b', 'App\\Notifications\\ReorderNotification', 1, 'App\\Admin', '{"quantity":2,"description":"Brake Master Repair Kit Wave125"}', '2018-05-21 22:05:50', '2018-05-21 22:03:36', '2018-05-21 22:05:50'),
('d9405e65-c993-4fdc-8204-01bff48255b5', 'App\\Notifications\\ReorderNotification', 2, 'App\\User', '{"quantity":4,"description":"Brake Master Repair Kit Wave125"}', NULL, '2018-05-21 21:29:30', '2018-05-21 21:29:30'),
('e02fd9bf-353d-4f85-95c7-eea3d03e1ceb', 'App\\Notifications\\ReorderNotification', 1, 'App\\User', '{"quantity":4,"description":"Brake Master Repair Kit Wave125"}', NULL, '2018-05-21 21:29:30', '2018-05-21 21:29:30'),
('e51f9b16-c817-4b7d-bb4d-1efaf60941c3', 'App\\Notifications\\ReorderNotification', 1, 'App\\Admin', '{"quantity":3,"description":"Brake Master Repair Kit Wave125"}', '2018-05-21 22:04:29', '2018-05-21 21:30:30', '2018-05-21 22:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `physical_counts`
--

CREATE TABLE `physical_counts` (
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `date` date NOT NULL DEFAULT '2017-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physical_counts`
--

INSERT INTO `physical_counts` (`status`, `date`) VALUES
('inactive', '2018-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `physical_count_items`
--

CREATE TABLE `physical_count_items` (
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `description` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('available','unavailable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `reorder_level` int(11) NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `description`, `status`, `reorder_level`, `created_at`, `updated_at`) VALUES
(1, 'Connecting Rod KitXRM110', 'available', 5, '2018-02-28 16:00:00', NULL),
(2, 'Connecting Rod KitBILP/HD3', 'available', 5, '2018-02-28 16:00:00', NULL),
(3, 'Connecting Rod KitSMASH', 'available', 5, '2018-02-28 16:00:00', NULL),
(4, 'Connecting Rod KitXLR', 'available', 5, '2018-02-28 16:00:00', NULL),
(5, 'Connecting Rod KitBARAKO 175', 'available', 5, '2018-02-28 16:00:00', NULL),
(6, 'Connecting Rod KitSTX', 'available', 5, '2018-02-28 16:00:00', NULL),
(7, 'Connecting Rod KitDT125', 'available', 5, '2018-02-28 16:00:00', NULL),
(8, 'Connecting Rod KitSHOGUN', 'available', 5, '2018-02-28 16:00:00', NULL),
(9, 'Connecting Rod KitRUSI 150', 'available', 5, '2018-02-28 16:00:00', NULL),
(10, 'Connecting Rod KitX4/GP125', 'available', 5, '2018-02-28 16:00:00', NULL),
(11, 'Stator Assy.STX 8 COILS', 'available', 5, '2018-02-28 16:00:00', NULL),
(12, 'Stator Assy.STX 16 COILS', 'available', 5, '2018-02-28 16:00:00', NULL),
(13, 'Stator Assy.LIFAN125', 'available', 5, '2018-02-28 16:00:00', NULL),
(14, 'Stator Assy.BC175', 'available', 5, '2018-02-28 16:00:00', NULL),
(15, 'Stator Assy.C100', 'available', 5, '2018-02-28 16:00:00', NULL),
(16, 'Stator Assy.TMX-CP', 'available', 5, '2018-02-28 16:00:00', NULL),
(17, 'Stator Assy.XLR 200/GS185/150', 'available', 5, '2018-02-28 16:00:00', NULL),
(18, 'Stator Assy.MOTOR STAR', 'available', 5, '2018-02-28 16:00:00', NULL),
(19, 'Stator Assy.WAVE125', 'available', 5, '2018-02-28 16:00:00', NULL),
(20, 'Stator Assy.LIFAN150', 'available', 5, '2018-02-28 16:00:00', NULL),
(21, 'Stator Assy.XRM110', 'available', 5, '2018-02-28 16:00:00', NULL),
(22, 'Stator Assy.TMX-CDI W/BASE', 'available', 5, '2018-02-28 16:00:00', NULL),
(23, 'Clutch LiningLIFAN110', 'available', 5, '2018-02-28 16:00:00', NULL),
(24, 'Clutch LiningXRM110', 'available', 5, '2018-02-28 16:00:00', NULL),
(25, 'Clutch LiningTMX', 'available', 5, '2018-02-28 16:00:00', NULL),
(26, 'Clutch LiningWAVE125', 'available', 5, '2018-02-28 16:00:00', NULL),
(27, 'Clutch LiningCRYPTON', 'available', 5, '2018-02-28 16:00:00', NULL),
(28, 'Clutch LiningRS100', 'available', 5, '2018-02-28 16:00:00', NULL),
(29, 'Clutch LiningSTX', 'available', 5, '2018-02-28 16:00:00', NULL),
(30, 'Clutch LiningHD3/B1LP', 'available', 5, '2018-02-28 16:00:00', NULL),
(31, 'Clutch LiningBS175', 'available', 5, '2018-02-28 16:00:00', NULL),
(32, 'Clutch LiningAURA', 'available', 5, '2018-02-28 16:00:00', NULL),
(33, 'Clutch LiningWIND125', 'available', 5, '2018-02-28 16:00:00', NULL),
(34, 'Clutch LiningCT100/BAJAJ', 'available', 5, '2018-02-28 16:00:00', NULL),
(35, 'Clutch LiningX4/GP125', 'available', 5, '2018-02-28 16:00:00', NULL),
(36, 'Clutch LiningB120/SMASH', 'available', 5, '2018-02-28 16:00:00', NULL),
(37, 'Clutch LiningG7S', 'available', 5, '2018-02-28 16:00:00', NULL),
(38, 'CDI UnitTMX155', 'available', 5, '2018-02-28 16:00:00', NULL),
(39, 'CDI UnitC100', 'available', 5, '2018-02-28 16:00:00', NULL),
(40, 'CDI UnitWAVE125-CDI 5 Pins', 'available', 5, '2018-02-28 16:00:00', NULL),
(41, 'CDI UnitXRM110 5 Pins', 'available', 5, '2018-02-28 16:00:00', NULL),
(42, 'CDI UnitCRYPTON', 'available', 5, '2018-02-28 16:00:00', NULL),
(43, 'Pulser CoilCT100', 'available', 5, '2018-02-28 16:00:00', NULL),
(44, 'Pulser CoilBC175', 'available', 5, '2018-02-28 16:00:00', NULL),
(45, 'Pulser CoilCRYPTON', 'available', 5, '2018-02-28 16:00:00', NULL),
(46, 'Pulser CoilLifan100', 'available', 5, '2018-02-28 16:00:00', NULL),
(47, 'Pulser CoilLifan150', 'available', 5, '2018-02-28 16:00:00', NULL),
(48, 'Pulser CoilTMX-CDI TYPE', 'available', 5, '2018-02-28 16:00:00', NULL),
(49, 'Regulator 4 Wires', 'available', 5, '2018-02-28 16:00:00', NULL),
(50, 'Regulator 5 Wires', 'available', 5, '2018-02-28 16:00:00', NULL),
(51, 'Regulator Raider J', 'available', 5, '2018-02-28 16:00:00', NULL),
(52, 'Regulator Rectifier Barako', 'available', 5, '2018-02-28 16:00:00', NULL),
(53, 'Regulator Rectifier Crypton', 'available', 5, '2018-02-28 16:00:00', NULL),
(54, 'Regulator Rectifier CT100', 'available', 5, '2018-02-28 16:00:00', NULL),
(55, 'Regulator Rectifier GS125', 'available', 5, '2018-02-28 16:00:00', NULL),
(56, 'Regulator Rectifier Mio', 'available', 5, '2018-02-28 16:00:00', NULL),
(57, 'Regulator Rectifier RS100 12v WWII', 'available', 5, '2018-02-28 16:00:00', NULL),
(58, 'Regulator Rectifier  Smash', 'available', 5, '2018-02-28 16:00:00', NULL),
(59, 'Regulator Rectifier Wave100', 'available', 5, '2018-02-28 16:00:00', NULL),
(60, 'Regulator Rectifier Wave110/XRM', 'available', 5, '2018-02-28 16:00:00', NULL),
(61, 'Regulator Rectifier Wind125', 'available', 5, '2018-02-28 16:00:00', NULL),
(62, 'Regulator Rectifier Rusi/TC125 4+1 WII', 'available', 5, '2018-02-28 16:00:00', NULL),
(63, 'Regulator Rectifier C100', 'available', 5, '2018-02-28 16:00:00', NULL),
(64, 'Regulator Rectifier TMX', 'available', 5, '2018-02-28 16:00:00', NULL),
(65, 'Fuel Cock B1LP/HD3', 'available', 5, '2018-02-28 16:00:00', NULL),
(66, 'Fuel Cock BC175', 'available', 5, '2018-02-28 16:00:00', NULL),
(67, 'Fuel Cock C100/Dream/XRM', 'available', 5, '2018-02-28 16:00:00', NULL),
(68, 'Fuel Cock CG125', 'available', 5, '2018-02-28 16:00:00', NULL),
(69, 'Fuel Cock Crypton', 'available', 5, '2018-02-28 16:00:00', NULL),
(70, 'Fuel Cock G75', 'available', 5, '2018-02-28 16:00:00', NULL),
(71, 'Fuel Cock GP125/X4/X120', 'available', 5, '2018-02-28 16:00:00', NULL),
(72, 'Magneto Kit TMX Silicon Gray', 'available', 5, '2018-02-28 16:00:00', NULL),
(73, 'Magneto Kit XRM Silicon-Red', 'available', 5, '2018-02-28 16:00:00', NULL),
(74, 'Magneto Kit C100 Silcon-Red', 'available', 5, '2018-02-28 16:00:00', NULL),
(75, 'Magneto Kit TMX BLK', 'available', 5, '2018-02-28 16:00:00', NULL),
(76, 'Magneto Kit C100 BLK', 'available', 5, '2018-02-28 16:00:00', NULL),
(77, 'Magneto Kit Rusi125/110 BLK', 'available', 5, '2018-02-28 16:00:00', NULL),
(78, 'Magneto Kit Rusi125/110 Silicon-Red', 'available', 5, '2018-02-28 16:00:00', NULL),
(79, 'Carbon Brush Mio', 'available', 5, '2018-02-28 16:00:00', NULL),
(80, 'Carbon Brush Shogun', 'available', 5, '2018-02-28 16:00:00', NULL),
(81, 'Carbon Brush Smash', 'available', 5, '2018-02-28 16:00:00', NULL),
(82, 'Carbon Brush XRM', 'available', 5, '2018-02-28 16:00:00', NULL),
(83, 'Carbon Brush Sniper', 'available', 5, '2018-02-28 16:00:00', NULL),
(84, 'Carbon Brush With Housing', 'available', 5, '2018-02-28 16:00:00', NULL),
(85, 'Carbon Brush Wave125', 'available', 5, '2018-02-28 16:00:00', NULL),
(86, 'Carbon Brush Crypton', 'available', 5, '2018-02-28 16:00:00', NULL),
(87, 'Rocker Arm W/tappet Screw XM', 'available', 5, '2018-02-28 16:00:00', NULL),
(88, 'Rocker Arm W/tappet Screw TMX', 'available', 5, '2018-02-28 16:00:00', NULL),
(89, 'Rocker Arm W/tappet Screw Barako', 'available', 5, '2018-02-28 16:00:00', NULL),
(90, 'Rocker Arm W/tappet Screw Mio', 'available', 5, '2018-02-28 16:00:00', NULL),
(91, 'Rocker Arm W/tappet Screw STX', 'available', 5, '2018-02-28 16:00:00', NULL),
(92, 'Rocker Arm W/tappet Screw Shogun', 'available', 5, '2018-02-28 16:00:00', NULL),
(93, 'Rocker Arm W/tappet Screw Smash', 'available', 5, '2018-02-28 16:00:00', NULL),
(94, 'Rocker Arm W/tappet Screw Fury', 'available', 5, '2018-02-28 16:00:00', NULL),
(95, 'Rocker Arm Wave125', 'available', 5, '2018-02-28 16:00:00', NULL),
(96, 'Cylinder Head Packing-Red TMX', 'available', 5, '2018-02-28 16:00:00', NULL),
(97, 'Cylinder Head Packing-Silicon TMX', 'available', 5, '2018-02-28 16:00:00', NULL),
(98, 'Cylinder Head Packing-BLK TMX', 'available', 5, '2018-02-28 16:00:00', NULL),
(99, 'Wire Harness RS100', 'available', 5, '2018-02-28 16:00:00', NULL),
(100, 'Wire Harness TMX/CPT1', 'available', 5, '2018-02-28 16:00:00', NULL),
(101, 'Wire Harness TMX/CPT', 'available', 5, '2018-02-28 16:00:00', NULL),
(102, 'Wire Harness HD3/CDI', 'available', 5, '2018-02-28 16:00:00', NULL),
(103, 'Wire Harness HD3', 'available', 5, '2018-02-28 16:00:00', NULL),
(104, 'Wire Harness XRM', 'available', 5, '2018-02-28 16:00:00', NULL),
(105, 'Wire Harness STX', 'available', 5, '2018-02-28 16:00:00', NULL),
(106, 'Brake Master Repair Kit Raider150', 'available', 5, '2018-02-28 16:00:00', NULL),
(107, 'Brake Master Repair Kit Wave125', 'available', 5, '2018-02-28 16:00:00', NULL),
(108, 'Brake Master Repair Kit GLPRO', 'available', 5, '2018-02-28 16:00:00', NULL),
(109, 'Brake Master Repair Kit Mio', 'available', 5, '2018-02-28 16:00:00', NULL),
(110, 'Brake Master Repair Kit XRM110/W110', 'available', 5, '2018-02-28 16:00:00', NULL),
(111, 'Brake Master Repair Kit Shogun', 'available', 5, '2018-02-28 16:00:00', NULL),
(112, 'Brake Master Repair Kit Trinity', 'available', 5, '2018-02-28 16:00:00', NULL),
(113, 'Brake Master Repair Kit Raider110', 'available', 5, '2018-02-28 16:00:00', '2018-05-22 22:36:59'),
(114, 'Brake Master Repair Kit Smash', 'available', 5, '2018-02-28 16:00:00', NULL),
(115, 'Primary Coil C100', 'available', 5, '2018-02-28 16:00:00', NULL),
(116, 'Primary Coil CT00', 'available', 5, '2018-02-28 16:00:00', NULL),
(117, 'Primary Coil TMX-CDI1', 'available', 5, '2018-02-28 16:00:00', NULL),
(118, 'Primary Coil TMX-CDI', 'available', 5, '2018-02-28 16:00:00', NULL),
(119, 'Fulser Coil Lifan150', 'available', 5, '2018-02-28 16:00:00', NULL),
(120, 'Fulser Coil BC175', 'available', 5, '2018-02-28 16:00:00', NULL),
(121, 'Fulser Coil CT100', 'available', 5, '2018-02-28 16:00:00', NULL),
(122, 'Fulser Coil Crypton', 'available', 5, '2018-02-28 16:00:00', NULL),
(123, 'Fulser Coil MSX', 'available', 5, '2018-02-28 16:00:00', NULL),
(124, 'Fulser Coil TMX/CDI', 'available', 5, '2018-02-28 16:00:00', NULL),
(125, 'Carburador Insulator GY6125', 'available', 5, '2018-02-28 16:00:00', NULL),
(126, 'Carburador Insulator CG125', 'available', 5, '2018-02-28 16:00:00', NULL),
(127, 'Carburador Insulator CT100', 'available', 5, '2018-02-28 16:00:00', NULL),
(128, 'Carburador Insulator GS125', 'available', 5, '2018-02-28 16:00:00', NULL),
(129, 'Carburador Insulator XRM', 'available', 5, '2018-02-28 16:00:00', NULL),
(130, 'Carburador Insulator BC175', 'available', 5, '2018-02-28 16:00:00', NULL),
(131, 'Carburador Insulator TMX Fibra', 'available', 5, '2018-02-28 16:00:00', NULL),
(132, 'Carburador Insulator TMX Alloy', 'available', 5, '2018-02-28 16:00:00', NULL),
(133, 'Carburador Insulator TMX Rubberize', 'available', 5, '2018-02-28 16:00:00', NULL),
(134, 'Handle Switch Assy. BC175 L/H', 'available', 5, '2018-02-28 16:00:00', NULL),
(135, 'Handle Switch Assy. DT125 R/H', 'available', 5, '2018-02-28 16:00:00', NULL),
(136, 'Handle Switch Assy. DT125 L/H', 'available', 5, '2018-02-28 16:00:00', NULL),
(137, 'Handle Switch Assy. RS100 L/H', 'available', 5, '2018-02-28 16:00:00', NULL),
(138, 'Handle Switch Assy. XRM-Old L/H', 'available', 5, '2018-02-28 16:00:00', NULL),
(139, 'Handle Switch Assy. XRM-New L/H', 'available', 5, '2018-02-28 16:00:00', NULL),
(140, 'Handle Switch Assy. RM-Neww R/H', 'available', 5, '2018-02-28 16:00:00', NULL),
(141, 'Neutral Switch Indicator Crypton', 'available', 5, '2018-02-28 16:00:00', NULL),
(142, 'Neutral Switch Indicator C100', 'available', 5, '2018-02-28 16:00:00', NULL),
(143, 'Neutral Switch Indicator Wave125', 'available', 5, '2018-02-28 16:00:00', NULL),
(144, 'Neutral Switch Indicator XRM', 'available', 5, '2018-02-28 16:00:00', NULL),
(145, 'Neutral Switch Indicator STX', 'available', 5, '2018-02-28 16:00:00', NULL),
(146, 'Neutral Switch Indicator CT100', 'available', 5, '2018-02-28 16:00:00', NULL),
(147, 'Valve Guide Set CG125', 'available', 5, '2018-02-28 16:00:00', NULL),
(148, 'Valve Guide Set TMX CPT.', 'available', 5, '2018-02-28 16:00:00', NULL),
(149, 'Valve Guide Set TMXCDI', 'available', 5, '2018-02-28 16:00:00', NULL),
(150, 'Valve Guide Set XRM', 'available', 5, '2018-02-28 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `po_id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`po_id`, `product_id`, `supplier_name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
('1', 82, 'Honda', 5, '1.00', '2018-04-05 16:00:00', NULL),
('1', 19, 'Honda', 7, '1.00', '2018-04-05 16:00:00', NULL),
('1', 147, 'Honda', 7, '1.00', '2018-04-05 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `or_number` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`or_number`, `product_id`, `customer_name`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 113, 'Chris Hemsworth', '83.00', 5, '2018-04-14 15:15:30', NULL),
(1, 113, 'Chris Hemsworth', '83.00', 5, '2018-04-14 15:15:36', NULL),
(1, 114, 'Chris Hemsworth', '83.00', 6, '2018-04-14 15:17:53', NULL),
(2, 34, 'Mark Ruffalo', '150.00', 10, '2018-04-14 15:18:28', NULL),
(1, 106, 'Chris Hemsworth', '83.00', 8, '2018-04-14 15:26:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salable_items`
--

CREATE TABLE `salable_items` (
  `product_id` int(11) NOT NULL,
  `wholesale_price` decimal(7,2) NOT NULL,
  `retail_price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salable_items`
--

INSERT INTO `salable_items` (`product_id`, `wholesale_price`, `retail_price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, '150.00', '180.00', 28, '2018-03-30 16:00:00', NULL),
(2, '150.00', '180.00', 37, '2018-03-30 16:00:00', NULL),
(3, '150.00', '180.00', 35, '2018-03-30 16:00:00', NULL),
(4, '150.00', '180.00', 12, '2018-03-30 16:00:00', NULL),
(5, '150.00', '180.00', 23, '2018-03-30 16:00:00', NULL),
(6, '150.00', '180.00', 10, '2018-03-30 16:00:00', NULL),
(7, '150.00', '180.00', 27, '2018-03-30 16:00:00', NULL),
(8, '150.00', '180.00', 43, '2018-03-30 16:00:00', NULL),
(9, '150.00', '180.00', 24, '2018-03-30 16:00:00', NULL),
(10, '150.00', '180.00', 24, '2018-03-30 16:00:00', NULL),
(11, '250.00', '280.00', 6, '2018-03-30 16:00:00', NULL),
(12, '250.00', '280.00', 21, '2018-03-30 16:00:00', NULL),
(13, '250.00', '280.00', 12, '2018-03-30 16:00:00', NULL),
(14, '250.00', '280.00', 15, '2018-03-30 16:00:00', NULL),
(15, '250.00', '280.00', 6, '2018-03-30 16:00:00', NULL),
(16, '250.00', '280.00', 4, '2018-03-30 16:00:00', NULL),
(17, '250.00', '280.00', 37, '2018-03-30 16:00:00', NULL),
(18, '250.00', '280.00', 25, '2018-03-30 16:00:00', NULL),
(19, '1.00', '1.00', 10, '2018-03-30 16:00:00', NULL),
(20, '250.00', '280.00', 6, '2018-03-30 16:00:00', NULL),
(21, '250.00', '280.00', 33, '2018-03-30 16:00:00', NULL),
(22, '250.00', '280.00', 5, '2018-03-30 16:00:00', NULL),
(23, '120.00', '150.00', 22, '2018-03-30 16:00:00', NULL),
(24, '120.00', '150.00', 9, '2018-03-30 16:00:00', NULL),
(25, '120.00', '150.00', 39, '2018-03-30 16:00:00', NULL),
(26, '120.00', '150.00', 15, '2018-03-30 16:00:00', NULL),
(27, '120.00', '150.00', 43, '2018-03-30 16:00:00', NULL),
(28, '120.00', '150.00', 44, '2018-03-30 16:00:00', NULL),
(29, '120.00', '150.00', 28, '2018-03-30 16:00:00', NULL),
(30, '120.00', '150.00', 17, '2018-03-30 16:00:00', NULL),
(31, '120.00', '150.00', 45, '2018-03-30 16:00:00', NULL),
(32, '120.00', '150.00', 15, '2018-03-30 16:00:00', NULL),
(33, '120.00', '150.00', 21, '2018-03-30 16:00:00', NULL),
(34, '120.00', '150.00', 10, '2018-03-30 16:00:00', NULL),
(35, '120.00', '150.00', 10, '2018-03-30 16:00:00', NULL),
(36, '120.00', '150.00', 38, '2018-03-30 16:00:00', NULL),
(37, '155.00', '185.00', 34, '2018-03-30 16:00:00', NULL),
(38, '155.00', '185.00', 26, '2018-03-30 16:00:00', NULL),
(39, '155.00', '185.00', 49, '2018-03-30 16:00:00', NULL),
(40, '155.00', '185.00', 41, '2018-03-30 16:00:00', NULL),
(41, '155.00', '185.00', 10, '2018-03-30 16:00:00', NULL),
(42, '155.00', '185.00', 31, '2018-03-30 16:00:00', NULL),
(43, '155.00', '185.00', 37, '2018-03-30 16:00:00', NULL),
(44, '155.00', '185.00', 7, '2018-03-30 16:00:00', NULL),
(45, '155.00', '185.00', 23, '2018-03-30 16:00:00', NULL),
(46, '155.00', '185.00', 32, '2018-03-30 16:00:00', NULL),
(47, '155.00', '185.00', 29, '2018-03-30 16:00:00', NULL),
(48, '155.00', '185.00', 13, '2018-03-30 16:00:00', NULL),
(49, '200.00', '230.00', 16, '2018-03-30 16:00:00', NULL),
(50, '205.00', '235.00', 26, '2018-03-30 16:00:00', NULL),
(51, '287.00', '317.00', 38, '2018-03-30 16:00:00', NULL),
(52, '190.00', '220.00', 40, '2018-03-30 16:00:00', NULL),
(53, '190.00', '220.00', 48, '2018-03-30 16:00:00', NULL),
(54, '287.00', '317.00', 23, '2018-03-30 16:00:00', NULL),
(55, '287.00', '317.00', 37, '2018-03-30 16:00:00', NULL),
(56, '287.00', '317.00', 40, '2018-03-30 16:00:00', NULL),
(57, '95.00', '125.00', 25, '2018-03-30 16:00:00', NULL),
(58, '186.00', '216.00', 19, '2018-03-30 16:00:00', NULL),
(59, '186.00', '216.00', 22, '2018-03-30 16:00:00', NULL),
(60, '186.00', '216.00', 9, '2018-03-30 16:00:00', NULL),
(61, '270.00', '300.00', 35, '2018-03-30 16:00:00', NULL),
(62, '286.00', '316.00', 39, '2018-03-30 16:00:00', NULL),
(63, '150.00', '180.00', 20, '2018-03-30 16:00:00', NULL),
(64, '186.00', '216.00', 27, '2018-03-30 16:00:00', NULL),
(65, '125.00', '155.00', 5, '2018-03-30 16:00:00', NULL),
(66, '125.00', '155.00', 27, '2018-03-30 16:00:00', NULL),
(67, '75.00', '105.00', 10, '2018-03-30 16:00:00', NULL),
(68, '75.00', '105.00', 24, '2018-03-30 16:00:00', NULL),
(69, '125.00', '155.00', 43, '2018-03-30 16:00:00', NULL),
(70, '125.00', '155.00', 48, '2018-03-30 16:00:00', NULL),
(71, '125.00', '155.00', 13, '2018-03-30 16:00:00', NULL),
(72, '125.00', '155.00', 26, '2018-03-30 16:00:00', NULL),
(73, '125.00', '155.00', 21, '2018-03-30 16:00:00', NULL),
(74, '125.00', '155.00', 43, '2018-03-30 16:00:00', NULL),
(75, '85.00', '115.00', 47, '2018-03-30 16:00:00', NULL),
(76, '85.00', '115.00', 45, '2018-03-30 16:00:00', NULL),
(77, '85.00', '115.00', 20, '2018-03-30 16:00:00', NULL),
(78, '125.00', '155.00', 6, '2018-03-30 16:00:00', NULL),
(79, '35.00', '65.00', 19, '2018-03-30 16:00:00', NULL),
(80, '35.00', '65.00', 19, '2018-03-30 16:00:00', NULL),
(81, '35.00', '65.00', 29, '2018-03-30 16:00:00', NULL),
(82, '1.00', '1.00', 8, '2018-03-30 16:00:00', NULL),
(83, '35.00', '65.00', 7, '2018-03-30 16:00:00', NULL),
(84, '90.00', '120.00', 36, '2018-03-30 16:00:00', NULL),
(85, '35.00', '65.00', 36, '2018-03-30 16:00:00', NULL),
(86, '35.00', '65.00', 2, '2018-03-30 16:00:00', NULL),
(87, '195.00', '225.00', 6, '2018-03-30 16:00:00', NULL),
(88, '403.00', '433.00', 7, '2018-03-30 16:00:00', NULL),
(89, '225.00', '255.00', 37, '2018-03-30 16:00:00', NULL),
(90, '225.00', '255.00', 5, '2018-03-30 16:00:00', NULL),
(91, '225.00', '255.00', 15, '2018-03-30 16:00:00', NULL),
(92, '225.00', '255.00', 22, '2018-03-30 16:00:00', NULL),
(93, '225.00', '255.00', 38, '2018-03-30 16:00:00', NULL),
(94, '403.00', '433.00', 4, '2018-03-30 16:00:00', NULL),
(95, '403.00', '433.00', 16, '2018-03-30 16:00:00', NULL),
(96, '37.00', '67.00', 17, '2018-03-30 16:00:00', NULL),
(97, '39.00', '69.00', 45, '2018-03-30 16:00:00', NULL),
(98, '25.00', '55.00', 25, '2018-03-30 16:00:00', NULL),
(99, '375.00', '405.00', 9, '2018-03-30 16:00:00', NULL),
(100, '375.00', '405.00', 37, '2018-03-30 16:00:00', NULL),
(101, '375.00', '405.00', 4, '2018-03-30 16:00:00', NULL),
(102, '375.00', '405.00', 8, '2018-03-30 16:00:00', NULL),
(103, '375.00', '405.00', 49, '2018-03-30 16:00:00', NULL),
(104, '375.00', '405.00', 43, '2018-03-30 16:00:00', NULL),
(105, '375.00', '405.00', 34, '2018-03-30 16:00:00', NULL),
(106, '53.00', '83.00', 26, '2018-03-30 16:00:00', NULL),
(107, '53.00', '83.00', 2, '2018-03-30 16:00:00', NULL),
(108, '53.00', '83.00', 17, '2018-03-30 16:00:00', NULL),
(109, '53.00', '83.00', 18, '2018-03-30 16:00:00', NULL),
(110, '53.00', '83.00', 1, '2018-03-30 16:00:00', NULL),
(111, '53.00', '83.00', 15, '2018-03-30 16:00:00', NULL),
(112, '53.00', '83.00', 2, '2018-03-30 16:00:00', NULL),
(113, '53.00', '83.00', 15, '2018-03-30 16:00:00', '2018-05-22 22:37:00'),
(114, '53.00', '83.00', 2, '2018-03-30 16:00:00', NULL),
(115, '150.00', '180.00', 4, '2018-03-30 16:00:00', NULL),
(116, '150.00', '180.00', 32, '2018-03-30 16:00:00', NULL),
(117, '150.00', '180.00', 18, '2018-03-30 16:00:00', NULL),
(118, '150.00', '180.00', 31, '2018-03-30 16:00:00', NULL),
(119, '95.00', '125.00', 8, '2018-03-30 16:00:00', NULL),
(120, '135.00', '165.00', 6, '2018-03-30 16:00:00', NULL),
(121, '125.00', '155.00', 9, '2018-03-30 16:00:00', NULL),
(122, '107.00', '137.00', 15, '2018-03-30 16:00:00', NULL),
(123, '180.00', '210.00', 44, '2018-03-30 16:00:00', NULL),
(124, '160.00', '190.00', 16, '2018-03-30 16:00:00', NULL),
(125, '55.00', '85.00', 15, '2018-03-30 16:00:00', NULL),
(126, '38.00', '68.00', 17, '2018-03-30 16:00:00', NULL),
(127, '45.00', '75.00', 34, '2018-03-30 16:00:00', NULL),
(128, '75.00', '105.00', 4, '2018-03-30 16:00:00', NULL),
(129, '19.50', '49.50', 10, '2018-03-30 16:00:00', NULL),
(130, '32.00', '62.00', 14, '2018-03-30 16:00:00', NULL),
(131, '19.50', '49.50', 47, '2018-03-30 16:00:00', NULL),
(132, '98.00', '128.00', 4, '2018-03-30 16:00:00', NULL),
(133, '89.00', '119.00', 29, '2018-03-30 16:00:00', NULL),
(134, '188.00', '218.00', 45, '2018-03-30 16:00:00', NULL),
(135, '188.00', '218.00', 18, '2018-03-30 16:00:00', NULL),
(136, '190.00', '220.00', 46, '2018-03-30 16:00:00', NULL),
(137, '190.00', '220.00', 37, '2018-03-30 16:00:00', NULL),
(138, '235.00', '265.00', 42, '2018-03-30 16:00:00', NULL),
(139, '235.00', '265.00', 42, '2018-03-30 16:00:00', NULL),
(140, '235.00', '265.00', 26, '2018-03-30 16:00:00', NULL),
(141, '300.00', '330.00', 34, '2018-03-30 16:00:00', NULL),
(142, '300.00', '330.00', 17, '2018-03-30 16:00:00', NULL),
(143, '300.00', '330.00', 32, '2018-03-30 16:00:00', NULL),
(144, '300.00', '330.00', 20, '2018-03-30 16:00:00', NULL),
(145, '300.00', '330.00', 48, '2018-03-30 16:00:00', NULL),
(146, '300.00', '330.00', 22, '2018-03-30 16:00:00', NULL),
(147, '1.00', '1.00', 10, '2018-03-30 16:00:00', NULL),
(148, '75.00', '105.00', 36, '2018-03-30 16:00:00', NULL),
(149, '75.00', '105.00', 26, '2018-03-30 16:00:00', NULL),
(150, '75.00', '105.00', 4, '2018-03-30 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `or_number` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`or_number`, `product_id`, `customer_name`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 113, 'Chris Hemsworth', '83.00', 5, '2018-04-05 16:00:00', NULL),
(1, 106, 'Chris Hemsworth', '83.00', 8, '2018-04-05 16:00:00', NULL),
(1, 114, 'Chris Hemsworth', '83.00', 6, '2018-04-05 16:00:00', NULL),
(2, 34, 'Mark Ruffalo', '150.00', 10, '2018-04-05 16:00:00', NULL),
(2, 27, 'Mark Ruffalo', '150.00', 1, '2018-04-05 16:00:00', NULL),
(2, 31, 'Mark Ruffalo', '150.00', 2, '2018-04-05 16:00:00', NULL),
(3, 5, 'Jeremy Renner', '180.00', 5, '2018-04-05 16:00:00', NULL),
(3, 33, 'Jeremy Renner', '150.00', 2, '2018-04-05 16:00:00', NULL),
(3, 25, 'Jeremy Renner', '150.00', 9, '2018-04-05 16:00:00', NULL),
(232, 112, 'wer', '83.00', 1, '2018-05-19 16:00:00', NULL),
(123, 112, 'qwe', '83.00', 1, '2018-05-19 16:00:00', NULL),
(13, 112, 'nbmb', '83.00', 1, '2018-05-19 16:00:00', NULL),
(12, 112, 'bnb', '83.00', 1, '2018-05-19 16:00:00', NULL),
(1234, 112, 'nbm', '83.00', 12, '2018-05-19 16:00:00', NULL),
(1234, 107, 'nbm', '83.00', 12, '2018-05-19 16:00:00', NULL),
(123124, 111, 'nmbm', '83.00', 2, '2018-05-19 16:00:00', NULL),
(23423423, 110, 'jhkhk', '83.00', 3, '2018-05-19 16:00:00', NULL),
(35345, 86, 'sfs', '65.00', 4, '2018-05-19 16:00:00', NULL),
(12312, 86, 'nbmbm', '65.00', 2, '2018-05-19 16:00:00', NULL),
(123456, 86, 'wsedfgv', '65.00', 3, '2018-05-19 16:00:00', NULL),
(12345, 107, 'awsxdfcgvhbj', '83.00', 2, '2018-05-19 16:00:00', NULL),
(2132, 108, 'asdfvb', '83.00', 10, '2018-05-19 16:00:00', NULL),
(213, 107, 'qwserdf', '83.00', 10, '2018-05-19 16:00:00', NULL),
(23456, 107, '234nvbn', '83.00', 12, '2018-05-20 16:00:00', NULL),
(23456, 108, '234nvbn', '83.00', 12, '2018-05-20 16:00:00', NULL),
(1232412, 86, 'vnnv', '65.00', 1, '2018-05-20 16:00:00', NULL),
(23465, 112, 'cvbmn', '83.00', 1, '2018-05-20 16:00:00', NULL),
(2423, 112, 'qweq', '83.00', 2, '2018-05-20 16:00:00', NULL),
(31312, 112, 'dsfsd', '83.00', 12, '2018-05-20 16:00:00', NULL),
(13123, 112, 'qweq', '83.00', 1, '2018-05-20 16:00:00', NULL),
(13123, 79, 'qweq', '65.00', 1, '2018-05-20 16:00:00', NULL),
(12321, 110, 'bmnbm', '83.00', 1, '2018-05-21 16:00:00', NULL),
(32131231, 110, 'nmbmbm', '83.00', 1, '2018-05-21 16:00:00', NULL),
(5446, 112, 'mnbmbm', '83.00', 1, '2018-05-21 16:00:00', NULL),
(3453535, 86, 'sdfgg', '65.00', 2, '2018-05-21 16:00:00', NULL),
(2312, 112, 'bnmbnm', '83.00', 1, '2018-05-21 16:00:00', NULL),
(345, 113, 'gvjvjh', '83.00', 11, '2018-05-21 16:00:00', NULL),
(345, 106, 'gvjvjh', '83.00', 1, '2018-05-21 16:00:00', NULL),
(4564, 109, 'ghfhgf', '83.00', 1, '2018-05-21 16:00:00', NULL),
(4564, 113, 'ghfhgf', '83.00', 1, '2018-05-21 16:00:00', NULL),
(123217868, 107, 'bnbmn', '83.00', 3, '2018-05-21 16:00:00', NULL),
(3213213, 107, 'bmnb', '83.00', 1, '2018-05-21 16:00:00', NULL),
(1111, 107, 'aa', '83.00', 1, '2018-05-21 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `stock_adjustments_id` int(11) NOT NULL,
  `employee_name` varchar(191) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('damaged','damaged_salable','lost') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_adjustments`
--

INSERT INTO `stock_adjustments` (`stock_adjustments_id`, `employee_name`, `product_id`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 108, 10, 'lost', '2018-04-13 16:00:00', NULL),
(2, 'ADMIN', 108, 10, 'damaged', '2018-04-13 16:00:00', NULL),
(3, 'ADMIN', 111, 1, 'damaged', '2018-05-21 16:00:00', NULL),
(4, 'ADMIN', 111, 1, 'damaged', '2018-05-21 16:00:00', NULL),
(5, 'ADMIN', 133, 1, 'damaged', '2018-05-21 16:00:00', NULL),
(6, 'Juan Dela Cruz', 133, 1, 'damaged', '2018-05-21 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` bigint(12) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `contact_number`, `email`, `address`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Juan Dela Cruz', 12345678910, 'juan@gmail.com', 'Baguio City', '$2y$10$42YUopt2iioh0B1XGdudh.ascJghH7XSwugZw0R4JtqSq1GX5ND9O', '7Mw5m2J5j4OvmaTU551t9b9s0Y0CxK6nicspA8sg3956ZBLU8wx4Wvcrihb8', '2018-04-02 04:36:26', '2018-04-02 07:24:26', 'active'),
(2, 'mmm', 8765412345678, 'mnm@nmmn.com', 'mknb n', '$2y$10$ZFWMkZ2FvkwxSBeNuzfGoeOikJKBw39TBuUtvwCJARS2Iy1dh7EZ6', NULL, '2018-05-19 09:31:00', '2018-05-19 09:31:00', 'active'),
(3, 'mera', 12453679, 'mera@gmail.com', 'asda', '$2y$10$GKHx/q0IJ4BnINc19oG1Se3bNGTAPGFNgHudvaCuqeS5s5Zat3Uxy', NULL, '2018-05-20 03:16:02', '2018-05-20 03:16:02', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `damaged_items`
--
ALTER TABLE `damaged_items`
  ADD KEY `di_prodID_idx` (`product_id`);

--
-- Indexes for table `damaged_salable_items`
--
ALTER TABLE `damaged_salable_items`
  ADD KEY `dsi_prodID_idx` (`product_id`);

--
-- Indexes for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD KEY `pid_lost_items_idx` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `physical_count_items`
--
ALTER TABLE `physical_count_items`
  ADD UNIQUE KEY `product_id_UNIQUE` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `products_product_id_unique` (`product_id`),
  ADD UNIQUE KEY `products_description_unique` (`description`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD KEY `purchases_product_id_foreign` (`product_id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD KEY `pid_return_idx` (`product_id`),
  ADD KEY `prodID_return_idx` (`product_id`);

--
-- Indexes for table `salable_items`
--
ALTER TABLE `salable_items`
  ADD KEY `si_prodID_idx` (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD KEY `sales_product_id_foreign` (`product_id`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`stock_adjustments_id`),
  ADD UNIQUE KEY `stock_adjustments_id_UNIQUE` (`stock_adjustments_id`),
  ADD KEY `sa_product_id_idx` (`product_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `stock_adjustments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `damaged_items`
--
ALTER TABLE `damaged_items`
  ADD CONSTRAINT `di_prodID` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `damaged_salable_items`
--
ALTER TABLE `damaged_salable_items`
  ADD CONSTRAINT `dsi_prodID` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD CONSTRAINT `pid_lost_item` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `physical_count_items`
--
ALTER TABLE `physical_count_items`
  ADD CONSTRAINT `physical_count_pID` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `prodID_return` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salable_items`
--
ALTER TABLE `salable_items`
  ADD CONSTRAINT `si_prodID` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD CONSTRAINT `sa_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
