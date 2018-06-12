DROP TABLE admins;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ADMIN',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

<<<<<<< HEAD
INSERT INTO admins VALUES("1","ADMIN","admin@gmail.com","$2y$10$HpGuCVm2xV4cuj62m0dVaekc4xbDxazwNdHwUCq3XE2R2mBbfFvOW","WRN7lHAo3iWNOPvvhCcr3naXlysNzDbLBXY9gu1AqpOeEQyhxe65fVBgwFLq","2018-02-25 05:39:36","2018-02-25 05:39:36");
=======
INSERT INTO admins VALUES("1","ADMIN","admin@gmail.com","$2y$10$HpGuCVm2xV4cuj62m0dVaekc4xbDxazwNdHwUCq3XE2R2mBbfFvOW","ACxKDXgg2nSwmsjLNi2rKKKirNMZiFZmnDZysEHtuVAJRe5J58QeMZpDyK6Z","2018-02-25 05:39:36","2018-02-25 05:39:36");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE categories;

CREATE TABLE `categories` (
  `categoryname` varchar(45) NOT NULL,
  PRIMARY KEY (`categoryname`),
  UNIQUE KEY `categoryname_UNIQUE` (`categoryname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO categories VALUES("Accessories");
INSERT INTO categories VALUES("Air Intake & Fuel Delivery");
INSERT INTO categories VALUES("bbb");
INSERT INTO categories VALUES("Body & Frame");
INSERT INTO categories VALUES("Brakes");
INSERT INTO categories VALUES("Clutch Accessories");
INSERT INTO categories VALUES("Decals & Emblems");
INSERT INTO categories VALUES("Electrical Wirings");
INSERT INTO categories VALUES("Electronics");
INSERT INTO categories VALUES("Engine & Engine Parts");
INSERT INTO categories VALUES("Exhaust");
INSERT INTO categories VALUES("Lighting");
INSERT INTO categories VALUES("Luggage");
<<<<<<< HEAD
INSERT INTO categories VALUES("New category");
INSERT INTO categories VALUES("Oils");
INSERT INTO categories VALUES("Other Motor Parts");
INSERT INTO categories VALUES("Seating");
INSERT INTO categories VALUES("this is the category");
=======
INSERT INTO categories VALUES("Oils");
INSERT INTO categories VALUES("Other Motor Parts");
INSERT INTO categories VALUES("Seating");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO categories VALUES("Transmission");



DROP TABLE damaged_items;

CREATE TABLE `damaged_items` (
  `stock_adjustments_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `di_prodID_idx` (`product_id`),
  CONSTRAINT `di_prodID` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
INSERT INTO damaged_items VALUES("","160","1","2018-06-08 22:26:58","");
INSERT INTO damaged_items VALUES("","85","1","2018-06-11 14:49:57","");
=======
INSERT INTO damaged_items VALUES("","82","-12","2018-06-08 00:34:00","");
INSERT INTO damaged_items VALUES("","79","1","2018-06-08 03:50:00","");
INSERT INTO damaged_items VALUES("","83","1","2018-06-20 12:22:00","");
INSERT INTO damaged_items VALUES("","125","1","2018-06-09 12:10:00","");
INSERT INTO damaged_items VALUES("","116","1","2018-06-09 12:10:00","");
INSERT INTO damaged_items VALUES("","130","76","2018-06-09 12:13:00","");
INSERT INTO damaged_items VALUES("","108","-29","2018-06-09 12:13:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE damaged_salable_items;

CREATE TABLE `damaged_salable_items` (
  `damaged_salable_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `damaged_selling_price` decimal(7,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `damaged_salable_id_UNIQUE` (`damaged_salable_id`),
  KEY `dsi_prodID_idx` (`product_id`),
  CONSTRAINT `dsi_prodID` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
<<<<<<< HEAD
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO damaged_salable_items VALUES("1","160","100.00","1","2018-06-11 15:22:59","");
=======
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO damaged_salable_items VALUES("26","151","200.00","-6","2018-06-08 09:38:38","");
INSERT INTO damaged_salable_items VALUES("27","149","105.00","0","2018-06-08 09:49:04","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE lost_items;

CREATE TABLE `lost_items` (
  `stock_adjustments_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `pid_lost_items_idx` (`product_id`),
  CONSTRAINT `pid_lost_item` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
=======
INSERT INTO lost_items VALUES("1","109","1","2018-05-30 19:14:00","");
INSERT INTO lost_items VALUES("12","154","1","2018-05-31 17:15:00","");
INSERT INTO lost_items VALUES("18","108","1","2018-06-05 12:18:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("1","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("2","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("3","2018_01_25_134750_create_accounts_table","1");
INSERT INTO migrations VALUES("4","2018_01_25_134949_create_suppliers_table","1");
INSERT INTO migrations VALUES("5","2018_01_25_135011_create_customers_table","1");
INSERT INTO migrations VALUES("6","2018_01_25_135029_create_products_table","1");
INSERT INTO migrations VALUES("7","2018_01_25_135046_create_purchases_table","1");
INSERT INTO migrations VALUES("8","2018_01_25_135104_create_returns_table","1");
INSERT INTO migrations VALUES("9","2018_01_25_135123_create_sales_table","1");
INSERT INTO migrations VALUES("10","2018_02_24_081458_create_admins_table","2");
INSERT INTO migrations VALUES("11","2018_05_19_155942_create_notifications_table","3");



DROP TABLE model;

CREATE TABLE `model` (
  `modelname` varchar(45) NOT NULL,
  PRIMARY KEY (`modelname`),
  UNIQUE KEY `modelname_UNIQUE` (`modelname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO model VALUES("Aura");
INSERT INTO model VALUES("Bajaj");
INSERT INTO model VALUES("Barako");
INSERT INTO model VALUES("bbb");
INSERT INTO model VALUES("BC175");
INSERT INTO model VALUES("C100");
INSERT INTO model VALUES("Crypton");
INSERT INTO model VALUES("CT100");
INSERT INTO model VALUES("Fury");
INSERT INTO model VALUES("Generic");
INSERT INTO model VALUES("GP125");
INSERT INTO model VALUES("Lifan");
INSERT INTO model VALUES("Mio");
INSERT INTO model VALUES("Motor Star");
<<<<<<< HEAD
INSERT INTO model VALUES("New Model");
=======
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO model VALUES("Raider");
INSERT INTO model VALUES("RS100");
INSERT INTO model VALUES("Rusi");
INSERT INTO model VALUES("Shogun");
INSERT INTO model VALUES("Smash");
INSERT INTO model VALUES("Sniper");
INSERT INTO model VALUES("STX");
<<<<<<< HEAD
INSERT INTO model VALUES("this is the model");
=======
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO model VALUES("TMX");
INSERT INTO model VALUES("Wave");
INSERT INTO model VALUES("Wind");
INSERT INTO model VALUES("XLR");
INSERT INTO model VALUES("XRM");



DROP TABLE notifications;

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

<<<<<<< HEAD
INSERT INTO notifications VALUES("25f79af7-25af-47b4-8a80-49ed2b2ccc58","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":1,\"description\":\"Brake Master Repair Kit Shogun\"}","","2018-06-11 16:28:48","2018-06-11 16:28:48");
INSERT INTO notifications VALUES("29f78ac1-b263-4278-8e10-ffbec9a7f994","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":5,\"description\":\"Brake Master Repair Kit Shogun\"}","","2018-06-11 13:11:48","2018-06-11 13:11:48");
INSERT INTO notifications VALUES("367591c5-77af-44df-a929-f47b19c96e36","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":2,\"description\":\"Brake Master Repair Kit Shogun\"}","2018-06-12 12:49:29","2018-06-11 16:28:48","2018-06-12 12:49:29");
INSERT INTO notifications VALUES("4c6a139b-8cf5-478d-acaa-d9a959aaefa6","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Wave125\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Customer two\"}","","2018-06-11 14:49:57","2018-06-11 14:49:57");
INSERT INTO notifications VALUES("5794cb23-8c3d-4faa-ac96-bfb8b23a9bbf","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":0,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-09 02:04:47","2018-06-09 02:04:47");
INSERT INTO notifications VALUES("5e653f76-0bd8-415e-9613-4c2dafbe80ad","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":4,\"description\":\"Brake Master Repair Kit Shogun\"}","","2018-06-11 13:30:06","2018-06-11 13:30:06");
INSERT INTO notifications VALUES("688f446c-c5f2-47cb-954b-4f041eb92305","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"New Item\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"James\"}","","2018-06-08 22:26:59","2018-06-08 22:26:59");
INSERT INTO notifications VALUES("736fb78a-f91f-48d0-9166-d9fe8491a742","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":0,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-09 02:04:46","2018-06-09 02:04:46");
INSERT INTO notifications VALUES("9204c0b6-5eb1-4653-b46b-668786faad53","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":1,\"description\":\"Brake Master Repair Kit Shogun\"}","2018-06-11 16:32:16","2018-06-11 16:28:48","2018-06-11 16:32:16");
INSERT INTO notifications VALUES("98413652-d94f-491b-9201-1f870247cef9","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"New Item\",\"quantity\":\"1\",\"type\":\"Damaged Salable Items\",\"Customer\":\"James\"}","","2018-06-11 15:23:00","2018-06-11 15:23:00");
INSERT INTO notifications VALUES("9c95c529-0d62-450c-8df2-9b65a1c60f8e","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":0,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-09 02:04:46","2018-06-09 02:04:46");
INSERT INTO notifications VALUES("9d7b1ef5-9d28-4995-9d0f-35e3cbda8932","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":5,\"description\":\"Brake Master Repair Kit Shogun\"}","","2018-06-11 13:11:48","2018-06-11 13:11:48");
INSERT INTO notifications VALUES("ba7810b8-86c3-47ee-975c-bf8a24241d2d","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":5,\"description\":\"Brake Master Repair Kit Shogun\"}","","2018-06-11 13:11:48","2018-06-11 13:11:48");
INSERT INTO notifications VALUES("be0c430f-9b5d-4537-b383-ea9d9baf07ea","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":2,\"description\":\"Brake Master Repair Kit Shogun\"}","","2018-06-11 16:28:48","2018-06-11 16:28:48");
INSERT INTO notifications VALUES("bf6f57ae-84f2-4418-bf68-837617649a87","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":1,\"description\":\"Brake Master Repair Kit Shogun\"}","","2018-06-11 16:28:48","2018-06-11 16:28:48");
INSERT INTO notifications VALUES("d61a833c-510b-4aaa-82b6-a507150a3591","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":4,\"description\":\"Brake Master Repair Kit Shogun\"}","","2018-06-11 13:30:06","2018-06-11 13:30:06");
INSERT INTO notifications VALUES("f055f642-d79b-4a16-b2be-ed27fa6f56bb","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":2,\"description\":\"Brake Master Repair Kit Shogun\"}","","2018-06-11 16:28:48","2018-06-11 16:28:48");
INSERT INTO notifications VALUES("f07d625c-da7a-436a-b237-ee591d3491d4","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":4,\"description\":\"Brake Master Repair Kit Shogun\"}","","2018-06-11 13:30:06","2018-06-11 13:30:06");
=======
INSERT INTO notifications VALUES("05c4c92c-1fcc-493a-a0fa-96802d1f82b3","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set TMXCDI\",\"quantity\":\"1\",\"type\":\"Damaged Salable Items\",\"Customer\":\"Jake James\"}","","2018-06-08 10:37:11","2018-06-08 10:37:11");
INSERT INTO notifications VALUES("08dc25b1-6df9-4ed9-8596-eccaef5812a3","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":5,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-08 04:48:04","2018-06-08 04:48:04");
INSERT INTO notifications VALUES("0e2d16cd-e5ad-4c66-8de1-a7832ad460e1","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Brake Master Repair Kit GLPRO\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-08 07:06:04","2018-06-08 07:06:04");
INSERT INTO notifications VALUES("102302b6-63a2-4a51-9b3a-28e5611ee1b2","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 100\",\"quantity\":\"1\",\"type\":\"Damaged Salable Items\",\"Customer\":\"c1\"}","","2018-06-08 09:38:39","2018-06-08 09:38:39");
INSERT INTO notifications VALUES("13fa0bec-b9a3-46f3-b599-5d3ea1c8232e","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Brake Master Repair Kit GLPRO\",\"stock_id\":35}","","2018-06-09 12:13:52","2018-06-09 12:13:52");
INSERT INTO notifications VALUES("14cf2045-8971-4062-bdcd-a2955c3234ce","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":3,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-08 06:12:23","2018-06-08 06:12:23");
INSERT INTO notifications VALUES("1568115e-afab-4d69-a6c9-f3404c005b9f","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush XRM\",\"stock_id\":32}","","2018-06-09 00:34:57","2018-06-09 00:34:57");
INSERT INTO notifications VALUES("18eafbd6-8bd7-4d59-bac3-95a793085cd5","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set TMX CPT.\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"aaa\"}","","2018-06-08 10:26:35","2018-06-08 10:26:35");
INSERT INTO notifications VALUES("1a98022f-ac64-45e7-afee-fdc28092ef53","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":5,\"description\":\"Connecting Rod KitSTX\"}","","2018-06-08 08:24:50","2018-06-08 08:24:50");
INSERT INTO notifications VALUES("2341005b-3150-431e-b469-38dce88d9bd7","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set CG125\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-08 10:29:05","2018-06-08 10:29:05");
INSERT INTO notifications VALUES("263c1116-a971-44af-8bb5-4b9761fc8733","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 100\",\"quantity\":\"1\",\"type\":\"Undamaged Item\",\"Customer\":\"c1\"}","","2018-06-08 08:48:22","2018-06-08 08:48:22");
INSERT INTO notifications VALUES("292c0cb5-8202-45ba-8010-b1795af9c2b1","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set XRM\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-08 10:37:11","2018-06-08 10:37:11");
INSERT INTO notifications VALUES("37a158de-45d5-4b30-aab9-53a93b19cf08","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 100\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"c1\"}","","2018-06-08 08:41:05","2018-06-08 08:41:05");
INSERT INTO notifications VALUES("38cb90c7-f923-4335-b71a-9303db0244b4","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":2,\"description\":\"Valve Guide Set XRM\"}","","2018-06-08 09:48:46","2018-06-08 09:48:46");
INSERT INTO notifications VALUES("3a52ed9c-159c-4840-854b-70d6e57d4314","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":5,\"description\":\"Valve Guide Set CG125\"}","","2018-06-08 10:07:07","2018-06-08 10:07:07");
INSERT INTO notifications VALUES("3d9df6ad-0d6a-48a9-88ad-619357e06277","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":3,\"description\":\"Valve Guide Set CG125\"}","","2018-06-08 10:36:53","2018-06-08 10:36:53");
INSERT INTO notifications VALUES("3dc9ebff-aca2-46c8-a1be-ad5d1f018fe6","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Brake Master Repair Kit GLPRO\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"James\"}","","2018-06-08 07:57:50","2018-06-08 07:57:50");
INSERT INTO notifications VALUES("4f32c6f0-cc17-4135-bc3f-8beba2334cf2","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 100\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-07 07:29:20","2018-06-07 07:29:20");
INSERT INTO notifications VALUES("556d6556-9008-4e95-92a3-effce1a91ae0","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":2,\"description\":\"Valve Guide Set CG125\"}","","2018-06-08 10:47:30","2018-06-08 10:47:30");
INSERT INTO notifications VALUES("577dd632-6cec-46a8-b5ad-33b1570a9792","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil CT00\",\"stock_id\":35}","","2018-06-09 12:10:55","2018-06-09 12:10:55");
INSERT INTO notifications VALUES("5b2bea59-40d1-49d6-a969-7a96bf9e8bf8","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":5,\"description\":\"Valve Guide Set CG125\"}","","2018-06-08 10:07:07","2018-06-08 10:07:07");
INSERT INTO notifications VALUES("620f7de2-06f8-4f66-aca1-d35403a187bd","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set TMXCDI\",\"quantity\":\"1\",\"type\":\"Damaged Salable Items\",\"Customer\":\"aaa\"}","","2018-06-08 09:49:04","2018-06-08 09:49:04");
INSERT INTO notifications VALUES("62890b3d-eef4-4766-9214-8fa0d362c5e0","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 40\",\"quantity\":\"1\",\"type\":\"Damaged Salable Items\",\"Customer\":\"James\"}","","2018-06-08 07:15:02","2018-06-08 07:15:02");
INSERT INTO notifications VALUES("632309ae-ce39-4aec-b2ea-ccb991c25705","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Brake Master Repair Kit GLPRO\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"James\"}","","2018-06-08 07:59:47","2018-06-08 07:59:47");
INSERT INTO notifications VALUES("656e3995-afc7-48fc-9d6d-1211dec49979","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set CG125\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"aaa\"}","","2018-06-08 09:52:52","2018-06-08 09:52:52");
INSERT INTO notifications VALUES("74f1ae03-1da1-4a50-b7d6-34b25f635687","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":2,\"description\":\"Valve Guide Set XRM\"}","","2018-06-08 09:48:46","2018-06-08 09:48:46");
INSERT INTO notifications VALUES("7739a43d-cd30-496c-bd5f-2e7c49016ba6","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":0,\"description\":\"Brake Master Repair Kit Mio\"}","","2018-06-08 04:48:24","2018-06-08 04:48:24");
INSERT INTO notifications VALUES("778e8f84-90c7-4c62-9bdf-1a128470fa4e","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Brake Master Repair Kit GLPRO\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-08 06:32:51","2018-06-08 06:32:51");
INSERT INTO notifications VALUES("7c11cfdc-d53f-4bdf-8ef3-d1b7aa21d636","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitSTX\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-08 08:30:37","2018-06-08 08:30:37");
INSERT INTO notifications VALUES("842ce940-d535-4530-b24a-84d59c09056c","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set TMX CPT.\",\"quantity\":\"1\",\"type\":\"Undamaged Item\",\"Customer\":\"aaa\"}","","2018-06-08 09:52:53","2018-06-08 09:52:53");
INSERT INTO notifications VALUES("8b7fba80-838d-4f0a-a1ce-5a2b96fe41f1","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Sniper\",\"stock_id\":35}","","2018-06-09 03:50:48","2018-06-09 03:50:48");
INSERT INTO notifications VALUES("8ea5da83-bf9f-40f8-9b70-f55d4e0f3e8e","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carburador Insulator BC175\",\"stock_id\":35}","","2018-06-09 12:13:52","2018-06-09 12:13:52");
INSERT INTO notifications VALUES("91b7cb1a-5a7a-493a-a4a0-817dbbc6877d","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":2,\"description\":\"Valve Guide Set CG125\"}","","2018-06-08 10:47:30","2018-06-08 10:47:30");
INSERT INTO notifications VALUES("93afd0bd-23c0-4935-8561-623cc3280153","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set TMXCDI\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","2018-06-12 00:27:34","2018-06-08 12:43:05","2018-06-12 00:27:34");
INSERT INTO notifications VALUES("94186a27-5119-4f1a-9b6c-971397745e02","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":0,\"description\":\"Brake Master Repair Kit Mio\"}","","2018-06-08 04:48:24","2018-06-08 04:48:24");
INSERT INTO notifications VALUES("96953813-ab9a-4be2-bc05-250bc765d8c5","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":5,\"description\":\"Connecting Rod KitSTX\"}","","2018-06-08 08:27:37","2018-06-08 08:27:37");
INSERT INTO notifications VALUES("96bccdc2-70ef-48b9-a540-f3f8d0896ea8","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":2,\"description\":\"Valve Guide Set CG125\"}","","2018-06-08 10:47:30","2018-06-08 10:47:30");
INSERT INTO notifications VALUES("98b195e4-94ad-45d6-9fb5-db784348ade6","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 100\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"c2\"}","","2018-06-08 08:50:43","2018-06-08 08:50:43");
INSERT INTO notifications VALUES("9c5b7b5e-bfe3-4828-a63b-1ba32df0dd5f","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Crypton\",\"stock_id\":31}","","2018-06-09 00:33:40","2018-06-09 00:33:40");
INSERT INTO notifications VALUES("9e5484e5-6623-411b-91c0-19052851ba95","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":4,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-08 06:09:44","2018-06-08 06:09:44");
INSERT INTO notifications VALUES("a2b8d673-02b3-44c0-804f-03666afe66eb","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 100\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"c1\"}","","2018-06-08 08:35:01","2018-06-08 08:35:01");
INSERT INTO notifications VALUES("a6372cc4-703f-45b6-a5a3-a7ecd8c4b39a","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set XRM\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"aaa\"}","","2018-06-08 09:52:53","2018-06-08 09:52:53");
INSERT INTO notifications VALUES("a64c2f2c-a791-4227-aef5-5890b9dcabc6","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set TMXCDI\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-08 10:39:55","2018-06-08 10:39:55");
INSERT INTO notifications VALUES("a6d6523a-3bac-49a0-9e04-cd00fb80df01","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":5,\"description\":\"Connecting Rod KitSTX\"}","","2018-06-08 08:24:50","2018-06-08 08:24:50");
INSERT INTO notifications VALUES("a6f88914-f452-4741-9af6-01129edb87a1","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":5,\"description\":\"Connecting Rod KitSTX\"}","","2018-06-08 08:27:37","2018-06-08 08:27:37");
INSERT INTO notifications VALUES("a9567edf-b920-4257-9092-4ee68c576c6f","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set XRM\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"aaa\"}","","2018-06-08 09:49:04","2018-06-08 09:49:04");
INSERT INTO notifications VALUES("aadaa34d-5193-4a22-990d-dd2b8390a820","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Mio\",\"stock_id\":34}","","2018-06-09 03:50:25","2018-06-09 03:50:25");
INSERT INTO notifications VALUES("aaf2743b-c0cd-4eb0-b89c-d8e4fb64f74e","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":5,\"description\":\"Valve Guide Set CG125\"}","","2018-06-08 10:07:07","2018-06-08 10:07:07");
INSERT INTO notifications VALUES("ab529fa8-a9b1-4155-9c78-e1fc51902887","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set TMX CPT.\",\"quantity\":\"1\",\"type\":\"Undamaged Item\",\"Customer\":\"aaa\"}","","2018-06-08 09:49:04","2018-06-08 09:49:04");
INSERT INTO notifications VALUES("ad45026a-633f-4f22-aa29-bedcb1cda356","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Brake Master Repair Kit Trinity\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Marinel\"}","","2018-06-07 07:16:42","2018-06-07 07:16:42");
INSERT INTO notifications VALUES("aeed6d8f-56a3-43f1-88e2-e2abcc82f7ee","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":5,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-08 04:48:04","2018-06-08 04:48:04");
INSERT INTO notifications VALUES("af9b6e80-43c5-47cd-a3e1-7f7aa2081529","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Sniper\",\"stock_id\":\"30\"}","2018-06-06 06:12:31","2018-06-06 03:10:43","2018-06-06 06:12:31");
INSERT INTO notifications VALUES("b3b11398-eb5e-4f9a-81cc-7cbd7155ba61","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":3,\"description\":\"Valve Guide Set CG125\"}","","2018-06-08 10:36:53","2018-06-08 10:36:53");
INSERT INTO notifications VALUES("b3ddc061-9f4c-4894-9bfe-4076fc069b1b","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Mio\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Joshua\"}","","2018-06-08 06:35:50","2018-06-08 06:35:50");
INSERT INTO notifications VALUES("b49c6974-24d3-46c5-abf0-2f7b96b29ade","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitSTX\",\"quantity\":\"1\",\"type\":\"Damaged Salable Items\",\"Customer\":\"Jake James Manzon\"}","","2018-06-08 08:23:41","2018-06-08 08:23:41");
INSERT INTO notifications VALUES("b4a2b969-fb4e-4099-b2fd-9816c469e80e","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":0,\"description\":\"Valve Guide Set XRM\"}","","2018-06-08 10:36:54","2018-06-08 10:36:54");
INSERT INTO notifications VALUES("b5895406-c933-4ed0-a041-2f3414948714","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"item3\",\"quantity\":\"1\",\"type\":\"Damaged Salable Items\",\"Customer\":\"Ban\"}","","2018-06-08 07:15:47","2018-06-08 07:15:47");
INSERT INTO notifications VALUES("b7ade799-fde2-4f06-b49d-9a433f6cb1fa","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Mio\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Joshua\"}","","2018-06-08 06:38:26","2018-06-08 06:38:26");
INSERT INTO notifications VALUES("bf263d88-e1c8-4f86-bfc5-0dce5c878f80","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":5,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-08 04:48:04","2018-06-08 04:48:04");
INSERT INTO notifications VALUES("c022fa85-f4eb-4927-bc3f-0ecf44a1a9e2","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 100\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Joshua\"}","","2018-06-08 06:34:16","2018-06-08 06:34:16");
INSERT INTO notifications VALUES("c22e5413-691c-4d0d-816b-906fa4e1fd21","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":5,\"description\":\"Connecting Rod KitSTX\"}","","2018-06-08 08:24:50","2018-06-08 08:24:50");
INSERT INTO notifications VALUES("c35a00b3-b651-4e18-a080-6be235747d2c","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set CG125\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-08 10:37:11","2018-06-08 10:37:11");
INSERT INTO notifications VALUES("c6e8af4d-fd1c-4105-8fb6-ff9e2503e84b","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 40\",\"quantity\":\"1\",\"type\":\"Damaged Salable Items\",\"Customer\":\"James\"}","","2018-06-08 07:28:19","2018-06-08 07:28:19");
INSERT INTO notifications VALUES("c873fffc-02fd-4a59-bb2d-ce1411450641","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":5,\"description\":\"Connecting Rod KitSTX\"}","","2018-06-08 08:27:37","2018-06-08 08:27:37");
INSERT INTO notifications VALUES("cbf042f3-831e-4fba-842c-aae957ba0f61","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Brake Master Repair Kit GLPRO\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-07 07:20:04","2018-06-07 07:20:04");
INSERT INTO notifications VALUES("cdce1d37-cd42-46f5-a17c-4df332509f9d","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":0,\"description\":\"Valve Guide Set XRM\"}","","2018-06-08 10:36:54","2018-06-08 10:36:54");
INSERT INTO notifications VALUES("cf50d586-fdf9-47ca-97d0-9023524a7456","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":0,\"description\":\"Brake Master Repair Kit Mio\"}","","2018-06-08 04:48:24","2018-06-08 04:48:24");
INSERT INTO notifications VALUES("cfe1254c-2272-4233-b443-da5c92c25b6b","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set CG125\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"aaa\"}","","2018-06-08 09:49:03","2018-06-08 09:49:03");
INSERT INTO notifications VALUES("d22eea59-f760-47c8-82a8-caaa63c297c3","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 100\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"c1\"}","","2018-06-08 08:34:43","2018-06-08 08:34:43");
INSERT INTO notifications VALUES("d4cd6710-a6cd-45fd-bd5b-51e5b5123227","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set TMX CPT.\",\"quantity\":\"1\",\"type\":\"Undamaged Item\",\"Customer\":\"Jake James\"}","","2018-06-08 10:37:11","2018-06-08 10:37:11");
INSERT INTO notifications VALUES("d4d425bb-ff35-44df-9524-dd08035623c6","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":2,\"description\":\"Valve Guide Set XRM\"}","","2018-06-08 09:48:46","2018-06-08 09:48:46");
INSERT INTO notifications VALUES("d73f1e4b-6c9c-4bed-b2e5-48aca7426dce","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set CG125\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-08 10:41:36","2018-06-08 10:41:36");
INSERT INTO notifications VALUES("d92b1f55-845b-4208-b526-5c2fc6013232","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set XRM\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-08 10:46:00","2018-06-08 10:46:00");
INSERT INTO notifications VALUES("dd03375e-1eaf-4f9d-8d96-0abe527aa125","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set TMXCDI\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James\"}","","2018-06-08 10:23:58","2018-06-08 10:23:58");
INSERT INTO notifications VALUES("e2060189-2bb7-49f3-ab53-112b02919c09","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":4,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-08 06:09:44","2018-06-08 06:09:44");
INSERT INTO notifications VALUES("e47eb813-a306-49ed-b700-f3d06fd58053","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":3,\"description\":\"Valve Guide Set CG125\"}","","2018-06-08 10:36:53","2018-06-08 10:36:53");
INSERT INTO notifications VALUES("e601bc72-f8ca-4e0d-86d9-e2b202f59997","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":0,\"description\":\"Valve Guide Set XRM\"}","","2018-06-08 10:36:54","2018-06-08 10:36:54");
INSERT INTO notifications VALUES("e747d57c-c1e3-4836-9400-e146c467b048","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush XRM\",\"stock_id\":33}","","2018-06-09 00:35:25","2018-06-09 00:35:25");
INSERT INTO notifications VALUES("e8b37445-bab4-4b9f-8416-f4b8d3066394","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 40\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"James\"}","","2018-06-07 07:33:15","2018-06-07 07:33:15");
INSERT INTO notifications VALUES("e8db0b8f-938c-46df-a727-48496ba7a22a","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitSTX\",\"quantity\":\"1\",\"type\":\"Undamaged Item\",\"Customer\":\"Jake James\"}","","2018-06-08 08:25:47","2018-06-08 08:25:47");
INSERT INTO notifications VALUES("eb41f8b2-4fab-447d-88e7-52bae1c34427","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Item 40\",\"quantity\":\"1\",\"type\":\"Undamaged Item\",\"Customer\":\"Jake James\"}","","2018-06-08 07:43:00","2018-06-08 07:43:00");
INSERT INTO notifications VALUES("ebbfb843-c482-438a-b3f0-b56519791030","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set CG125\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"aaa\"}","","2018-06-08 10:27:35","2018-06-08 10:27:35");
INSERT INTO notifications VALUES("ed4c456b-ea36-472b-96b0-f8db8789e126","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Mio\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James Manzon\"}","","2018-06-08 07:44:59","2018-06-08 07:44:59");
INSERT INTO notifications VALUES("f34a98a8-69ef-4e90-8573-012a3fbb09bb","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":3,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-08 06:12:23","2018-06-08 06:12:23");
INSERT INTO notifications VALUES("f65bec68-45de-4aaa-b0c4-9d0e7cfef3c4","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Valve Guide Set TMXCDI\",\"quantity\":\"1\",\"type\":\"Damaged Salable Items\",\"Customer\":\"aaa\"}","","2018-06-08 09:52:53","2018-06-08 09:52:53");
INSERT INTO notifications VALUES("f89df56e-e1ce-442d-9f17-4535a2ae80ed","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":3,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-08 06:12:23","2018-06-08 06:12:23");
INSERT INTO notifications VALUES("fb0f65de-2063-4bf8-9ea7-98d13c878f22","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":4,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-08 06:09:44","2018-06-08 06:09:44");
INSERT INTO notifications VALUES("fbab497d-e541-4b44-8993-d7eab11c7091","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carburador Insulator GY6125\",\"stock_id\":35}","","2018-06-09 12:10:54","2018-06-09 12:10:54");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE physical_count_items;

CREATE TABLE `physical_count_items` (
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `product_id_UNIQUE` (`product_id`),
  CONSTRAINT `physical_count_pID` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO physical_count_items VALUES("1","0");
INSERT INTO physical_count_items VALUES("2","0");
INSERT INTO physical_count_items VALUES("3","0");
INSERT INTO physical_count_items VALUES("4","0");
INSERT INTO physical_count_items VALUES("5","0");
INSERT INTO physical_count_items VALUES("6","0");
INSERT INTO physical_count_items VALUES("7","0");
INSERT INTO physical_count_items VALUES("8","0");
INSERT INTO physical_count_items VALUES("9","0");
INSERT INTO physical_count_items VALUES("10","0");
INSERT INTO physical_count_items VALUES("11","0");
INSERT INTO physical_count_items VALUES("12","0");
INSERT INTO physical_count_items VALUES("13","0");
INSERT INTO physical_count_items VALUES("14","0");
INSERT INTO physical_count_items VALUES("15","0");
INSERT INTO physical_count_items VALUES("16","0");
INSERT INTO physical_count_items VALUES("17","0");
INSERT INTO physical_count_items VALUES("18","0");
INSERT INTO physical_count_items VALUES("19","0");
INSERT INTO physical_count_items VALUES("20","0");
INSERT INTO physical_count_items VALUES("21","0");
INSERT INTO physical_count_items VALUES("22","0");
INSERT INTO physical_count_items VALUES("23","0");
INSERT INTO physical_count_items VALUES("24","0");
INSERT INTO physical_count_items VALUES("25","0");
INSERT INTO physical_count_items VALUES("26","0");
INSERT INTO physical_count_items VALUES("27","0");
INSERT INTO physical_count_items VALUES("28","0");
INSERT INTO physical_count_items VALUES("29","0");
INSERT INTO physical_count_items VALUES("30","0");
INSERT INTO physical_count_items VALUES("31","0");
INSERT INTO physical_count_items VALUES("32","0");
INSERT INTO physical_count_items VALUES("33","0");
INSERT INTO physical_count_items VALUES("34","0");
INSERT INTO physical_count_items VALUES("35","0");
INSERT INTO physical_count_items VALUES("36","0");
INSERT INTO physical_count_items VALUES("37","0");
INSERT INTO physical_count_items VALUES("38","0");
INSERT INTO physical_count_items VALUES("39","0");
INSERT INTO physical_count_items VALUES("40","0");
INSERT INTO physical_count_items VALUES("41","0");
INSERT INTO physical_count_items VALUES("42","0");
INSERT INTO physical_count_items VALUES("43","0");
INSERT INTO physical_count_items VALUES("44","0");
INSERT INTO physical_count_items VALUES("45","0");
INSERT INTO physical_count_items VALUES("46","0");
INSERT INTO physical_count_items VALUES("47","0");
INSERT INTO physical_count_items VALUES("48","0");
INSERT INTO physical_count_items VALUES("49","0");
INSERT INTO physical_count_items VALUES("50","0");
INSERT INTO physical_count_items VALUES("51","0");
INSERT INTO physical_count_items VALUES("52","0");
INSERT INTO physical_count_items VALUES("53","0");
INSERT INTO physical_count_items VALUES("54","0");
INSERT INTO physical_count_items VALUES("55","0");
INSERT INTO physical_count_items VALUES("56","0");
INSERT INTO physical_count_items VALUES("57","0");
INSERT INTO physical_count_items VALUES("58","0");
INSERT INTO physical_count_items VALUES("59","0");
INSERT INTO physical_count_items VALUES("60","0");
INSERT INTO physical_count_items VALUES("61","0");
INSERT INTO physical_count_items VALUES("62","0");
INSERT INTO physical_count_items VALUES("63","0");
INSERT INTO physical_count_items VALUES("64","0");
INSERT INTO physical_count_items VALUES("65","0");
INSERT INTO physical_count_items VALUES("66","0");
INSERT INTO physical_count_items VALUES("67","0");
INSERT INTO physical_count_items VALUES("68","0");
INSERT INTO physical_count_items VALUES("69","0");
INSERT INTO physical_count_items VALUES("70","0");
INSERT INTO physical_count_items VALUES("71","0");
INSERT INTO physical_count_items VALUES("72","0");
INSERT INTO physical_count_items VALUES("73","0");
INSERT INTO physical_count_items VALUES("74","0");
INSERT INTO physical_count_items VALUES("75","0");
INSERT INTO physical_count_items VALUES("76","0");
INSERT INTO physical_count_items VALUES("77","0");
INSERT INTO physical_count_items VALUES("78","0");
INSERT INTO physical_count_items VALUES("79","0");
INSERT INTO physical_count_items VALUES("80","0");
INSERT INTO physical_count_items VALUES("81","0");
INSERT INTO physical_count_items VALUES("82","0");
INSERT INTO physical_count_items VALUES("83","0");
INSERT INTO physical_count_items VALUES("84","0");
INSERT INTO physical_count_items VALUES("85","0");
INSERT INTO physical_count_items VALUES("86","0");
INSERT INTO physical_count_items VALUES("87","0");
INSERT INTO physical_count_items VALUES("88","0");
INSERT INTO physical_count_items VALUES("89","0");
INSERT INTO physical_count_items VALUES("90","0");
INSERT INTO physical_count_items VALUES("91","0");
INSERT INTO physical_count_items VALUES("92","0");
INSERT INTO physical_count_items VALUES("93","0");
INSERT INTO physical_count_items VALUES("94","0");
INSERT INTO physical_count_items VALUES("95","0");
INSERT INTO physical_count_items VALUES("96","0");
INSERT INTO physical_count_items VALUES("97","0");
INSERT INTO physical_count_items VALUES("98","0");
INSERT INTO physical_count_items VALUES("99","0");
INSERT INTO physical_count_items VALUES("100","0");
INSERT INTO physical_count_items VALUES("101","0");
INSERT INTO physical_count_items VALUES("102","0");
INSERT INTO physical_count_items VALUES("103","0");
INSERT INTO physical_count_items VALUES("104","0");
INSERT INTO physical_count_items VALUES("105","0");
INSERT INTO physical_count_items VALUES("106","0");
INSERT INTO physical_count_items VALUES("107","3");
INSERT INTO physical_count_items VALUES("108","4");
INSERT INTO physical_count_items VALUES("109","3");
INSERT INTO physical_count_items VALUES("110","0");
INSERT INTO physical_count_items VALUES("111","0");
INSERT INTO physical_count_items VALUES("112","0");
INSERT INTO physical_count_items VALUES("113","3");
INSERT INTO physical_count_items VALUES("114","0");
INSERT INTO physical_count_items VALUES("115","0");
INSERT INTO physical_count_items VALUES("116","0");
INSERT INTO physical_count_items VALUES("117","0");
INSERT INTO physical_count_items VALUES("118","0");
INSERT INTO physical_count_items VALUES("119","0");
INSERT INTO physical_count_items VALUES("120","0");
INSERT INTO physical_count_items VALUES("121","0");
INSERT INTO physical_count_items VALUES("122","0");
INSERT INTO physical_count_items VALUES("123","0");
INSERT INTO physical_count_items VALUES("124","0");
INSERT INTO physical_count_items VALUES("125","0");
INSERT INTO physical_count_items VALUES("126","0");
INSERT INTO physical_count_items VALUES("127","0");
INSERT INTO physical_count_items VALUES("128","0");
INSERT INTO physical_count_items VALUES("129","0");
INSERT INTO physical_count_items VALUES("130","0");
INSERT INTO physical_count_items VALUES("131","0");
INSERT INTO physical_count_items VALUES("132","0");
INSERT INTO physical_count_items VALUES("133","0");
INSERT INTO physical_count_items VALUES("134","0");
INSERT INTO physical_count_items VALUES("135","0");
INSERT INTO physical_count_items VALUES("136","0");
INSERT INTO physical_count_items VALUES("137","0");
INSERT INTO physical_count_items VALUES("138","0");
INSERT INTO physical_count_items VALUES("139","0");
INSERT INTO physical_count_items VALUES("140","0");
INSERT INTO physical_count_items VALUES("141","0");
INSERT INTO physical_count_items VALUES("142","0");
INSERT INTO physical_count_items VALUES("143","0");
INSERT INTO physical_count_items VALUES("144","0");
INSERT INTO physical_count_items VALUES("145","0");
INSERT INTO physical_count_items VALUES("146","0");
INSERT INTO physical_count_items VALUES("147","0");
INSERT INTO physical_count_items VALUES("148","0");
INSERT INTO physical_count_items VALUES("149","0");
INSERT INTO physical_count_items VALUES("150","0");
INSERT INTO physical_count_items VALUES("151","0");
INSERT INTO physical_count_items VALUES("152","0");
INSERT INTO physical_count_items VALUES("153","0");
INSERT INTO physical_count_items VALUES("154","0");
<<<<<<< HEAD
INSERT INTO physical_count_items VALUES("159","0");
INSERT INTO physical_count_items VALUES("160","0");
=======
INSERT INTO physical_count_items VALUES("158","0");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE physical_counts;

CREATE TABLE `physical_counts` (
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `date` date NOT NULL DEFAULT '2017-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO physical_counts VALUES("inactive","2018-06-03");



DROP TABLE products;

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('available','unavailable') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `reorder_level` int(11) NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `modelname` varchar(45) DEFAULT NULL,
  `categoryname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `products_product_id_unique` (`product_id`),
  KEY `model_idx` (`modelname`),
  KEY `category_idx` (`categoryname`),
  CONSTRAINT `category` FOREIGN KEY (`categoryname`) REFERENCES `categories` (`categoryname`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `model` FOREIGN KEY (`modelname`) REFERENCES `model` (`modelname`) ON DELETE NO ACTION ON UPDATE NO ACTION
<<<<<<< HEAD
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;
=======
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f

INSERT INTO products VALUES("1","Connecting Rod KitXRM110","available","5","2018-03-01 00:00:00","","XRM","Body & Frame");
INSERT INTO products VALUES("2","Connecting Rod KitBILP/HD3","available","5","2018-03-01 00:00:00","","Barako","Body & Frame");
INSERT INTO products VALUES("3","Connecting Rod KitSMASH","available","5","2018-03-01 00:00:00","","Smash","Body & Frame");
INSERT INTO products VALUES("4","Connecting Rod KitXLR","available","5","2018-03-01 00:00:00","","XLR","Body & Frame");
INSERT INTO products VALUES("5","Connecting Rod KitBARAKO 175","available","5","2018-03-01 00:00:00","","Barako","Body & Frame");
INSERT INTO products VALUES("6","Connecting Rod KitSTX","available","5","2018-03-01 00:00:00","","STX","Body & Frame");
INSERT INTO products VALUES("7","Connecting Rod KitDT125","available","5","2018-03-01 00:00:00","","","Body & Frame");
INSERT INTO products VALUES("8","Connecting Rod KitSHOGUN","available","5","2018-03-01 00:00:00","","Shogun","Body & Frame");
INSERT INTO products VALUES("9","Connecting Rod KitRUSI 150","available","5","2018-03-01 00:00:00","","Rusi","Body & Frame");
INSERT INTO products VALUES("10","Connecting Rod KitX4/GP125","available","5","2018-03-01 00:00:00","","GP125","Body & Frame");
INSERT INTO products VALUES("11","Stator Assy.STX 8 COILS","available","5","2018-03-01 00:00:00","","STX","Electrical Wirings");
INSERT INTO products VALUES("12","Stator Assy.STX 16 COILS","available","5","2018-03-01 00:00:00","","STX","Electrical Wirings");
INSERT INTO products VALUES("13","Stator Assy.LIFAN125","available","5","2018-03-01 00:00:00","","Lifan","Electrical Wirings");
INSERT INTO products VALUES("14","Stator Assy.BC175","available","5","2018-03-01 00:00:00","","BC175","Electrical Wirings");
INSERT INTO products VALUES("15","Stator Assy.C100","available","5","2018-03-01 00:00:00","","C100","Electrical Wirings");
INSERT INTO products VALUES("16","Stator Assy.TMX-CP","available","5","2018-03-01 00:00:00","","TMX","Electrical Wirings");
INSERT INTO products VALUES("17","Stator Assy.XLR 200/GS185/150","available","5","2018-03-01 00:00:00","","XLR","Electrical Wirings");
INSERT INTO products VALUES("18","Stator Assy.MOTOR STAR","available","5","2018-03-01 00:00:00","","Motor Star","Electrical Wirings");
INSERT INTO products VALUES("19","Stator Assy.WAVE125","available","5","2018-03-01 00:00:00","","Wave","Electrical Wirings");
INSERT INTO products VALUES("20","Stator Assy.LIFAN150","available","5","2018-03-01 00:00:00","","Lifan","Electrical Wirings");
INSERT INTO products VALUES("21","Stator Assy.XRM110","available","5","2018-03-01 00:00:00","","XRM","Electrical Wirings");
INSERT INTO products VALUES("22","Stator Assy.TMX-CDI W/BASE","available","5","2018-03-01 00:00:00","","TMX","Electrical Wirings");
INSERT INTO products VALUES("23","Clutch LiningLIFAN110","available","5","2018-03-01 00:00:00","","Lifan","Clutch Accessories");
INSERT INTO products VALUES("24","Clutch LiningXRM110","available","5","2018-03-01 00:00:00","","XRM","Clutch Accessories");
INSERT INTO products VALUES("25","Clutch LiningTMX","available","5","2018-03-01 00:00:00","","TMX","Clutch Accessories");
INSERT INTO products VALUES("26","Clutch LiningWAVE125","available","5","2018-03-01 00:00:00","","Wave","Clutch Accessories");
INSERT INTO products VALUES("27","Clutch LiningCRYPTON","available","5","2018-03-01 00:00:00","","Crypton","Clutch Accessories");
INSERT INTO products VALUES("28","Clutch LiningRS100","available","5","2018-03-01 00:00:00","","RS100","Clutch Accessories");
INSERT INTO products VALUES("29","Clutch LiningSTX","available","5","2018-03-01 00:00:00","","STX","Clutch Accessories");
INSERT INTO products VALUES("30","Clutch LiningHD3/B1LP","available","5","2018-03-01 00:00:00","","","Clutch Accessories");
INSERT INTO products VALUES("31","Clutch LiningBS175","available","5","2018-03-01 00:00:00","","Generic","Clutch Accessories");
INSERT INTO products VALUES("32","Clutch LiningAURA","available","5","2018-03-01 00:00:00","","Aura","Clutch Accessories");
INSERT INTO products VALUES("33","Clutch LiningWIND125","available","5","2018-03-01 00:00:00","","Wind","Clutch Accessories");
INSERT INTO products VALUES("34","Clutch LiningCT100/BAJAJ","available","5","2018-03-01 00:00:00","","CT100","Clutch Accessories");
INSERT INTO products VALUES("35","Clutch LiningX4/GP125","available","5","2018-03-01 00:00:00","","GP125","Clutch Accessories");
INSERT INTO products VALUES("36","Clutch LiningB120/SMASH","available","5","2018-03-01 00:00:00","","Smash","Clutch Accessories");
INSERT INTO products VALUES("37","Clutch LiningG7S","available","5","2018-03-01 00:00:00","","","Clutch Accessories");
INSERT INTO products VALUES("38","CDI UnitTMX155","available","5","2018-03-01 00:00:00","","TMX","Electrical Wirings");
INSERT INTO products VALUES("39","CDI UnitC100","available","5","2018-03-01 00:00:00","","C100","Electrical Wirings");
INSERT INTO products VALUES("40","CDI UnitWAVE125-CDI 5 Pins","available","5","2018-03-01 00:00:00","","Wave","Electrical Wirings");
INSERT INTO products VALUES("41","CDI UnitXRM110 5 Pins","available","5","2018-03-01 00:00:00","","XRM","Electrical Wirings");
INSERT INTO products VALUES("42","CDI UnitCRYPTON","available","5","2018-03-01 00:00:00","","Crypton","Electrical Wirings");
INSERT INTO products VALUES("43","Pulser CoilCT100","available","5","2018-03-01 00:00:00","","CT100","Electrical Wirings");
INSERT INTO products VALUES("44","Pulser CoilBC175","available","5","2018-03-01 00:00:00","","BC175","Electrical Wirings");
INSERT INTO products VALUES("45","Pulser CoilCRYPTON","available","5","2018-03-01 00:00:00","","Crypton","Electrical Wirings");
INSERT INTO products VALUES("46","Pulser CoilLifan100","available","5","2018-03-01 00:00:00","","Lifan","Electrical Wirings");
INSERT INTO products VALUES("47","Pulser CoilLifan150","available","5","2018-03-01 00:00:00","","Lifan","Electrical Wirings");
INSERT INTO products VALUES("48","Pulser CoilTMX-CDI TYPE","available","5","2018-03-01 00:00:00","","TMX","Electrical Wirings");
INSERT INTO products VALUES("49","Regulator 4 Wires","available","5","2018-03-01 00:00:00","","","Electrical Wirings");
INSERT INTO products VALUES("50","Regulator 5 Wires","available","5","2018-03-01 00:00:00","","Generic","Electrical Wirings");
INSERT INTO products VALUES("51","Regulator Raider J","available","5","2018-03-01 00:00:00","","Raider","Electrical Wirings");
INSERT INTO products VALUES("52","Regulator Rectifier Barako","available","5","2018-03-01 00:00:00","","Barako","Electrical Wirings");
INSERT INTO products VALUES("53","Regulator Rectifier Crypton","available","5","2018-03-01 00:00:00","","Crypton","Electrical Wirings");
INSERT INTO products VALUES("54","Regulator Rectifier CT100","available","5","2018-03-01 00:00:00","","CT100","Electrical Wirings");
INSERT INTO products VALUES("55","Regulator Rectifier GS125","available","5","2018-03-01 00:00:00","","","Electrical Wirings");
INSERT INTO products VALUES("56","Regulator Rectifier Mio","available","5","2018-03-01 00:00:00","","Mio","Electrical Wirings");
INSERT INTO products VALUES("57","Regulator Rectifier RS100 12v WWII","available","5","2018-03-01 00:00:00","","RS100","Electrical Wirings");
INSERT INTO products VALUES("58","Regulator Rectifier  Smash","available","5","2018-03-01 00:00:00","","Smash","Electrical Wirings");
INSERT INTO products VALUES("59","Regulator Rectifier Wave100","available","5","2018-03-01 00:00:00","","Wave","Electrical Wirings");
INSERT INTO products VALUES("60","Regulator Rectifier Wave110/XRM","available","5","2018-03-01 00:00:00","","XRM","Electrical Wirings");
INSERT INTO products VALUES("61","Regulator Rectifier Wind125","available","5","2018-03-01 00:00:00","","Wind","Electrical Wirings");
INSERT INTO products VALUES("62","Regulator Rectifier Rusi/TC125 4+1 WII","available","5","2018-03-01 00:00:00","","Rusi","Electrical Wirings");
INSERT INTO products VALUES("63","Regulator Rectifier C100","available","5","2018-03-01 00:00:00","","C100","Electrical Wirings");
INSERT INTO products VALUES("64","Regulator Rectifier TMX","available","5","2018-03-01 00:00:00","","TMX","Electrical Wirings");
INSERT INTO products VALUES("65","Fuel Cock B1LP/HD3","available","5","2018-03-01 00:00:00","","","Air Intake & Fuel Delivery");
INSERT INTO products VALUES("66","Fuel Cock BC175","available","5","2018-03-01 00:00:00","","BC175","Air Intake & Fuel Delivery");
INSERT INTO products VALUES("67","Fuel Cock C100/Dream/XRM","available","5","2018-03-01 00:00:00","","XRM","Air Intake & Fuel Delivery");
INSERT INTO products VALUES("68","Fuel Cock CG125","available","5","2018-03-01 00:00:00","","","Air Intake & Fuel Delivery");
INSERT INTO products VALUES("69","Fuel Cock Crypton","available","5","2018-03-01 00:00:00","","Crypton","Air Intake & Fuel Delivery");
INSERT INTO products VALUES("70","Fuel Cock G75","available","5","2018-03-01 00:00:00","","Generic","Air Intake & Fuel Delivery");
INSERT INTO products VALUES("71","Fuel Cock GP125/X4/X120","available","5","2018-03-01 00:00:00","","GP125","Air Intake & Fuel Delivery");
INSERT INTO products VALUES("72","Magneto Kit TMX Silicon Gray","available","5","2018-03-01 00:00:00","","TMX","Other Motor Parts");
INSERT INTO products VALUES("73","Magneto Kit XRM Silicon-Red","available","5","2018-03-01 00:00:00","","XRM","Other Motor Parts");
INSERT INTO products VALUES("74","Magneto Kit C100 Silcon-Red","available","5","2018-03-01 00:00:00","","C100","Other Motor Parts");
INSERT INTO products VALUES("75","Magneto Kit TMX BLK","available","5","2018-03-01 00:00:00","","TMX","Other Motor Parts");
INSERT INTO products VALUES("76","Magneto Kit C100 BLK","available","5","2018-03-01 00:00:00","","C100","Other Motor Parts");
INSERT INTO products VALUES("77","Magneto Kit Rusi125/110 BLK","available","5","2018-03-01 00:00:00","","Rusi","Other Motor Parts");
INSERT INTO products VALUES("78","Magneto Kit Rusi125/110 Silicon-Red","available","5","2018-03-01 00:00:00","","Rusi","Other Motor Parts");
INSERT INTO products VALUES("79","Carbon Brush Mio","available","5","2018-03-01 00:00:00","","Mio","Electrical Wirings");
INSERT INTO products VALUES("80","Carbon Brush Shogun","available","5","2018-03-01 00:00:00","2018-05-30 15:39:00","Shogun","Electrical Wirings");
INSERT INTO products VALUES("81","Carbon Brush Smash","available","5","2018-03-01 00:00:00","2018-05-30 16:10:39","Smash","Electrical Wirings");
INSERT INTO products VALUES("82","Carbon Brush XRM","available","5","2018-03-01 00:00:00","","Generic","Electrical Wirings");
INSERT INTO products VALUES("83","Carbon Brush Sniper","available","5","2018-03-01 00:00:00","","Sniper","Electrical Wirings");
INSERT INTO products VALUES("84","Carbon Brush With Housing","available","5","2018-03-01 00:00:00","","","Electrical Wirings");
INSERT INTO products VALUES("85","Carbon Brush Wave125","available","5","2018-03-01 00:00:00","","Wave","Electrical Wirings");
INSERT INTO products VALUES("86","Carbon Brush Crypton","available","5","2018-03-01 00:00:00","","Crypton","Electrical Wirings");
INSERT INTO products VALUES("87","Rocker Arm W/tappet Screw XM","available","5","2018-03-01 00:00:00","","Generic","Accessories");
INSERT INTO products VALUES("88","Rocker Arm W/tappet Screw TMX","available","5","2018-03-01 00:00:00","","TMX","Accessories");
INSERT INTO products VALUES("89","Rocker Arm W/tappet Screw Barako","available","5","2018-03-01 00:00:00","","Barako","Accessories");
INSERT INTO products VALUES("90","Rocker Arm W/tappet Screw Mio","available","5","2018-03-01 00:00:00","","Mio","Accessories");
INSERT INTO products VALUES("91","Rocker Arm W/tappet Screw STX","available","5","2018-03-01 00:00:00","","STX","Accessories");
INSERT INTO products VALUES("92","Rocker Arm W/tappet Screw Shogun","available","5","2018-03-01 00:00:00","","Shogun","Accessories");
INSERT INTO products VALUES("93","Rocker Arm W/tappet Screw Smash","available","5","2018-03-01 00:00:00","","Smash","Accessories");
INSERT INTO products VALUES("94","Rocker Arm W/tappet Screw Fury","available","5","2018-03-01 00:00:00","","Fury","Accessories");
INSERT INTO products VALUES("95","Rocker Arm Wave125","available","5","2018-03-01 00:00:00","","Wave","Accessories");
INSERT INTO products VALUES("96","Cylinder Head Packing-Red TMX","available","5","2018-03-01 00:00:00","","TMX","Engine & Engine Parts");
INSERT INTO products VALUES("97","Cylinder Head Packing-Silicon TMX","available","5","2018-03-01 00:00:00","","TMX","Engine & Engine Parts");
INSERT INTO products VALUES("98","Cylinder Head Packing-BLK TMX","available","5","2018-03-01 00:00:00","","TMX","Engine & Engine Parts");
INSERT INTO products VALUES("99","Wire Harness RS100","available","5","2018-03-01 00:00:00","","RS100","Electrical Wirings");
INSERT INTO products VALUES("100","Wire Harness TMX/CPT1","available","5","2018-03-01 00:00:00","","TMX","Electrical Wirings");
INSERT INTO products VALUES("101","Wire Harness TMX/CPT","available","5","2018-03-01 00:00:00","","TMX","Electrical Wirings");
INSERT INTO products VALUES("102","Wire Harness HD3/CDI","available","5","2018-03-01 00:00:00","","","Electrical Wirings");
INSERT INTO products VALUES("103","Wire Harness HD3","available","5","2018-03-01 00:00:00","","","Electrical Wirings");
INSERT INTO products VALUES("104","Wire Harness XRM","available","5","2018-03-01 00:00:00","","XRM","Electrical Wirings");
INSERT INTO products VALUES("105","Wire Harness STX","available","5","2018-03-01 00:00:00","","STX","Electrical Wirings");
INSERT INTO products VALUES("106","Brake Master Repair Kit Raider150","available","5","2018-03-01 00:00:00","","Raider","Brakes");
INSERT INTO products VALUES("107","Brake Master Repair Kit Wave125","available","5","2018-03-01 00:00:00","","Wave","Brakes");
INSERT INTO products VALUES("108","Brake Master Repair Kit GLPRO","available","6","2018-03-01 00:00:00","2018-05-26 07:38:53","","Brakes");
INSERT INTO products VALUES("109","Brake Master Repair Kit Mio","available","5","2018-03-01 00:00:00","","Mio","Brakes");
INSERT INTO products VALUES("110","Brake Master Repair Kit XRM110/W110","available","5","2018-03-01 00:00:00","","XRM","Brakes");
INSERT INTO products VALUES("111","Brake Master Repair Kit Shogun","available","5","2018-03-01 00:00:00","","Shogun","Brakes");
INSERT INTO products VALUES("112","Brake Master Repair Kit Trinity","available","5","2018-03-01 00:00:00","","","Brakes");
INSERT INTO products VALUES("113","Brake Master Repair Kit Raider110","available","5","2018-03-01 00:00:00","","Raider","Brakes");
INSERT INTO products VALUES("114","Brake Master Repair Kit Smash","available","5","2018-03-01 00:00:00","","Smash","Brakes");
INSERT INTO products VALUES("115","Primary Coil C100","available","5","2018-03-01 00:00:00","","C100","Electrical Wirings");
INSERT INTO products VALUES("116","Primary Coil CT00","available","5","2018-03-01 00:00:00","","","Electrical Wirings");
INSERT INTO products VALUES("117","Primary Coil TMX-CDI1","available","5","2018-03-01 00:00:00","","TMX","Electrical Wirings");
INSERT INTO products VALUES("118","Primary Coil TMX-CDI","available","5","2018-03-01 00:00:00","","TMX","Electrical Wirings");
INSERT INTO products VALUES("119","Fulser Coil Lifan150","available","5","2018-03-01 00:00:00","","Lifan","Electrical Wirings");
INSERT INTO products VALUES("120","Fulser Coil BC175","available","5","2018-03-01 00:00:00","","BC175","Electrical Wirings");
INSERT INTO products VALUES("121","Fulser Coil CT100","available","5","2018-03-01 00:00:00","","CT100","Electrical Wirings");
INSERT INTO products VALUES("122","Fulser Coil Crypton","available","5","2018-03-01 00:00:00","","Crypton","Electrical Wirings");
INSERT INTO products VALUES("123","Fulser Coil MSX","available","5","2018-03-01 00:00:00","","","Electrical Wirings");
INSERT INTO products VALUES("124","Fulser Coil TMX/CDI","available","5","2018-03-01 00:00:00","","TMX","Electrical Wirings");
INSERT INTO products VALUES("125","Carburador Insulator GY6125","available","5","2018-03-01 00:00:00","","","Engine & Engine Parts");
INSERT INTO products VALUES("126","Carburador Insulator CG125","available","5","2018-03-01 00:00:00","","","Engine & Engine Parts");
INSERT INTO products VALUES("127","Carburador Insulator CT100","available","5","2018-03-01 00:00:00","","CT100","Engine & Engine Parts");
INSERT INTO products VALUES("128","Carburador Insulator GS125","available","5","2018-03-01 00:00:00","","","Engine & Engine Parts");
INSERT INTO products VALUES("129","Carburador Insulator XRM","available","5","2018-03-01 00:00:00","","XRM","Engine & Engine Parts");
INSERT INTO products VALUES("130","Carburador Insulator BC175","available","5","2018-03-01 00:00:00","","BC175","Engine & Engine Parts");
INSERT INTO products VALUES("131","Carburador Insulator TMX Fibra","available","5","2018-03-01 00:00:00","","TMX","Engine & Engine Parts");
INSERT INTO products VALUES("132","Carburador Insulator TMX Alloy","available","5","2018-03-01 00:00:00","","TMX","Engine & Engine Parts");
INSERT INTO products VALUES("133","Carburador Insulator TMX Rubberize","available","5","2018-03-01 00:00:00","","TMX","Engine & Engine Parts");
INSERT INTO products VALUES("134","Handle Switch Assy. BC175 L/H","available","5","2018-03-01 00:00:00","","BC175","Electrical Wirings");
INSERT INTO products VALUES("135","Handle Switch Assy. DT125 R/H","available","5","2018-03-01 00:00:00","","","Electrical Wirings");
INSERT INTO products VALUES("136","Handle Switch Assy. DT125 L/H","available","5","2018-03-01 00:00:00","","Generic","Electrical Wirings");
INSERT INTO products VALUES("137","Handle Switch Assy. RS100 L/H","available","5","2018-03-01 00:00:00","","RS100","Electrical Wirings");
INSERT INTO products VALUES("138","Handle Switch Assy. XRM-Old L/H","available","5","2018-03-01 00:00:00","2018-06-02 13:11:55","XRM","Electrical Wirings");
INSERT INTO products VALUES("139","Handle Switch Assy. XRM-New L/H","available","5","2018-03-01 00:00:00","","XRM","Electrical Wirings");
INSERT INTO products VALUES("140","Handle Switch Assy. RM-Neww R/H","available","5","2018-03-01 00:00:00","","","Electrical Wirings");
INSERT INTO products VALUES("141","Neutral Switch Indicator Crypton","available","5","2018-03-01 00:00:00","","Crypton","Electrical Wirings");
INSERT INTO products VALUES("142","Neutral Switch Indicator C100","available","5","2018-03-01 00:00:00","","C100","Electrical Wirings");
INSERT INTO products VALUES("143","Neutral Switch Indicator Wave125","available","5","2018-03-01 00:00:00","","Wave","Electrical Wirings");
INSERT INTO products VALUES("144","Neutral Switch Indicator XRM","available","5","2018-03-01 00:00:00","","XRM","Electrical Wirings");
INSERT INTO products VALUES("145","Neutral Switch Indicator STX","available","5","2018-03-01 00:00:00","","STX","Electrical Wirings");
INSERT INTO products VALUES("146","Neutral Switch Indicator CT100","available","5","2018-03-01 00:00:00","","CT100","Electrical Wirings");
INSERT INTO products VALUES("147","Valve Guide Set CG125","available","5","2018-03-01 00:00:00","","","Engine & Engine Parts");
INSERT INTO products VALUES("148","Valve Guide Set TMX CPT.","available","5","2018-03-01 00:00:00","","TMX","Engine & Engine Parts");
INSERT INTO products VALUES("149","Valve Guide Set TMXCDI","available","5","2018-03-01 00:00:00","","TMX","Engine & Engine Parts");
INSERT INTO products VALUES("150","Valve Guide Set XRM","available","5","2018-03-01 00:00:00","","XRM","Engine & Engine Parts");
INSERT INTO products VALUES("151","Item 100","available","5","2018-05-31 06:56:20","2018-05-31 06:58:53","Generic","Other Motor Parts");
INSERT INTO products VALUES("152","item3","available","4","2018-05-31 07:27:54","2018-05-31 07:31:26","Generic","Other Motor Parts");
INSERT INTO products VALUES("153","Item 40","available","5","2018-05-31 08:13:30","2018-05-31 08:15:22","Generic","Other Motor Parts");
INSERT INTO products VALUES("154","item 101","available","5","2018-05-31 08:29:59","2018-05-31 08:32:20","Generic","Other Motor Parts");
<<<<<<< HEAD
INSERT INTO products VALUES("159","this is the item","available","5","2018-06-08 16:05:29","2018-06-08 16:09:24","this is the model","this is the category");
INSERT INTO products VALUES("160","New Item","available","5","2018-06-08 22:18:12","2018-06-08 22:18:46","New Model","New category");
=======
INSERT INTO products VALUES("158","aaabbb","available","3","2018-06-08 04:24:47","2018-06-08 04:24:47","XRM","Other Motor Parts");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE purchases;

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(7,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` int(45) NOT NULL,
  `discount` int(45) DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `purchases_product_id_foreign` (`product_id`),
  CONSTRAINT `purchases_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
<<<<<<< HEAD
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO purchases VALUES("1","1001","160","Honda","1","pcs","85.00","2018-06-08 06:19:00","","85","0");
INSERT INTO purchases VALUES("2","1002","160","Honda","20","pcs","85.00","2018-06-08 06:20:00","","1700","0");
=======
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO purchases VALUES("1","1","82","Honda","5","","1.00","2018-04-06 00:00:00","","0","");
INSERT INTO purchases VALUES("2","1","19","Honda","7","","1.00","2018-04-06 00:00:00","","0","");
INSERT INTO purchases VALUES("3","1","147","Honda","7","","1.00","2018-04-06 00:00:00","","0","");
INSERT INTO purchases VALUES("4","909090","111","lol","2","","5.00","2018-05-30 18:17:00","","0","");
INSERT INTO purchases VALUES("5","90901","111","lla","1","","10.00","2018-05-30 18:20:00","","0","");
INSERT INTO purchases VALUES("6","90902","111","aa","2","","10.00","2018-05-30 18:21:00","","0","");
INSERT INTO purchases VALUES("7","90903","111","aaae","5","","15.00","2018-05-30 18:22:00","","0","");
INSERT INTO purchases VALUES("8","90904","111","aaa","2","","20.00","2018-05-30 18:39:00","","0","");
INSERT INTO purchases VALUES("9","1001","108","Yamaha","25","","53.00","2018-05-30 18:52:00","","0","");
INSERT INTO purchases VALUES("10","1001","112","Yamaha","35","","53.00","2018-05-30 18:52:00","","0","");
INSERT INTO purchases VALUES("11","1001","109","Yamaha","28","","53.00","2018-05-30 18:52:00","","0","");
INSERT INTO purchases VALUES("12","445","151","Honda","100","","150.00","2018-05-31 14:58:00","","0","");
INSERT INTO purchases VALUES("13","12312","152","nm","100","","50.00","2018-05-31 15:29:00","","0","");
INSERT INTO purchases VALUES("14","200","153","honda","50","","40.00","2018-05-31 16:13:00","","0","");
INSERT INTO purchases VALUES("15","1011","154","yamaha","10","","50.00","2018-05-31 16:31:00","","0","");
INSERT INTO purchases VALUES("16","1234","154","Honda","5","","50.00","2018-05-31 16:37:00","","0","");
INSERT INTO purchases VALUES("17","234432","108","Motorstar","1","pcs","53.00","2018-06-07 14:06:00","","53","2");
INSERT INTO purchases VALUES("18","12321","130","Yamaha","100","pcs","32.00","2018-06-09 12:12:00","","3200","0");
INSERT INTO purchases VALUES("19","12321","108","Yamaha","50","pcs","53.00","2018-06-09 12:12:00","","2650","0");
INSERT INTO purchases VALUES("20","876542345678","82","h","4","pcs","1.00","2018-06-09 12:48:00","","4","0");
INSERT INTO purchases VALUES("21","76867868","82","h","4","pcs","1.00","2018-06-09 12:50:00","","4","0");
INSERT INTO purchases VALUES("22","1231321","82","h","4","pcs","1.00","2018-06-09 12:53:00","","4","0");
INSERT INTO purchases VALUES("23","23241","151","h","1","pcs","150.00","2018-06-09 12:56:00","","150","0");
INSERT INTO purchases VALUES("24","5646","151","h","1","pcs","150.00","2018-06-09 13:02:00","","150","0");
INSERT INTO purchases VALUES("25","23211","151","h","1","pcs","150.00","2018-06-09 13:24:00","","150","0");
INSERT INTO purchases VALUES("26","12312312","151","h","1","pcs","150.00","2018-06-09 13:27:00","","150","0");
INSERT INTO purchases VALUES("27","2312321","151","h","1","pcs","150.00","2018-06-09 13:28:00","","150","0");
INSERT INTO purchases VALUES("28","465656","108","yamaha","5","pcs","53.00","2018-06-09 13:29:00","","265","0");
INSERT INTO purchases VALUES("29","2345678","130","yamaha","5","pcs","32.00","2018-06-09 15:49:00","","160","0");
INSERT INTO purchases VALUES("30","123","82","Honda","2","pcs","1.00","2018-06-11 12:55:00","","2","0");
INSERT INTO purchases VALUES("31","4324","82","Honda","2","pcs","1.00","2018-06-11 13:11:00","","2","0");
INSERT INTO purchases VALUES("32","1233","82","Honda","2","pcs","1.00","2018-06-11 14:02:00","","2","0");
INSERT INTO purchases VALUES("33","12334","82","Honda","2","pcs","1.00","2018-06-11 14:02:00","","2","0");
INSERT INTO purchases VALUES("34","23214124","82","Honda","2","pcs","1.00","2018-06-11 14:05:00","","2","0");
INSERT INTO purchases VALUES("35","2321","152","nm","5","pcs","50.00","2018-06-11 14:06:00","","250","0");
INSERT INTO purchases VALUES("36","12312312312","82","Honda","2","pcs","1.00","2018-06-11 14:11:00","","2","0");
INSERT INTO purchases VALUES("37","414213123","152","nm","5","pcs","50.00","2018-06-11 14:13:00","","250","0");
INSERT INTO purchases VALUES("38","123222","108","Yamaha","5","pcs","53.00","2018-06-11 16:06:00","","265","0");
INSERT INTO purchases VALUES("39","12321312","108","Yamaha","4","pcs","53.00","2018-06-11 16:40:00","","212","0");
INSERT INTO purchases VALUES("40","12321312","108","Yamaha","4","pcs","53.00","2018-06-11 16:40:00","","212","0");
INSERT INTO purchases VALUES("41","3123123","108","Yamaha","4","pcs","53.00","2018-06-11 16:43:00","","212","0");
INSERT INTO purchases VALUES("42","31231222","108","Yamaha","4","pcs","53.00","2018-06-11 16:45:00","","212","0");
INSERT INTO purchases VALUES("43","1232131","108","Yamaha","4","pcs","53.00","2018-06-11 16:47:00","","212","0");
INSERT INTO purchases VALUES("44","321414","108","Yamaha","4","pcs","53.00","2018-06-11 21:14:00","","212","0");
INSERT INTO purchases VALUES("45","321414","112","Yamaha","5","pcs","53.00","2018-06-11 21:14:00","","265","0");
INSERT INTO purchases VALUES("46","321414","109","Yamaha","5","pcs","53.00","2018-06-11 21:14:00","","265","0");
INSERT INTO purchases VALUES("47","5435","82","Honda","2","pcs","1.00","2018-06-11 23:14:00","","2","0");
INSERT INTO purchases VALUES("48","32124","152","nm","12","pcs","50.00","2018-06-11 23:21:00","","600","0");
INSERT INTO purchases VALUES("49","42232","130","yamaha","10","pcs","32.00","2018-06-11 23:23:00","","320","0");
INSERT INTO purchases VALUES("50","333","82","Honda","0","pcs","1.00","2018-06-11 23:23:00","","0","0");
INSERT INTO purchases VALUES("51","887","130","yamaha","10","pcs","32.00","2018-06-11 23:28:00","","320","0");
INSERT INTO purchases VALUES("52","123123","82","Honda","0","pcs","1.00","2018-06-11 23:38:00","","0","0");
INSERT INTO purchases VALUES("53","86876","151","h","1","pcs","150.00","2018-06-11 23:43:00","","150","0");
INSERT INTO purchases VALUES("54","321232","82","Honda","0","pcs","1.00","2018-06-11 23:45:00","","0","0");
INSERT INTO purchases VALUES("55","3332","82","Honda","0","pcs","1.00","2018-06-11 23:49:00","","0","0");
INSERT INTO purchases VALUES("56","3456","82","Honda","2","pcs","1.00","2018-06-11 00:00:00","","2","0");
INSERT INTO purchases VALUES("57","435","82","Honda","0","pcs","1.00","2018-06-11 00:21:00","","0","0");
INSERT INTO purchases VALUES("58","5435","108","Motorstar","0","pcs","53.00","2018-06-12 12:27:00","","0","0");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE returns;

CREATE TABLE `returns` (
  `or_number` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `damagedQuantity` int(11) DEFAULT '0',
  `undamagedQuantity` int(11) DEFAULT '0',
  `damagedSalableQuantity` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `pid_return_idx` (`product_id`),
  KEY `prodID_return_idx` (`product_id`),
  CONSTRAINT `prodID_return` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

<<<<<<< HEAD
INSERT INTO returns VALUES("1111","160","James","100.00","1","0","0","2018-06-09 06:26:58","");
INSERT INTO returns VALUES("246899","85","Customer two","65.00","1","0","0","2018-06-11 14:49:56","");
INSERT INTO returns VALUES("1112","160","James","100.00","0","0","1","2018-06-11 15:22:59","");
=======
INSERT INTO returns VALUES("1","147","Jake James","1.00","1","0","0","2018-06-08 18:37:10","");
INSERT INTO returns VALUES("1","148","Jake James","105.00","0","1","0","2018-06-08 18:37:11","");
INSERT INTO returns VALUES("1","149","Jake James","105.00","0","0","1","2018-06-08 18:37:11","");
INSERT INTO returns VALUES("1","150","Jake James","105.00","1","0","0","2018-06-08 18:37:11","");
INSERT INTO returns VALUES("2","149","Jake James","105.00","1","0","0","2018-06-08 18:39:55","");
INSERT INTO returns VALUES("1","147","Jake James","1.00","1","0","0","2018-06-08 18:41:36","");
INSERT INTO returns VALUES("1","150","Jake James","105.00","1","0","0","2018-06-08 18:46:00","");
INSERT INTO returns VALUES("3","149","Jake James","105.00","1","0","0","2018-06-08 20:43:02","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE returns_supplier;

CREATE TABLE `returns_supplier` (
  `returns_s_id` int(11) NOT NULL AUTO_INCREMENT,
<<<<<<< HEAD
  `address` varchar(45) DEFAULT NULL,
  `supplier_name` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('Pending','Settled') DEFAULT 'Pending',
  `po_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`returns_s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

=======
  `po_id` int(11) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `supplier_name` varchar(45) NOT NULL,
  `status` enum('Pending','Settled') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`returns_s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO returns_supplier VALUES("7","","","yamaha","Pending","2018-06-09 12:14:34","");
INSERT INTO returns_supplier VALUES("6","","","yamaha","Pending","2018-06-09 12:14:23","");
INSERT INTO returns_supplier VALUES("5","","","h","Settled","2018-06-11 23:44:09","");
INSERT INTO returns_supplier VALUES("8","","","yamaha","Settled","2018-06-11 23:28:36","");
INSERT INTO returns_supplier VALUES("9","","","yamaha","Settled","2018-06-11 23:23:23","");
INSERT INTO returns_supplier VALUES("10","","","1","Pending","2018-06-11 11:30:12","");
INSERT INTO returns_supplier VALUES("11","","","Honda","Settled","2018-06-11 23:23:52","");
INSERT INTO returns_supplier VALUES("12","","","Honda","Settled","2018-06-11 23:38:36","");
INSERT INTO returns_supplier VALUES("13","1","","Honda","Settled","2018-06-11 14:12:07","");
INSERT INTO returns_supplier VALUES("14","1","","Honda","Settled","2018-06-11 23:15:10","");
INSERT INTO returns_supplier VALUES("15","12","","nm","Settled","2018-06-11 14:13:27","");
INSERT INTO returns_supplier VALUES("16","1001","","Yamaha","Settled","2018-06-11 16:07:56","");
INSERT INTO returns_supplier VALUES("17","1001","","Yamaha","Settled","2018-06-11 16:47:54","");
INSERT INTO returns_supplier VALUES("18","12","","nm","Settled","2018-06-11 23:21:29","");
INSERT INTO returns_supplier VALUES("19","123","","Honda","Settled","2018-06-11 23:46:06","");
INSERT INTO returns_supplier VALUES("20","3","","Honda","Settled","2018-06-11 23:49:29","");
INSERT INTO returns_supplier VALUES("21","12","","Honda","Settled","2018-06-12 00:08:25","");
INSERT INTO returns_supplier VALUES("22","12","","Honda","Settled","2018-06-12 00:21:15","");
INSERT INTO returns_supplier VALUES("23","1231231","","h","Pending","2018-06-12 12:26:09","");
INSERT INTO returns_supplier VALUES("24","234","","Motorstar","Settled","2018-06-12 12:27:28","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE returns_supplier_info;

CREATE TABLE `returns_supplier_info` (
  `return_supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `returned_po_id` int(11) DEFAULT NULL,
  `returns_s_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `damagedQty_return` int(11) NOT NULL,
  `damaged_salableQty_return` int(11) NOT NULL,
  `damaged_item_accepted` int(11) DEFAULT '0',
  `damaged_salable_accepted` int(11) DEFAULT '0',
  `return_status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
<<<<<<< HEAD
  `updatede_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`return_supplier_id`),
  KEY `returns_s_id_idx` (`returns_s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

=======
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`return_supplier_id`),
  KEY `returns_s_id_idx` (`returns_s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

INSERT INTO returns_supplier_info VALUES("8","86876","5","151","0","1","0","7","Accepted","2018-06-11 23:44:09","");
INSERT INTO returns_supplier_info VALUES("9","","5","82","4","0","4","0","Rejected","2018-06-09 13:29:02","");
INSERT INTO returns_supplier_info VALUES("10","887","8","130","10","0","10","0","Accepted","2018-06-11 23:28:36","");
INSERT INTO returns_supplier_info VALUES("11","","8","108","5","0","0","0","Rejected","2018-06-11 23:28:36","");
INSERT INTO returns_supplier_info VALUES("12","","8","108","5","0","5","0","Rejected","2018-06-11 23:28:36","");
INSERT INTO returns_supplier_info VALUES("13","42232","9","130","10","0","15","0","Accepted","2018-06-11 23:23:22","");
INSERT INTO returns_supplier_info VALUES("14","333","11","82","0","0","0","0","Accepted","2018-06-11 23:23:52","");
INSERT INTO returns_supplier_info VALUES("15","123123","12","82","0","0","0","0","Accepted","2018-06-11 23:38:36","");
INSERT INTO returns_supplier_info VALUES("16","","13","82","2","0","6","0","Pending","2018-06-11 16:06:33","");
INSERT INTO returns_supplier_info VALUES("17","5435","14","82","2","0","10","0","Accepted","2018-06-11 23:15:09","");
INSERT INTO returns_supplier_info VALUES("18","","15","152","2","3","4","6","Pending","2018-06-11 16:06:33","");
INSERT INTO returns_supplier_info VALUES("19","","16","108","5","0","10","0","Pending","2018-06-11 17:52:53","");
INSERT INTO returns_supplier_info VALUES("20","","16","112","5","0","0","0","Pending","2018-06-11 17:52:53","");
INSERT INTO returns_supplier_info VALUES("21","321414","17","108","4","0","24","0","Accepted","2018-06-11 21:16:18","");
INSERT INTO returns_supplier_info VALUES("22","321414","17","112","0","5","0","5","Accepted","2018-06-11 21:16:18","");
INSERT INTO returns_supplier_info VALUES("23","321414","17","109","5","0","5","0","Accepted","2018-06-11 21:16:19","");
INSERT INTO returns_supplier_info VALUES("24","32124","18","152","12","0","12","0","Accepted","2018-06-11 23:21:29","");
INSERT INTO returns_supplier_info VALUES("25","321232","19","82","0","0","0","0","Accepted","2018-06-11 23:46:06","");
INSERT INTO returns_supplier_info VALUES("26","3332","20","82","0","0","0","0","Accepted","2018-06-11 23:49:29","");
INSERT INTO returns_supplier_info VALUES("27","3456","21","82","2","0","2","0","Accepted","2018-06-12 00:08:25","");
INSERT INTO returns_supplier_info VALUES("28","435","22","82","0","0","0","0","Accepted","2018-06-12 00:21:15","");
INSERT INTO returns_supplier_info VALUES("29","","23","151","0","0","0","0","Pending","2018-06-12 12:26:09","");
INSERT INTO returns_supplier_info VALUES("30","5435","24","108","0","0","0","0","Accepted","2018-06-12 12:27:28","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE salable_items;

CREATE TABLE `salable_items` (
  `product_id` int(11) NOT NULL,
  `wholesale_price` decimal(7,2) NOT NULL,
  `retail_price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `si_prodID_idx` (`product_id`),
  CONSTRAINT `si_prodID` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO salable_items VALUES("1","150.00","180.00","28","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("2","150.00","180.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("3","150.00","180.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("4","150.00","180.00","12","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("5","150.00","180.00","23","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("6","150.00","180.00","5","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("7","150.00","180.00","27","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("8","150.00","180.00","32","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("9","150.00","180.00","23","2018-03-31 00:00:00","");
=======
INSERT INTO salable_items VALUES("8","150.00","180.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("9","150.00","180.00","24","2018-03-31 00:00:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO salable_items VALUES("10","150.00","180.00","22","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("11","250.00","280.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("12","250.00","280.00","21","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("13","250.00","280.00","12","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("14","250.00","280.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("15","250.00","280.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("16","250.00","280.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("17","250.00","280.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("18","250.00","280.00","25","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("19","1.00","1.00","10","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("20","250.00","280.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("21","250.00","280.00","33","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("22","250.00","280.00","5","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("23","120.00","150.00","19","2018-03-31 00:00:00","");
=======
INSERT INTO salable_items VALUES("23","120.00","150.00","20","2018-03-31 00:00:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO salable_items VALUES("24","120.00","150.00","9","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("25","120.00","150.00","39","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("26","120.00","150.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("27","120.00","150.00","43","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("28","120.00","150.00","44","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("29","120.00","150.00","28","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("30","120.00","150.00","17","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("31","120.00","150.00","45","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("32","120.00","150.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("33","120.00","150.00","21","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("34","120.00","150.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("35","120.00","150.00","10","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("36","120.00","150.00","38","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("37","155.00","185.00","34","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("38","155.00","185.00","23","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("39","155.00","185.00","46","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("40","155.00","185.00","38","2018-03-31 00:00:00","");
=======
INSERT INTO salable_items VALUES("34","120.00","150.00","9","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("35","120.00","150.00","10","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("36","120.00","150.00","38","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("37","155.00","185.00","34","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("38","155.00","185.00","24","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("39","155.00","185.00","48","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("40","155.00","185.00","41","2018-03-31 00:00:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO salable_items VALUES("41","155.00","185.00","10","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("42","155.00","185.00","30","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("43","155.00","185.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("44","155.00","185.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("45","155.00","185.00","23","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("46","155.00","185.00","31","2018-03-31 00:00:00","");
=======
INSERT INTO salable_items VALUES("46","155.00","185.00","32","2018-03-31 00:00:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO salable_items VALUES("47","155.00","185.00","29","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("48","155.00","185.00","13","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("49","200.00","230.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("50","205.00","235.00","26","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("51","287.00","317.00","38","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("52","190.00","220.00","38","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("53","190.00","220.00","47","2018-03-31 00:00:00","");
=======
INSERT INTO salable_items VALUES("52","190.00","220.00","40","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("53","190.00","220.00","48","2018-03-31 00:00:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO salable_items VALUES("54","287.00","317.00","23","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("55","287.00","317.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("56","287.00","317.00","40","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("57","95.00","125.00","25","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("58","186.00","216.00","19","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("59","186.00","216.00","22","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("60","186.00","216.00","9","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("61","270.00","300.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("62","286.00","316.00","39","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("63","150.00","180.00","19","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("64","186.00","216.00","27","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("65","125.00","155.00","2","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("66","125.00","155.00","26","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("67","75.00","105.00","6","2018-03-31 00:00:00","");
=======
INSERT INTO salable_items VALUES("63","150.00","180.00","20","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("64","186.00","216.00","27","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("65","125.00","155.00","5","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("66","125.00","155.00","27","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("67","75.00","105.00","10","2018-03-31 00:00:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO salable_items VALUES("68","75.00","105.00","24","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("69","125.00","155.00","43","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("70","125.00","155.00","46","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("71","125.00","155.00","13","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("72","125.00","155.00","26","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("73","125.00","155.00","21","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("74","125.00","155.00","43","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("75","85.00","115.00","47","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("76","85.00","115.00","45","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("77","85.00","115.00","20","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("78","125.00","155.00","6","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("79","35.00","65.00","8","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("80","35.00","70.00","1","2018-03-31 00:00:00","2018-05-30 15:39:00");
INSERT INTO salable_items VALUES("81","35.00","70.00","11","2018-03-31 00:00:00","2018-05-30 16:10:39");
INSERT INTO salable_items VALUES("82","1.00","1.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("83","35.00","65.00","2","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("84","90.00","120.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("85","35.00","65.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("86","35.00","65.00","1","2018-03-31 00:00:00","");
=======
INSERT INTO salable_items VALUES("79","35.00","65.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("80","35.00","70.00","3","2018-03-31 00:00:00","2018-05-30 15:39:00");
INSERT INTO salable_items VALUES("81","35.00","70.00","12","2018-03-31 00:00:00","2018-05-30 16:10:39");
INSERT INTO salable_items VALUES("82","1.00","1.00","20","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("83","35.00","65.00","5","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("84","90.00","120.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("85","35.00","65.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("86","35.00","65.00","0","2018-03-31 00:00:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO salable_items VALUES("87","195.00","225.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("88","403.00","433.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("89","225.00","255.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("90","225.00","255.00","5","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("91","225.00","255.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("92","225.00","255.00","22","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("93","225.00","255.00","38","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("94","403.00","433.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("95","403.00","433.00","16","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("96","37.00","67.00","13","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("97","39.00","69.00","43","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("98","25.00","55.00","24","2018-03-31 00:00:00","");
=======
INSERT INTO salable_items VALUES("96","37.00","67.00","17","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("97","39.00","69.00","44","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("98","25.00","55.00","25","2018-03-31 00:00:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO salable_items VALUES("99","375.00","405.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("100","375.00","405.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("101","375.00","405.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("102","375.00","405.00","8","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("103","375.00","405.00","46","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("104","375.00","405.00","42","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("105","375.00","405.00","34","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("106","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("107","53.00","83.00","3","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("108","53.00","83.00","0","2018-03-31 00:00:00","2018-05-26 07:38:54");
INSERT INTO salable_items VALUES("109","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("110","53.00","83.00","1","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("111","20.00","83.00","1","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("112","53.00","83.00","18","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("113","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("114","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("115","150.00","180.00","1","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("116","150.00","180.00","31","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("117","150.00","180.00","17","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("118","150.00","180.00","31","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("119","95.00","125.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("120","135.00","165.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("121","125.00","155.00","9","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("122","107.00","137.00","14","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("123","180.00","210.00","44","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("124","160.00","190.00","16","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("125","55.00","85.00","13","2018-03-31 00:00:00","");
=======
INSERT INTO salable_items VALUES("108","53.00","83.00","77","2018-03-31 00:00:00","2018-05-26 07:38:54");
INSERT INTO salable_items VALUES("109","53.00","83.00","5","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("110","53.00","83.00","1","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("111","20.00","83.00","8","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("112","53.00","83.00","24","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("113","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("114","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("115","150.00","180.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("116","150.00","180.00","31","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("117","150.00","180.00","18","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("118","150.00","180.00","31","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("119","95.00","125.00","8","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("120","135.00","165.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("121","125.00","155.00","9","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("122","107.00","137.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("123","180.00","210.00","44","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("124","160.00","190.00","16","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("125","55.00","85.00","12","2018-03-31 00:00:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO salable_items VALUES("126","38.00","68.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("127","45.00","75.00","31","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("128","75.00","105.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("129","19.50","49.50","7","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("130","32.00","62.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("131","19.50","49.50","45","2018-03-31 00:00:00","");
=======
INSERT INTO salable_items VALUES("130","32.00","62.00","31","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("131","19.50","49.50","46","2018-03-31 00:00:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO salable_items VALUES("132","98.00","128.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("133","89.00","119.00","29","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("134","188.00","218.00","45","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("135","188.00","218.00","18","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("136","190.00","220.00","46","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("137","190.00","220.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("138","235.00","260.00","41","2018-03-31 00:00:00","2018-06-02 13:11:56");
INSERT INTO salable_items VALUES("139","235.00","265.00","42","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("140","235.00","265.00","26","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("141","300.00","330.00","34","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("142","300.00","330.00","17","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("143","300.00","330.00","32","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("144","300.00","330.00","20","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("145","300.00","330.00","47","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("146","300.00","330.00","22","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("147","1.00","1.00","2","2018-03-31 00:00:00","");
<<<<<<< HEAD
INSERT INTO salable_items VALUES("148","75.00","105.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("149","75.00","105.00","19","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("150","75.00","105.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("151","150.00","200.00","46","2018-05-31 06:56:20","2018-05-31 06:58:54");
INSERT INTO salable_items VALUES("152","50.00","70.00","78","2018-05-31 07:27:54","2018-05-31 07:31:26");
INSERT INTO salable_items VALUES("153","40.00","50.00","15","2018-05-31 08:13:30","2018-05-31 08:15:22");
INSERT INTO salable_items VALUES("154","50.00","70.00","14","2018-05-31 08:29:59","2018-05-31 08:32:20");
INSERT INTO salable_items VALUES("159","100.00","150.00","15","2018-06-08 16:05:29","2018-06-08 16:09:25");
INSERT INTO salable_items VALUES("160","85.00","100.00","19","2018-06-08 22:18:12","2018-06-08 22:18:46");
=======
INSERT INTO salable_items VALUES("148","75.00","105.00","34","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("149","75.00","105.00","19","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("150","75.00","105.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("151","150.00","200.00","52","2018-05-31 06:56:20","2018-05-31 06:58:54");
INSERT INTO salable_items VALUES("152","50.00","70.00","100","2018-05-31 07:27:54","2018-05-31 07:31:26");
INSERT INTO salable_items VALUES("153","40.00","50.00","20","2018-05-31 08:13:30","2018-05-31 08:15:22");
INSERT INTO salable_items VALUES("154","50.00","70.00","14","2018-05-31 08:29:59","2018-05-31 08:32:20");
INSERT INTO salable_items VALUES("158","0.00","0.00","0","2018-06-08 04:24:47","2018-06-08 04:24:47");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE sales;

CREATE TABLE `sales` (
  `or_number` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `exchangeor` int(11) DEFAULT NULL,
  `address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
<<<<<<< HEAD
  `warranty` datetime(6) DEFAULT NULL,
=======
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
  KEY `sales_product_id_foreign` (`product_id`),
  CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

<<<<<<< HEAD
INSERT INTO sales VALUES("1111","160","James","100.00","0","2018-06-08 06:26:00","","pcs","0","","","0000-00-00 00:00:00.000000");
INSERT INTO sales VALUES("1112","160","James","100.00","0","2018-06-08 06:27:00","","pcs","0","1111","","0000-00-00 00:00:00.000000");
INSERT INTO sales VALUES("123","108","Marinel","83.00","1","2018-06-09 10:04:00","","pcs","0","","","0000-00-00 00:00:00.000000");
INSERT INTO sales VALUES("2468","111","Customer One","83.00","1","2018-06-11 13:11:00","","pcs","0","","baguio","0000-00-00 00:00:00.000000");
INSERT INTO sales VALUES("24688","112","Customer two","83.00","1","2018-06-11 13:12:00","","pcs","2","","bakakeng","2018-06-12 13:10:00.000000");
INSERT INTO sales VALUES("246899","85","Customer two","65.00","1","2018-06-11 13:16:00","","pcs","4","","London","2018-06-12 00:00:00.000000");
INSERT INTO sales VALUES("246000","111","Customer two","83.00","1","2018-06-11 13:29:00","","pcs","0","","bakakeng","");
INSERT INTO sales VALUES("1232342","111","James","83.00","2","2018-06-11 16:27:00","","pcs","","","","");
INSERT INTO sales VALUES("12345","111","Jake James","83.00","1","2018-06-11 16:28:00","","pcs","","","","");
INSERT INTO sales VALUES("999977777","153","James","50.00","2","2018-06-11 16:36:00","","pcs","","","","");
INSERT INTO sales VALUES("3333","153","Jake the 2nd","50.00","3","2018-06-11 16:36:00","","pcs","5","","Taiwan Taipe","2018-06-12 00:00:00.000000");
=======
INSERT INTO sales VALUES("1","147","Jake James","1.00","0","2018-06-08 18:36:00","","pcs","0","","");
INSERT INTO sales VALUES("1","148","Jake James","105.00","1","2018-06-08 18:36:00","","pcs","0","","");
INSERT INTO sales VALUES("1","149","Jake James","105.00","1","2018-06-08 18:36:00","","pcs","0","","");
INSERT INTO sales VALUES("1","150","Jake James","105.00","0","2018-06-08 18:36:00","","pcs","0","","");
INSERT INTO sales VALUES("2","149","Jake James","105.00","0","2018-06-08 18:38:00","","pcs","0","","");
INSERT INTO sales VALUES("3","149","Jake James","105.00","0","2018-06-08 18:40:00","","pcs","0","","");
INSERT INTO sales VALUES("4","147","Jake James","1.00","1","2018-06-08 18:47:00","","pcs","0","","");
INSERT INTO sales VALUES("5","112","Jake James","83.00","1","2018-06-08 18:59:00","","pcs","0","2","");
INSERT INTO sales VALUES("6","149","aaa","75.00","1","2018-06-08 20:43:00","","","","","");
INSERT INTO sales VALUES("7","151","Jake James","150.00","1","2018-06-08 20:51:00","","","","3","");
INSERT INTO sales VALUES("8","149","Customer two","75.00","2","2018-06-08 20:52:00","","pcs","","7","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE stock_adjustments;

CREATE TABLE `stock_adjustments` (
  `stock_adjustments_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(191) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` enum('damaged','damaged_salable','lost') NOT NULL,
  `status` enum('Accepted','Declined','Pending') NOT NULL DEFAULT 'Pending',
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`stock_adjustments_id`),
  UNIQUE KEY `stock_adjustments_id_UNIQUE` (`stock_adjustments_id`),
  KEY `sa_product_id_idx` (`product_id`),
  CONSTRAINT `sa_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
<<<<<<< HEAD
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;
=======
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f

INSERT INTO stock_adjustments VALUES("28","ADMIN","126","1","damaged","Accepted","damaged by rats","2018-06-05 04:07:00","");
INSERT INTO stock_adjustments VALUES("29","ADMIN","80","1","damaged","Accepted","adsada","2018-06-06 11:08:00","");
INSERT INTO stock_adjustments VALUES("30","ADMIN","83","1","damaged","Accepted","asdsad","2018-06-06 11:10:00","");
<<<<<<< HEAD
INSERT INTO stock_adjustments VALUES("31","ADMIN","159","1","damaged","Accepted","item was damaged","2018-06-08 01:20:00","");
INSERT INTO stock_adjustments VALUES("32","ADMIN","83","1","damaged","Accepted","nnmnbm","2018-06-08 02:19:00","");
INSERT INTO stock_adjustments VALUES("33","ADMIN","116","1","damaged","Accepted","nmbmbn","2018-06-08 02:19:00","");
INSERT INTO stock_adjustments VALUES("34","ADMIN","39","2","damaged","Accepted","asdasd","2018-06-08 02:31:00","");
INSERT INTO stock_adjustments VALUES("35","ADMIN","40","3","damaged","Accepted","asdasdd","2018-06-08 02:31:00","");
INSERT INTO stock_adjustments VALUES("36","ADMIN","83","2","damaged","Accepted","asdasd","2018-06-08 02:36:00","");
INSERT INTO stock_adjustments VALUES("37","ADMIN","80","1","damaged","Accepted","asdasda","2018-06-08 02:36:00","");
INSERT INTO stock_adjustments VALUES("38","ADMIN","115","3","damaged","Accepted","fchgjbkj","2018-06-08 02:37:00","");
INSERT INTO stock_adjustments VALUES("39","ADMIN","117","1","damaged","Accepted","rhj","2018-06-08 02:37:00","");
INSERT INTO stock_adjustments VALUES("40","ADMIN","111","1","damaged","Accepted","ghjgj","2018-06-08 02:38:00","");
INSERT INTO stock_adjustments VALUES("41","ADMIN","46","1","damaged","Accepted","dcfgghvh","2018-06-08 02:38:00","");
INSERT INTO stock_adjustments VALUES("42","ADMIN","67","1","damaged","Accepted","gggfjfj","2018-06-08 02:38:00","");
INSERT INTO stock_adjustments VALUES("43","ADMIN","83","1","damaged","Accepted","asdasd","2018-06-08 02:40:00","");
INSERT INTO stock_adjustments VALUES("44","ADMIN","65","1","damaged","Accepted","asdsad","2018-06-08 02:40:00","");
INSERT INTO stock_adjustments VALUES("45","ADMIN","67","1","damaged","Accepted","dasdad","2018-06-08 02:40:00","");
INSERT INTO stock_adjustments VALUES("46","ADMIN","66","1","damaged","Accepted","asdasd","2018-06-08 02:41:00","");
INSERT INTO stock_adjustments VALUES("47","ADMIN","67","1","damaged","Accepted","sdadasd","2018-06-08 02:41:00","");
INSERT INTO stock_adjustments VALUES("48","ADMIN","23","1","lost","Accepted","asdada","2018-06-08 02:41:00","");
INSERT INTO stock_adjustments VALUES("49","ADMIN","125","1","damaged_salable","Accepted","adasda","2018-06-08 02:41:00","");
INSERT INTO stock_adjustments VALUES("50","ADMIN","67","1","damaged_salable","Accepted","dasdasd","2018-06-08 02:41:00","");
INSERT INTO stock_adjustments VALUES("51","ADMIN","67","1","damaged","Accepted","tddhfjhgjh","2018-06-08 02:46:00","");
INSERT INTO stock_adjustments VALUES("52","ADMIN","131","1","damaged","Accepted","gg","2018-06-08 02:46:00","");
INSERT INTO stock_adjustments VALUES("53","ADMIN","34","4","lost","Accepted","fgvhj","2018-06-08 02:46:00","");
INSERT INTO stock_adjustments VALUES("54","ADMIN","51","1","damaged_salable","Accepted","gcfhgjhk","2018-06-08 02:46:00","");
INSERT INTO stock_adjustments VALUES("55","ADMIN","80","1","damaged","Accepted","jjh","2018-06-08 02:47:00","");
INSERT INTO stock_adjustments VALUES("56","ADMIN","51","1","damaged_salable","Accepted","gghjj","2018-06-08 02:47:00","");
INSERT INTO stock_adjustments VALUES("57","ADMIN","34","1","lost","Accepted","fdhffg","2018-06-08 02:47:00","");
INSERT INTO stock_adjustments VALUES("58","ADMIN","65","2","damaged","Accepted","bghj","2018-06-08 02:47:00","");
INSERT INTO stock_adjustments VALUES("59","ADMIN","66","3","damaged_salable","Accepted","jkhkhkjhkj","2018-06-08 02:47:00","");
INSERT INTO stock_adjustments VALUES("60","ADMIN","9","1","damaged","Accepted","asdasd","2018-06-08 02:56:00","");
INSERT INTO stock_adjustments VALUES("61","ADMIN","8","1","damaged","Accepted","asdasd","2018-06-08 02:56:00","");
INSERT INTO stock_adjustments VALUES("62","ADMIN","8","1","damaged","Accepted","asdasda","2018-06-08 02:56:00","");
INSERT INTO stock_adjustments VALUES("63","ADMIN","81","1","damaged","Accepted","sadas","2018-06-08 02:56:00","");
INSERT INTO stock_adjustments VALUES("64","ADMIN","8","1","damaged","Accepted","asdasd","2018-06-08 02:56:00","");
INSERT INTO stock_adjustments VALUES("65","ADMIN","119","1","damaged","Accepted","asdasda","2018-06-08 02:56:00","");
INSERT INTO stock_adjustments VALUES("66","ADMIN","122","1","damaged","Accepted","asdasd","2018-06-08 02:56:00","");
INSERT INTO stock_adjustments VALUES("67","ADMIN","149","1","damaged_salable","Accepted","asdasd","2018-06-08 02:58:00","");
INSERT INTO stock_adjustments VALUES("68","ADMIN","108","2","damaged","Accepted","sdsad","2018-06-08 02:58:00","");
INSERT INTO stock_adjustments VALUES("69","ADMIN","97","1","damaged","Accepted","fdsfsdfs","2018-06-08 02:58:00","");
INSERT INTO stock_adjustments VALUES("70","ADMIN","96","4","lost","Accepted","asdasd","2018-06-08 02:58:00","");
INSERT INTO stock_adjustments VALUES("71","ADMIN","52","2","lost","Accepted","adasda","2018-06-08 02:58:00","");
INSERT INTO stock_adjustments VALUES("72","ADMIN","53","1","damaged","Accepted","sada","2018-06-08 05:17:00","");
INSERT INTO stock_adjustments VALUES("73","ADMIN","38","1","damaged","Accepted","dasda","2018-06-08 05:17:00","");
INSERT INTO stock_adjustments VALUES("74","ADMIN","63","1","damaged","Accepted","asdasd","2018-06-08 05:19:00","");
INSERT INTO stock_adjustments VALUES("75","ADMIN","111","1","damaged","Accepted","ASas","2018-06-08 05:20:00","");
INSERT INTO stock_adjustments VALUES("76","ADMIN","98","1","damaged","Accepted","adasd","2018-06-08 05:20:00","");
INSERT INTO stock_adjustments VALUES("77","Juan Dela Cruz","131","1","damaged","Pending","sdad","2018-06-08 05:24:00","");
INSERT INTO stock_adjustments VALUES("78","Juan Dela Cruz","83","1","damaged","Pending","asdsad","2018-06-08 05:26:00","");
INSERT INTO stock_adjustments VALUES("79","Juan Dela Cruz","18","1","damaged","Pending","sadsd","2018-06-08 05:31:00","");
INSERT INTO stock_adjustments VALUES("80","Juan Dela Cruz","8","1","damaged","Pending","asdas","2018-06-08 05:31:00","");
INSERT INTO stock_adjustments VALUES("81","Juan Dela Cruz","33","1","damaged","Pending","asdas","2018-06-08 05:31:00","");
=======
INSERT INTO stock_adjustments VALUES("31","ADMIN","86","1","damaged","Accepted","mark","2018-06-08 00:33:00","");
INSERT INTO stock_adjustments VALUES("32","ADMIN","82","2","damaged","Accepted","sasds","2018-06-08 00:34:00","");
INSERT INTO stock_adjustments VALUES("33","ADMIN","82","2","damaged","Accepted","sadasdasd","2018-06-08 00:35:00","");
INSERT INTO stock_adjustments VALUES("34","ADMIN","79","1","damaged","Accepted","sdasdas","2018-06-08 03:50:00","");
INSERT INTO stock_adjustments VALUES("35","ADMIN","83","1","damaged","Accepted","adsds","2018-06-20 12:22:00","");
INSERT INTO stock_adjustments VALUES("36","ADMIN","125","1","damaged","Accepted","asdasda","2018-06-09 12:10:00","");
INSERT INTO stock_adjustments VALUES("37","ADMIN","116","1","damaged","Accepted","asdasda","2018-06-09 12:10:00","");
INSERT INTO stock_adjustments VALUES("38","ADMIN","130","101","damaged","Accepted","asdas","2018-06-09 12:13:00","");
INSERT INTO stock_adjustments VALUES("39","ADMIN","108","10","damaged","Accepted","sadasa","2018-06-09 12:13:00","");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f



DROP TABLE users;

CREATE TABLE `users` (
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

<<<<<<< HEAD
INSERT INTO users VALUES("1","Juan Dela Cruz","12345678910","juan@gmail.com","Baguio City","$2y$10$KfNeDs7yyjq.6llgi7kNkOtEboPlArbW2jwsgVAvlw82MCHVR61Ja","tkt5hSCALIK4CP8E61YJaDnV2olowIzJ9IDf7B3Qmk6kMp0r8K8SBbr6zIND","2018-04-02 12:36:26","2018-05-30 10:43:49","active");
=======
INSERT INTO users VALUES("1","Juan Dela Cruz","12345678910","juan@gmail.com","Baguio City","$2y$10$KfNeDs7yyjq.6llgi7kNkOtEboPlArbW2jwsgVAvlw82MCHVR61Ja","h2uj1dEMhbmKhduCWijCxhE0V0gYROVEAA6WeGN9N8T5Rlypz2PIGb2mrjus","2018-04-02 12:36:26","2018-05-30 10:43:49","active");
>>>>>>> 2d156a96479225ada1c84c0a9a8128fc0dcaab6f
INSERT INTO users VALUES("4","jaramel","9876372718","jaramel@gmail.com","Loakan","$2y$10$kaTX2Yv1HO5lRfo.MIfMGODDYBiCj40nTx8AWsP4DIaO88P0Wd6BW","","2018-05-31 07:23:28","2018-05-31 07:23:28","active");



