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

INSERT INTO admins VALUES("1","ADMIN","admin@gmail.com","$2y$10$HpGuCVm2xV4cuj62m0dVaekc4xbDxazwNdHwUCq3XE2R2mBbfFvOW","RGWpxkA5spOOJggTSxW3lC1rEqRaTTkNpknqZPdibCnXOyyxlT95lJvnTfe2","2018-02-25 05:39:36","2018-02-25 05:39:36");



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

INSERT INTO damaged_items VALUES("1","108","1","2018-05-30 19:14:00","");
INSERT INTO damaged_items VALUES("","70","2","2018-05-30 11:22:19","");
INSERT INTO damaged_items VALUES("","151","1","2018-05-31 07:08:01","");
INSERT INTO damaged_items VALUES("8","151","20","2018-05-31 15:12:00","");
INSERT INTO damaged_items VALUES("","152","2","2018-05-31 07:41:30","");
INSERT INTO damaged_items VALUES("9","152","10","2018-05-31 15:44:00","");
INSERT INTO damaged_items VALUES("","152","1","2018-05-31 08:19:07","");
INSERT INTO damaged_items VALUES("10","153","20","2018-05-31 16:19:00","");
INSERT INTO damaged_items VALUES("11","151","10","2018-05-31 17:12:00","");
INSERT INTO damaged_items VALUES("","152","1","2018-05-31 09:47:33","");
INSERT INTO damaged_items VALUES("13","109","1","2018-06-05 12:07:00","");
INSERT INTO damaged_items VALUES("14","109","1","2018-06-05 12:13:00","");
INSERT INTO damaged_items VALUES("15","109","1","2018-06-05 12:14:00","");
INSERT INTO damaged_items VALUES("16","132","1","2018-06-05 12:16:00","");
INSERT INTO damaged_items VALUES("17","109","1","2018-06-05 12:17:00","");
INSERT INTO damaged_items VALUES("18","79","1","2018-06-05 16:53:00","");
INSERT INTO damaged_items VALUES("18","81","1","2018-06-05 16:54:00","");
INSERT INTO damaged_items VALUES("19","127","1","2018-06-05 03:53:00","");
INSERT INTO damaged_items VALUES("16","79","1","2018-06-05 04:01:00","");
INSERT INTO damaged_items VALUES("16","86","1","2018-06-05 04:02:00","");
INSERT INTO damaged_items VALUES("16","125","1","2018-06-05 04:03:00","");
INSERT INTO damaged_items VALUES("13","81","1","2018-06-05 04:04:00","");
INSERT INTO damaged_items VALUES("13","80","1","2018-06-05 04:05:00","");
INSERT INTO damaged_items VALUES("28","126","1","2018-06-05 04:07:00","");
INSERT INTO damaged_items VALUES("29","80","1","2018-06-06 11:08:00","");
INSERT INTO damaged_items VALUES("30","83","1","2018-06-06 11:10:00","");
INSERT INTO damaged_items VALUES("","79","1","2018-06-06 09:50:32","");
INSERT INTO damaged_items VALUES("","79","1","2018-06-06 09:50:34","");
INSERT INTO damaged_items VALUES("","79","1","2018-06-06 09:50:35","");
INSERT INTO damaged_items VALUES("","79","1","2018-06-06 09:50:35","");
INSERT INTO damaged_items VALUES("","6","1","2018-06-06 09:51:00","");
INSERT INTO damaged_items VALUES("32","51","1","2018-06-07 13:55:00","");



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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO damaged_salable_items VALUES("16","103","","1","2018-05-30 19:14:00","");
INSERT INTO damaged_salable_items VALUES("17","50","","0","2018-05-30 19:15:00","");
INSERT INTO damaged_salable_items VALUES("18","51","","2","2018-05-30 19:15:00","");
INSERT INTO damaged_salable_items VALUES("19","145","330.00","1","2018-05-30 11:26:48","");
INSERT INTO damaged_salable_items VALUES("20","6","180.00","3","2018-05-30 12:40:15","");
INSERT INTO damaged_salable_items VALUES("21","34","","1","2018-05-30 20:41:00","");
INSERT INTO damaged_salable_items VALUES("22","151","200.00","1","2018-05-31 07:08:02","");
INSERT INTO damaged_salable_items VALUES("23","152","70.00","3","2018-05-31 07:41:30","");
INSERT INTO damaged_salable_items VALUES("24","108","","1","2018-06-05 23:12:00","");



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

INSERT INTO lost_items VALUES("1","109","1","2018-05-30 19:14:00","");
INSERT INTO lost_items VALUES("12","154","1","2018-05-31 17:15:00","");
INSERT INTO lost_items VALUES("18","108","1","2018-06-05 12:18:00","");
INSERT INTO lost_items VALUES("31","34","1","2018-06-07 13:55:00","");



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

INSERT INTO notifications VALUES("06848d81-e135-4a3a-8961-a6010573521d","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":0,\"description\":\"Carbon Brush Crypton\"}","","2018-06-06 06:06:44","2018-06-06 06:06:44");
INSERT INTO notifications VALUES("0b814b8b-1936-4fba-a641-8b83ccbadbd1","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":0,\"description\":\"Carbon Brush Crypton\"}","","2018-06-06 06:06:44","2018-06-06 06:06:44");
INSERT INTO notifications VALUES("0f0d5f6e-4013-466f-8d12-20eeb9c425c0","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":2,\"description\":\"Clutch LiningCT100\\/BAJAJ\"}","","2018-06-06 06:03:43","2018-06-06 06:03:43");
INSERT INTO notifications VALUES("1a99a6c5-fd6a-4001-9db1-fdfcc57d2db0","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Mio\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James Manzon\"}","","2018-06-06 09:50:35","2018-06-06 09:50:35");
INSERT INTO notifications VALUES("1ad803cc-39ca-41d4-8039-7658e4047181","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":1,\"description\":\"Clutch LiningCT100\\/BAJAJ\"}","","2018-06-06 06:05:19","2018-06-06 06:05:19");
INSERT INTO notifications VALUES("20294e9c-1da1-4dfe-a7a2-dc9f82e816fe","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":1,\"description\":\"Clutch LiningCT100\\/BAJAJ\"}","","2018-06-06 06:05:19","2018-06-06 06:05:19");
INSERT INTO notifications VALUES("3b388a5d-dde0-4769-a1c6-b5df997b5d67","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":1,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-06 06:04:35","2018-06-06 06:04:35");
INSERT INTO notifications VALUES("4dc8f845-64ec-474b-86f2-0b83f2d9d6a3","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Mio\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James Manzon\"}","","2018-06-06 09:50:36","2018-06-06 09:50:36");
INSERT INTO notifications VALUES("5505bbef-6831-44ca-9ec4-024192af6acc","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Regulator Raider J\",\"stock_id\":32}","","2018-06-07 05:56:00","2018-06-07 05:56:00");
INSERT INTO notifications VALUES("663b2056-a290-4f62-8df6-89b3fc1ac910","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":2,\"description\":\"Clutch LiningCT100\\/BAJAJ\"}","","2018-06-06 06:03:43","2018-06-06 06:03:43");
INSERT INTO notifications VALUES("8c0942de-4f7f-4463-8cc4-981e88e49c9f","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitSTX\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James Manzon\"}","","2018-06-06 09:51:00","2018-06-06 09:51:00");
INSERT INTO notifications VALUES("8cbfd4b8-001f-4c3b-ba82-918d6661d898","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Clutch LiningCT100\\/BAJAJ\",\"stock_id\":31}","","2018-06-07 05:56:00","2018-06-07 05:56:00");
INSERT INTO notifications VALUES("8eeb880f-4d73-4161-ad8c-a4e25050b6e4","App\\Notifications\\ReorderNotification","1","App\\User","{\"quantity\":2,\"description\":\"Clutch LiningCT100\\/BAJAJ\"}","","2018-06-06 06:03:43","2018-06-06 06:03:43");
INSERT INTO notifications VALUES("93cff181-c36f-4bf1-90b2-a73995c5357f","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":1,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-06 06:04:35","2018-06-06 06:04:35");
INSERT INTO notifications VALUES("9f59d8f7-d450-4a80-a233-31e13545515b","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":1,\"description\":\"Brake Master Repair Kit GLPRO\"}","","2018-06-06 06:04:35","2018-06-06 06:04:35");
INSERT INTO notifications VALUES("a150569b-e220-4ef6-b714-4f6cee3892b8","App\\Notifications\\ReorderNotification","4","App\\User","{\"quantity\":0,\"description\":\"Carbon Brush Crypton\"}","","2018-06-06 06:06:44","2018-06-06 06:06:44");
INSERT INTO notifications VALUES("a332c3f8-971d-4010-9274-00e5ceaf32b6","App\\Notifications\\ReorderNotification","1","App\\Admin","{\"quantity\":1,\"description\":\"Clutch LiningCT100\\/BAJAJ\"}","","2018-06-06 06:05:19","2018-06-06 06:05:19");
INSERT INTO notifications VALUES("a9e70c14-d2d5-4df8-8a69-8c0b2953aaae","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Mio\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James Manzon\"}","","2018-06-06 09:50:35","2018-06-06 09:50:35");
INSERT INTO notifications VALUES("af9b6e80-43c5-47cd-a3e1-7f7aa2081529","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Sniper\",\"stock_id\":\"30\"}","","2018-06-06 03:10:43","2018-06-06 03:10:43");
INSERT INTO notifications VALUES("c29b48e8-69f2-46ed-ac26-2e3b4ca81ef7","App\\Notifications\\ReturnNotification","1","App\\Admin","{\"itemname\":\"Carbon Brush Mio\",\"quantity\":\"1\",\"type\":\"Damaged Items\",\"Customer\":\"Jake James Manzon\"}","","2018-06-06 09:50:35","2018-06-06 09:50:35");



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



DROP TABLE physical_counts;

CREATE TABLE `physical_counts` (
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `date` date NOT NULL DEFAULT '2017-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO physical_counts VALUES("inactive","2018-06-03");



DROP TABLE products;

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('available','unavailable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `reorder_level` int(11) NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `products_product_id_unique` (`product_id`),
  UNIQUE KEY `products_description_unique` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES("1","Connecting Rod KitXRM110","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("2","Connecting Rod KitBILP/HD3","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("3","Connecting Rod KitSMASH","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("4","Connecting Rod KitXLR","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("5","Connecting Rod KitBARAKO 175","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("6","Connecting Rod KitSTX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("7","Connecting Rod KitDT125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("8","Connecting Rod KitSHOGUN","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("9","Connecting Rod KitRUSI 150","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("10","Connecting Rod KitX4/GP125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("11","Stator Assy.STX 8 COILS","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("12","Stator Assy.STX 16 COILS","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("13","Stator Assy.LIFAN125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("14","Stator Assy.BC175","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("15","Stator Assy.C100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("16","Stator Assy.TMX-CP","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("17","Stator Assy.XLR 200/GS185/150","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("18","Stator Assy.MOTOR STAR","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("19","Stator Assy.WAVE125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("20","Stator Assy.LIFAN150","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("21","Stator Assy.XRM110","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("22","Stator Assy.TMX-CDI W/BASE","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("23","Clutch LiningLIFAN110","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("24","Clutch LiningXRM110","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("25","Clutch LiningTMX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("26","Clutch LiningWAVE125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("27","Clutch LiningCRYPTON","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("28","Clutch LiningRS100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("29","Clutch LiningSTX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("30","Clutch LiningHD3/B1LP","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("31","Clutch LiningBS175","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("32","Clutch LiningAURA","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("33","Clutch LiningWIND125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("34","Clutch LiningCT100/BAJAJ","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("35","Clutch LiningX4/GP125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("36","Clutch LiningB120/SMASH","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("37","Clutch LiningG7S","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("38","CDI UnitTMX155","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("39","CDI UnitC100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("40","CDI UnitWAVE125-CDI 5 Pins","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("41","CDI UnitXRM110 5 Pins","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("42","CDI UnitCRYPTON","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("43","Pulser CoilCT100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("44","Pulser CoilBC175","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("45","Pulser CoilCRYPTON","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("46","Pulser CoilLifan100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("47","Pulser CoilLifan150","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("48","Pulser CoilTMX-CDI TYPE","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("49","Regulator 4 Wires","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("50","Regulator 5 Wires","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("51","Regulator Raider J","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("52","Regulator Rectifier Barako","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("53","Regulator Rectifier Crypton","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("54","Regulator Rectifier CT100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("55","Regulator Rectifier GS125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("56","Regulator Rectifier Mio","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("57","Regulator Rectifier RS100 12v WWII","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("58","Regulator Rectifier  Smash","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("59","Regulator Rectifier Wave100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("60","Regulator Rectifier Wave110/XRM","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("61","Regulator Rectifier Wind125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("62","Regulator Rectifier Rusi/TC125 4+1 WII","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("63","Regulator Rectifier C100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("64","Regulator Rectifier TMX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("65","Fuel Cock B1LP/HD3","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("66","Fuel Cock BC175","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("67","Fuel Cock C100/Dream/XRM","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("68","Fuel Cock CG125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("69","Fuel Cock Crypton","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("70","Fuel Cock G75","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("71","Fuel Cock GP125/X4/X120","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("72","Magneto Kit TMX Silicon Gray","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("73","Magneto Kit XRM Silicon-Red","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("74","Magneto Kit C100 Silcon-Red","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("75","Magneto Kit TMX BLK","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("76","Magneto Kit C100 BLK","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("77","Magneto Kit Rusi125/110 BLK","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("78","Magneto Kit Rusi125/110 Silicon-Red","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("79","Carbon Brush Mio","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("80","Carbon Brush Shogun","available","5","2018-03-01 00:00:00","2018-05-30 15:39:00");
INSERT INTO products VALUES("81","Carbon Brush Smash","available","5","2018-03-01 00:00:00","2018-05-30 16:10:39");
INSERT INTO products VALUES("82","Carbon Brush XRM","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("83","Carbon Brush Sniper","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("84","Carbon Brush With Housing","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("85","Carbon Brush Wave125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("86","Carbon Brush Crypton","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("87","Rocker Arm W/tappet Screw XM","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("88","Rocker Arm W/tappet Screw TMX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("89","Rocker Arm W/tappet Screw Barako","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("90","Rocker Arm W/tappet Screw Mio","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("91","Rocker Arm W/tappet Screw STX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("92","Rocker Arm W/tappet Screw Shogun","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("93","Rocker Arm W/tappet Screw Smash","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("94","Rocker Arm W/tappet Screw Fury","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("95","Rocker Arm Wave125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("96","Cylinder Head Packing-Red TMX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("97","Cylinder Head Packing-Silicon TMX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("98","Cylinder Head Packing-BLK TMX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("99","Wire Harness RS100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("100","Wire Harness TMX/CPT1","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("101","Wire Harness TMX/CPT","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("102","Wire Harness HD3/CDI","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("103","Wire Harness HD3","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("104","Wire Harness XRM","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("105","Wire Harness STX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("106","Brake Master Repair Kit Raider150","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("107","Brake Master Repair Kit Wave125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("108","Brake Master Repair Kit GLPRO","available","6","2018-03-01 00:00:00","2018-05-26 07:38:53");
INSERT INTO products VALUES("109","Brake Master Repair Kit Mio","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("110","Brake Master Repair Kit XRM110/W110","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("111","Brake Master Repair Kit Shogun","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("112","Brake Master Repair Kit Trinity","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("113","Brake Master Repair Kit Raider110","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("114","Brake Master Repair Kit Smash","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("115","Primary Coil C100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("116","Primary Coil CT00","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("117","Primary Coil TMX-CDI1","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("118","Primary Coil TMX-CDI","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("119","Fulser Coil Lifan150","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("120","Fulser Coil BC175","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("121","Fulser Coil CT100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("122","Fulser Coil Crypton","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("123","Fulser Coil MSX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("124","Fulser Coil TMX/CDI","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("125","Carburador Insulator GY6125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("126","Carburador Insulator CG125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("127","Carburador Insulator CT100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("128","Carburador Insulator GS125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("129","Carburador Insulator XRM","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("130","Carburador Insulator BC175","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("131","Carburador Insulator TMX Fibra","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("132","Carburador Insulator TMX Alloy","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("133","Carburador Insulator TMX Rubberize","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("134","Handle Switch Assy. BC175 L/H","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("135","Handle Switch Assy. DT125 R/H","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("136","Handle Switch Assy. DT125 L/H","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("137","Handle Switch Assy. RS100 L/H","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("138","Handle Switch Assy. XRM-Old L/H","available","5","2018-03-01 00:00:00","2018-06-02 13:11:55");
INSERT INTO products VALUES("139","Handle Switch Assy. XRM-New L/H","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("140","Handle Switch Assy. RM-Neww R/H","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("141","Neutral Switch Indicator Crypton","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("142","Neutral Switch Indicator C100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("143","Neutral Switch Indicator Wave125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("144","Neutral Switch Indicator XRM","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("145","Neutral Switch Indicator STX","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("146","Neutral Switch Indicator CT100","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("147","Valve Guide Set CG125","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("148","Valve Guide Set TMX CPT.","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("149","Valve Guide Set TMXCDI","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("150","Valve Guide Set XRM","available","5","2018-03-01 00:00:00","");
INSERT INTO products VALUES("151","Item 100","available","5","2018-05-31 06:56:20","2018-05-31 06:58:53");
INSERT INTO products VALUES("152","item3","available","4","2018-05-31 07:27:54","2018-05-31 07:31:26");
INSERT INTO products VALUES("153","Item 40","available","5","2018-05-31 08:13:30","2018-05-31 08:15:22");
INSERT INTO products VALUES("154","item 101","available","5","2018-05-31 08:29:59","2018-05-31 08:32:20");



DROP TABLE purchases;

CREATE TABLE `purchases` (
  `po_id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(7,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `purchases_product_id_foreign` (`product_id`),
  CONSTRAINT `purchases_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO purchases VALUES("1","82","Honda","5","","1.00","2018-04-06 00:00:00","");
INSERT INTO purchases VALUES("1","19","Honda","7","","1.00","2018-04-06 00:00:00","");
INSERT INTO purchases VALUES("1","147","Honda","7","","1.00","2018-04-06 00:00:00","");
INSERT INTO purchases VALUES("909090","111","lol","2","","5.00","2018-05-30 18:17:00","");
INSERT INTO purchases VALUES("90901","111","lla","1","","10.00","2018-05-30 18:20:00","");
INSERT INTO purchases VALUES("90902","111","aa","2","","10.00","2018-05-30 18:21:00","");
INSERT INTO purchases VALUES("90903","111","aaae","5","","15.00","2018-05-30 18:22:00","");
INSERT INTO purchases VALUES("90904","111","aaa","2","","20.00","2018-05-30 18:39:00","");
INSERT INTO purchases VALUES("1001","108","Yamaha","25","","53.00","2018-05-30 18:52:00","");
INSERT INTO purchases VALUES("1001","112","Yamaha","35","","53.00","2018-05-30 18:52:00","");
INSERT INTO purchases VALUES("1001","109","Yamaha","28","","53.00","2018-05-30 18:52:00","");
INSERT INTO purchases VALUES("445","151","Honda","100","","150.00","2018-05-31 14:58:00","");
INSERT INTO purchases VALUES("12312","152","nm","100","","50.00","2018-05-31 15:29:00","");
INSERT INTO purchases VALUES("200","153","honda","50","","40.00","2018-05-31 16:13:00","");
INSERT INTO purchases VALUES("1011","154","yamaha","10","","50.00","2018-05-31 16:31:00","");
INSERT INTO purchases VALUES("1234","154","Honda","5","","50.00","2018-05-31 16:37:00","");



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

INSERT INTO returns VALUES("1002","70","Caesar Romero","155.00","2","1","0","2018-05-30 19:22:19","");
INSERT INTO returns VALUES("1002","39","Caesar Romero","185.00","0","1","0","2018-05-30 19:25:44","");
INSERT INTO returns VALUES("1002","53","Caesar Romero","220.00","0","1","0","2018-05-30 19:26:23","");
INSERT INTO returns VALUES("1002","145","Caesar Romero","330.00","0","0","1","2018-05-30 19:26:48","");
INSERT INTO returns VALUES("1001","79","Jake James Manzon","65.00","0","1","0","2018-05-30 20:16:51","");
INSERT INTO returns VALUES("1003","76","Nonito Cabilar","115.00","0","1","0","2018-05-30 20:19:48","");
INSERT INTO returns VALUES("1001","6","Jake James Manzon","180.00","0","0","1","2018-05-30 20:40:15","");
INSERT INTO returns VALUES("1001","6","Jake James Manzon","180.00","0","0","1","2018-05-30 22:06:15","");
INSERT INTO returns VALUES("1001","6","Jake James Manzon","180.00","0","0","1","2018-05-30 22:12:31","");
INSERT INTO returns VALUES("778","151","Jake James","200.00","1","1","1","2018-05-31 15:08:01","");
INSERT INTO returns VALUES("1234","152","Ban","70.00","2","1","2","2018-05-31 15:41:30","");
INSERT INTO returns VALUES("1234","152","Ban","70.00","1","0","1","2018-05-31 16:19:07","");
INSERT INTO returns VALUES("1234","152","Ban","70.00","1","0","0","2018-05-31 17:47:33","");
INSERT INTO returns VALUES("1001","79","Jake James Manzon","65.00","1","0","0","2018-06-06 17:50:31","");
INSERT INTO returns VALUES("1001","79","Jake James Manzon","65.00","1","0","0","2018-06-06 17:50:34","");
INSERT INTO returns VALUES("1001","79","Jake James Manzon","65.00","1","0","0","2018-06-06 17:50:35","");
INSERT INTO returns VALUES("1001","79","Jake James Manzon","65.00","1","0","0","2018-06-06 17:50:35","");
INSERT INTO returns VALUES("1001","6","Jake James Manzon","180.00","1","0","0","2018-06-06 17:51:00","");



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
INSERT INTO salable_items VALUES("6","150.00","180.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("7","150.00","180.00","27","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("8","150.00","180.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("9","150.00","180.00","24","2018-03-31 00:00:00","");
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
INSERT INTO salable_items VALUES("23","120.00","150.00","20","2018-03-31 00:00:00","");
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
INSERT INTO salable_items VALUES("34","120.00","150.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("35","120.00","150.00","10","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("36","120.00","150.00","38","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("37","155.00","185.00","34","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("38","155.00","185.00","24","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("39","155.00","185.00","48","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("40","155.00","185.00","41","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("41","155.00","185.00","10","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("42","155.00","185.00","30","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("43","155.00","185.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("44","155.00","185.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("45","155.00","185.00","23","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("46","155.00","185.00","32","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("47","155.00","185.00","29","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("48","155.00","185.00","13","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("49","200.00","230.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("50","205.00","235.00","26","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("51","287.00","317.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("52","190.00","220.00","40","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("53","190.00","220.00","48","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("54","287.00","317.00","23","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("55","287.00","317.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("56","287.00","317.00","40","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("57","95.00","125.00","25","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("58","186.00","216.00","19","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("59","186.00","216.00","22","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("60","186.00","216.00","9","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("61","270.00","300.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("62","286.00","316.00","39","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("63","150.00","180.00","20","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("64","186.00","216.00","27","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("65","125.00","155.00","5","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("66","125.00","155.00","27","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("67","75.00","105.00","10","2018-03-31 00:00:00","");
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
INSERT INTO salable_items VALUES("79","35.00","65.00","11","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("80","35.00","70.00","3","2018-03-31 00:00:00","2018-05-30 15:39:00");
INSERT INTO salable_items VALUES("81","35.00","70.00","12","2018-03-31 00:00:00","2018-05-30 16:10:39");
INSERT INTO salable_items VALUES("82","1.00","1.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("83","35.00","65.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("84","90.00","120.00","35","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("85","35.00","65.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("86","35.00","65.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("87","195.00","225.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("88","403.00","433.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("89","225.00","255.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("90","225.00","255.00","5","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("91","225.00","255.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("92","225.00","255.00","22","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("93","225.00","255.00","38","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("94","403.00","433.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("95","403.00","433.00","16","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("96","37.00","67.00","17","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("97","39.00","69.00","44","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("98","25.00","55.00","25","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("99","375.00","405.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("100","375.00","405.00","37","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("101","375.00","405.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("102","375.00","405.00","8","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("103","375.00","405.00","46","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("104","375.00","405.00","42","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("105","375.00","405.00","34","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("106","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("107","53.00","83.00","3","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("108","53.00","83.00","1","2018-03-31 00:00:00","2018-05-26 07:38:54");
INSERT INTO salable_items VALUES("109","53.00","83.00","1","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("110","53.00","83.00","1","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("111","20.00","83.00","8","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("112","53.00","83.00","20","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("113","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("114","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("115","150.00","180.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("116","150.00","180.00","32","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("117","150.00","180.00","18","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("118","150.00","180.00","31","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("119","95.00","125.00","8","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("120","135.00","165.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("121","125.00","155.00","9","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("122","107.00","137.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("123","180.00","210.00","44","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("124","160.00","190.00","16","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("125","55.00","85.00","13","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("126","38.00","68.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("127","45.00","75.00","31","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("128","75.00","105.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("129","19.50","49.50","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("130","32.00","62.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("131","19.50","49.50","46","2018-03-31 00:00:00","");
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
INSERT INTO salable_items VALUES("147","1.00","1.00","10","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("148","75.00","105.00","36","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("149","75.00","105.00","26","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("150","75.00","105.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("151","150.00","200.00","61","2018-05-31 06:56:20","2018-05-31 06:58:54");
INSERT INTO salable_items VALUES("152","50.00","70.00","81","2018-05-31 07:27:54","2018-05-31 07:31:26");
INSERT INTO salable_items VALUES("153","40.00","50.00","20","2018-05-31 08:13:30","2018-05-31 08:15:22");
INSERT INTO salable_items VALUES("154","50.00","70.00","14","2018-05-31 08:29:59","2018-05-31 08:32:20");



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
  KEY `sales_product_id_foreign` (`product_id`),
  CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO sales VALUES("1001","79","Jake James Manzon","65.00","-3","2018-05-30 19:19:00","","","");
INSERT INTO sales VALUES("1001","6","Jake James Manzon","180.00","0","2018-05-30 19:19:00","","","");
INSERT INTO sales VALUES("1001","104","Jake James Manzon","405.00","1","2018-05-30 19:19:00","","","");
INSERT INTO sales VALUES("1001","114","Jake James Manzon","83.00","1","2018-05-30 19:19:00","","","");
INSERT INTO sales VALUES("1002","70","Caesar Romero","155.00","0","2018-05-30 19:20:00","","","");
INSERT INTO sales VALUES("1002","39","Caesar Romero","185.00","0","2018-05-30 19:20:00","","","");
INSERT INTO sales VALUES("1002","53","Caesar Romero","220.00","0","2018-05-30 19:20:00","","","");
INSERT INTO sales VALUES("1002","145","Caesar Romero","330.00","0","2018-05-30 19:20:00","","","");
INSERT INTO sales VALUES("1003","76","Nonito Cabilar","115.00","0","2018-05-30 19:21:00","","","");
INSERT INTO sales VALUES("1003","97","Nonito Cabilar","69.00","1","2018-05-30 19:21:00","","","");
INSERT INTO sales VALUES("1004","112","Marinel","83.00","13","2018-05-30 19:29:00","","","");
INSERT INTO sales VALUES("1004","81","Marinel","65.00","9","2018-05-30 19:29:00","","","");
INSERT INTO sales VALUES("1004","10","Marinel","180.00","2","2018-05-30 19:29:00","","","");
INSERT INTO sales VALUES("1004","50","Marinel","205.00","1","2018-05-30 19:29:00","","","");
INSERT INTO sales VALUES("100001","81","James Abalos","60.00","1","2018-05-30 23:35:00","","","");
INSERT INTO sales VALUES("1000002","81","Marinellll","75.00","3","2018-05-30 23:59:00","","","");
INSERT INTO sales VALUES("778","151","Jake James","200.00","7","2018-05-31 15:02:00","","","");
INSERT INTO sales VALUES("1234","152","Ban","70.00","2","2018-05-31 15:35:00","","","");
INSERT INTO sales VALUES("123","109","lan","83.00","10","2018-05-31 15:52:00","","","");
INSERT INTO sales VALUES("12345","153","James","50.00","10","2018-05-31 16:17:00","","","");
INSERT INTO sales VALUES("99990","138","Jake James","260.00","1","2018-05-25 15:33:00","","","");
INSERT INTO sales VALUES("8796","108","Jake James","83.00","10","2018-06-05 12:00:00","","","");
INSERT INTO sales VALUES("246246","108","James","83.00","2","2018-06-05 15:16:00","","pcs","5");
INSERT INTO sales VALUES("246246","109","James","83.00","2","2018-06-05 15:16:00","","pcs","5");
INSERT INTO sales VALUES("45678","34","dfghj","150.00","7","2018-06-06 14:03:00","","pcs","0");
INSERT INTO sales VALUES("789","108","dfghj","83.00","4","2018-06-06 14:04:00","","pcs","0");
INSERT INTO sales VALUES("5678","34","rtyui","150.00","1","2018-06-06 14:05:00","","pcs","0");
INSERT INTO sales VALUES("1","51","fghjk","317.00","1","2018-06-06 01:01:00","","pcs","");
INSERT INTO sales VALUES("1","51","fghjk","317.00","1","2018-06-06 01:01:00","","pcs","");
INSERT INTO sales VALUES("97","86","rtyu","65.00","1","2018-06-06 13:00:00","","pcs","");



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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

INSERT INTO stock_adjustments VALUES("28","ADMIN","126","1","damaged","Accepted","damaged by rats","2018-06-05 04:07:00","");
INSERT INTO stock_adjustments VALUES("29","ADMIN","80","1","damaged","Accepted","adsada","2018-06-06 11:08:00","");
INSERT INTO stock_adjustments VALUES("30","ADMIN","83","1","damaged","Accepted","asdsad","2018-06-06 11:10:00","");
INSERT INTO stock_adjustments VALUES("31","ADMIN","34","1","lost","Accepted","fghjk","2018-06-07 13:55:00","");
INSERT INTO stock_adjustments VALUES("32","ADMIN","51","1","damaged","Accepted","fghj","2018-06-07 13:55:00","");



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

INSERT INTO users VALUES("1","Juan Dela Cruz","12345678910","juan@gmail.com","Baguio City","$2y$10$KfNeDs7yyjq.6llgi7kNkOtEboPlArbW2jwsgVAvlw82MCHVR61Ja","arJhTWioUCjwwiHJKRknTyk0YIChcrUwyKaRDR3DkJ5AUwY0bfCMFh0zn0hv","2018-04-02 12:36:26","2018-05-30 10:43:49","active");
INSERT INTO users VALUES("4","jaramel","9876372718","jaramel@gmail.com","Loakan","$2y$10$kaTX2Yv1HO5lRfo.MIfMGODDYBiCj40nTx8AWsP4DIaO88P0Wd6BW","","2018-05-31 07:23:28","2018-05-31 07:23:28","active");



