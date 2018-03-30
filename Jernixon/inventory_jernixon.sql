-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2018 at 03:19 PM
-- Server version: 5.7.21-log
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ADMIN',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `name`) VALUES
(1, 'abalos@pm.com', '$2y$10$p0b4tVjZC1nQ1zn76BDE9OT85grz5OCwVMCUfx0yFf4sPzsoRjixq', 'ojo7x2pHnOWQ4KijSYtti1hgyenmpmf4mV3jmSTaIsqkNAxmR5AIpd0JTeyN', '2018-02-24 21:39:36', '2018-02-24 21:39:36', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_info` int(11) DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customers_customer_id_unique` (`customer_id`),
  UNIQUE KEY `customers_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `address`, `contact_info`, `email`, `created_at`, `updated_at`) VALUES
(1, 'romero', 'baguio', 123123123, 'romero@jernixon.com', '2018-03-23 15:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `damaged_items`
--

DROP TABLE IF EXISTS `damaged_items`;
CREATE TABLE IF NOT EXISTS `damaged_items` (
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  KEY `di_prodID_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `damaged_salable_items`
--

DROP TABLE IF EXISTS `damaged_salable_items`;
CREATE TABLE IF NOT EXISTS `damaged_salable_items` (
  `product_id` int(11) NOT NULL,
  `wholesale_price` decimal(7,2) NOT NULL,
  `retail_price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  KEY `dsi_prodID_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(10, '2018_02_24_081458_create_admins_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `physical_count`
--

DROP TABLE IF EXISTS `physical_count`;
CREATE TABLE IF NOT EXISTS `physical_count` (
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `date` date NOT NULL DEFAULT '2017-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `physical_count_items`
--

DROP TABLE IF EXISTS `physical_count_items`;
CREATE TABLE IF NOT EXISTS `physical_count_items` (
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `product_id_UNIQUE` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('available','unavailable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `reorder_level` int(11) NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `products_product_id_unique` (`product_id`),
  UNIQUE KEY `products_description_unique` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `description`, `status`, `reorder_level`, `created_at`, `updated_at`) VALUES
(2, 'lenovo g40', 'available', 10, '2018-01-25 05:56:54', '2018-01-25 05:56:54'),
(3, 'smartBroLte', 'unavailable', 10, '2018-02-01 05:46:59', '2018-02-01 05:46:59'),
(4, 'windowsPhone', 'available', 10, '2018-02-01 05:48:32', '2018-02-01 05:48:32'),
(7, 'lenovo g40 li-on battery', 'unavailable', 10, '2018-02-16 05:15:56', '2018-02-16 05:15:56'),
(8, 'mouse pad', 'unavailable', 10, '2018-02-18 22:06:46', '2018-02-18 22:06:46'),
(9, 'sampel', 'unavailable', 10, '2018-02-21 22:17:23', '2018-02-21 22:17:23'),
(10, 'maple', 'unavailable', 10, '2018-02-22 00:05:14', '2018-02-22 00:05:14'),
(11, 'asd', 'unavailable', 10, '2018-02-22 19:19:41', '2018-02-22 19:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `po_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `purchases_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`po_id`, `product_id`, `supplier_name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, '1', 100, '50.00', '2018-03-24 15:00:00', NULL),
(2, 4, '1', 500, '500.00', '2018-03-24 15:00:00', NULL),
(3, 7, 'Romero', 5, '100.00', '2018-03-28 16:00:00', NULL),
(3, 2, 'Romero', 5, '200.00', '2018-03-28 16:00:00', NULL),
(3, 11, 'Romero', 5, '300.00', '2018-03-28 16:00:00', NULL),
(4, 2, 'Antero', 10, '100.00', '2018-03-28 15:00:00', NULL),
(4, 7, 'Antero', 10, '150.00', '2018-03-28 15:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

DROP TABLE IF EXISTS `returns`;
CREATE TABLE IF NOT EXISTS `returns` (
  `or_number` int(11) NOT NULL,
  `product_id_return` int(11) NOT NULL,
  `product_id_exchange` int(11) NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `pid_return_idx` (`product_id_return`),
  KEY `pid_exchange_idx` (`product_id_exchange`),
  KEY `prodID_return_idx` (`product_id_return`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`or_number`, `product_id_return`, `product_id_exchange`, `customer_name`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '1', '100.00', 10, '2018-03-24 15:00:00', NULL),
(2, 4, 4, '1', '500.00', 1, '2018-03-24 15:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salable_items`
--

DROP TABLE IF EXISTS `salable_items`;
CREATE TABLE IF NOT EXISTS `salable_items` (
  `product_id` int(11) NOT NULL,
  `wholesale_price` decimal(7,2) NOT NULL,
  `retail_price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  KEY `si_prodID_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salable_items`
--

INSERT INTO `salable_items` (`product_id`, `wholesale_price`, `retail_price`, `quantity`) VALUES
(2, '50.00', '100.00', 5),
(4, '100.00', '500.00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `or_number` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `sales_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`or_number`, `product_id`, `customer_name`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2, '1', '100.00', 5, '2018-03-24 15:00:00', NULL),
(10001, 2, 'Nonito', '100.00', 5, '2018-03-27 23:29:22', NULL),
(10001, 4, 'Nonito', '500.00', 2, '2018-03-27 23:29:22', NULL),
(10002, 2, 'Romero', '100.00', 5, '2018-03-28 19:53:07', NULL),
(10003, 2, 'Manzon', '100.00', 5, '2018-03-28 19:56:12', NULL),
(10004, 2, 'Manzon', '100.00', 5, '2018-03-28 19:59:43', NULL),
(10004, 4, 'Manzon', '500.00', 1, '2018-03-28 19:59:43', NULL),
(10005, 2, 'Jaramel', '100.00', 10, '2018-03-28 20:10:10', NULL),
(10005, 4, 'Jaramel', '500.00', 5, '2018-03-28 20:10:10', NULL),
(97123, 4, 'jake', '500.00', 2, '2018-03-28 20:24:40', NULL),
(98231, 4, 'jakejames', '500.00', 1, '2018-03-28 20:26:28', NULL),
(98231, 2, 'jakejames', '100.00', 1, '2018-03-28 20:26:28', NULL),
(12313, 4, 'afef', '500.00', 1, '2018-03-28 20:35:44', NULL),
(12, 4, 'afe', '500.00', 2, '2018-03-28 20:37:36', NULL),
(312313123, 4, 'lakefasf', '500.00', 1, '2018-03-28 20:41:03', NULL),
(312313123, 2, 'lakefasf', '100.00', 2, '2018-03-28 20:41:03', NULL),
(111111, 4, 'manzon3rd', '500.00', 2, '2018-03-28 20:42:07', NULL),
(111111, 2, 'manzon3rd', '100.00', 2, '2018-03-28 20:42:07', NULL),
(2131313, 4, 'manzon4th', '500.00', 2, '2018-03-28 20:43:36', NULL),
(2131313, 2, 'manzon4th', '100.00', 2, '2018-03-28 20:43:36', NULL),
(313213, 4, 'manzon5th', '500.00', 3, '2018-03-28 20:45:04', NULL),
(313213, 2, 'manzon5th', '100.00', 3, '2018-03-28 20:45:04', NULL),
(523523, 4, 'ljaseif', '500.00', 2, '2018-03-28 20:49:38', NULL),
(213131, 4, 'afseaeff', '500.00', 3, '2018-03-28 20:55:51', NULL),
(34124, 2, 'fasfa', '100.00', 3, '2018-03-28 20:57:15', NULL),
(213, 4, 'faesfsa', '500.00', 2, '2018-03-28 20:58:38', NULL),
(414, 4, 'afsef', '500.00', 22, '2018-03-28 20:59:28', NULL),
(22, 4, 'faes', '500.00', 2, '2018-03-28 21:01:16', NULL),
(231, 4, 's1231', '500.00', 2, '2018-03-28 21:01:52', NULL),
(3333, 4, 'aaseaff', '500.00', 3, '2018-03-28 21:03:46', NULL),
(33, 4, 'ssgd', '500.00', 3, '2018-03-28 21:04:20', NULL),
(2222, 4, 'asfa', '500.00', 2, '2018-03-28 21:05:44', NULL),
(2121, 4, 'fasfas', '500.00', 3, '2018-03-28 21:08:18', NULL),
(98142, 4, 'jakejfa', '500.00', 1, '2018-03-28 21:30:52', NULL),
(2131, 2, 'faf', '100.00', 2, '2018-03-28 21:32:26', NULL),
(10007, 4, 'Caesar', '500.00', 5, '2018-03-28 21:34:31', NULL),
(10007, 2, 'Caesar', '100.00', 100, '2018-03-28 21:34:31', NULL),
(10008, 2, 'Romero', '100.00', 100, '2018-03-28 21:35:14', NULL),
(10008, 4, 'Romero', '500.00', 5, '2018-03-28 21:35:14', NULL),
(10009, 2, 'Antero', '100.00', 10, '2018-03-29 02:54:20', NULL),
(10009, 4, 'Antero', '500.00', 1, '2018-03-29 02:54:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

DROP TABLE IF EXISTS `stock_adjustments`;
CREATE TABLE IF NOT EXISTS `stock_adjustments` (
  `employee_name` varchar(191) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('damaged','damaged_salable','lost') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `sa_product_id_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_adjustments`
--

INSERT INTO `stock_adjustments` (`employee_name`, `product_id`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
('ADMIN', 2, 2, 'damaged', '2018-03-25 03:09:07', NULL),
('jakejames', 4, 1, 'damaged_salable', '2018-03-25 03:09:07', NULL),
('ADMIN', 3, 1, 'lost', '2018-03-25 03:09:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`supplier_id`),
  UNIQUE KEY `suppliers_supplier_id_unique` (`supplier_id`),
  UNIQUE KEY `suppliers_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `address`, `email`, `contact_number`, `created_at`, `updated_at`) VALUES
(1, 'manzon', 'slu', 'manzon@jernoxon.com', 123123123, '2018-03-23 15:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` bigint(12) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `contact_number`, `email`, `address`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(2, 'jakejames', NULL, 'jakejames@example.com', 'slu', '$2y$10$HJRHxgFX5yW41EJGTzyJuuTwYpKelK.MF7cLq8U03FcRkQZ/MX1L6', 'cRrBee7QyQcjCzrdojRu0IMeEcbrvNImfCBv9hdP5Cd7ijC8pDvsfwOtPWUB', '2018-02-23 23:41:35', '2018-03-29 06:08:20', 'active'),
(3, 'jake', 41231233, 'jake@email.com', 'asfeasf', '$2y$10$C3ePSMow8ZeUTIcjagk0vO1H.le3pje/uVMHriUzSXadaMFS/FB8S', NULL, '2018-03-28 21:12:21', '2018-03-28 21:12:21', 'active'),
(4, 'Antero', 12345678910, 'antero@jernixon', 'tuba', '$2y$10$XO5Aith74cKQYGSxVUnYguky99DS.6ii6clzJ079xY0uWJGEYXhkS', NULL, '2018-03-29 03:47:48', '2018-03-29 03:47:48', 'active');

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
  ADD CONSTRAINT `prodID_return` FOREIGN KEY (`product_id_return`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
