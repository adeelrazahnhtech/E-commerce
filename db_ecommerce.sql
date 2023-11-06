-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 08:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`) VALUES
(1, 'ZACHERY MOSLEY', '1697442761.png', 1),
(2, 'YOLANDA HUBER', '1697442780.jpg', 1),
(3, 'MR KEIKO', '1697447897.jpg', 0);

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
(1, '2013_10_14_131115_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_10_07_093906_create_categories_table', 1),
(7, '2023_10_07_124652_update_users_table', 1),
(8, '2023_10_07_124653_create_products_table', 1),
(9, '2023_10_12_124440_update_products_table', 1),
(10, '2023_10_14_093547_create_packages_table', 1),
(11, '2023_10_14_133911_updata_users_table', 1),
(12, '2023_10_16_142918_create_userpackages_table', 2),
(13, '2019_05_03_000001_create_customer_columns', 3),
(14, '2019_05_03_000002_create_subscriptions_table', 3),
(15, '2019_05_03_000003_create_subscription_items_table', 3),
(16, '2023_10_20_101403_create_user_packages_table', 4),
(17, '2023_10_20_105029_create_userpackages_table', 5),
(18, '2023_10_20_135357_create_orders_table', 6),
(19, '2023_10_20_135605_create_order_products_table', 6),
(20, '2023_10_21_090644_alter_order_products', 7),
(21, '2023_10_21_091138_alter_order_products', 8),
(22, '2023_10_24_090000_create_order_products_table', 9),
(23, '2023_10_24_090452_create_order_product_table', 10),
(24, '2023_10_25_083109_create_reviews_table', 11),
(25, '2023_10_25_102740_create_reviews_table', 12),
(26, '2023_10_25_104020_create_reviews_table', 13),
(27, '2023_10_25_110647_create_reviews_table', 14),
(28, '2023_10_28_074855_create_reviews_table', 15),
(29, '2023_10_28_092130_create_sub_admins_table', 16),
(30, '2023_10_28_114314_create_sub_admins_table', 17),
(31, '2023_11_02_135142_create_reviews_table', 18),
(32, '2023_11_03_212133_create_products_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `status` enum('pending','paid','unpaid') NOT NULL DEFAULT 'paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `payment_id`, `status`, `created_at`, `updated_at`) VALUES
(17, 2, 'pi_3O52ntBbNjVdsPVx19XjYJAw', 'paid', '2023-10-25 03:51:09', '2023-10-25 03:51:09'),
(18, 2, 'pi_3O5O1dBbNjVdsPVx17ubhM4y', 'paid', '2023-10-26 02:30:45', '2023-10-26 02:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `product_id`, `order_id`, `quantity`, `created_at`, `updated_at`) VALUES
(18, 1, 17, 1, NULL, NULL),
(20, 2, 17, 1, NULL, NULL),
(22, 5, 17, 1, NULL, NULL),
(23, 1, 18, 1, NULL, NULL),
(24, 3, 18, 1, NULL, NULL),
(25, 1, 18, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `duration_unit` enum('weeks','months','years') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `description`, `price`, `duration`, `duration_unit`, `created_at`, `updated_at`) VALUES
(1, 'Esse autem consequa', 'Commodo dignissimos', 525.00, '1', 'months', '2023-08-25 04:24:45', '2023-10-16 04:24:45'),
(2, 'new package updated', 'Tenetur saepe est ea', 345.00, '9', 'weeks', '2023-10-16 04:25:13', '2023-10-16 05:03:58');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` double NOT NULL,
  `track_qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `seller_id`, `sub_admin_id`, `title`, `description`, `price`, `track_qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 20, 'A aspernatur commodo', 'Dicta dolor nisi ven', 503, 858, 1, NULL, NULL),
(2, 3, NULL, 20, 'Tempor quod iste mag', 'Omnis ut id ex at en', 467, 553, 1, NULL, NULL),
(3, 2, NULL, 20, 'Eiusmod temporibus e', 'In eiusmod quia enim', 669, 606, 1, NULL, NULL),
(4, 3, NULL, 20, 'Voluptatem aut labor', 'Corrupti magnam exe', 710, 100, 1, NULL, NULL),
(5, 1, 5, NULL, 'Fugiat consequuntur', 'Cupidatat commodo et', 518, 33, 1, NULL, NULL),
(6, 3, 5, NULL, 'Amet quo optio rer', 'Facere molestiae dol', 887, 286, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `review` text NOT NULL,
  `reviewable_type` varchar(255) NOT NULL,
  `reviewable_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `rating`, `review`, `reviewable_type`, `reviewable_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 3, '1', 'good', 'App\\Models\\SubAdmin', 20, 1, '2023-11-06 13:21:02', '2023-11-06 14:29:11'),
(7, 4, '3', 'awesome', 'App\\Models\\SubAdmin', 20, 0, '2023-11-06 13:21:14', '2023-11-06 13:21:14'),
(8, 5, '1', 'good', 'App\\Models\\User', 5, 1, '2023-11-06 13:50:19', '2023-11-06 14:29:08'),
(9, 6, '1', 'not good', 'App\\Models\\User', 5, 0, '2023-11-06 13:50:35', '2023-11-06 13:50:35'),
(10, 1, '4', 'awesome', 'App\\Models\\User', 1, 1, '2023-11-06 14:28:54', '2023-11-06 14:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_type`) VALUES
(1, 'Admin'),
(2, 'seller'),
(3, 'user'),
(4, 'SubAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `sub_admins`
--

CREATE TABLE `sub_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` bigint(20) UNSIGNED NOT NULL,
  `email_verified` tinyint(1) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_admins`
--

INSERT INTO `sub_admins` (`id`, `name`, `email`, `role`, `email_verified`, `token`, `password`, `created_at`, `updated_at`) VALUES
(13, 'Cathleen Bradley', 'sysevaf@mailinator.com', 4, NULL, '653fe9a3a10bb', 'Pa$$w0rd!', '2023-10-30 12:36:35', '2023-10-30 12:36:35'),
(14, 'Keaton Perry', 'xyqyl@mailinator.com', 4, NULL, '653fea7fa5dcb', 'Pa$$w0rd!', '2023-10-30 12:40:15', '2023-10-30 12:40:15'),
(18, 'Hayden Bullock', 'aadeelraza21@gmail.com', 4, 1, '', '12345', '2023-10-30 13:06:06', '2023-10-30 13:06:30'),
(19, 'Wynter Baird', 'cupotow@mailinator.com', 4, 1, '653ff4a7b106b', '12345', '2023-10-30 13:23:35', '2023-10-30 13:23:35'),
(20, 'Robin Branch', 'hehesy@mailinator.com', 4, 1, '653ff5a4397b2', '$2y$10$ciAfB9CAGdmGPNfpIGzZ/.V1ZVIbfwUvgbQ0/Pq/FDImr6uBlYHqe', '2023-10-30 13:27:48', '2023-10-30 13:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `userpackages`
--

CREATE TABLE `userpackages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userpackages`
--

INSERT INTO `userpackages` (`id`, `user_id`, `package_id`, `payment_id`, `created_at`, `updated_at`) VALUES
(8, 2, 1, 'pi_3O4lh5BbNjVdsPVx1N0UPyY4', '2023-10-24 09:34:59', '2023-10-24 09:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` bigint(20) UNSIGNED NOT NULL,
  `email_verified` tinyint(1) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified`, `token`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Waqas', 'admin@gmail.com', 1, NULL, NULL, '$2y$10$IPTJzydls5jivd9SC2xGM.7s6.I9cEbzLABPbz.IDmP5HkXQWmD7a', NULL, NULL, NULL),
(2, 'User', 'user@gmail.com', 3, 1, '652aa7260b829', '$2y$10$PCOH8SpgcNpwCkpZatQxqeKkeGJ35rY3CfP9l94xgu7z/wCe2W7ee', NULL, '2023-10-14 09:35:18', '2023-10-14 09:35:18'),
(5, 'sameer seller', 'sameer@mailinator.com', 2, 1, '652cf60342ba1', '$2y$10$v3RbwvDhqVjG9ulpExa4vewualKOc1UhF.oMbd8kOh5M42ChFEp.2', NULL, '2023-10-16 03:36:19', '2023-10-16 03:36:19'),
(7, 'Sub Admin', 'subadmin@gmail.com', 2, NULL, '653cf1368b0ec', '$2y$10$mQ3ThRNNkhC..Fa8U3zKUeKoMQSikbeXQC9RzZHjlRhhrZuoTPCfm', NULL, '2023-10-28 06:32:06', '2023-10-28 06:32:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_seller_id_foreign` (`seller_id`),
  ADD KEY `products_sub_admin_id_foreign` (`sub_admin_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_admins`
--
ALTER TABLE `sub_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_admins_email_unique` (`email`),
  ADD KEY `sub_admins_role_foreign` (`role`);

--
-- Indexes for table `userpackages`
--
ALTER TABLE `userpackages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userpackages_user_id_foreign` (`user_id`),
  ADD KEY `userpackages_package_id_foreign` (`package_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_foreign` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_admins`
--
ALTER TABLE `sub_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userpackages`
--
ALTER TABLE `userpackages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_admin_id_foreign` FOREIGN KEY (`sub_admin_id`) REFERENCES `sub_admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_admins`
--
ALTER TABLE `sub_admins`
  ADD CONSTRAINT `sub_admins_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `userpackages`
--
ALTER TABLE `userpackages`
  ADD CONSTRAINT `userpackages_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`),
  ADD CONSTRAINT `userpackages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
