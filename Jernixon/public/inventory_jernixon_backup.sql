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

INSERT INTO admins VALUES("1","ADMIN","admin@gmail.com","$2y$10$HpGuCVm2xV4cuj62m0dVaekc4xbDxazwNdHwUCq3XE2R2mBbfFvOW","Zc4ZxUcnP72knNBCn9HGcGqKv9kMJui5roChPRhslsbKpxwMcKneHV3Wesbt","2018-02-25 05:39:36","2018-02-25 05:39:36");



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

INSERT INTO damaged_items VALUES("","118","30","2018-06-08 15:08:38","");



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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO damaged_salable_items VALUES("16","103","","1","2018-05-30 19:14:00","");
INSERT INTO damaged_salable_items VALUES("17","50","","0","2018-05-30 19:15:00","");
INSERT INTO damaged_salable_items VALUES("18","51","","2","2018-05-30 19:15:00","");
INSERT INTO damaged_salable_items VALUES("19","145","330.00","1","2018-05-30 11:26:48","");
INSERT INTO damaged_salable_items VALUES("20","6","180.00","3","2018-05-30 12:40:15","");
INSERT INTO damaged_salable_items VALUES("21","34","","1","2018-05-30 20:41:00","");
INSERT INTO damaged_salable_items VALUES("22","151","200.00","1","2018-05-31 07:08:02","");
INSERT INTO damaged_salable_items VALUES("23","152","70.00","3","2018-05-31 07:41:30","");
INSERT INTO damaged_salable_items VALUES("24","108","","1","2018-06-05 23:12:00","");
INSERT INTO damaged_salable_items VALUES("25","127","","40","2018-06-08 15:21:00","");



DROP TABLE lost_items;

CREATE TABLE `lost_items` (
  `stock_adjustments_id` int(11) DEFAULT NULL,
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
INSERT INTO lost_items VALUES("","115","6","2018-06-08 15:30:00","");
INSERT INTO lost_items VALUES("96","1","2","2018-06-08 15:52:00","");



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

INSERT INTO notifications VALUES("01939069-d0c5-45ee-ad4e-4ba8f1fb87f2","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":77}","","2018-06-08 05:48:20","2018-06-08 05:48:20");
INSERT INTO notifications VALUES("07a5923a-5117-4633-9db9-fd60e7ef95be","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":61}","","2018-06-08 03:24:37","2018-06-08 03:24:37");
INSERT INTO notifications VALUES("0832907f-a375-4b2a-a966-6068021f9264","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":79}","","2018-06-08 06:00:41","2018-06-08 06:00:41");
INSERT INTO notifications VALUES("0f252df5-ead0-4e7f-ab18-6224992a4d26","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":80}","","2018-06-08 06:02:32","2018-06-08 06:02:32");
INSERT INTO notifications VALUES("159cc1b2-3a22-4381-b8a1-b70bea390d59","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":69}","2018-06-08 04:08:03","2018-06-08 04:04:40","2018-06-08 04:08:03");
INSERT INTO notifications VALUES("163559cf-2f5f-4c25-bbff-aad1eee1350b","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil TMX-CDI\",\"stock_id\":90}","","2018-06-08 06:48:34","2018-06-08 06:48:34");
INSERT INTO notifications VALUES("1a4032f4-0bf2-42c8-9616-2e6cd17f9cb9","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":64}","","2018-06-08 03:33:05","2018-06-08 03:33:05");
INSERT INTO notifications VALUES("24c9f087-33ac-4d63-9d48-19ac146a3986","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":57}","","2018-06-08 03:13:58","2018-06-08 03:13:58");
INSERT INTO notifications VALUES("2cc8b22d-2cf3-416b-a04c-8857b9a13c30","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":71}","","2018-06-08 04:09:18","2018-06-08 04:09:18");
INSERT INTO notifications VALUES("2e3603f2-da37-41c5-9bf1-b8cacdcba640","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil TMX-CDI\",\"stock_id\":87}","","2018-06-08 06:42:48","2018-06-08 06:42:48");
INSERT INTO notifications VALUES("2ef2f1b7-863c-4ff8-9324-b0853420add9","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":55}","","2018-06-08 03:08:27","2018-06-08 03:08:27");
INSERT INTO notifications VALUES("35cbe0a6-4805-4c98-aa95-028f76180a73","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":63}","","2018-06-08 03:29:17","2018-06-08 03:29:17");
INSERT INTO notifications VALUES("4aa39456-ab6c-47c5-a2f0-21b76b28f583","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil C100\",\"stock_id\":95}","","2018-06-08 07:31:02","2018-06-08 07:31:02");
INSERT INTO notifications VALUES("4dd6b1d8-8252-4d31-b090-532483c90149","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":68}","2018-06-08 04:08:09","2018-06-08 03:55:27","2018-06-08 04:08:09");
INSERT INTO notifications VALUES("53e44949-b2d4-4bb2-ab8f-1780131f9d10","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":59}","","2018-06-08 03:20:56","2018-06-08 03:20:56");
INSERT INTO notifications VALUES("69e2fbac-a0cc-4deb-8b31-3d2297b62960","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":61}","","2018-06-08 03:25:52","2018-06-08 03:25:52");
INSERT INTO notifications VALUES("6a198f0b-6733-4a64-aa6c-1f1f676ecff5","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":54}","","2018-06-08 03:06:18","2018-06-08 03:06:18");
INSERT INTO notifications VALUES("6c2fc232-733d-4547-ae5d-d8c9d0111ab6","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carburador Insulator CT100\",\"stock_id\":88}","","2018-06-08 06:44:16","2018-06-08 06:44:16");
INSERT INTO notifications VALUES("716e7d0c-25b2-464f-9a13-15eeaf37bbb9","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":67}","2018-06-08 04:08:14","2018-06-08 03:45:12","2018-06-08 04:08:14");
INSERT INTO notifications VALUES("7cddc8b5-6456-44f0-9c1f-68eebd342fe4","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":75}","","2018-06-08 05:08:10","2018-06-08 05:08:10");
INSERT INTO notifications VALUES("825d70d6-9c7f-4a55-ba62-44ed072829c2","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":96}","","2018-06-08 07:53:25","2018-06-08 07:53:25");
INSERT INTO notifications VALUES("83458bb5-e963-4357-bde9-32e5b7d284dc","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":76}","","2018-06-08 05:16:08","2018-06-08 05:16:08");
INSERT INTO notifications VALUES("8629d59e-71b2-4d68-bc09-7b54b9d3f924","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":66}","","2018-06-08 03:40:49","2018-06-08 03:40:49");
INSERT INTO notifications VALUES("8717f26c-0673-4777-b5dc-1b9eb8a38f1a","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":73}","","2018-06-08 04:15:36","2018-06-08 04:15:36");
INSERT INTO notifications VALUES("89f0e6aa-1a1e-4c58-9e19-e0557afc3b01","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":56}","","2018-06-08 03:11:59","2018-06-08 03:11:59");
INSERT INTO notifications VALUES("8d90b268-5847-4276-b8e4-b97df39b6ac2","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil TMX-CDI\",\"stock_id\":89}","","2018-06-08 06:46:02","2018-06-08 06:46:02");
INSERT INTO notifications VALUES("8defc409-da35-46b5-8c27-c9bccf442f77","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil TMX-CDI\",\"stock_id\":90}","","2018-06-08 06:48:34","2018-06-08 06:48:34");
INSERT INTO notifications VALUES("9120648f-6b34-4c42-be6e-98a5cddb887b","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":65}","","2018-06-08 03:38:07","2018-06-08 03:38:07");
INSERT INTO notifications VALUES("923473d1-f6a1-47d8-b203-60f3a8d36d87","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":60}","","2018-06-08 03:23:03","2018-06-08 03:23:03");
INSERT INTO notifications VALUES("9ecb1951-1f6f-4eb8-8291-45bff200b249","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":97}","2018-06-08 08:04:28","2018-06-08 07:54:33","2018-06-08 08:04:28");
INSERT INTO notifications VALUES("a06c2a9b-5b31-41e2-8330-e190479786a8","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":81}","","2018-06-08 06:04:34","2018-06-08 06:04:34");
INSERT INTO notifications VALUES("b09d685c-b239-450e-81d6-bb17b8b3bc49","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":83}","","2018-06-08 06:18:24","2018-06-08 06:18:24");
INSERT INTO notifications VALUES("b3e368e5-5c21-40ba-b8a5-b79701195245","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil C100\",\"stock_id\":84}","","2018-06-08 06:37:46","2018-06-08 06:37:46");
INSERT INTO notifications VALUES("b5c18bc8-057d-4f2a-9359-7e382602c503","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carburador Insulator CT100\",\"stock_id\":84}","","2018-06-08 06:36:26","2018-06-08 06:36:26");
INSERT INTO notifications VALUES("bef1d75f-dce7-4bef-bc88-10276cd45c0f","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":82}","","2018-06-08 06:06:13","2018-06-08 06:06:13");
INSERT INTO notifications VALUES("c0823847-4b85-4996-b609-fa56196166f7","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":74}","","2018-06-08 04:59:48","2018-06-08 04:59:48");
INSERT INTO notifications VALUES("c70fcdb9-1b74-475a-83ac-045f174850f6","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Carburador Insulator CT100\",\"stock_id\":94}","","2018-06-08 07:21:24","2018-06-08 07:21:24");
INSERT INTO notifications VALUES("c8420ab2-028e-4113-a764-ed2eb7e60218","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil CT00\",\"stock_id\":53}","","2018-06-07 04:43:41","2018-06-07 04:43:41");
INSERT INTO notifications VALUES("ce70e14b-d4cb-4e4e-aed1-9f57745953b5","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":78}","","2018-06-08 05:54:22","2018-06-08 05:54:22");
INSERT INTO notifications VALUES("d7432928-19d8-4852-bc70-56eb57b9ac52","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil TMX-CDI1\",\"stock_id\":90}","","2018-06-08 06:50:17","2018-06-08 06:50:17");
INSERT INTO notifications VALUES("e0b42497-04ec-486e-acbb-a604c965ab0e","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":58}","","2018-06-08 03:18:18","2018-06-08 03:18:18");
INSERT INTO notifications VALUES("e69b3fad-6150-48a2-975e-6831beca8960","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil TMX-CDI\",\"stock_id\":52}","","2018-06-07 04:43:41","2018-06-07 04:43:41");
INSERT INTO notifications VALUES("f1d69415-4ece-46c4-9c0b-249e98c8f7f5","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Brake Master Repair Kit Mio\",\"stock_id\":51}","","2018-06-07 04:41:22","2018-06-07 04:41:22");
INSERT INTO notifications VALUES("f37b55e7-db87-49da-a463-09f02b893ba2","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Connecting Rod KitXRM110\",\"stock_id\":70}","2018-06-08 04:07:56","2018-06-08 04:06:59","2018-06-08 04:07:56");
INSERT INTO notifications VALUES("f7ab038a-ab67-42e2-ad03-071c847781d1","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil C100\",\"stock_id\":86}","","2018-06-08 06:38:58","2018-06-08 06:38:58");
INSERT INTO notifications VALUES("fd2dc76b-5a87-4efe-bad6-900f8ea2eadd","App\\Notifications\\StockAdjustmentNotification","1","App\\Admin","{\"itemname\":\"Primary Coil TMX-CDI\",\"stock_id\":93}","","2018-06-08 06:51:17","2018-06-08 06:51:17");



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
INSERT INTO returns VALUES("1234","152","Ban","70.00","1","0","0","2018-06-06 18:48:09","");
INSERT INTO returns VALUES("100001","81","James Abalos","60.00","1","0","0","2018-06-07 00:36:48","");



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

INSERT INTO salable_items VALUES("1","150.00","180.00","26","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("2","150.00","180.00","36","2018-03-31 00:00:00","");
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
INSERT INTO salable_items VALUES("34","120.00","150.00","9","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("35","120.00","150.00","10","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("36","120.00","150.00","38","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("37","155.00","185.00","34","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("38","155.00","185.00","24","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("39","155.00","185.00","48","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("40","155.00","185.00","40","2018-03-31 00:00:00","");
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
INSERT INTO salable_items VALUES("51","287.00","317.00","38","2018-03-31 00:00:00","");
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
INSERT INTO salable_items VALUES("79","35.00","65.00","10","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("80","35.00","70.00","2","2018-03-31 00:00:00","2018-05-30 15:39:00");
INSERT INTO salable_items VALUES("81","35.00","70.00","12","2018-03-31 00:00:00","2018-05-30 16:10:39");
INSERT INTO salable_items VALUES("82","1.00","1.00","4","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("83","35.00","65.00","5","2018-03-31 00:00:00","");
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
INSERT INTO salable_items VALUES("108","53.00","83.00","5","2018-03-31 00:00:00","2018-05-26 07:38:54");
INSERT INTO salable_items VALUES("109","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("110","53.00","83.00","1","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("111","20.00","83.00","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("112","53.00","83.00","20","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("113","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("114","53.00","83.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("115","150.00","180.00","2","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("116","150.00","180.00","31","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("117","150.00","180.00","18","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("118","150.00","180.00","29","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("119","95.00","125.00","8","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("120","135.00","165.00","6","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("121","125.00","155.00","9","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("122","107.00","137.00","15","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("123","180.00","210.00","44","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("124","160.00","190.00","16","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("125","55.00","85.00","13","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("126","38.00","68.00","13","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("127","45.00","75.00","31","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("128","75.00","105.00","0","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("129","19.50","49.50","7","2018-03-31 00:00:00","");
INSERT INTO salable_items VALUES("130","32.00","62.00","6","2018-03-31 00:00:00","");
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
  `address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `sales_product_id_foreign` (`product_id`),
  CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO sales VALUES("1001","79","Jake James Manzon","","65.00","1","","","2018-05-30 19:19:00","");
INSERT INTO sales VALUES("1001","6","Jake James Manzon","","180.00","1","","","2018-05-30 19:19:00","");
INSERT INTO sales VALUES("1001","104","Jake James Manzon","","405.00","1","","","2018-05-30 19:19:00","");
INSERT INTO sales VALUES("1001","114","Jake James Manzon","","83.00","1","","","2018-05-30 19:19:00","");
INSERT INTO sales VALUES("1002","70","Caesar Romero","","155.00","0","","","2018-05-30 19:20:00","");
INSERT INTO sales VALUES("1002","39","Caesar Romero","","185.00","0","","","2018-05-30 19:20:00","");
INSERT INTO sales VALUES("1002","53","Caesar Romero","","220.00","0","","","2018-05-30 19:20:00","");
INSERT INTO sales VALUES("1002","145","Caesar Romero","","330.00","0","","","2018-05-30 19:20:00","");
INSERT INTO sales VALUES("1003","76","Nonito Cabilar","","115.00","0","","","2018-05-30 19:21:00","");
INSERT INTO sales VALUES("1003","97","Nonito Cabilar","","69.00","1","","","2018-05-30 19:21:00","");
INSERT INTO sales VALUES("1004","112","Marinel","","83.00","13","","","2018-05-30 19:29:00","");
INSERT INTO sales VALUES("1004","81","Marinel","","65.00","9","","","2018-05-30 19:29:00","");
INSERT INTO sales VALUES("1004","10","Marinel","","180.00","2","","","2018-05-30 19:29:00","");
INSERT INTO sales VALUES("1004","50","Marinel","","205.00","1","","","2018-05-30 19:29:00","");
INSERT INTO sales VALUES("100001","81","James Abalos","","60.00","0","","","2018-05-30 23:35:00","");
INSERT INTO sales VALUES("1000002","81","Marinellll","","75.00","3","","","2018-05-30 23:59:00","");
INSERT INTO sales VALUES("778","151","Jake James","","200.00","7","","","2018-05-31 15:02:00","");
INSERT INTO sales VALUES("1234","152","Ban","asda","70.00","1","","","2018-05-31 15:35:00","");
INSERT INTO sales VALUES("123","109","lan","","83.00","10","","","2018-05-31 15:52:00","");
INSERT INTO sales VALUES("12345","153","James","","50.00","10","","","2018-05-31 16:17:00","");
INSERT INTO sales VALUES("99990","138","Jake James","","260.00","1","","","2018-05-25 15:33:00","");
INSERT INTO sales VALUES("8796","108","Jake James","","83.00","10","","","2018-06-05 12:00:00","");
INSERT INTO sales VALUES("246246","108","James","","83.00","2","pcs","5","2018-06-05 15:16:00","");
INSERT INTO sales VALUES("246246","109","James","","83.00","2","pcs","5","2018-06-05 15:16:00","");



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
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

INSERT INTO stock_adjustments VALUES("51","ADMIN","109","1","damaged","Pending","dasdasda","2018-06-08 14:52:45","");
INSERT INTO stock_adjustments VALUES("52","Juan Dela Cruz","118","1","damaged","Pending","e","2018-06-08 14:52:45","");
INSERT INTO stock_adjustments VALUES("53","Juan Dela Cruz","116","1","damaged","Pending","t","2018-06-08 14:52:45","");
INSERT INTO stock_adjustments VALUES("54","ADMIN","1","1","damaged","Pending","sdfghj","2018-06-08 14:52:45","");
INSERT INTO stock_adjustments VALUES("55","Juan Dela Cruz","1","1","damaged","Pending","dfghj","2018-06-08 14:54:38","2018-06-08 03:08:37");
INSERT INTO stock_adjustments VALUES("56","Juan Dela Cruz","1","1","damaged","Pending","dfghj","2018-06-08 14:54:38","2018-06-08 03:12:09");
INSERT INTO stock_adjustments VALUES("57","Juan Dela Cruz","1","1","damaged","Pending","sdfghjk","2018-06-08 14:54:38","2018-06-08 03:14:09");
INSERT INTO stock_adjustments VALUES("58","Juan Dela Cruz","1","1","damaged","Pending","dfghj","2018-06-08 14:54:38","2018-06-08 03:18:26");
INSERT INTO stock_adjustments VALUES("59","Juan Dela Cruz","1","1","damaged","Pending","sdfghjk","2018-06-08 14:54:38","2018-06-08 03:21:05");
INSERT INTO stock_adjustments VALUES("60","Juan Dela Cruz","1","1","damaged","Pending","dfghj","2018-06-08 14:54:38","");
INSERT INTO stock_adjustments VALUES("61","Juan Dela Cruz","1","1","damaged","Pending","dfgh","2018-06-08 14:54:38","");
INSERT INTO stock_adjustments VALUES("62","Juan Dela Cruz","1","1","damaged","Accepted","dfghjk","2018-06-08 11:26:22","2018-06-08 03:26:22");
INSERT INTO stock_adjustments VALUES("63","Juan Dela Cruz","1","1","damaged","Accepted","xcvbn","2018-06-08 11:29:28","");
INSERT INTO stock_adjustments VALUES("64","Juan Dela Cruz","1","1","damaged","Accepted","xdfghj","2018-06-08 11:33:16","");
INSERT INTO stock_adjustments VALUES("65","Juan Dela Cruz","1","1","damaged","Accepted","sdfghj","2018-06-08 11:38:20","");
INSERT INTO stock_adjustments VALUES("66","Juan Dela Cruz","1","1","damaged","Accepted","dfghj","2018-06-08 11:41:03","");
INSERT INTO stock_adjustments VALUES("67","Juan Dela Cruz","1","1","damaged","Accepted","dfghj","2018-06-08 11:45:24","");
INSERT INTO stock_adjustments VALUES("68","Juan Dela Cruz","1","1","damaged","Accepted","gh","2018-06-08 11:56:10","");
INSERT INTO stock_adjustments VALUES("69","Juan Dela Cruz","1","1","damaged","Accepted","fghj","2018-06-08 12:04:52","");
INSERT INTO stock_adjustments VALUES("70","Juan Dela Cruz","1","1","damaged","Accepted","fghj","2018-06-08 12:07:09","");
INSERT INTO stock_adjustments VALUES("71","Juan Dela Cruz","1","1","damaged","Accepted","fgh","2018-06-08 12:09:26","");
INSERT INTO stock_adjustments VALUES("72","Juan Dela Cruz","1","1","damaged","Declined","ghj","2018-06-08 12:15:56","2018-06-08 04:15:56");
INSERT INTO stock_adjustments VALUES("73","Juan Dela Cruz","1","1","damaged","Accepted","dfgh","2018-06-08 12:15:45","2018-06-08 04:15:45");
INSERT INTO stock_adjustments VALUES("74","Juan Dela Cruz","1","1","damaged","Accepted","dfghj","2018-06-08 13:05:01","");
INSERT INTO stock_adjustments VALUES("75","Juan Dela Cruz","1","1","damaged","Accepted","fghjk","2018-06-08 13:08:19","");
INSERT INTO stock_adjustments VALUES("76","Juan Dela Cruz","1","1","damaged","Accepted","hjksa","2018-06-08 13:16:26","");
INSERT INTO stock_adjustments VALUES("77","Juan Dela Cruz","1","1","damaged","Accepted","dfgh","2018-06-08 13:48:37","");
INSERT INTO stock_adjustments VALUES("78","Juan Dela Cruz","1","1","damaged","Accepted","dfghj","2018-06-08 14:00:52","2018-06-08 06:00:52");
INSERT INTO stock_adjustments VALUES("79","Juan Dela Cruz","1","1","lost","Accepted","dfghj","2018-06-08 14:00:57","2018-06-08 06:00:57");
INSERT INTO stock_adjustments VALUES("80","Juan Dela Cruz","1","1","lost","Accepted","dfghg","2018-06-08 14:02:49","2018-06-08 06:02:49");
INSERT INTO stock_adjustments VALUES("81","Juan Dela Cruz","1","1","lost","Accepted","dfgh","2018-06-08 14:04:49","");
INSERT INTO stock_adjustments VALUES("82","Juan Dela Cruz","1","1","damaged","Accepted","dfghj","2018-06-08 14:06:42","");
INSERT INTO stock_adjustments VALUES("83","Juan Dela Cruz","1","1","damaged","Pending","dfghjk","2018-06-08 14:18:00","");
INSERT INTO stock_adjustments VALUES("84","Juan Dela Cruz","127","10","damaged","Accepted","asdasad","2018-06-08 14:37:11","");
INSERT INTO stock_adjustments VALUES("85","Juan Dela Cruz","115","1","damaged","Pending","sadasasd","2018-06-08 14:37:00","");
INSERT INTO stock_adjustments VALUES("86","Juan Dela Cruz","115","1","damaged","Accepted","sdasda","2018-06-08 14:39:09","");
INSERT INTO stock_adjustments VALUES("87","Juan Dela Cruz","118","4","damaged","Accepted","asdasd","2018-06-08 14:43:11","");
INSERT INTO stock_adjustments VALUES("88","Juan Dela Cruz","127","6","damaged","Accepted","asdasd","2018-06-08 14:44:32","");
INSERT INTO stock_adjustments VALUES("89","Juan Dela Cruz","118","10","damaged","Pending","sdgfhj","2018-06-08 14:45:00","");
INSERT INTO stock_adjustments VALUES("90","Juan Dela Cruz","118","5","damaged","Accepted","dgfhjkj","2018-06-08 14:49:24","");
INSERT INTO stock_adjustments VALUES("91","Juan Dela Cruz","118","5","damaged","Pending","dgfhjkj","2018-06-08 14:48:00","");
INSERT INTO stock_adjustments VALUES("92","Juan Dela Cruz","117","10","damaged","Pending","sdxghbjk","2018-06-08 14:49:00","");
INSERT INTO stock_adjustments VALUES("93","Juan Dela Cruz","118","10","damaged","Pending","nmnmnmnm","2018-06-08 15:08:38","");
INSERT INTO stock_adjustments VALUES("94","Juan Dela Cruz","127","10","damaged_salable","Pending","sadasd","2018-06-08 15:21:00","");
INSERT INTO stock_adjustments VALUES("95","Juan Dela Cruz","115","2","lost","Accepted","gvhjbnjm,","2018-06-08 15:42:00","2018-06-08 07:42:00");
INSERT INTO stock_adjustments VALUES("96","ADMIN","1","1","lost","Accepted","kqjbjwe","2018-06-08 15:52:00","");
INSERT INTO stock_adjustments VALUES("97","Juan Dela Cruz","1","1","lost","Accepted","jhdw","2018-06-08 15:54:41","2018-06-08 07:54:41");



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

INSERT INTO users VALUES("1","Juan Dela Cruz","12345678910","juan@gmail.com","Baguio City","$2y$10$KfNeDs7yyjq.6llgi7kNkOtEboPlArbW2jwsgVAvlw82MCHVR61Ja","BULPLKELp8JWcotXTedDU7s32dTMjdABzCOFi71LTUvlpJIhoCI3rkRD7z9i","2018-04-02 12:36:26","2018-05-30 10:43:49","active");
INSERT INTO users VALUES("4","jaramel","9876372718","jaramel@gmail.com","Loakan","$2y$10$kaTX2Yv1HO5lRfo.MIfMGODDYBiCj40nTx8AWsP4DIaO88P0Wd6BW","","2018-05-31 07:23:28","2018-05-31 07:23:28","active");



