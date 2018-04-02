-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2018 at 10:50 AM
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
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ADMIN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `name`) VALUES
(1, 'abalos@pm.com', '$2y$10$p0b4tVjZC1nQ1zn76BDE9OT85grz5OCwVMCUfx0yFf4sPzsoRjixq', 'odm2Awmxus3wR0yj32w57zkwJ9eamAhWUf3FMETSfRROrgTFBr5jjnqiuUth', '2018-02-24 21:39:36', '2018-02-24 21:39:36', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `damaged_items`
--

CREATE TABLE `damaged_items` (
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damaged_items`
--

INSERT INTO `damaged_items` (`product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 25, '2018-03-31 04:42:40', NULL),
(2, 25, '2018-03-31 04:43:28', NULL),
(3, 25, '2018-03-31 04:43:55', NULL),
(2, 5, '2018-03-31 07:53:44', NULL),
(1, 50, '2018-03-31 15:03:02', NULL);

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
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lost_items`
--

INSERT INTO `lost_items` (`product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 3, '2018-03-31 21:45:40', NULL),
(1, 3, '2018-03-31 21:56:25', NULL),
(1, 1, '2018-03-31 21:56:54', NULL),
(3, 2, '2018-03-31 16:00:00', NULL),
(4, 1, '2018-03-31 16:00:00', NULL),
(2, 5, '2018-03-31 16:00:00', NULL),
(1, 1, '2018-03-31 16:00:00', NULL),
(3, 2, '2018-03-31 16:00:00', NULL),
(1, 1, '2018-03-31 16:00:00', NULL),
(4, 1, '2018-04-01 16:00:00', NULL);

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
(10, '2018_02_24_081458_create_admins_table', 2);

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
('inactive', '2018-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `physical_count_items`
--

CREATE TABLE `physical_count_items` (
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physical_count_items`
--

INSERT INTO `physical_count_items` (`product_id`, `quantity`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0);

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
(1, 'Item 1', 'available', 10, '2018-03-31 04:37:09', '2018-03-31 04:37:09'),
(2, 'Item 2', 'available', 10, '2018-03-31 04:37:16', '2018-03-31 04:37:16'),
(3, 'Item/3', 'available', 10, '2018-03-31 04:37:27', '2018-03-31 04:37:27'),
(4, 'Item 4', 'available', 10, '2018-03-31 20:08:56', '2018-03-31 20:08:56');

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
('1', 1, 'Supplier 1', 100, '100.00', '2018-03-30 15:00:00', NULL),
('2', 2, 'Supplier 2', 100, '100.00', '2018-03-30 15:00:00', NULL),
('3', 3, 'Supplier 3', 100, '100.00', '2018-03-30 15:00:00', NULL),
('4', 1, 'item', 100, '1.00', '2018-03-30 16:00:00', NULL),
('5', 1, 'supplier 5', 1, '500.00', '2018-04-29 16:00:00', NULL),
('5', 2, 'supplier 5', 1, '600.00', '2018-04-29 16:00:00', NULL),
('5', 3, 'supplier 5', 1, '700.00', '2018-04-29 16:00:00', NULL),
('6', 1, 'Supplier 6', 50, '1000.00', '2018-03-31 16:00:00', NULL),
('6', 2, 'Supplier 6', 29, '2000.00', '2018-03-31 16:00:00', NULL),
('6', 3, 'Supplier 6', 24, '3000.00', '2018-03-31 16:00:00', NULL),
('7', 1, 'Supplier 7', 99, '100.00', '2018-03-31 16:00:00', NULL),
('7', 2, 'Supplier 7', 100, '200.00', '2018-03-31 16:00:00', NULL),
('7', 3, 'Supplier 7', 150, '300.00', '2018-03-31 16:00:00', NULL),
('8', 1, 'Supplier 8', 1, '50.00', '2018-03-31 16:00:00', NULL),
('8', 2, 'Supplier 8', 1, '60.00', '2018-03-31 16:00:00', NULL),
('8', 3, 'Supplier 8', 1, '70.00', '2018-03-31 16:00:00', NULL);

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
(1, 1, 'Customer 1', '200.00', 25, '2018-03-31 13:42:40', NULL),
(2, 2, 'Customer 2', '200.00', 25, '2018-03-31 13:43:28', NULL),
(3, 3, 'Customer 3', '200.00', 25, '2018-03-31 13:43:55', NULL),
(2, 2, 'Customer 2', '200.00', 5, '2018-03-31 15:53:43', NULL),
(1, 1, 'Customer 1', '200.00', 50, '2018-03-31 23:03:01', NULL);

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
(1, '50.00', '200.00', 0, '2018-03-31 04:37:09', '2018-03-31 04:37:09'),
(2, '60.00', '200.00', 149, '2018-03-31 04:37:16', '2018-03-31 04:37:16'),
(3, '70.00', '200.00', 196, '2018-03-31 04:37:27', '2018-03-31 04:37:27'),
(4, '0.00', '0.00', 0, '2018-03-31 20:08:56', '2018-03-31 20:08:56');

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
(1, 1, 'Customer 1', '200.00', 50, '2018-03-31 04:41:45', NULL),
(2, 2, 'Customer 2', '200.00', 50, '2018-03-31 04:41:57', NULL),
(3, 3, 'Customer 3', '200.00', 50, '2018-03-31 04:42:07', NULL),
(190, 1, 'Minehayashi', '200.00', 125, '2018-03-31 07:11:26', NULL),
(5, 1, 'Kenneth Jaramel', '200.00', 101, '2018-03-31 21:47:36', NULL),
(123412, 3, 'Kenneth Jaramel', '200.00', 1, '2018-03-31 21:48:47', NULL),
(1234, 3, 'jake manzon10th', '200.00', 4, '2018-04-01 02:27:24', NULL),
(1234, 2, 'jake manzon10th', '200.00', 2, '2018-04-01 02:27:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
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

INSERT INTO `stock_adjustments` (`employee_name`, `product_id`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
('ADMIN', 1, 3, 'damaged', '2018-03-31 16:00:00', NULL),
('ADMIN', 1, 3, 'damaged', '2018-03-31 16:00:00', NULL),
('ADMIN', 1, 1, 'lost', '2018-03-31 16:00:00', NULL),
('ADMIN', 3, 2, 'damaged', '2018-03-31 16:00:00', NULL),
('ADMIN', 4, 1, 'lost', '2018-03-31 16:00:00', NULL),
('ADMIN', 2, 5, 'lost', '2018-03-31 16:00:00', NULL),
('ADMIN', 1, 1, 'damaged', '2018-03-31 16:00:00', NULL),
('ADMIN', 3, 2, 'lost', '2018-03-31 16:00:00', NULL),
('ADMIN', 1, 1, 'lost', '2018-03-31 16:00:00', NULL),
('ADMIN', 4, 1, 'lost', '2018-04-01 16:00:00', NULL);

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
(1, 'Manel', 9876543210, 'nel@nel.com', 'mnm', '$2y$10$roDdyicLV0ywnkSMasilbe3wItIX4aXDQ3fjiPqZHPCIBZ1vvjdrS', 'RDX740dmG9RwP8BpqE3usSK0c599yvuAQTRkhTCAKBo3T4iCPqzJhIu0abuV', '2018-03-31 07:22:06', '2018-03-31 20:03:37', 'active');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
